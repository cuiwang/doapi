@extends('common.base_layout')
@section('title','Do API - 日志信息')
@section('stylesheet')

  <!-- Bootstrap dataTables-->
  <link rel="stylesheet"
        href="https://cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.css">
  <link rel="stylesheet" href="{{asset('assets/css/api_total.css')}}">

  <style>

      .stack {
          font-size: 0.85em;
      }

      .date {
          min-width: 75px;
      }

      .text {
          word-break: break-all;
      }

  </style>

@endsection
@section('content')
    <div class="wrap-fluid">

        <!-- 导航条-->
        <ul id="breadcrumb" style="margin-top: 20px;margin-bottom: 20px;border-left: 5px solid #ff9a81;">
            </li>
            <li><i class="fa fa-lg fa-angle-right"></i>
            </li>
            <li><a href="#" title="Sample page 1">日志信息</a>
            </li>
        </ul>
        <!-- 导航条结束-->

<div class="content-wrap">
  <div class="row">
      <div class="col-md-12">
          <div class="nest">
          <div class="body-nest col-md-12">
                  <div class="body-nest">
                      <table id="table-log" class="table table-striped table-container">
                          <thead>
                          <tr>
                              <th>级别</th>
                              <th>日期</th>
                              <th>内容</th>
                          </tr>
                          </thead>
                          <tbody>

                          @foreach($logs as $key => $log)
                              <tr data-display="stack{{{$key}}}">
                                  <td class="text-{{{$log['level']}}}"><span class="glyphicon glyphicon-{{{$log['level']}}}-sign"
                                                                                   aria-hidden="true"></span> &nbsp;{{$log['level']}}</td>
                                  <td class="date">{{{$log['created_at']}}}</td>
                                  <td class="text">{{{$log['description']}}}</td>
                              </tr>
                          @endforeach

                          </tbody>
                      </table>
                  </div>
              <div>
              </div>
          </div>
          </div>
      </div>


  </div>
</div>
    </div>
@endsection

@section('javascript')
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="{{asset('/js/layer/layer.js')}}"></script>

<script>
  $(document).ready(function () {
    $('.table-container tr').on('click', function () {
      $('#' + $(this).data('display')).toggle();
    });
    $('#table-log').DataTable({
      "order": [1, 'desc'],
      "stateSave": true,
      "stateSaveCallback": function (settings, data) {
        window.localStorage.setItem("datatable", JSON.stringify(data));
      },
        "scrollY": "600px",
        "scrollCollapse": true,
        "columns": [
            { "width": "10%" },
            { "width": "10%" },
            null,
        ],
        "language": {
            "paginate": {
                "first": "第一页",
                "last": "最后一页",
                "next": "下一页",
                "previous": "上一页",
            },
            "search": "搜索:",
            "zeroRecords":    "没有匹配到数据",
            "decimal":        "",
            "emptyTable":     "暂无数据",
            "info":           "显示 _START_ 到 _END_ 总共 _TOTAL_ 项",
            "infoEmpty":      "显示 0 到 0 总共 0 项",
            "infoFiltered":   "(从 _MAX_ 记录中过滤)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "显示 _MENU_ 项",
        },
      "stateLoadCallback": function (settings) {
        var data = JSON.parse(window.localStorage.getItem("datatable"));
        if (data) data.start = 0;
        return data;
      }
    });
    $('#delete-log, #delete-all-log').click(function () {

        //询问框
        layer.confirm('您真的要删除吗？', {
            btn: ['确定', '取消'] //按钮
        }, function () {
            //
            layer.close(); //如果设定了yes回调，需进行手工关闭

            return true;

        }, function () {
            return false;
        });
    });
  });
</script>
@endsection