@extends($layout)

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">权限列表</h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                {{--<input type="text" name="table_search" class="form-control pull-right" placeholder="Search">--}}

                                {{--<div class="input-group-btn">--}}
                                    {{--<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>--}}
                                {{--</div>--}}

                            </div>
                            <button type="button" href="{{route('permission.create')}}" class="btn bg-olive margin">添加权限</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>名称</th>
                                <th>PID</th>
                                <th>路由名称</th>
                                <th>图标</th>
                                <th width="120">排序</th>
                                <th>是否为导航</th>
                                <th>操作</th>
                            </tr>
                            @foreach($permissions as $k=>$v)
                                <tr>
                                    <td>{{$v['id']}}</td>
                                    <td>{{$v['name']}}</td>
                                    <td>{{$v['pid']}}</td>
                                    <td>{{$v['route']}}</td>
                                    <td><i class="fa {{$v['icon']}}"></i> {{$v['icon']}}</td>
                                    <td><div class="input-group input-group-sm">
                                            <input type="text" class="form-control" value="{{$v['sort']}}">
                                            <span class="input-group-btn">
                                              <button type="button" class="btn btn-info btn-flat edit-sort" data-old="{{$v['sort']}}" data-id="{{$v['id']}}">Go!</button>
                                            </span>
                                        </div>
                                    </td>
                                    <td>@if($v['is_nav']) <span class="label label-success">是</span> @else <span class="label label-danger">否</span> @endif</td>
                                    <td>
                                        {{--<a href=""><span class="glyphicon glyphicon-edit">编辑</span></a>--}}
                                        {{--<a href=""><span class="glyphicon glyphicon-plus"></span></a>--}}
                                        {{--<a href=""><span class="glyphicon glyphicon-trash"></span></a>--}}

                                        <a href="{{route('permission.create',['pid'=>$v['id']])}}" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-plus"></span>添加</a>
                                        <a href="{{route('permission.edit',['id'=>$v['id']])}}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-edit"></span>编辑</a>
                                        <a href="{{route('permission.destroy',['id'=>$v['id']])}}" onclick="if(confirm('确认要删除吗？')==false)return false;" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span>删除</a>

                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
    </section>
@endsection

@push('footer')
    <script>
        /***修改排序请求***/
        $('.edit-sort').on('click',function(){
            var id = $(this).data('id');
            var old = $(this).data('old');
            var now = $(this).parent().prev('input').val();
            if(old == now){
                return false;
            }

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $.ajax({
                url:"{{route('permission.sort')}}",
                data:{id:id,sort:now},
                type:'POST',
                success:function(result){
                    alert(result.msg);
                    if(result.code == 0){
                        window.location.reload();
                    }
                }
            })
        })
    </script>
@endpush

