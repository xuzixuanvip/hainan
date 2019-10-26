@extends('admin.layouts.app')
@section('css')
        <!-- Custombox css -->
       
        <link href="{{asset('hrs/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css')}}" rel="stylesheet">
         <link href="{{asset('admin/plugins/select2/css/select2.css')}}" rel="stylesheet">
@endsection 
@include('vendor.ueditor.assets') 
@section('content')

                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">任务管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                    <li><a href="{{url('zadmin/task')}}">任务管理</a></li>
                                    <li class="active">添加任务</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                            <h2 class="m-t-0 header-title">任务详情</h2>
                            <hr/>
                             @if(session('rs') || $errors->any())
                              <div class="alert alert-danger">
                        @if($errors->any())
                            @foreach($errors->messages() as $msg )
                                {{$msg[0]}}
                            @endforeach
                        @endif
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
                        			<div class="row">
			                        	<div class="col-md-12">
                                  <form method="post" action="{{url('zadmin/task/save')}}" enctype="multipart/form-data">
                            {{ csrf_field()}}
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="card-box">
                                        <h5 class="text-muted text-uppercase m-t-0 m-b-20"><b>发布任务</b></h5>

                                        <div class="form-group m-b-20">
                                            <label>选择卖家 <span class="text-danger">*</span></label>
                                            <select class="form-control " name="seller_id">
                                                <option value="">请选择</option>
                                            @foreach($sellers as $seller)   
                                                <option value="{{$seller->id}}">{{$seller->truename}}</option>
                                            @endforeach    
                                                

                                            </select>

                                        </div>

                                        <div class="form-group m-b-20">
                                            <label>任务名称 <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" placeholder="" value="{{old('name')}}">
                                        </div>

                                        <div class="form-group m-b-20">
                                            <label>宝贝链接 <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="task_url">{{old('task_url')}}</textarea> 
                                        </div>
                                        <div class="form-group m-b-20">
                                            <label>电商平台 <span class="text-danger">*</span></label>
                                            <select class="form-control" name="platform_id">
                                                <option value="">请选择</option>
                                            @foreach($platforms as $p)   
                                                <option value="{{$p->id}}">{{$p->name}}</option>
                                            @endforeach    
                                                

                                            </select>

                                        </div>

                                        <div class="form-group m-b-20">
                                            <label>结束时间 <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="endtime" placeholder="" value="{{old('endtime')}}" id="endtime">
                                        </div>

                                        
            <div class="form-group m-b-20">
                <label class="control-label">任务图片</label>
                                                <input type="file" class="filestyle" data-buttontext="选择图片" data-buttonname="btn-white" name="thumb" value="{{old('thumb')}}">
            </div>
                                        



                                     <div class="form-group m-b-20">
                                            <label>任务描述<span class="text-danger">*</span></label>
                                            
                                            <!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('describe');
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
    });
</script>

<!-- 编辑器容器 -->
<script id="describe" name="describe" type="text/plain">{!!old('describe')!!}</script>
                                        </div>   

                                        

                                    </div>
                                </div>


                                <div class="col-lg-4">
                                    <div class="card-box">
                                        <h5 class="text-muted text-uppercase m-t-0 m-b-20"><b>费用信息</b></h5>

                                        <div class="form-group m-b-20">
                                            <label>宝贝价格</label>
                                            <input type="text" class="form-control" required="" name="price" value="{{old('price')}}">
                                        </div>

                                         <div class="form-group m-b-20">
                                            <label>任务数量</label>
                                            <input type="number" class="form-control" required="" name="num" value="{{old('num')}}">
                                        </div>

                                        <div class="form-group m-b-20">
                                            <label>佣金</label>
                                            <input type="text" class="form-control" required="" name="commission" value="{{old('commission')}}">
                                        </div>


                                <div class="form-group">
                                  
                                    <div class="text-center p-20">
                                         
                                         <button type="submit" class="btn w-sm btn-default waves-effect waves-light">发布</button>
                                         
                                    </div>
                                </div>
                           

                                        

                                    </div>

                                </div>


                            </div>


                            
                        
                        </form>
                                </div>
			                        	
			                        </div>

                             
			                        
                        			
                        		</div>
                                
                            </div> <!-- end col -->

                            
                        </div>
@endsection
                        
                        
                        

                  
            
    @section('modal')        
      
    @endsection        
       

           



    
        @section('js')
        <script src="{{asset('admin/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('admin/plugins/select2/js/select2.min.js')}}"></script>
<script type="text/javascript" src="{{asset('hrs/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
<script type="text/javascript" src="{{asset('hrs/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js')}}" charset="UTF-8"></script>
<script type="text/javascript">
    $('.select2').select2();

    $('#endtime').datetimepicker({
        format: "yyyy-mm-dd hh:ii:ss",
        autoclose: true,
        todayBtn: true,
        startDate: new Date()
       
    });


         

         
        </script>
@endsection
    
