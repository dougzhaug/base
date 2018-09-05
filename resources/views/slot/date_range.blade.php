@push('head')
    @parent
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{admin_asset('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
@endpush

@switch(isset($type) ? $type : '')
    @case('date-picker')
        <!-- Date(1) -->
        <div class="form-group search-input col-sm-{{$col_sm or 2}}">
            {{--<label>Date:</label>--}}

            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                <input type="text" name="date_time" class="form-control pull-right" id="datepicker" placeholder="时间范围">
            </div>
            <!-- /.input group -->
        </div>
        <!-- /.form group -->
        @break
    @case('range-picker')
        <!-- Date range(2) -->
        <div class="form-group search-input col-sm-{{$col_sm or 3}}">
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
        @break
    @case('time-range-picker')
        <!-- Date and time range(3) -->
        <div class="form-group search-input col-sm-{{$col_sm or 3}}">
            {{--<label>Date and time range:</label>--}}

            <div class="input-group">
                <div class="input-group-addon">
                    <i class="fa fa-clock-o"></i>
                </div>
                <input type="text" name="date_range" class="form-control pull-right" id="reservationtime">
            </div>
            <!-- /.input group -->
        </div>
        <!-- /.form group -->
        @break
    @case('data-time-range-picker')
        <!-- Date and time range(4) -->
        <div class="form-group search-input col-sm-{{$col_sm or 3}}">
            {{--<label>Date range button:</label>--}}

            <div class="input-group">
                <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                            <span name="date_range">
                              <i class="fa fa-calendar"></i> 时间范围
                            </span>
                    <i class="fa fa-caret-down"></i>
                </button>
            </div>
        </div>
        <!-- /.form group -->
        @break
    @default
        <!-- Date range(2) -->
        <div class="form-group search-input col-sm-{{$col_sm or 3}}">
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
{{--    <script src="{{admin_asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>--}}

    <script>
        $(function () {
            var start_date = "{{$start_date or false}}";
            var end_date = "{{$end_date or false}}";

            var max_date = "{{$max_date or false}}";

            //Date picker(1)
            $('#datepicker').daterangepicker({
                autoApply: true,
                singleDatePicker: true,
                showDropdowns: true,
                autoUpdateInput: false,
                timePicker24Hour : true,
                timePicker : true,
                timePickerIncrement: {{$time_picker_increment or 10}},              //选择分钟的间隔
                locale: {
                    format: "{{$format or config('daterangepicker.format')}}",            //时间格式
                    applyLabel: "应用",
                    cancelLabel: "取消",
                    resetLabel: "重置",
                    daysOfWeek: [ '日', '一', '二', '三', '四', '五', '六' ],
                    monthNames: [ '一月', '二月', '三月', '四月', '五月', '六月',
                        '七月', '八月', '九月', '十月', '十一月', '十二月' ],
                }
            },function(start, end, label) {
                beginTimeTake = start;
                if(!this.startDate){
                    this.element.val('');
                }else{
                    this.element.val(this.startDate.format(this.locale.format));
                }
            })

            //Date range picker(2)
            $('#reservation').daterangepicker({
                autoApply: true,                                                    //自动确定
                startDate: start_date ? start_date : moment().startOf('day'),       //默认开始时间
                endDate: end_date ? end_date : moment(),                            //默认结束时间
                minDate: {{$min_date or 'false'}},                                  //最小时间
                maxDate: max_date ? max_date : moment(),                           //最大时间
                dateLimit: {
                    days: {{$date_limit or 31}},                                   //起止时间的最大间隔
                },
                timePicker: {{$time_picker or 'false'}},                            //是否小时分钟可选
                timePickerIncrement: {{$time_picker_increment or 10}},              //选择分钟的间隔
                timePicker12Hour: true,                                             //开启24小时格式
                showDropdowns: {{$show_dropdowns or 'false'}},                     //年份和月份是否可选
                 // applyClass : 'btn-small btn-primary blue',   //样式
                 // cancelClass : 'btn-small',
                locale: {
                    format: "{{$format or config('daterangepicker.format')}}",            //时间格式
                    separator: "{{$separator or config('daterangepicker.separator')}}",   //分隔符
                    applyLabel: "应用",
                    cancelLabel: "取消",
                    resetLabel: "重置",
                    daysOfWeek: [ '日', '一', '二', '三', '四', '五', '六' ],
                    monthNames: [ '一月', '二月', '三月', '四月', '五月', '六月',
                        '七月', '八月', '九月', '十月', '十一月', '十二月' ],

                },

            })

            //Date range picker with time picker(3)
            $('#reservationtime').daterangepicker({
                autoApply: true,                                                    //自动确定
                timePicker: true,
                timePickerIncrement: {{$time_picker_increment or 10}},                  //选择分钟的间隔
                locale: {
                    format: "{{$format or config('daterangepicker.format')}}",            //时间格式
                    separator: "{{$separator or config('daterangepicker.separator')}}",   //分隔符
                    applyLabel: "应用",
                    cancelLabel: "取消",
                    resetLabel: "重置",
                    daysOfWeek: [ '日', '一', '二', '三', '四', '五', '六' ],
                    monthNames: [ '一月', '二月', '三月', '四月', '五月', '六月',
                        '七月', '八月', '九月', '十月', '十一月', '十二月' ],
                },
            })

            //Date range as a button(4)
            $('#daterange-btn').daterangepicker(
                {
                    autoApply: true,                                                    //自动确定
                    startDate: start_date ? start_date : moment().subtract(29, 'days'), //默认开始时间
                    endDate: end_date ? end_date : moment(),                            //默认结束时间
                    minDate: {{$min_date or 'false'}},                                  //最小时间
                    maxDate: max_date ? max_date : moment(),                            //最大时间

                    timePicker12Hour: true,
                    timePickerIncrement: {{$time_picker_increment or 10}},              //选择分钟的间隔
                    timePicker: {{$time_picker or 'false'}},
                    showDropdowns : {{$show_dropdowns or 'false'}},                     //年份和月份是否可选
                    locale: {
                        format: "{{$format or config('daterangepicker.format')}}",            //时间格式
                        separator: "{{$separator or config('daterangepicker.separator')}}",   //分隔符
                        applyLabel: "应用",
                        cancelLabel: "取消",
                        resetLabel: "重置",
                        customRangeLabel:"自定义范围",
                        daysOfWeek: [ '日', '一', '二', '三', '四', '五', '六' ],
                        monthNames: [ '一月', '二月', '三月', '四月', '五月', '六月',
                            '七月', '八月', '九月', '十月', '十一月', '十二月' ],
                        firstDay : 1
                    },
                    ranges   : {
                        '今天'       : [moment(), moment()],
                        '昨天'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        '最近7天' : [moment().subtract(6, 'days'), moment()],
                        '最近30天': [moment().subtract(29, 'days'), moment()],
                        '本月'  : [moment().startOf('month'), moment().endOf('month')],
                        '上个月'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                },
                function (start, end) {
                    $('#daterange-btn span').html(start.format("{{$format or config('daterangepicker.format')}}") + "{{$separator or config('daterangepicker.separator')}}" + end.format("{{$format or config('daterangepicker.format')}}")+'<input type="hidden" name="date_range" value="'+start.format("{{$format or config('daterangepicker.format')}}") + "{{$separator or config('daterangepicker.separator')}}" + end.format("{{$format or config('daterangepicker.format')}}")+'">')
                }
            )
        })
    </script>
@endpush