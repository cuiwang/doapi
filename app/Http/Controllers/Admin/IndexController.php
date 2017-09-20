<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;

require_once '/Applications/MAMP/htdocs/myapp/resources/org/code/Code.class.php';

class IndexController extends Controller
{
    protected $redirectTo = '/main/console';//用户成功认证登录

    public function index()
    {

        /*  $tt = DB::connection()->getPdo();
          dd($tt);*/
        /* $common_user = DB::table('common_user')->where('id','>',1)->get();
          dd($common_user);*/

        /*$common_user = UserModel::find(1);
        dd($common_user);*/

        if (Auth::check())
        {
            return redirect($this->redirectTo);
        }else{
        return view('index');
        }

    }

    public function home()
    {
        echo config('database.default');
//        return view('home');
    }

    public function login()
    {
        if ($input = Input::all()) {
            $code = new \Code();
            $acode = $code->get();
            if ($acode != $input['code']) {
               return back()->with('msg','验证码错误');
           }
        } else {
        }
        return view('admin.login');
    }

    public function code()
    {
        $code = new \Code();
        $code->make();
    }
}
