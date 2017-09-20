<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//==============首页==================
Route::get('/', 'IndexController@index')->name('home');
Route::get('/home', 'IndexController@index')->name('home');
Route::get('/help', 'IndexController@help');

//==============认证==================
Route::auth();

//========================用户Routes=1分钟只能访问30次===============================================
Route::group(['prefix'=>'test','middleware'=>'throttle:30'],function () {

    $apis = \App\Api::all();

    foreach ($apis as $api) {

        if ($api->status == 200) {
            switch ($api->method) {
                case 'POST':
                    Route::post('{id}_api/' . $api->url, 'TestController@test');
                    break;
                case 'GET':
                    Route::get('{id}_api/' . $api->url.'{param?}', 'TestController@test');
                    break;
                case 'PUT':
                    Route::put('{id}_api/' . $api->url, 'TestController@test');
                    break;
                case 'PATCH':
                    Route::patch('{id}_api/' . $api->url, 'TestController@test');
                    break;
                case 'DELETE':
                    Route::delete('{id}_api/' . $api->url, 'TestController@test');
                    break;
                default:
                    Route::any('{id}_api/' . $api->url.'{param?}', 'TestController@test');
            }
        } else if ($api->status == 503) {
            Route::any('{id}_api/' . $api->url, 'TestController@test503');
        } else {//503
            Route::any('{id}_api/' . $api->url, 'TestController@test500');
        }


    }
});
//========================用户Routes结束================================================

//====================第三方登录====================================================
Route::group(['prefix'=>'auth','namespace' => 'Auth'],function () {
// 引导用户到新浪微博的登录授权页面
    Route::get('weixin', 'LoginController@weixin');
    Route::get('weibo', 'LoginController@weibo');
    Route::get('qq', 'LoginController@qq');
//用户授权后新浪微博回调的页面
    Route::get('callback', 'LoginController@callback');
    Route::get('qq_callback', 'LoginController@qq_callback');
    Route::get('weixin_callback', 'LoginController@weixin_callback');

});
//=====================第三方登录结束===================================================


//========================用户前台入口================================================
Route::get('logout', 'Auth\LoginController@logout');
Route::get('verify/{confirm_code}', 'Auth\LoginController@confirmEmail');



Route::group(['namespace'=>'Auth','middleware' => ['userAuth','throttle:30']], function () {
    Route::get('/','LoginController@index');
    Route::get('login', ['as' => 'login', 'uses' => 'LoginController@showLoginForm']);
    Route::get('login_email','LoginController@login_email');
    Route::post('login', 'LoginController@login');

// Registration Routes...
    Route::get('register', 'RegisterController@showRegistrationForm');
    Route::post('register', 'RegisterController@register');

// Password Reset Routes...
    Route::get('password/reset/{token?}', 'ResetPasswordController@showResetForm');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'ResetPasswordController@reset');
});
//========================用户前台入口结束================================================

//========================控制台入口================================================
Route::group(['prefix'=>'main','middleware' => ['auth','throttle:30']],function () {
    Route::get('/console', 'ConsoleController@index');
    Route::get('project/create','ConsoleController@create');
    Route::post('project/store', 'ConsoleController@store');
    Route::patch('project/edit/{id}', 'ConsoleController@update');
    Route::get('project/{id}/edit', 'ConsoleController@edit');
    Route::post('project/delete/{id}', 'ConsoleController@delete');
    Route::post('/changeicon/{id}','ConsoleController@changeicon');
});

//========================用户中心入口结束================================================

    Route::group(['prefix'=>'main','middleware' => ['auth','throttle:30']],function () {

    Route::get('userCenter/showResetForm', 'UserCenterController@showResetForm');
    Route::post('userCenter/resetPassword', 'UserCenterController@resetPassword');
    Route::get('userCenter', 'UserCenterController@show');
    Route::post('userCenter/update', 'UserCenterController@update');
    Route::post('userCenter/changeHeadimg', 'UserCenterController@changeHeadimg');

});
//========================用户中心入口结束================================================

