
<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>大夫简介</title>
    <link rel="stylesheet" type="text/css" href="{{ url('dz/css/reset2.css') }}">
    <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.js"></script>
    <link href="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/css/bootstrap.css" rel="stylesheet">
</head>

<body>
<!--
<header>
    <div class="left fl"><a href="">返回</a></div>
    <h2 class="fl">疾病详情</h2>
    <div class="right fr">
        <a></a>
    </div>
</header>
 -->
<input type="hidden" id="disease_name" value="便秘">
<input type="hidden" id="gender" value="">
<input type="hidden" id="age" value="">
<section >
    <ul class="tab1">
        <li class="cur">个人介绍</li>
    </ul>
</section>
<div class="con cs">
    <div  style="height: 100px;margin: 10px 0 0 0">
        <div style="float: left;width: 100px;">
            <img style="width: 100px;" src="{{ url('/').$doctor->image }}" alt="">
        </div>
        <div style="width:300px;float: left;margin: 10px 0 0 50px;color: #0b0b0b;">
            <b style="float: left;display: block;font-size: 25px">{{ $doctor->name }}</b>
            <b style="float: right;display: block;font-size: 18px;padding-top: 10px;color: #4d4d4d">{{ $doctor->title }}</b>
            <div style="border:1px solid #4d4d4d;display: block;clear: left;width: 100%"></div>
            <button class="btn btn-primary" style="margin: 10px 10px 0 0 ;float: right">挂号</button>
            <button  class="btn btn-primary" style="margin: 10px 10px 0 0 ;float: right">分享给好友</button>
        </div>
    </div>

    
    <dl class="symptoms cur">
        <dt>
            <h3 class="bg1">医生简介</h3>
        </dt>
        <dd>
            {{ $doctor->content }}
        </dd>
    </dl>
    <dl class="pathogen cur">
        <dt>
            <h3 class="bg3">专业特长</h3>
        </dt>
        <dd>
            {{ $doctor->remark }}
        </dd>
    </dl>

</div>
<button style="width: 80%;margin: 0 10%" onclick=" window.location.href='{{ route('daozhen.index') }}'" class="btn btn-primary">返回首页</button>

<div class="con none" id="resdept">
    <h2 class="tybefore">推荐科室</h2>
    <div class="cb" id="recdept">
        <!-- <a>咽喉疼</a><a>咽喉疼</a><a>咽喉疼</a><a>咽喉疼</a> -->
    </div>

</div>
<script type="text/javascript" src="{{ url('dz/js/zeptom.min.js') }}"></script>
<script type="text/javascript" src="{{ url('dz/js/public.js') }}"></script>
<script type="text/javascript">
    $(function() {
        var getgender=$("#gender").val()?$("#gender").val():"";
        var getage=$("#age").val()?$("#age").val():"";
        {{--$.ajax({--}}
        {{--    url: '{{ route('api.diseaseRetrieve')}}',--}}
        {{--    type: 'POST',--}}
        {{--    dataType: 'json',--}}
        {{--    beforeSend:function(){--}}
        {{--        loading();--}}
        {{--    },--}}
        {{--    data:{_token:'{{ csrf_token() }}',diseasename:'{{request()->diseasename ?? 0}}',gender:getgender,age:getage},--}}
        {{--    success: function(res) {--}}
        {{--        stoploading();--}}
        {{--        var data=res.data;--}}
        {{--        var introduction=data.xgzds.introduction?data.introduction:"暂无内容";--}}
        {{--        var symptoms=data.symptoms.join(',')?data.symptoms.join('，'):"暂无内容";--}}
        {{--        var pathogen=data.xgzds.pathogen?data.pathogen:"暂无内容";--}}
        {{--        var lcbx=data.xgzds.lcbx?data.lcbx:"暂无内容";--}}
        {{--        therapy=data.xgzds.therapy?data.therapy:"暂无内容";--}}
        {{--        $(".cs").find(".introduction").find('p').append(introduction);--}}
        {{--        $(".cs").find(".symptoms").find('dd').append(symptoms);--}}
        {{--        $(".cs").find(".pathogen").find('dd').append(pathogen);--}}
        {{--        $(".cs").find(".lcbx").find('dd').append(lcbx);--}}
        {{--        $(".cs").find(".therapy").find('dd').append(therapy);--}}
        {{--        // $.ajax({--}}
        {{--        //     url: '/intelligenceserver/search/diseaseAnalysisRetrieve',--}}
        {{--        //     type: 'POST',--}}
        {{--        //     dataType: 'json',--}}
        {{--        //     beforeSend:function(){--}}
        {{--        //         loading();--}}
        {{--        //     },--}}
        {{--        //     data:{symptom_word:"",gender:getgender,age:getage,disease_id:data.diseaseId},--}}
        {{--        //     success: function(res) {--}}
        {{--        //         stoploading();--}}
        {{--        //         var data=res.data.jzkses;--}}
        {{--        //         console.log(data);--}}
        {{--                $.each(data.jzkses,function(index, el) {--}}
        {{--                    var ahtml=$("<a>"+el+"</a>");--}}
        {{--                    $("#recdept").append(ahtml);--}}

        {{--                });--}}

        {{--            // },--}}
        {{--            // error: function(xhr, type) {--}}
        {{--            //--}}
        {{--            // }--}}
        {{--        // });--}}


        {{--    },--}}
        {{--    error: function(xhr, type) {--}}

        {{--    }--}}
        {{--})--}}
        // 点击展开和收缩
        $(".cs dl").on('click', 'dt', function(event) {
            event.preventDefault();
            $(this).parent("dl").toggleClass('cur');
        });
        $(".four").on('click', function(event) {
            event.preventDefault();
            $(this).parent(".download").hide();
        });

        // tab切换
        $(".tab1").on('click', 'li', function(event) {
            event.preventDefault();
            $(this).addClass('cur').siblings('li').removeClass('cur');
            var index = $(".tab1 li.cur").index();
            $(".con").eq(index).removeClass('none').siblings('div').addClass('none');
        });
        $("#recdept").on('click', 'a', function(event) {

            var deptname= $(this).html();
            $(this).attr({
                href: 'bsmedical://getDeptInfo?dept_name='+deptname,
            });
        });

    });


</script>
</body>

</html>
