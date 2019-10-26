@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">财务管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                    <li><a href="#">财务管理</a></li>
                                    <li class="active">卖家财务日志</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                        			<div class="row">
                                <form role="form">
			                        	<div class="col-sm-8">
			                        		
			                                    <div class="form-group contact-search m-b-30">
			                                    	<input type="text" id="search" class="form-control" placeholder="Search...">
			                                        
			                                    </div> <!-- form-group -->
                                          </div>
 <div class="col-sm-4">                                        
<button type="submit" class="btn btn-default btn-md waves-effect waves-light m-b-30" ><i class="fa fa-search"></i>搜索</button>
</div>
                               
			                                
			                        	
			                        	</form>
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
													
													<th>类型</th>
													
                          <th>金额</th>
                          <th>姓名</th>
													<th>事由</th>
                          <th>时间</th>
                         
												
												</tr>
											</thead>
											
                                            <tbody>

                      @foreach($list as $v)
                      <tr>
                        <td>
                          <span class="label label-{{$v->type==1?'success':'primary'}}">
                          {{$v->type==1?'充值':'扣除'}}
                        </span>
                                                      
                        </td>
                                                    
                        <td>
                          {{$v->money}}
                        </td>
                        <td>
                          {{$v->seller->truename or ''}}
                        </td>                            
                                                    
                                                     
                        <td>{{$v->remark}}</td>
                        <td>{{$v->created_at}}</td>
                                                    
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
          $('.add-money').on('click',function(){
            var _seller_id   = $(this).data('seller_id');
            var _seller_name = $(this).data('seller_name');
            $('#seller_name').val(_seller_name);
            $('input[name="seller_id"]').val(_seller_id);
            console.info(_seller_id);
          });
        </script>
        @endsection
    
