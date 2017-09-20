@extends('common.base_layout')
@section('title','Do API - 产品概览')
@section('stylesheet')
    <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    {{--    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">--}}
    <link rel="stylesheet" href="{{asset('assets/css/api_total.css')}}">
    {{--    <link rel="stylesheet" href="{{asset('assets/css/loader-style.css')}}">--}}

    <!--表格风格-->
    <link href="{{asset('assets/js/footable/css/footable.core.css?v=2-0-1')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/js/footable/css/footable.standalone.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/js/footable/css/footable-demos.css')}}" rel="stylesheet" type="text/css">

    {{--进度--}}
{{--    <link rel='stylesheet' href='{{asset('/assets/js/nprogress/nprogress.css')}}'/>--}}


    <!--应用统计-->
    <link rel="stylesheet" href="{{asset('assets/css/extra-pages.css')}}">
    <!--switch-->
    <link href="{{asset('assets/js/switch/bootstrap-switch.css')}}" rel="stylesheet">
@endsection
@section('content')

    <div class="wrap-fluid">
        <!-- 导航条-->
        {{--<ul id="breadcrumb" style="margin-top: 20px">
            <li>
                <span class="entypo-home"></span>
            </li>
            <li><i class="fa fa-lg fa-angle-right"></i>
            </li>
            <li><a href="#" title="Sample page 1">概览</a>
            </li>
        </ul>--}}
        <!-- 导航条结束-->

        <!--基本信息-->
        <div class="content-wrap">
            <div class="row">

                <div class="col-sm-12">
                    <!-- CONTENT PAGE-->

                    <div class="nest" id="CONTENT_PageClose">
                        <div class="title-alt">
                            <h6>
                                基本信息</h6>

                            <div class="titleClose">
                                <a class="gone" href="#CONTENT_PageClose">
                                    <span class="entypo-cancel"></span>
                                </a>
                            </div>
                            <div class="titleToggle">
                                <a class="nav-toggle-alt" href="#CONTENT_Page_Content">
                                    <span class="entypo-up-open"></span>
                                </a>
                            </div>

                        </div>
                        <div class="body-nest" id="CONTENT_Page_Content">
                            <div class="row" style="margin-top: 1px;margin-left: 1px;margin-bottom: 25px">
                                <span class="label label-default">C</span>
                                <span class="label label-default">Objective-C</span>
                                <span class="label label-default">Swift</span>
                                <span class="label label-default">Java</span>
                                <span class="label label-default">C#</span>
                                <span class="label label-default">JavaScript</span>
                                <span class="label label-default">PHP</span>
                                <span class="label label-default">Python</span>
                                <span class="label label-default">Shell</span>
                            </div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <img src="{{$project->iconimg}}" width="116px" height="116px" alt=""/>
                                    </div>
                                    <div class="col-sm-10" style="min-height: 116px;">
                                        <h3 style="margin-bottom: 20px;margin-top: 0px">{{$project->name}}</h3>
                                        <h4 style="color: #666;">{{$project->description}}</h4>
                                    </div>
                                </div>
                                {{-- <ul class="list-inline" style="height: 116px;">
                                     <li>
                                         <img src="{{$project->iconimg}}" width="116px" height="116px" alt=""/>
                                     </li>
                                     <li>
                                         <h2>{{$project->name}}</h2>
                                         <h4>{{$project->description}}</h4>
                                     </li>

                                 </ul>--}}


                                <!--<div style="margin-top: 20px;">
                                    <ul class="list-inline">
                                        <li>
                                            <h4>接口文档: <a style="color: #949494;" href="">http://www.do-api.com/mryys/weixin/doc</a></h4>
                                        </li>
                                        <li style="padding-left: 30px;">
                                            <h4>对所有人可见:</h4>

                                        </li>
                                        <li>
                                            <div style="margin-top: -6px;" class="make-switch switch-small" data-on="info" data-off="default" data-on-label="是" data-off-label="否">
                                                <input type="checkbox" checked="">
                                            </div>
                                        </li>

                                    </ul>

                                </div>-->

                                <div class="row" style="margin-top: 15px;margin-left: 1px">
                                    <h4>接口文档: <a style="color: #666666;padding-top: 15px" target="_blank"
                                                 href="{{url('i').'/'.$project->url.'/doc'}}">{{url('i').'/'.$project->url.'/doc'}}</a>
                                        {{-- <ul class="list-inline">
                                             <li>
                                                 <h5>接口数量: {{$apis_count}}</h5>
                                             </li>
                                             --}}{{--<li>
                                                 <h5>分组数量: 8</h5>
                                             </li>--}}{{--

                                         </ul>--}}

                                    </h4>
                                </div>
                                <hr>
                                <h5 style="color: #999999">默认服务器地址: {{url('i').'/'.$project->url}}</h5>

                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div style="margin-top: -15px;text-align: center">
                                <div>
                                    <img class="img-thumbnail" width="160px" height="160px" src="{{$project->qrcode}}">
                                    <h5 style="color: #666">微信公众号</h5>
                                </div>

                                {{--<div align="center" style="margin-bottom: 25px;">
                                    <div class="make-switch" data-on="info" data-off="warning" data-on-label="启动"
                                         data-off-label="停止">
                                        <input type="checkbox" checked="">
                                    </div>
                                </div>--}}
                            </div>
                        </div>
                        <div style="clear:both;"></div>

                    </div>
                    <!--<button class="btn btn-info pull-right">Read More</button>-->
                </div>
            </div>
            <!-- END OF CONTENT PAGE -->
        </div>
        <!--基本信息结束-->

        <!--接口信息-->
        <div class="content-wrap">
            <div class="row">

                <div class="col-sm-12">

                    <div class="nest" id="FootableClose">
                        <div class="title-alt">
                            <h6>
                                接口信息</h6>

                            <div class="titleClose">
                                <a class="gone" href="#FootableClose">
                                    <span class="entypo-cancel"></span>
                                </a>
                            </div>
                            <div class="titleToggle">
                                <a class="nav-toggle-alt" href="#Footable">
                                    <span class="entypo-up-open"></span>
                                </a>
                            </div>

                        </div>

                        <div class="body-nest" id="Footable">

                            <p class="lead well">接口数量: <strong>{{$apis_count}}</strong> 个,点击接口地址前面的<stong> ► 灰色三角形</stong>,查看具体地址,点击后可以测试接口内容!
                            </p>

                            <table class="table-striped footable-res footable metro-blue  toggle-arrow-small" data-page-size="10">
                                <thead>
                                <tr>
                                    <th data-toggle="true">
                                        接口地址
                                    </th>
                                    <th data-hide="all">
                                        点击测试接口地址
                                    </th>
                                    <th>
                                        版本号
                                    </th>
                                    <th data-sort-ignore="true">
                                        说明
                                    </th>
                                    <th data-sort-ignore="true">
                                        接口状态
                                    </th>
                                    <th>
                                        请求方式
                                    </th>
                                    <!--<th>
                                        接口类型
                                    </th>-->


                                    <th>
                                        接口类型
                                    </th>
                                    <th data-sort-initial="descending">
                                        最后修改时间
                                    </th>
                                    {{-- <th>
                                         操作
                                     </th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($apis as $api)
                                    <tr>
                                        <td>
                                            {{mb_strlen($api->url)>40?mb_substr($api->url,0,40).'...':$api->url}}
                                        </td>
                                        <td>
                                            <a style="font-size: 14px;color: #333"
                                               @if (($api->param == "=") || empty($api->param))
                                               href="{{url('test').'/'.$api->id.'_api/'.$api->url}}"
                                               target="_blank">{{url('test').'/'.$api->id.'_api/'.$api->url}}
                                                @else
                                                    href="{{url('test').'/'.$api->id.'_api/'.$api->url.'?'.$api->param}}"
                                                    target="_blank">{{url('test').'/'.$api->id.'_api/'.$api->url.'?'.$api->param}}
                                                @endif
                                            </a>
                                        </td>
                                        <td>
                                            {{$api->version}}
                                        </td>
                                        <td>
                                            <!--<span class="status-metro status-active" title="Active">Active</span>-->
                                            {{mb_strlen($api->description)>25?mb_substr($api->description,0,25).'...':$api->description}}
                                        </td>
                                        @if ($api->status == 200)
                                            <td><label class="label label-success"
                                                       onclick="changeStatus(this,'{{$api->id}}',200)">200</label>
                                                <label class="label label-default"
                                                       onclick="changeStatus(this,'{{$api->id}}',500)">500</label>
                                                <label class="label label-default"
                                                       onclick="changeStatus(this,'{{$api->id}}',503)">503</label></td>
                                        @elseif ($api->status == 500)
                                            <td><label class="label label-default"
                                                       onclick="changeStatus(this,'{{$api->id}}',200)">200</label>
                                                <label class="label label-success"
                                                       onclick="changeStatus(this,'{{$api->id}}',500)">500</label>
                                                <label class="label label-default"
                                                       onclick="changeStatus(this,'{{$api->id}}',503)">503</label></td>
                                        @else
                                            <td><label class="label label-default"
                                                       onclick="changeStatus(this,'{{$api->id}}',200)">200</label>
                                                <label class="label label-default"
                                                       onclick="changeStatus(this,'{{$api->id}}',500)">500</label>
                                                <label class="label label-success"
                                                       onclick="changeStatus(this,'{{$api->id}}',503)">503</label></td>
                                        @endif
                                        <td><span>{{$api->method}}</span></td>
                                        <!--<td><span class="status-metro status-disabled" >STATIC</span></td>-->

                                        <td>{{$api->type=='static'?'静态接口':'动态接口'}}</td>
                                        <td><h6>{{$api->updated_at}}</h6>{{$api->updated_at->diffForHumans()}}</td>

                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <div class="pagination pagination-centered"></div>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>

                        </div>

                    </div>

                </div>

            </div>
        </div>
        <!--接口信息结束-->

        <!--应用统计-->
        <div class="content-wrap">
            <div class="row">
                <div class="col-sm-12">
                    <div class="nest" id="yinyongtongjiClose">
                        <div class="title-alt">
                            <h6>
                                应用统计</h6>

                            <div class="titleClose">
                                <a class="gone" href="#yinyongtongjiClose">
                                    <span class="entypo-cancel"></span>
                                </a>
                            </div>
                            <div class="titleToggle">
                                <a class="nav-toggle-alt" href="#yinyongtongji">
                                    <span class="entypo-up-open"></span>
                                </a>
                            </div>

                        </div>
                        <div class="body-nest" id="yinyongtongji">
                            <p class="lead well">普通用户有使用次数的限制,VIP用户可以不受次数限制,内测阶段将不受限制.</p>

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="plan">
                                        <p class="plan-recommended">API调用次数</p>

                                        <h3 class="plan-title">当前使用</h3>

                                        <p class="plan-price">0
                                            <span class="plan-unit">次</span>
                                        </p>
                                        <ul class="plan-features">
                                            <li class="plan-feature text-center">30000<span
                                                        class="plan-feature-name">次/月</span>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                                <!--api调用次数-->
                                <div class="col-sm-3">
                                    <div class="plan">
                                        <p class="plan-recommended">文档查看次数</p>

                                        <h3 class="plan-title">当前使用</h3>

                                        <p class="plan-price">0
                                            <span class="plan-unit">次</span>
                                        </p>
                                        <ul class="plan-features">
                                            <li class="plan-feature text-center">30000<span
                                                        class="plan-feature-name">次/月</span>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                                <!--文档查看次数-->
                                <div class="col-sm-3">
                                    <div class="plan">
                                        <p class="plan-recommended">数据储存</p>

                                        <h3 class="plan-title">当前使用</h3>

                                        <p class="plan-price">0
                                            <span class="plan-unit">m</span>
                                        </p>
                                        <ul class="plan-features">
                                            <li class="plan-feature text-center">1000<span
                                                        class="plan-feature-name">m/月</span>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                                <!--数据存储-->
                                <div class="col-sm-3">
                                    <div class="plan">
                                        <p class="plan-recommended">文件存储</p>

                                        <h3 class="plan-title">当前使用</h3>

                                        <p class="plan-price">0
                                            <span class="plan-unit">m</span>
                                        </p>
                                        <ul class="plan-features">
                                            <li class="plan-feature text-center">3000<span
                                                        class="plan-feature-name">m/月</span>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                                <!--文件存储-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--应用统计结束-->
    </div>
    @endsection


    @section('javascript')
            <!-- MAIN EFFECT -->
    <script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    {{--<script type="text/javascript" src="{{asset('assets/js/jquery.js')}}"></script>--}}
    {{--    <script type="text/javascript" src="{{asset('assets/js/bootstrap.js')}}"></script>--}}
    <script type="text/javascript" src="{{asset('assets/js/load.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/info_main.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/switch/bootstrap-switch.js')}}"></script>

    <!-- /MAIN EFFECT -->
    <!-- GAGE -->
    <script type="text/javascript" src="{{asset('assets/js/toggle_close.js')}}"></script>

    <script src="{{asset('assets/js/footable/js/footable.js?v=2-0-1')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/footable/js/footable.paginate.js?v=2-0-1')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/footable/js/footable.sort.js?v=2-0-1')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/footable/js/footable.filter.js?v=2-0-1')}}" type="text/javascript"></script>
            {{--<script type="text/javascript" src='{{asset('/assets/js/nprogress/nprogress.js')}}'></script>--}}



            {{--进度条--}}
            {{--<script>--}}
                {{--$(function() {--}}
                    {{--NProgress.start();--}}
                    {{--$(window).load(function () {--}}
                        {{--NProgress.done();--}}
                    {{--})--}}
                {{--});--}}
            {{--</script>--}}
            {{--表格--}}
    <script type="text/javascript">
        $(function () {
            $('.footable-res').footable();
        });
    </script>
@endsection