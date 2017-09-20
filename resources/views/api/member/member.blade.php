@extends('common.base_layout')
@section('title','Do API - 产品成员')
@section('stylesheet')
    <link rel="stylesheet" href="{{asset('assets/css/api_total.css')}}">
    <!--表格风格-->
    <link href="{{asset('assets/js/footable/css/footable.core.css?v=2-0-1')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/js/footable/css/footable.standalone.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/js/footable/css/footable-demos.css')}}" rel="stylesheet" type="text/css">
    {{--模态窗口--}}
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.0/css/iziModal.min.css" rel="stylesheet" type="text/css">--}}
@endsection
@section('content')

    <div class="wrap-fluid">
        <!-- 导航条-->
        <ul id="breadcrumb" style="margin-top: 20px;border-left: 5px solid #FFA200;">
            </li>
            <li><i class="fa fa-lg fa-angle-right"></i>
            </li>
            <li><a href="#" title="Sample page 1">产品成员</a>
            </li>
        </ul>
        <!-- 导航条结束-->


        <!--成员信息-->
        <div class="content-wrap">
            <div class="row">

                <div class="col-sm-12">

                    <div class="nest" id="FootableClose">

                        <div class="title-alt">
                            <h6>
                                成员列表</h6>

                        </div>


                        <div class="body-nest" id="Footable">

                            <p class="lead well">
                                成员人数: <strong>{{$size}}</strong>
                            </p>

                            @if ($user_role == 'admin')
                            <div class="well">

                                <form class="form-inline" action="{{url('i/'.$project->url.'/members/addMember')}}" method="POST">
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <label for="invitation-name">姓名</label>
                                        <input type="text" class="form-control" name="name" id="invitation-name" placeholder="请输入对方称呼">
                                    </div>
                                    <div class="form-group">
                                        <label for="invitation-email">邮箱</label>
                                        <input type="email" class="form-control" name="email" id="invitation-email" placeholder="请输入对方邮箱地址">
                                    </div>
                                    <button type="button" class="btn btn-warning" onclick="sendInvitation()">发送邀请</button>
                                </form>


                            </div>
                            @endif

                            <table class="table-striped footable-res footable metro-blue   toggle-arrow-small"
                                   data-page-size="10">
                                <thead>
                                <tr>

                                    <th data-hide="all">
                                        可用权限
                                    </th>

                                    <th data-hide="all">
                                        加入时间
                                    </th>

                                    <th data-sort-ignore="true" data-toggle="true">

                                    </th>
                                    <th data-sort-ignore="true" style="text-align: center">
                                        邮箱
                                    </th>
                                    <th data-hide="all">
                                        手机号
                                    </th>
                                    <th data-hide="all">
                                        公司
                                    </th>
                                    <th data-sort-ignore="true" style="text-align: center">
                                        角色
                                    </th>

                                    <th data-sort-ignore="true" style="text-align: center">
                                        操作
                                    </th>
                                    {{-- <th>
                                         操作
                                     </th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($members as $member)
                                    <tr id="tr_{{$member[0]->id}}">
                                        <td>

                                            @if ($member['role'] == 'admin')
                                                <label class="label label-default">增加</label>
                                                <label class="label label-default">删除</label>
                                                <label class="label label-default">修改</label>
                                                <label class="label label-default">查询</label>
                                            @elseif ($member['role'] == 'writer')
                                                <label class="label label-default">增加</label>
                                                <label class="label label-default">修改</label>
                                                <label class="label label-default">查询</label>
                                            @else
                                                <label class="label label-default">查询</label>
                                            @endif

                                        </td>

                                        <td>{{$member[0]->updated_at->diffForHumans()}}</td>

                                        <td>
                                            <img width="50px" height="50px" alt="" class="admin-pic img-circle"
                                                 src="{{$member[0]->headimg}}">
                                            <span style="color: #333;font-size: 1.3em">{{base64_decode($member[0]->name)}}</span>
                                            @if ($member['status'] == '已加入')
                                                <span class="text-success">(已加入)</span>
                                            @elseif($member['status'] == '已邀请')
                                                <span class="text-warning">(已邀请)</span>
                                            @endif


                                        </td>
                                        <td style="text-align: center">{{$member[0]->email}}</td>
                                        <td>
                                            {{$member[0]->phone}}</td>
                                        <td>{{$member[0]->company}}</td>
                                        <td style="text-align: center">{{$member['role']}}</td>
                                        <td style="text-align: center">

                                            @if ($user_role == 'admin')
                                                @if($user->id != $member[0]->id)

                                                    @if ($member['status'] == '已加入')
                                                        <a class="btn btn-info" onclick="transformToOther({{$member[0]->id}})"
                                                        >转让产品
                                                        </a>
                                                        <a class="btn btn-warning" onclick="modifyRole('{{$member['role']}}','{{$member[0]->id}}')"
                                                        >修改角色
                                                        </a>
                                                        <a class="btn btn-danger"
                                                           onclick="delMember('{{$member[0]->id}}')">
                                                            删除成员
                                                        </a>
                                                    @elseif($member['status'] == '已邀请')
                                                        <a class="btn btn-warning" onclick="sendAgainInvitation('{{$member[0]->name}}','{{$member[0]->email}}')"
                                                        >再次邀请
                                                        </a>
                                                        <a class="btn btn-danger"
                                                           onclick="delProject(this,'{{$member[0]->id}}')">
                                                            删除成员
                                                        </a>
                                                    @endif

                                                @else
                                                    <span class="label label-info">本人</span>
                                                @endif
                                            @else
                                                @if($user->id == $member[0]->id)
                                                    <span class="label label-info">本人</span>
                                                    @else
                                                    <span class="label label-default">无权</span>
                                                @endif
                                               {{-- <a class="btn btn-success"
                                                >邀请
                                                </a>--}}
                                            @endif

                                        </td>

                                    </tr>
                                @endforeach

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

                    </div>

                </div>

            </div>
        </div>
        <!--成员信息结束-->
    </div>


@endsection


@section('javascript')

    {{--footable--}}
    <script src="{{asset('assets/js/footable/js/footable.js?v=2-0-1')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/footable/js/footable.paginate.js?v=2-0-1')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/footable/js/footable.sort.js?v=2-0-1')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/footable/js/footable.filter.js?v=2-0-1')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $('.footable-res').footable();
        });
    </script>
    {{--/footable--}}
    {{--layer--}}
    <script type="text/javascript" src="{{asset('/js/layer/layer.js')}}"></script>
    {{--/layer--}}
    {{--user--}}
    <script type="text/javascript">
        layer.config({
            extend:'myskin/style.css',
            skin: 'layer-ext-myskin'
        });
        //删除成员
        function delMember(uid) {

            //询问框
            layer.confirm('您真的要删除此用户吗？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                //
                var url = "{{url('i/'.$project->url.'/members/delMember')}}"

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        '_token': '{{csrf_token()}}',
                        'uid':uid,
                    },
                    success: function(data){
                        layer.msg(data.data);
                        if (data.success) {
                            //删除成功
                            $('#tr_'+uid).remove();
                            window.parent.changeNumFromIframe('member_count','del')
                        }
                    },
                    error: function(xhr, type){
                        layer.closeAll();
                        layer.msg('网络异常');
                    }
                });

                layer.close(); //如果设定了yes回调，需进行手工关闭
            }, function () {

            });
            event.stopPropagation();
        }

        //转让给他
        function transformToOther(toid) {
            layer.confirm('转让后您将失去这个产品,确定转让吗?', {
                btn: ['确定','取消'] //按钮
            }, function(){
                //确定

                var url = "{{url('i/'.$project->url.'/members/transformToOther')}}"

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        '_token': '{{csrf_token()}}',
                        'toid':toid,
                    },
                    success: function(data){
                        layer.msg(data.data);
                        //退出到控制台
                        window.parent.goPage('{{url('main/console')}}');

                    },
                    error: function(xhr, type){
                        layer.msg('网络异常');
                    }
                });

            }, function(){
                //取消
                layer.msg('您取消了本次操作');
            });
        }

        //修改角色
        function modifyRole(role,toid) {

            if (role === 'writer') {
                layer.open({
                    title:'',
                    anim:1,
                    content: '<p style="font-size: 1.2em;color: #333">将角色转为只读状态?</p>'+'<p style="color: #666">writer角色可以对本产品 <strong style="color: #FF6B6B">阅读和编写</strong></p>' +
                    '<p style="color: #666">reader角色只能 <strong style="color: #FF6B6B">阅读</strong></p>'
                    ,btn: ['确定','取消']
                    ,yes: function(index, layero){
                        //按钮【按钮一】的回调
                        var url = "{{url('i/'.$project->url.'/members/changeRole')}}"

                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                '_token': '{{csrf_token()}}',
                                'toid':toid,
                                'torole':'reader',
                            },
                            success: function(data){
                                layer.msg(data.data);
                                location.reload();
                            },
                            error: function(xhr, type){
                                layer.msg('网络异常');
                            }
                        });



                        layer.closeAll();
                    }
                    ,btn2: function(index, layero){
                        //按钮【按钮二】的回调
                        //return false 开启该代码可禁止点击该按钮关闭
                    }
                    ,cancel: function(){
                        //右上角关闭回调

                        //return false 开启该代码可禁止点击该按钮关闭
                    }
                });
            }else {
                layer.open({
                    title:'',
                    anim:1,
                    content: '<p style="font-size: 1.2em;color: #333">将角色转为可读可写状态?</p>'+'<p style="color: #666">writer角色可以对本产品 <strong style="color: #FF6B6B">阅读和编写</strong></p>' +
                    '<p style="color: #666">reader角色只能 <strong style="color: #FF6B6B">阅读</strong></p>'
                    ,btn: ['确定','取消']
                    ,yes: function(index, layero){
                        //按钮【按钮一】的回调
                        var url = "{{url('i/'.$project->url.'/members/changeRole')}}"

                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                '_token': '{{csrf_token()}}',
                                'toid':toid,
                                'torole':'writer',
                            },
                            success: function(data){
                                layer.msg(data.data);
                                location.reload();
                            },
                            error: function(xhr, type){
                                layer.msg('网络异常');
                            }
                        });
                        layer.closeAll();
                    }
                    ,btn2: function(index, layero){
                        //按钮【按钮二】的回调
                        //return false 开启该代码可禁止点击该按钮关闭
                    }
                    ,cancel: function(){
                        //右上角关闭回调

                        //return false 开启该代码可禁止点击该按钮关闭
                    }
                });
            }



        }

        //        发送邀请
        function sendInvitation() {
            layer.msg('正在载入...', {
                icon: 16
                ,shade: 0.3
                ,time: 0
                ,id:250
            });
            var name = $("#invitation-name").val()
            var email = $("#invitation-email").val()
            var url = "{{url('i/'.$project->url.'/members/addMember')}}"

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    '_token': '{{csrf_token()}}',
                    'name':name,
                    'email':email
                },
                success: function(data){
//                alert(data.success);
                    layer.closeAll();
                    if (!data.success) {
                        if (data.position == 0) {
                            layer.tips(data.data, '#invitation-name', {
                                tips: [1, '#FF5722'] //还可配置颜色
                            });
                        }else {
                            layer.tips(data.data, '#invitation-email', {
                                tips: [1, '#FF5722'] //还可配置颜色
                            });
                        }
                    }else {
                        window.parent.changeNumFromIframe('member_count','add')
                        layer.msg('已发送,等待对方确认',function () {
                            window.location.reload();
                        });
                    }

                },
                error: function(xhr, type){
                    layer.closeAll();
                    layer.msg('网络异常');
                }
            });

        }
        //        再次发送邀请
        function sendAgainInvitation(name,email) {
            layer.msg('正在载入...', {
                icon: 16
                ,shade: 0.3
                ,time: 0
                ,id:250
            });
            var url = "{{url('i/'.$project->url.'/members/addAgainMember')}}"

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    '_token': '{{csrf_token()}}',
                    'name':name,
                    'email':email
                },
                success: function(data){
                    layer.closeAll();
                    if (!data.success) {
                        layer.msg(data.data);
                    }else {
                        layer.msg('已发送,等待对方确认');
                    }
                },
                error: function(xhr, type){
                    layer.closeAll();
                    layer.msg('网络异常');
                }
            });

        }
    </script>

    {{--/user--}}
@endsection