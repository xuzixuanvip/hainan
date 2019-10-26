@extends('admin.layouts.app')
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
                                  <form class="form-horizontal" role="form" action="{{url('zadmin/diancan/shops')}}" method="post" enctype="multipart/form-data">

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">商户名</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="name" required="" value="">
                                                  </div>
                                              </div>
<div class="form-group">
                          <label class="col-md-2 control-label">微信</label>                    
                                        <div class="col-md-10">
                          <select class="form-control select2" name="openid" id="openid">
                            <option value="">请选择</option>
                            @foreach($wxusers as $wxuser)
                            <option value="{{$wxuser->openid}}">{{$wxuser->nickname}}</option>
                            @endforeach
                          </select>
                        </div> 
                        </div>     

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">图片</label>
                                                  <div class="col-md-10">
                                                      <input type="file" class="form-control" name="pic" >
                                                  </div>
                                                  

                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">地址</label>
                                                  <div class="col-md-10">
      <input type="text" class="form-control" name="address" required="" value="">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">电话</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="mobile" required="" value="">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">登录密码</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="password"  value="">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">Tags</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="tags" required="" value="">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">联系人</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="contacter" required="" value="">
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
    
