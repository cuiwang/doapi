@extends('common.base_console')
@section('title','Do API - 修改产品')
@section('user_stylesheets')
@parent
        <!--USER STYLESHEETS -->
<link href="{{asset('assets/js/iCheck/flat/all.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/sky-forms.css')}}">
<link rel="stylesheet" href="{{asset('css/user_console_newapp.css')}}">

@endsection


@section('user_content')

    <div class="page-header">
        <div class="container">
            <h1>修改产品
                <small style="float: right;">修改产品</small>
            </h1>
        </div>
    </div>
    <div class="container content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <!--<div class="alert alert-warning" role="alert">
                    <p>注意：产品地址前缀固定不可编辑,可以在接口文档发布时,通过配置中心自定义修改。</p>
                </div>-->

                {{--修改图标--}}
                <div class="text-center">
                    <a class="btn btn-default" href="{{url('main/console')}}" style="position: absolute;right: 45px;top: 20px">返回</a>
                    <form action="{{url('main/changeicon/'.$project->id)}}" enctype="multipart/form-data" method="post" class="reg-page sky-form" id="upload">
                        {{csrf_field()}}
                        <img class="img-thumbnail" src="{{$project->iconimg}}" width="120" id="project-img" alt="">
                        <div class="text-center">
                            <span class="filebtn">
                                <input type="file" name="image" id="image">
                                <span id="upload-img">修改图标</span></span>

                    </div>
                    </form>
                </div>

                {{--修改基本信息--}}
                {!! Form::model($project, ['url' => ['main/project/edit', $project->id], 'method' => 'PATCH' , 'class' => 'reg-page sky-form']) !!}
                <section class="{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="nlabel"><i class="fa fa-flag"></i> 产品名称</label>
                    @if ($errors->has('name'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @else
                        <span class="help-block">
                                        <h6 style="color: #999">名称最长16位</h6>
                                    </span>
                    @endif
                    <label class="input">
                        <i class="icon-append fa fa-pencil"></i>
                        <input type="text" id="name" name="name" value="{{$project->name}}" placeholder="请输入应用名称">
                    </label>
                </section>

                <section class="{{ $errors->has('url') ? ' has-error' : '' }}">
                    <label for="url" class="nlabel"><i class="fa fa-briefcase"></i> 产品地址 </label>
                    @if ($errors->has('url'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                    @else
                        <span class="help-block">
                                        <h6 style="color: #999">不可修改</h6>
                                    </span>
                    @endif
                    <label class="input">
                            <span class="icon-prepend"
                                  style="color:#666; width:180px; left:2px;top: 2px;height: 35px;line-height: 35px; background-color:#eee; font-weight:normal;">&nbsp;http://doapi.cn/</span>
                        <input disabled type="text" id="url" name="url" value="{{ $project->url }}"
                               placeholder="请输入页面地址后缀">
                    </label>
                </section>

                <section class="{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="nlabel"><i class="fa fa-bookmark"></i> 产品说明</label>
                    @if ($errors->has('description'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                    @else
                        <span class="help-block">
                                        <h6 style="color: #999">简单说明下内容,最多255位</h6>
                                    </span>
                    @endif
                    <label class="textarea textarea-resizable">
                            <textarea rows="6" placeholder="请输入产品说明" id="description"
                                      name="description">{{ $project->description }}</textarea>
                    </label>
                </section>

                <hr>

                <div class="row">
                    <div class="col-md-6 col-xs-6 text-left">
                    </div>
                    <div class="col-md-6 text-right">
                        <input type="hidden" name="key" id="key" value="">
                        <input type="hidden" name="icon" id="icon">
                        <button class="btn btn-default" type="submit" id="submitButton">修改产品</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('user_footer')
    <footer class="footer console_footer">
        <div class="container">
            <div class="text-center">
                <p>版权所有(C) 北京布衣科技有限公司 ICP证号：京ICP备14015023号-2</p>
            </div>
        </div>
    </footer>
@endsection

@section('user_script')
    @parent
    <script type="text/javascript" src="{{asset('assets/js/iCheck/jquery.icheck.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.form.js')}}"></script>
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
                        layer.tips(value, '#changeimg', {
                            tips: [1, '#d9534f'] //还可配置颜色
                        });
                    }
                });
            } else {

                $('#project-img').attr('src',response.avatar);
                $('#upload-img').html('修改图标');

                layer.tips('修改成功!', '#changeimg', {
                    tips: [1, '#99cc33'] //还可配置颜色
                });
            }
        }
    </script>
@endsection