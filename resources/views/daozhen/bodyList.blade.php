<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>疾病选择</title>
    <link rel="stylesheet" type="text/css" href="{{ url('dz/css/reset2.css') }}" />
    <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.js"></script>

</head>
<body>
<div id="app" class="renti_list">
    <div class="left" style="height: 428px;">
        <ul id="leftlistid">
            @foreach($data as $v)
                @if ($loop->first)
                <li class="cur" id="{{ $v->id }}"><p id="{{ $v->id }}"><img width="30" height="30" src="{{ url('dz/img/') }}/31.png" />{{ $v->name }}<b>相关</b></p>
                <!---->
                <dl class="none"></dl></li>
                @else
                    <li class=""><p id="{{ $v->id }}">{{ $v->name }}</p>
                        <!---->
                    <dl class="none"></dl></li>
                @endif
            @endforeach
        </ul>
    </div>
    <div class="right" style="height: 428px; overflow: scroll;">
        @foreach($son as $k => $v)
            <a href="{{ $k }}">{{ $v }}</a>
        @endforeach
    </div>
</div>
</body>
</html>
<!-- Fixed navbar -->

</body>
<script type="text/javascript" src="{{url('/dz/js/zeptom.min.js')}}"></script>
<script type="text/javascript" src="{{url('/dz/js/public.js')}}"></script>
<script>
$(function () {
    $('#leftlistid').click(function (e) {
       // alert(e.target.id);
        $.ajax({
            url: '{{ route('api.bodyTab') }}',
            type: 'POST',
            dataType: 'json',
            data:{id:e.target.id,'_token':'{{ csrf_token() }}'},
            beforeSend:function(){
                loading();
            },
            success: function(res) {
                stoploading();
                var data = res.data;
                $('.right').empty();
                $.each(data, function(index, el) {
                    $('.right').append('<a href='+data[index]+'>'+data[index]+'</a>');
                });
            },
        })
    })

})
</script>
