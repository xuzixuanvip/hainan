@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">留言管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="{{url('zadmin')}}">系统</a></li>
                                    <li><a href="{{url('zadmin/message')}}">留言列表</a></li>
                                    <li class="active">修改留言</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                            <h2 class="m-t-0 header-title">修改留言</h2>
                            <hr/>
                             @if(session('rs'))
                              <div class="alert alert-{{session('rs')['status']}}">
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
                        			<div class="row">
			                        	<div class="col-md-6">
                                  <form class="form-horizontal" role="form" action="{{url('zadmin/message/reply')}}"  method="post" >
                                    <div class="form-group">
                                      <label class="col-md-2 control-label">留言内容</label>
                                      <div class="col-md-10">
                                        <textarea class="form-control" >{{$data->contents}}</textarea> 
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label class="col-md-2 control-label">留言时间</label>
                                      <div class="col-md-10">
                                        <input class="form-control" value="{{$data->created_at}}" /> 
                                      </div>
                                    </div>

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">回复</label>
                                                  <div class="col-md-10">
                                                      <textarea  class="form-control" name="reply" required="" >{{$data->reply}}</textarea>
                                                  </div>
                                                  
                                              </div>
                                                                                                                 
                                              

                                              <div class="form-group text-center">
                                                  
                                                  <button type="submit" class="btn btn-info waves-effect waves-light">提交</button>
                                              </div>
                                              
                             <input name="id" value="{{$data->id}}" type="hidden" />                 
                             {{csrf_field()}}
                                          </form>
                                </div>
			                        	
			                        </div>

                             
			                        
                        			
                        		</div>
                                
                            </div> <!-- end col -->

                            
                        </div>
@endsection
                        
                        
                        

                  
            
    
       

           



    
       
    
