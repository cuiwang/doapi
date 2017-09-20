<?php

namespace App\Http\Controllers;

use App\Api;
use App\Member;
use App\Notifications\DoApiNotification;
use App\Project;
use App\Syslog;
use App\User;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


/**
 * Class UserApiController
 * @package App\Http\Controllers
 */
class UserApiController extends Controller
{

    /**
     * 后台主框架,里面包含Iframe
     * @param $url
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($url)
    {
        $user = Auth::user();

        $projects = $user->projects;
        $project = Project::where('url',$url)->firstOrFail();
        $member = Member::where(['project_id'=>$project->id,'user_id'=>$user->id])->firstOrFail();
        $apis = $project->apis;
        $static_api = $apis->where('type','static');
        $dynamic_api = $apis->where('type','dynamic');
        $apis_count = $static_api->count();
        $dynamic_apis_count = $dynamic_api->count();
        $members_count = Member::where('project_id',$project->id)->get()->count();
        $path = url('i').'/'.$url.'/'.'info';

        return view('api.base_main',compact('user','projects','project','apis_count','dynamic_apis_count','members_count','url','path','member'));
    }

    /**
     * iframe 查看预览概览
     * @param $url
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function info($url)
    {
        $project = Project::where('url',$url)->firstOrFail();
        $apis = $project->apis;
        $apis_count = $apis->count();
        $qrcode = $project->qrcode;
        return view('api.about.info',compact('project','apis','url','apis_count','qrcode'));

    }

    /**
     * 修改接口状态
     * @param $id
     * @param $status
     * @return \Illuminate\Http\JsonResponse
     * @internal param Request $request
     */
    public function changeStatus($url,$id,$status)
    {

        $user = Auth::user();
        $project = Project::where('url',$url)->firstOrFail();
        $api = Api::findOrFail($id);

//        $file = Input::file('project_image');
//        echo '123';
//        dd($request->all());
//        Image::make($nfilename)->fit(200)->save();

        $api->status = $status;
        $api->save();

        //log
        $msg = "用户修改了API的状态".' uid='.$user->id.' uname='.base64_decode($user->name).' pid='.$api->id.' url='.$api->url;
        Log::warning($msg);

        $log = new Syslog();
        $log->description = $msg;
        $log->type = '3';
        $log->level = 'warning';
        $log->project_id = $project->id;
        $log->user_id = $user->id;
        $log->save();
        //end log


        //发送邮件
        $data = [
            'subject'=>'更新接口状态',
            'greeting'=>'请注意',
            'line1'=>base64_decode($user->name).' 更新一个接口的状态!',
            'line2'=>'接口地址:'.$api->url,
            'line3'=>'接口说明:'.$api->description,
            'line4'=>'更新时间:'.$api->updated_at,
            'action'=>'查看',
            'url'=>url('i').'/'.$project->url.'/doc',
        ];

        $users = Member::where('project_id',$project->id)->get()->map(function ($item, $key) {
            return User::where('id',$item->user_id)->first();
        });
        Notification::send($users, new DoApiNotification($data));

        return \Response::json(
            [
                'success' => true,
            ]
        );



    }

    /**
     *iframe 删除接口信息

     * @param $url
     * @param $id
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function destroy($url, $id)
    {
        $user = Auth::user();
        $project = Project::where('url',$url)->firstOrFail();
        $api = Api::where('id',$id)->firstOrFail();

        $re = $api->delete();
        if ($re) {
//            \Artisan::call('route:clear');//清理缓存
//            \Artisan::call('route:cache');//存储缓存
            //log
            $msg = "用户删除了一条API".' uid='.$user->id.' uname='.base64_decode($user->name).' pid='.$project->id.' name='.$project->name;
            Log::warning($msg);

            $log = new Syslog();
            $log->description = $msg;
            $log->type = '3';
            $log->level = 'warning';
            $log->project_id = $project->id;
            $log->user_id = $user->id;
            $log->save();
            //end log
            //发送邮件
            $data = [
                'subject'=>'删除接口',
                'greeting'=>'请注意',
                'line1'=>base64_decode($user->name).' 删除了一个接口!',
                'line2'=>'接口地址:'.$api->url,
                'line3'=>'接口说明:'.$api->description,
                'line4'=>'更新时间:'.$api->updated_at,
                'action'=>'查看',
                'url'=>url('i').'/'.$project->url.'/doc',
            ];

            $users = Member::where('project_id',$project->id)->get()->map(function ($item, $key) {
                return User::where('id',$item->user_id)->first();
            });
            Notification::send($users, new DoApiNotification($data));

            //
            $data = [
                'status'=>1,
                'msg'=>'恭喜大神,删除成功!',
            ];

        }else {
            $data = [
                'status'=>0,
                'msg'=>'大神留意,删除失败了!',
            ];
        }
        return $data;
    }




}
