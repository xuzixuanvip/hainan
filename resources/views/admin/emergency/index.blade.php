@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">应急救援联系人管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                    
                                    <li class="active">应急救援联系人列表</li>
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
			                                    	<input type="text" id="search" class="form-control" placeholder="Search..." name="keyword">
			                                        <button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
			                                    </div> <!-- form-group -->
			                                </form>
			                        	</div>
			                        	<div class="col-sm-4">
			                        		

                                  <a href="{{url('zadmin/emergency/create')}}" class="btn btn-primary btn-md waves-effect waves-light m-b-30" ><i class="md md-add"></i>添加</a>
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
													<th>姓名</th>
													
                          <th>电话号码</th> 
                          <th>短信</th>
                          <th>语音</th>
                          <th>录入时间</th>
                         
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
                                                      {{$v->name}}
                                                    </td>
                                                    
                                                    <td>{{$v->mobile}}</td>
                                                    <td>
<span class="btn btn-{{$v->is_msg?'success':'danger'}}">
                                                      {{$v->is_msg?'接收':'不接收'}}
                                                    </span></td>
                                                    <td>
                                                      <span class="btn btn-{{$v->is_voice?'success':'danger'}}">
                                                      {{$v->is_voice?'接收':'不接收'}}
                                                    </span></td>
                                                    <td>{{$v->created_at}}</td>
                                                
                                                    
                                                   
                                                    <td>
                                                    	<a href="{{url('zadmin/emergency/'.$v->id.'/edit')}}" ><i class="md md-edit"></i>编辑</a>
                                                    	<a href="{{url('zadmin/emergency',$v->id)}}" data-method="delete" 
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
        <!-- Modal -->
      <div id="custom-modal" class="modal-demo">
          <button type="button" class="close" onclick="Custombox.close();">
              <span>&times;</span><span class="sr-only">Close</span>
          </button>
          <h4 class="custom-modal-title">添加应急救援联系人</h4>
          <div class="custom-modal-text text-left">
              <form class="form-horizontal" role="form" action="{{url('zadmin/worklog')}}" method="post" enctype="multipart/form-data">                                    
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">服务图片</label>
                                                  <div class="col-md-10">
                                                      <input type="file" class="form-control" name="pic" value="" required="">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">服务日期</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="logtime" value="{{date('Y-m-d')}}" required="">
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
       

           



    
        
    
