@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">用户管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                    <li><a href="#">系统设置</a></li>
                                    <li class="active">微信用户列表</li>
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
                                            <input type="text" id="search" class="form-control" name="keyword" placeholder="Search...">
                                              <button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
                                          </div> <!-- form-group -->
                                      </form>
                                </div>
                                <div class="col-sm-2">
                                  

   <a href="{{url('zadmin/wechat/wxuser/pull')}}" class="btn btn-primary btn-md waves-effect waves-light m-b-30" ><i class="md md-add"></i>拉取微信粉丝</a>
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
													<th>微信名</th>
													
                          <th>头像</th>
                          <th>地址</th>
                          
                         
                         
                         
													<th style="width: 200px;">操作</th>
												</tr>
											</thead>
											
      <tbody>

      @foreach($list as $v)
          <tr>
            <td>
                {{$v['openid']}}
            </td>
                                                    
            <td>
                {{$v['nickname']}}
            </td>
            <td><img src="{{$v['headimgurl']}}" width="30" /></td>
            <td>{{$v['country'].$v['province'].$v['city']}}</td>
           
                                                  
                                                    
                                                
                                                    
                                                   
            <td>
              <a href="#custom-modal" class="btn btn-primary btn-md waves-effect waves-light m-b-30 usegroup" data-animation="fadein" data-plugin="custommodal"                                                            data-overlaySpeed="200" data-overlayColor="#36404a" data-openid="{{$v['openid']}}" data-avatar="{{$v['headimgurl']}}" data-nickname="{{$v['nickname']}}">角色</a>

              <a href="#msg-modal" class="btn btn-success btn-md waves-effect waves-light m-b-30 usermsg" data-animation="fadein" data-plugin="custommodal"                                                            data-overlaySpeed="200" data-overlayColor="#36404a" data-openid="{{$v['openid']}}">消息</a>
              
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
          <h4 class="custom-modal-title">微信用户分组</h4>
          <div class="custom-modal-text text-left">
              <form class="form-horizontal" role="form" action="{{url('zadmin/wechat/wxuser/save-user')}}" method="post">                                    
                  <div class="form-group">
                    <label class="col-md-2 control-label">openid</label>
                    <div class="col-md-10">
                      <input type="text" class="form-control" name="openid" value="" required="" name="openid">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label">微信名</label>
                    <div class="col-md-10">
                      <input type="text" class="form-control" name="nickname" value="" required="">
                    </div>
                  </div>
                  
                                              
                
                <div class="form-group">
                  <label class="col-md-2 control-label">头像</label>
                  <div class="col-md-10">
                    <img src="" id="avatar" />
                    <input type="text" class="form-control" name="avatar" value="" required="">
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-md-2 control-label">姓名</label>
                  <div class="col-md-10">
                    <img src="" id="avatar" />
                    <input type="text" class="form-control" name="truename" value="" required="">
                  </div>
              </div>

              <div class="form-group">
                  <label class="col-md-2 control-label">手机号</label>
                  <div class="col-md-10">
                    <img src="" id="avatar" />
                    <input type="text" class="form-control" name="mobile" value="" required="">
                  </div>
              </div>
                                              
                
                                             
                 
                                             
              <div class="form-group">
                <label class="col-md-2 control-label">角色</label>
                <div class="col-md-10">
                  <select  class="form-control" name="role_id" value="" required="">
                    <option value="">请选择角色</option>
                      @foreach($roles as $role)
                    <option value="{{$role->code}}">{{$role->name}}</option>
                      @endforeach
                  </select>
              </div>
          </div>
                                              
                                                                                                                    
                                              

          <div class="form-group text-center">
                                                  
            <button type="submit" class="btn btn-info waves-effect waves-light">保存</button>
          </div>
                                              
                                              
                             {{csrf_field()}}
                                          </form>
          </div>
      </div>



       <div id="msg-modal" class="modal-demo">
          <button type="button" class="close" onclick="Custombox.close();">
              <span>&times;</span><span class="sr-only">Close</span>
          </button>
          <h4 class="custom-modal-title">推送客服消息</h4>
          <div class="custom-modal-text text-left">
              <form class="form-horizontal" role="form" action="{{url('zadmin/wechat/send-msg')}}" method="post">                                    
                  <div class="form-group">
                    <label class="col-md-2 control-label">openid</label>
                    <div class="col-md-10">
                      <input type="text" class="form-control" name="openid" value="" required="" name="openid">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-2 control-label">消息</label>
                    <div class="col-md-10">

                      <textarea  class="form-control" name="msg"  required=""></textarea>
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

    @section('js')
    <script type="text/javascript">
        $('.usegroup').on('click',function(){
          var data = $(this).data();
          $('input[name="openid"]').val(data.openid);
          $('input[name="nickname"]').val(data.nickname);
          $('input[name="avatar"]').val(data.avatar);
          $('#avatar').prop('src',data.avatar);
        });

        $('.usermsg').on('click',function(){
          var data = $(this).data();
          $('input[name="openid"]').val(data.openid);       
        });
    </script>
       
    @endsection    
       

           



    
        
    
