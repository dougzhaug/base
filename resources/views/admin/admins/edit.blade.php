@extends($layout)

@push('link')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{admin_asset('bower_components/select2/dist/css/select2.min.css')}}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{admin_asset('plugins/iCheck/all.css')}}">
@endpush

@section('box')

    <!-- box-header -->
    <div class="box-header ">
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" method="POST" action="{{route('admins.update',[$admin['id']])}}">

        {{ csrf_field() }}
        {{ method_field('PATCH')}}

        <div class="box-body">

            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-sm-2 control-label">用户名</label>

                <div class="col-sm-9">
                    <input id="name" type="text" name="name" class="form-control" value="{{$admin['name'] or old('name') }}" placeholder="名称" required>
                    @if ($errors->has('name'))
                        <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="phone" class="col-sm-2 control-label">手机号</label>

                <div class="col-sm-9">
                    <input id="phone" type="text" name="phone" class="form-control" value="{{$admin['phone'] or old('phone') }}" placeholder="手机号" required>
                    @if ($errors->has('phone'))
                        <span class="help-block">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-sm-2 control-label">E-mail</label>

                <div class="col-sm-9">
                    <input id="email" type="email" name="email" class="form-control" value="{{$admin['email'] or old('email') }}" placeholder="电子邮箱">
                    @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-2 control-label">密码</label>

                <div class="col-md-9">
                    <input id="password" type="password" class="form-control" name="password">

                    @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('roles') ? ' has-error' : '' }}">
                <label for="permission" class="col-md-2 control-label">分配权限</label>
                <div class="col-md-9">
                    @include('layouts.plugins.Select2',['name'=>'roles[]','options'=>$roles,'multiple'=>true,'selected'=> $admin_roles ?? old('roles')])

                    @if ($errors->has('roles'))
                        <span class="help-block">{{$errors->first('roles')}}</span>
                    @endif

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
@endsection

