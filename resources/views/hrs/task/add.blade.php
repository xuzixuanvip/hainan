@extends('hrs.layouts.app')  
@section('css')
 <style type="text/css">
     .form-control{width: 80%}
 
 </style>  
<link href="{{asset('hrs/plugins/select2/css/select2.css')}}" rel="stylesheet">
<link href="{{asset('hrs/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">  

<link href="{{asset('hrs/plugins/ladda-buttons/css/ladda-themeless.min.css')}}" rel="stylesheet" type="text/css" />      
@endsection 
     
@section('content')

            <div class="container">

                

                <div class="row">
                   
                    

                    @if(session('rs')|| $errors->any())
                    <div class="alert alert-{{session('rs')['status']}}">
                                        <i class="md  md-highlight-remove"></i> 
                    @if($errors->any())
                        @foreach($errors->messages() as $msg )
                            {{$msg[0]}}
                        @endforeach
                    @endif
                                        {!!session('rs')['msg']!!}
                    </div>
                    
                    @endif
  <div class="card-box" style="padding: 5px;">
    <h4 class="text-muted">
        {!! $notice1->contents !!}
    </h4>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <form method="post" action="{{url('user/task/save')}}" enctype="multipart/form-data" id="taskForm">
            {{ csrf_field()}} 
            <div class="form-group">
                <label class="col-md-2 control-label">报修人员<span class="text-danger">*</span></label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="customer_name"  value="{{object_get($customer,'customer_name')}}" required="">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">联系方式<span class="text-danger">*</span></label>
                <div class="col-md-10">                
                    <input type="text" class="form-control" name="mobile"  value="{{object_get($customer,'mobile')}}" required="">
                </div>
            </div> 

            <div class="form-group">
                <label class="col-md-2 control-label">故障类别 <span class="text-danger">*</span></label>
                <div class="col-md-10">                
                    <select class="form-control" id="category_id" name="category_id" required="">
                        <option value="">请选择故障类别</option>
                        @foreach($cates as $p)   
                        <option value="{{$p->id}}">{{$p->name}}</option>
                        @endforeach 
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">故障地点 <span class="text-danger">*</span></label>
                <div class="col-md-10">                
                    <select class="form-control" name="depart_id" required="" id="depart_id">
                        <option value="">请选择故障地点</option>
                        @foreach($departs as $d)   
                        <option value="{{$d->id}}">{{$d->name}}</option>
                        @endforeach 
                    </select>
                </div>
            </div>

            <div class="form-group" id="addressInfo" style="display: none">
               
                <select class="form-control" name="address"  id="depart_child">
                    <option value="">请选择</option>                                   
                </select>
                <input type="text" name="address2" class="form-control" placeholder="请输入详细地点">
                                
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">图像</label>
                <div class="col-md-10">                
                    <input type="file" class="filestyle" data-buttontext="选择图片" data-buttonname="btn-white" name="thumb" value="{{old('thumb')}}"  accept="image/*" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">视频</label>
                <div class="col-md-10">                
                    <input type="file" class="filestyle" data-buttontext="视频" data-buttonname="btn-white" name="video" value="{{old('video')}}" accept="video/*">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">描述或备注你的问题</label>
                <div class="col-md-10">
                    <textarea class="form-control" name="content" required="">{{old('content')}}</textarea>
                </div>
            </div>

            <div class="form-group m-b-0">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="button" class="ladda-button btn w-sm btn-default waves-effect waves-light" data-style="expand-left" id="btnSubmit">提交</button>
                </div>
            </div>


            </form>                
        </div>
    </div>    
                       
                       
                        <div class="row">
                            <div style="text-align: center;">
                                 {!! $notice2->contents !!}
                            </div>
                        </div>
                                

                                        

                                        




   
                                     
                       
                    
             
        
    
     </div>        
 </div>
              

               

            </div> <!-- end container -->
@endsection        

        
@section('js')
<script type="text/javascript" src="{{asset('/plupload/js/plupload.full.min.js')}}"></script>
<script src="{{asset('hrs/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>  
<script src="{{asset('hrs/plugins/bootstrap-datepicker/js/bootstrap-datepicker.zh-CN.js')}}"></script>
<script type="text/javascript" src="{{asset('hrs/plugins/select2/js/select2.min.js')}}"></script>

<script src="{{asset('hrs/plugins/ladda-buttons/js/spin.min.js')}}"></script>
<script src="{{asset('hrs/plugins/ladda-buttons/js/ladda.min.js')}}"></script>
<script src="{{asset('hrs/plugins/ladda-buttons/js/ladda.jquery.min.js')}}"></script>

 <script src="{{asset('hrs/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')}}" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
    $('#btnSubmit').click(function(e){
        e.preventDefault();
        var l = Ladda.create(this);
        l.start();

        var depart_id = $('#depart_id').val();
        if(depart_id=='') {
            alert('请选择故障地点'); return false;
        }

        var category_id = $('#category_id').val();
        if(category_id == '') {
            alert('请选择故障类别');return false;
        }



        $('#taskForm').submit();
        
       
        return false;
    });
});



    $('#datepicker-autoclose').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
        startDate:new Date(),
        language: 'zh-CN',
    });

    $('#depart_id').on('change',function(){
        var id = $(this).val();
        var url = "{{url('api/depart')}}?id="+id;
        $.get(url,function(rs){
            $('#depart_child').empty();
            if(rs.status==false) {
                $('#addressInfo').hide();
                return false;    
            } 
            $('#addressInfo').show();
            var str = '';
            $.each(rs.data,function(k,v){
                str += '<option value="'+v.name+'">'+v.name+'</option>';
            });
            $('#depart_child').append(str);
        })
    })

</script>        
@endsection

