<!-- 头部 -->
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <!-- SITE TITLE -->
    <title>Do API - 管理中心</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="接口管理设计开发模拟,优化开发流程,提升开发效率,减少沟通成本,加速产品上线,让API文档管理更高效">
    <meta name="keywords" content="接口管理神器,接口设计神器,接口开发神器,接口模拟神器,api,接口,接口文档,文档管理,管理接口,设计接口,开发接口,模拟接口,开发效率">
    <meta name="renderer" content="webkit">
    <meta name="author" content="cuiwang">
    <meta name="robots" content="index,follow">
    <meta name="application-name" content="doapi.cn">
    <!-- Fav and touch icons -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}"/>
    <!-- Le styles -->
    <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{asset('assets/js/footable/css/footable.core.css?v=2-0-1')}}" rel="stylesheet" type="text/css">

    {{--<link rel="stylesheet" href="{{asset('/assets/css/bootstrap.css')}}">--}}
    <link rel="stylesheet" href="{{asset('/assets/css/base_main.css?v=3')}}">
    <link rel="stylesheet" href="{{asset('/assets/js/tip/tooltipster.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/js/skin-select/skin-select.css')}}">
    <!--[if lte IE 9]>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <script src="//cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
    <![endif]-->

</head>

<body style="background: url('{{isset($project->backgdimg)?asset('/assets/img/').'/'.'12.jpg':asset('/assets/img/').'/'.$project->backgdimg}}')no-repeat center center fixed;background-size:cover;">
<!-- TOP NAVBAR -->
<nav role="navigation" class="navbar navbar-static-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle"
                    type="button">
                <span class="fa fa-bars"></span>
            </button>
            <button class="navbar-toggle toggle-menu-mobile toggle-left" type="button">
                <span class="fa fa-car"></span>
            </button>

            <div id="logo-mobile" class="visible-xs">
                <h1>Do API<span>{{env('APP_VERSION','2.0.1')}}</span></h1>
            </div>

        </div>

        <!-- 产品列表 -->
        <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a data-toggle="dropdown" class="dropdown-toggle dropdown-menu-left" href="#">
                        <span class=" fa fa-chevron-down"></span>&#160;&#160;{{$project->name}}
                    </a>
                    <ul style="margin-top:14px;" role="menu" class="dropdown-wrap dropdown-menu">
                        @foreach ($projects as $pro)
                            <li>
                                <a href="{{url('i').'/'.$pro->url}}">
                                    <img width="25" height="25" style="margin-right: 10px" src="{{$pro->iconimg}}">{{$pro->name}}</a>
                            </li>

                        @endforeach

                    </ul>
                </li>

            </ul>
            {{--个人中心控制台/设置/退出b--}}
            <ul style="margin-right:0;" class="nav navbar-nav navbar-right">
                <li>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <img alt="" class="admin-pic img-circle"
                             src="{{$user->headimg}}">Hi, {{base64_decode($user->name)}} <b
                                class="caret"></b>
                    </a>
                    <ul style="margin-top:14px;" role="menu" class="dropdown-setting dropdown-menu">
                        <li>
                            <a href="{{url('/help')}}">
                                <span class="fa fa-lightbulb-o"></span>&#160;&#160;&#160帮助</a>
                        </li>
                        <li>
                            <a href="{{url('main/console')}}">
                                <span class="fa fa-desktop"></span>&#160;&#160;控制台</a>
                        </li>
                        <li>
                            <a href="{{url('main/userCenter')}}">
                                <span class="fa fa-male"></span>&#160;&#160;&#160;个人信息</a>
                        </li>


                        {{--<li>
                            <a href="#">
                                <span class="entypo-vcard"></span>&#160;&#160;设置</a>
                        </li>--}}
                       {{-- <li>
                            <a href="#">
                                <span class="entypo-lifebuoy"></span>&#160;&#160;帮助</a>
                        </li>--}}
                        <li class="divider"></li>
                        <li>
                            <a href="{{url('main/console')}}">
                                <span class="fa fa-circle-o-notch"></span>&#160;&#160;&#160;退出</a>
                        </li>
                    </ul>
                </li>
                <!--换肤-->
                <li>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="fa fa-gear"></span>&#160;&#160;换肤</a>
                    <ul role="menu" class="dropdown-setting dropdown-menu">

                        <li class="theme-bg">
                            <div id="button-bg1"></div>
                            <div id="button-bg2"></div>
                            <div id="button-bg3"></div>
                            <div id="button-bg4"></div>
                            <div id="button-bg5"></div>
                            <div id="button-bg6"></div>
                            <div id="button-bg7"></div>
                            <div id="button-bg8"></div>
                            <div id="button-bg9"></div>
                            <div id="button-bg10"></div>
                            <div id="button-bg11"></div>
                            <div id="button-bg12"></div>
                            {{--<div id="button-bg13"></div>--}}
                        </li>
                    </ul>
                </li>

            </ul>

        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<!-- /END OF TOP NAVBAR -->

