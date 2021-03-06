@extends($layout)

@section('box')

    <div class="box-header ">
    </div>
    <!-- /.box-header -->
    <form class="form-horizontal" action="{{url('roles')}}" method="post" onsubmit="return getContainUndetermined()">
        {{ csrf_field() }}

        <div class="box-body">
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="inputAlias" class="col-sm-2 control-label">名称*</label>
                <div class="col-sm-9">
                    <input name="name" type="text" value="{{ old('name') }}" class="form-control" id="inputAlias" placeholder="名称">
                    @if ($errors->has('name'))
                        <span class="help-block">{{$errors->first('name')}}</span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('depict') ? ' has-error' : '' }}">
                <label for="inputName" class="col-sm-2 control-label">描述</label>
                <div class="col-sm-9">
                    <input name="depict" type="text" value="{{ old('depict') }}" class="form-control" id="inputName" placeholder="角色描述">
                    @if ($errors->has('depict'))
                        <span class="help-block">{{$errors->first('depict')}}</span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">状态</label>
                <div class="col-sm-9">

                    {{-- Switchery 开关插件 --}}
                    @include('layouts.plugins.Switchery',['name'=>'status'])

                </div>
            </div>

            <div class="form-group {{ $errors->has('permissions') ? ' has-error' : '' }}" >
                <label for="permissions" class="col-sm-2 control-label">权限</label>
                <div class="col-sm-9">

                    {{--JsTree插件--}}
                    @include('layouts.plugins.JsTree',['url'=>url('roles/permission_tree'),'name'=>'permissions'])

                    @if ($errors->has('permissions'))
                        <span class="help-block">{{$errors->first('permissions')}}</span>
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
@endsection

@push('script')
    <script>
        //树状结构背景设置
        $('#js-tree').css({'border':'1px solid #96c2f1','background':'#eff7ff','padding':'10px'});
    </script>
@endpush