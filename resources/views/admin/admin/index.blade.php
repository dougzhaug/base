@extends($layout)

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">

                        <form id="formSearch" class="form-horizontal" method="POST" action="{{route('admin')}}">

                            {{--多功能输入框--}}
                            @include('admin.block.input_group')

                            {{--时间选择器--}}
                            @include('admin.block.date_range')

                            <div class="search-input col-sm-1">
                                <button type="button" onclick="doSearch()" id="searchBtn" class="btn btn-block btn-info" value="查询">查询</button>
                            </div>
                        </form>

                        <div class="box-tools">
                            <button type="button" href="{{route('admin.create')}}" class="btn bg-olive margin">添加管理员</button>
                        </div>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="tables" class="table table-bordered table-striped" data-url="{{route('admin')}}">
                            <thead>
                            <tr>
                                <th data-name="id" data-sort="true">ID</th>
                                <th data-name="name">姓名</th>
                                <th data-name="phone">手机号码</th>
                                <th data-name="email" data-sort="true" data-default-sort="desc">E-mail</th>
                                <th data-name="created_at">注册时间</th>
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
    <script>
        /**
         * DataTables 初始化
         */
        var tables = DataTableLoad();


        /**
         * 重构操作栏
         *
         * @param data
         * @param type
         * @param row
         * @returns {string}
         */
        function getButton(data,type,row)
        {
            var html = '';
            html += '<a href="{{url('admin/edit')}}/'+data.id+'" class="btn btn-primary btn-xs tables-edit"><span class="glyphicon glyphicon-edit"></span>编辑</a>';
            html += '<a href="{{url('admin/destroy')}}/'+data.id+'" class="btn btn-danger btn-xs tables-delete"><span class="glyphicon glyphicon-trash"></span>删除</a>';
            return html;
        }

        /**
         * 删除 （自定义）
         */
        $('body').on('click','.tables-delete',function(){
            if(!confirm('确认要删除吗')){
                return false;
            }
        });
    </script>
@endpush