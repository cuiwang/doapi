<?php

namespace App\Http\Controllers;

use App\Mail\InvitationMail;
use App\Member;
use App\Project;
use App\Syslog;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use function PHPSTORM_META\elementType;
use Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Validator;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //
    /**
     * 查看成员列表
     */
    public function members($url)
    {
        $user = \Auth::user();
        $project = Project::where('url',$url)->firstOrFail();
        $members = Member::where('project_id', $project->id)->get()->map(function ($item,$key) {
            $usr = User::where('id',$item->user_id)->get();
            $usr->put('role' , $item->role);
            $usr->put('status' , $item->status);
            return $usr;
        });
        $user_role =  Member::where(['user_id'=>$user->id,'project_id'=>$project->id])->firstOrFail()->role;
//      dd($user_role);
        $size = $members->count();
        /*foreach ($members as $member) {
            dd($member[0]);
        }*/
//        dd($size);
        return view('api.member.member',compact('project','members','size','user_role','user'));

    }

    /**
     * 邀请成员
     */
    public function addMember(Request $request, $url)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $project = Project::where('url',$url)->firstOrFail();
        $fuser = Auth::user();

        $messages = [
            'required' => '此处不能为空',
            'email' => '邮箱格式不对',
        ];
        $rules = [
//            'email' => 'required|email|unique:users,email',
            'email' => 'required|email',
            'name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules,$messages);

        if ($validator->fails()) {
            $messages = $validator->errors();
            if ($messages->has('email')) {
                return Response::json(
                    [
                        'success' => false,
                        'data' => $messages->first('email'),
                        'position' => 1
                    ]
                );
            }
            if ($messages->has('name')) {
                return Response::json(
                    [
                        'success' => false,
                        'data' => $messages->first('name'),
                        'position' => 0
                    ]
                );
            }
        }
        else if($email == $fuser->email) {
            //发送人和接受人是同一个
            return Response::json(
                [
                    'success' => false,
                    'data' => '您邀请的是自己啊!',
                    'position' => 1
                ]
            );
        }
        //数据验证通过
        else{
            //==================数据库操作================
            // 创建状态为0的用户
            //判断是否存在
            $user = User::where('email' , $email)->first();
            if (empty($user)) {
                $user = new User;
                $user->name = base64_encode($name);
                $user->email = $email;
                $user->status = 0;
                $user->save();
                // 创建关系表
                $member = new Member;
                $member->project_id = $project->id;
                $member->user_id = $user->id;
                $member->role = 'writer';
                $member->status = '已邀请';
                $member->save();


                //log
                $ouser= Auth::user();
                $msg = "用户邀请朋友加入产品".' uid='.$ouser->id.' uname='.base64_decode($ouser->name).' tid='.$user->id.' tname='.base64_decode($user->name).' pid='.$project->id.' pname='.$project->name;
                Log::warning($msg);

                $log = new Syslog();
                $log->description = $msg;
                $log->type = '3';
                $log->level = 'warning';
                $log->project_id = $project->id;
                $log->user_id = $ouser->id;
                $log->save();
                //end log

            }else{
                //用户已存在
                //判断是否邀请 null,已加入
                $mem = Member::where(['user_id'=> $user->id,'project_id'=> $project->id,])->first();
                if (empty($mem)) {
                    // 创建关系表
                    $member = new Member;
                    $member->project_id = $project->id;
                    $member->user_id = $user->id;
                    $member->role = 'writer';
                    $member->status = '已邀请';
                    $member->save();


                    //log
                    $ouser= Auth::user();
                    $msg = "用户邀请朋友加入产品".' uid='.$ouser->id.' uname='.base64_decode($ouser->name).' tid='.$nuser->id.' tname='.base64_decode($nuser->name).' pid='.$project->id.' pname='.$project->name;
                    Log::warning($msg);

                    $log = new Syslog();
                    $log->description = $msg;
                    $log->type = '3';
                    $log->level = 'warning';
                    $log->project_id = $project->id;
                    $log->user_id = $ouser->id;
                    $log->save();
                    //end log
                }else{
                    //已经加入?
                    if ($mem->status == '已加入') {
                        return Response::json(
                            [
                                'success' => false,
                                'data' => '已加入',
                                'position' => 1
                            ]
                        );
                    }else if ($mem->status == '已邀请') {
                        return Response::json(
                            [
                                'success' => false,
                                'data' => '已邀请,等待加入',
                                'position' => 1
                            ]
                        );
                    }
                }
            }


            //==================\数据库操作================

            //==================发送邀请邮件================
            //
            Mail::to($user)->send(new InvitationMail($fuser,$user,$project));
            //==================\发送邀请邮件================

            //==================返回前台数据================
            //
            return Response::json(
                [
                    'success' => true,
                    'data' => '成功啦',
                    'position' => 0
                ]
            );
            //==================\返回前台数据================
        }


    }

    /**
     * 再次邀请
     * @param Request $request
     * @param $url
     * @return \Illuminate\Http\JsonResponse
     */
    public function addAgainMember(Request $request, $url)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $project = Project::where('url',$url)->firstOrFail();
        $fuser = Auth::user();

        $messages = [
            'required' => '此处不能为空',
            'email' => '邮箱格式不对',
        ];
        $rules = [
//            'email' => 'required|email|unique:users,email',
            'email' => 'required|email',
            'name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules,$messages);

        if ($validator->fails()) {
            $messages = $validator->errors();
            if ($messages->has('email')) {
                return Response::json(
                    [
                        'success' => false,
                        'data' => $messages->first('email'),
                        'position' => 1
                    ]
                );
            }
            if ($messages->has('name')) {
                return Response::json(
                    [
                        'success' => false,
                        'data' => $messages->first('name'),
                        'position' => 0
                    ]
                );
            }
        }
        else if($email == $fuser->email) {
            //发送人和接受人是同一个
            return Response::json(
                [
                    'success' => false,
                    'data' => '您邀请的是自己啊!',
                    'position' => 1
                ]
            );
        }
        //数据验证通过
        else{
            //==================数据库操作================
            // 创建状态为0的用户
            //判断是否存在
            $user = User::where('email' , $email)->first();
            if (empty($user)) {
                $user = new User;
                $user->name = base64_encode($name);
                $user->email = $email;
                $user->status = 0;
                $user->save();
                // 创建关系表
                $member = new Member;
                $member->project_id = $project->id;
                $member->user_id = $user->id;
                $member->role = 'writer';
                $member->status = '已邀请';
                $member->save();

                //log
                $ouser= Auth::user();
                $msg = "用户再次邀请朋友加入产品".' uid='.$ouser->id.' uname='.base64_decode($ouser->name).' tid='.$nuser->id.' tname='.base64_decode($nuser->name).' pid='.$project->id.' pname='.$project->name;
                Log::warning($msg);

                $log = new Syslog();
                $log->description = $msg;
                $log->type = '3';
                $log->level = 'warning';
                $log->project_id = $project->id;
                $log->user_id = $ouser->id;
                $log->save();
                //end log

            }else{
                //用户已存在
                //判断是否邀请 null,已加入
                $mem = Member::where(['user_id'=> $user->id,'project_id'=> $project->id,])->first();
                if (empty($mem)) {
                    // 创建关系表
                    $member = new Member;
                    $member->project_id = $project->id;
                    $member->user_id = $user->id;
                    $member->role = 'writer';
                    $member->status = '已邀请';
                    $member->save();

                    //log
                    $ouser= Auth::user();
                    $msg = "用户再次邀请朋友加入产品".' uid='.$ouser->id.' uname='.base64_decode($ouser->name).' tid='.$nuser->id.' tname='.base64_decode($nuser->name).' pid='.$project->id.' pname='.$project->name;
                    Log::warning($msg);

                    $log = new Syslog();
                    $log->description = $msg;
                    $log->type = '3';
                    $log->level = 'warning';
                    $log->project_id = $project->id;
                    $log->user_id = $ouser->id;
                    $log->save();
                    //end log


                }else{
                    //已经加入?
                    if ($mem->status == '已加入') {
                        return Response::json(
                            [
                                'success' => false,
                                'data' => '已加入',
                                'position' => 1
                            ]
                        );
                    }
                }
            }


            //==================\数据库操作================

            //==================发送邀请邮件================
            //
            Mail::to($user)->send(new InvitationMail($fuser,$user,$project));
            //==================\发送邀请邮件================

            //==================返回前台数据================
            //
            return Response::json(
                [
                    'success' => true,
                    'data' => '成功啦',
                    'position' => 0
                ]
            );
            //==================\返回前台数据================
        }


    }

    /**
     * 查看接受邀请
     */
    public function view_AcceptEmailInvitation($url,$email)
    {
        $invitee = User::where('email',$email)->firstOrFail();
        $project = Project::where('url',$url)->firstOrFail();
        $members = Member::where(['project_id'=>$project->id,'status'=>'已邀请'])->get();
        //查看是否邀请了这个人
        if ($members->contains('user_id',$invitee->id)) {
            $founder = $project->user;
            return view('api.member.invitation',compact('project','founder','email','invitee'));
        }else{
            abort(403);
        }

    }

    /**
     * 接受邀请(不需要走auth)
     */
    public function action_AcceptEmailInvitation(Request $request,$url)
    {
        //1.校验数据 email,password,project_url
        $email = $request->input('email');
        $password = $request->input('password');

        //2.通过email查用户,空用户提示错误并跳到注册页面
        //已存在用户分为正常用户和邀请用户,需要把邀请用户注册成正常用户status =1
        //进行登录
        //更新member表
        //进入控制台
        $invitee = User::where('email',$email)->firstOrFail();
        $project = Project::where('url',$url)->firstOrFail();
        $members = Member::where('project_id',$project->id)->get();
        //查看是否邀请了这个人
        if ($members->contains('user_id',$invitee->id)) {
            if ($invitee->status == 0) {
                //未激活用户
                //1.更新user $invitee
                $invitee->password = bcrypt($password);
                $invitee->status = 1;
                $invitee->save();
                //2.更新members状态
                $member = Member::where(['project_id'=>$project->id,'user_id'=>$invitee->id])->firstOrFail();
                $member->status = '已加入';
                $member->save();
                //通过auth
                Auth::logout();
                Auth::loginUsingId($invitee->id, true);

                //log
                $user= $invitee;
                $msg = "未激活用户接受产品邀请".' id='.$user->id.' name='.base64_decode($user->name);
                Log::alert($msg);

                $log = new Syslog();
                $log->description = $msg;
                $log->type = '1';
                $log->level = 'alert';
                $log->project_id = 0;
                $log->user_id = $user->id;
                $log->save();
                //end log

                return redirect()->action('UserCenterController@show');
            }else{
                //已激活用户
                //判断密码是否正确
                if (Auth::attempt(['email' => $email, 'password' => $password])) {
                    //2.更新members状态
                    $member = Member::where(['project_id'=>$project->id,'user_id'=>$invitee->id])->firstOrFail();
                    $member->status = '已加入';
                    $member->save();
                    Auth::loginUsingId($invitee->id, true);

                    //log
                    $user= $invitee;
                    $msg = "已激活用户接受产品邀请".' id='.$user->id.' name='.base64_decode($user->name);
                    Log::alert($msg);

                    $log = new Syslog();
                    $log->description = $msg;
                    $log->type = '1';
                    $log->level = 'alert';
                    $log->project_id = 0;
                    $log->user_id = $user->id;
                    $log->save();
                    //end log

                    return redirect()->action('ProjectController@index');
               }else{
                    return back()->with('error','密码错误');
                }
            }


        }else{
            abort(403);
        }
    }
    /**
     * 删除成员
     */
    public function delMember(Request $request,$url)
    {
        $user = Auth::user();
        $project = Project::where('url',$url)->firstOrFail();
        $user_id = $request->input('uid');
        $member = Member::where(['user_id'=>$user_id,'project_id'=>$project->id])->firstOrFail();
        $isDeleted = $member->delete();
        if ($isDeleted) {

            //log
            $msg = "用户从产品团队删除了一个朋友".' uid='.$user->id.' uname='.base64_decode($user->name).' tid='.$user_id.' pid='.$project->id.' pname='.$project->name;
            Log::warning($msg);

            $log = new Syslog();
            $log->description = $msg;
            $log->type = '3';
            $log->level = 'warning';
            $log->project_id = $project->id;
            $log->user_id = $user->id;
            $log->save();
            //end log

            //删除了
            return Response::json(
                [
                    'success' => true,
                    'data' => '删除成功'
                ]
            );
        }else{
            //删除失败
            return Response::json(
                [
                    'success' => false,
                    'data' => '删除失败'
                ]
            );
        }
        echo $member->user_id;
    }

    /**
     * 转让产品 (修改产品的拥有人?修改关联表中的权限?退出)
     * admin writer reader
     */
    public function transformToOther(Request $request, $url)
    {
        $project = Project::where('url',$url)->firstOrFail();
        $user = Auth::user();
        $toid = $request->input('toid');
        $toUser = User::where('id',$toid)->firstOrFail();
        $member = Member::where(['project_id'=>$project->id,'user_id'=>$user->id])->firstOrFail();
        $tomember = Member::where(['project_id'=>$project->id,'user_id'=>$toUser->id])->firstOrFail();

        $project->user_id = $toUser->id;
        $project->save();
        $member->delete();
        $tomember->role = 'admin';
        $tomember->save();

        //log
        $msg = "用户把产品转让给了其他人".' uid='.$user->id.' uname='.base64_decode($user->name).' tid='.$toUser->id.' uname='.base64_decode($toUser->name).' pid='.$project->id.' pname='.$project->name;
        Log::warning($msg);

        $log = new Syslog();
        $log->description = $msg;
        $log->type = '3';
        $log->level = 'warning';
        $log->project_id = $project->id;
        $log->user_id = $user->id;
        $log->save();
        //end log

        return Response::json(
            [
                'success' => true,
                'data' => '转让成功'
            ]
        );
        //
    }
    /**
     * 修改身份
     * admin writer reader
     */
    public function changeRole(Request $request, $url)
    {
        $project = Project::where('url',$url)->firstOrFail();
        $user = Auth::user();
        $toid = $request->input('toid');
        $toUser = User::where('id',$toid)->firstOrFail();
        $torole = $request->input('torole');
        $member = Member::where(['project_id'=>$project->id,'user_id'=>$user->id])->firstOrFail();
        $toid = $request->input('toid');
        $tomember = Member::where(['project_id'=>$project->id,'user_id'=>$toUser->id])->firstOrFail();

        if ($member->role != 'admin') {
            throw new HttpException('503');
        }

        $tomember->role = $torole;
        $tomember->saveOrFail();


        //log
        $msg = "用户修改了别人的角色".' uid='.$user->id.' uname='.base64_decode($user->name).' tid='.$toUser->id.' uname='.base64_decode($toUser->name).' pid='.$project->id.' pname='.$project->name;
        Log::warning($msg);

        $log = new Syslog();
        $log->description = $msg;
        $log->type = '3';
        $log->level = 'warning';
        $log->project_id = $project->id;
        $log->user_id = $user->id;
        $log->save();
        //end log


        return Response::json(
            [
                'success' => true,
                'data' => '修改成功'
            ]
        );

    }

}
