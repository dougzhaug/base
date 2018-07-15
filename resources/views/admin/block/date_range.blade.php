@push('head')
    @parent
<!-- daterange picker -->
<link rel="stylesheet" href="{{admin_asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
@endpush

@switch(isset($type)?$type:'')
    @case('date-picker')
        <!-- Date -->
        <div class="form-group search-input col-sm-2">
            {{--<label>Date:</label>--}}

            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker" placeholder="">
            </div>
            <!-- /.input group -->
        </div>
        <!-- /.form group -->
        @break
    @case('range-picker')
        <!-- Date range -->
        <div class="form-group search-input col-sm-3">
            {{--<label>Date range:</label>--}}

            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="reservation">
            </div>
            <!-- /.input group -->
        </div>
        <!-- /.form group -->
        @break
    @case('time-range-picker')
        <!-- Date and time range -->
        <div class="form-group search-input col-sm-3">
            {{--<label>Date and time range:</label>--}}

            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </div>
                <input type="text" class="form-control pull-right" id="reservationtime">
            </div>
            <!-- /.input group -->
        </div>
        <!-- /.form group -->
        @break
    @case('data-time-range-picker')
        <!-- Date and time range -->
        <div class="form-group search-input col-sm-2">
            {{--<label>Date range button:</label>--}}

            <div class="input-group">
                <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                            <span>
                              <i class="fa fa-calendar"></i> 时间范围
                            </span>
                    <i class="fa fa-caret-down"></i>
                </button>
            </div>
        </div>
        <!-- /.form group -->
        @break
    @default
        <!-- Date range -->
        <div class="form-group search-input col-sm-3">
            {{--<label>Date range:</label>--}}

            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="date_range" class="form-control pull-right" id="reservation">
            </div>
            <!-- /.input group -->
        </div>
        <!-- /.form group -->
@endswitch

@push('footer')
    @parent
    <!-- date-range-picker -->
    <script src="{{admin_asset('bower_components/moment/min/moment.min.js')}}"></script>
    <script src="{{admin_asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{admin_asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

    <script>
        $(function () {
            var start_date = {{$start_date or 'false'}};
            var end_date = {{$end_date or 'false'}};

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            })

            //Date range picker
            $('#reservation').daterangepicker({
                startDate: start_date ? start_date : moment().startOf('day'),
                endDate: end_date ? end_date : moment(),
                //minDate: '01/01/2012',    //最小时间
                maxDate : moment(), //最大时间
                dateLimit : {
                    days : {{$date_limit or 31}},                              //起止时间的最大间隔
                },
                timePicker: {{$time_picker or 'false'}},                        //是否小时分钟可选
                timePicker12Hour: true,         //开启24小时格式
                showDropdowns : {{$show_dropdowns or 'false'}},                  //年份和月份是否可选
                // applyClass : 'btn-small btn-primary blue',   //样式
                // cancelClass : 'btn-small',
                locale: {
                    format: "{{$format or config('daterangepicker.format')}}",                      //时间格式
                    separator: "{{$separator or config('daterangepicker.separator')}}",                       //分隔符
                    applyLabel: "应用",
                    cancelLabel: "取消",
                    resetLabel: "重置",
                    daysOfWeek : [ '日', '一', '二', '三', '四', '五', '六' ],
                    monthNames : [ '一月', '二月', '三月', '四月', '五月', '六月',
                        '七月', '八月', '九月', '十月', '十一月', '十二月' ],
                    // firstDay : 1
                }
            })

            //Date range picker with time picker
            $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'YYYY-MM-DD h:mm A' })

            //Date range as a button
            $('#daterange-btn').daterangepicker(
                {
                    timePicker12Hour: true,
                    timePicker: true,
                    locale: {
                        format: 'YYYY-MM-DD HH:mm:ss',
                        separator: ' ~ ',
                        applyLabel: "应用",
                        cancelLabel: "取消",
                        resetLabel: "重置",
                        customRangeLabel:"自定义范围",
                        daysOfWeek : [ '日', '一', '二', '三', '四', '五', '六' ],
                        monthNames : [ '一月', '二月', '三月', '四月', '五月', '六月',
                            '七月', '八月', '九月', '十月', '十一月', '十二月' ],
                        firstDay : 1
                    },
                    ranges   : {
                        '今天'       : [moment(), moment()],
                        '昨天'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        '最近7天' : [moment().subtract(6, 'days'), moment()],
                        '最近30天': [moment().subtract(29, 'days'), moment()],
                        '这个月'  : [moment().startOf('month'), moment().endOf('month')],
                        '上个月'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate  : moment(),

                },
                function (start, end) {
                    $('#daterange-btn span').html(start.format('YYYY-MM-DD') + ' ~ ' + end.format('YYYY-MM-DD'))
                }
            )
        })
    </script>
@endpush