@extends('admin.layouts.app')
@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">疾病管理</h4>
            <ol class="breadcrumb">
                <li><a href="{{url('zadmin/')}}">系统</a></li>
                <li><a href="{{url('zadmin/goods')}}">疾病列表</a></li>
                <li class="active">添加症状</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h2 class="m-t-0 header-title">添加症状</h2>
                <hr/>
                @if(session('rs'))
                    <div class="alert alert-{{session('rs')['status']}}">
                        {{ session('rs')['msg'] }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal" role="form" action="{{url('zadmin/disease/symptom/insertdata/'.$data->id)}}" method="post" enctype="multipart/form-data">

                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">疾病名称</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="name" required="" value="{{$data->name}}">
                                </div>
                            </div>


                            <div class="form-group col-md-6" style="float: right;" id="public">
                                <label class="col-md-3 control-label">症状选择</label><br><br><br>
                                @foreach($result as $v)
                                    @if(!in_array($v->id,$rsrs))
                                        <div class="col-md-3 public_div" >
                                            <input type="checkbox" value="{{$v->id}}" {{in_array($v->id,$rsrs) ? 'checked=""' : ''}} name="symptom_id[]" checkbox="checkbox"/>{{$v->name}}
                                            <input type="text" class="form-control" name="probability{{ $v->id }}" @if(in_array($v->id,$rsrs)) required="" @endif value="@foreach($proba as $vv){{ $v->id == $vv->symptom_id ? $vv->probability : '' }}@endforeach" style="width:70px;float:right;height: 25px">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
{{--                            <div class="form-group col-md-6">--}}
{{--                                <label class="col-md-3 control-label">症状匹配病症几率</label>--}}
{{--                                    @foreach($result as $v)--}}
{{--                                        <div class="col-md-9">--}}
{{--                                        </div>--}}
{{--                                    @endforeach--}}
{{--                            </div>--}}


                            <div class="form-group col-md-6" style="width: 800px;height: 60px;overflow-x: hidden;overflow-x: hidden;">
                                <div class="tags" id="" style="text-align: center;float:left;width:60px;border-radius: 5px;margin: 10px;border: 1px solid darkseagreen;font-size: 20px">通用</div>
                            @foreach($tag as $v)
                                    <div class="tags" id="{{ $v->id }}" style="text-align: center;float:left;width:60px;border-radius: 5px;margin: 10px;border: 1px solid darkseagreen;font-size: 20px">{{$v->name}}</div>
                                @endforeach
                            </div>

                            <div class="form-group col-md-6" style="">
                                    <div class="col-md-3" style="width:100%">
                                        <input type="text" class="form-control" placeholder="请填写疾病来搜索症状,如 头疼,胸闷" name="search" id="search" style="">
                                    </div>
                            </div>


                            <div class="form-group col-md-6" style="width: 800px;height: 370px;overflow-x: hidden;overflow-y: scroll;">
                                @foreach($rs as $v)
                                    <div class="col-md-3" style="width: 170px">
                                        <input type="checkbox" value="{{$v->id}}" checked name="symptom_id[]"/>{{$v->name}}
                                        <input type="text" class="form-control" name="probability{{ $v->id }}" @if(in_array($v->id,$rsrs)) @endif value="@foreach($proba as $vv){{ $v->id == $vv->symptom_id ? $vv->probability : '' }}@endforeach" style="width:70px;float:right;height: 25px">
                                    </div>
                                @endforeach
                            </div>

                            <div class="form-group text-center col-md-12">

                                <button type="submit" class="btn btn-info waves-effect waves-light">保存</button>
                            </div>

                            {{csrf_field()}}
                        </form>
                    </div>

                </div>




            </div>

        </div> <!-- end col -->


    </div>
@endsection






@section('modal')
    <!-- Modal -->
    <div id="custom-modal" class="modal-demo">
        <button type="button" class="close" onclick="Custombox.close();">
            <span>&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="custom-modal-title">账户充值</h4>
        <div class="custom-modal-text text-left">
            <form role="form" method="post" action="{{url('zadmin/seller/add-money')}}">

                <div class="form-group">
                    <label for="position">卖家</label>
                    <input type="text" class="form-control" id="seller_name" disabled="" />
                </div>
                <div class="form-group">
                    <label for="name">充值金额</label>
                    <input type="number" class="form-control" name="money" placeholder="">
                </div>



                <div class="form-group">
                    <label for="position">备注信息</label>
                    <textarea class="form-control" name="remark" ></textarea>
                </div>


                <button type="submit" class="btn btn-default waves-effect waves-light">保存</button>
                <button type="button" class="btn btn-danger waves-effect waves-light m-l-10" onclick="Custombox.close();">取消</button>

                <input type="hidden" name="seller_id" />
                {{csrf_field()}}
            </form>
        </div>
    </div>
@endsection







@section('js')

    <script type="text/javascript">


        $('.type').on('change',function(){
            var _val = $(this).val();
            if(_val==2) {
                $('.money').show();
                $('.rate').hide();
            }else{
                $('.rate').show();
                $('.money').hide();
            }
        });


        // $('.public_div').each(function (){
        //     console.log($(this).attr('hidden',true));
        //     if($(this).children().eq(0).attr('value') <50){
        //    }
        // });
        $('#search').blur(function() {
            var name = $(this).val();
            if(name == ''){
                public_div(name);
                return;
            }
            $.ajax({
                url: '{{ route('disease.search') }}',
                type: 'POST',
                dataType: 'json',
                data:{'name':name,'_token':'{{ csrf_token() }}'},
                success: function(msg) {
                   if(msg.code == 200){
                       // console.log(msg.data);
                       $('#search').val(msg.data2.name);
                       public_div(msg);
                   } else {
                        alert('没有匹配到该疾病');
                   }
                },
                error: function(xhr, type) {

                }
            })
        });




        $('.tags').click(function(){
            var id = $(this).attr('id');
            if(id == '') {
                public_div(id);
                return;
            }
            $.ajax({
                url: '{{ route('disease.tag_search') }}',
                type: 'POST',
                dataType: 'json',
                data:{'id':id,'_token':'{{ csrf_token() }}'},
                success: function(msg) {
                    if(msg.code == 200){
                        // console.log(msg.data);
                        // $('#search').val(msg.data2.name);
                        public_div(msg);
                    } else {
                        alert('没有匹配到该疾病');
                    }
                },
                error: function(xhr, type) {

                }
            })

        })


        function public_div(msg){
            if(msg != '') {
                $('.public_div').each(function (){
                    // console.log($(this).attr('hidden',true));
                    $(this).css('color','');
                    for(var i=0;i<msg.data.length;i++){
                        // console.log(msg.data[i]);
                        if( $(this).children().eq(0).attr('value') == msg.data[i]) {
                            $(this).css('color','red');
                            // $(this).children().eq(0).attr('backgroud','#ddd');
                        }
                    }
                    //
                });
            } else {
                $('.public_div').each(function (){
                    // console.log($(this).attr('hidden',true));
                    $(this).css('color','');
                    //
                });
            }

        }
    </script>
@endsection

