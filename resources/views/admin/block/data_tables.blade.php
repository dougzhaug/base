
@push('head')
    @parent
    <!-- DataTables -->
    <link rel="stylesheet" href="{{admin_asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endpush

@push('footer')
    @parent
    <!-- DataTables -->
    <script src="{{admin_asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{admin_asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

    <script>

        /**
         * dataTable插件初始化
         */
        function DataTableLoad(url,tableName,formName) {

            tableName = tableName ? tableName : '#tables';
            formName = formName ? formName : false;
            url = url ? url : $(tableName).data('url');

            var column = [];
            var defaultSort = [];
            var target = [];
            $(tableName).children('thead').children('tr').children().map(function (k,v) {
                /*处理显示字段信息*/
                var thName = $(this).data('name');
                if(thName != undefined){
                    column.push({data:thName});
                }

                /*获取默认排序字段*/
                var default_sort = $(this).data('default-sort');
                if(default_sort){
                    defaultSort = [k,default_sort]
                }

                /*生成不允许排序字段*/
                var sort = $(this).data('sort');
                if(!sort){
                    target.push(k)
                }
            });

            return $(tableName).DataTable({
                serverSide: true,                   //开启服务器模式
                ajax: {                             //AJAX请求设置
                    url:url,
                    type: 'POST',
                    data: getFormData(formName),    //额外参数
                    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                },
                columns: column,                    //列表的展示字段
                paging: true,                       //是否分页
                lengthChange: true,                 //每页显示多少条
                searching: false,                   //搜索
                ordering: true,                     //排序
                info: true,                         //左下角信息
                autoWidth: false,                   //宽度自适应
                aaSorting: [ defaultSort ],         //默认排序
                aoColumnDefs: [ { "bSortable": false, "aTargets": target }],      //禁止那些列不可以排序
                language: {
                    processing: "数据加载中...",
                    info: "显示第 _START_ 至 _END_ 条，共 _TOTAL_ 条记录",
                    infoEmpty: "暂无数据",
                    sEmptyTable: "表中数据为空",
                    lengthMenu: "每页显示 _MENU_ 条记录",
                    paginate: {
                        first: "首页",
                        previous: "上一页",
                        next: "下一页",
                        last: "最后一页"
                    }
                }
            })
        }

        /**
         * 公共搜索函数
         *
         * @param formName
         */
        function doSearch(formName)
        {
            tables.settings()[0].ajax.data = getFormData(formName);     //设置ajax请求参数
            tables.draw();  //重新触发请求
        }

        /**
         * 获取form数据
         * @param node
         */
        function getFormData(node) {
            var node = node ? node : '#formSearch';
            var dataArray = $(node).serializeArray();

            var data = {};
            $.each(dataArray, function() {
                data[this.name] = this.value;
            });

            return data;
        }
    </script>
@endpush