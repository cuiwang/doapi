@extends('common.base_console')
@section('title','Do API - 用户中心')
@section('user_stylesheets')
@parent
        <!--USER STYLESHEETS -->
<link rel="stylesheet" href="{{asset('css/user_center.css')}}">
@endsection


@section('user_content')
    <div class="page-header">
        <div class="container">
            <h1>我的信息
                <small style="float: right;">
                    <ol class="breadcrumb" style="background-color: #ffffff;">
                        <li><a href="{{url('main/console')}}">控制台</a></li>
                        <li class="active">我的信息</li>
                    </ol>
                </small>
            </h1>
        </div>
    </div>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">基本信息</h3>
            </div>
            <div class="panel-body">
                {{--基本信息--}}
                <div class="col-md-6" style="border: 1px #EEEEEE;border-right-style: solid;">
                    <div class="row center-block" style="margin-bottom: 20px;">
                        <div class="col-md-2"><img id="myheadimg"  src="{{ $user->headimg }}" width="60px" height="60px"/></div>
                        <div class="col-md-4">
{{--                            <h4>{{ base64_decode($user->name) }}</h4>--}}
                            <h4 style="line-height: 50px">{{ $user->email }}</h4>
                        </div>
                    </div>
                    {!! Form::model($user, ['url' => 'main/userCenter/update', 'method' => 'post' ,'id' => 'infoForm']) !!}
                    <div id="dname" class="form-group">
                            <div class="control-wrapper">
                                {!! Form::label('name', '昵称', ['class' => 'control-label fa-label']) !!}
                                {!! Form::text('name', base64_decode($user->name), ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div id="dphone" class="form-group">
                            <div class="control-wrapper">
                                {!! Form::label('phone', '手机', ['class' => 'control-label fa-label']) !!}
                                {!! Form::text('phone', $user->phone, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div id="dcompany" class="form-group">
                            <div class="control-wrapper">
                                {!! Form::label('company', '公司', ['class' => 'control-label fa-label']) !!}
                                {!! Form::text('company', $user->company, ['class' => 'form-control']) !!}
                            </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="control-wrapper text-center">
                                {!! Form::submit('保存', ['class' => 'form-control' , 'id' =>'savebtn']) !!}
                            </div>
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
                {{--上传修剪头像--}}
                <div class="col-md-6">
                    <div class="col-md-7">
                        <div id="changeheadimg" class="text-center">
                            <form action="{{url('main/userCenter/changeHeadimg/')}}" enctype="multipart/form-data" method="post" class="reg-page sky-form" id="upload">
                                {{csrf_field()}}

                                <img class="img-thumbnail" src="{{$user->headimg}}" width="300" height="300" id="project-img" alt="">
                                <div class="text-center">
                            <span class="filebtn">
                                <input type="file" name="image" id="image">
                                <span id="upload-img">修改头像</span></span>

                                </div>
                            </form>
                        </div>

                    </div>
                    <div class="col-md-5">
                        <div class="row clearfix">
                            <p style="position:relative;left:38px;">
                                ● 支持jpg，png格式
                            </p>
                            <p style="position:relative;left:38px;">
                                ● 文件须小于2M
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="panel-heading" id="changePsd">
                <h3 class="panel-title">修改密码</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="margin-bottom-30">请尽快修改您的密码</h1>
                        <form class="form-horizontal templatemo-container templatemo-login-form-1 margin-bottom-30" role="form" method="POST" action="{{ url('main/userCenter/resetPassword') }}">
                            {{ csrf_field() }}
                            <div class="form-group {{ $errors->has('opassword') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <div class="control-wrapper">
                                        <label for="username" class="control-label fa-label"><i class="fa fa-key"></i></label>
                                        <input type="text" class="form-control" id="opassword" name="opassword" placeholder="请输入前密码" value="{{$opassword or old('opassword')}}">
                                        @if ($errors->has('opassword'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('opassword') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-md-12">
                                    <div class="control-wrapper">
                                        <label for="password" class="control-label fa-label"><i class="fa fa-key"></i></label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="请输入新密码,长度最少为6位" value="{{$password or old('password')}}">
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
                                        <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="请再次输入一次新密码" value="{{$password_confirmation or old('password_confirmation')}}">
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

                </div>

            </div>
        </div>
    </div>
@endsection

@section('user_footer')
    <footer class="footer  console_footer">
        <div class="container">
            <div class="text-center">
                <p>版权所有(C) 北京布衣科技有限公司 ICP证号：京ICP备14015023号-2</p>
            </div>
        </div>
    </footer>
@endsection

@section('user_script')
    @parent
    <script type="text/javascript" src="{{asset('js/jquery.form.js')}}"></script>
    <script>
        $(document).ready(function() {
            var options = {
                beforeSubmit:  showRequest,
                success:       showResponse,
                dataType: 'json'
            };
            $('#infoForm').ajaxForm(options);

        });
        function showRequest() {
//            $("#validation-errors").hide().empty();
//            $("#output").css('display','none');
            return true;
        }

        function showResponse(response)  {
            if(response.success == false)
            {
//                layer.msg('保存失败!',{icon: 5});

                var responseErrors = response.errors;
                $.each(responseErrors, function(index, value)
                {
                    if (value.length != 0)
                    {
                        if (index == 'name') {
                            $('#dname').attr('class','form-group has-error');
                            layer.tips(value, '#dname', {
                                tips: [1, '#d9534f'] //还可配置颜色
                            });
                        } else if (index == 'phone') {
                            $('#dphone').attr('class','form-group has-error');
                            layer.tips(value, '#dphone', {
                                tips: [1, '#d9534f'] //还可配置颜色
                            });
                        }else if (index == 'company') {
                            $('#dcompany').attr('class','form-group has-error');
                            layer.tips(value, '#dcompany', {
                                tips: [1, '#d9534f'] //还可配置颜色
                            });
                        }

                    }
                });
            } else {

//                layer.msg('保存成功!',{icon: 6});
                layer.tips('保存成功!', '#savebtn', {
                    tips: [1, '#5cb85c'] //还可配置颜色
                });
                $('#dname').attr('class','form-group has-success');
                $('#dphone').attr('class','form-group has-success');
                $('#dcompany').attr('class','form-group has-success');
                $('#name').attr('src',response.name);
                $('#phone').attr('src',response.phone);
                $('#company').attr('src',response.company);

            }
        }
    </script>
    <script>
        $(document).ready(function() {
            var options = {
                beforeSubmit:  showRequest,
                success:       showResponse,
                dataType: 'json'
            };
            $('#image').on('change', function(){
                $('#upload-img').html('正在上传...');
                $('#upload').ajaxForm(options).submit();
            });
        });
        function showRequest() {
//            $("#validation-errors").hide().empty();
//            $("#output").css('display','none');
            return true;
        }

        function showResponse(response)  {
            if(response.success == false)
            {
                var responseErrors = response.errors;
                $.each(responseErrors, function(index, value)
                {
                    if (value.length != 0)
                    {
                        layer.tips(value, '#changeheadimg', {
                            tips: [1, '#d9534f'] //还可配置颜色
                        });
                    }
                });
            } else {

                $('#project-img').attr('src',response.avatar);
                $('#myheadimg').attr('src',response.avatar);
                $('#common_head').attr('src',response.avatar);
                $('#upload-img').html('修改图标');
                layer.tips('修改成功!', '#changeheadimg', {
                    tips: [1, '#ff99cc33'] //还可配置颜色
                });

            }
        }
    </script>
    <script>
        @if($errors->has('opassword') || $errors->has('password') || $errors->has('password_confirmation'))
            window.location.hash="#changePsd"
        @endif
    </script>
@endsection