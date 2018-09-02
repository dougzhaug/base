@extends($layout)

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="callout @if($data['status'] == 'success') callout-success @else callout-danger @endif">
            <h4>@if($data['status'] == 'success') 成功！ @else 失败！ @endif</h4>
            {{$data['message']}}
            <p>浏览器页面将在<b id="loginTime">{{ $data['wait_time'] }}</b>秒后跳转......<a href="javascript:void(0);" class="jump_now"> 立即跳转</a> </p>
        </div>
    </section>
@endsection

@push('footer')
    <script type="text/javascript">
        $(function(){
            //循环倒计时，并跳转
            var url = "{{ $data['url'] }}";
            var loginTimeID='loginTime';
            //alert(loginTimeID);return;
            var loginTime = parseInt($('#'+loginTimeID).text());
            console.log(loginTime);
            var time = setInterval(function(){
                loginTime = loginTime-1;
                $('#'+loginTimeID).text(loginTime);
                if(loginTime==0){
                    clearInterval(time);
                    window.location.href=url;
                }
            },1000);
        });
        //点击跳转
        $('.jump_now').click(function () {
            var url = "{{ $data['url'] }}";
            window.location.href=url;
        });

    </script>
@endpush