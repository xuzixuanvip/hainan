@extends('dingcan.layouts.app')
@section('css')
        <!-- Custombox css -->
       
       
         <link href="{{asset('admin/plugins/select2/css/select2.css')}}" rel="stylesheet">
@endsection 
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">操作员管理</h4>
                                <ol class="breadcrumb">
                                   
                                    <li><a href="{{url('zadmin/diancan/users')}}">操作员列表</a></li>
                                    <li class="active">添加操作员</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                            <h2 class="m-t-0 header-title">添加管理员</h2>
                            <hr/>
                             @if(session('rs'))
                              <div class="alert alert-{{session('rs')['status']}}">
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
                        			<div class="row">
			                        	<div class="col-md-6">
                                  <form class="form-horizontal" role="form" action="{{url('diancan/shop/users')}}" method="post" enctype="multipart/form-data">                                    
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">姓名</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="name" value="" required="">
                                                  </div>
                                              </div>

                                             

                                             

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">手机</label>
                                                  <div class="col-md-10">
                        <input type="text" class="form-control" name="mobile" value="" required="" placeholder="登录使用">
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">密码</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="password" value="" required="">
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
  <script type="text/javascript" src="{{asset('admin/plugins/select2/js/select2.min.js')}}"></script>
  <script type="text/javascript">
    $('#openid').select2();        
  </script>
        @endsection
    
