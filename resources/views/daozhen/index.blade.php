<html><head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>智能导诊</title>
    <link rel="stylesheet" type="text/css" href="{{url('/dz/css/reset2.css')}}">
</head>


<body>
<!--
<header>
    <div class="left fl"><a href="">返回</a></div>
    <h2 class="fl">症状自查</h2>
    <div class="right fr">
        <a></a>
    </div>
</header>
 -->
<div style="border:1px solid #1299da;height:50px;border-radius: 10px;margin:1px 10px -10px 10px">
    <b style="color: red;margin-left: 20px;">公告:</b> <b >{{ empty($content) ? '' : $content->content }}</b>
</div>
<section id="search" class="index_search">

    <input type="text" placeholder="请输入症状或疾病关键字如：发热、头疼、感冒等。" id="myInput">
    <button class="confirm" disabled="disabled"></button>
    <button class="cancel"></button>
</section>
<div class="ageset"><button id="ageset">性别年龄设置</button></div>
<section class="index_rtt">
    <a href="{{ route('daozhen.body') }}">
        <h2>人体图查症状</h2>
        <p>按部位查看相应症状或疾病</p>
    </a>

</section>
<div class="list">
    <section class="index_zzzc">
        <h2 class="tybefore">热查症状</h2>
        <ul class="tab">

            <div class="con none">
            </div>
            <div class="con none">
            </div>
            <div class="con">

                <div class="con none">
                </div>
                <div class="con none">
                </div>
            </div>
        </ul>
    </section>
</div>
<div class="search_result">
    <h3>你是不是要找一下症状？</h3>
    <div class="one_a">
    </div>
    <h3 class="two_h3">你是不是要找一下疾病？</h3>
    <div class="two_a">
    </div>
</div>
<script type="text/javascript" src="{{url('/dz/js/zeptom.min.js')}}"></script>
<script type="text/javascript" src="{{url('/dz/js/public.js')}}"></script>
<script type="text/javascript">


    $(function() {


        if(localStorage.getItem("age")){
            var age=localStorage.getItem("age"),
                gender=localStorage.getItem("gender");

            if(gender==1){
                gender="男"
            }else{
                gender="女"
            }
            str="性别："+gender+"<span> | </span>"+"年龄："+age;
            $("#ageset").html(str)
        }else{
            $("#ageset").html("性别年龄设置")
        }
        // tab导航获取
        $.ajax({
            url: '{{ route('api.tags') }}',
            data:{'_token':'{{ csrf_token() }}'},
            type: 'POST',
            dataType: 'json',
            beforeSend:function(){
                loading();
            },
            success: function(res) {
                var data = res.data;
                $.each(data, function(index, el) {
                    var tab_li = $("<li data-id='" + el.id + "'><span><img src='{{url('/')}}" + el.image + "'></span><span>" + el.name + "</span></li>");
                    $(".tab").prepend(tab_li);
                });
                $(".tab").find('li').eq(2).addClass('cur');
                // tab切换内容初始化
                var li_id = $(".tab").find('li').eq(2).data('id');
                $.ajax({
                    url: '{{ route('api.symptom') }}',
                    type: 'POST',
                    dataType: 'json',
                    data:{id:li_id,'_token':'{{ csrf_token() }}'},
                    success: function(res) {
                        stoploading();
                        var data = res.data;
                        $.each(data, function(index, el) {
                        console.log(el);
                        console.log(index);
                            var keyword_a = $("<a href='{{ url('daozhen/symptom') }}?symptom_name="+el+"&symptom_id="+index+"'>" + el + "</a>");
                            $(".con").eq(2).append(keyword_a);
                        });

                    },
                    error: function(xhr, type) {

                    }
                })
            },
            error: function(xhr, type) {

            }
        })
        // tab切换
        $(".tab").on('click', 'li', function(event) {
            event.preventDefault();
            $(this).addClass('cur').siblings('li').removeClass('cur');
            var index2 = $(this).index();
            $(".con").eq(index2).removeClass('none').siblings('.con').addClass('none');
            var li_id = $(this).data('id');

            $.ajax({
                url: '{{ route('api.symptom') }}',
                type: 'POST',
                dataType: 'json',
                beforeSend:function(){
                    loading();
                },
                data:{id:li_id,'_token':'{{ csrf_token() }}'},
                success: function(res) {
                    stoploading();
                    $(".con").eq(index2).empty();
                    var data = res.data;
                    $.each(data, function(index, el) {
                        var keyword_a = $("<a href='{{ url('daozhen/symptom') }}?symptom_name="+el+"&symptom_id="+index+"'>" + el + "</a>");
                        $(".con").eq(index2).append(keyword_a);
                    });

                },
                error: function(xhr, type) {

                }
            })

        });
        // 搜索
        $("#search").on('click', '.confirm', function(event) {
            event.preventDefault();
            $(this).hide().next(".cancel").show();
            var input_val = $("#myInput").val();
            $(".search_result").find(".one_a").html("");
            $(".search_result").find(".two_a").html("");
            $.ajax({
                url: '{{ route('api.search') }}',
                type: 'POST',
                dataType: 'json',
                beforeSend:function(){
                    loading();
                },
                data: {keyword: input_val,'_token':'{{ csrf_token() }}'},
                success: function(res) {
                    stoploading();
                    $(".search_result").show();
                    var diseases = res.data.diseases;
                    var symptoms = res.data.symptom;
                    if(symptoms != undefined && symptoms != null && symptoms != ""){

                        $.each(symptoms, function(index, el) {
                            var symptoms_html = $("<a href='{{ url('daozhen/symptom') }}?symptom_name="+el+"&symptom_id="+ index +"'>" + el + "</a>");
                            $(".search_result").find(".one_a").append(symptoms_html)
                        });

                    }
                    else{
                        var symptoms_html = $("<a href=''>搜索不到相关症状</a>");
                        $(".search_result").find(".one_a").append(symptoms_html)
                    }
                    if(diseases != undefined && diseases != null && diseases != ""){
                        $.each(diseases, function(index, el) {
                            var diseases_html = $("<a href='{{ url('daozhen/diseaseRetrieve') }}?diseasename="+el+"'>" + el + "</a>");
                            $(".search_result").find(".two_a").append(diseases_html)
                        });

                    }else{
                        var diseases_html = $("<a href=''>搜索不到相关疾病</a>");
                        $(".search_result").find(".two_a").append(diseases_html);
                    }
                },
                error: function(xhr, type) {

                }
            })
        })
        $("#ageset").on('click', function(event) {

            localStorage.setItem("fromwhere","index");
            window.location.href="/intelligenceserver/view/selectDate"
        });
    });
</script>



</body></html>