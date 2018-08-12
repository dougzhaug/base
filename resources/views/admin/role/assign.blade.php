@extends($layout)

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">分配权限</h3>
                    </div>
                    <div class="box-header ">
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal form-role" method="POST" action="{{route('role.assign',[1])}}" onsubmit="return getPermissions()">

                        {{ csrf_field() }}

                        {{--DataTables插件--}}
                        @include('admin.block.js_tree',['name'=>'permissions'])

                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">取消</button>
                            <button type="submit" class="btn btn-info pull-right" >提交</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
    </section>
@endsection