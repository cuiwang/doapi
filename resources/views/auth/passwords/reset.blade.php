@extends('common.base_user')
@section('title','Do API - 修改密码')
@section('user_stylesheets')
@parent
        <!--USER STYLESHEETS -->
<link rel="stylesheet" href="{{asset('css/user_register.css')}}">
@endsection


@section('user_content')
    <section id="login">
        <div class="container">
            <div class="col-md-12">
                <h1 class="margin-bottom-30">请尽快修改您的密码</h1>
                <form class="form-horizontal templatemo-container templatemo-login-form-1 margin-bottom-30" role="form" method="POST" action="{{ url('/password/reset') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="control-wrapper">
                                <label for="username" class="control-label fa-label"><i class="fa fa-envelope-o"></i></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $email or old('email') }}">
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
                                <input type="password" class="form-control" id="password" name="password" placeholder="请输入新密码,长度最少为6位">
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
                                <label for="password" class="control-label fa-label"><i class="fa fa-key"></i></label>
                                <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="请再次输入一次新密码">
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
                                <input style="width: 300px;background-color: #f3715c; border-color: #f3715c;" type="submit" value="确定" class="btn btn-info">
                            </div>
                        </div>
                    </div>
                </form>

            </div>

            <div class="text-center">
                <a href="{{url('user/login_email')}}" class="user-create-new">已有帐号,立即登录 <i class="fa fa-chevron-right"></i></a>
            </div>
        </div>
    </section>
@endsection

@section('user_script')
    @parent
@endsection