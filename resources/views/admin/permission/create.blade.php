@extends('admin.layouts.fixed')

@section('head')
    {{--<!-- daterange picker -->--}}
    {{--<link rel="stylesheet" href="{{admin_asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">--}}
    {{--<!-- bootstrap datepicker -->--}}
    {{--<link rel="stylesheet" href="{{admin_asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">--}}
    {{--<!-- iCheck for checkboxes and radio inputs -->--}}
    {{--<link rel="stylesheet" href="{{admin_asset('plugins/iCheck/all.css')}}">--}}
    {{--<!-- Bootstrap Color Picker -->--}}
    {{--<link rel="stylesheet" href="{{admin_asset('bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">--}}
    {{--<!-- Bootstrap time Picker -->--}}
    {{--<link rel="stylesheet" href="{{admin_asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">--}}
    <!-- Select2 -->
    <link rel="stylesheet" href="{{admin_asset('bower_components/select2/dist/css/select2.min.css')}}">
@endsection

@section('content')
    <section class="content-header">
        <h1>
            权限管理
            <small>13 new messages</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('')}}"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">权限管理</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Horizontal Form</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">父节点</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2" style="width: 100%;">
                                        <option selected="selected">Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">权限名称</label>

                                <div class="col-sm-8">
                                    <input type="" class="form-control" id="inputEmail3" placeholder="名称">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label">权限路由</label>

                                <div class="col-sm-8">
                                    <input type="" class="form-control" id="inputPassword3" placeholder="URL">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> 是否在导航中显示
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-info pull-right">Sign in</button>
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

@section('footer')
    <!-- Select2 -->
    <script src="{{admin_asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <!-- InputMask -->
    {{--<script src="{{admin_asset('plugins/input-mask/jquery.inputmask.js')}}"></script>--}}
    {{--<script src="{{admin_asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>--}}
    {{--<script src="{{admin_asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>--}}
    {{--<!-- date-range-picker -->--}}
    {{--<script src="{{admin_asset('bower_components/moment/min/moment.min.js')}}"></script>--}}
    {{--<script src="{{admin_asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>--}}
    {{--<!-- bootstrap datepicker -->--}}
    {{--<script src="{{admin_asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>--}}
    {{--<!-- bootstrap color picker -->--}}
    {{--<script src="{{admin_asset('bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>--}}
    {{--<!-- bootstrap time picker -->--}}
    {{--<script src="{{admin_asset('plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>--}}
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
        })
    </script>
@endsection