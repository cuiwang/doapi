@extends('common.base_console')
@section('title','Do API - 邀请加入产品')
@section('user_stylesheets')
    @parent
    <!--USER STYLESHEETS -->
    <link rel="stylesheet" href="{{asset('css/user_console.css')}}">
@endsection

@section('user_content')
    <div class="page-header">
        <div class="container">
            <h1>欢迎加入
                <small style="float: right;">{{$project->name}}</small>
            </h1>
        </div>
    </div>
    <div class="container">
        <div  style="display: flex;border: 1px solid #ccc; display: flex">
            {{--左边--}}
            <div  id="left" style="display: flex;flex: 5;padding: 20px;flex-direction: column;">
                <div style="flex: 3" class="row">
                    <div class="col-md-9" id="info1">
                        <div class="row" style="margin-top: 20px">
                            <div class="col-sm-3">
                                <img src="{{$project->iconimg}}" width="60px" height="60px" style="margin: 10px" alt="">
                            </div>
                            <div class="col-sm-9">
                                <h4 style="margin-bottom: 10px;margin-top: 10px">{{$project->name}}</h4>
                                <h5 style="color: #666;word-wrap:break-word">{{$project->description}}</h5>
                            </div>
                        </div>

                        <div class="row" style="margin-top: 15px;margin-left: 1px">
                           <a style="padding-top: 15px" target="_blank"
                                         href="{{url('i').'/'.$project->url.'/doc'}}">接口文档: {{url('i').'/'.$project->url.'/doc'}}</a>
                        </div>
                        <hr>

                    </div>
                    <div class="col-md-3" id="info2" style="display: flex;">
                            <div style="align-self: center;text-align: center;">
                                <img class="img-thumbnail" width="160px" height="160px"
                                     src="{{$project->qrcode}}">
                                <h5 style="color: #666">公众号</h5>
                            </div>
                    </div>
                </div>
                <div style="flex: 1;display: flex;flex-direction: column;justify-content: space-between">
                    <p>
                        <img width="40px" height="40px" alt="" class="admin-pic img-circle"
                             src="{{$founder->headimg}}">
                        <span style="color: #333;font-size: 1.0em">{{base64_decode($founder->name)}}(管理员)</span>
                    </p>
                    <h6 style="color: #999999;align-self: flex-end">默认服务器地址: {{url('i').'/'.$project->url}}</h6>
                </div>
            </div>
            {{--右边--}}
            <div class="col-md-6" id="right" style="border-left: 1px solid #ccc;flex: 8;padding: 20px">
                <div class="well">
                    <p class="text-muted h5">第一次使用帐号登录,您需要填写邮箱和密码,以后您也可以使用此邮箱和密码登录</p>
                    <p class="text-muted h5">如果您已有帐号,可以直接进行帐号绑定</p>
                </div>

                @if (!empty(session('error')))
                    <div class="alert alert-danger">
                        <ul>
                                <li>{{session('error')}}</li>
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{url('/i/'.$project->url.'/action_AcceptEmailInvitation')}}" style="margin-top: 20px">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <input readonly value="{{$email}}" name="email" style="width: 250px;height: 44px" type="email" class="form-control center-block"  placeholder="请输入邮箱">
                    </div>
                    <div class="form-group">
                        <input id="password"  name="password" style="width: 250px;height: 44px" type="password" class="form-control center-block focus"  placeholder="请输入密码">
                    </div>
                    <button type="submit" style="width: 150px" class="btn btn-info center-block">加入</button>
                </form>
            </div>

        </div>
    </div>
    </div>


@endsection

@section('user_footer')
    <footer class="footer navbar-fixed-bottom console_footer">
        <div class="container">
            <div class="text-center">
                <p>版权所有(C) 北京布衣科技有限公司 ICP证号：京ICP备14015023号-2</p>
            </div>
        </div>
    </footer>
@endsection

@section('user_script')
    @parent
    {{--layer--}}
    <script type="text/javascript" src="{{asset('/js/layer/layer.js')}}"></script>

    {{--/layer--}}
    {{--user--}}
    <script type="text/javascript">
        $('#info2').css("height",$('#info1').height())
        $('#center_line').css("height",$('#left').height())
        $('#password').focus();
    </script>
    {{--/user--}}
@endsection