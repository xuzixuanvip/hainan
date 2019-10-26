@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">用户管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                    <li><a href="#">系统设置</a></li>
                                    <li class="active">用户列表</li>
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
			                        	<div class="col-sm-2">
			                        		

   <!--  <a href="#custom-modal" class="btn btn-primary btn-md waves-effect waves-light m-b-30" data-animation="fadein" data-plugin="custommodal"                                                            data-overlaySpeed="200" data-overlayColor="#36404a"><i class="md md-add"></i>添加</a> -->
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
													<th>账号</th>
													
                          <th>姓名</th>
                          <th>手机号码</th>
                          <!-- <th>邮箱</th>
                          <th>来源</th> -->
                          <th>角色</th>
                          <th>工单</th>
                         
                         
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
                            {{$v->username}} 
                                                    </td>
                          <td>{{$v->truename}} {{$v->nickname}}</td>
                          <td>{{$v->mobile}}</td>
                         
                         
                          <td>{{object_get($v,'role.name')}}</td>
                          <th><a href="{{url('zadmin/task')}}?worker_id={{$v->id}}">{{$v->task->count()}}</a></th>
                                                    
                                                    
                                                
                                                    
                                                   
                                                    <td>
                                                     
                                                    	<a href="{{url('zadmin/users/'.$v->id.'/edit')}}" ><i class="md md-edit"></i>编辑</a>
                                                     
                                                    	<a href="{{url('zadmin/users',$v->id)}}" data-method="delete" 
  data-token="{{csrf_token()}}" data-confirm="确定删除吗?"><i class="md md-close"></i>删除</a> 

                                                    </td>
                                                </tr>
                                            @endforeach    
                                                
                                               
                                               
                                                
                                               
                                                
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                    {{$list->links()}}
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
          <h4 class="custom-modal-title">添加用户</h4>
          <div class="custom-modal-text text-left">
              <form class="form-horizontal" role="form" action="{{url('zadmin/users')}}" method="post" enctype="multipart/form-data">                                    
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">账号</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="username" value="" required="">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">密码</label>
                                                  <div class="col-md-10">
                                                      <input type="password" class="form-control" name="password" value="" required="">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">密码确认</label>
                                                  <div class="col-md-10">
                                                      <input type="password" class="form-control" name="password2" value="" required="">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">手机号码</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="mobile" value="" required="">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">E-mail</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="email" value="" required="">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">真实姓名</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="truename" value="" required="">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">来源</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="source" value="" >
                                                  </div>
                                              </div>
                  @if(session('admin')->role_id==100)                            
                  <div class="form-group">
                      <label class="col-md-2 control-label">部门</label>
                      <div class="col-md-10">
                                                      <select  class="form-control" name="depart_id" value="" >
                                                      <option value="">请选择部门</option>
                                                      @foreach($departs as $depart)
                                                      <option value="{{$depart->id}}">{{$depart->name}}</option>
                                                      @endforeach
                                                      </select>
                                                  </div>
                                              </div>
                                             
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">角色</label>
                                                  <div class="col-md-10">
                                                      <select  class="form-control" name="role_id" value="" required="">
                                                      <option value="">请选择角色</option>
                                                      @foreach($roles as $role)
                                                      <option value="{{$role->id}}">{{$role->name}}</option>
                                                      @endforeach
                                                      </select>
                                                  </div>
                                              </div>
                         @endif                      
                                                                                                                    
                                              

                                              <div class="form-group text-center">
                                                  
                                                  <button type="submit" class="btn btn-info waves-effect waves-light">保存</button>
                                              </div>
                                              
                                              
                             {{csrf_field()}}
                                          </form>
          </div>
      </div>





     
    @endsection        
       

           



    
        
    
