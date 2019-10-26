@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">订单管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                    <li><a href="{{url('zadmin/diancan/orders')}}">订单列表</a></li>
                                    <li class="active">订单详情</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                            <h2 class="m-t-0 header-title">订单详情</h2>
                            <hr/>
                             @if(session('rs'))
                              <div class="alert alert-{{session('rs')['status']}}">
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
                        			<div class="row">
			                        	<div class="col-md-12">
            <table class="table">
             <tr>
             <th>编号：{{$data->code}}</th>
             <td>状态：{{$data->status_txt}}</td>
             </tr>

             <tr>
             <th>商户：{{object_get($data,'shop.name')}}</th>
             <td>用户：{{object_get($data,'user.name')}}</td>
             </tr>

          <tr>
          <th>订单金额：{{object_get($data,'total_price')}}</th>
          <td>下单时间：{{object_get($data,'created_at')}}</td>
          </tr>
                                   
            </table>
         </div>
          <div class="col-md-12">
            <div class="panel panel-border panel-success">
                <div class="panel-heading">
                <h3 class="panel-title">订单明细</h3>
                </div>
                <div class="panel-body">
                  <table class="table">
                   <tr>
                     <th>菜品名</th>
                     <th>单价</th>
                     <th>数量</th>
                     <th>小计</th>
                   </tr>
                  @foreach($data->products as $p)
                    <tr>
                      <td>{{$p->name}}</td>
                      <td>{{$p->product_price}}</td>
                      <td>{{$p->product_num}}</td>
                      <td>{{$p->subtotal}}</td>

                    </tr>
                 
                  @endforeach
                </table>
                </div>
            </div>                        
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
    
