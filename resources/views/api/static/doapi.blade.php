@extends('common.base_layout')
@section('title','Do API - 新建静态接口')
@section('stylesheet')
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    {{--<link rel="stylesheet" href="{{asset('assets/css/loader-style.css')}}">--}}

    <!--custom风格-->
    <link rel="stylesheet" href="{{asset('assets/css/doapi.css')}}">

    <!--验证-->
    <link href="{{asset('assets/js/validate/validate.css')}}" rel="stylesheet">

    <!--表格风格-->
    <link href="{{asset('assets/js/footable/css/footable.core.css?v=2-0-1')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/js/footable/css/footable.standalone.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/js/footable/css/footable-demos.css')}}" rel="stylesheet" type="text/css">


    @endsection

    @section('content')
            <!--  PAPER WRAP -->
    <div class="wrap-fluid">
        <!-- CONTENT -->
        <!-- BREADCRUMB -->
        <ul id="breadcrumb" style="margin-top: 20px;border-left: 5px solid #0DB8DF;">
            <li>
                <span class="entypo-home"></span>
            </li>
            <li><i class="fa fa-lg fa-angle-right"></i>
            </li>
            <li><a href="#" title="Sample page 1">新建静态接口</a>
            </li>
        </ul>
        <!-- END OF BREADCRUMB -->

        <!--说明-->
        <div class="content-wrap">
            <div class="row">

            </div>
        </div>
        <!--说明结束-->
        <!-- 创建步骤-->
        <div class="content-wrap">
            <div class="time-wrap">
                <div class="row">
                    <div class="col-md-12">
                        <!-- The time line -->
                        <ul class="timeline">
                            <!-- timeline time label -->
                            <li class="time-label">
										<span class="bg-red">
                                        准备制作了
                                    </span>

                                <div class="timeline-item">
                                    <div class="timeline-body">
                                        <h5>Base URL : <span
                                                    style="margin-left:10px;color: #333;font-size: 16px;letter-spacing:2px;">{{url('i').'/'}}</span><span
                                                    style="color: #EA3F3F;font-size: 16px;letter-spacing:2px;">{{$url}}</span>
                                        </h5>
                                    </div>
                                </div>
                            </li>
                            <!-- /.timeline-label -->

                            <!-- 第一步开始 -->
                            <li>
                                <a name="first" id="first"></a>
                                <i class="fa  bg-time">1</i>

                                <div class="timeline-item">
                                    <!--<span class="time"><i class="fa fa-clock-o"></i> 12:05</span>-->
                                    <h4 class="timeline-header"><a href="#">1.接口地址</a> ( 最终请求地址 = Base URL
                                        <前缀> + 自定义请求地址
                                            <后缀> )
                                    </h4>

                                    <div class="timeline-body">
                                        <div class="well">
                                            <h5>请填写请求地址和说明 . <span
                                                        style="color: #EA3F3F;">  请不要带?号 </span>字符.</h5>
                                        </div>
                                        <div>

                                            <form action="#" id="baseinfo-form" class="form-horizontal">
                                                <fieldset>
                                                    {{--请求方式--}}
                                                    <div class="control-group">
                                                        <label style="margin-bottom: 5px;font-size: 16px !important;" class="control-label"
                                                               for="name">请求方式:</label>

                                                        <div class="controls">
                                                            <div class="input-group">
                                                                <div class="input-group-btn">
                                                                    <button style="height: 40px;width: 100px;"
                                                                            type="button"
                                                                            id="method"
                                                                            class="btn btn-info dropdown-toggle"
                                                                            data-toggle="dropdown"
                                                                            aria-haspopup="true"
                                                                            aria-expanded="false">GET <span
                                                                                class="caret"></span></button>
                                                                    <ul class="dropdown-menu">
                                                                        <li onclick="method_change('GET')"><a
                                                                                    href="javascript:;">GET
                                                                                从服务器取出资源（一项或多项）</a></li>
                                                                        <li role="separator" class="divider"></li>
                                                                        <li onclick="method_change('POST')"><a
                                                                                    href="javascript:;">POST
                                                                                在服务器新建一个资源</a></li>
                                                                        <li role="separator" class="divider"></li>
                                                                        <li onclick="method_change('PUT')"><a
                                                                                    href="javascript:;">PUT
                                                                                在服务器更新资源（客户端提供改变后的完整资源）</a></li>
                                                                        <li role="separator" class="divider"></li>
                                                                        <li onclick="method_change('PATCH')"><a
                                                                                    href="javascript:;">PATCH
                                                                                在服务器更新资源（客户端提供改变的属性）</a></li>
                                                                        <li role="separator" class="divider"></li>
                                                                        <li onclick="method_change('DELETE')"><a
                                                                                    href="javascript:;">DELETE
                                                                                从服务器删除资源</a></li>
                                                                    </ul>
                                                                </div>
                                                                <!-- /btn-group -->
                                                                <input style="height: 40px !important;font-size: 16px !important;"
                                                                       type="text" class="form-control"
                                                                       placeholder="{{url('i').'/'.$url.'/'}}"
                                                                       disabled="disabled" id="weburl">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--请求地址--}}
                                                    <div class="control-group">
                                                        <label style="margin-bottom: 5px;margin-top: 10px;font-size: 16px !important;" class="control-label"
                                                               for="url" id="url_label">(必填)请求地址: </label>

                                                        <div class="controls" id="url_control">
                                                            <input style="height: 50px !important;font-size: 14px !important;"
                                                                   type="text" class="form-control" name="url"
                                                                   id="url"
                                                                   placeholder="例如: login.action login.do .."
                                                                   onchange="changeValue(this.value)">
                                                        </div>
                                                    </div>

                                                    {{--版本号--}}
                                                    <div class="control-group">
                                                        <label style="margin-bottom: 5px;margin-top: 10px;font-size: 16px !important;" class="control-label"
                                                               for="url" id="url_label">版本号: </label>

                                                        <div class="controls">
                                                            <input style="height: 50px !important;font-size: 14px !important;"
                                                                   type="text" class="form-control" name="version"
                                                                   id="version"
                                                                   placeholder="默认版本号 1.0.0,请修改"
                                                                   >
                                                        </div>
                                                    </div>

                                                    {{--接口说明--}}
                                                    <div class="control-group">
                                                        <label style="margin-bottom: 5px;margin-top: 10px;font-size: 16px !important;" class="control-label"
                                                               for="description">接口说明:</label>

                                                        <div class="controls">
                                                            <input style="height: 50px !important;font-size: 14px !important;"
                                                                   type="text" class="form-control"
                                                                   name="description"
                                                                   id="description"
                                                                   placeholder="例如: 前台登录接口,用户名用username字段">
                                                        </div>
                                                    </div>


                                                    <div class="form-actions" style="margin:25px 0 10px 0;">
                                                        <a href="javascript:;" onclick="jump_second()"
                                                           class="btn btn-info btn-flat btn-xs">下一步 <span
                                                                    class="fa fa-chevron-right"></span></a>
                                                    </div>
                                                </fieldset>
                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </li>
                            <!-- 第一步结束 -->

                            <!-- 第二步开始 -->
                            <li>
                                {{--锚点,点击下一步跳转到这里--}}
                                <a name="second" id="second"></a>
                                <i class="fa bg-time">2</i>

                                <div class="timeline-item">
                                    <!--<span class="time"><i class="fa fa-clock-o"></i> 5 mins ago</span>-->
                                    <h3 class="timeline-header no-border"><a href="#">2.传入参数</a> (最多10个参数)</h3>

                                    <div class="timeline-body">
                                        <div class="well">
                                            <h5 id="second_well_url">{{url('i').'/'.$url.'/'}}</h5>
                                        </div>
                                        <table id="params_table" class="footable-res footable table-hover"
                                               data-page-size="30">
                                            <thead>
                                            <tr>
                                                <th>
                                                    操作
                                                </th>
                                                <th data-sort-ignore="true">
                                                    参数名
                                                </th>
                                                <th>
                                                    参数默认值
                                                </th>
                                                <th>
                                                    参数说明
                                                </th>

                                            </tr>
                                            </thead>
                                            <tbody id="params_table_tbody">
                                            <tr id="demo_tr">
                                                <td></td>
                                                <td><h5 style="color: #999999;">示例 : username </h5></td>
                                                <td><h5 style="color: #999999;">示例 : your name</h5></td>
                                                <td><h5 style="color: #999999;">示例 : 用户名3-8位</h5></td>

                                            </tr>
                                            <tr>
                                                <td><a class="btn btn-default btn-flat btn-xs"
                                                       onClick="copyRow(this)">复制</a> <a class="btn btn-danger btn-flat btn-xs"
                                                                                         onClick="removeRow(this)">删除</a></td>
                                                <td><input type="text" class="in0" placeholder="请输入参数名.."
                                                           onchange="params_change()"/></td>
                                                <td><input type="text" class="in1" placeholder="请输入默认值.."
                                                           onchange="params_change()"/></td>
                                                <td><input type="text" class="in2" placeholder="请输入参数说明.."
                                                           onchange="params_change()"/></td>
                                            </tr>
                                            </tbody>

                                        </table>

                                    </div>
                                    <div class="timeline-footer">
                                        <a class="btn btn-info btn-flat btn-xs" id="add_new_tr"
                                           onClick="addRow('params_table')">添加一行 <span
                                                    class="fa fa-plus"></span></a>
                                    </div>
                                </div>
                            </li>
                            <!-- 第二步结束 -->
                            <!-- 第三步开始 -->
                            <li>
                                <a name="third" id="third"></a>
                                <i class="fa bg-time">3</i>

                                <div class="timeline-item">
                                    <!--<span class="time"><i class="fa fa-clock-o"></i> 40 mins ago</span>-->
                                    <h3 class="timeline-header"><a href="#">3.返回内容</a> (您是否需要 <a
                                                href="http://www.qqe2.com/" target="_blank">json在线编辑器</a>,编辑完成后复制进下框中)
                                    </h3>

                                    <div class="timeline-body">
                                        <div class="well">
                                            <h5>用户访问此接口后,返回的内容如下,所见即所得,你填入什么就返回什么!</h5>
                                        </div>
                                            <textarea id="json_content" rows="15"
                                                      style="width: 100%; border-color: #C7D5E0 !important;padding: 10px;"
                                                      placeholder="请填入正确的json内容..">{
  "success": true,
  "data": {
    "array": [
      1,
      2,
      3
    ],
    "boolean": true,
    "null": null,
    "number": 123,
    "object": {
      "a": "b",
      "c": "d",
      "e": "f"
    },
    "string": "Hello World"
  }
}</textarea>
                                    </div>
                                    <div class='timeline-footer'>
                                        <h5 class="timeline-header">需要 <a
                                                    href="http://www.baidu.com/s?cid=qb7.zhuye&ie=utf-8&wd=json"
                                                    target="_blank">json</a>格式校验?</h5>
                                    </div>
                                </div>
                            </li>
                            <!-- 第三步结束 -->
                            <li>
                                <div class="timeline-item">
                                    <div class='timeline-footer'>
                                        <a class="btn btn-info btn-flat btn-xs" id="send_btn">保存提交 <span
                                                    class="fa fa-check"></span></a>

                                    </div>
                                </div>
                            </li>
                            <li>
                                <i class="fa fa-check bg-time"></i>
                            </li>
                        </ul>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!--创建步骤结束-->

        <!-- /END OF CONTENT -->

    </div>
    <!--  END OF PAPER WRAP -->
    @endsection

    @section('javascript')
            <!-- MAIN EFFECT -->
    {{--<script type="text/javascript" src="{{asset('assets/js/jquery.js')}}"></script>--}}
    {{--    <script type="text/javascript" src="{{asset('assets/js/bootstrap.js')}}"></script>--}}
    <script type="text/javascript" src="{{asset('assets/js/load.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/layer/layer.js')}}"></script>
    <!-- /MAIN EFFECT -->
    <script type="text/javascript" src="{{asset('assets/js/doapi_main.js')}}"></script>
    <!-- GAGE -->
    <script src="{{asset('assets/js/footable/js/footable.js?v=2-0-1')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('assets/js/validate/jquery.validate.min.js')}}"></script>

    <script type="text/javascript">
        $(function () {
            $('.footable-res').footable();
        });
    </script>
    {{--提交--}}
    <script type="text/javascript">
        $(document).ready(function () {
            $('#send_btn').click(function () {

                if (!isSetUrl()) {
                    return;
                }
                if (!isSetJson()) {
                    return;
                }

                $.ajax({
                    url: '{{url('i/'.$url)}}',
                    type: "post",
                    data: {
                        'url': $('#url').val(),
                        'description': $('#description').val(),
                        'version': $('#version').val().length<=0?"1.0.0":$('#version').val(),
                        'method': mMethod,
                        'param': getdata(),
                        'param_description': getDescritiondata(),
                        'baseurl': '{{url('i/').'/'}}',
                        'status': '200',
                        'type': 'static',
                        'json': $('#json_content').val(),
                        '_token': '{{csrf_token()}}'
                    },
                    success: function (data) {
                        if (!data.success) {
                            $.each(data.errors, function (index, value) {
                                if (value.length != 0) {
                                    if (index === 'json') {
                                        window.location.href = "#third";
                                        layer.tips(value, '#json_content', {
                                            tips: [1, '#d9534f'] //还可配置颜色
                                        });
                                    } else if (index === 'param') {
                                        window.location.href = "#second";
                                        layer.tips(value, '#params_table_tbody', {
                                            tips: [1, '#d9534f'] //还可配置颜色
                                        });
                                    } else if (index === 'server') {
                                        layer.msg(value);
                                    } else if (index === 'url_method') {
                                        $('#url_control').find('.error').removeClass('valid').text(value);
                                        window.location.href = "#first";
                                        layer.tips(value, '#url', {
                                            tips: [1, '#d9534f'] //还可配置颜色
                                        });
                                    }
                                }
                            });

                        } else {
                            //创建成功啦
                            window.parent.changeNumFromIframe('static_count','add')
                            window.location.href = "#second"
                            layer.open({
                                content: '创建成功啦!',
                                btn: ['再建一条', '返回'],
                                scrollbar: false,
                                yes: function (index, layero) {
                                    //do something
                                    layer.close(index); //如果设定了yes回调，需进行手工关闭
                                    window.location.href = "#first";
                                },
                                btn2: function (index, layero) {
                                    //do something
                                    var href = '{{url('i')}}';
                                    href += '/';
                                    href += '{{$url}}';
                                    href += '/total#';
//                                    parent.location.reload();
                                    window.location.href = href;
                                }
                            });
                        }
                    },
                    error: function (xhr, type) {
//                        alert('Ajax error!')

                    }
                });
            });
        });
    </script>

    {{--验证输入合法性--}}
    <script type="text/javascript">
        $(document).ready(function () {
            /* $.validator.addMethod("urlCheck", function (value, element) {
             var val = /^\w+\/!*\w+\.?\w+$/;
             return this.optional(element) || val.test(value);
             }, "只能包括中文字、英文字母、数字和下划线");*/
            //Validation
            $('#baseinfo-form').validate({
                rules: {
                    url: {
                        urlCheck: true,
                        minlength: 2,
                        maxlength: 99,
                        required: true
                    },

                },
                messages: {
                    url: {
                        urlCheck: '输入的内容不合法,请核对上面的要求',
                        required: '请输入请求地址',
                        minlength: '请至少输入2个字符',
                        maxlength: '最多输入99个字符',
                    },

                },
                highlight: function (element) {
                    $(element).closest('.control-group').removeClass('success').addClass('error');
                },
                success: function (element) {
                    element.text('OK!').addClass('valid')
                            .closest('.control-group').removeClass('error').addClass('success');
                }
            });
        });
    </script>
    {{--修改url--}}
    <script>
        var mMethod = "GET";
        /*第一步中修改url*/
        function changeValue(obj) {
            // alert("changed value is " + obj);
            //console.log(obj);
            var baseurl = "{{url('i/').'/'.$url.'/'}}";
            var weburl = baseurl + obj;
            document.getElementById("weburl").placeholder = weburl;
            var oldData = document.getElementById("second_well_url").innerHTML;
            if (oldData == weburl) {
                return;
            }
            document.getElementById("second_well_url").innerHTML = weburl;
            params_change();

        }
        /*第二步中的参数修改响应*/
        function params_change() {

            var strData = getdata();
            var oldData = document.getElementById("weburl").placeholder;
            document.getElementById("second_well_url").innerHTML = oldData + "?" + strData;

        }

        /*判断是否设置了url*/
        function isSetUrl() {
            var name = document.getElementById("url").value;
            if (name.length == 0) {
//                location.hash="#first";
                window.location.href = "#first"
//                $("html,body").animate({scrollTop:$("#first").offset().top},1000)
                layer.tips("地址不能为空,请填写一下咯~", '#url', {
                    tips: [1, '#d9534f'] //还可配置颜色
                });
                return false;
            }
            return true;
        }
        /*判断是否设置了json*/
        function isSetJson() {
            var name = document.getElementById("json_content").value;
            if (name.length == 0) {
//                location.hash="#first";
                window.location.href = "#third"
//                $("html,body").animate({scrollTop:$("#first").offset().top},1000)
                layer.tips("json内容不能为空,请填写一下咯~", '#json_content', {
                    tips: [1, '#d9534f'] //还可配置颜色
                });
                return false;
            }
            return true;
        }
        /*下一步,跳到第二步设置参数*/
        function jump_second() {
            if (!isSetUrl()) {
                return;
            }
            location.hash = "#second";
            var tr_list = document.getElementById("params_table_tbody").getElementsByTagName("tr");
            if (tr_list.length > 1) {
                var name = tr_list[1].getElementsByClassName('in0')[0];
                name.focus();
            }
        }
        /*修改请求方法*/
        function method_change(method) {
            mMethod = method;
            $btn = document.getElementById("method").innerHTML = method + " " + '<span class=\"caret\"></span>';
        }

        /*处理第二步中的参数,返回处理后的字符串 不带说明字段内容*/
        function getdata() {
            var tr_list = document.getElementById("params_table_tbody").getElementsByTagName("tr");

            var strData = "";
            for (var i = 0; i < tr_list.length; i++) {
                var tr = tr_list[i];
                if (tr.id != 'demo_tr') {
                    var name = tr.getElementsByClassName('in0')[0];
                    var content = tr.getElementsByClassName('in1')[0];
                    strData += name.value + "=" + content.value + "&";
                }

            }
            if (strData.length > 0) {
                strData = strData.substr(0, strData.length - 1);
            }
            return strData;
        }
        /*处理第二步中的参数,返回处理后的字符串 带说明字段内容*/
        function getDescritiondata() {
            var tr_list = document.getElementById("params_table_tbody").getElementsByTagName("tr");

            var strData = "";
            for (var i = 0; i < tr_list.length; i++) {
                var tr = tr_list[i];
                if (tr.id != 'demo_tr') {
                    var description = tr.getElementsByClassName('in2')[0];
                    strData += description.value + "|";
                }

            }
            if (strData.length > 0) {
                strData = strData.substr(0, strData.length - 1);
            }
            return strData;
        }

        /*第二步中,添加一行*/
        function addRow(tbodyID) {
            var bodyObj = document.getElementById(tbodyID);
            if (bodyObj == null) {
                alert("Body of Table not Exist!");
                return;
            }
            var rowCount = bodyObj.rows.length;

            if (rowCount > 11) {
                layer.tips("最多10个参数哦~", '#add_new_tr', {
                    tips: [1, '#d9534f'] //还可配置颜色
                });
                retutn;
            }

            var cellCount = bodyObj.rows[0].cells.length;
            var newRow = bodyObj.insertRow(rowCount++);
            var cellHTMLs = [
                '<td><a class="btn btn-default btn-flat btn-xs"onClick="copyRow(this)">复制</a> <a class="btn btn-danger btn-flat btn-xs"onClick="removeRow(this)">删除</a>',
                '<input type="text" class="in0" onchange="params_change()" placeholder="请输入参数名.." /></td>',
                '<td><input type="text" class="in1" onchange="params_change()"  placeholder="请输入字段值.."/></td>',
                '<td><input type="text" class="in2" onchange="params_change()" placeholder="请输入字段描述.."/></td>',

            ];
            for (var i = 0; i < cellCount; i++) {
                newRow.insertCell(i).innerHTML = cellHTMLs[i];
            }
            var name = newRow.getElementsByClassName('in0')[0];
            name.focus();


            IFrameResize();

        }
        /*第二步中,删除一行*/
        function removeRow(inputobj) {
            if (inputobj == null) return;
            var parentTD = inputobj.parentNode;
            var parentTR = parentTD.parentNode;
            var parentTBODY = parentTR.parentNode;
            parentTBODY.removeChild(parentTR);

            params_change();
        }
        /*第二步中,复制一行*/
        function copyRow(inputobj) {
            if (inputobj == null) return;
            var parentTD = $(inputobj).parent();
            var parentTR = $(inputobj).parent().parent();
            var parentTBODY = $(inputobj).parent().parent().parent();
            var tr = parentTR.clone();
            tr.appendTo(parentTBODY);

            params_change();

            IFrameResize();
        }

        /*动态修改iframe高度*/
        function IFrameResize() {
//alert(this.document.body.scrollHeight); //弹出当前页面的高度
            var obj = parent.document.getElementById("iframepage"); //取得父页面IFrame对象
//alert(obj.height); //弹出父页面中IFrame中设置的高度
            obj.height = this.document.body.scrollHeight; //调整父页面中IFrame的高度为此页面的高度
        }
    </script>
@endsection

