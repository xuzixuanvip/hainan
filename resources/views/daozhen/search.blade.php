



<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>症状自查_搜索</title>
    <link rel="stylesheet" type="text/css" href="{{ url('dz/css/reset2.css') }}">
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
<section id="search" class="search_list">
    <input type="text" placeholder="请输入症状或疾病如：发热" id="myInput" value="{{ Request()->symptom_name ?? '' }}" />
    <button class="confirm" >搜索</button>
    <button class="cancel">取消</button>
</section>
<div class="search_result">
    <h3>你是不是要找一下症状？</h3>
    <div class="one_a">
    </div>
    <h3 class="two_h3">你是不是要找一下疾病？</h3>
    <div class="two_a">
    </div>
</div>
<script type="text/javascript" src="{{ url('dz/js/zeptom.min.js') }}"></script>
<script type="text/javascript">
    $(function() {
        // 搜索
        $("#search").on('click', '.confirm', function(event) {
            event.preventDefault();
            $(this).hide().next(".cancel").show();
            var input_val = $("#myInput").val();
            $(".search_result").find(".one_a").html("");
            $(".search_result").find(".two_a").html("");
            var age=localStorage.getItem("age"),
                gender=localStorage.getItem("gender"),version;
            if(age&&gender){
                version="2.2.0";
            }else{
                version="";
            }
            $.ajax({
                url: '{{ route('api.search') }}',
                type: 'POST',
                dataType: 'json',
                beforeSend:function(){
                    loading();
                },
                data: {_token:'{{ csrf_token()}}',keyword: input_val,age:age,gender:gender,version:version},
                success: function(res) {
                    stoploading();
                    $(".search_result").show();
                    var diseases = res.data.diseases;
                    var symptoms = res.data.symptoms;
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
                            var diseases_html = $("<a href='{{ url('daozhen/diseaseRetrieve') }}?diseases_id="+index+"&diseasename='"+el+"'>" + el + "</a>");
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


// 搜索按钮的点击
        var myInput = document.getElementById("myInput");
        if (myInput) {
            myInput.addEventListener("input", changeButton);
        }

        $("#myInput").on('blur', function(event) {
            if ($(this).val() == "") {
                $("#search").find(".confirm").show().attr({
                    disabled: 'disabled'
                });
                $("#search").find(".cancel").hide();
                $(".search_result").find(".one_a").html("");
                $(".search_result").find(".two_a").html("");
                $(".search_result").hide();
            }
        });
        $("#search").on('click', '.cancel', function(event) {
            event.preventDefault();

            $(this).hide().prev(".confirm").show().attr({
                disabled: 'disabled'
            });
            $(this).parent("#search").find("input").val("");
            $(".search_result").find(".one_a").html("");
            $(".search_result").find(".two_a").html("");
            $(".search_result").hide();
            $(this).val("");
        });
        $("#search").on('focus', 'input', function(event) {
            $(".list").hide();

        })
        $("#search").on('keyup', 'input', function(event) {

            $(".cancel").hide();
            $(".confirm").show();
        })

        function changeButton() {
            $("#search").find('button').removeAttr('disabled');

        }
// 数据加载中
        function loading() {
            var loadCon = $(" <div id='loading'><div class='bg_master'></div><div class='toast'><p class='weui_toast_content'>数据加载中...</p></div></div>");
            $("body").append(loadCon);
        }
// 数据加载结束
        function stoploading() {
            $("#loading").remove();
        }



    });
</script>
</body>

</html>
