@push('head')
    @parent
    <!-- z_tree css -->
    <link rel="stylesheet" href="{{admin_asset('plugins/zTree/css/zTreeStyle/zTreeStyle.css')}}">
@endpush

<div>
    <ul id="treeDemo" class="ztree"></ul>
</div>

@push('footer')
    @parent
    <script src="{{admin_asset('plugins/zTree/js/jquery.ztree.all.js')}}"></script>

    <script>

    </script>
@endpush