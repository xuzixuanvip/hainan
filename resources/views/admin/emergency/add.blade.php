@extends('admin.layouts.app')
@include('vendor.ueditor.assets')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">应急救援联系人管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="{{url('zadmin/')}}">系统</a></li>
                                    
                                    <li class="active">修改应急救援联系人</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                            <h2 class="m-t-0 header-title">添加应急救援联系人</h2>
                            <hr/>
                             @if(session('rs'))
                              <div class="alert alert-{{session('rs')['status']}}">
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
                        			<div class="row">
			                        	<div class="col-md-9">
                                  <form class="form-horizontal" role="form" action="{{url('zadmin/emergency')}}" enctype="multipart/form-data" method="post" >

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">姓名</label>
                                                  <div class="col-md-10">
                                                      <input type="input" class="form-control" name="name" required="" value="">
                                                  </div>
                                                 
                                              </div>
                                      <div class="form-group">
                                                  <label class="col-md-2 control-label">电话</label>
                                                  <div class="col-md-10">
                                                      <input type="input" class="form-control" name="mobile" required="" value="">
                                                  </div>
                                                 
                                              </div> 

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">接收短信</label>
                                                  <div class="col-md-10">
                                                      <input type="radio"  name="is_msg" required="" value="1">是

                                                      <input type="radio"  name="is_msg" required="" value="0">否
                                                  </div>
                                                 
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">接收语音</label>
                                                  <div class="col-md-10">
                                                      <input type="radio"  name="is_voice" required="" value="1">是
                                                      <input type="radio"  name="is_voice" required="" value="0">否
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
                        
                        
                        

                  
            
    
       

           



    
       
    
