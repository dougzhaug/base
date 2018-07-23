@extends($layout)

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">角色管理</h3>

                        <div class="box-tools">
                            <button type="button" href="{{route('role.create')}}" class="btn bg-olive margin">添加角色</button>
                        </div>
                    </div>

                    <div class="box-header">

                        <form id="formSearch" class="form-horizontal">

                            {{--多功能输入框--}}
                            @include('admin.block.input_group')

                            <div class="search-input col-sm-1">
                                <button type="button" onclick="doSearch()" id="searchBtn" class="btn btn-block btn-info" value="查询">查询</button>
                            </div>
                        </form>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="tables" class="table table-bordered table-striped" data-url="{{route('role')}}">
                            <thead>
                            <tr>
                                <th data-name="id" data-sort="true">ID</th>
                                <th data-name="name">角色名称</th>
                                <th data-name="depict">描述</th>
                                <th data-name="created_at">创建时间</th>
                                <th data-name="">操作</th>
                            </tr>
                            </thead>
                            <tbody>

                            {{--DataTables插件--}}
                            @include('admin.block.data_tables')

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>角色名称</th>
                                <th>描述</th>
                                <th>创建时间</th>
                                <th>操作</th>
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
    <script>
        //DataTables 初始化
        var tables = DataTableLoad();

        /**
         * 操作按钮案例（这里的href最好用url，因为route会报错）
         */
        function getButton(data,type,row)
        {
            var html = '<a href="{{url('role/assign')}}?id='+data.id+'&name='+ data.name +'" class="btn btn-success btn-xs tables-create"><span class="glyphicon glyphicon-plus"></span>分配权限</a>';
                html += '<a href="javascript:void(0);" data-id="'+ data.id +'" data-name="'+ data.name +'" class="btn btn-primary btn-xs tables-edit"><span class="glyphicon glyphicon-edit"></span>编辑</a>';
                html += '<a href="javascript:void(0);" data-id="'+ data.created_at +'" class="btn btn-danger btn-xs tables-delete"><span class="glyphicon glyphicon-trash"></span>删除</a>';
            return html;
        }

        /**
         * 修改 （自定义）
         */
        $('body').on('click','.tables-edit',function(){
            var id = $(this).data('id')
            var name = $(this).data('name')
            alert(id+name);
        })

        /**
         * 删除 （自定义）
         */
        $('body').on('click','.tables-delete',function(){
            var id = $(this).data('id')
            alert(id);
        })
    </script>
@endpush