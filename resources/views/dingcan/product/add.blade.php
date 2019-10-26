@extends('dingcan.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">菜品管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                    <li><a href="{{url('diancan/shop/products')}}">菜品列表</a></li>
                                    <li class="active">添加菜品</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                            <h2 class="m-t-0 header-title">添加菜品</h2>
                            <hr/>
                             @if(session('rs'))
                              <div class="alert alert-{{session('rs')['status']}}">
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
                        			<div class="row">
			                        	<div class="col-md-6">
                                  <form class="form-horizontal" role="form" action="{{url('diancan/shop/products')}}" method="post" enctype="multipart/form-data">

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">菜品名</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="name" required="" value="">
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">图片</label>
                                                  <div class="col-md-10">
                                                      <input type="file" class="form-control" name="pic" >
                                                  </div>
                                                  

                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">价格</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="price" required="" value="">
                                                  </div>
                                              </div>
                <div class="form-group">
                  <label class="col-md-2 control-label">备注</label>
                  <div class="col-md-10">
                    <textarea type="text" class="form-control" name="remark"></textarea>
                  </div>
                </div>                              
                <div class="form-group">
                  <label class="col-md-2 control-label">时间段</label>
                  <div class="col-md-10">
                      <select name="type_id" class="form-control" required="">
                        <option value="">请选择</option>
                        @foreach($types as $t)
                        <option value="{{$t->id}}">{{$t->name}}</option>
                        @endforeach
                      </select>
                      
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-2 control-label">分类</label>
                  <div class="col-md-10">
                      <select name="cate_id" class="form-control" required="">
                        <option value="">请选择</option>
                        @foreach($cates as $c)
                        <option value="{{$c->id}}">{{$c->name}}</option>
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
    
