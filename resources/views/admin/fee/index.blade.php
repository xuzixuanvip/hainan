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
			            @foreach($yezhus as $yezhu) 
                  <div class="card-box">
                  <div class="row">
                    <p>用户：{{$yezhu->name}} ，单元：【{{$yezhu->unite_num}}单元】 楼层：【{{$yezhu->floor_num}}楼】 【{{$yezhu->room_num}}】</p>
                  </div>           
                  <div class="table-responsive">
                      <table class="table table-hover">
                        <thead>
												<tr>
													<th>月份</th>
													<th>上月度数</th>
												  <th>本月度数</th>
                          <th>使用度数</th>
                          <th>金额</th>
                          <th>电费</th>
                          <th>上月吨数</th>
                          <th>本月吨数</th>
                          <th>使用吨数</th>
                          <th>金额</th>
                          <th>水费</th>
                          <th>合计</th>
                          <th>备注</th>
                          <th>打印</th>
                          <th>操作</th>
													
												</tr>
											</thead>
											
                                            <tbody>

                                            @foreach($months as $v)
                                                <tr>
                                                    <td>
                                                        {{$v}}月
                                                        
                                                      
                                                    </td>
                                                    
                                                    <td>
      {{object_get($fees[$yezhu->id]['2019-'.$v]['dianfei'],'prenum')}}
                                                    </td>
                              <td>
                              {{object_get($fees[$yezhu->id]['2019-'.$v]['dianfei'],'current_num')}}                          
                              </td>
                              <td>
                                {{object_get($fees[$yezhu->id]['2019-'.$v]['dianfei'],'used_num')}}
                              </td>
                              <td>{{object_get($fees[$yezhu->id]['2019-'.$v]['dianfei'],'price')}}</td>
                              <td>
                                 {!!object_get($fees[$yezhu->id]['2019-'.$v]['dianfei'],'total_price')?'<span class="label label-info">'.object_get($fees[$yezhu->id]['2019-'.$v]['dianfei'],'total_price').'</span>':''!!}</span></td>

                              <td>{{object_get($fees[$yezhu->id]['2019-'.$v]['shuifei'],'prenum')}}</td>
                              <td>{{object_get($fees[$yezhu->id]['2019-'.$v]['shuifei'],'current_num')}}</td>
                              <td>{{object_get($fees[$yezhu->id]['2019-'.$v]['shuifei'],'used_num')}}</td>
                              <td>{{object_get($fees[$yezhu->id]['2019-'.$v]['shuifei'],'price')}}</td>
                              <td>
                                {!!object_get($fees[$yezhu->id]['2019-'.$v]['shuifei'],'total_price')?'<span class="label label-success">'.object_get($fees[$yezhu->id]['2019-'.$v]['shuifei'],'total_price').'</span>':''!!}</td>

                              <td>{{object_get($fees[$yezhu->id]['2019-'.$v]['dianfei'],'total_price')+object_get($fees[$yezhu->id]['2019-'.$v]['dianfei'],'total_price')}}</td>
                              <Td>{{object_get($fees[$yezhu->id]['2019-'.$v]['dianfei'],'remark')}},{{object_get($fees[$yezhu->id]['2019-'.$v]['shuifei'],'remark')}}</Td>
                              <td><a href="" class="btn-sm btn btn-primary">打印</a></td>
                              <td>
                              @if(object_get($fees[$yezhu->id]['2019-'.$v]['dianfei'],'total_price'))
                              <a href="{{url('zadmin/fee/change')}}?yezhu_id={{$yezhu->id}}&year_month={{'2019-'.$v}}" class="btn btn-warning btn-sm">修改</a>
                              @else 
                              <a href="{{url('zadmin/fee/create')}}?yezhu_id={{$yezhu->id}}&year_month={{'2019-'.$v}}" class="btn btn-default btn-sm">
                                添加
                              </a> 
                              @endif 
                              @if(object_get($fees[$yezhu->id]['2019-'.$v]['shuifei'],'id'))
                              <a href="{{url('zadmin/fee/del')}}?yezhu_id={{$yezhu->id}}&year_month={{'2019-'.$v}}"  class="btn btn-danger btn-sm">删除</a>
                              @endif
                            </td>
                             
                                                </tr>
                                            @endforeach    
                                                
                                               
                                               
                                                
                                               
                                                
                                            
                                            </tbody>
                                        </table>
                                    </div>
                              </div>      
                            @endforeach        
                        		</div>
                                
                            </div> <!-- end col -->

                            
                        </div>
@endsection
                        
                        
                        

                  
            
   
       

           



    
        
    
