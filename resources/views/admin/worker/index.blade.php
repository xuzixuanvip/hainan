@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">维修工管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                    <li><a href="#">系统设置</a></li>
                                    <li class="active">维修工列表</li>
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
													

                          <th>头像</th>
                          <th>姓名</th>
													<th>电话号码</th>
                          <th>工种</th>
                          <th>负责区域</th>
                          <th>备注</th> 
                         
                         
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
                                                       <img src="{{$v->avatar or ''}}" width="60" />
                                                    </td>
                                                    <td>
                                                      {{$v->truename}}
                                                    </td>
                                                    <td>
                                                        {{$v->mobile or ''}}
                                                    </td>
                                                    <td>
                                                        {{object_get($v,'worktype.name')}}
                                                    </td>
                                                    <td>{{object_get($v,'depart.name')}}</td>
                                                     <td>
                                                        {{$v->remark or ''}}
                                                    </td>                                                    
                                                    
                                                    
                                                
                                                    
                                                   
                                                    <td>
                                                    	<a href="{{url('zadmin/worker/'.$v->id.'/edit')}}" ><i class="md md-edit"></i>编辑</a>
                                                    	<a href="{{url('zadmin/worker',$v->id)}}" data-method="delete" 
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
       

           



    
        
    
