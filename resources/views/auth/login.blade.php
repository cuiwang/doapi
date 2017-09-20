@extends('common.base_user')
@section('title','Do API - 登录')
@section('user_stylesheets')
@parent
        <!--USER STYLESHEETS -->
<link rel="stylesheet" href="{{asset('css/user_login.css?v=1')}}">
@endsection



@section('user_content')
    <section id="login">
        <div class="container">
            <div class="col-md-12 margin-bottom-30">
                <h1 id="login_title" class="margin-bottom-30">欢迎您的登录</h1>

                <div class="user-login-container user-login-form-1 margin-bottom-30">


                    <div class="col-md-4 text-center rd_login">
                        <a class="rd_login" href="{{url('auth/weibo')}}"><i class="fa fa-weibo login-with"></i></a>

                        <p>新浪微博</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <a class="rd_login"  href="{{url('auth/qq')}}"><i class="fa fa-qq login-with"></i></a>

                        <p>QQ</p>
                    </div>
                    <div class="col-md-4 text-center">
                        <a id="weixin_login" href="{{url('auth/weixin')}}"><i class="fa fa-weixin login-with"></i></a>

                        <p>微信</p>
                    </div>


                </div>


            </div>
            <div class="text-center">
                <a href="{{url('login_email')}}" class="user-create-new">邮箱登录</a> <a href="{{url('register')}}" class="user-create-new">或 注册一个新账户 <i class="fa fa-chevron-right"></i></a>
            </div>
        </div>
    </section>
@endsection

@section('user_script')
   @parent
   <script>

       $('.rd_login').on('click', function(){
           layer.msg('加载中..', {icon: 16,shade: 0.3,time: 25000});
       });

   </script>
@endsection