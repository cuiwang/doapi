@extends('common.base_console')
@section('title','Do API - 控制台')
@section('user_stylesheets')
    @parent
    <!--USER STYLESHEETS -->
    <link rel="stylesheet" href="{{asset('css/user_console.css')}}">
    <!--表格风格-->
    <link href="{{asset('assets/js/footable/css/footable.core.css?v=2-0-1')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/js/footable/css/footable.standalone.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/js/footable/css/footable-demos.css')}}" rel="stylesheet" type="text/css">
@endsection


@section('user_content')

    <div class="page-header">
        <div class="container">
            <h1>我的产品
                <small style="float: right;">管理我的产品</small>
            </h1>
        </div>
    </div>
    <div class="container">
        <button type="button" class="btn btn-default pull-right"
                onclick="javascrtpt:window.location.href='{{url('main/project/create')}}'"><i class="fa fa-plus">
                添加产品</i></button>
    </div>
    <div class="container" id="section">
        <table class="table-striped footable-res footable metro-blue" data-page-size="10">
            <thead>
            <tr>
                <th data-sort-ignore="true" style="text-align: center">图标</th>
                <th data-sort-ignore="true" style="text-align: center">名称</th>
                <th data-sort-ignore="true" style="text-align: center">服务器默认地址
                    <small>(接口文档中可以修改)</small>
                </th>
                <th data-sort-ignore="true">说明</th>
            {{--<th>支持平台 <i class="fa fa-apple"></i> <i class="fa fa-android"></i> <i class="fa fa-ellipsis-h"></i> </th>--}}
            <!--<th>平台</th>-->
                <th data-sort-initial="descending" style="text-align: center">最后更新</th>
                <th data-sort-ignore="true" style="text-align: center">操作 <i class="fa fa-legal"></i></th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
                <tr onclick="showProject({{$project->id}})">
                    <td style="text-align: center" onclick="showProject({{$project->id}})"><img
                                src="{{$project->iconimg}}" width="40px" height="40px" alt=""/></td>
                    <td style="text-align: center" scope="row"
                        onclick="showProject({{$project->id}})">{{$project->name}}</td>
                    <td style="text-align: center" onclick="showProject({{$project->id}})"><label
                                href="{{url('i').'/'.$project->url}}"
                                role="button">{{url('i').'/'.$project->url}}</label></td>
                    {{--<td><label class="label label-default" href="#" role="button">Web</label> <label class="label label-default" href="#" role="button">iOS</label> <label class="label label-default" href="#" role="button">Android</label> <label class="label label-default" href="#" role="button">其他客户端</label></td>--}}
                    <td onclick="showProject({{$project->id}})">{{mb_strlen($project->description)>30?mb_substr($project->description,0,30).'...':$project->description}}</td>
                    {{--<td style="word-wrap: break-word;word-break: normal; " onclick="showProject({{$project->id}})">{{$project->description}}</td>--}}
                    {{-- @if ($project->status==='0')
                     <td><span class="label label-warning">停止</span></td>
                     @else
                         <td><span class="label label-info">运行</span></td>
                     @endif--}}

                    <td style="text-align: center" onclick="showProject({{$project->id}})">
                        <h6>{{$project->updated_at}}</h6>{{$project->updated_at->diffForHumans()}}</td>
                    <td style="text-align: center" onclick="showProject({{$project->id}})">
                        @if($project->role == 'admin')
                            <button class="btn btn-info" style="margin-bottom: 5px"
                                    onclick="showProject({{$project->id}})">查看
                            </button>
                            <button class="btn btn-warning " style="margin-bottom: 5px"
                                    onclick="editProject({{$project->id}})">编辑
                            </button>
                            <button class="btn btn-danger" style="margin-bottom: 5px"
                                    onclick="delProject({{$project->id}})">删除
                            </button>
                        @elseif($project->role == 'writer')
                            <button class="btn btn-info" onclick="showProject({{$project->id}})">查看</button>
                        @else
                            <button class="btn btn-info" onclick="showProject({{$project->id}})">查看</button>
                        @endif
                    </td>

                </tr>
            @endforeach

            </tbody>
        </table>
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
    <script src="{{asset('assets/js/footable/js/footable.js?v=2-0-1')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/footable/js/footable.paginate.js?v=2-0-1')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/footable/js/footable.sort.js?v=2-0-1')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/footable/js/footable.filter.js?v=2-0-1')}}" type="text/javascript"></script>

    <script type="text/javascript">
        $('.footable-res').footable();

        function delProject($id) {
            //询问框
            layer.confirm('大...大神,您真的要删除本产品吗？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                //
                $.post("{{url('main/project/delete').'/'}}" + $id, {
                    '_method': 'post',
                    '_token': "{{csrf_token()}}"
                }, function (data) {
                    if (data.status) {
                        layer.msg(data.msg, {icon: 6});
                        location.reload();
                    } else {
                        layer.msg(data.msg, {icon: 5});
                    }
                });
                layer.close(); //如果设定了yes回调，需进行手工关闭
            }, function () {

            });
            event.stopPropagation();
        }

        function editProject($id) {
            var u = "/main/project/" + $id + "/edit";
            {{--var ur = ;--}}
                window.location.href = u;
            event.stopPropagation();
        }

        function showProject($id) {
            var u = "/i/project/" + $id;
            {{--var ur = ;--}}
                window.location.href = u;
            event.stopPropagation();
        }
    </script>
@endsection
