@extends('admin.layouts.app')

@section('css')
 <style type="text/css">
   .material-switch > input[type="checkbox"] {
    display: none;   
}

.material-switch > label {
    cursor: pointer;
    height: 0px;
    position: relative; 
    width: 40px;  
}

.material-switch > label::before {
    background: rgb(0, 0, 0);
    box-shadow: inset 0px 0px 10px rgba(0, 0, 0, 0.5);
    border-radius: 8px;
    content: '';
    height: 16px;
    margin-top: -8px;
    position:absolute;
    opacity: 0.3;
    transition: all 0.4s ease-in-out;
    width: 40px;
}
.material-switch > label::after {
    background: rgb(255, 255, 255);
    border-radius: 16px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
    content: '';
    height: 24px;
    left: -4px;
    margin-top: -8px;
    position: absolute;
    top: -4px;
    transition: all 0.3s ease-in-out;
    width: 24px;
}
.material-switch > input[type="checkbox"]:checked + label::before {
    background: inherit;
    opacity: 0.5;
}
.material-switch > input[type="checkbox"]:checked + label::after {
    background: inherit;
    left: 20px;
}
 </style>

@endsection 

@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">食堂商户管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                    <li><a href="{{url('zadmin/diancan/shops')}}">食堂商户列表</a></li>
                                    <li class="active">修改食堂商户</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                            <h2 class="m-t-0 header-title">修改食堂商户</h2>
                            <hr/>
                             @if(session('rs'))
                              <div class="alert alert-{{session('rs')['status']}}">
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
                        			<div class="row">
			                        	<div class="col-md-6">
                                  <form class="form-horizontal" role="form" action="{{url('zadmin/diancan/shops/'.$data->id)}}" method="post" enctype="multipart/form-data">{{ method_field('PUT') }}

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">商户名</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="name" required="" value="{{$data->name}}">
                                                  </div>
                                              </div>
<div class="form-group">
                          <label class="col-md-2 control-label">微信</label>                    
                                        <div class="col-md-10">
                          <select class="form-control select2" name="openid" id="openid">
                            <option value="">请选择</option>
                            @foreach($wxusers as $wxuser)
                            <option value="{{$wxuser->openid}}" {{$wxuser->openid==$data->openid?'selected':''}}>{{$wxuser->nickname}}</option>
                            @endforeach
                          </select>
                        </div> 
                        </div>     

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">图片</label>
                                                  <div class="col-md-6">
                                                      <input type="file" class="form-control" name="pic" >
                                                  </div>
                                                  <div class="col-md-4">
                                  <img src="{{$data->pic}}" width="45" />
                                                  </div>

                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">地址</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="address" required="" value="{{$data->address}}">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">电话</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="mobile" required="" value="{{$data->mobile}}">
                                                  </div>
                                              </div>
                                             
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">Tags</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="tags" required="" value="{{$data->tags}}">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">联系人</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="contacter" required="" value="{{$data->contacter}}">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                <label class="col-md-2 control-label">状态</label>
                                                <div class="col-md-10">
                          
                          <div class="material-switch col-md-8">
                           
                            <input id="someSwitchOptionSuccess" name="status" type="checkbox" value="1" {{$data->status==1?'checked=""':''}}    />
                            <label for="someSwitchOptionSuccess" class="label-success"></label>
                          </div>
                          

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
         
        @endsection
    
