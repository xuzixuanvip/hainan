@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">微信菜单管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                    <li><a href="#">系统设置</a></li>
                                    <li class="active">微信菜单列表</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                        			<div class="row">
			                        	<div class="col-sm-8">
			                        		
			                        	</div>
			                        	
			                        </div>

                              @if(session('rs'))
                              <div class="alert alert-{{session('rs')['status']}}">
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
			                        
                        			<div class="table-responsive">
                              <?php
                                var_dump($list);
                              ?>      
                              </div>
                              <div class="row">
                                <button class="btn btn-info" id="createMenu">生成菜单</button>
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
          <h4 class="custom-modal-title">添加微信菜单</h4>
          <div class="custom-modal-text text-left">
              <form class="form-horizontal" role="form" action="{{url('zadmin/services')}}" method="post" enctype="multipart/form-data">                                    
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">名称</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="name" value="" required="">
                                                  </div>
                                              </div>
                                              
                                                                                                                    
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">价格</label>
                                                  <div class="col-md-10">
                                                      <input class="form-control"  name="price" />
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
      $('#createMenu').on('click',function(){
        var url = "{{url('create-menu')}}";
        $.get(url,function(rs){
          alert(rs.msg);
        });
      });
    </script>
    @endsection       
       

           



    
        
    
