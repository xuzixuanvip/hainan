@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">意见管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="{{url('zadmin/')}}">系统</a></li>
                                    
                                    <li class="active">意见列表</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                        			<div class="row">
			                        	<div class="col-sm-8">
			                        		<form role="form">
			                                    <div class="form-group contact-search m-b-30">
			                                    	<input type="text" id="search" class="form-control" placeholder="Search...">
			                                        <button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
			                                    </div> <!-- form-group -->
			                                </form>
			                        	</div>
			                        	<div class="col-sm-4">
			                        		

                                  
			                        	</div>
			                        </div>

                              @if(session('rs'))
                              <div class="alert alert-{{session('rs')['status']}}">
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
			                        
                        			<div class="table-responsive">
                                        <table class="table table-hover">
                                        	<thead>
												<tr>
													<th style="min-width: 35px;">
													ID
                                                        
													</th>
                          <th>微信昵称</th>
													<th>意见内容</th>
												
                          <th>意见时间</th>
                          
                         
													<th style="width: 200px;">操作</th>
												</tr>
											</thead>
											
                                            <tbody>

                                            @foreach($list as $v)
                                                <tr>
                        <td>{{$v->id}}</td>
                        <td>{{$v->nickname}}</td>                            
                        <td>{{$v->contents}}</td>                                                  
                                                    
                        <td>{{$v->created_at}}</td>
                       
                                                
                                                    
                                                   
                                                    <td>
                                                    	
                                                    	<a href="{{url('zadmin/message',$v->id)}}" data-method="delete" 
  data-token="{{csrf_token()}}" data-confirm="确定删除吗?"><i class="md md-close"></i>删除</a>
                                                    </td>
                                                </tr>
                                            @endforeach    
                                                
                                               
                                               
                                                
                                               
                                                
                                            
                                            </tbody>
                                        </table>
                                    </div>

                                     {{ $list->links() }}
                        		</div>
                                
                            </div> <!-- end col -->

                            
                        </div>
@endsection
                        
                        
                        

                  
            
    @section('modal')        
      
    @endsection        
       

           



    
        
    
