@extends('admin.layouts.app')
@section('css')
        <!-- Custombox css -->
       
       
         <link href="{{asset('admin/plugins/select2/css/select2.css')}}" rel="stylesheet">
@endsection
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">职工管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="{{url('zadmin')}}">系统</a></li>
                                   
                                    <li class="active">职工列表</li>
                                </ol>
                            </div>
                        </div>
                       <div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="card-box widget-box-1 bg-white">
                                  <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                                  <h4 class="text-dark">职工总数</h4>
                                  <h2 class="text-primary text-center"><span data-plugin="counterup">{{$total_user}}</span></h2>
                                  
                                </div>
                            </div>

                            

                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="card-box widget-box-1 bg-white">
                                    <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                                    <h4 class="text-dark">今日就餐人数</h4>
                                    <h2 class="text-success text-center"><span data-plugin="counterup">{{$today_user}}</span></h2>
                                    
                                </div>
                            </div>

                             <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="card-box widget-box-1 bg-white">
                                    <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                                    <h4 class="text-dark">昨日就餐人数</h4>
                                    <h2 class="text-info text-center"><span data-plugin="counterup">{{$yesterday_user}}</span></h2>
                                    
                                </div>
                            </div>

                    

                        </div> 
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                        			<div class="row">
			                        	<div class="col-sm-8">
			                        		<form role="form">
			                                    <div class="form-group contact-search m-b-30 col-sm-6">
			     <input type="text" id="search" class="form-control" name="keyword" value="{{array_get($param,'keyword')}}" placeholder="Search...">
			                                        
			                                    </div>
                                          <div class="form-group col-sm-3">
                                            <select class="form-control" name="department">
                                               <option value="">请选择部门</option>
                                              @foreach($departs as $d)
                                             
          <option value="{{$d->name}}" {{$d->name==array_get($param,'department')?'selected':''}}>{{$d->name}}</option>
                                              @endforeach
                                            </select>
                                          </div>
                                          <div class="col-sm-3">
                                            <button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
                                          </div> <!-- form-group -->
			                                </form>
			                        	</div>
			                        	<div class="col-sm-4">
			                        		

                                  <a href="{{url('zadmin/diancan/users/create')}}" class="btn btn-primary btn-md waves-effect waves-light m-b-30" ><i class="md md-add"></i>添加</a>
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
                          <th>照片</th>
													<th>姓名</th>                         
                          <th>电话</th>
                          <th>密码</th>
                          <th>科室</th>
                          <th>职位</th>
                          <th>餐补标准</th>
												  <th>今日剩余</th>
                          <th>订单总数</th>
                         
													<th style="width: 200px;">操作</th>
												</tr>
											</thead>
											
                                            <tbody>

                                @foreach($list as $k=>$v)
                                                <tr>
                                <td>{{($start+$k)}}
                                <td>
                                  @if($v->avatar)
                                  <a href=""><img src='{{$v->avatar}}' width="45"/>
                                  </a>
                                  @else
                                  未上传
                                  @endif
                                </td>                        
                                                      
                                                    </td>
                                                    
                                                    <td>
                                                        {{$v->name}}
                                                    </td>
                                                   
                                                    <td>
                                                      {{$v->mobile}}
                                                    </td>
                                                <td>{{$v->password}}</td>    
                                                    <td>{{$v->department}}</td>
                                                <td>{{$v->position}}</td>
                                                <td>{{$v->day_money}}/天</td>
                                    <td>{{$v->money}}</td>
                                    <td>
                                      <a href="{{url('zadmin/diancan/orders')}}?user_id={{$v->id}}">{{$v->orders->count()}}
                                      </a>
                                    </td>  
                                                   
                                                  <td>
  <a href="{{url('zadmin/diancan/users/'.$v->id.'/edit')}}" ><i class="md md-edit"></i>编辑</a>
  <a href="{{url('zadmin/diancan/users',$v->id)}}" data-method="delete" 
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
                        
                        
                        

    

    @section('js')
     <script type="text/javascript" src="{{asset('admin/plugins/select2/js/select2.min.js')}}"></script>
  <script type="text/javascript">
    $('#openid').select2();        
  </script>
    @endsection      
       

           



    
        
    
