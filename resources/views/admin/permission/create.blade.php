@extends($layout)

@push('head')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{admin_asset('bower_components/select2/dist/css/select2.min.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{admin_asset('plugins/iCheck/all.css')}}">
@endpush

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="POST" action="{{route('permission.store')}}">

                        {{ csrf_field() }}

                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">父节点</label>
                                <div class="col-sm-6">
                                    <select name="pid" class="form-control select2">
                                        <option value="0" data-depth="1" data-ancestor_ids="">顶级</option>
                                        {!!$permission!!}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-sm-3 control-label">权限名称</label>

                                <div class="col-sm-6">
                                    <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="名称" required>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label">权限路由</label>

                                <div class="col-sm-6">
                                    <input type="text" name="route" class="form-control" placeholder="路由别名">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label">图标</label>

                                <div class="col-sm-6">
                                    <input type="text" name="icon" class="form-control" placeholder="icon">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label">排序</label>

                                <div class="col-sm-6">
                                    <input type="text" name="sort" class="form-control" placeholder="0">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="is_nav" class="flat-red">
                                            是否在导航中显示
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">取消</button>
                            <button type="submit" class="btn btn-info pull-right">提交</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!-- /.row -->
    </section>
@endsection

@push('footer')
    <!-- Select2 -->
    <script src="{{admin_asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{admin_asset('plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();

            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass   : 'iradio_flat-green'
            })
        })
    </script>
@endpush