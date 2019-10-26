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
    <h4 class="text-muted"><b>提交工单</b></h4>
                       
                        <div class="table-responsive" style="border: none;">
    
                       <table class="table m-0">

                            <tbody>
                         <form method="post" action="{{url('user/task/update')}}" enctype="multipart/form-data" id="taskForm">
                            <input type="hidden" name="id" value="{{$data->id}}" />
                            {{ csrf_field()}}            
                            <tr>
                                <td>
                                    <label>姓名 <span class="text-danger">*</span></label>
                                </td>
                                <td><input type="text" class="form-control" name="customer_name" placeholder="" value="{{$data->customer_name}}" required=""></td>
                            </tr>
                            <tr>
                                <td><label >手机 <span class="text-danger">*</span></label></td>
                                <td><input type="text" class="form-control" name="mobile" placeholder="" value="{{$data->mobile}}" required=""></td>
                            </tr>
    <tr>
        <td><label>类别 <span class="text-danger">*</span></label>
                                </td>
        <td>
        <select class="form-control" name="category_id" required="">
            <option value="">请选择故障类别</option>
                @foreach($cates as $p)   
                <option value="{{$p->id}}" {{$data->category_id==$p->id?'selected':''}}>{{$p->name}}</option>
                @endforeach 
        </select>
        </td>
    </tr>
        <tr>
            <td>
                <label>
                    地点 <span class="text-danger">*</span>
                </label>
            </td>
            <td>
            <select class="form-control" name="depart_id" required="" id="depart_id">
                <option value="">请选择故障地点</option>
                @foreach($departs as $d)   
                    <option value="{{$d->id}}" {{$data->depart_id==$d->id?'selected':''}}>{{$d->name}}</option>
                @endforeach 
            </select>

            <div id="addressInfo" style="display: {{$data->addres2?'':'none'}}">
            <select class="form-control" name="address" required="" id="depart_child">
                <option value="">请选择</option>
                                   
            </select>
                                <input type="text" name="address2" class="form-control" placeholder="请输入详细地点" value="{{$data->addres2}}">
                                </div>
                                </td>
                           </tr>

                             <tr>
                                <td><label class="control-label">图像</label></td>
                                <td>
                                    <input type="file" class="filestyle" data-buttontext="选择图片" data-buttonname="btn-white" name="thumb"   accept="image/*" />
                                    <img src="{{$data->thumb}}" width="45">
                                </td>
                            </tr>

                            <tr>
                                <td><label class="control-label">视频</label></td>
                                <td>
                                    <input type="file" class="filestyle" data-buttontext="视频" data-buttonname="btn-white" name="video" value="{{old('video')}}" accept="video/*">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><font color="#ff0000">*上传图片及视频时请遮挡客户敏感信息</font></td>
                            </tr>
                            <tr>
                                <td><label>描述 </label></td>
                                <td>
                                <textarea class="form-control" name="content" required="">{{$data->content}}</textarea>
                                </td> 
                            </tr>

                        <tr>
                        <td><label>预约</label></td>
                        <td>
                        <div class="row" style="width: 90%;overflow: hidden;">
    
        <div class="col-sm-6">                        
            <div class="input-group">
                <input type="text" class="form-control" placeholder="yyyy-mm-dd" id="datepicker-autoclose" name="service_time1" value="{{$data->service_time1}}">
                <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
            </div><!-- input-group -->
        </div>
        <div class="col-sm-6">                        
            <div class="input-group">
                           
                            <select class="form-control select2 col-sm-6" name="service_time2">
                                <option value="">请选择预约时间</option>
            @foreach($serviceTimes as $t)   
            <option value="{{$t}}" {{$data->service_time2==$t?'selected':''}}>{{$t}}</option>
            @endforeach 
                            </select> 
                        </div>
                    </div>
        </div>
    </td>
    </tr> 
    <tr>
        <td colspan="2">
             <div class="text-center p-20">
                                         
                            <button type="button" class="ladda-button btn w-sm btn-default waves-effect waves-light" data-style="expand-left" id="btnSubmit">提交</button>                                    
                        </div>
        </td>
    </tr>    
</form>
</tbody>
                        </table> 
                        </div>  
                                

                                        

                                        




   
                                     
                       
                    
             
        
    </form>
     </div>               </div>
              

               

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

