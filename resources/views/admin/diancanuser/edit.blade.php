@extends('admin.layouts.app')
@section('css')
        <!-- Custombox css -->
       
       
         <link href="{{asset('admin/plugins/select2/css/select2.css')}}" rel="stylesheet">
@endsection 
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">用餐职工管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                    <li><a href="{{url('zadmin/diancan/users')}}">用餐职工列表</a></li>
                                    <li class="active">修改用餐职工</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                            <h2 class="m-t-0 header-title">修改用餐职工</h2>
                            <hr/>
                             @if(session('rs'))
                              <div class="alert alert-{{session('rs')['status']}}">
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
                        			<div class="row">
			                        	<div class="col-md-6">
                                  <form class="form-horizontal" role="form" action="{{url('zadmin/diancan/users/'.$data->id)}}" method="post" enctype="multipart/form-data">{{ method_field('PUT') }}
                                      <div class="form-group">
                                                  <label class="col-md-2 control-label">微信用户</label>
                        <div class="col-md-10">
                          <select class="form-control select2" name="openid" id="openid">
                            <option value="">请选择</option>
                            @foreach($wxusers as $wxuser)
                            <option value="{{$wxuser->openid}}" {{$wxuser->openid==$data->openid?'selected':''}}>{{$wxuser->nickname}}</option>
                            @endforeach
                          </select>
                        </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">姓名</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="name" required="" value="{{$data->name}}">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">电话</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="mobile" required="" value="{{$data->mobile}}">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">科室</label>
                                                  <div class="col-md-10">
                                                      <select class="form-control select2" name="department" >
                                                    <option value="">请选择</option>
                            @foreach($departs as $d)
                            <option value="{{$d->name}}" {{$data->department==$d->name?'selected':''}} >{{$d->name}}</option>
                            @endforeach
                          </select>  
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">职位</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="position" required="" value="{{$data->position}}">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">餐补标准/天</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="day_money" required="" value="{{$data->day_money}}">
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
                        
                        
                        

                  
            
    @section('modal')        
     
    @endsection        
       

           



    
  @section('js')
  <script type="text/javascript" src="{{asset('admin/plugins/select2/js/select2.min.js')}}"></script>
  <script type="text/javascript">
    $('#openid').select2();        
  </script>
        @endsection
    
