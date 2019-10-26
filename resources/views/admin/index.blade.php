@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                

                                <h4 class="page-title">控制台</h4>
                                <p class="text-muted page-title-alt"></p>
                            </div>
                        </div>

						<div class="row">
                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="card-box widget-box-1 bg-white">
                                	<i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                                	<h4 class="text-dark">待处理</h4>
                                	<h2 class="text-primary text-center"><span data-plugin="counterup">{{$wait}}</span></h2>
                                	
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="card-box widget-box-1 bg-white">
                                	<i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                                	<h4 class="text-dark">处理中</h4>
                                	<h2 class="text-pink text-center"><span data-plugin="counterup">{{$process}}</span></h2>
                                	
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="card-box widget-box-1 bg-white">
                                	<i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                                	<h4 class="text-dark">已报价</h4>
                                	<h2 class="text-success text-center"><span data-plugin="counterup">
                                    <a href="{{url('zadmin/task')}}?price=1">{{$price}}</a>
                                  </span></h2>
                                	
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-lg-3">
                                <div class="card-box widget-box-1 bg-white">
                                    <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                                    <h4 class="text-dark">已完成</h4>
                                    <h2 class="text-success text-center"><span data-plugin="counterup">{{$done}}</span></h2>
                                    
                                </div>
                            </div>

                    

                        </div>

                        


                        <div class="row">

                            <div class="col-lg-12">

                                <div class="portlet"><!-- /primary heading -->
                                    <div class="portlet-heading">
                                        <h3 class="portlet-title text-dark text-uppercase">
                                            最新工单
                                        </h3>
                                        <div class="portlet-widgets">
                                            <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                                            <span class="divider"></span>
                                            <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i class="ion-minus-round"></i></a>
                                            <span class="divider"></span>
                                            <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div id="portlet2" class="panel-collapse collapse in">
                                        <div class="portlet-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover ">
                                            <thead>
                                                <tr>
                                                    <th style="min-width: 35px;">
                                                        <div class="checkbox checkbox-primary checkbox-single m-r-15">
                                                            <input id="action-checkbox" type="checkbox">
                                                            <label for="action-checkbox"></label>
                                                        </div>
                                                        
                                                    </th>
                                                    <th>姓名</th>
                          <th>维修地址</th>
                          <th>报修类型</th>
                          <th>备注</th>
                          
                                                    <th>状态</th>
                         <th>手机号</th>
                         <th style="width: 200px;">提交日期</th>
                         <th>操作</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>

                                            @foreach($tasks as $v)
                                               <tr>
                                                    <td>
                                                        {{$v->id}}                                                   
                                                      
                                                    </td>
                                                    
                                                 
                                                    
                                                    
                                                     <td>
                                                        {{$v->customer_name}}
                                                    </td>
                                                    <td>
                                                       {{object_get($v,'depart.name')}} 
                                                    </td>

                                                    <td>
                                                        {{object_get($v,'category.name')}}
                                                    </td>
                                    <td>{{$v->content}}</td>            
                                                    <td>
                                                   
                                                        <a href="{{url('zadmin/task/edit',$v->id)}}" class="btn btn-{{$taskStatus[$v->status]['style']}} waves-effect waves-light btn-custom">{{$taskStatus[$v->status]['txt']}}</a>
                                                        
                                                    </td>
                                                           <td>
                                                        {{$v->mobile}}
                                                    </td>
                                                    <td>
                                                        {{$v->created_at}}
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-primary btn-dispath" data-id="{{$v->id}}">派工</button>

                                                    <button class="btn btn-danger btn-refund" data-id="{{$v->id}}">退单</button>
                                                </td>
                                                </tr>
                                            @endforeach    
                                                
                                               
                                               
                                                
                                               
                                                
                                            
                                            </tbody>
                                        </table>

                                            </div>
                                       
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->


                        </div>

						<!-- end row -->

                        
@endsection 

 @section('modal')        
<!-- Modal -->
<div class="modal fade" id="refundModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          &times;
        </button>
        <h4 class="modal-title" id="myModalLabel">
          退单
        </h4>
      </div>
       <form class="form-horizontal" role="form" action="{{url('zadmin/refund')}}" method="post">
      <div class="modal-body">
       
         <div class="form-group">
                  <label class="control-label">退单原因</label>
                 
                    <textarea class="form-control"  name="refund_reason" id="refund_reason"></textarea>
                 
                </div> 
     
       <input type="hidden" name="task_id" value="" id="task_id" />
       {{csrf_field()}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭
        </button>
        <button type="submit" class="btn btn-primary">
          提交
        </button>
      </div>
    </form>
    </div><!-- /.modal-content -->
  </div>
</div> 

<!--派工-->
<div class="modal fade" id="dispatchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          &times;
        </button>
        <h4 class="modal-title" id="myModalLabel">
          派工
        </h4>
      </div>
       <form class="form-horizontal" role="form" action="{{url('zadmin/process')}}" method="post">
      <div class="modal-body">
       
        <div class="form-group">
                  <label class="control-label">选择维修人员</label>
                 
                    <select name="worker_id" class="form-control">
                      <option value="">请选择维修人员</option>
                      @foreach($workers as $worker)
                      <option value="{{$worker->id}}">  {{$worker->truename}} ({{$worker->mobile}})
                      </option>
                      @endforeach
                    </select>
                 
        </div>
        <div class="form-group">
                  <label class="control-label">备注</label>
                 
                    <textarea class="form-control"  name="remark"></textarea>
                 
        </div> 
     
       <input type="hidden" name="task_id" value="" />
       {{csrf_field()}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭
        </button>
        <button type="submit" class="btn btn-primary">
          提交
        </button>
      </div>
    </form>
    </div><!-- /.modal-content -->
  </div>
</div> 
<!-- /.modal -->
    @endsection 


@section('js')
<!-- Counterup  -->
        
        <script src="{{asset('admin/plugins/counterup/jquery.counterup.min.js')}}"></script>

        <script src="{{asset('admin/plugins/morris/morris.min.js')}}"></script>
        <script src="{{asset('admin/plugins/raphael/raphael-min.js')}}"></script>
        
        <script type="text/javascript">
            $('.btn-refund').on('click',function(){
                var task_id = $(this).data('id');
                $("#refundModal").modal('show');
                $('input[name="task_id"]').val(task_id);
            })

            $('.btn-dispath').on('click',function(){
                 var task_id = $(this).data('id');
                $('#dispatchModal').modal('show');
                $('input[name="task_id"]').val(task_id);
            })
        </script>
      
@endsection