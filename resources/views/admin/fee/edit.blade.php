@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">费用类型管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="{{url('zadmin')}}">系统</a></li>
                                   
                                    <li class="active">修改费用</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="card-box">
                              
                              

                              @if(session('rs'))
                              <div class="alert alert-{{session('rs')['status']}}">
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
                              
                              <div class="table-responsive">
                                        <table class="table table-hover">
                                          <thead>
                        <tr>
                          <th colspan="2">业主：{{$yezhu->name}}</th>
                          <th colspan="2">水费单价：{{$yezhu->shuifei_price}}</th>
                          <th colspan="2">电费单价：{{$yezhu->dianfei_price}}</th>
                          
                        </tr>                    
                        <tr>
                          
                          <th>类型</th>
                          <th>上月数</th>
                          <th>本月数</th>
                          <th>用量</th>
                          
                          <th>金额</th>
                          <th>备注</th>
                          <th>保存</th>
                        
                         
                        </tr>
                      </thead>
                      
                      <tbody>
                       
                    @foreach($list as $fee)                       
                    <tr>
                      <form class="form-horizontal" role="form" action="{{url('zadmin/fee/'.$fee->id)}}" method="post">{{ method_field('PUT') }}
                        <td>{{object_get($fee,'feeType.name')}}</td>
                        <td>
                          <input type="text" name="prenum" value="{{$fee->prenum}}" class="form-control">
                        </td>
                        <td>
                          <input type="text" name="current_num" value="{{$fee->current_num}}" class="form-control">
                        </td>
                        <td>
                          <input type="text" name="used_num" value="{{$fee->used_num}}" id="used_num_{{$fee->fee_type_id}}" class="form-control">
                        </td>
                        <td>
                          <input type="text" name="total_price" value="{{$fee->total_price}}" data-type="{{$fee->fee_type_id}}" class="form-control">
                        </td>
                        <td>
                          <input type="text" name="remark" value="{{$fee->remark}}" class="form-control" >
                        </td>
                        <td><button class="btn btn-primary">更新</button></td>
                        {{csrf_field()}}
                      </form>  
                    </tr>

                    @endforeach
                 
                 
                                             
                                                
                                               
                                               
                                                
                                               
                                                
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                    {{csrf_field()}}
                              </form>       
                            </div>
                                
                            </div> <!-- end col -->

                            
                        </div>
@endsection
                        
                        
                        
@section('js')
<script type="text/javascript">
  $('input[name="total_price"]').on('click',function(){
    var _this = $(this);
    var _type = _this.data('type');
    var total_price = 0;
    if(_type==1) {
      //alert({{$yezhu->shuifei}});
      total_price = $('#used_num_'+_type).val()*parseFloat('{{$yezhu->shuifei_price}}');
    } else {
      total_price = $('#used_num_'+_type).val()*parseFloat('{{$yezhu->dianfei_price}}');
    }
    _this.val(total_price.toFixed(2));
  })
</script>
@endsection                  
            
    
       

           



    
        
    
