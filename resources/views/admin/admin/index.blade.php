@extends($layout)

@push('head')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{admin_asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endpush

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">管理员管理</h3>

                        <div class="box-tools">
                            <button type="button" href="{{route('admin.create')}}" class="btn bg-olive margin">添加管理员</button>
                        </div>
                    </div>

                    <div class="box-header">
                        <from class="form-horizontal" method="POST" action="{{route('admin')}}">

                            <div class="input-group margin col-sm-2" style="float:left;margin: 0 0 0 10px;">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Action
                                        <span class="fa fa-caret-down"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>
                                <!-- /btn-group -->
                                <input type="text" class="form-control">
                            </div>

                            <div class="input-group margin col-sm-2" style="float:left;margin: 0 0 0 10px;">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-info btn-flat">Action</button>
                                    <button type="button" class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown" style="padding-right: 6px;padding-left: 6px;">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>

                                <input type="text" class="form-control">
                            </div>

                            <div class="col-sm-2">
                                <input id="name" type="text" name="name" class="form-control" placeholder="用户名">
                            </div>
                            <div class="col-sm-1">
                                <input type="submit" class="btn btn-block btn-info" value="查询">
                            </div>
                        </from>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="tables" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>姓名</th>
                                <th>手机号码</th>
                                <th>E-mail</th>
                                <th>注册时间</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>姓名</th>
                                <th>手机号码</th>
                                <th>E-mail</th>
                                <th>注册时间</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection

@push('footer')
    <!-- DataTables -->
    <script src="{{admin_asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{admin_asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

    <script>
        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#tables').DataTable({
                serverSide: true,                   //开启服务器模式
                ajax: {                             //AJAX请求设置
                    url:'{{route('admin')}}',
                    type: 'POST',
                    data:{id:11,name:'张三'},        //额外参数
                },

                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'phone' },
                    { data: 'email' },
                    { data: 'created_at' },
                ],
                paging      : true,                 //是否分页
                lengthChange: true,                 //每页显示多少条
                searching  : false,                 //搜索
                ordering   : true,                  //排序
                info        : true,                 //左下角信息
                autoWidth   : false,                //宽度自适应
                aaSorting: [[1, "asc"]],            //默认排序
                aoColumnDefs: [ { "bSortable": false, "aTargets": [ 0 , 2] }],      //禁止那些列不可以排序
            })
        })
    </script>
@endpush