@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">采购单管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="{{url('zadmin/')}}">系统</a></li>
                                   
                                    <li class="active">采购单列表</li>
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
			           <input type="text" id="search" name="keyword" class="form-control" placeholder="输入采购单号/采购人">
			             
			         </div>
               <div class="col-sm-4"><button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button></div> <!-- form-group -->
			     </form>
			                        	</div>
			                        	<div class="col-sm-4">
			                        		

                                  <a href="{{url('zadmin/purchases/create')}}" class="btn btn-primary btn-md waves-effect waves-light m-b-30"  
                                  ><i class="md md-add"></i>添加</a>
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
													<th>单号</th>
													<th>供应商</th>
                          <th>采购数量</th>
                          <th>采购人</th>
                          <!-- <th>入库状态</th>
                          <th>结算状态</th> -->
                         
                         
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
                      {{$v->code}}
                  </td>
                  <td>{{object_get($v,'supply.name')}}</td>
                  <td>
                      {{$v->caigou_num}}
                  </td>
                  <td>
                      {{$v->caigouer}}
                  </td>
                  <!-- <td>
                      {{$v->spending_num}}
                  </td>
                  <td>
                      {{$v->spending_money}}
                  </td>   -->                           
                                                    
                                                    
                                                
                                                    
                                                   
                  <td>
                    <a href="{{url('zadmin/purchases/'.$v->id.'/edit')}}" ><i class="md md-edit"></i>编辑</a>
                    <a href="{{url('zadmin/purchases',$v->id)}}" data-method="delete" 
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
       

           



    
        
    
