@push('head')
    @parent
    {{--全屏功能插件CSS--}}
    <link rel="stylesheet" href="{{admin_asset('bower_components/wangEditor/release/wangEditor-fullscreen-plugin.css')}}">
@endpush

<div id="editor">
    <p>欢迎使用 <b>wangEditor</b> 富文本编辑器</p>
</div>

@push('footer')
    @parent

    <script type="text/javascript" src="{{admin_asset('bower_components/wangEditor/release/wangEditor.min.js')}}"></script>
    {{--全屏功能插件JS--}}
    <script type="text/javascript" src="{{admin_asset('bower_components/wangEditor/release/wangEditor-fullscreen-plugin.js')}}"></script>
    <script type="text/javascript">
        var E = window.wangEditor;
        var editor = new E('#editor');
        editor.create();
        E.fullscreen.init('#editor');
    </script>
@endpush