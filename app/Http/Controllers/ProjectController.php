<?php

namespace App\Http\Controllers;

use App\Member;
use App\Project;
use App\Syslog;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;


class ProjectController extends Controller
{

    /**
     * 展示产品详情,进入产品概览
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();

        //
        $project = Project::findOrFail($id);

        //
        $members = Member::where('project_id', $project->id)->get();
        //查看是否邀请了这个人
        if ($members->contains('user_id',$user->id)) {

            //log
            $msg = "用户进入预览".' uid='.$user->id.' uname='.$user->name.' pid='.$project->id.' pname='.$project->name;
            Log::info($msg);

            $log = new Syslog();
            $log->description = $msg;
            $log->type = '3';
            $log->level = 'info';
            $log->project_id = $project->id;
            $log->user_id = $user->id;
            $log->save();
            //end log

            return redirect()->action('UserApiController@index', ['url' => $project->url]);
        }else{
            abort('403');
        }


    }


    /**
     * 修改背景图片
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeBGimg(Request $request,$id)
    {

        $user = Auth::user();

//        $file = Input::file('project_image');
//        echo '123';
//        dd($request->all());
//        Image::make($nfilename)->fit(200)->save();
        $project = Project::findOrFail($id);


        $project->backgdimg = $request::input('backbgimg');
        $project->save();


        //log
        $msg = "用户修改产品背景图片".' uid='.$user->id.' uname='.$user->name.' pid='.$project->id.' pname='.$project->name;
        Log::warning($msg);

        $log = new Syslog();
        $log->description = $msg;
        $log->type = '3';
        $log->level = 'warning';
        $log->project_id = $project->id;
        $log->user_id = $user->id;
        $log->save();
        //end log

        return \Response::json(
            [
                'success' => true,
            ]
        );



    }

    /**
     * 展示日志
     */
    public function logs($id)
    {
        $logs = Syslog::where('project_id',$id)->get();
        return view('api.logs',compact('logs'));
    }

}
