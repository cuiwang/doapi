<?php

namespace App\Http\Controllers;

use App\Syslog;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;


class UserCenterController extends Controller
{
    //


    public function __construct()
    {
    }


    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function resetPassword(Request $request)
    {
        $this->wrongTokenAjax();
        $opassword = $request->input('opassword');
        $password = $request->input('password');
        $password_confirmation = $request->input('password_confirmation');

        //1.验证基本信息
        $messages = [
//            'email.unique'    => '邮箱已被注册,请直接登录.',
            'opassword.required'    => '请输入原密码.',
            'password.required'    => '请输入密码.',
            'password_confirmation.required'    => '请输入密码.',
            'password.confirmed'    => '两次输入的密码不一致,请检查.',
            'password.min'    => '为了您的数据安全,密码请最少设置6位.',
        ];
        $validator = Validator::make($request->all(), [
            'opassword' => 'bail|required|string',
            'password' => 'bail|required|string|min:6|confirmed',
        ],$messages);

        $user = \Auth::user();
        if(!Hash::check($opassword, $user->password)){
            $validator->errors()->add('opassword', '原密码错误!');
        }
        if ( $validator->fails() ) {
//            $this->throwValidationException($request, $validator);
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $user->password = bcrypt($password);
            $user->save();
            \Auth::logout();

            //log
            $msg = "用户修改密码".' uid='.$user->id.' uname='.$user->name;
            Log::warning($msg);

            $log = new Syslog();
            $log->description = $msg;
            $log->type = '2';
            $log->level = 'warning';
            $log->project_id = 0;
            $log->user_id = $user->id;
            $log->save();
            //end log


            return redirect('login_email');
        }

    }

    public function show()
    {
        $user = Auth::user();
        return view('main.userCenter',compact('user'));
    }

    /**
     * 修改信息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
//        dd('test');

//        $file = Input::file('project_image');
//        echo '123';
        $this->wrongTokenAjax();
//        dd($request->all());
//        Image::make($nfilename)->fit(200)->save();


        $rules = array(
            'name' => [
                'required',
                'max:25',
            ],
            'phone' => 'digits_between:7,11',
            'company' => 'max:30',
        );

        $messages = [
            'phone.digits_between' => '手机格式不正确,请输入7-11位',
            'company.max'  => '公司名字太长',
            'name.max'  => '昵称太长',
            'name.required'  => '请输入昵称',
        ];

        $validator = \Validator::make($request->all(), $rules,$messages);
        if ( $validator->fails() ) {
            return \Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);
        }

        $name = base64_encode($request->get('name'));
        $phone = $request->get('phone');
        $company = $request->get('company');

        $user = Auth::user();

        $user->name = $name;
        $user->phone = $phone;
        $user->company = $company;

        $user->save();


        //log
        $msg = "用户更新个人信息".' uid='.$user->id.' uname='.$user->name;
        Log::warning($msg);

        $log = new Syslog();
        $log->description = $msg;
        $log->type = '2';
        $log->level = 'warning';
        $log->project_id = 0;
        $log->user_id = $user->id;
        $log->save();
        //end log

        return \Response::json(
            [
                'success' => true,
                'name' => $name,
                'phone' => $phone,
                'company' => $company,
            ]
        );

    }

    /**
     * 修改用户图标
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeHeadimg(Request $request)
    {
//        dd('test');

//        $file = Input::file('project_image');
//        echo '123';
        $this->wrongTokenAjax();
//        dd($request->all());
//        Image::make($nfilename)->fit(200)->save();
        $file = $request->file('image');

        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );
        $validator = \Validator::make($input, $rules);
        if ( $validator->fails() ) {
            return \Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);

        }


        $user = Auth::user();

        $destinationPath = 'uploads/';
        $filename = $user->id.'_'.time().'_'.$file->getClientOriginalName();


        $file->move($destinationPath,$filename);
        Image::make($destinationPath.$filename)->fit(200)->save();



        $user->headimg = '/'.$destinationPath.$filename;
        $user->save();


        //log
        $msg = "用户更新个人头像".' uid='.$user->id.' uname='.$user->name;
        Log::warning($msg);

        $log = new Syslog();
        $log->description = $msg;
        $log->type = '2';
        $log->level = 'warning';
        $log->project_id = 0;
        $log->user_id = $user->id;
        $log->save();
        //end log

        return \Response::json(
            [
                'success' => true,
                'avatar' => asset($destinationPath.$filename),
            ]
        );



    }



    /**
     * 检查是否合法提交
     * @return \Illuminate\Http\JsonResponse
     */
    public function wrongTokenAjax()
    {
        if ( \Session::token() !== \Request::get('_token') ) {
            $response = [
                'status' => false,
                'errors' => 'Wrong Token',
            ];
            return \Response::json($response);
        }

    }

    /**
     * 重置密码方法
     * @param Request $request
     */
    public function set_password(Request $request){
        $id = Auth::user()->id;
        $oldpassword = $request->input('oldpassword');
        $newpassword = $request->input('newpassword');
        $res = DB::table('admins')->where('id',$id)->select('password')->first();
        if(!Hash::check($oldpassword, $res->password)){
            echo 2;
            exit;//原密码不对
        }
        $update = array(
            'password'  =>bcrypt($newpassword),
        );
        $result = DB::table('admins')->where('id',$id)->update($update);
        if($result){
            echo 1;exit;
        }else{
            echo 3;exit;
        }

    }
}
