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
                              <i class="fa fa-calendar"></i> Date range picker
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
                <input type="text" class="form-control pull-right" id="reservation">
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
            //Date range picker
            $('#reservation').daterangepicker()
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
            //Date range as a button
            $('#daterange-btn').daterangepicker(
                {
                    ranges   : {
                        'Today'       : [moment(), moment()],
                        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate  : moment()
                },
                function (start, end) {
                    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                }
            )

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            })
        })
    </script>
@endpush