@push('head')
    <!--引入wangEditor2.css-->
    <link rel="stylesheet" type="text/css" href="{{admin_asset('bower_components/wangEditor2/dist/css/wangEditor.min.css')}}">
@endpush

<div id="editor">
    <p>欢迎使用 <b>wangEditor</b> 富文本编辑器</p>
</div>


@push('footer')
    <!--引入jquery和wangEditor2.js-->   <!--注意：javascript必须放在body最后，否则可能会出现问题-->
    {{--<script type="text/javascript" src="{{admin_asset('bower_components/wangEditor2/dist/js/lib/jquery-1.10.2.min.js')}}"></script>--}}
    <script type="text/javascript" src="{{admin_asset('bower_components/wangEditor2/dist/js/wangEditor.min.js')}}"></script>
    <script type="text/javascript">
        var E = window.wangEditor;
        var editor = new E('editor');
        editor.config.hideLinkImg = true;
        editor.config.customUpload = true;  // 设置自定义上传的开关
        editor.config.customUploadInit = '';  // 配置自定义上传初始化事件，uploadInit方法在上面定义了
        editor.create();
    </script>
@endpush