<!-- 侧栏 -->
<div id="skin-select" style="margin-top: 10px;">
    <div id="logo">
        <h1>Do API<span style="margin-left: 5px;"> {{env('APP_VERSION')}} 内测 </span></h1>
    </div>

    <a id="toggle">
        <span class="fa fa-bars"></span>
    </a>
    {{--概览--}}
    <div style="margin-top: -18px">
        <ul class="topnav menu-left-nest">
            <li>
                <a class="tooltip-tip ajax-load" href="{{url('i').'/'.$url.'/info'}}" target="main" title="产品概览">
                    <i class="fa fa-dashboard"></i>
                    <span>产品概览</span>

                </a>
            </li>
        </ul>
    </div>
    {{--成员--}}
    <div>
        <ul class="topnav menu-left-nest">
            <li>
                <a class="tooltip-tip ajax-load" href="{{url('i').'/'.$url.'/'.'members'}}" target="main" title="产品成员">
                    <i class="fa fa-users"></i>
                    <span>产品成员</span>
                    <div class="noft-orange" id="member_count">{{$members_count}}</div>
                </a>
            </li>
        </ul>
    </div>
    @if($member->role == 'reader')
        @else
            <!--静态接口 不能动态生成数据 我的接口/新建接口/新建分类-->
            <div class="skin-part">
                <div id="tree-wrap-static">
                    <div class="side-bar">

                        <ul class="topnav menu-left-nest">
                            <li>
                                <a href="#" style="border-left:0px solid!important;" class="title-menu-left">

                                    <span class="static-menu"></span>
                                    {{-- <i data-toggle="tooltip" class="entypo-cog pull-right config-wrap"></i>--}}

                                </a>
                            </li>

                            <li>
                                <a class="tooltip-tip ajax-load" href="{{url('i').'/'.$url.'/'.'total'}}" target="main" title="静态接口列表">
                                    <i class="fa fa-file-o"></i>
                                    <span>静态接口</span>

                                    <div class="noft-blue" id="static_count">{{$apis_count}}</div>
                                </a>
                            </li>

                            <!--<li>
                                <a class="tooltip-tip" href="#" title="API调试">
                                    <i class="icon-document-new"></i>
                                    <span>API调试</span>
                                </a>
                                <ul>
                                    <li>
                                        <a class="tooltip-tip2 ajax-load" href="blank_page.html" title="Blank Page"><i class="icon-media-record"></i><span>Blank Page</span></a>
                                    </li>
                                </ul>
                            </li>-->

                            <li>
                                <a class="tooltip-tip " href="{{url('i'.'/'.$project->url.'/create')}}" target="main" title="创建静态接口">
                                    <i class="fa fa-pencil"></i>
                                    <span>创建静态接口</span>
                                </a>
                            </li>
                            {{--<li>
                                <a class="tooltip-tip " href="{{url('i/dogroup')}}" target="main" title="新建分类">
                                    <i class="icon icon-attachment"></i>
                                    <span>新建分类</span>
                                </a>
                            </li>--}}

                        </ul>

                    </div>
                </div>
            </div>
            <!--动态接口 dynamic 不能动态生成数据 我的接口/新建接口/新建分类-->
            <div class="skin-part">
                <div id="tree-wrap-static">
                    <div class="side-bar">

                        <ul class="topnav menu-left-nest">
                            <li>
                                <a href="#" style="border-left:0px solid!important;" class="title-menu-left">

                                    <span class="dynamic-menu"></span>
                                    {{-- <i data-toggle="tooltip" class="entypo-cog pull-right config-wrap"></i>--}}

                                </a>
                            </li>

                            <li>
                                <a class="tooltip-tip ajax-load" href="{{url('i').'/'.$url.'/'.'dynamic_total'}}" target="main" title="动态接口列表">
                                    <i class="fa fa-file-text"></i>
                                    <span>动态接口</span>
                                    <div class="noft-blue" id="dynamic_count">{{$dynamic_apis_count}}</div>
                                </a>
                            </li>

                            <!--<li>
                                <a class="tooltip-tip" href="#" title="API调试">
                                    <i class="icon-document-new"></i>
                                    <span>API调试</span>
                                </a>
                                <ul>
                                    <li>
                                        <a class="tooltip-tip2 ajax-load" href="blank_page.html" title="Blank Page"><i class="icon-media-record"></i><span>Blank Page</span></a>
                                    </li>
                                </ul>
                            </li>-->

                            <li>
                                <a class="tooltip-tip " href="{{url('i'.'/'.$project->url.'/dynamic_create')}}" target="main" title="创建动态接口">
                                    <i class="fa fa-magic"></i>
                                    <span>创建动态接口</span>
                                </a>
                            </li>
                            {{--<li>
                                <a class="tooltip-tip " href="{{url('i/dogroup')}}" target="main" title="新建分类">
                                    <i class="icon icon-attachment"></i>
                                    <span>新建分类</span>
                                </a>
                            </li>--}}

                        </ul>

                    </div>
                </div>
            </div>
        @endif

    <!--文档-->
    <div>
        <ul class="topnav menu-left-nest">
            <li>
                {{--<a class="tooltip-tip" href="{{url('i').'/'.$project->url.'/doc'}}" target="_blank" title="接口文档">--}}
                <a class="tooltip-tip" href="{{url('i/').'/'.$project->url.'/doc_set'}}" target="main" title="接口文档">
                    <i class="fa fa-edit"></i>
                    <span>接口文档</span>

                </a>
            </li>
        </ul>
    </div>
    <!--数据模型-->
    <div>
        <ul class="topnav menu-left-nest">
            <li>
                <a class="tooltip-tip ajax-load" href="#" title="数据模型">
                    <i class="fa fa-maxcdn"></i>
                    <span>数据模型</span>

                </a>
                <ul>
                    <li>
                        <a class="tooltip-tip2 ajax-load" href="#" title="Android"><i class="fa fa-android"></i> <span>Android 模型</span></a>
                    </li>
                    <li>
                        <a class="tooltip-tip2 ajax-load" href="#" title="iOS"><i class="fa fa-apple"></i>
                            <span>iOS 模型</span></a>
                    </li>
                    <li>
                        <a class="tooltip-tip2 ajax-load" href="#" title="JAVA"><i class="fa fa-coffee"></i><span>JAVA 模型</span></a>
                    </li>
                    <li>
                        <a class="tooltip-tip2 ajax-load" href="#" title="PHP"><i
                                    class="fa fa-rouble"></i><span>PHP 模型</span></a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
    @if ($user->position == 'root')
    <!--日志-->
    <div>
        <ul class="topnav menu-left-nest">
            <li>
                {{--<a class="tooltip-tip" href="{{url('i').'/'.$project->url.'/doc'}}" target="_blank" title="接口文档">--}}
                <a class="tooltip-tip" href="{{url('/logs')}}" target="main" title="日志">
                    <i class="fa fa-calendar"></i>
                    <span>日志</span>

                </a>
            </li>
        </ul>
    </div>
        @else
        <div>
            <ul class="topnav menu-left-nest">
                <li>
                    {{--<a class="tooltip-tip" href="{{url('i').'/'.$project->url.'/doc'}}" target="_blank" title="接口文档">--}}
                    <a class="tooltip-tip" href="{{url('i/project/'.$project->id.'/logs')}}" target="main" title="日志">
                        <i class="fa fa-calendar"></i>
                        <span>日志</span>

                    </a>
                </li>
            </ul>
        </div>
    @endif
    <!--帮助-->
    <div>
        <ul class="topnav menu-left-nest">
            <li>
                {{--<a class="tooltip-tip" href="{{url('i').'/'.$project->url.'/doc'}}" target="_blank" title="接口文档">--}}
                <a class="tooltip-tip" href="{{url('/help')}}" target="_blank" title="帮助文档">
                    <i class="fa fa-lightbulb-o"></i>
                    <span>帮助文档</span>

                </a>
            </li>
        </ul>
    </div>
