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
                    {{--<div class="box-header with-border">--}}
                        {{--<h3 class="box-title">添加管理员</h3>--}}
                    {{--</div>--}}
                    <div class="box-header ">
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="POST" action="{{route('admin.store')}}">

                        {{ csrf_field() }}

                        <div class="box-body">
                            {{--<div class="form-group">--}}
                                {{--<label class="col-sm-2 control-label">父节点</label>--}}
                                {{--<div class="col-sm-8">--}}
                                    {{--<select name="pid" class="form-control select2">--}}
                                        {{--<option value="0" data-depth="1" data-ancestor_ids="">顶级</option>--}}
                                        {{--{!!$permission!!}--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-sm-4 control-label">用户名</label>

                                <div class="col-sm-4">
                                    <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="名称" required>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone" class="col-sm-4 control-label">手机号</label>

                                <div class="col-sm-4">
                                    <input id="phone" type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="手机号" required>
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-sm-4 control-label">E-mail</label>

                                <div class="col-sm-4">
                                    <input id="email" type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="电子邮箱">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">密码</label>

                                <div class="col-md-4">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="permission" class="col-md-4 control-label">分配权限</label>
                                <div class="col-md-4">
                                    <select id="permissions" name="permissions[]" class="form-control select2" multiple="multiple" data-placeholder="可多选"
                                            style="width: 100%;">

                                        @foreach($roles as $k=>$v)
                                            <option value="{{$v['name']}}">{{$v['name']}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="permission" class="col-md-4 control-label">富文本框</label>
                                <div class="col-md-8">

                                    {{--CK-Editor5 富文本框--}}
                                    @include('slot.wang_editor')

                                    {{--Uploader图片上传插件--}}
                                    @uploader('assets')
                                    @uploader(['name' => 'avatar', 'max' => 3, 'accept' => 'jpg,png,gif'])
                                </div>
                            </div>

                            <!-- /.form-group -->
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