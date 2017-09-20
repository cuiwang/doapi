<?php

namespace App\Http\Controllers;

use App\Api;
use App\Doc;
use App\Project;
use App\Syslog;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class DocController extends Controller
{
    //

    /**
     * 展示文档锁屏
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lockscreen($url)
    {
        return view('api.doc.lockscreen',compact('url'));
    }

    /**
     * 展示带密码锁屏
     * @param Request $request
     * @param $url
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lockscreen_passwd(Request $request,$url)
    {
        $project = Project::where('url',$url)->firstOrFail();
        $doc = Doc::where('project_id',$project->id)->firstOrFail();

        $ipasswd = $request->input('password');
        if ($doc->doc_passwd!= $ipasswd) {
            \Session::flash('password', '密码错误,请重试 !');
            return back();
        }

        $apis = $project->apis->where('type','static');
        $dynamic_apis = $project->apis->where('type','dynamic');
        $apis_count = $project->apis->count();
        return view('api/doc/doc_details',compact('user','project','apis','dynamic_apis','apis_count','doc'));

    }

    /**iframe
     * 展示产品文档设置页面
     * @param $url
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function doc_set($url)
    {
        $user = Auth::user();
        $project = Project::where('url',$url)->firstOrFail();
        $doc = Doc::where('project_id',$project->id)->firstOrFail();
        $apis = $project->apis;
        $apis_count = $project->apis->count();

        return view('api/doc/doc',compact('user','project','apis','apis_count','doc'));
    }

    /**
     * 展示接口文档
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function doc_detail($url)
    {
        $user = \Auth::user();
        $project = Project::where('url',$url)->firstOrFail();
        $doc = Doc::where('project_id',$project->id)->firstOrFail();
        if ($doc->doc_status == 0) {
            $apis = $project->apis->where('type','static');
            $dynamic_apis = $project->apis->where('type','dynamic');
            $apis_count = $project->apis->count();
            return view('api/doc/doc_details',compact('user','project','apis','dynamic_apis','apis_count','doc'));
        } else {//显示锁屏密码
            return redirect()->action('DocController@lockscreen', ['url'=>$url]);
        }

    }


    /**
     * 修改文档权限
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(Request $request,$id)
    {

        $project = Doc::findOrFail($id);

        $project->doc_status = $request->input('status');
        $project->doc_passwd = $request->input('passwd');
        $project->save();


        //log
        $ouser= Auth::user();
        $msg = "用户修改产品文档权限".' uid='.$ouser->id.' uname='.base64_decode($ouser->name).' did='.$project->id.' pname='.$project->doc_title;
        Log::warning($msg);

        $log = new Syslog();
        $log->description = $msg;
        $log->type = '3';
        $log->level = 'warning';
        $log->project_id = $project->id;
        $log->user_id = $ouser->id;
        $log->save();
        //end log

        return \Response::json(
            [
                'status' => true,
            ]
        );

    }

    /**
     * 修改文档背景图片
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeBgimg(Request $request,$id)
    {

        $project = Doc::findOrFail($id);

        $project->doc_backgdimg = $request->input('backgdimg');
        $project->save();


        //log
        $ouser= Auth::user();
        $msg = "用户修改产品文档背景图片".' uid='.$ouser->id.' uname='.base64_decode($ouser->name).' did='.$project->id.' pname='.$project->doc_title;
        Log::warning($msg);

        $log = new Syslog();
        $log->description = $msg;
        $log->type = '3';
        $log->level = 'warning';
        $log->project_id = $project->id;
        $log->user_id = $ouser->id;
        $log->save();
        //end log

        return \Response::json(
            [
                'status' => true,
            ]
        );

    }


    /**
     * 修改文档标题
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeTitle(Request $request,$id)
    {

        $project = Doc::findOrFail($id);

        $project->doc_title = $request->input('title');
        $project->save();


        //log
        $ouser= Auth::user();
        $msg = "用户修改产品文档标题".' uid='.$ouser->id.' uname='.base64_decode($ouser->name).' did='.$project->id.' pname='.$project->doc_title;
        Log::warning($msg);

        $log = new Syslog();
        $log->description = $msg;
        $log->type = '3';
        $log->level = 'warning';
        $log->project_id = $project->id;
        $log->user_id = $ouser->id;
        $log->save();
        //end log

        return \Response::json(
            [
                'status' => true,
            ]
        );

    }

    /**修改文档版本号
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function versionChange(Request $request,$id)
    {

        $project = Doc::findOrFail($id);

        $project->doc_version = $request->input('version');
        $project->save();

        //log
        $ouser= Auth::user();
        $msg = "用户修改产品文档版本号".' uid='.$ouser->id.' uname='.base64_decode($ouser->name).' did='.$project->id.' pname='.$project->doc_title;
        Log::warning($msg);

        $log = new Syslog();
        $log->description = $msg;
        $log->type = '3';
        $log->level = 'warning';
        $log->project_id = $project->id;
        $log->user_id = $ouser->id;
        $log->save();
        //end log

        return \Response::json(
            [
                'status' => true,
            ]
        );

    }

    /**修改文档描述
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponsex
     */
    public function descriptionChange(Request $request,$id)
    {

        $project = Doc::findOrFail($id);

        $project->doc_description = $request->input('description');
        $project->save();

        //log
        $ouser= Auth::user();
        $msg = "用户修改产品文档描述".' uid='.$ouser->id.' uname='.base64_decode($ouser->name).' did='.$project->id.' pname='.$project->doc_title;
        Log::warning($msg);

        $log = new Syslog();
        $log->description = $msg;
        $log->type = '3';
        $log->level = 'warning';
        $log->project_id = $project->id;
        $log->user_id = $ouser->id;
        $log->save();
        //end log

        return \Response::json(
            [
                'status' => true,
            ]
        );

    }

    /**修改文档基地址
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function baseurlChange(Request $request,$id)
    {

        $project = Doc::findOrFail($id);

        $project->doc_baseurl = $request->input('baseurl');
        $project->save();

        //log
        $ouser= Auth::user();
        $msg = "用户修改产品文档基地址".' uid='.$ouser->id.' uname='.base64_decode($ouser->name).' did='.$project->id.' pname='.$project->doc_title;
        Log::warning($msg);

        $log = new Syslog();
        $log->description = $msg;
        $log->type = '3';
        $log->level = 'warning';
        $log->project_id = $project->id;
        $log->user_id = $ouser->id;
        $log->save();
        //end log

        return \Response::json(
            [
                'status' => true,
            ]
        );

    }


    /**
     * 下载doc
     * @param Request $request
     * @param $url
     */
    public function doc_download(Request $request,$url)
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $project = Project::where('url',$url)->firstOrFail();
        $doc = Doc::where('project_id',$project->id)->firstOrFail();

        $section = $phpWord->addSection();
        $section->addTitle($doc->doc_title?$doc->doc_title:$project->name.' - 接口文档');
        $section->addImage(asset($project->iconimg), array('width' => 120, 'height' => 120, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
        $section->addTextBreak(2);
        $section->addText($doc->doc_description?$doc->doc_description:' 本离线文档由 Do API 1.6内测版生成,您可以选择在线实时查看文档,并分享给其他小伙伴.');
        $section->addTextBreak(1);
        $section->addText('根地址 : ');
        $section->addText(mb_strlen($doc->doc_baseurl)>0?$doc->doc_baseurl:env('APP_URL'));
        $section->addTextBreak(4);
        $apis = $project->apis->where('type','static');
        $dynamic_apis = $project->apis->where('type','dynamic');
        $section->addText('静态接口');
        $i = 0;
        foreach ($apis as $api) {
            $i++;
            $section->addTextBreak(2);
            $section->addTitle($i.'. '.$api->description);
            if ($doc->doc_baseurl) {
                $section->addLink(
                    $doc->doc_baseurl.'/'.$api->url,
                    $api->url,
                    array('color' => '0000FF', 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE)
                );
            }
            else {
                $section->addLink(
                    env('APP_URL').'/test/'.$api->id.'_api/'.$api->url,
                    $api->url,
                    array('color' => '0000FF', 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE)
                );

            }
            $section->addTextBreak(1);
            $section->addText('请求方式 : '.$api->method);
            $section->addText('请求参数 : '.str_replace('&',' | ',$api->param));
            $section->addText('参数描述 : '.$api->param_description);
           /* $section->addText('返回内容 : ');
            $section->addText($api->json);*/
        }
        $section->addTextBreak(3);
        $section->addText('动态接口');
        $i = 0;
        foreach ($dynamic_apis as $api) {
            $i++;
            $section->addTextBreak(2);
            $section->addTitle($i.'. '.$api->description);
            if ($project->doc_baseurl) {
                $section->addLink(
                    $project->doc_baseurl.'/'.$api->url,
                    $api->url,
                    array('color' => '0000FF', 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE)
                );
            }
            else {
                $section->addLink(
                    env('APP_URL').'/test/'.$api->id.'_api/'.$api->url,
                    $api->url,
                    array('color' => '0000FF', 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE)
                );

            }
            $section->addTextBreak(1);
            $section->addText('请求方式 : '.$api->method);
            $section->addText('请求参数 : '.str_replace('&',' | ',$api->param));
            $section->addText('参数描述 : '.$api->param_description);
           /* $section->addText('返回内容 : ');
            $section->addText($api->json_data);*/
        }


        $path = 'uploads/'.$url.'.docx';
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($path);

        if(!$path) header("Location: /");
        $this->download($path);

        //log
        $ouser= Auth::user();
        $msg = "用户下载了产品文档".' uid='.$ouser->id.' uname='.base64_decode($ouser->name).' did='.$doc->id.' pname='.$doc->doc_title;
        Log::warning($msg);

        $log = new Syslog();
        $log->description = $msg;
        $log->type = '3';
        $log->level = 'warning';
        $log->project_id = $project->id;
        $log->user_id = $ouser->id;
        $log->save();
        //end log
    }

    function download($file_url,$new_name=''){
        if(!isset($file_url)||trim($file_url)==''){
            echo '500';
        }
        if(!file_exists($file_url)){ //检查文件是否存在
            echo '404';
        }
        $file_name=basename($file_url);
        $file_type=explode('.',$file_url);
        $file_type=$file_type[count($file_type)-1];
        $file_name=trim($new_name=='')?$file_name:urlencode($new_name);
        $file_type=fopen($file_url,'r'); //打开文件
        //输入文件标签
        header("Content-type: application/octet-stream");
        header("Accept-Ranges: bytes");
        header("Accept-Length: ".filesize($file_url));
        header("Content-Disposition: attachment; filename=".$file_name);
        //输出文件内容
        echo fread($file_type,filesize($file_url));
        fclose($file_type);
    }
}
