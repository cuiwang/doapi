@extends('common.base_layout')
@section('title','Do API - 我的接口')
@section('stylesheet')
    {{--<link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">--}}
    <link rel="stylesheet" href="{{asset('assets/css/api_total.css')}}">
    {{--    <link rel="stylesheet" href="{{asset('assets/css/loader-style.css')}}">--}}
    <link rel="stylesheet" href="{{asset('assets/css/main_custom.css')}}">

    <!--表格风格-->
    <link href="{{asset('assets/js/footable/css/footable.core.css?v=2-0-1')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/js/footable/css/footable.standalone.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/js/footable/css/footable-demos.css')}}" rel="stylesheet" type="text/css">

    @endsection
    @section('content')
            <!--  PAPER WRAP -->

    <!-- CONTENT -->
    <div class="wrap-fluid">
        <!-- BLANK PAGE-->
        <div class="content-wrap" style="background-color:#F9F9F9">
            <div class="row">
                <!--接口列表-->
                <div class="col-sm-12">

                    <div class="nest" id="FootableClose">
                        <div class="title-alt">
                            <ul class="nav nav-pills">
                                <li role="presentation" class="apis active"><a href="#myapi" data-toggle="tab"
                                                                               id="myAPI">动态接口</a></li>
                                {{-- <li role="presentation" class="apis"><a href="#mygroup" data-toggle="tab"
                                                                         id="myGROUP">我的分组</a></li>--}}
                                <li class="pull-right">
                                    <div class="titleClose">
                                        <a class="gone" href="#FootableClose">
                                            <span class="entypo-cancel"></span>
                                        </a>
                                    </div>
                                </li>
                                <li class="pull-right">
                                    <div class="titleToggle">
                                        <a class="nav-toggle-alt" href="#Footable">
                                            <span class="entypo-up-open"></span>
                                        </a>
                                    </div>
                                </li>
                            </ul>

                        </div>
                        {{--tab 标签--}}
                        <div id="myTabContent" class="tab-content">
                            {{--新建接口--}}
                            <div class="tab-pane fade in active" id="myapi">
                                <div class="body-nest" id="Footable">
                                    <div class="row" style="margin-bottom:10px;">
                                        <div class="col-sm-6">

                                            <a href="{{url('i'.'/'.$url.'/dynamic_create')}}"
                                               class="btn btn-info">新建接口 <span
                                                        class="glyphicon glyphicon-plus"></span></a>

                                        </div>
                                        <div class="col-sm-4">
                                            <input class="form-control" id="filter" placeholder="过滤接口..."
                                                   type="text">
                                        </div>
                                        <div class="col-sm-2">
                                            <select class="filter-status form-control">
                                                <option value="active">全部请求</option>
                                                <option value="suspended">GET</option>
                                                <option value="suspended">POST</option>
                                                <option value="suspended">PUT</option>
                                                <option value="suspended">PATCH</option>
                                                <option value="suspended">DELETE</option>
                                            </select>
                                        </div>

                                    </div>

                                    <p class="lead well">点击接口地址前面的<stong> ► 灰色三角形</stong>,查看具体地址,点击后可以测试接口内容!</p>
                                    <table id="footable-res1" class="demo footable  table-striped  toggle-arrow-small" data-filter="#filter"
                                           data-filter-text-only="true" data-filter-timeout="500">
                                        <thead>
                                        <tr>
                                            <th data-toggle="true">
                                                接口地址
                                            </th>
                                            <th data-hide="all">
                                                点击测试接口地址
                                            </th>
                                            <th>
                                                版本号
                                            </th>
                                            <th data-sort-ignore="true">
                                                说明
                                            </th>
                                            <th data-sort-ignore="true">
                                                接口状态
                                            </th>
                                            <th>
                                                请求方式
                                            </th>
                                            <!--<th>
                                                接口类型
                                            </th>-->
                                            <th data-sort-initial="descending">
                                                最后修改时间
                                            </th>
                                            <th data-sort-ignore="true" style="text-align: center">
                                                操作
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($apis as $api)
                                            <tr>

                                                <td>
                                                    {{mb_strlen($api->url)>40?mb_substr($api->url,0,40).'...':$api->url}}
                                                </td>
                                                <td>
                                                    <a style="font-size: 14px;color: #333"
                                                       href="{{url('test').'/'.$api->id.'_api/'.$api->url}}"
                                                       target="_blank">{{url('test').'/'.$api->id.'_api/'.$api->url}}</a>
                                                </td>
                                                <td>
                                                    {{$api->version}}
                                                </td>
                                                <td>
                                                    <!--<span class="status-metro status-active" title="Active">Active</span>-->
                                                    {{mb_strlen($api->description)>25?mb_substr($api->description,0,25).'...':$api->description}}
                                                </td>
                                                @if ($api->status == 200)
                                                    <td><label class="label label-success"
                                                               onclick="changeStatus(this,'{{$api->id}}',200)">200</label>
                                                        <label class="label label-default"
                                                               onclick="changeStatus(this,'{{$api->id}}',500)">500</label>
                                                        <label class="label label-default"
                                                               onclick="changeStatus(this,'{{$api->id}}',503)">503</label>
                                                    </td>
                                                @elseif ($api->status == 500)
                                                    <td><label class="label label-default"
                                                               onclick="changeStatus(this,'{{$api->id}}',200)">200</label>
                                                        <label class="label label-success"
                                                               onclick="changeStatus(this,'{{$api->id}}',500)">500</label>
                                                        <label class="label label-default"
                                                               onclick="changeStatus(this,'{{$api->id}}',503)">503</label>
                                                    </td>
                                                @else
                                                    <td><label class="label label-default"
                                                               onclick="changeStatus(this,'{{$api->id}}',200)">200</label>
                                                        <label class="label label-default"
                                                               onclick="changeStatus(this,'{{$api->id}}',500)">500</label>
                                                        <label class="label label-success"
                                                               onclick="changeStatus(this,'{{$api->id}}',503)">503</label>
                                                    </td>
                                                @endif
                                                <td><span>{{$api->method}}</span></td>
                                                <!--<td><span class="status-metro status-disabled" >STATIC</span></td>-->


                                                <td><h6>{{$api->updated_at}}</h6>{{$api->updated_at->diffForHumans()}}</td>
                                                <td style="text-align: center">
                                                    <a style="color: #666" class="btn btn-primary"
                                                       onclick="copyProject('{{$url}}','{{$api->id}}')">复制
                                                    </a>

                                                    {{-- <br>
                                                     <div style="height: 5px;"></div>--}}

                                                    <a class="btn btn-info"
                                                       onclick="editProject('{{$url}}','{{$api->id}}')">修改
                                                    </a>
                                                    <a class="btn btn-danger" onclick="delProject(this,'{{$api->id}}')">
                                                        删除
                                                    </a>
                                                    {{-- <a style="color: #666" class="btn btn-primary"
                                                        href="{{url('test').'/'.$api->id.'_api/'.$api->url}}"
                                                        target="_blank">测试</a>--}}
                                                </td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="7">
                                                <div class="pagination pagination-centered"></div>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            {{--新建分组--}}
                            {{--<div class="tab-pane fade" id="mygroup">
                                <div class="body-nest" id="Footable">
                                    <div class="row" style="margin-bottom:10px;">
                                        <div class="col-sm-6">
                                            <a href="{{url('main/dogroup')}}" style="margin-left:10px;"
                                               class="pull-left btn btn-info clear-filter" title="clear filter">
                                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>新建分组</a>


                                        </div>
                                        <div class="col-sm-4">
                                            <input class="form-control" id="filter" placeholder="Search..."
                                                   type="text">
                                        </div>
                                        <div class="col-sm-2">
                                            <select class="filter-status form-control">
                                                <option value="active">全部分组</option>
                                                <option value="disabled">user</option>
                                                <option value="suspended">cost</option>
                                            </select>
                                        </div>


                                    </div>

                                    <p class="lead well">用户自己创建的接口将展示在下表中,目前只支持静态创建,动态创建正在研发中,请您等待.</p>
                                    <table id="footable-res2" class="demo  table-striped" data-filter="#filter"
                                           data-filter-text-only="true" data-filter-timeout="500">
                                        <thead>
                                        <tr>
                                            <th data-sort-ignore="true">
                                                分组名称
                                            </th>
                                            <th data-sort-ignore="true">
                                                说明
                                            </th>
                                            <th data-sort-ignore="true">
                                                接口数量
                                            </th>
                                            <th data-sort-ignore="true">
                                                编辑
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>user</td>
                                            <td>
                                                <!--<span class="status-metro status-active" title="Active">Active</span>-->
                                                登录接口主要用户首页,用户需要提交用户名以及密码
                                            </td>
                                            <td>2</td>
                                            <td>
                                                <button class="btn btn-info">编辑</button>
                                                <button class="btn btn-danger">删除</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>cost</td>
                                            <td>
                                                <!--<span class="status-metro status-active" title="Active">Active</span>-->
                                                登录接口主要用户首页,用户需要提交用户名以及密码
                                            </td>
                                            <td>2</td>
                                            <td>
                                                <button class="btn btn-info">编辑</button>
                                                <button class="btn btn-danger">删除</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="4">
                                                <div class="pagination pagination-centered"></div>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>--}}
                        </div>

                    </div>

                </div>
                <!--接口列表结束-->

            </div>

            <!-- END OF BLANK PAGE -->

        </div>
    </div>



    <!-- /END OF CONTENT -->

    <!--  END OF PAPER WRAP -->
    @endsection

    @section('javascript')
            <!-- MAIN EFFECT -->
    {{--<script type="text/javascript" src="{{asset('assets/js/jquery.js')}}"></script>--}}
    {{--    <script type="text/javascript" src="{{asset('assets/js/bootstrap.js')}}"></script>--}}
    <script type="text/javascript" src="{{asset('assets/js/load.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/total_main.js')}}"></script>

    <!-- /MAIN EFFECT -->
    <script type="text/javascript" src="{{asset('/js/layer/layer.js')}}"></script>

    <!-- GAGE -->
    <script type="text/javascript" src="{{asset('assets/js/toggle_close.js')}}"></script>
    <script src="{{asset('assets/js/footable/js/footable.js?v=2-0-1')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/footable/js/footable.paginate.js?v=2-0-1')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/footable/js/footable.sort.js?v=2-0-1')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/footable/js/footable.filter.js?v=2-0-1')}}" type="text/javascript"></script>

    <script type="text/javascript">
        $(function () {
            $('#footable-res1').footable().bind('footable_filtering', function (e) {
                var selected = $('.filter-status').find(':selected').text();
                if (selected && selected.length > 0) {
                    if (selected == "全部请求") {
                        $('table.demo').trigger('footable_clear_filter');
                    } else {
                        e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
                        e.clear = !e.filter;
                    }
                }
            });
            $('.clear-filter').click(function (e) {
                e.preventDefault();
                $('.filter-status').val('全部请求');
                $('table.demo').trigger('footable_clear_filter');
            });
            $('.filter-status').change(function (e) {
                e.preventDefault();
                $('table.demo').trigger('footable_filter', {
                    filter: $('#filter').val()
                });
            });
        });
    </script>
    <script>

        function copyProject(url, id) {
            var u = '{{url('i')}}';
            u += '/';
            u += url;
            u += '/';
            u += id;
            u += '/dynamic_copy';
            {{--var ur = ;--}}
            $.post(u, {
                '_token': "{{csrf_token()}}"
            }, function (data) {
                if (data.success) {
                    layer.msg(data.data);
                    var u = '{{url('i')}}';
                    u += '/';
                    u += data.url;
                    u += '/';
                    u += data.id;
                    u += '/dynamic_edit';
                    {{--var ur = ;--}}
                    window.location.href = u;
                    event.stopPropagation();
//                        top.document.location.href='xxx.aspx?id=xx'
                } else {
                    layer.msg(data.data);
                }
            });
        }

        function editProject(url, id) {
            var u = '{{url('i')}}';
            u += '/';
            u += url;
            u += '/';
            u += id;
            u += '/dynamic_edit';
            {{--var ur = ;--}}
            window.location.href = u;
            event.stopPropagation();
        }

        function delProject(obj,$id) {
            //询问框
            layer.confirm('大...大神,您真的要删除本接口吗？', {
                btn: ['确定', '取消'], //按钮
                scrollbar: false,
                offset: '200px',
            }, function () {
                //
                $.post("{{url('i/').'/'.$url.'/'}}" + $id, {
                    '_method': 'delete',
                    '_token': "{{csrf_token()}}"
                }, function (data) {
                    if (data.status) {
                        layer.msg(data.msg, {icon: 6});
                        var footable = $('table').data('footable');

                        //get the row we are wanting to delete
                        var row = $(obj).parents('tr:first');

                        //delete the row
                        footable.removeRow(row);
//                        top.document.location.href='xxx.aspx?id=xx'
                    } else {
                        layer.msg(data.msg, {icon: 5});
                    }
                });
                layer.close(); //如果设定了yes回调，需进行手工关闭
            }, function () {

            });
            event.stopPropagation();
        }

        function changeStatus(obj, $id, $status) {
            if ($(obj).hasClass('label-success')) {
                $(obj).removeClass('label-success').addClass('label-default');
                $(obj).siblings().removeClass('label-success').addClass('label-default');
            } else {
                $(obj).removeClass('label-default').addClass('label-success');
                $(obj).siblings().removeClass('label-success').addClass('label-default');
            }
            //
            $.post("{{url('i/').'/'}}"+'{{$url}}'+'/' + $id + "/status/" + $status, {
                '_method': 'post',
                '_token': "{{csrf_token()}}"
            }, function (data) {
                if (data.status) {

                } else {
                }
            });

        }
    </script>
    {{--分组切换--}}
    {{-- <script type="text/javascript">
         $(function () {

             $('#footable-res2').footable().bind('footable_filtering', function (e) {
                 var selected = $('.filter-status').find(':selected').text();
                 if (selected && selected.length > 0) {
                     if (selected == "全部分组") {
                         $('table.demo').trigger('footable_clear_filter');
                     } else {
                         e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
                         e.clear = !e.filter;
                     }

                 }

             });

             $('.clear-filter').click(function (e) {
                 e.preventDefault();
                 $('.filter-status').val('请求方式');
                 $('table.demo').trigger('footable_clear_filter');
             });

             $('.filter-status').change(function (e) {
                 e.preventDefault();
                 $('table.demo').trigger('footable_filter', {
                     filter: $('#filter').val()
                 });
             });


         });
     </script>--}}
@endsection

