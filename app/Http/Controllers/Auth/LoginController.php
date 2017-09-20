<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Barryvdh\Debugbar\Middleware\Debugbar;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/main/console';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware($this->guestMiddleware(), ['except' => ['logout','confirmEmail','login','register']]);

        $this->middleware('guest')->except(['logout','confirmEmail','login','register']);
    }


    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $data = $request->all();
        $messages = [
            'email.required'    => '请输入邮箱.',
            'email'    => '邮箱格式错误',
            'password.required'    => '请输入密码.',
        ];

        $validator = Validator::make($data, [
            'email' => 'email|required|string',
            'password' => 'required|string',
        ],$messages);

        //2.验证帐号状态
        $user = User::where('email',$data['email'])->first();
        if (empty($user) || $user->status == 0) {
            $validator->errors()->add('email', '未注册或未激活!');
                $this->throwValidationException($request, $validator);
        }
    }



    public function index()
    {
        return view('index');
    }

    public function login_email()
    {
        return view('auth.login_email');
    }


    //第三方登录
    //==================微信==================================
    public function weixin()
    {
        return Socialite::with('weixin')->redirect();        // return \Socialite::with('weibo')->scopes(array('email'))->redirect();
    }

    public function weixin_callback(Request $request)
    {
        $oauthUser = Socialite::driver('weixin')->stateless()->user();
        //查找用户
        $user = User::where('weixin_id',$oauthUser->id)->first();
        if ($user) {//已经在表里面了
            if (Auth::check())
            {
                //一周
                $cookie = cookie('islogin', '1', 10080);
                return redirect($this->redirectTo)->withCookie($cookie);
            }else{
                if (Auth::attempt(['weixin_id' => $user->weibo_id, 'password' => "123123"],true)) {
                    $cookie = cookie('islogin', '1', 10080);
                    return redirect($this->redirectTo)->withCookie($cookie);
                }else{
                    return '认证失败,请联系管理员 qq:41612021';
                }
            }
        } else {//还没在表里面,自动创建用户
            $new_user = User::create([
                'name' => base64_encode($oauthUser->nickname),
                'headimg' => $oauthUser->avatar,
                'weixin_id' => $oauthUser->id,
                'status' => 2,
                'password' => '$2y$10$fZngYK9d.o1Ljapa2LCOduz9LZGnozewsVNV3NwMDpyq4ZAlaIvNm',
            ]);
            if (Auth::attempt(['weixin_id' => $new_user->weixin_id, 'password' => "123123"],true)) {
                $cookie = cookie('islogin', '1', 10080);
                return redirect($this->redirectTo)->withCookie($cookie);
            }else{
                return '认证失败,请联系管理员 qq:41612021';
            }
        }

    }

//==================微博==================================
    public function weibo()
    {
        return Socialite::with('weibo')->redirect();        // return \Socialite::with('weibo')->scopes(array('email'))->redirect();
    }

    public function callback(Request $request)
    {
        $oauthUser = \Socialite::driver('weibo')->stateless()->user();
        //查找用户
        $user = User::where('weibo_id',$oauthUser->id)->first();
        if ($user) {//已经在表里面了
            if (Auth::check())
            {
                //一周
                $cookie = cookie('islogin', '1', 10080);
                return redirect($this->redirectTo)->withCookie($cookie);
            }else{
                if (Auth::attempt(['weibo_id' => $user->weibo_id, 'password' => "123123"],true)) {
                    $cookie = cookie('islogin', '1', 10080);
                    return redirect($this->redirectTo)->withCookie($cookie);
                }else{
                    return '认证失败,请联系管理员 qq:41612021';
                }
            }
        } else {//还没在表里面,自动创建用户
            $new_user = User::create([
                'name' => base64_encode($oauthUser->nickname),
                'headimg' => $oauthUser->avatar,
                'weibo_id' => $oauthUser->id,
                'status' => 2,
                'password' => '$2y$10$fZngYK9d.o1Ljapa2LCOduz9LZGnozewsVNV3NwMDpyq4ZAlaIvNm',
            ]);
            if (Auth::attempt(['weibo_id' => $new_user->weibo_id, 'password' => "123123"],true)) {
                $cookie = cookie('islogin', '1', 10080);
                return redirect($this->redirectTo)->withCookie($cookie);
            }else{
                return '认证失败,请联系管理员 qq:41612021';
            }
        }

    }

    //===============QQ=====================================
    public function qq()
    {
        return Socialite::with('qq')->redirect();        // return \Socialite::with('weibo')->scopes(array('email'))->redirect();
    }

    public function qq_callback(Request $request)
    {
        $oauthUser = \Socialite::driver('qq')->stateless()->user();
        $user = User::where('qq_id',$oauthUser->id)->first();
        if ($user) {//已经在表里面了
            if (Auth::check())
            {
                $cookie = cookie('islogin', '1', 10080);
                return redirect($this->redirectTo)->withCookie($cookie);
            }else{
                if (Auth::attempt(['qq_id' => $user->qq_id, 'password' => "123123"],true)) {
                    $cookie = cookie('islogin', '1', 10080);
                    return redirect($this->redirectTo)->withCookie($cookie);
                }else{
                    return '认证失败,请联系管理员 qq:41612021';
                }
            }

//            $data = $this->oauth2_get_user_email($accessTokenResponseBody['access_token']);
        } else {//还没在表里面
//            $data = $this->oauth2_get_user_email($accessTokenResponseBody['access_token']);
//            $data = $this->oauth2_get_user_info($accessTokenResponseBody['access_token'],$accessTokenResponseBody['uid']);
            $new_user = User::create([
                'name' => base64_encode($oauthUser->nickname),
                'headimg' => $oauthUser->avatar,
                'qq_id' => $oauthUser->id,
                'status' => 2,
                'password' => '$2y$10$fZngYK9d.o1Ljapa2LCOduz9LZGnozewsVNV3NwMDpyq4ZAlaIvNm',
            ]);
            if (Auth::attempt(['qq_id' => $new_user->qq_id, 'password' => "123123"],true)) {
                $cookie = cookie('islogin', '1', 10080);
                return redirect($this->redirectTo)->withCookie($cookie);
            }else{
                return '认证失败,请联系管理员 qq:41612021';
            }

        }




    }

    public function oauth2_get_user_info($accessToken,$uid)
    {
        $url = "https://api.weibo.com/2/users/show.json?access_token=$accessToken&uid=$uid";
        $client = new Client();
        $response = $client->request('GET', $url);
        return json_decode($response->getBody(),true);
    }

    public function oauth2_get_user_email($accessToken)
    {
        $url = "https://api.weibo.com/2/account/profile/email.json?access_token=$accessToken";
        $client = new Client();
        $response = $client->request('GET', $url);
        return json_decode($response->getBody(),true);
    }
}
