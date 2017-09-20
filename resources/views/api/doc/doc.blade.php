@extends('common.base_layout')
@section('title','Do API - 接口文档')
@section('stylesheet')
    <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    {{--<link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{asset('assets/css/doc.css')}}">--}}
    <link rel="stylesheet" href="{{asset('assets/css/style.css?v=1')}}">

    {{--	<link rel="stylesheet" href="{{asset('assets/css/loader-style.css')}}">--}}

    <!--custom风格-->
    <link href="{{asset('assets/js/switch/bootstrap-switch.css')}}" rel="stylesheet">
    <link href="{{asset('assets/js/iCheck/flat/all.css')}}" rel="stylesheet">

@endsection
@section('content')
    <!--  PAPER WRAP -->
    <div class="wrap-fluid">
        <!-- CONTENT -->
        <!-- BREADCRUMB -->
        <ul id="breadcrumb" hidden style="margin-top: 20px">
            <li>
                <span class="entypo-home"></span>
            </li>
            <li><i class="fa fa-lg fa-angle-right"></i>
            </li>
            <li><a href="#" title="Sample page 1">接口文档</a>
            </li>
        </ul>

        <!-- END OF BREADCRUMB -->
        <!--基本信息-->
        <div class="content-wrap">
            <div class="row">

                <div class="col-sm-12">
                    <!-- CONTENT PAGE-->

                    <div class="nest" id="CONTENT_PageClose">
                        <div class="title-alt">
                            <h6>
                                文档配置</h6>

                            <div class="titleClose">
                                <a class="gone" href="#CONTENT_PageClose">
                                    <span class="entypo-cancel"></span>
                                </a>
                            </div>
                            <div class="titleToggle">
                                <a class="nav-toggle-alt" href="#CONTENT_Page_Content">
                                    <span class="entypo-up-open"></span>
                                </a>
                            </div>

                        </div>

                        <div class="body-nest" id="CONTENT_Page_Content">
                            <div class="col-sm-10">
                                <!--接口文档-->
                                <ul class="list-inline">
                                    <li>
                                        <img src="{{$project->iconimg}}" width="80px" height="80px" alt=""/>
                                    </li>
                                    <li>
                                        <h2>{{$project->name}}</h2>
                                    </li>
                                    <li style="margin-top: 10px">
                                        <h5>{{$project->description}}</h5>
                                    </li>

                                </ul>
                                <iframe id="idframe" src="" style="display: none;"></iframe>
                                <ul class="list-inline" style="margin-top: 20px;">
                                    <li>
                                        <h4>文档地址:</h4>
                                    </li>
                                    <li>
                                        <h4><a style="color: #949494;" target="_blank"
                                               href="{{url('i').'/'.$project->url.'/doc'}}">{{url('i').'/'.$project->url.'/doc'}}</a>
                                        </h4>
                                    </li>
                                    <li>
                                        <button id="download" class="btn" onclick="doc_download()">点击下载</button>
                                    </li>

                                </ul>
                                <!--访问权限-->
                                <hr>
                                <div class="skin-flat" style="margin-top: 30px;">
                                    <table>
                                        <tr>
                                            <td>
                                                <h4>访问权限:</h4>
                                            </td>
                                            <td style="padding-left: 11px;">
                                                <input tabindex="1" type="radio" id="radio-1"
                                                       name="radio-checkbox" {{ $project->status=='0' ? 'checked' : '' }} >
                                            </td>
                                            <td style="padding-left: 5px;padding-top: 5px;">
                                                <label for="radio-1">全部可见</label>
                                            </td>
                                            <td style="padding-left: 12px;">&ensp;|&ensp;</td>
                                            <td style="padding-left: 12px;">
                                                <input tabindex="2" type="radio" id="radio-2"
                                                       name="radio-checkbox" {{ $project->status=='1' ? 'checked' : '' }}>
                                            </td>
                                            <td style="padding-left: 5px;padding-top: 5px;">
                                                <label for="radio-2">需要密码</label>
                                            </td>
                                            <td style="padding-left: 5px;">
                                                <input type="text" placeholder="Password" id="passwd"
                                                       value="{{$doc->passwd}}"
                                                       class="form-control" {{ $project->status=='1' ? '' : 'disabled=disabled' }}>
                                            </td>
                                            <td style="padding-left: 5px;">
                                                <button class="btn btn-info" id="passwd_btn">确认</button>
                                            </td>

                                        </tr>
                                    </table>

                                </div>
                                <div style="clear:both; margin-bottom: 10px;"></div>

                            </div>
                            <div class="col-sm-2">
                                <div class="pull-right" style="padding-top: 15px;">
                                    <img src="{{$project->qrcode}}"/>
                                    <h6 class="text-center">微信公众号</h6>
                                </div>
                            </div>
                            {{--修改标题等--}}
                            <div class="col-sm-12">
                                <hr/>
                                <!--pdf生成-->
                                <div>
                                    <label class="label label-default" style="margin-bottom: 20px;">自定义</label>

                                    <!--文档标题-->
                                    <ul class="list-inline">
                                        <li style="width: 150px;">
                                            <h4>标题:</h4>
                                        </li>
                                        <li>
                                            <input style="width: 300px;" type="" name="" id="title"
                                                   value="{{$doc->doc_title}}" placeholder="显示在接口文档标题部分"/>
                                        </li>
                                        <li>
                                            <button class="btn btn-info" type="submit" onclick="titleChange()">确认
                                            </button>
                                        </li>

                                    </ul>
                                    <!--文档标题结束-->
                                    <!--文档版本号-->
                                    <ul class="list-inline">
                                        <li style="width: 150px;">
                                            <h4>版本号:</h4>
                                        </li>
                                        <li>
                                            <input style="width: 300px;" type="" name="" id="version"
                                                   value="{{$doc->doc_version}}" placeholder="产品版本号,可追溯回滚"/>
                                        </li>
                                        <li>
                                            <button class="btn btn-info" type="submit" onclick="versionChange()">确认
                                            </button>
                                        </li>

                                    </ul>
                                    <!--文档版本号结束-->
                                    <!--文档说明-->
                                    <ul class="list-inline">
                                        <li style="width: 150px;">
                                            <h4>说明介绍:</h4>
                                        </li>
                                        <li>
                                            <input style="width: 300px;" type="" name="" id="doc_description"
                                                   value="{{$doc->doc_description}}" placeholder="显示在接口文档中"/>
                                        </li>
                                        <li>
                                            <button class="btn btn-info" type="submit" onclick="descriptionChange()">
                                                确认
                                            </button>
                                        </li>

                                    </ul>
                                    <!--文档说明结束-->
                                    <!--Base URL-->
                                    <ul class="list-inline">
                                        <li style="width: 150px;">
                                            <h4>服务器地址:</h4>
                                        </li>
                                        <li>
                                            <input style="width: 300px;" type="" name="" id="baseurl"
                                                   value="{{$doc->doc_baseurl}}"
                                                   placeholder="正式环境地址,请填写完整路径http/https"/>
                                        </li>
                                        <li>
                                            <button class="btn btn-info" type="submit" onclick="baseurlChange()">确认
                                            </button>
                                        </li>

                                    </ul>
                                    <!--Base URL END-->

                                </div>
                                <!--pdf生成结束-->
                            </div>
                            {{--修改样式--}}
                            <div class="col-sm-12">
                                <hr/>
                                <!--pdf生成-->
                                <h4>文档背景选择:</h4>
                                <ul class="list-inline">
                                    <li>
                                        <input type="radio" name="ri"
                                               id="i1" {{ $doc->doc_backgdimg=='1.jpg' ? 'checked' : '' }}>
                                        <div id="button-bg1" style="margin-left: -2px"></div>
                                    </li>
                                    <li>
                                        <input type="radio" name="ri"
                                               id="i2" {{ $doc->doc_backgdimg=='2.jpg' ? 'checked' : '' }}>
                                        <div id="button-bg2" style="margin-left: -2px"></div>
                                    </li>
                                    <li>
                                        <input type="radio" name="ri"
                                               id="i3" {{ $doc->doc_backgdimg=='3.jpg' ? 'checked' : '' }}>
                                        <div id="button-bg3" style="margin-left: -2px"></div>
                                    </li>
                                    <li>
                                        <input type="radio" name="ri"
                                               id="i4" {{ $doc->doc_backgdimg=='4.jpg' ? 'checked' : '' }}>
                                        <div id="button-bg4" style="margin-left: -2px"></div>
                                    </li>
                                    <li>
                                        <input type="radio" name="ri"
                                               id="i5" {{ $doc->doc_backgdimg=='5.jpg' ? 'checked' : '' }}>
                                        <div id="button-bg5" style="margin-left: -2px"></div>
                                    </li>
                                    <li>
                                        <input type="radio" name="ri"
                                               id="i6" {{ $doc->doc_backgdimg=='6.jpg' ? 'checked' : '' }}>
                                        <div id="button-bg6" style="margin-left: -2px"></div>
                                    </li>
                                    <li>
                                        <input type="radio" name="ri"
                                               id="i7" {{ $doc->doc_backgdimg=='7.jpg' ? 'checked' : '' }}>
                                        <div id="button-bg7" style="margin-left: -2px"></div>
                                    </li>
                                    <li>
                                        <input type="radio" name="ri"
                                               id="i8" {{ $doc->doc_backgdimg=='8.jpg' ? 'checked' : '' }}>
                                        <div id="button-bg8" style="margin-left: -2px"></div>
                                    </li>
                                    <li>
                                        <input type="radio" name="ri"
                                               id="i9" {{ $doc->doc_backgdimg=='9.jpg' ? 'checked' : '' }}>
                                        <div id="button-bg9" style="margin-left: -2px"></div>
                                    </li>
                                    <li>
                                        <input type="radio" name="ri"
                                               id="i10" {{ $doc->doc_backgdimg=='10.jpg' ? 'checked' : '' }}>
                                        <div id="button-bg10" style="margin-left: -2px"></div>
                                    </li>
                                    <li>
                                        <input type="radio" name="ri"
                                               id="i11" {{ $doc->doc_backgdimg=='11.jpg' ? 'checked' : '' }}>
                                        <div id="button-bg11" style="margin-left: -2px"></div>
                                    </li>
                                    <li>
                                        <input type="radio" name="ri"
                                               id="i12" {{ $doc->doc_backgdimg=='12.jpg' ? 'checked' : '' }}>
                                        <div id="button-bg12" style="margin-left: -2px"></div>
                                    </li>
                                </ul>

                                <!--生成PDF-->
                                <hr/>
                                <h4>查看效果:</h4>
                                <ul class="list-inline" style="margin-top: 20px;">

                                    <li>
                                        {{--<button class="btn btn-info" type="submit">HTML下载</button>--}}
                                        <a class="btn btn-info" target="_blank"
                                           href="{{url('i').'/'.$project->url.'/doc'}}">打开文档</a>
                                    </li>
                                    {{--<li>
                                        <button class="btn btn-info" type="submit">WORD下载</button>
                                    </li>
                                    <li>
                                        <button class="btn btn-info" type="submit">PDF下载</button>
                                    </li>--}}

                                </ul>
                                <!--生成PDF结束-->
                                <!--pdf生成结束-->
                            </div>
                        </div>

                        <div style="clear:both; margin-bottom: 20px;"></div>

                    </div>
                    <!--<button class="btn btn-info pull-right">Read More</button>-->
                </div>
            </div>
            <!-- END OF CONTENT PAGE -->
        </div>
        <!--基本信息结束-->

        <!-- /END OF CONTENT -->
    </div>
    <!-- /END OF CONTENT -->
@endsection
@section('javascript')
    <!-- MAIN EFFECT -->
    <script src="//cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    {{--<script type="text/javascript" src="{{asset('assets/js/jquery.js')}}"></script>--}}
    {{--	<script type="text/javascript" src="{{asset('assets/js/bootstrap.js')}}"></script>--}}
    <script type="text/javascript" src="{{asset('assets/js/load.js')}}"></script>
    <!-- /MAIN EFFECT -->
    <script type="text/javascript" src="{{asset('assets/js/iCheck/jquery.icheck.js')}}"></script>
    <!-- GAGE -->
    <script type="text/javascript" src="{{asset('assets/js/toggle_close.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/switch/bootstrap-switch.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/layer/layer.js')}}"></script>

    <script>
        {{--下载文档--}}
        function doc_download() {
            $('#idframe').attr('src', '{{url('i').'/'.$project->url.'/doc_download'}}');
        }

        {{--修改标题--}}
        function titleChange() {
            var title = $('#title').val();
            if (title.length > 0) {
                $.post("{{url('doc/changeTitle').'/'.$doc->id}}", {
                    '_method': 'post',
                    'title': title,
                    '_token': "{{csrf_token()}}"
                }, function (data) {
                    if (data.status) {
                        layer.tips('修改成功', '#title', {
                            tips: [4, '#78BA32']
                        });
                    } else {
                    }
                });
            }

        }

        {{--修改版本--}}
        function versionChange() {
            var version = $('#version').val();
            if (version.length > 0) {
                $.post("{{url('doc/versionChange').'/'.$doc->id}}", {
                    '_method': 'post',
                    'version': version,
                    '_token': "{{csrf_token()}}"
                }, function (data) {
                    if (data.status) {
                        layer.tips('修改成功', '#version', {
                            tips: [4, '#78BA32']
                        });
                    } else {
                    }
                });
            }

        }

        {{--修改描述--}}
        function descriptionChange() {
            var doc_description = $('#doc_description').val();
            if (doc_description.length > 0) {
                $.post("{{url('doc/descriptionChange').'/'.$doc->id}}", {
                    '_method': 'post',
                    'description': doc_description,
                    '_token': "{{csrf_token()}}"
                }, function (data) {
                    if (data.status) {
                        layer.tips('修改成功', '#doc_description', {
                            tips: [4, '#78BA32']
                        });
                    } else {
                    }
                });
            }

        }

        {{--修改基地址--}}
        function baseurlChange() {
            var baseurl = $('#baseurl').val();
            $.post("{{url('doc/baseurlChange').'/'.$doc->id}}", {
                '_method': 'post',
                'baseurl': baseurl,
                '_token': "{{csrf_token()}}"
            }, function (data) {
                if (data.status) {
                    layer.tips('修改成功', '#baseurl', {
                        tips: [4, '#78BA32']
                    });
                } else {
                }
            });

        }

        {{--修改密码--}}
        $(document).ready(function () {
            //CHECKBOX PRETTYFY
            $('input').iCheck({
                checkboxClass: 'icheckbox_flat-grey',
                radioClass: 'iradio_flat-grey'
            });
        });
        $('#radio-1').on('ifChecked', function (event) {
            $('#passwd').attr("disabled", true);
            $.post("{{url('doc/changeStatus').'/'.$doc->id}}", {
                '_method': 'post',
                'passwd': $('#passwd').val(),
                'status': '0',
                '_token': "{{csrf_token()}}"
            }, function (data) {
                if (data.status) {
                    layer.tips('修改成功', '#radio-1', {
                        tips: [4, '#78BA32']
                    });
                } else {
                }
            });
        });
        $('#radio-2').on('ifChecked', function (event) {
            $('#passwd').attr("disabled", false);
            if ($('#passwd').attr("disabled") != "disabled" && $('#passwd').val().length > 0) {
                $.post("{{url('doc/changeStatus').'/'.$doc->id}}", {
                    '_method': 'post',
                    'passwd': $('#passwd').val(),
                    'status': '1',
                    '_token': "{{csrf_token()}}"
                }, function (data) {
                    if (data.status) {
                        layer.tips('修改成功', '#passwd', {
                            tips: [4, '#78BA32']
                        });
                    } else {
                    }
                });
            }
        });
        $('#passwd_btn').click(function () {
            if ($('#passwd').attr("disabled") != "disabled" && $('#passwd').val().length > 0) {
                $.post("{{url('doc/changeStatus').'/'.$doc->id}}", {
                    '_method': 'post',
                    'passwd': $('#passwd').val(),
                    'status': '1',
                    '_token': "{{csrf_token()}}"
                }, function (data) {
                    if (data.status) {
                        layer.tips('修改成功', '#passwd', {
                            tips: [4, '#78BA32']
                        });
                    } else {
                    }
                });
            }
        });
        {{--修改文档背景--}}
        $('#i1').on('ifChecked', function (event) {
            $.post("{{url('doc/changeBgimg').'/'.$doc->id}}", {
                '_method': 'post',
                'backgdimg': '1.jpg',
                '_token': "{{csrf_token()}}"
            }, function (data) {
                if (data.status) {
                    layer.tips('修改成功', '#i1', {
                        tips: [4, '#78BA32']
                    });
                } else {
                }
            });
        });
        $('#i2').on('ifChecked', function (event) {
            $.post("{{url('doc/changeBgimg').'/'.$doc->id}}", {
                '_method': 'post',
                'backgdimg': '2.jpg',
                '_token': "{{csrf_token()}}"
            }, function (data) {
                if (data.status) {
                    layer.tips('修改成功', '#i2', {
                        tips: [4, '#78BA32']
                    });
                } else {
                }
            });
        });
        $('#i3').on('ifChecked', function (event) {
            $.post("{{url('doc/changeBgimg').'/'.$doc->id}}", {
                '_method': 'post',
                'backgdimg': '3.jpg',
                '_token': "{{csrf_token()}}"
            }, function (data) {
                if (data.status) {
                    layer.tips('修改成功', '#i3', {
                        tips: [4, '#78BA32']
                    });
                } else {
                }
            });
        });
        $('#i4').on('ifChecked', function (event) {
            $.post("{{url('doc/changeBgimg').'/'.$doc->id}}", {
                '_method': 'post',
                'backgdimg': '4.jpg',
                '_token': "{{csrf_token()}}"
            }, function (data) {
                if (data.status) {
                    layer.tips('修改成功', '#i4', {
                        tips: [4, '#78BA32']
                    });
                } else {
                }
            });
        });
        $('#i5').on('ifChecked', function (event) {
            $.post("{{url('doc/changeBgimg').'/'.$doc->id}}", {
                '_method': 'post',
                'backgdimg': '5.jpg',
                '_token': "{{csrf_token()}}"
            }, function (data) {
                if (data.status) {
                    layer.tips('修改成功', '#i5', {
                        tips: [4, '#78BA32']
                    });
                } else {
                }
            });
        });
        $('#i6').on('ifChecked', function (event) {
            $.post("{{url('doc/changeBgimg').'/'.$doc->id}}", {
                '_method': 'post',
                'backgdimg': '6.jpg',
                '_token': "{{csrf_token()}}"
            }, function (data) {
                if (data.status) {
                    layer.tips('修改成功', '#i6', {
                        tips: [4, '#78BA32']
                    });
                } else {
                }
            });
        });
        $('#i7').on('ifChecked', function (event) {
            $.post("{{url('doc/changeBgimg').'/'.$doc->id}}", {
                '_method': 'post',
                'backgdimg': '7.jpg',
                '_token': "{{csrf_token()}}"
            }, function (data) {
                if (data.status) {
                    layer.tips('修改成功', '#i7', {
                        tips: [4, '#78BA32']
                    });
                } else {
                }
            });
        });
        $('#i8').on('ifChecked', function (event) {
            $.post("{{url('doc/changeBgimg').'/'.$doc->id}}", {
                '_method': 'post',
                'backgdimg': '8.jpg',
                '_token': "{{csrf_token()}}"
            }, function (data) {
                if (data.status) {
                    layer.tips('修改成功', '#i8', {
                        tips: [4, '#78BA32']
                    });
                } else {
                }
            });
        });
        $('#i9').on('ifChecked', function (event) {
            $.post("{{url('doc/changeBgimg').'/'.$doc->id}}", {
                '_method': 'post',
                'backgdimg': '9.jpg',
                '_token': "{{csrf_token()}}"
            }, function (data) {
                if (data.status) {
                    layer.tips('修改成功', '#i9', {
                        tips: [4, '#78BA32']
                    });
                } else {
                }
            });
        });
        $('#i10').on('ifChecked', function (event) {
            $.post("{{url('doc/changeBgimg').'/'.$doc->id}}", {
                '_method': 'post',
                'backgdimg': '10.jpg',
                '_token': "{{csrf_token()}}"
            }, function (data) {
                if (data.status) {
                    layer.tips('修改成功', '#i10', {
                        tips: [4, '#78BA32']
                    });
                } else {
                }
            });
        });
        $('#i11').on('ifChecked', function (event) {
            $.post("{{url('doc/changeBgimg').'/'.$doc->id}}", {
                '_method': 'post',
                'backgdimg': '11.jpg',
                '_token': "{{csrf_token()}}"
            }, function (data) {
                if (data.status) {
                    layer.tips('修改成功', '#i11', {
                        tips: [4, '#78BA32']
                    });
                } else {
                }
            });
        });
        $('#i12').on('ifChecked', function (event) {
            $.post("{{url('doc/changeBgimg').'/'.$doc->id}}", {
                '_method': 'post',
                'backgdimg': '12.jpg',
                '_token': "{{csrf_token()}}"
            }, function (data) {
                if (data.status) {
                    layer.tips('修改成功', '#i12', {
                        tips: [4, '#78BA32']
                    });
                } else {
                }
            });
        });
    </script>

@endsection