@push('head')
    @parent
    <!-- js_tree css -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.3/themes/default/style.min.css">
@endpush

<div id="js-tree"></div>

<!--存储jstree所需的数据-->
<input type="hidden" id="js_tree_ids" name="js_tree_ids" value="">

<!--存储权限管理所需的数据-->
@if($name)
    <input type="hidden" id="{{$name}}" name="{{$name}}" value="">
@endif

@push('footer')
    @parent
    <script src="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.3/jstree.min.js"></script>

    <script>
        $(function() {

            $('#js-tree').jstree({
                'core' : {
                    "data" : {
                        "url" : '{{$url}}',
                        "type" : "POST",
                        "dataType" : "json",
                        "headers" : { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                    }
                },
                "checkbox" : {
                    "keep_selected_style" : false
                },
                "types" : {
                    "default" : {
                        "icon" : "{{$default_icon or 'fa fa-dot-circle-o'}}"
                    }
                },
                "plugins" : [ "checkbox","types"]
            });
        });

        /**
         * 默认jstree所需数据
         */
        $('#js-tree').on('changed.jstree',function(e,data){
            var permissions = $(this).jstree(true).get_selected(false);

            $('#js_tree_ids').val(permissions);
        });

        /**
         * 获取所有选中项的id并赋值给隐藏域
         *
         * @returns {boolean}
         */
        function getPermissions() {
            var permission = $('#js-tree').jstree(true).get_selected(false);
            var permissions = permission.toString();
            permissions = getUnd(permissions);
            if(permissions.length == 0){
                alert('请选择权限');
                return false;
            }
            console.log(permissions);
            $("#{{$name}}").val(permissions);
        }

        /**
         * 获取所有半选状态的复选框id
         *
         * @param permissions
         * @returns {*}
         */
        function getUnd(permissions){
            $(".jstree-undetermined").each(function(){
                permissions = permissions + ',' + $(this).parent().parent().attr('id');
            });
            return permissions;
        }
    </script>
@endpush