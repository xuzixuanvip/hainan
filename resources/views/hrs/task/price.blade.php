@extends('hrs.layouts.app')  
@section('css')

@endsection         
@section('content')               

<div class="row">
  <div class="col-md-12">
      <div class="card-box">
          <div class="row">
            <div class="col-md-12" >                                   
              <h3>工单费用详情</h3> 

              <table class="table table-hover">
                <tr>
                  <td>服务项目</td>
                  <td>{{$price->service_name}}</td>
                </tr>
                <tr>
                  <td>费用</td>
                  <td>{{$price->service_price}}</td>              
                </tr>
              </table> 
              <hr/>
              <div class="row">
                <form method="post" name="form1" id="form1" action="{{url('user/task/price-confirmed')}}">
                <div class="col-md-6">
                  <button type="button" class="btn btn-success btn-agree">同意付款</button>&nbsp;
                
                
                  <button type="button" class="btn btn-warning btn-disagree">不同意</button>
                </div>
                <input type="hidden" name="task_service_id" value="{{$price->id}}">
                <input type="hidden" name="status" id="status" value="0" />
                {{csrf_field()}}
                </form>
              </div>                           
        </div>
      </div>                           
    </div> 
  </div>                         
</div> <!-- end col -->



@endsection        


        
@section('js')

<script type="text/javascript">
    $('.btn-agree').on('click',function(){
      $('#status').val('1');
      $('#form1').submit();
    });

    $('.btn-disagree').on('click',function(){
      $('#status').val('-1');
      $('#form1').submit();
    });


</script>


@endsection