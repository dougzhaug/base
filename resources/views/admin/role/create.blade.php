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
                    <div class="box-header with-border">
                        <h3 class="box-title">添加角色</h3>
                    </div>
                    <div class="box-header ">
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="POST" action="{{route('role.store')}}">

                        {{ csrf_field() }}

                        <div class="box-body">
                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-sm-4 control-label">角色名称</label>

                                <div class="col-sm-4">
                                    <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="名称" required>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('depict') ? ' has-error' : '' }}">
                                <label for="phone" class="col-sm-4 control-label">描述</label>

                                <div class="col-sm-4">
                                    <input id="phone" type="text" name="depict" class="form-control" value="{{ old('depict') }}" placeholder="描述">
                                    @if ($errors->has('depict'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('depict') }}</strong>
                                    </span>
                                    @endif
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
            //$('.select2').select2();

            //Flat red color scheme for iCheck
            // $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            //     checkboxClass: 'icheckbox_flat-green',
            //     radioClass   : 'iradio_flat-green'
            // })
        })
    </script>
@endpush