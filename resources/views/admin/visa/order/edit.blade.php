@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">签证订单管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                    <li><a href="#">系统设置</a></li>
                                    <li class="active">修改签证订单</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                            <h2 class="m-t-0 header-title">订单详情</h2>
                            <hr/>
                             @if(session('rs'))
                              <div class="alert alert-{{session('rs')['status']}}">
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
                        			<div class="row">
			                        	<div class="col-md-6">
                                  <form class="form-horizontal" role="form" action="{{url('zadmin/visa/order/'.$data->id)}}" method="post" enctype="multipart/form-data">{{ method_field('PUT') }}

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">受理单号</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="service_code" readonly="" value="{{$data->service_code}}">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">客户姓名</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="name" required="" value="{{$data->name}}">
                                                  </div>
                                              </div>
                                               <div class="form-group">
                                                  <label class="col-md-2 control-label">电话</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="phone" required="" value="{{$data->phone}}">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">国家</label>
                                                  <div class="col-md-10">
                                                      <select class="form-control" name="country_code">
                                                      @foreach($countries as $c)  
                                                        <option value="{{$c->code}}" {{$data->country_code==$c->code?'selected':''}}>{{$c->name}}</option>
                                                      @endforeach  
                                                      </select>
                                                  </div>
                                              </div>

                                               <div class="form-group">
                                                  <label class="col-md-2 control-label">流程</label>
                                                  <div class="col-md-10">
                                                      <select class="form-control" name="process_id">
                                                      @foreach($processes as $p)  
                                                        <option value="{{$p->id}}" {{$data->process_id==$p->id?'selected':''}}>{{$p->name}}</option>
                                                      @endforeach  
                                                      </select>
                                                  </div>
                                              </div>

                                               <div class="form-group">
                                                  <label class="col-md-2 control-label">备注</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="remark"  value="" placeholder="订单号等信息">
                                                  </div>
                                                </div>  
                                                                                                                 
                                             

                                              <div class="form-group text-center">
                                                  
                                                  <button type="submit" class="btn btn-info waves-effect waves-light">保存</button>
                                              </div>
                                              
                                              
                             {{csrf_field()}}
                                          </form>
                                </div>

                                <div class="col-md-6">
                                  <table class="table table-hover">
                                    <tr>
                                      <th>流程</th>
                                      <th>状态</th>
                                      <th>时间</th>
                                    </tr>
                                    @foreach($orderProcess as $op)
                                    <tr>
                                      <td width="100">{{$op->process->name or ''}}</td>
                                      <td width="100">{!!$op->status?'<a class="label label-success">已完成</span>':'<a class="label label-warning">未完成</span>'!!}</td>
                                      <td>{{$op->created_at}}</td>
                                    </tr>
                                    @endforeach
                                  </table>
                                </div>
			                        	
			                        </div>

                             
			                        
                        			
                        		</div>
                                
                            </div> <!-- end col -->

                            
                        </div>
@endsection
                        
                        
                        

                  
            
    @section('modal')        
    
      </div>
    @endsection        
       

           



    
        @section('js')

       
        @endsection
    
