<?php

namespace App\Http\Controllers;

use App\Api;
use App\Doc;
use App\Http\Requests\ProjectRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Member;
use App\Project;
use App\Syslog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ConsoleController extends Controller
{
    //

    /**
     *  控制台展示产品列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            // The user is logged in...
            $user = Auth::user();

            //log
            $msg = "用户进入控制台".' uid='.$user->id.' uname='.$user->name;
            Log::info($msg);

            $log = new Syslog();
            $log->description = $msg;
            $log->type = '2';
            $log->level = 'info';
            $log->project_id = 0;
            $log->user_id = $user->id;
            $log->save();
            //end log


            $members = Member::where('user_id',$user->id)->get();
            if ($members->count() <= 0) {
                return redirect('main/project/create');
            }else{
                $projects = $members->map(function ($item, $key){
                    $project = Project::where('id',$item->project_id)->first();
                    $project->role = $item->role;
                    return $project;
                });
                return view('main.console', compact('user', 'projects'));
            }
        } else {
            abort('403');
        }
        //

    }


    /**
     *  展示创建新产品页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('main.console_create', compact('user'));
    }


    /**
     * 展示产品编辑页面
     * main/console/{console}/edit
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = Auth::user();
        $project = Project::findOrFail($id);

        if ($user->id !== $project->user_id) {
            return back();
        }
        return view('main.console_edit', compact('user', 'project'));
    }

    /**
     * 创建新产品
     * 存储新产品到数据库
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        //
        $user = Auth::user();
        $data = $request->except(['_token', 'key', 'icon']);

        $qrcode = '/uploads/' . $data['url'] . '_qrcode.png';
        QrCode::format('png')->size(200)->merge('/public/favicon.png', .15)->generate(url('i') . '/' . $data['url'] . '/doc', public_path($qrcode));
        $ndata = array_merge($data, ['user_id' => $user->id, 'qrcode' => $qrcode]);
        $project = Project::create($ndata);

        if ($project) {
            $doc = Doc::create(['project_id' => $project->id, 'doc_title' => $data['name'], 'doc_description' => $data['description'], 'doc_baseurl' => 'https://doapi.cn/i' . '/' . $data['url'] . '/']);
            $member = Member::create(['project_id' => $project->id, 'user_id' => $user->id, 'role' => 'admin','status'=>'已加入']);
            if ($doc && $member) {
                $project->doc_id = $doc->id;
                $project->save();

                //log
                $msg = "控制台创建产品".' uid='.$user->id.' uname='.$user->name.' pid='.$project->id.' pname='.$project->name;
                Log::notice($msg);

                $log = new Syslog();
                $log->description = $msg;
                $log->type = '2';
                $log->level = 'notice';
                $log->project_id = $project->id;
                $log->user_id = $user->id;
                $log->save();
                //end log


                //创建完成后显示到详细页面
                return redirect()->action('ProjectController@show', ['id' => $project->id]);
            } else {
                Session::flash('project_create_error', '产品内置错误,请重试!');
                return back();
            }
        } else {
            Session::flash('project_create_error', '产品创建失败,请重试!');
            return back();
        }
    }


    /**
     * 将编辑的更新产品存储到数据库
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectUpdateRequest $request, $id)
    {
        $user = Auth::user();
        $project = Project::findOrFail($id);

        $project->update($request->all());

        //log
        $msg = "控制台更新产品".' uid='.$user->id.' uname='.$user->name.' pid='.$project->id.' pname='.$project->name;
        Log::notice($msg);

        $log = new Syslog();
        $log->description = $msg;
        $log->type = '2';
        $log->level = 'notice';
        $log->project_id = $project->id;
        $log->user_id = $user->id;
        $log->save();
        //end log

        return redirect()->action('ProjectController@index');
    }

    /**
     * 删除指定产品
     * main/console/{console}
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = Auth::user();
        $project = Project::findOrFail($id);

        if ($user->id !== $project->user_id) {
            return back();
        }
        //删除接口
        $apis = $project->apis;
        foreach ($apis as $api) {
            Api::where('id', $api->id)->delete();
        }
        //删除文档
        Doc::where('project_id', $project->id)->delete();
        //删除成员
        Member::where('project_id', $project->id)->delete();
        //删除产品
        $re = $project->delete();

        if ($re) {
            $data = [
                'status' => 1,
                'msg' => '恭喜大神,删除成功!',
            ];

            //log
            $msg = "控制台删除产品成功".' uid='.$user->id.' uname='.$user->name.' pid='.$project->id.' pname='.$project->name;
            Log::notice($msg);

            $log = new Syslog();
            $log->description = $msg;
            $log->type = '2';
            $log->level = 'notice';
            $log->project_id = $project->id;
            $log->user_id = $user->id;
            $log->save();
            //end log

        } else {
            $data = [
                'status' => 0,
                'msg' => '大神留意,删除失败了!',
            ];

            //log
            $msg = "控制台删除产品失败".' uid='.$user->id.' uname='.$user->name.' pid='.$project->id.' pname='.$project->name;
            Log::notice($msg);

            $log = new Syslog();
            $log->description = $msg;
            $log->type = '2';
            $log->level = 'notice';
            $log->project_id = $project->id;
            $log->user_id = $user->id;
            $log->save();
            //end log
        }
        return $data;
    }

    /**
     * 修改产品图标
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeicon(Request $request, $id)
    {
        $user = Auth::user();

        if (Session::token() !== Request::get('_token')) {
            $response = [
                'status' => false,
                'errors' => 'Wrong Token',
            ];
            return \Response::json($response);
        }

        if (Input::hasFile('image')) {
            $file = Input::file('image');
        } else {
            return Response::json([
                'success' => false,
                'errors' => '获取文件失败,请重试!'
            ]);
        }

        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);

        }

        $destinationPath = 'uploads/';
        $filename = $user->id . '_' . time() . '_' . $file->getClientOriginalName();

        $file->move($destinationPath, $filename);
        Image::make($destinationPath . $filename)->fit(200)->save();

        $project = Project::findOrFail($id);

        if ($user->id !== $project->user_id) {
            return back();
        }

        $project->iconimg = '/' . $destinationPath . $filename;
        $project->save();


        //log
        $msg = "控制台更新产品图标".' uid='.$user->id.' uname='.$user->name.' pid='.$project->id.' pname='.$project->name;
        Log::notice($msg);

        $log = new Syslog();
        $log->description = $msg;
        $log->type = '2';
        $log->level = 'notice';
        $log->project_id = $project->id;
        $log->user_id = $user->id;
        $log->save();
        //end log

        return Response::json(
            [
                'success' => true,
                'avatar' => asset($destinationPath . $filename),
            ]
        );

    }

}
