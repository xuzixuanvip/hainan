@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">全局设置</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                   
                                    <li class="active">全局设置</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                            <h2 class="m-t-0 header-title">全局设置</h2>
                            <hr/>
                             @if(session('rs'))
                              <div class="alert alert-{{session('rs')['status']}}">
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
  <div class="row">
			<div class="col-md-6">
      <form class="form-horizontal" role="form" action="{{url('zadmin/system/'.$data->id)}}" method="post" enctype="multipart/form-data">{{ method_field('PUT') }}

    <div class="form-group">
        <label class="col-md-3 control-label">AppID</label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="app_id"  value="{{$data->app_id}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">AppSecret</label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="app_secret" value="{{$data->app_secret}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Token</label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="token"  value="{{$data->token}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">EncodingAESKey</label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="aes_key"  value="{{$data->aes_key}}">
        </div>
    </div>  

    

    <div class="form-group">
        <label class="col-md-3 control-label">商户ID</label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="mch_id"  value="{{$data->mch_id}}">
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">商户KEY</label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="mch_key"  value="{{$data->mch_key}}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label">派单方式</label>
        <div class="col-md-9">
            <input type="radio"  name="dispatch_type"  value="1"  {{$data->dispatch_type==1?'checked=""':''}}>手工派单

            <input type="radio"  name="dispatch_type"  value="2" {{$data->dispatch_type==2?'checked=""':''}}>自动派单

        </div>
    </div> 
     <div class="form-group">
        <label class="col-md-3 control-label">一键报警码</label>
        <div class="col-md-9">
            <input type="text" class="form-control" name="warning_code"  value="{{$data->warning_code}}">
        </div>
    </div>                                                                                                          
                                              

                                              <div class="form-group text-center">
                                                  
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
      
    @endsection        
       

           



    
        @section('js')

        <script type="text/javascript">
         

        </script>
        @endsection
    
