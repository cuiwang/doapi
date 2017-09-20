@extends('common.base_console')
@section('title','Do API - 新建产品')
@section('user_stylesheets')
@parent
        <!--USER STYLESHEETS -->
<link rel="stylesheet" href="{{asset('css/sky-forms.css')}}">
<link rel="stylesheet" href="{{asset('css/user_console_newapp.css')}}">

@endsection


@section('user_content')

    <div class="page-header">
        <div class="container">
            <h1>新建产品
                <small style="float: right;">添加新产品</small>
            </h1>
        </div>
    </div>
    <div class="container content">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <!--<div class="alert alert-warning" role="alert">
                    <p>注意：产品地址前缀固定不可编辑,可以在接口文档发布时,通过配置中心自定义修改。</p>
                </div>-->

                <form action="{{url('main/project/store')}}" class="reg-page sky-form" id="form" method="post"
                      enctype="multipart/form-data" novalidate="novalidate">
                    {{ csrf_field() }}

                    <section class="{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="nlabel"><i class="fa  fa-flag"></i> 产品名称</label>
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
                            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="请输入应用名称">
                        </label>
                    </section>

                    <section class="{{ $errors->has('url') ? ' has-error' : '' }}">
                        <label for="url" class="nlabel"><i class="fa fa-briefcase"></i> 私有地址 { 可快速访问接口文档 }</label>
                        @if ($errors->has('url'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                        @else
                            <span class="help-block">
                                        <h6 style="color: #999">字母,数字,下划线组合4-16位</h6>
                                    </span>
                        @endif
                        <label class="input">
                            <span class="icon-prepend"
                                  style="color:#666; width:180px; left:2px;top: 2px;height: 35px;line-height: 35px; background-color:#eee; font-weight:normal;">&nbsp;http://doapi.cn/</span>
                            <input type="text" id="url" name="url" value="{{ old('url') }}"
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
                                      name="description">{{ old('description') }}</textarea>
                        </label>
                    </section>

                    <hr>

                    <div class="row">
                        <div class="col-md-6 col-xs-6 text-left">
                        </div>
                        <div class="col-md-6 text-right">
                            <input type="hidden" name="key" id="key" value="">
                            <input type="hidden" name="icon" id="icon">
                            <button class="btn btn-default" type="submit" id="submitButton">添加产品</button>
                        </div>
                    </div>
                </form>
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
@endsection