//========================文档管理================================================
Route::group(['prefix'=>'i','middleware' => ['auth','throttle:30']],function () {
    Route::get('{path}/doc_set', 'DocController@doc_set');
    Route::get('{path}/mydoc','DocController@lockscreen');
    Route::post('{path}/mydoc','DocController@lockscreen_passwd');
    Route::get('{path}/doc', 'DocController@doc_detail');
    Route::get('{path}/doc_download', 'DocController@doc_download');
});
//========================文档管理结束================================================

//========================成员管理================================================
Route::group(['prefix'=>'i','middleware' => ['throttle:30']],function () {
    Route::post('{path}/members/addMember', 'MemberController@addMember')->middleware('auth');
    Route::post('{path}/members/addAgainMember', 'MemberController@addAgainMember')->middleware('auth');
    Route::post('{path}/members/delMember', 'MemberController@delMember')->middleware('auth');
    Route::post('{path}/members/transformToOther', 'MemberController@transformToOther')->middleware('auth');
    Route::post('{path}/members/changeRole', 'MemberController@changeRole')->middleware('auth');
    Route::get('{path}/members', 'MemberController@members')->middleware('auth');
    Route::get('{path}/view_AcceptEmailInvitation/{email}', 'MemberController@view_AcceptEmailInvitation');
    Route::post('{path}/action_AcceptEmailInvitation', 'MemberController@action_AcceptEmailInvitation');
});
//========================成员管理结束================================================


//========================用户产品入口================================================
/*用户产品入口*/
Route::group(['prefix'=>'i','middleware' => ['auth','throttle:30']],function () {
    /* Route::get('dogroup', function () { //创建组
         return view('api.dogroup');
     });*/

    //进入预览
    Route::get('project/{id}','ProjectController@show');
    Route::get('project/{id}/logs','ProjectController@logs');
    //修改背景图片
    Route::post('project/changeBGimg/{id}', 'ProjectController@changeBGimg');

    Route::get('{path}','UserApiController@index');
    Route::delete('{path}/{id}','UserApiController@destroy');
    Route::get('{path}/info', 'UserApiController@info');
    Route::post('{path}/{id}/status/{status}','UserApiController@changeStatus');
   //查看动态接口
    Route::get('{path}/dynamic_total', 'DynamicApiController@dynamic_total');
    //复制动态接口
    Route::post('{path}/{id}/dynamic_copy', 'DynamicApiController@dynamic_copy');
    //创建动态接口视图
    Route::get('{path}/dynamic_create','DynamicApiController@dynamic_create');
    //存储动态接口
    Route::any('{path}/dynamic_store','DynamicApiController@dynamic_store');
    //创建更新动态接口视图
    Route::get('{path}/{id}/dynamic_edit','DynamicApiController@dynamic_edit');
    //更新动态接口
    Route::post('{path}/{id}/dynamic_update','DynamicApiController@dynamic_update');

    //查看静态接口
    Route::get('{path}/total', 'StaticApiController@total');
    //复制静态接口
    Route::post('{path}/{id}/copy', 'StaticApiController@copy');
    //创建静态接口视图
    Route::get('{path}/create','StaticApiController@create');
    //存储静态接口
    Route::post('{path}','StaticApiController@store');
    //创建更新静态接口视图
    Route::get('{path}/{id}/edit','StaticApiController@edit');
    //更新静态接口
    Route::post('{path}/{id}/update','StaticApiController@update');




});
//========================用户产品入口结束================================================


//========================文档================================================

Route::group(['prefix'=>'doc','middleware' => ['auth','throttle:10']],function () {
    Route::post('/changeStatus/{id}','DocController@changeStatus');
    Route::post('/changeBgimg/{id}','DocController@changeBgimg');
    Route::post('/changeTitle/{id}','DocController@changeTitle');
    Route::post('/versionChange/{id}','DocController@versionChange');
    Route::post('/descriptionChange/{id}','DocController@descriptionChange');
    Route::post('/baseurlChange/{id}','DocController@baseurlChange');

});
//========================文档结束================================================


//Route::any('project/changeicon','ProjectController@change_project_icon'); //产品资源路由

Route::any('project/test/{url}','ProjectController@test');
Route::any('test',function() {
    return view('api/doc_details');
});
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');




