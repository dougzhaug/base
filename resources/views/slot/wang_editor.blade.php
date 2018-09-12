@push('head')
    @parent
    {{--全屏功能插件CSS--}}
    <link rel="stylesheet" href="{{admin_asset('bower_components/wangEditor/release/wangEditor-fullscreen-plugin.css')}}">
@endpush

<div id="editor">
    <p>欢迎使用 <b>wangEditor</b> 富文本编辑器</p>
</div>
<div id="textarea-box"  style="display:none">
    <textarea id="editor-textarea" name="editor" style="width:100%; height:200px;"></textarea>
</div>


@push('footer')
    @parent

    <script type="text/javascript" src="{{admin_asset('bower_components/wangEditor/release/wangEditor.min.js')}}"></script>
    {{--全屏功能插件JS--}}
    <script type="text/javascript" src="{{admin_asset('bower_components/wangEditor/release/wangEditor-fullscreen-plugin.js')}}"></script>
    <script type="text/javascript">
        var E = window.wangEditor;
        var editor = new E('#editor');
        var $textarea = $('#editor-textarea');
        editor.customConfig.onchange = function (html) {
            // 监控变化，同步更新到 textarea
            $textarea.val(html)
        };

        editor.create();

        $textarea.val(editor.txt.html());

        E.fullscreen.init('#editor');
    </script>
@endpush