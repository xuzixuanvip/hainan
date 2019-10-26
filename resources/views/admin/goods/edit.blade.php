@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">配件管理</h4>
                                <ol class="breadcrumb">
                                   <li><a href="{{url('zadmin/')}}">系统</a></li>
                                    <li><a href="{{url('zadmin/goods')}}">配件信息</a></li>
                                    <li class="active">修改配件</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                            <h2 class="m-t-0 header-title">修改配件</h2>
                            <hr/>
                             @if(session('rs'))
                              <div class="alert alert-{{session('rs')['status']}}">
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
                        			<div class="row">
			                        	<div class="col-md-12">
                                  <form class="form-horizontal" role="form" action="{{url('zadmin/goods/'.$data->id)}}" method="post" enctype="multipart/form-data">{{ method_field('PUT') }}

                <div class="form-group col-md-6">
                  <label class="col-md-3 control-label">配件分类</label>
                  <div class="col-md-9">
                    <select class="form-control" name="cate_id">
                                                                        
                      @foreach($cates as $p)
                      <option value="{{$p->id}}" {{$data->cate_id==$p->id?'selected':''}}>{{$p->name}}</option>
                      @endforeach  
                      </select>
                  </div>
                </div>                              
                                              <div class="form-group col-md-6">
                                                  <label class="col-md-3 control-label">配件名称</label>
                                                  <div class="col-md-9">
                                                      <input type="text" class="form-control" name="name" required="" value="{{$data->name}}">
                                                  </div>
                                              </div>
                                              <div class="form-group col-md-6">
                                                  <label class="col-md-3 control-label">原厂编码</label>
                                                  <div class="col-md-9">
                                                      <input type="text" class="form-control" name="source_code" required="" value="{{$data->source_code}}">
                                                  </div>
                                              </div>
                                              <div class="form-group col-md-6">
                                                  <label class="col-md-3 control-label">配件单位</label>
                                                  <div class="col-md-9">
                                                      <input type="text" class="form-control" name="unit" required="" value="{{$data->unit}}">
                                                  </div>
                                              </div>
                                              <div class="form-group col-md-6">
                                                  <label class="col-md-3 control-label">库存数量</label>
                                                  <div class="col-md-9">
                                                      <input type="text" class="form-control" name="store_num" required="" value="{{$data->store_num}}">
                                                  </div>
                                              </div>
                                              <div class="form-group col-md-6">
                                                  <label class="col-md-3 control-label">零售价</label>
                                                  <div class="col-md-9">
                                                      <input type="text" class="form-control" name="out_price"  value="{{$data->out_price}}">
                                                  </div>
                                              </div>
                                              <div class="form-group col-md-6">
                                                  <label class="col-md-3 control-label">进货价</label>
                                                  <div class="col-md-9">
                                                      <input type="text" class="form-control" name="in_price" required="" value="{{$data->in_price}}">
                                                  </div>
                                              </div>

                                              <div class="form-group col-md-6">
                                                  <label class="col-md-3 control-label">配件品牌</label>
                                                  <div class="col-md-9">
                                                      <input type="text" class="form-control" name="brand" required="" value="{{$data->brand}}">
                                                  </div>
                                              </div>

                                              
                                                                                                                 
                                              <div class="form-group col-md-12">
                                                  <label class="col-md-1 control-label">备注</label>
                                                  <div class="col-md-10">
                                                      <textarea class="form-control" rows="5" name="remark">{{$data->remark}}</textarea>
                                                  </div>
                                              </div>
                                              
                                              
                             {{csrf_field()}}

                              <div class="form-group text-center col-md-12">
                                                  
                                                  <button type="submit" class="btn btn-info waves-effect waves-light">保存</button>
                                              </div>
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
         

          $('.type').on('change',function(){
            var _val = $(this).val();
            if(_val==2) {
              $('.money').show();
              $('.rate').hide();
            }else{
              $('.rate').show();
              $('.money').hide();
            }
          });
        </script>
        @endsection
    
