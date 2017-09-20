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
  <link href="//cdn.bootcss.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('css/index_flexslider.css')}}">
  <link rel="stylesheet" href="{{asset('css/index_styles.css?v=2')}}">
  <link rel="stylesheet" href="{{asset('css/index_queries.css')}}">
  <link rel="stylesheet" href="{{asset('css/index_animate.css')}}">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lte IE 9]>
  <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
  <script src="//cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
  <![endif]-->
      </head>
      <body id="top">
        <header id="home">
          <nav>
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-8 col-xs-offset-2">
                  <nav class="pull">
                    <ul class="top-nav">
                      <li><a href="#intro">简介 <span class="indicator"><i class="fa fa-angle-right"></i></span></a></li>
                      <li><a href="#features">功能 <span class="indicator"><i class="fa fa-angle-right"></i></span></a></li>
                      <li><a href="#portfolio">产品 <span class="indicator"><i class="fa fa-angle-right"></i></span></a></li>
                    </ul>
                  </nav>
                </div>
              </div>
            </div>
          </nav>
          <section class="hero" id="hero">
            <div class="container">
              <div class="row">
                <div class="col-md-12 text-right navicon">
                  <a id="nav-toggle" class="nav_slide_button" href="#"><span></span></a>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center inner">
                  <h1 class="animated fadeInDown">API<span>管理神器</span></h1>
                  <p class="animated fadeInUp delay-05s"><i class="fa fa-terminal"></i> : wget https://doapi.cn/ <small>v2.0.1</small></p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                  <a href="{{url('login')}}" class="learn-more-btn">LET'S <b style="border-bottom: 1px solid #fff">DO</b> IT</a>
                </div>
              </div>
            </div>
          </section>
        </header>
        <section class="intro text-center section-padding" id="intro">
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-md-offset-2 wp1">
                <h1 class="arrow">一个接口管理平台</h1>
                <p>线上编辑接口,输出美化接口文档,支持密码访问.接口仿真,模拟真实线上环境,真实支撑敏捷开发,加速产品上线,加快产品迭代,简单高效处理接口方面的内容,前端后端并行开发,提高开发效率.实时的生成API文档,方便开发人员阅读,增加单元测试的真实性,通过随机数据,模拟各种场景.</p>
              </div>
            </div>
          </div>
        </section>
       
        <section class="features text-center section-padding" id="features">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <h1 class="arrow">能做,但不只能做</h1>
                <div class="features-wrapper">
                  <div class="col-md-4 wp2">
                    <div class="icon">
                      <i class="fa fa-laptop shadow"></i>
                    </div>
                    <h2>接口文档</h2>
                    <p>随时随地查阅在线接口文档,支持文档加密.前后台都可以按照接口文档上的内容,进行分离甚至异地开发,前后台不再需要经常调试接口.减少了沟通成本,加快了开发进度.</p>

                  </div>
                  <div class="col-md-4 wp2 delay-05s">
                    <div class="icon">
                      <i class="fa fa-code shadow"></i>
                    </div>
                    <h2>接口编辑</h2>
                    <p>用户可以自定义字段、返回数据、请求方式等.用户可以模拟出和真实后台接口一致的效果,最终程序员只需要统一修改服务器地址,就能完成和后台的实际数据对接.</p>
                  </div>
                  <div class="col-md-4 wp2 delay-1s">
                    <div class="icon">
                      <i class="fa fa-heart shadow"></i>
                    </div>
                    <h2>仿真环境</h2>
                    <p>自动生成请求地址,接口只有前缀和您的真实环境不一样,其他部分和您的环境保持一样,用户可自由修改请求方式,GET,POST,PUT等,和您的真实环境保持一致.</p>
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
            </div>
          </div>
        </section>
       
        <section class="swag text-center">
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-md-offset-2">
                <h1>平台部署超过200个产品<span>持续增加中...</span></h1>
                <a href="#portfolio" class="down-arrow-btn"><i class="fa fa-chevron-down"></i></a>
              </div>
            </div>
          </div>
        </section>
        <section class="portfolio text-center section-padding" id="portfolio">
          <div class="container">
            <div class="row">
              <div id="portfolioSlider">
                <ul class="slides">
                  <li>
                    <div class="col-md-4 wp4">
                      <div class="overlay-effect effects clearfix">
                        <div class="img">
                          <img src="/images/1.jpg" alt="Portfolio Item">
                          <div class="overlay">
                            <a href="#" class="expand"><i class="fa fa-search"></i><br>View More</a>
                            <a class="close-overlay hidden">x</a>
                          </div>
                        </div>
                      </div>
                      <h2>保持传统</h2>
                      <p>使用传统HTTP请求响应模式,自定义返回json内容,快速实现接口功能.分角色管理后台,绑定不同权限.</p>
                    </div>
                    <div class="col-md-4 wp4 delay-05s">
                      <div class="overlay-effect effects clearfix">
                        <div class="img">
                          <img src="/images/2.jpg" alt="Portfolio Item">
                          <div class="overlay">
                            <a href="#" class="expand"><i class="fa fa-search"></i><br>View More</a>
                            <a class="close-overlay hidden">x</a>
                          </div>
                        </div>
                      </div>
                      <h2>动态通知</h2>
                      <p>接口的变动会通过邮件提醒产品干系人,让开发人员不再错过消息.高度自由的接口编辑,方便快捷的接口查找.</p>
                    </div>
                    <div class="col-md-4 wp4 delay-1s">
                      <div class="overlay-effect effects clearfix">
                        <div class="img">
                          <img src="/images/3.jpg" alt="Portfolio Item">
                          <div class="overlay">
                            <a href="#" class="expand"><i class="fa fa-search"></i><br>View More</a>
                            <a class="close-overlay hidden">x</a>
                          </div>
                        </div>
                      </div>
                      <h2>不断前进</h2>
                      <p>您的支持是我们开发的动力,为了更好的体验,接口神器会持续迭代更新.</p>
                    </div>
                  </li>
                  <li>
                    <div class="col-md-4 wp4">
                      <div class="overlay-effect effects clearfix">
                        <div class="img">
                          <img src="/images/4.jpg" alt="Portfolio Item">
                          <div class="overlay">
                            <a href="#" class="expand"><i class="fa fa-search"></i><br>View More</a>
                            <a class="close-overlay hidden">x</a>
                          </div>
                        </div>
                      </div>
                      <h2>干净极简</h2>
                      <p>摈弃复杂,还原干净,让开发流程更加干净透明,简洁而不简单,一切以用户体验至上.</p>
                    </div>
                    <div class="col-md-4 wp4 delay-05s">
                      <div class="overlay-effect effects clearfix">
                        <div class="img">
                          <img src="/images/5.jpg" alt="Portfolio Item">
                          <div class="overlay">
                            <a href="#" class="expand"><i class="fa fa-search"></i><br>View More</a>
                            <a class="close-overlay hidden">x</a>
                          </div>
                        </div>
                      </div>
                      <h2>冲破阻碍</h2>
                      <p>挑战传统开发模式,前后台并行高效开发,省去中间等待环节,让产品快速实现最小可行性.</p>
                    </div>
                    <div class="col-md-4 wp4 delay-1s">
                      <div class="overlay-effect effects clearfix">
                        <div class="img">
                          <img src="/images/6.jpg" alt="Portfolio Item">
                          <div class="overlay">
                            <a href="#" class="expand"><i class="fa fa-search"></i><br>View More</a>
                            <a class="close-overlay hidden">x</a>
                          </div>
                        </div>
                      </div>
                      <h2>开发生态</h2>
                      <p>建立开发生态,自动生成原型图,自动生成接口文档,自动生成数据实体模型,让开发更高效.</p>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </section>
        <footer>
          <div class="container">
            <div class="row">
              <div class="col-md-12 credit">
                <p>版权所有(C) 北京布衣科技有限公司 ICP证号：京ICP备14015023号-3</p>
              </div>
            </div>
          </div>
        </footer>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <!-- USER SCRIPT -->
        {{--<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>--}}
        <script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{asset('js/jquery.flexslider.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/modernizr.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/index_scripts.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/waypoints.min.js')}}" type="text/javascript"></script>
      </body>
    </html>