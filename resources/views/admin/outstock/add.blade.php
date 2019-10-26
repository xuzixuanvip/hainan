@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">出库单管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="{{url('zadmin/')}}">系统</a></li>
                                    <li><a href="{{url('zadmin/purchases')}}">出库单管理</a></li>
                                    <li class="active">添加出库单</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
  <form class="form-horizontal" role="form" action="{{url('zadmin/outstock')}}" method="post" >                          
          <div class="card-box">
                            <h2 class="m-t-0 header-title ">出库单基本信息</h2>
                            <hr/>
                             @if(session('rs'))
                              <div class="alert alert-{{session('rs')['status']}}">
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
                        			<div class="row">
			                        	<div class="col-md-12">
                                  
                  <div class="form-group col-md-3">
                      <label class="col-md-3 control-label">单号</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" name="code" required="" value="{{'CK'.date('YmdHis')}}">
                      </div>
                  </div> 
                  <div class="form-group col-md-3">
                      <label class="col-md-3 control-label">科室</label>
                      <div class="col-md-9">
                        <select  class="form-control" name="room_id" required="">
                          <option value="">请选择</option>
                          @foreach($rooms as $s)
                          <option value="{{$s->id}}">{{$s->name}}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>               
                  <div class="form-group col-md-3">
                      <label class="col-md-3 control-label">姓名</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" name="name" required="" value="">
                      </div>
                  </div>
                  <div class="form-group col-md-3">
                      <label class="col-md-3 control-label">联系</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" name="phone" required="" value="">
                      </div>
                  </div>

                   <div class="form-group col-md-4">
                      <label class="col-md-4 control-label">出库日期</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" name="outed_at" required="" value="{{date('Y-m-d')}}">
                      </div>
                  </div>
                                                                                                                 
                  <div class="form-group col-md-8">
                      <label class="col-md-3 control-label">备注</label>
                      <div class="col-md-9">
                         <input type="text" class="form-control" name="remark"  value="">
                              
                      </div>
                  </div>
                                            
                </div>			                        	
			     </div>
          </div>

    <div class="card-box">
      <div class="pull-left m-t-15">
                            <h2 class="m-t-0 header-title">物品信息</h2>
                          </div>
                         
                           
                            
            <div class="row">
                <div class="col-md-12">
                  <table cellspacing="0" cellpadding="0" border="0" class="table table-striped table-bordered  no-footer" id="car">
                    <thead>
                      <tr>
                      
                      <th class="">配件</th>
                      <th class="">数量</th>
                      <th class="">出库单价</th>
                      
                      <th class="">操作</th>
                    </tr>
                    </thead>
          <tbody class="caritem">
            <tr>            
              
              <td>
                  <select  class="form-control" placeholder="" name="goods_id[]">
                    <option value="">请选择</option>
                    @foreach($goods as $b)
                    <option value="{{$b->id}}">{{$b->name}}</option>
                    @endforeach
                  </select>
              </td>
              <td>
                  <input  class="form-control car-serie"  name="goods_num[]" />
                  
              </td>
              <td>
                <input type="text" class="form-control" placeholder="" name="goods_price[]" value="" />
              </td>
              
              <td width="100">
                  <button type="button" class="btn btn-sm btn-primary btn-add"><i class="md md-add"></i></button>
                  <button type="button" class="btn btn-sm btn-danger btn-remove"><i class="md md-remove"></i></button>
              </td>
            </tr>
          </tbody>
        </table>                  

                                           
      </div>                                
           </div>
          </div>  

          <div class="card-box">
            <div class="row">
              <div class="col-md-6"><button type="submit" class="btn btn-danger">保存</div>
              <div class="col-md-6"></div>
            </div>
          </div>    
          {{csrf_field()}}  

                              </form>   
                            </div> <!-- end col -->

                            
                        </div>
@endsection

@section('modal')        
     <div class="modal fade car-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myLargeModalLabel">添加车辆</h4>
                </div>
                <div class="modal-body">
                  <form class="form-horizontal" role="form">                                    
                    <div class="form-group">
                      <label class="col-md-2 control-label">车牌号码</label>
                      <div class="col-md-10">
                        <input type="text" class="form-control" value="">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-2 control-label" for="example-email">车架号/VIN号</label>
                      <div class="col-md-10">
                        <input type="email" id="example-email" name="example-email" class="form-control" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-2 control-label">车辆类型</label>
                        <div class="col-md-10">
                          
                        </div>
                    </div>
                                                                       
                    <div class="form-group">
                      <label class="col-md-2 control-label">发动机号</label>
                        <div class="col-md-10">
                        <input type="text" class="form-control" placeholder="">
                        </div>
                    </div>                                                                        
                                           
         </form>                              
                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->

@endsection
@section('js')
<script type="text/javascript">
  $(document).on('click','.btn-add',function(){
            var tr = $('.caritem tr').eq(0).clone();

            $('#car').append(tr);
            console.info(tr);
        });
       
        $(document).on('click','.btn-remove',function(){
            $(this).parents('tr').remove();
        })
 $('#add-car').on('click',function(){
  $('.car-modal').modal('show');
 }); 
</script>
@endsection

                        
                        
                        

                  
            
   

           



    
        
