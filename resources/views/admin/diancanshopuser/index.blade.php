@extends('admin.layouts.app')
@section('css')
        <!-- Custombox css -->
       
       
         <link href="{{asset('admin/plugins/select2/css/select2.css')}}" rel="stylesheet">
@endsection
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">操作员管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="{{url('zadmin')}}">系统</a></li>
                                   
                                    <li class="active">操作员列表</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                        			<div class="row">
			                        	<div class="col-sm-8">
			                        		<form role="form">
			                                    <div class="form-group contact-search m-b-30 col-sm-6">
			                                    	<input type="text" id="search" class="form-control" placeholder="Search...">
			                                        
			                                    </div>
                                          <div class="form-group col-sm-3">
                                            <select class="form-control" name="shop_id">
                                               <option value="">请选择店铺</option>
                                              @foreach($shops as $d)
                                             
          <option value="{{$d->id}}" {{$d->id==array_get($param,'shop_id')?'selected':''}}>{{$d->name}}</option>
                                              @endforeach
                                            </select>
                                          </div>
                                          <div class="col-sm-3">
                                            <button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
                                          </div> <!-- form-group -->
			                                </form>
			                        	</div>
			                        	<div class="col-sm-4">
			                        		

                                  <a href="{{url('zadmin/diancan/shopusers/create')}}" class="btn btn-primary btn-md waves-effect waves-light m-b-30" ><i class="md md-add"></i>添加</a>
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
                          <th>商户</th>
													<th>姓名</th>                         
                          <th>电话</th>
                          <th>密码</th>
                         
                         
                         
													<th style="width: 200px;">操作</th>
												</tr>
											</thead>
											
                                            <tbody>

                                            @foreach($list as $v)
                                                <tr>
                                                    <td>
                                                        {{$v->id}}
                                                        
                                                      
                                                    </td>
                                      <td>{{object_get($v,'shop.name')}}</td>              
                                                    <td>
                                                        {{$v->name}}
                                                    </td>
                                                   
                                                    <td>
                                                      {{$v->mobile}}
                                                    </td>
                                                <td>{{$v->password}}</td>    
                                               
                                               
                                                   
                                                    <td>
  <a href="{{url('zadmin/diancan/shopusers/'.$v->id.'/edit')}}" ><i class="md md-edit"></i>编辑</a>
  <a href="{{url('zadmin/diancan/shopusers',$v->id)}}" data-method="delete" 
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
                        
                        
                        

    

    @section('js')
     <script type="text/javascript" src="{{asset('admin/plugins/select2/js/select2.min.js')}}"></script>
  <script type="text/javascript">
    $('#openid').select2();        
  </script>
    @endsection      
       

           



    
        
    
