
<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>症状自查_疾病详情</title>
    <link rel="stylesheet" type="text/css" href="{{ url('dz/css/reset2.css') }}">
    <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.js"></script>
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
        <li class="cur">常识</li>
        <li>医院</li>
    </ul>
</section>
<div class="con cs">
    <div class="introduction">
        <h3><span></span>疾病概述</h3>
        <p></p>
    </div>
    <dl class="symptoms">
        <dt>
            <h3 class="bg1">伴随症状</h3>
        </dt>
        <dd>

        </dd>
    </dl>
    <dl class="pathogen">
        <dt>
            <h3 class="bg3">疾病原因</h3>
        </dt>
        <dd>
        </dd>
    </dl>
    <dl class="lcbx">
        <dt>
            <h3 class="bg4">临床表现</h3>
        </dt>
        <dd>
        </dd>
    </dl>
    <dl class="therapy">
        <dt>
            <h3 class="bg5">疾病治疗</h3>
        </dt>
        <dd>
        </dd>
    </dl>


</div>
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
        $.ajax({
            url: '{{ route('api.diseaseRetrieve')}}',
            type: 'POST',
            dataType: 'json',
            beforeSend:function(){
                loading();
            },
            data:{_token:'{{ csrf_token() }}',diseases_id:'{{request()->diseases_id ?? 0}}',gender:getgender,age:getage},
            success: function(res) {
                stoploading();
                var data=res.data;
                var introduction=data.xgzds.introduction?data.introduction:"暂无内容";
                var symptoms=data.symptoms.join(',')?data.symptoms.join('，'):"暂无内容";
                var pathogen=data.xgzds.pathogen?data.pathogen:"暂无内容";
                var lcbx=data.xgzds.lcbx?data.lcbx:"暂无内容";
                therapy=data.xgzds.therapy?data.therapy:"暂无内容";
                $(".cs").find(".introduction").find('p').append(introduction);
                $(".cs").find(".symptoms").find('dd').append(symptoms);
                $(".cs").find(".pathogen").find('dd').append(pathogen);
                $(".cs").find(".lcbx").find('dd').append(lcbx);
                $(".cs").find(".therapy").find('dd').append(therapy);
                // $.ajax({
                //     url: '/intelligenceserver/search/diseaseAnalysisRetrieve',
                //     type: 'POST',
                //     dataType: 'json',
                //     beforeSend:function(){
                //         loading();
                //     },
                //     data:{symptom_word:"",gender:getgender,age:getage,disease_id:data.diseaseId},
                //     success: function(res) {
                //         stoploading();
                //         var data=res.data.jzkses;
                //         console.log(data);
                        $.each(data.jzkses,function(index, el) {
                            var ahtml=$("<a>"+el+"</a>");
                            $("#recdept").append(ahtml);

                        });

                    // },
                    // error: function(xhr, type) {
                    //
                    // }
                // });


            },
            error: function(xhr, type) {

            }
        })
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
