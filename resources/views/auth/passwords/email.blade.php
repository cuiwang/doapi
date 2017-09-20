@extends('common.base_user')
@section('title','Do API - 忘记密码')
@section('user_stylesheets')
@parent
        <!--USER STYLESHEETS -->
<link rel="stylesheet" href="{{asset('css/user_register.css')}}">
@endsection


@section('user_content')
    <section id="login">
        <div class="container">
            <div class="col-md-12">
                <h1 class="margin-bottom-30">忘记密码</h1>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form class="form-horizontal templatemo-container templatemo-login-form-1 margin-bottom-30" role="form" action="{{url('/password/email')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        <div class="col-xs-12">
                            <div class="control-wrapper">
                                <label for="email" class="control-label fa-label"><i class="fa fa-envelope-o"></i></label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="您注册时所用的邮箱">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="control-wrapper text-center">
                                <input style="width: 300px;background-color: #f3715c; border-color: #f3715c;" type="submit" value="密码重置" class="btn btn-info">
                            </div>
                        </div>
                    </div>

                </form>

            </div>

            <div class="text-center">
                  <a href="{{url('login')}}" class="user-create-new">立即登录 <i class="fa fa-chevron-right"></i></a>
            </div>
        </div>
    </section>
@endsection

@section('user_script')
    @parent
@endsection