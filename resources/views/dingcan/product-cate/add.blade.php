@extends('dingcan.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">菜品分类管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                    <li><a href="{{url('diancan/shop/cates')}}">菜品分类列表</a></li>
                                    <li class="active">添加菜品分类</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                            <h2 class="m-t-0 header-title">添加菜品分类</h2>
                            <hr/>
                             @if(session('rs'))
                              <div class="alert alert-{{session('rs')['status']}}">
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
                        			<div class="row">
			                        	<div class="col-md-6">
                                  <form class="form-horizontal" role="form" action="{{url('diancan/shop/cates')}}" method="post" enctype="multipart/form-data">

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">菜品分类名</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="name" required="" value="">
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

        <script type="text/javascript">
         

         
        </script>
        @endsection
    
