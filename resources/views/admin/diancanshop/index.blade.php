@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">食堂商户管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="{{url('zadmin')}}">系统</a></li>
                                   
                                    <li class="active">食堂商户列表</li>
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
			                        		

                                  <a href="{{url('zadmin/diancan/shops/create')}}" class="btn btn-primary btn-md waves-effect waves-light m-b-30" ><i class="md md-add"></i>添加</a>
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
                          <th>图片</th>
													<th>商户名</th>
                          <th>地址</th>
                          <th>联系人</th>
                          <th>电话</th>
												  <th>Tags</th>
                          <th>状态</th>
                          <th>操作员</th>
                         
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
                                                      <img src="{{$v->pic}}" width="45" />
                                                    </td>
                                                    
                                                    <td>
                                                        {{$v->name}}
                                                    </td>
                                                    <td>{{$v->address}}</td>
                                                    <td>{{$v->contacter}}</td>
                                                    <td>
                                                      {{$v->mobile}}
                                                    </td>
                                                    <td>{{$v->tags}}</td>
                <td>{{$v->status==1?'营业中':'关店'}}</td>
                <td>
                  <a href="{{url('zadmin/diancan/shopusers')}}?shop_id={{$v->id}}">操作员</a>
                </td> 
                                                    <td>
                                                    	<a href="{{url('zadmin/diancan/shops/'.$v->id.'/edit')}}" ><i class="md md-edit"></i>编辑</a>
                                                    	<a href="{{url('zadmin/diancan/shops',$v->id)}}" data-method="delete" 
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
                        
                        
                        

                  
            
    
       

           



    
        
    
