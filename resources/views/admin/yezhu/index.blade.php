@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">业主管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="{{url('zadmin')}}">系统</a></li>
                                   
                                    <li class="active">业主列表</li>
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
			 <input type="text" name="keyword" class="form-control" placeholder="姓名" value="{{array_get($param,'keyword')}}">
			                                        
			                                    </div>
                                          <div class="form-group contact-search m-b-30 col-sm-4">
                                            <select  name="unite_num" class="form-control" placeholder="单元">
                                              <option value="">全部</option>
                                              <option value="1" {{array_get($param,'unite_num')==1?'selected':''}}>1单元</option>
                                              <option value="2" {{array_get($param,'unite_num')==2?'selected':''}}>2单元</option>
                                              <option value="3" {{array_get($param,'unite_num')==3?'selected':''}}>3单元</option>
                                            </select>
                                              
                                          </div>
                                          <div class="col-sm-4">
                                            <button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
                                          </div> <!-- form-group -->
			                                </form>
			                        	</div>
			                        	<div class="col-sm-4">
			                        		

                                  <a href="{{url('zadmin/yezhu/create')}}" class="btn btn-primary"><i class="md md-add"></i>添加</a>
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
													
												  <th>单元</th>
                          <th>楼层</th>
                          <th>房间</th>
                          <th>业主</th>
                          <th>电话</th>
                          <th>水费单价</th>
                          <th>电费单价</th>
                          <th>备注</th>
                          <th>是否等级</th>
                          <th>是否缴费</th>
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
                          <a href="{{url('zadmin/fee/create')}}?unite_num={{$v->unite_num}}">{{$v->unite_num}}
                          </a>
                        </td>
                                                  
                        <td>
                          <a href="{{url('zadmin/fee/create')}}?floor_num={{$v->floor_num}}">{{$v->floor_num}}</a>
                        </td>
                                                    <td>{{$v->room_num}}</td>
                                                     <td>
                  <a href="{{url('zadmin/fee/create')}}?yezhu_id={{$v->id}}">{{$v->name}}</a>
                                                    </td>
                  <td>{{$v->mobile}}</td>
                  <td>{{$v->shuifei_price}}</td>
                  <td>{{$v->dianfei_price}}</td>                                  
                                                     <td>
                                                        {{$v->remark}}
                                                    </td>
                                                    <td>
                    {{$v->is_dengji?'是':'否'}}
                                                    </td>
                                                    <td>
                    {{$v->is_jiaofei?'是':'否'}}
                                                    </td>
                                                   
                                                    <td>
                                                    	<a href="{{url('zadmin/yezhu/'.$v->id.'/edit')}}" ><i class="md md-edit"></i>编辑</a>
                                                    	<a href="{{url('zadmin/yezhu',$v->id)}}" data-method="delete" 
  data-token="{{csrf_token()}}" data-confirm="确定删除吗?"><i class="md md-close"></i>删除</a>
                                                    </td>
                                                </tr>
                                            @endforeach    
                                                
                                               
                                               
                                                
                                               
                                                
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                    {{$list->appends($param)->links()}}
                        		</div>
                                
                            </div> <!-- end col -->

                            
                        </div>
@endsection
                        
                        
                        

                  
            
         
       

           



    
        
    
