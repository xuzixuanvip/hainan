<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>名医查询</title>
    <link rel="stylesheet" type="text/css" href="{{ url('dz/css/reset2.css') }}" />
    <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.js"></script>

</head>
<body>
<div id="app" class="renti_list">
    <div class="left" style="height: 428px;">
        <ul id="leftlistid">
            @foreach($department as $v)
                @if ($loop->first)
                    <li class="cur" style="height: 35px"><p style="line-height: 24px" id="{{ $v->id }}">{{ $v->name }}</p>
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
        @foreach($doctor as $k => $v)
            <a href="{{ route('daozhen.doctor_show',$k) }}">{{ $v }}</a>
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
        var li = $(e.target);
        var id = e.target.id;
        if(e.target.id == 'img'){
            id = $(e.target).parent().attr('id');
        }
        $('#leftlistid li').each(function () {
            $(this).attr('class','');
        });
        $(e.target).parent().attr('class','cur');
        if(id == '') {
            return false;
        }
        $.ajax({
            url: '{{ route('api.daozhen.doctor') }}',
            type: 'POST',
            dataType: 'json',
            data:{id:id,'_token':'{{ csrf_token() }}'},
            beforeSend:function(){
                loading();
            },
            success: function(res) {
                stoploading();


                var data = res.data;
                $('.right').empty();
                $.each(data, function(index, el) {
                    $('.right').append('<a href={{ url('daozhen/doctor_show') }}/'+data[index].id+'>'+data[index].name+'</a>');
                });
            },
        })
    })

})
</script>
