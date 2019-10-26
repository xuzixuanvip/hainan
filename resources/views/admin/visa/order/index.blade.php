@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">签证订单管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                    <li><a href="#">系统设置</a></li>
                                    <li class="active">签证订单列表</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                              <div class="row">
                                <div class="col-sm-4">
                                  

                                  <a href="#custom-modal" class="btn btn-primary btn-md waves-effect waves-light m-b-30" data-animation="fadein" data-plugin="custommodal" 
                                                            data-overlaySpeed="200" data-overlayColor="#36404a"><i class="md md-add"></i>添加</a>
                                </div>
                              </div>
                        			<div class="row">
			                        	<div class="col-sm-12">
			                        		<form role="form" action="{{url('zadmin/visa/order/batch-update')}}" method="post">
                                    <div class="col-sm-6">
			                                    <div class="form-group contact-search m-b-30">
			                                    	<input type="text"  class="form-control" name="service_code" placeholder="受理号码，多个用英文逗号隔开" required="">
                                           
			                                       
			                                    </div> 
                                    </div>  
                                    <div class="col-sm-3">
                                          <div class="form-group contact-search m-b-30">
                                            <input type="text" id="search" class="form-control" name="remark" placeholder="备注：快递单号等" >
                                           
                                             
                                          </div> 
                                    </div>
                                    <div class="col-sm-2">
                                         <select class="form-control" name="process_id" required="">
                                          <option value="">选择流程</option>
                                                      @foreach($processes as $p)  
                                                        <option value="{{$p->id}}">{{$p->name}}</option>
                                                      @endforeach  
                                                      </select>
                                    </div>
                                    <div class="col-sm-1">
                                      <button type="submit" class="btn btn-success">更新</button>
                                    </div> 
                                    {{csrf_field()}}   
			                             </form>
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
													<th>受理号码</th>
                          <th>客户姓名</th>
                          <th>手机号</th>
                          <th>申请国家</th>
                          <th>当前流程</th>			
                         
                         
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
                                                        {{$v->service_code}}
                                                    </td>
                                                    <td>
                                                        {{$v->name}}
                                                    </td>
                                                    <td>
                                                        {{$v->phone}}
                                                    </td>
                                                    <td>
                                                        {{$v->country->name or ''}}
                                                    </td>
                                                    <td>
                                                        {{$v->process->name or ''}}
                                                    </td>
                                                    
                                                    
                                                    
                                                
                                                    
                                                   
                                                    <td>
                                                    	<a href="{{url('zadmin/visa/order/'.$v->id.'/edit')}}" ><i class="md md-edit"></i>编辑</a>
                                                    	<a href="{{url('zadmin/visa/order',$v->id)}}" data-method="delete" 
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
          <h4 class="custom-modal-title">添加签证订单</h4>
          <div class="custom-modal-text text-left">
              <form class="form-horizontal" role="form" action="{{url('zadmin/visa/order')}}" method="post">                                    
                                             
                                              
                                                                                                                    
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">客户姓名</label>
                                                  <div class="col-md-10">
                                                       <input type="text" class="form-control" name="name" value="" >
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">手机号码</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="phone" value="" required="">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">申请国家</label>
                                                  <div class="col-md-10">
                                                      <select class="form-control" name="country_code">
                                                      @foreach($countries as $c)  
                                                        <option value="{{$c->code}}">{{$c->name}}</option>
                                                      @endforeach  
                                                      </select>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">当前流程</label>
                                                  <div class="col-md-10">
                                                      <select class="form-control" name="process_id">
                                                      @foreach($processes as $p)  
                                                        <option value="{{$p->id}}">{{$p->name}}</option>
                                                      @endforeach  
                                                      </select>
                                                  </div>
                                              </div>

                                              <div class="form-group text-center">
                                                  
                                                  <button type="submit" class="btn btn-info waves-effect waves-light">保存</button>
                                              </div>
                                              
                                              
                             {{csrf_field()}}
                                          </form>
          </div>
      </div>
    @endsection        
       

           



    
        
    
