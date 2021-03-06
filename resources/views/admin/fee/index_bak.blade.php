@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">费用管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="{{url('zadmin')}}">系统</a></li>
                                   
                                    <li class="active">费用明细列表</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                        			<div class="row">
			                        	<div class="col-sm-8">
			                        		<form role="form">
			                                    <div class="form-group contact-search m-b-30 col-sm-4">
			                                    	<input type="text" id="search" class="form-control" placeholder="Search..." name="keyword" value="{{array_get($param,'keyword')}}">
			                                        
			                                    </div>
                                          <div class="col-sm-3">
                                            <select name="fee_type_id" class="form-control">
                                              <option value="">请选择费目</option>
                                              @foreach($feeTypes as $ft)
  <option value="{{$ft->id}}" {{array_get($param,'fee_type_id')==$ft->id?'selected':''}}>{{$ft->name}}</option>
                                              @endforeach
                                            </select>
                                          </div>
                                          <div class="col-sm-3">
  <input type="text" name="year_month" class="form-control" value="{{array_get($param,'year_month')}}" placeholder="月份：2019-04">
                                          </div>
                                          <div class="col-sm-2">
                                            <button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
                                          </div> <!-- form-group -->
			                                </form>
			                        	</div>
			                        	<div class="col-sm-2">
			                        		

                                  <a href="{{url('zadmin/fee/create')}}" class="btn btn-primary btn-md waves-effect waves-light m-b-30" ><i class="md md-add"></i>添加</a>
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
													<th>业主</th>
												  <th>费目</th>
                          <th>月份</th>
                          <th>用量</th>
                          <th>费用</th>
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
                                                        {{object_get($v,'yezhu.name')}}
                                                    </td>
                                                    <td>
                                                        {{object_get($v,'feeType.name')}}
                                                    </td>
                                                    <td>
                                                        {{$v->year_month}}
                                                    </td>
                              <td>{{$v->used_num}} {{$v->fee_type_id==1?'吨':'度'}}</td>
                                                    <td>{{$v->total_price}} 元</td>
                                                  
                                                    
                                                   
                                                    <td>
                                                    	<a href="{{url('zadmin/fee/'.$v->id.'/edit')}}" ><i class="md md-edit"></i>详情</a>
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
                        
                        
                        

                  
            
   
       

           



    
        
    
