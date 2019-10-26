@extends('dingcan.layouts.app')
@section('content')

                                                
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                            <h2 class="m-t-0 header-title">修改菜品分类</h2>
                            <hr/>
                             @if(session('rs'))
                              <div class="alert alert-{{session('rs')['status']}}">
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
                        			<div class="row">
			                        	<div class="col-md-6">
                                  <form class="form-horizontal" role="form" action="{{url('diancan/shop/cates/'.$data->id)}}" method="post" enctype="multipart/form-data">{{ method_field('PUT') }}

                                             <div class="form-group">
                                                  <label class="col-md-2 control-label">菜品分类名</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="name" required="" value="{{$data->name}}">
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
                                
                            </div>
          </div>

          <div class="row">
          <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        
                        

                        <th>菜名</th>
                        <th>状态</th>
                        <th>操作</th>
                       
                        

                    </tr>
                    </thead>

                    <tbody>

                    @foreach($products as $v)
                    <tr>
                        
                        <td>
                           
                            <img src="{{$v->pic}}" width="50" /> <br/>
                             {{$v->name}}
                        </td>
                        <td>
                          <button class="btn btn-info btn-sm">{{$v->status==1?'销售中':'已下架'}}</button>
                        </td>
                        <td>
                           <a href="{{url('diancan/shop/products/change-status')}}?id={{$v->id}}&status={{$v->status==1?0:1}}" class="btn btn-{{$v->status==1?'danger':'success'}} btn-sm">{{$v->status==1?'下架':'上架'}}</a>
                        </td>
                      

                        
                        
                    </tr>
                   
                    @endforeach


                    </tbody>
                </table>
            </div>
          </div>  
@endsection
                        
                        
                        

           
       

           



    
        @section('js')

        <script type="text/javascript">
         

         
        </script>
        @endsection
    