</div>
<!-- END OF SIDE MENU -->

<!-- 内容 ifrme 开始 -->
<div class="wrap-fluid" id="content">
    <div class="container-fluid">

        {{--内容页面--}}
        <div id="leamain">
                <div class="container-fluid paper-wrap">
            <iframe src="{{url('i').'/'.$url.'/'.'info'}}" marginheight="0" marginwidth="0" frameborder="0" scrolling="no"
                    width="100%" height=600px id="iframepage" name="main" allowTransparency="true"
                   onload="initIframeHeight(600)"></iframe>
                    <script>

                        /**
                         * iframe自适应高度，height为手动设置的最小高度
                         */
                        function initIframeHeight(height){
                            var userAgent = navigator.userAgent;
                            var iframe = parent.document.getElementById("iframepage");
                            var subdoc = iframe.contentDocument || iframe.contentWindow.document;
                            var subbody = subdoc.body;
                            var realHeight;
                            //谷歌浏览器特殊处理
                            if(userAgent.indexOf("Chrome") > -1){
                                realHeight = subdoc.documentElement.scrollHeight;
                            }
                            else{
                                realHeight = subbody.scrollHeight;
                            }
                            if(realHeight < height){
                                $(iframe).height(height);
                            }
                            else{
                                $(iframe).height(realHeight);
                            }
                        }

                    </script>
                </div>
        </div>

    </div>
