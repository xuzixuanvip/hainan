@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">维修工管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                    <li><a href="#">系统设置</a></li>
                                    <li class="active">修改维修工</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                            <h2 class="m-t-0 header-title">修改维修工</h2>
                            <hr/>
                             @if(session('rs'))
                              <div class="alert alert-{{session('rs')['status']}}">
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
                        			<div class="row">
			                        	<div class="col-md-6">
                                  <form class="form-horizontal" role="form" action="{{url('zadmin/worker/'.$data->id)}}" method="post" >{{ method_field('PUT') }}

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">维修工名称</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="truename" required="" value="{{$data->truename}}">
                                                  </div>
                                              </div>
                                               <div class="form-group">
                                                  <label class="col-md-2 control-label">手机号</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="mobile" required="" value="{{$data->mobile}}">
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">工种</label>
                                                  <div class="col-md-10">
                                                      <select name="worktype_id" class="form-control">
                                                        <option value="">请选择工种</option>
                                                        @foreach($worktypes as $wt)
                                                        <option value="{{$wt->id}}" {{$wt->id==$data->worktype_id?'selected':''}}>{{$wt->name}}</option>
                                                        @endforeach
                                                      </select>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">负责区域</label>
                                                  <div class="col-md-10">
                                                      <select name="depart_id" class="form-control">
                                                        <option value="">请选择</option>
                                                        @foreach($departs as $d)
                                                        <option value="{{$wt->id}}" {{$d->id==$data->depart_id?'selected':''}}>{{$d->name}}</option>
                                                        @endforeach
                                                      </select>
                                                  </div>
                                              </div>
                                                                                                                 
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">备注</label>
                                                  <div class="col-md-10">
                                                      <textarea class="form-control" rows="5" name="remark">{{$data->remark}}</textarea>
                                                  </div>
                                              </div>

                                              <div class="form-group text-center">
                                                  
                                                  <button type="submit" class="btn btn-info waves-effect waves-light">保存</button>
                                              </div>
                                              
                                              
                             {{csrf_field()}}
                                          </form>
                                </div>
			                        	
			                        </div>

                             
			                        
                        			
                        		</div>
                                
                            </div> <!-- end col -->

                            
                        </div>
@endsection
                        
                        
                        

                  
            
    
       

           



    
       
    
