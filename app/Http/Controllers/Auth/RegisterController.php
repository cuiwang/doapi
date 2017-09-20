<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegisterEvent;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/main/console';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout','confirmEmail','login','register']);
    }




    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $data = $request->all();
        //1.验证基本信息
        $messages = [
//            'email.unique'    => '邮箱已被注册,请直接登录.',
            'email.required'    => '请输入邮箱.',
            'name.required'    => '请输入昵称.',
            'password.required'    => '请输入密码.',
            'password.confirmed'    => '两次输入的密码不一致,请检查.',
            'password.min'    => '为了您的数据安全,密码请最少设置6位.',
        ];
        $validator = Validator::make($data, [
            'name' => 'bail|required|string|max:255',
//            'email' => 'bail|required|string|email|max:255|unique:users',
            'email' => 'bail|required|string|email|max:255',
            'password' => 'bail|required|string|min:6|confirmed',
        ],$messages);
        //2.验证帐号状态
        $user = User::where('email',$data['email'])->first();
        if (empty($user)) {
            //没有这个邮箱
            $user = $this->create($request->all());
        } elseif ($user->status == 0) {
            //已存在邮箱,但是未激活
            $user = $this->update($request->all());
        }else {
            //已经注册过了
            $validator->errors()->add('email', '邮箱已被注册!');
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }


        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }


    protected function redirectTo()
    {
        return $this->redirectTo;
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $base = [
            'name' => base64_encode($data['name']),
            'email' => $data['email'],
            'status' => 1,
            'password' => bcrypt($data['password']),
        ];
        $option = [
            'confirm_code'=>str_random(48),
        ];
        $user = User::create(array_merge($base,$option));

        //发送注册成功事件
        event(new UserRegisterEvent($user));


        return $user;
    }

    protected function update(array $data)
    {

        $user = User::where('email',$data['email'])->first();
        $user->status = 1;
        $user->password = bcrypt($data['password']);
        $user->name = base64_encode($data['name']);
        $user->save();
        //发送注册成功事件
        event(new UserRegisterEvent($user));


        return $user;
    }

    /**
     * 验证是否激活
     */
    private function somethingElseIsInvalid()
    {
    }
}
