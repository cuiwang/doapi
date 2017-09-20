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
    @yield('user_stylesheets')
</head>

<body class="base-bg-gray" data-spy="scroll" data-target="#rock-navigation" style="background: url({{asset('/images/hero-bg.jpg')}}) no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover; background-attachment: fixed; padding: 0px 0; ">

<!-- START NAVIGATION -->
<div class="navbar navbar-default bs-dos-nav" role="navigation" style="background-color: rgba(255, 255, 255, 0.40)">
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
                <li><a href="{{url('/#')}}" class="smoothScroll">首页</a></li>
                <li><a href="{{url('/help')}}" target="_blank" class="smoothScroll">帮助</a></li>
                <li><a href="{{url('login')}}" class="smoothScroll">注册|登录</a></li>
            </ul>
        </nav>

    </div>
</div>
<!-- END NAVIGATION -->

@yield('user_content')

        <!-- 底部 -->
<footer class="footer navbar-fixed-bottom">
    <div class="container">
        <div class="text-center">
            <p>版权所有(C) 北京布衣科技有限公司 ICP证号：京ICP备14015023号-3</p>
        </div>
    </div>
</footer>

<!-- USER SCRIPT -->
@section('user_script')
    <script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    {{--    <script src="{{asset('js/jquery.js')}}"></script>--}}
    {{--    <script src="{{asset('js/bootstrap.min.js')}}"></script>--}}
    <script type="text/javascript" src="{{asset('/js/layer/layer.js')}}"></script>
@show
</body>
</html>