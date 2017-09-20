<!-- 头部 -->
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <!-- SITE TITLE -->
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="优化开发流程,提升开发效率,减少沟通成本,加速产品上线,让接口文档管理更高效">
    <meta name="keywords" content="接口管理神器,接口设计神器,接口开发神器,接口模拟神器,api,接口,接口文档,文档管理,管理接口,设计接口,开发接口,模拟接口,开发效率">
    <meta name="renderer" content="webkit">
    <meta name="author" content="cuiwang">
    <meta name="robots" content="index,follow">
    <meta name="application-name" content="doapi.cn">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}"/>
    <!--COMMON STYLESHEETS -->
    <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">

    <!--[if lte IE 9]>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <script src="//cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
    <![endif]-->
    {{--<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">--}}
    @yield('user_stylesheets')
</head>

<body class="base-bg-gray" data-spy="scroll" data-target="#rock-navigation">

<!-- START NAVIGATION -->
<div class="navbar navbar-default bs-dos-nav" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target="#rock-navigation">
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
            </button>
            <div>
                <a href="#" class="navbar-brand" style="float: none;">Do - API</a>

                <p style="color: #666666; font-size: 15px;">假数据 , 真接口 , 文档管理一把手</p>
            </div>
        </div>
        <nav class="collapse navbar-collapse" id="rock-navigation">
            <ul class="nav navbar-nav navbar-right main-navigation text-uppercase">
                {{--<li><a href="#">文档</a></li>--}}
               {{-- <li><a href="{{url('main/console')}}">控制台</a></li>--}}
                <li><a href="{{url('/help')}}">帮助</a></li>
                <li><a id="tucao" onmouseover="showTip()" target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=8e6f65cce6f12efaff7f5f39667b0b704fec751a829a262f04ec96768172b7fc">吐槽</a></li>
                @if (empty($user))

                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img id="common_head" src="{{$user->headimg}}" width="40px" height="40px" alt=""/>  <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('main/userCenter')}}">我的信息</a></li>
                            <li><a href="{{url('main/console/create')}}">新建应用</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ url('/logout') }}">退出</a></li>
                        </ul>
                    </li>
            @endif

            </ul>
        </nav>

    </div>
</div>
<!-- END NAVIGATION -->

        <!-- 内容 -->
@yield('user_content')
        <!-- 底部 -->
@yield('user_footer')

<!-- USER SCRIPT -->
@section('user_script')
    <script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    {{--    <script src="{{asset('js/jquery.js')}}"></script>--}}
{{--    <script src="{{asset('js/bootstrap.min.js')}}"></script>--}}
    <script type="text/javascript" src="{{asset('/js/layer/layer.js')}}"></script>
    <script>
        function showTip() {
            layer.tips('浏览器可能屏蔽一键加群,请手动添加群号:79479868', '#tucao', {
                tips: [4, '#78BA32']
            });
        }
    </script>
@show
</body>
</html>