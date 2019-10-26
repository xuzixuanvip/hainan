@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">出库单管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="{{url('zadmin/')}}">系统</a></li>
                                    <li><a href="{{url('zadmin/purchases')}}">出库单管理</a></li>
                                    <li class="active">修改出库单</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                      
          <div class="card-box">
             <form class="form-horizontal" role="form" action="{{url('zadmin/outstock/'.$data->id)}}" method="post" >    

  {{ method_field('PUT') }} 
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
                        <input type="text" class="form-control" name="code" required="" value="{{$data->code}}">
                      </div>
                  </div> 
                  <div class="form-group col-md-3">
                      <label class="col-md-3 control-label">科室</label>
                      <div class="col-md-9">
                        <select  class="form-control" name="room_id" required="">
                          <option value="">请选择</option>
                          @foreach($rooms as $s)
                          <option value="{{$s->id}}" {{$s->id==$data->room_id?'selected':''}}>{{$s->name}}</option>
                          @endforeach
                        </select>
                      </div>
                  </div>               
                  <div class="form-group col-md-3">
                      <label class="col-md-3 control-label">姓名</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" name="name" required="" value="{{$data->name}}">
                      </div>
                  </div>
                  <div class="form-group col-md-3">
                      <label class="col-md-3 control-label">联系</label>
                      <div class="col-md-9">
                        <input type="text" class="form-control" name="phone" required="" value="{{$data->phone}}">
                      </div>
                  </div>

                   <div class="form-group col-md-4">
                      <label class="col-md-4 control-label">出库日期</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" name="outed_at" required="" value="{{$data->outed_at}}">
                      </div>
                  </div>
                                                                                                                 
                  <div class="form-group col-md-8">
                      <label class="col-md-3 control-label">备注</label>
                      <div class="col-md-9">
                         <input type="text" class="form-control" name="remark"  value="{{$data->remark}}">
                              
                      </div>
                  </div>
                                            
                </div>			                        	
			     </div>
         </form>
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
            @foreach($data->goods as $og)
            <form action="{{url('zadmin/outstock/update-goods')}}" method="post">
              <input type="hidden" name="id" value="{{$og->id}}" />
              {{csrf_field()}}
            <tr>            
              
              <td>
                  <select  class="form-control" placeholder="" name="goods_id">
                    <option value="">请选择</option>
                    @foreach($goods as $b)
                    <option value="{{$b->id}}" {{$b->id==$og->goods_id?'selected':''}}>{{$b->name}}</option>
                    @endforeach
                  </select>
              </td>
              <td>
                  <input  class="form-control car-serie"  name="goods_num" value="{{$og->goods_num}}" />
                  
              </td>
              <td>
                <input type="text" class="form-control" placeholder="" name="goods_price" value="{{$og->goods_price}}" />
              </td>
              
              <td width="150">
                  <button  class="btn btn-sm btn-primary"><i class="md md-add"></i>更新</button>
                  <a href="{{url('zadmin/outstock/del-goods',$og->id)}}" class="btn btn-sm btn-danger btn-remove"><i class="md md-remove"></i>删除</a>
              </td>
            </tr>
          </form>
            @endforeach
            <tr>            
            <form action="{{url('zadmin/outstock/save-goods')}}" method="post">  
              <td>
                  <select  class="form-control" placeholder="" name="goods_id">
                    <option value="">请选择</option>
                    @foreach($goods as $b)
                    <option value="{{$b->id}}">{{$b->name}}</option>
                    @endforeach
                  </select>
              </td>
              <td>
                  <input  class="form-control car-serie"  name="goods_num" />
                  
              </td>
              <td>
                <input type="text" class="form-control" placeholder="" name="subtotal_money" value="" />
              </td>
              
              <td width="150">
                  <button  class="btn btn-sm btn-primary"><i class="md md-add"></i>保存</button>
                  <button type="button" class="btn btn-sm btn-danger btn-remove"><i class="md md-remove"></i>删除</button>
              </td>
              {{csrf_field()}}  
              <input name="outstock_id" value="{{$data->id}}" type="hidden" />
            </form>   
            </tr>
          </tbody>
        </table>                  

                                           
      </div>                                
           </div>
          </div>  

          <div class="card-box">
            <div class="row">
              <div class="col-md-3"><button type="submit" class="btn btn-danger">保存</div>
              <div class="col-md-3"> 
                <a class="btn btn-success pull-right m-t-0" href="{{url('zadmin/outstock/print',$data->id)}}">打印</a></div>
            </div>
          </div>    
          
                            </div> <!-- end col -->

                            
                        </div>
@endsection

@section('modal')        
   

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

                        
                        
                        

                  
            
   

           



    
        
