@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">平台管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                    <li><a href="{{url('zadmin/admin')}}">管理员</a></li>
                                    <li class="active">修改密码</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                            <h2 class="m-t-0 header-title">修改平台</h2>
                            <hr/>
                             @if(session('rs'))
                              <div class="alert alert-{{session('rs')['status']}}">
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
                        			<div class="row">
			                        	<div class="col-md-6">
                                  <form class="form-horizontal" role="form" action="{{url('zadmin/admins/'.$data->id)}}" method="post">{{ method_field('PUT') }}

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">用户名</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="username" required="" value="{{$data->username}}" readonly="">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label" for="example-email">密码</label>
                                                  <div class="col-md-10">
                                                      <input type="password"  name="password" class="form-control" value="" placeholder="不修改请留空" >
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label" for="example-email">密码确认</label>
                                                  <div class="col-md-10">
                                                      <input type="password"  name="password2" class="form-control" value="" placeholder="不修改请留空" >
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
    
