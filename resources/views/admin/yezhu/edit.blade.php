@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">费用类型管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                    
                                    <li class="active">修改费用类型</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                            <h2 class="m-t-0 header-title">修改费用类型</h2>
                            <hr/>
                             @if(session('rs'))
                              <div class="alert alert-{{session('rs')['status']}}">
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
                        			<div class="row">
			                        	<div class="col-md-6">
                                  <form class="form-horizontal" role="form" action="{{url('zadmin/yezhu/'.$data->id)}}" method="post" enctype="multipart/form-data">{{ method_field('PUT') }}

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">业主名</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="name" required="" value="{{$data->name}}">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">电话</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="mobile" value="{{$data->mobile}}" required="">
                                                  </div>
                                              </div>
                                                                                                                 
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">单元</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="unite_num" required="" value="{{$data->unite_num}}">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">楼层</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="floor_num" required="" value="{{$data->floor_num}}">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">房间</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="room_num" required="" value="{{$data->room_num}}">
                                                  </div>
                                              </div>
                                               <div class="form-group">
                                                  <label class="col-md-2 control-label">水费单价</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="shuifei_price" value="" required="">
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">电费单价</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="dianfei_price" value="" required="">
                                                  </div>
                                              </div>
                    <div class="form-group">
                                                  <label class="col-md-2 control-label">备注</label>
                                                  <div class="col-md-10">
                                                      <textarea class="form-control" rows="5" name="remark">{{$data->remark}}</textarea>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">是否登记</label>
                                                  <div class="col-md-10">
                      <select  class="form-control" name="is_dengji" >
                        <option value="1" {{$data->is_dengji==1?'selected':''}}>是</option>
                        <option value="0" {{$data->is_dengji==0?'selected':''}}>否</option>
                      </select>
                                                  </div>
                                              </div>

                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">是否缴费</label>
                                                  <div class="col-md-10">
              <select  class="form-control" name="is_jiaofei" >
                        <option value="1" {{$data->is_jiaofei==1?'selected':''}}>是</option>
                        <option value="0" {{$data->is_jiaofei==1?'selected':''}}>否</option>
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
    
