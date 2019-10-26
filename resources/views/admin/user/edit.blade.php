@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">用户管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                    <li><a href="#">系统设置</a></li>
                                    <li class="active">修改用户</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                            <h2 class="m-t-0 header-title">修改用户</h2>
                            <hr/>
                             @if(session('rs'))
                              <div class="alert alert-{{session('rs')['status']}}">
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
                        			<div class="row">
			                        	<div class="col-md-9">
                                  <form class="form-horizontal" role="form" action="{{url('zadmin/users/'.$data->id)}}" method="post" enctype="multipart/form-data">{{ method_field('PUT') }}

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">账号</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="username" value="{{$data->username}}" required="">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">密码</label>
                                                  <div class="col-md-10">
                                                      <input type="password" class="form-control" name="password" value="" >
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">密码确认</label>
                                                  <div class="col-md-10">
                                                      <input type="password" class="form-control" name="password2" value="">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">手机号码</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="mobile" value="{{$data->mobile}}" required="">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">openid</label>
                                                  <div class="col-md-8">
                                                      <input type="text" class="form-control" name="openid" value="{{$data->openid}}" required="" readonly="">
                                                      
                                                  </div>
                                                  <div class="col-md-2">
                                                    <button type="button" class="btn btn-warning" id="editOpenid">修改</button>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">真实姓名</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="truename" value="{{$data->truename}}" required="">
                                                  </div>
                                              </div>
                                              <!-- <div class="form-group">
                                                  <label class="col-md-2 control-label">来源</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="source" value="{{$data->source}}" required="">
                                                  </div>
                                              </div> -->
                        @if(session('admin')->role_id==999)                      
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">负责地区</label>
                                                  <div class="col-md-10">
                                                      <select  class="form-control" name="depart_id" value="" >
                                                      
                                                      @foreach($departs as $depart)
                                                      <option value="{{$depart->id}}" {{$depart->id==$data->depart_id?'selected':''}}>{{$depart->name}}</option>
                                                      @endforeach
                                                      </select>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">角色</label>
                                                  <div class="col-md-10">
                                                      <select  class="form-control" name="role_id" value="" required="">
                                                      
                                                      @foreach($roles as $role)
                                                      <option value="{{$role->code}}" {{$role->code==$data->role_id?'selected':''}}>{{$role->name}}</option>
                                                      @endforeach
                                                      </select>
                                                  </div>
                                              </div>
                                       @endif         
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
        <!-- Modal -->
      <div id="custom-modal" class="modal-demo">
          <button type="button" class="close" onclick="Custombox.close();">
              <span>&times;</span><span class="sr-only">Close</span>
          </button>
          <h4 class="custom-modal-title">账户充值</h4>
          <div class="custom-modal-text text-left">
              <form role="form" method="post" action="{{url('zadmin/seller/add-money')}}">

                 <div class="form-group">
                            <label for="position">卖家</label>
                            <input type="text" class="form-control" id="seller_name" disabled="" />
                  </div>
                <div class="form-group">
                  <label for="name">充值金额</label>
                  <input type="number" class="form-control" name="money" placeholder="">
                </div>
                        
                       
                       
                        <div class="form-group">
                            <label for="position">备注信息</label>
                            <textarea class="form-control" name="remark" ></textarea>
                        </div>
                        
                        
                        <button type="submit" class="btn btn-default waves-effect waves-light">保存</button>
                        <button type="button" class="btn btn-danger waves-effect waves-light m-l-10" onclick="Custombox.close();">取消</button>

                        <input type="hidden" name="seller_id" />
                        {{csrf_field()}}
                    </form>
          </div>
      </div>
    @endsection        
       

           



    
        @section('js')

        <script type="text/javascript">
         

          $('#editOpenid').on('click',function(){
            $('input[name="openid"]').removeAttr('readonly','');
           // / alert(233223);
          });
        </script>
        @endsection
    
