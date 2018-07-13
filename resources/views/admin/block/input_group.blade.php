
<div class="input-group margin search-input col-sm-3" style="float:left;margin: 0 0 0 10px;">
    <div class="input-group-btn">
        <button type="button" class="btn btn-info btn-flat input-group-btn-button">{{reset($actionField)}}</button>
        <button type="button" class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown" style="padding-right: 6px;padding-left: 6px;">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu" role="menu">
            @foreach($actionField as $k=>$v)
                <li data-field="{{$k}}"><a href="javascript:void(0);">{{$v}}</a></li>
            @endforeach
        </ul>
    </div>

    <input type="hidden" id="action_field" name="{{$action_field or 'action_field'}}" value="{{array_keys($actionField)[0]}}">
    <input type="text" class="form-control" name="{{$keyword or 'keyword'}}">
</div>

@push('footer')
    @parent
    <script>
        /**
         * 多功能搜索框，点击事件
         */
        $('.dropdown-menu li').on('click',function () {
            $('.input-group-btn-button').html($(this).text());
            $('#action_field').val($(this).data('field'));
        })
    </script>
@endpush
