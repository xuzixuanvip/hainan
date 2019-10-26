@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">平台管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                    <li><a href="#">系统设置</a></li>
                                    <li class="active">管理员</li>
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
			                                    	<input type="text" id="search" class="form-control" placeholder="Search...">
			                                        <button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
			                                    </div> <!-- form-group -->
			                                </form>
			                        	</div>
			                        	<div class="col-sm-4">


                                  <a href="#custom-modal" class="btn btn-primary btn-md waves-effect waves-light m-b-30" data-animation="fadein" data-plugin="custommodal"
                                                            data-overlaySpeed="200" data-overlayColor="#36404a"><i class="md md-add"></i>添加</a>
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
													<th>用户名</th>



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
                                                        {{$v->username}}
                                                    </td>






                                                    <td>
                                                    	<a href="{{url('zadmin/admins/'.$v->id.'/edit')}}" ><i class="md md-edit"></i>编辑</a>

                                                      <a href="{{url('zadmin/admins',$v->id)}}" data-method="delete"
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






    @section('modal')
        <!-- Modal -->
      <div id="custom-modal" class="modal-demo">
          <button type="button" class="close" onclick="Custombox.close();">
              <span>&times;</span><span class="sr-only">Close</span>
          </button>
          <h4 class="custom-modal-title">添加管理员</h4>
          <div class="custom-modal-text text-left">
              <form class="form-horizontal" role="form" action="{{url('zadmin/admins')}}" method="post">
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">账号</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="username" value="" required="">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label" for="example-email">密码</label>
                                                  <div class="col-md-10">
                                                      <input type="text"  name="password" class="form-control" >
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label" for="example-email">确认密码</label>
                                                  <div class="col-md-10">
                                                      <input type="text"  name="password2" class="form-control" >
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
        <script type="text/javascript" src="{{asset('hrs/js/laravel.js')}}"></script>

        @endsection

