<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>症状自查_症状分析</title>
    <link rel="stylesheet" type="text/css" href="{{ url('dz/css/reset2.css') }}">
    <link rel="stylesheet" href="{{ url('dz/css/swiper.min.css') }}">
    <style>
        .swiper1 {
            width: 100%;
            /*height: 300px;*/
            padding-bottom: 20px;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
        }

        .swiper2 {
            width: 100%;
            padding-top: 20px;
            padding-bottom: 50px;
            background: #eeeeee;
        }

        .swiper-slide2 {
            background: #fff;
            border-radius: 1rem;
            width: 80%;
            text-align: left;
        }

        .swiper-slide2 .block .page_number {
            background: #c9ddaa;
            margin-top: 1rem;
            height: 3rem;
            line-height: 3rem;
            color: #fff;
            font-size: 2rem;
            width: 5rem;
            display: block;
            text-align: center;
        }

        .swiper-slide2 .block h2 {
            font-size: 2rem;
            color: #666666;
            text-align: center;
            height: 4rem;
            line-height: 4rem;
        }

        .swiper-slide2 .block p {
            padding: 0 2rem;
            font-size: 1.6rem;
            margin-top: 1rem
        }

        .swiper-slide2 .block p:nth-child(1) {
            line-height: 2rem;
            height: 2rem;
        }

        .swiper-slide2 .block p b {
            color: #e74c3c;
            line-height: 2rem;
            margin-left: 1rem;
        }

        .swiper-slide2 .block p span {
            line-height: 2rem;
            height: 2rem;
            width: 1rem;
            background: url(../img/1.png) no-repeat left bottom;
            display: inline-block;
            background-size: auto 50%
        }

        .swiper-slide2 .block p span.grey {
            background: url(../img/2.png) no-repeat left bottom;
            background-size: auto 50%
        }

        .swiper-slide2 .block p span:nth-child(1) {
            margin-left: 1rem;
        }

        .swiper-slide2 .block p button {
            color: #fff;
            border-radius: 0.5rem;
            width: 90%;
            padding: 0 5%;
            height: 3rem;
            line-height: 3rem;
            margin: 1rem auto 1rem;
            display: block;
            background: #c9ddaa;
            text-align: center;
            border:none;
        }

        .swiper-pagination-bullet-active {
            background: #36bf84
        }
    </style>
</head>

<body>
<!--
<header>
    <div class="left fl"><a href="/intelligenceserver/view/index">返回</a></div>
    <h2 class="fl">症状自查</h2>
    <div class="right fr">
        <a></a>
    </div>
</header>
 -->
<input type="hidden" id="symptom_word" value="{{ request()->symptom_word ?? '' }}">
<input type="hidden" id="gender" value="{{ request()->gender ?? '0' }}">
<input type="hidden" id="age" value="0">
<!-- <section class="zzfx">
    <a href="/intelligenceserver/view/selectDate?symptom_word=腰椎疼痛">
        不设置性别年龄


   </a>
</section> -->
<section id="search_tag" class="tyafter">
    <div class="serachBtn"></div>
    <!-- data-text="咳嗽"必须加上 -->
    <a class="orange" data-text="{{ request()->symptom_name }}" href="/intelligenceserver/view/index">{{  request()->symptom_name  }}<span onClick="window.location.href='{{ route('daozhen.index') }}">×</span></a>
    <!--  <a class="green">咳嗽1<span>×</span></a> -->
</section>
<section class="index_zzzc">
    <h2 class="tybefore">是否还有以下症状</h2>
    <div class="swiper-container swiper1">
        <div class="swiper-wrapper">
        </div>
        <div class='swiper-pagination'></div>
    </div>
</section>
<section class="start_fx" data-toggle="show">
    <button>开始分析</button>
</section>
<div class="swiper-container swiper2 swiper3">
    <div class="swiper-wrapper">
    </div>
