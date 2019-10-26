@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">收费管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="{{url('zadmin')}}">系统</a></li>
                                   <li><a href="{{url('zadmin/fee')}}">收费信息</a></li>
                                    <li class="active">添加收费</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                              <form action="{{url('zadmin/fee')}}" method="post">
                        			<div class="row">
			                        	<div class="col-sm-8">
			                        		
			                                    <div class="form-group contact-search m-b-30 col-sm-8">
			   <input type="text" value="{{array_get($param,'year_month')?$param['year_month']:date('Y-m')}}" name="year_month"  class="form-control" placeholder="">
			                                        
			                                    </div>
                                          <div class="col-sm-4">
                                            <button type="button" class="btn btn-white" id="search"><i class="fa fa-search"></i>获取上月数据</button>
                                          </div> <!-- form-group -->
			                               
			                        	</div>
			                        	
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
                          <th colspan="2">业主</th>
                          <th colspan="4">水力记录（{{$shuifei->price}}/吨）</th>
                          <th colspan="4">电力记录（{{$dianfei->price}}/度）</th>
                          
                        </tr>                    
												<tr>
													<th></th>
												
                          <th>上月</th>
                          <th>本月</th>
                          <th>用量（吨）</th>
													
                          <th>金额</th>
                          
                          <th>上月</th>
                          <th>本月</th>
                          <th>用量（度）</th>
                          
                          <th>金额</th>
                          <th>备注</th>
                         
												</tr>
											</thead>
											
                      <tbody>
                       
                    @foreach($yezhus as $yz)                       
                    <tr>
                        <td>[{{$yz->unite_num.'单元'.$yz->floor_num.'层'.$yz->romm_num}}] {{$yz->name}}

                        </td>
                        <td>
<input type="text" class="form-control" name="shuifei[{{$yz->id}}][prenum]" id="shuifei_prenum_{{$yz->id}}">
<input type="hidden" name="shuifei[{{$yz->id}}][fee_type_id]" value="{{$shuifei->id}}">
<input type="hidden" name="shuifei[{{$yz->id}}][price]" value="{{$yz->shuifei_price}}"/>

</td>
                        <td><input type="text" class="form-control" name="shuifei[{{$yz->id}}][current_num]" id="shuifei_current_num_{{$yz->id}}" value="">
                        </td>
                        <td>
                        <input type="text" class="form-control shuifei_used_num" name="shuifei[{{$yz->id}}][used_num]" data-yezhu="{{$yz->id}}" value="" id="shuifei_used_num_{{$yz->id}}">
                        </td>
                       
                        <td>
                          <input type="text" class="form-control shuifei_total_price" data-yezhu="{{$yz->id}}" name="shuifei[{{$yz->id}}][total_price]">
                        </td>

                        <td>
<input type="text" class="form-control" name="dianfei[{{$yz->id}}][prenum]" id="dianfei_prenum_{{$yz->id}}">
<input type="hidden" name="dianfei[{{$yz->id}}][fee_type_id]" value="2">
<input type="hidden" name="dianfei[{{$yz->id}}][price]" value="{{$yz->dianfei_price}}"/>
</td>
                        <td><input type="text" class="form-control" name="dianfei[{{$yz->id}}][current_num]" id="dianfei_current_num_{{$yz->id}}" value=""></td>
<td>
<input type="text" class="form-control dianfei_used_num" data-yezhu="{{$yz->id}}" name="dianfei[{{$yz->id}}][used_num]" value="" id="dianfei_used_num_{{$yz->id}}" />
</td>
                        <td>
                          <input type="text" class="form-control dianfei_total_price" name="dianfei[{{$yz->id}}][total_price]" data-yezhu="{{$yz->id}}" value="" />
                        </td>
                        <td>
                          <input type="text" class="form-control" name="remark">
                        </td>
                       
                    </tr>
                    @endforeach
                 
                  <tr>
                    <td colspan="9">
                      <button class="btn btn-primary">提交</button></td>
                  </tr>
                                             
                                                
                                               
                                               
                                                
                                               
                                                
                                            
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
  $('#search').on('click',function(){
    var month = $('input[name="year_month"]').val();
    var url = "{{url('zadmin/fee/month')}}";
    $.get(url,{'month':month},function(rs){
      if(rs.status==true) {
        $.each(rs.data,function(k,v){
          if(v.fee_type_id==1) {
            $('#shuifei_prenum_'+v.yezhu_id).val(v.current_num);  
          } else {
            $('#dianfei_prenum_'+v.yezhu_id).val(v.current_num); 
          }          
          
        });
      }
    });
  })


  $('.shuifei_used_num').on('click',function(){
    var yezhu = $(this).data('yezhu');
    var used_num = $('#shuifei_current_num_'+yezhu).val()-$('#shuifei_prenum_'+yezhu).val();
    $(this).val(used_num);
  })

  $('.dianfei_used_num').on('click',function(){
    var yezhu = $(this).data('yezhu');
    var used_num = $('#dianfei_current_num_'+yezhu).val()-$('#dianfei_prenum_'+yezhu).val();
    $(this).val(used_num);
  })

  $('.shuifei_total_price').on('click',function(){
    var yezhu = $(this).data('yezhu');
    var shuifei_price = $('input[name="shuifei['+yezhu+'][price]"]').val();
    var total_price = $('#shuifei_used_num_'+yezhu).val()*parseFloat('{{$shuifei->price}}');
    $(this).val(total_price);
  });

  $('.dianfei_total_price').on('click',function(){
    var yezhu = $(this).data('yezhu');
    var dianfei_price = $('input[name="dianfei['+yezhu+'][price]"]').val();
    var total_price = $('#dianfei_used_num_'+yezhu).val()*parseFloat(dianfei_price);
    $(this).val(total_price);
  });
</script>
@endsection                  
            
    
       

           



    
        
    
