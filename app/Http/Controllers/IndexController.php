<?php

namespace App\Http\Controllers;

use DebugBar\DebugBar;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class IndexController extends Controller
{
    /**
     * 前台首页入口
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //判断是否登录,是否过期
        $cookie = $request->cookie('islogin');
        if (is_null($cookie)) {
            return view('index');
        }else{
            return redirect()->action('ConsoleController@index');
        }
    }

    /**
     * 帮助页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function help()
    {
        return view('main.help');
    }

}
