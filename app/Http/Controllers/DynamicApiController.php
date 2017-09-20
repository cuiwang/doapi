<?php

namespace App\Http\Controllers;

use App\Api;
use App\Member;
use App\Project;
use App\Syslog;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class DynamicApiController extends Controller
{
    //
    //
    /**
     * iframe 查看所有动态接口
     * @param $url
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dynamic_total($url)
    {
        $project = Project::where('url',$url)->firstOrFail();
        $apis = $project->apis->where('type','dynamic');
        return view('api.dynamic.dynamic_api_total',compact('apis','url'));
    }
    /**
     *iframe 新建接口 -视图
     * @param $url
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dynamic_create($url)
    {
        return view('api.dynamic.dynamic_doapi',compact('url'));
    }

    /**
     * 显示更新页面
     * @param $url
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dynamic_edit($url, $id)
    {
        $user = \Auth::user();
        $project = Project::where('url',$url)->firstOrFail();
       /* if ($user->id !== $project->user_id) {
            return back();
        }*/

        $api = Api::findOrFail($id);
        /*获取参数,拼接成数组*/
        $params = $api->param;//参数
        $param_descriptions = $api->param_description;//参数

        $param_description_array = explode('|',$param_descriptions);//描述

        $param_edit_array = array();//

        if (!empty($params)) {
            $param_array = explode('&',$params);
        for ( $i=0;$i< count($param_array);$i++) {
            $param = $param_array[$i];
            $second_part = $param_description_array[$i];
            $p_arr = array();
            $first_part_array  = explode('=',$param);
            $fp0 = $first_part_array[0];//key
            $fp1 = $first_part_array[1];//value
            if (!empty($fp0) && !empty($fp1)) {
                $p_arr = array($second_part=>array($fp0,$fp1));
            }
            array_push($param_edit_array, $p_arr);
        }
        }

        /*===========返回值===============*/
        $back_params = $api->json;//参数
        $back_param_array = explode('&',$back_params);
        $back_param_edit_array = array();//
        for ( $i=0;$i< count($back_param_array);$i++) {
            $back_param = $back_param_array[$i];
            $new_param_array = explode('|',$back_param);
            $p_arr = array($new_param_array[0],$new_param_array[1],$new_param_array[2],$new_param_array[3]);
            array_push($back_param_edit_array, $p_arr);
        }

        return view('api.dynamic.dynamic_doapi_edit',compact('url','api','param_edit_array','back_param_edit_array'));
    }

    /**
     * 存储新增接口
     * @param Request $request
     * @param $url
     * @return \Illuminate\Http\JsonResponse
     */
    public function dynamic_store(Request $request, $url)
    {
        //判断参数合法性
        // username=abc&user_name|password=123&pass_wd|
        /*=================传入参数校验=====================================*/

        $params = $request->input('param');

        if ($params != "=") {//没有填写参数
            $param_array = explode('&',$params);

            foreach ($param_array as $item) {
                $first_part_array  = explode('=',$item);
                $fp0 = $first_part_array[0];
                $fp1 = $first_part_array[1];
                if (empty($fp0) && empty($fp1)) {
                    //不带参数
                }else if (empty($fp0) || empty($fp1)) {
                    //如果字段和值不对应,提示用户
                    return \Response::json([
                        'success' => false,
                        'errors' => array('param'=>'参数名和默认值不能为空!'),
                    ]);
                }else {
                    //合法
                }
            }
        }


        /*=================返回内容校验=====================================*/
        //判断url内容合法性
        $message = [
            'url_method.unique' => '请求地址重复,修改请求方式或地址',
        ];
        $rules = array(
            'url_method'=> [
                'unique:apis,url_method',
            ],
        );
        $vdata = ['url_method'=>$url.'/'.$request->input('url').'&'.$request->input('method')];
        $validator = \Validator::make($vdata, $rules,$message);

        if ( $validator->fails() ) {
            return \Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);

        }

        /*=================返回内容校验=====================================*/
        $back_params = $request->input('json');

        if (substr($back_params,-3) != "|||") {
            $back_param_array = explode('&', $back_params);

            foreach ($back_param_array as $item) {
                $first_part_array = explode('|', $item);
                $fp0 = $first_part_array[0];//类型
                $fp1 = $first_part_array[1];//参数名
                $fp2 = $first_part_array[2];//配置
                $fp3 = $first_part_array[3];//说明
                if (empty($fp1)) {
                    //如果字段和值不对应,提示用户
                    return \Response::json([
                        'success' => false,
                        'errors' => array('back_param' => '参数名不能为空!'),
                    ]);
                } else {
                    //合法
                }
            }
        }


        //全部校验完成,写数据库

        $project = Project::where('url',$url)->firstOrFail();
        $user = \Auth::user();

        $data = $request->except(['_token','key','icon']);

        $ndata = array_merge($data,['project_id'=>$project->id,'user_id'=>$user->id,'url_method'=>$url.'/'.$request->input('url').'&'.$request->input('method')]);

        $api = Api::create($ndata);



        if ($api) {//创建完成后显示到详细页面
//            Artisan::call('route:clear');//清理缓存
//            Artisan::call('route:cache');//存储缓存

            //log
            $msg = "用户创建了一条动态API".' uid='.$user->id.' uname='.base64_decode($user->name).' pid='.$api->id.' url='.$api->url;
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
                'subject'=>'新增接口',
                'greeting'=>'请注意',
                'line1'=>base64_decode($user->name).' 新增了一个接口!',
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

            return \Response::json([
                'success' => true,
                'data' => '成功',
            ]);
        } else {
            return \Response::json([
                'success' => false,
                'errors' => array('server'=>'服务器异常,请联系管理员'),
            ]);
        }
    }

    /**
     * 复制新增接口
     * @param $url
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function dynamic_copy($url, $id)
    {
        $user = Auth::user();
        $project = Project::where('url',$url)->firstOrFail();
        /* if ($user->id !== $project->user_id) {
             return back();
         }*/

        $api_old = Api::findOrFail($id);
        $api_old->url = 'copy_rand'.mt_rand(0,100).'_'.$api_old->url;
        $api_old->url_method = $url.'/'.'copy_'.$api_old->url.'&'.$api_old->method;
        $data = $api_old->toArray();
        unset($data['id']);
        unset($data['created_at']);
        unset($data['updated_at']);

        $api = Api::create($data);

        if ($api) {//创建完成后显示到详细页面
//            Artisan::call('route:clear');//清理缓存
//            Artisan::call('route:cache');//存储缓存

            //log
            $msg = "用户创建了一条动态API".' uid='.$user->id.' uname='.base64_decode($user->name).' pid='.$api->id.' url='.$api->url;
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
                'subject'=>'新增接口',
                'greeting'=>'请注意',
                'line1'=>base64_decode($user->name).' 新增了一个接口!',
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


            return \Response::json([
                'success' => true,
                'data' => '成功',
                'id'=>''.$api->id,
                'url'=>''.$url,
            ]);
        } else {
            return \Response::json([
                'success' => false,
                'data' => '复制失败!',
            ]);
        }


    }

    /**
     * 更新接口
     * @param Request $request
     * @param $url
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function dynamic_update(Request $request, $url, $id)
    {


        //判断参数合法性
        // username=abc&user_name|password=123&pass_wd|
        /*=================传入参数校验=====================================*/

        $params = $request->input('param');

        if (!empty($params)) {//没有填写参数
            $param_array = explode('&',$params);

                foreach ($param_array as $item) {
                    $first_part_array = explode('=', $item);
                    $fp0 = $first_part_array[0];
                    $fp1 = $first_part_array[1];
                    if (empty($fp0) && empty($fp1)) {
                        //不带参数
                    } else if (empty($fp0) || empty($fp1)) {
                        //如果字段和值不对应,提示用户
                        return \Response::json([
                            'success' => false,
                            'errors' => array('param' => '参数名和默认值不能为空!'),
                        ]);
                    } else {
                        //合法
                    }
                }
        }


        /*=================返回内容校验=====================================*/


        $api = Api::findOrFail($id);
        $urlmethod = $url.'/'.$request->input('url').'&'.$request->input('method');
        if ($api->url_method != $urlmethod) {
            //判断url内容合法性
            $message = [
                'url_method.unique' => '请求地址重复,修改请求方式或地址',
            ];
            $rules = array(
                'url_method'=> [
                    'unique:apis,url_method',
                ],
            );
            $vdata = ['url_method'=>$url.'/'.$request->input('url').'&'.$request->input('method')];
            $validator = \Validator::make($vdata, $rules,$message);

            if ( $validator->fails() ) {
                return \Response::json([
                    'success' => false,
                    'errors' => $validator->getMessageBag()->toArray()
                ]);

            }
        }


        /*=================返回内容校验=====================================*/
        $back_params = $request->input('json');

        if (substr($back_params,-3) != "|||") {
            $back_param_array = explode('&', $back_params);

            foreach ($back_param_array as $item) {
                $first_part_array = explode('|', $item);
                $fp0 = $first_part_array[0];//类型
                $fp1 = $first_part_array[1];//参数名
                $fp2 = $first_part_array[2];//配置
                $fp3 = $first_part_array[3];//说明
                if (empty($fp1)) {
                    //如果字段和值不对应,提示用户
                    return \Response::json([
                        'success' => false,
                        'errors' => array('back_param' => '参数名不能为空!'),
                    ]);
                } else {
                    //合法
                }
            }
        }


        //全部校验完成,写数据库

        $project = Project::where('url',$url)->firstOrFail();
        $user = \Auth::user();

        $data = $request->except(['_token','key','icon']);

        $ndata = array_merge($data,['project_id'=>$project->id,'user_id'=>$user->id,'url_method'=>$url.'/'.$request->input('url').'&'.$request->input('method')]);


        $api->update($ndata);

        if ($api) {//创建完成后显示到详细页面
//            \Artisan::call('route:clear');//清理缓存
//            \Artisan::call('route:cache');//存储缓存

            //log
            $msg = "用户更新了一条动态API".' uid='.$user->id.' uname='.base64_decode($user->name).' pid='.$api->id.' url='.$api->url;
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
                'subject'=>'更新接口',
                'greeting'=>'请注意',
                'line1'=>base64_decode($user->name).' 更新了一个接口!',
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

            return \Response::json([
                'success' => true,
                'data' => '成功',
            ]);
        } else {
            return \Response::json([
                'success' => false,
                'errors' => array('server'=>'服务器异常,请联系管理员'),
            ]);
        }
    }



}
