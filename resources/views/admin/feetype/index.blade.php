@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">费用类型管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="{{url('zadmin')}}">系统</a></li>
                                   
                                    <li class="active">费用类型列表</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                        			<div class="row">
			                        	<div class="col-sm-8">
			                        		<form role="form">
			                                    <div class="form-group contact-search m-b-30 col-sm-8">
			                                    	<input type="text" id="search" class="form-control" placeholder="Search...">
			                                        
			                                    </div>
                                          <div class="col-sm-4">
                                            <button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
                                          </div> <!-- form-group -->
			                                </form>
			                        	</div>
			                        	<div class="col-sm-4">
			                        		

                                  <a href="#custom-modal" class="btn btn-primary btn-md waves-effect waves-light m-b-30" data-animation="fadein" data-plugin="custommodal" 
                                                            data-overlaySpeed="200" data-overlayColor="#36404a"><i class="md md-add"></i>添加</a>
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
													<th>费用名称</th>
												  <th>单价</th>
                         
                         
													<th style="width: 200px;">操作</th>
												</tr>
											</thead>
											
                                            <tbody>

                                            @foreach($list as $v)
                                                <tr>
                                                    <td>
                                                        {{$v->id}}
                                                        
                                                      
                                                    </td>
                                                    
                                                    <td>
                                                        {{$v->name}}
                                                    </td>
                                                    <td>{{$v->price}}</td>
                                                  
                                                    
                                                   
                                                    <td>
                                                    	<a href="{{url('zadmin/feetype/'.$v->id.'/edit')}}" ><i class="md md-edit"></i>编辑</a>
                                                    	<a href="{{url('zadmin/feetype',$v->id)}}" data-method="delete" 
  data-token="{{csrf_token()}}" data-confirm="确定删除吗?"><i class="md md-close"></i>删除</a>
                                                    </td>
                                                </tr>
                                            @endforeach    
                                                
                                               
                                               
                                                
                                               
                                                
                                            
                                            </tbody>
                                        </table>
                                    </div>
                        		</div>
                                
                            </div> <!-- end col -->

                            
                        </div>
@endsection
                        
                        
                        

                  
            
    @section('modal')        
        <!-- Modal -->
      <div id="custom-modal" class="modal-demo">
          <button type="button" class="close" onclick="Custombox.close();">
              <span>&times;</span><span class="sr-only">Close</span>
          </button>
          <h4 class="custom-modal-title">添加费用类型</h4>
          <div class="custom-modal-text text-left">
              <form class="form-horizontal" role="form" action="{{url('zadmin/feetype')}}" method="post" enctype="multipart/form-data">                                    
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">费用名称</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="name" value="" required="">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">单价</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="price" value="" required="">
                                                  </div>
                                              </div>
                                              
                                                                                                                    
                                              <!-- <div class="form-group">
                                                  <label class="col-md-2 control-label">备注</label>
                                                  <div class="col-md-10">
                                                      <textarea class="form-control" rows="5" name="remark"></textarea>
                                                  </div>
                                              </div> -->

                                              <div class="form-group text-center">
                                                  
                                                  <button type="submit" class="btn btn-info waves-effect waves-light">保存</button>
                                              </div>
                                              
                                              
                             {{csrf_field()}}
                                          </form>
          </div>
      </div>
    @endsection        
       

           



    
        
    
