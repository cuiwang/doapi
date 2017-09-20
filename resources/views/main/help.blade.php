@extends('common.base_layout')
@section('title','DO API - 帮助文档')
@section('stylesheet')
@section('stylesheet')
        <!-- Le styles -->
<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
{{--<link rel="stylesheet" href="{{asset('assets/css/loader-style.css')}}">--}}
<!--custom风格-->
<link rel="stylesheet" href="{{asset('css/docs.min.css')}}">
<style>
    li {
        margin-right: 10px;
    }
    .w4ul li {
        padding-top: 10px;
        padding-bottom: 10px;
        margin: 10px;
        line-height: 30px;
    }
</style>
@endsection
@section('content')


    <div style="background: url('{{asset('/images').'/hero-bg.jpg'}}')no-repeat center center fixed">

        <!-- Docs page layout -->
        <div class="bs-docs-header" id="content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <a href="{{url('/')}}"><img src="{{asset('images/favicon.ico')}}" width="116px" height="116px" alt=""/></a>
                    </div>
                    <div class="col-sm-10" style="min-height: 116px;">
                        <h1>DO API - 帮助文档</h1>
                        <small class="pull-right" style="color: #555">修订号 : v2.0.1</small>
                        <p>假数据 , 真接口 , 文档管理一把手</p>

                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="bs-docs-sidebar hidden-print hidden-xs hidden-sm" role="complementary">
                    <ul class="nav bs-docs-sidenav">

                        <li>
                            <a href="#overview">概览</a>
                        </li>
                        <li>
                            <a href="#apidetails">常见问题</a>
                            <ul class="nav">
                                <li><a href="#w1">1.静态接口和动态接口的区别?</a></li>
                                <li><a href="#w2">2.如何保护自己的接口文档不被别人查看?</a></li>
                                <li><a href="#w3">3.接口文档背景可以自定义修改吗?</a></li>
                                <li><a href="#w4">4.动态接口支持哪些标签?</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#lishi">更新历史</a>
                            <ul class="nav">
                                <li><a href="#20170203">2017-02-03 优化升级</a></li>
                                <li><a href="#20160928">2016-09-28 重要升级</a></li>
                                <li><a href="#20160815">2016-08-15 常规升级</a></li>
                            </ul>
                        </li>

                    </ul>
                    <a class="back-to-top" href="#top">
                        返回顶部
                    </a>

                </div>
            </div>
            <div class="col-md-10" role="main" style="padding-left: 120px;background: rgba(255, 255, 255, 0.75)">
                <div class="bs-docs-section">
                    <h1 id="overview" class="page-header">概览</h1>

                    <hr>
                    <h4 style="margin: 20px;color: #666;">- <a href="/">接口神器</a>是一个简单的网站 . 它存在的理由只有一个 -> 加速开发.</h4>
                    <ul>
                        <li><p>前后端分离,前端后端独立并行开发</p></li>
                        <li><p>实时生成API文档</p></li>
                        <li><p>增加单元测试的真实性,通过随机数据,模拟各种场景</p></li>
                    </ul>
                    <h4 style="margin: 20px;color: #666;">- <a href="/">接口神器</a>它还只是个孩子 . 它还有很大的成长空间.</h4>
                    <ul>
                        <li><p>接口交易市场</p></li>
                        <li><p>产品分发平台</p></li>
                        <li><p>...</p></li>
                    </ul>

                </div>
                {{--接口--}}
                <div class="bs-docs-section">
                    <h1 id="apidetails" class="page-header">常见问题</h1>
                    <hr>
                                <!-- BLANK PAGE-->
                    <div class="content-wrap">
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="" id="w1">
                                        <h4 style="color: #333;">1.静态接口和动态接口的区别?
                                        </h4>
                                    <div class="" id="Blank_Page_Content">
                                        <blockquote>
                                            <p>静态接口和动态接口都会按照用户的设置返回对应的数据,<br>静态接口返回的数据,是根据用户自己设置的JSON内容,<strong> 原样返回</strong>.
                                                动态接口返回的数据,会根据用户设置的返回类型,而<strong>动态生成数据</strong>.</p>
                                        </blockquote>
                                    </div>
                                </div>
                                <div class="" id="w2">
                                    <h4 style="color: #333;">2.如何保护自己的接口文档不被别人查看?
                                    </h4>
                                    <div class="" id="Blank_Page_Content">
                                        <blockquote>
                                            <p>在注意保护自己隐私的同时,可以在文档设置中,添加<strong>接口文档密码</strong>.
                                        </blockquote>
                                    </div>
                                </div>
                                <div class="" id="w3">
                                    <h4 style="color: #333;">3.接口文档背景可以自定义修改吗?
                                    </h4>
                                    <div class="" id="Blank_Page_Content">
                                        <blockquote>
                                            <p>目前版本只支持系统默认的几个背景,后期会增加自定义背景功能,请进QQ交流群 <strong>79479868</strong> 获取最新信息.
                                        </blockquote>
                                    </div>
                                </div>
                                <div class="" id="w4">
                                    <h4 style="color: #333;">4.动态接口支持哪些标签?
                                    </h4>
                                    <div class="" id="Blank_Page_Content">
                                        <blockquote>
                                            <p>动态接口支持下列标签,标签要求传入的参数都是 <strong>数字</strong> ,请不要传错!您可以按 <strong>CTRL+F</strong> 搜索查看具体细节,如果您有其他需求,请进QQ交流群 <strong>79479868</strong> 沟通.</p>
                                            <ul class="w4ul">
                                                <li><h4>标签: randomFloat(number,min,max)</h4>  随机浮点数,返回一个数字, 要求参数 3个,number代表多少位精度,min代表最小值,max代表最大值.</li>
                                                <li><h4>标签: numberBetween(min,max)</h4> 随机数字,返回一个数字, 要求参数 2个,min代表最小值,max代表最大值.</li>
                                                <li><h4>标签: longitude(min,max)</h4> 随机精度,返回一个数字, 要求参数 2个,min代表最小值,max代表最大值.</li>
                                                <li><h4>标签: latitude(min,max)</h4> 随机纬度,返回一个数字, 要求参数 2个,min代表最小值,max代表最大值.</li>
                                                <li><h4>标签: imageUrl(width,height)</h4> 随机图片url,返回一个字符串, 要求参数 2个,width代表宽度,height代表高度.</li>
                                                <li><h4>标签: randomNumber(number)</h4> 随机数字,返回一个数字, 要求参数 1个,number代表多少位数字.</li>
                                                <li><h4>标签: paragraphs(number)</h4> 随机多个段落,返回一个数组, 要求参数 1个,number代表数组内段落的个数.</li>
                                                <li><h4>标签: sentences(number)</h4> 随机多个句子,返回一个数组, 要求参数 1个,number代表数组内句子的个数.</li>
                                                <li><h4>标签: paragraph(number)</h4> 随机一个段落,返回一个字符串, 要求参数 1个,number代表字符串内段落的个数.</li>
                                                <li><h4>标签: sentence(number)</h4> 随机一个句子,返回一个字符串, 要求参数 1个,number代表字符串内句子的个数.</li>
                                                <li><h4>标签: text(max)</h4> 随机一段文字,返回一个字符串, 要求参数 1个,max代表最大多少个字符.</li>
                                                <li><h4>标签: realText(max)</h4> 随机一段真实文字, 要求参数 1个,返回一个字符串,max代表最大多少个字符.</li>
                                                <li><h4>标签: words(number)</h4> 随机多个单词,返回一个数组, 要求参数 1个,number代表数组内有多少个单词.</li>
                                                <li><h4>标签: randomDigit</h4> 随机一个数字0~9,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: randomDigitNotNull</h4> 随机一个数字1~9,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: randomLetter</h4> 随机一个字母,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: word</h4> 随机一个单词,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: name</h4> 随机一个姓名,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: state</h4> 随机一个省份,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: city</h4> 随机一个城市,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: streetName</h4> 随机一个街道,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: postcode</h4> 随机一个邮编,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: address</h4> 随机一个地址,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: country</h4> 随机一个国家,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: phoneNumber</h4> 随机一个电话号码,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: catchPhrase</h4> 随机一个广告语,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: company</h4> 随机一个公司名,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: date</h4> 随机一个日期 1999-11-11,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: time</h4> 随机一个时间 22:22:22,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: amPm</h4> 随机一个上下午,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: year</h4> 随机一个年份 1991,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: monthName</h4> 随机一个月份名称,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: month</h4> 随机一个月份,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: century</h4> 随机一个世纪,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: dayOfWeek</h4> 随机一个周中的一天,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: dayOfMonth</h4> 随机一个月中的一天,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: email</h4> 随机一个邮箱,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: userName</h4> 随机一个用户名,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: password</h4> 随机一个密码,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: domainName</h4> 随机一个域名,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: url</h4> 随机一个url地址,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: slug</h4> 随机一个口号,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: ipv4</h4> 随机一个ip地址,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: ipv6</h4> 随机一个ip6地址,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: macAddress</h4> 随机一个MAC地址,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: localIpv4</h4> 随机一个本地地址,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: hexcolor</h4> 随机一个hex格式的颜色,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: rgbcolor</h4> 随机一个rgb格式的颜色,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: colorName</h4> 随机一个颜色名称,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: uuid</h4> 随机一个uuid,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: boolean</h4> 随机一个布尔值,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: md5</h4> 随机一个md5码,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: sha1</h4> 随机一个sha1码,返回一个字符串, 不需要参数.</li>
                                                <li><h4>标签: sha256</h4> 随机一个sha256码,返回一个字符串, 不需要参数.</li>
                                            </ul>
                                        </blockquote>
                                    </div>
                                </div>

                            </div>
                            <!-- END OF BLANK PAGE -->

                        </div>

                        <!-- /END OF CONTENT -->


                    </div>


                </div>
                {{--更新历史--}}
                <div class="bs-docs-section">
                    <h1 id="lishi" class="page-header">更新历史</h1>
                    <hr>
                    <!-- BLANK PAGE-->
                    <div class="content-wrap">
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="" id="20170630">
                                    <h4 style="color: #333;">2017-06-30 体验优化
                                    </h4>
                                    <small>影响版本 : Beta 1.0.9</small>
                                    <div class="" id="Blank_Page_Content">
                                        <ul>
                                            <li><p>登录过的用户,再次打开不再显示首页,直接进入登录页面</p></li>
                                            <li><p>全站增加对https的支持</p></li>
                                        </ul>
                                    </div>
                                    <div class="pull-right"><small> 修订号 : {{env('APP_VERSION','2.0.1')}}</small></div>
                                </div>
                                <hr>
                                <div class="" id="20170203">
                                    <h4 style="color: #333;">2017-02-03 优化升级
                                    </h4>
                                    <small>影响版本 : Beta 1.0.9</small>
                                    <div class="" id="Blank_Page_Content">
                                        <ul>
                                            <li><p>优化第三方登录,保持在线状态</p></li>
                                            <li><p>优化文本信息内容</p></li>
                                        </ul>
                                    </div>
                                    <div class="pull-right"><small> 修订号 : {{env('APP_VERSION','2.0.1')}}</small></div>
                                </div>
                                <hr>
                                <div class="" id="20161026">
                                    <h4 style="color: #333;">2016-10-29 重要升级
                                    </h4>
                                    <small>影响版本 : v1.6</small>
                                    <div class="" id="Blank_Page_Content">
                                        <ul>
                                            <li><p>新增https服务</p></li>
                                            <li><p>新增QQ和微博登录</p></li>
                                        </ul>
                                    </div>
                                    <div class="pull-right"><small> 修订号 : v1.0.6</small></div>
                                </div>
                                <hr>
                                <div class="" id="20161026">
                                    <h4 style="color: #333;">2016-10-26 重要升级
                                    </h4>
                                    <small>影响版本 : v1.6</small>
                                    <div class="" id="Blank_Page_Content">
                                        <ul>
                                            <li><p>新增接口版本号</p></li>
                                            <li><p>创建接口,现在可以复制参数和返回值了</p></li>
                                            <li><p>程序稳定性修复</p></li>
                                        </ul>
                                    </div>
                                    <div class="pull-right"><small> 修订号 : v1.0.6</small></div>
                                </div>
                                <hr>
                                <div class="" id="20160928">
                                    <h4 style="color: #333;">2016-09-28 重要升级
                                    </h4>
                                    <small>影响版本 : v1.6</small>
                                    <div class="" id="Blank_Page_Content">
                                        <ul>
                                            <li><p>修复上传问题</p></li>
                                            <li><p>发布1.6内测版</p></li>
                                            <li><p>修复登录问题</p></li>
                                        </ul>
                                    </div>
                                    <div class="pull-right"><small> 修订号 : v1.0.6</small></div>
                                </div>
                                <hr>
                                <div class="" id="Blank_PageClose">
                                    <h4 style="color: #333;">2016-08-15 常规升级
                                    </h4>
                                    <small>影响版本 : v1.5</small>
                                    <div class="" id="Blank_Page_Content">
                                        <ul>
                                            <li><p>发布1.5内测版</p></li>
                                            <li><p>修复产品删除问题</p></li>
                                        </ul>
                                    </div>
                                    <div class="pull-right"><small> 修订号 : v1.0.5</small></div>
                                </div>


                            </div>
                            <!-- END OF BLANK PAGE -->

                        </div>

                        <!-- /END OF CONTENT -->


                    </div>


                </div>
                <!-- 底部 -->
                <footer class="footer pull-right" style="background: #fff;">
                    <div class="container">
                        <div class="text-center">
                            <p>版权所有(C) 北京布衣科技有限公司 ICP证号：京ICP备14015023号-2</p>
                        </div>
                    </div>
                </footer>
            </div>

        </div>

    </div>


    <!-- /END OF CONTENT -->
    @endsection
    @section('javascript')
    <script type="text/javascript" src="{{asset('assets/js/load.js')}}"></script>
    <!-- /MAIN EFFECT -->
    <script type="text/javascript" src="{{asset('js/docs.min.js')}}"></script>

@endsection