</div>
<script type="text/javascript" src="{{ url('dz/js/zeptom.min.js') }}"></script>
<script src="{{ url('dz/js/swiper.min.js') }}"></script>
<script type="text/javascript" src="{{ url('dz/js/public.js') }}"></script>
<script type="text/javascript">
    var swiper2 = new Swiper('.swiper2', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        coverflow: {
            rotate: 50,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true
        }
    });
    var swiper1 = new Swiper('.swiper1', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        observer: true,
        bserveParents:true,
    });
    $(function() {
        $(".serachBtn").on('click', function(event) {
            event.preventDefault();
            window.location.href='/intelligenceserver/view/search_list?symptom_word=腰椎疼痛';
        });
        function request(){
            var a_innertext = [];
            $("#search_tag").find('a').each(function(index, el) {
                var item_text = $(el).attr("data-text");
                a_innertext.push(item_text);
            });
            a_innertext = a_innertext.join(";");
            // localStorage.setItem("symptom_word",a_innertext);
            // 初始化  关键字获取，每页分20个
            $.ajax({
                url: '{{ route('api.symptomSearch',['symptom_id'=>request()->symptom_id]) }}',
                type: 'POST',
                dataType: 'json',
                beforeSend: function() {
                    loading();
                },
                data:{_token:'{{csrf_token()}}',symptom_word:a_innertext,gender:localStorage.getItem("gender"),age:localStorage.getItem("age")},
                success: function(res) {
                    stoploading();
                    if(res.data.symptoms == undefined || res.data.symptoms == null || res.data.symptoms.length==0){
                        sw2_show(res);
                        $(".start_fx").hide();
                        $(".start_fx").attr({
                            "data-toggle": 'hide'
                        });
                    }else{
                        updateData(res);
                    }


                },
                error: function(xhr, type) {

                }
            })
        }

        //初始化
        request();

        //点击删除标签
        $("#search_tag").on('click', 'span', function(event) {
            event.preventDefault();
            var data_text = $(this).parent("a").attr("data-text");
            var slide_index = $(this).parent("a").attr("data-index");
            var aa_html = $("<a>" + data_text + "</a>");
            $(".swiper1").find('.con').eq(slide_index).append(aa_html);
            $(this).parent("a").remove();
            var isShow = $(".start_fx").attr("data-toggle");
            if (isShow !== 'show') {
                fenxi()
            }else{
                request();
            }

        });
        // 点击添加标签
        $(".swiper1").find('.swiper-wrapper').on('click', 'a', function(event) {
            event.preventDefault();
            var text = $(this).text();
            var slide_index = $(this).closest('.swiper-slide').index();
            var a_con = $("<a class='green' data-text='" + text + "' data-index='" + slide_index + "'>" + text + "<span>×</span></a>")
            $("#search_tag").append(a_con);
            $(this).remove();
            var isShow = $(".start_fx").attr("data-toggle");
            if (isShow !== 'show') {
                fenxi()
            }else{
                request();
            }
        });

        $(".start_fx").on('click', function(event) {
            event.preventDefault();
            $(".start_fx").attr({
                "data-toggle": 'hide',
            });
            $(this).hide();
            fenxi();

        });
    });

    function fenxi() {
        // 获取参数
        var a_innertext = [];
        var symptom_id = "{{ request()->symptom_id ?? '' }}";
        $("#search_tag").find('a').each(function(index, el) {
            var item_text = $(el).attr("data-text");
            a_innertext.push(item_text);
        });
        a_innertext = a_innertext.join(";");
        localStorage.setItem("symptom_word",a_innertext);
        $.ajax({
            url: '{{ route('api.fenxi') }}',
            type: 'POST',
            dataType: 'json',
            data:{'_token':'{{ csrf_token() }}','symptom_id':symptom_id,symptom_word:a_innertext,gender:localStorage.getItem("gender"),age:localStorage.getItem("age")},
            beforeSend: function() {
                loading();
            },
            success: function(res) {
                stoploading();
                sw2_show(res);
                // swiper2.update();
            }
        });

    }
    function updateData(res) {
        $(".swiper1").find('.swiper-wrapper').html("");
        if(res.data.symptoms.length == 0){
            $(".swiper1").find(".swiper-pagination").hide();
            swiper1.update();

        }else{
            $(".swiper1").find(".swiper-pagination").show();

            var symptoms = res.data.symptoms;
            var symptoms_len = symptoms.length;
            var page_num = Math.ceil(symptoms_len / 20);
            var page_num_yushu = symptoms_len % 20;
            console.log(page_num);
            for (var i = 0; i < page_num; i++) {
                var html_1 = $("<div class='swiper-slide'><div class='con'></div></div>");
                $(".swiper1").find('.swiper-wrapper').append(html_1);
                var j1 = i * 20,
                    j2 = (i + 1) * 20;
                if ((j1 + page_num_yushu) >= symptoms_len) {
                    j2 = j1 + page_num_yushu;
                }
                for (var j = j1; j < j2; j++) {
                    var symptom_html = $("<a>" + symptoms[j] + "</a>");
                    $(".swiper1").find('.con').eq(i).append(symptom_html);
                };
            }
            swiper1.update();
        }

    }

    function sw2_show(res){
        $(".swiper2").find('.swiper-wrapper').html("");
        updateData(res);
        var diseases = res.data.diseases;
        if(diseases == undefined || diseases == null || diseases.length==0){
            var notdata=$("<div style='text-align:center;width:100%'>您选择的症状无分析结果，请<a href='index.html'>重新选择</a></div>");
            $(".swiper2").find('.swiper-wrapper').append(notdata);

        }else{
            for (var i = 0; i < diseases.length; i++) {
                var symptoms_text = diseases[i].symptoms.join('、');

                var age = localStorage.getItem("age");
                if(age == null){
                    age = "";
                }
                var gender = localStorage.getItem("gender");
                if(gender == null){
                    gender = "";
                }
                var html = $("<div class='swiper-slide swiper-slide2'><a href='/intelligenceserver/view/diseaseWikiByNameRetrieve?age="+age+"&gender="+gender+"&diseasename=" + diseases[i].diseaseName + "' class='block'><span class='page_number'>0" + (i + 1) + "</span><h2>" + diseases[i].diseaseName + "</h2><p>患病概率</span><b>" + diseases[i].probality + "%</b></p><p>常见症状：" + symptoms_text + "</p><p><button>查看详情</button></p></a></div>");
                $(".swiper2").find('.swiper-wrapper').append(html);
            }
        }
        swiper2.update();
        var swiper3 = new Swiper('.swiper3', {
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            coverflow: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true
            }
        });

    }
</script>
</body>

</html>