</div>
<!-- /END OF CONTENT -->
<!-- FOOTER -->
<div class="footer-space"></div>
<div id="footer">
    <div class="devider-footer-left"></div>
    <div class="time">
        <p id="spanDate">

        <p id="clock">
    </div>
    <div class="copyright">
        版权所有(C) 北京布衣科技有限公司 ICP证号：京ICP备14015023号-3
    </div>
    {{-- <div class="devider-footer"></div> 分割线--}}

</div>
<!-- / END OF FOOTER -->
</div>
</div>
<!--  END OF PAPER WRAP -->

<!-- MAIN EFFECT -->
{{--<script type="text/javascript" src="{{asset('/assets/js/jquery.js')}}"></script>--}}
{{--<script type="text/javascript" src="{{asset('/assets/js/bootstrap.js')}}"></script>--}}
<script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{asset('/assets/js/load.js?v=1')}}"></script>
<script type="text/javascript" src="{{asset('/assets/js/base_main.js?v=1')}}"></script>
<script type="text/javascript" src="{{asset('/assets/js/app.js?v=1')}}"></script>

<!-- /MAIN EFFECT -->
<script>
    function changeBg(obj) {
{{--        var img = '{{url('/assets/img').'/'.obj?obj:''}}';--}}
        $.ajax({
            url: '{{url('i/project/changeBGimg/'.$project->id)}}',
            type: 'post',
            data: {
                'backbgimg' : obj,
                '_token': '{{csrf_token()}}',
            },
            success: function(data){
//                alert(data.success);
            },
            error: function(xhr, type){
//                alert('Ajax error!');
            }
        });
    }
    function changeNumFromIframe(pid,add) {
        var num = document.getElementById(pid).innerHTML;
        if (add == 'add') {
            document.getElementById(pid).innerHTML = Number(num)+1;
        }else {
            document.getElementById(pid).innerHTML = Number(num)-1;
        }
    }

    function goPage(page) {
        window.location.href=page;
    }
</script>
</body>

</html>