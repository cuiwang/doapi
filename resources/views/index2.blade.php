<!-- 头部 -->
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <!-- SITE TITLE -->
    <title>Do API - 接口神器</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="接口管理设计开发模拟,优化开发流程,提升开发效率,减少沟通成本,加速产品上线,让API文档管理更高效">
    <meta name="keywords" content="接口管理神器,接口设计神器,接口开发神器,接口模拟神器,api,接口,接口文档,文档管理,管理接口,设计接口,开发接口,模拟接口,开发效率">
    <meta property="wb:webmaster" content="db2e139bcab18189" />
    <meta name="msvalidate.01" content="991DAE427EC09D98D2BF86FAD9AE80B9" />
    <meta name="baidu-site-verification" content="ZyavMJarcj" />
    {{--<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />--}}
    <meta name="renderer" content="webkit">
    <meta name="author" content="cuiwang">
    <meta name="robots" content="index,follow">
    <meta name="application-name" content="doapi.cn">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}"/>
    <!--COMMON STYLESHEETS -->
    <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    {{--    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">--}}
    <link href="//cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
{{--    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">--}}
    <!--USER STYLESHEETS -->
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/user_index.css?v=2017')}}">
    <!--[if lte IE 9]>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <script src="//cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
    <![endif]-->
</head>

<body data-spy="scroll" data-target="#rock-navigation">
<!-- START NAVIGATION -->
<div class="navbar navbar-default bs-dos-nav navbar-fixed-top sticky-navigation" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" data-toggle="collapse" data-target="#rock-navigation">
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
                <span class="icon icon-bar"></span>
            </button>
            <div>
                <a href="#" class="navbar-brand" style="float: none;">Do - API</a>
                <p id="title_description">假数据 , 真接口 , 文档管理一把手</p>
            </div>
        </div>
        <nav class="collapse navbar-collapse" id="rock-navigation">
            <ul class="nav navbar-nav navbar-right main-navigation text-uppercase">
                <li><a href="#home" class="smoothScroll">首页</a></li>
                <li><a href="#work" class="smoothScroll">我们在做</a></li>
                <li><a href="{{url('login')}}" class="smoothScroll">注册|登录</a></li>
            </ul>
        </nav>

    </div>
</div>
<!-- END NAVIGATION -->

<!-- START HOME -->
<section id="home" class="user_index_home">

    <div class="container" style="margin-top: -200px;">

        <video autoplay loop id="bgvid" poster="{{asset('images/polina.png')}}"
               style=" background: url('{{asset('images/polina.png')}}') no-repeat;">
            <source src="{{asset('images/Home.mp4')}}">
            <!--[if LT IE 9]>
            <object type="application/x-shockwave-flash" data="{{asset('images/Home.mp4')}}"
                    width="100%" height="770">
                <param name="movie" value="{{asset('images/Home.mp4')}}">
                <param name="allowFullScreen" value="true">
                <param name="wmode" value="transparent">
                <param name="flashVars"
                       value="autoplay=true&controls=false&loop=true&poster={{asset('images/polina.png')}}&src={{asset('images/Home.mp4')}}">
            </object>
            <![endif]-->
        </video>

        <div class="row">
            <div class="col-md-1 col-sm-1"></div>
            <div class="col-md-10 col-sm-10">
                <h1 class="tm-home-title visible-lg-block visible-md-block" id="tm-home-title"><strong> 接 口 神 器 </strong><small style="color: #ffffff;font-size: 14px;">&nbsp;&nbsp; {{env('APP_VERSION','2.0.1')}}</small></h1>
                <h2 class="tm-home-subtitle visible-lg-block visible-md-block" id="tm-home-subtitle"><i class="fa fa-terminal"></i> : wget http://doapi.cn/</h2>

                <h4 style="font-weight:normal;" class="sm1 visible-lg-block visible-md-block" id="sm1">&nbsp;&nbsp;<a class="sm1_a" target="_blank" href="{{url('help')}}">接口假数据</a> ▪ <a class="sm1_a" target="_blank" href="{{url('help')}}">自助接口文档</a> ▪ <a class="sm1_a" target="_blank" href="{{url('help')}}">模拟线上环境</a> ▪ <a class="sm1_a" target="_blank" href="{{url('help')}}">更多隐藏功能..</a></h4>
                <a href="{{url('login')}}" class="btn btn-default smoothScroll tm-view-more-btn kaishi" id="kaishi">开 始 使 用</a>
            </div>
            <div class="col-md-1 col-sm-1"></div>
        </div>

    </div>

</section>
<!-- END HOME -->

<!-- START work -->
<section id="work" class="tm-padding-top-bottom-100">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-11">
                <h2 class="title">我们 <strong>在做</strong></h2>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="work-wrapper">
                    <i class="fa fa-exchange"></i>

                    <h3 class="text-uppercase tm-work-h3">接口假数据</h3>
                    <hr>
                    <p>用户可以自定义字段、返回数据、请求方式等.用户可以模拟出和真实后台接口一致的效果,最终程序员只需要统一修改服务器地址,就能完成和后台的实际数据对接.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="work-wrapper">
                    <i class="fa fa-suitcase"></i>

                    <h3 class="text-uppercase tm-work-h3">自助接口文档</h3>
                    <hr>
                    <p>用户可以随时随地查阅在线接口文档,前后台都可以按照接口文档上的内容,进行分离甚至异地开发,前后台不再需要经常调试接口.减少了沟通成本,加快了开发进度.</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="work-wrapper">
                    <i class="fa fa-stethoscope"></i>

                    <h3 class="text-uppercase tm-work-h3">模拟线上环境</h3>
                    <hr>
                    <p>自动生成请求地址,接口只有前缀和您的真实环境不一样,其他部分和您的环境保持一样,用户可自由修改请求方式,GET,POST,PUT等,和您的真实环境保持一致.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END work -->
{{--播放声音
<audio controls style="height: 0px;width: 0px;display: none" autoplay="autoplay">
    <source src="{{asset('others/click.mp3')}}" type="audio/mpeg">
    <embed height="0" width="0" src="{{asset('others/click.mp3>')}}">
</audio>--}}
<!-- USER SCRIPT -->
{{--<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>--}}
<script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

{{--<script src="{{asset('js/jquery.js')}}"></script>--}}
{{--<script src="{{asset('js/bootstrap.min.js')}}"></script>--}}
<script src="{{asset('js/jquery.nav.js')}}"></script>
<script src="{{asset('js/imagesloaded.min.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
{{--<script src="{{asset('js/smoothscroll.js')}}"></script>--}}

<!-- 底部 -->
<footer class="footer">
    <div class="container">
        <div class="text-center">
            <p>版权所有(C) 北京布衣科技有限公司 ICP证号：京ICP备14015023号-3</p>
        </div>
    </div>
</footer>
</body>
</html>