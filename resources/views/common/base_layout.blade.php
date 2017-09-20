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
    <!-- Fav and touch icons -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/favicon.ico')}}"/>
    <!-- Le styles -->
    <link href="//cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    @yield('stylesheet')

   <!--[if lte IE 9]>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <script src="//cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
    <![endif]-->

</head>

<body style="background-color:transparent;margin: 0;padding: 0;">
@yield('content')
<!-- MAIN EFFECT -->
<script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@yield('javascript')
</body>

</html>