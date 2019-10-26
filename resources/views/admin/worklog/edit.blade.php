@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">服务日志管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                    <li><a href="#">系统设置</a></li>
                                    <li class="active">修改服务日志</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                            <h2 class="m-t-0 header-title">修改服务日志</h2>
                            <hr/>
                             @if(session('rs'))
                              <div class="alert alert-{{session('rs')['status']}}">
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
                        			<div class="row">
			                        	<div class="col-md-6">
                                  <form class="form-horizontal" role="form" action="{{url('zadmin/worklog/'.$data->id)}}" enctype="multipart/form-data" method="post" >{{ method_field('PUT') }}

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">服务图片</label>
                                                  <div class="col-md-6">
                                                      <input type="file" class="form-control" name="pic" required="" value="">
                                                  </div>
                                                  <div class="col-md-4">
                                                    <a href="{{$data->pic}}" target="_blank">
                                                      <img src="{{$data->pic}}" width="150" />
                                                    </a>  
                                                  </div>
                                              </div>
                                                                                                                 
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">服务日期</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="logtime" value="{{$data->logtime}}" required="">
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
                        
                        
                        

                  
            
    
       

           



    
       
    
