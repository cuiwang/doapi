@extends('common.base_user')
@section('title','Do API - 注册')
@section('user_stylesheets')
@parent
        <!--USER STYLESHEETS -->
<link rel="stylesheet" href="{{asset('css/user_register.css?v=1')}}">
@endsection


@section('user_content')
    <section id="login">
        <div class="container">
            <div class="col-md-12">
                <h1 class="margin-bottom-30">欢迎您的注册</h1>
                <form class="form-horizontal templatemo-container templatemo-login-form-1 margin-bottom-30" role="form" action="{{ url('/register') }}" method="post">
                    {{ csrf_field() }}
                    <input style="visibility: hidden" type="checkbox" name="remember" checked="checked" >
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="control-wrapper">
                                <label for="username" class="control-label fa-label"><i class="fa fa-navicon"></i></label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="怎么称呼您?">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="control-wrapper">
                                <label for="email" class="control-label fa-label"><i class="fa fa-envelope-o"></i></label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="您常用的邮箱地址">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <div class="control-wrapper">
                                <label for="password" class="control-label fa-label"><i class="fa fa-key"></i></label>
                                <input id="password" type="password" class="form-control" name="password" placeholder="设置您的密码">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <div class="control-wrapper">
                                <label for="password-confirm" class="control-label fa-label"><i class="fa fa-key"></i></label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="再次填写一次密码">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="control-wrapper text-center">
                                <input style="width: 300px;background-color: #ec7063;color: white"   type="submit" value="注册" class="btn btn-default">
                            </div>
                        </div>
                    </div>
                </form>

            </div>

            <div class="text-center">
                <a href="{{url('login_email')}}" class="user-create-new">已有帐号,立即登录 <i class="fa fa-chevron-right"></i></a>
            </div>
        </div>
    </section>
@endsection

@section('user_script')
    @parent
    <script >
        $('#register_btn').on('click', function(){
            // business logic...
            layer.msg('召唤洪荒之力加速注册..', {icon: 16,time: 25000});
        });
    </script>

@endsection