@extends('admin.layouts.app')
@section('css')
  <link href="{{asset('admin/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">


@endsection

@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">任务管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="{{url('zadmin/')}}">系统</a></li>
                                   
                                    <li class="active">任务列表</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                        			<div class="row">
			                        	<div class="col-sm-12">
			                        		<form role="form" id="srcForm">
			                                    <div class="form-group contact-search m-b-30 col-sm-4">
			                                    	<input type="text" name="keyword" class="form-control" placeholder="输入手机号码或者备注搜索" value="{{array_get($param,'keyword')}}">
			                                        
			                                    </div>
                                          <div class="form-group col-sm-4">
                                            <select class="form-control" name="depart_id">
                                               <option value="">请选择地点</option>
                                              @foreach($departs as $d)
                                             
          <option value="{{$d->id}}" {{$d->id==array_get($param,'depart_id')?'selected':''}}>{{$d->name}}</option>
                                              @endforeach
                                            </select>
                                          </div> 

                                          <div class="form-group col-sm-4">
                                            <select class="form-control" name="category_id">
                                               <option value="">请选择类别</option>
                                              @foreach($cates as $c)
                                             
          <option value="{{$c->id}}" {{$c->id==array_get($param,'category_id')?'selected':''}}>{{$c->name}}</option>
                                              @endforeach
                                            </select>
                                          </div>

                                          <div class="col-sm-4">
                                            <div id="reportrange" class="pull-right form-control">
                                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                                <span></span>
                                            </div>
                                            <input name="beginDate" id="beginDate" type="hidden" value="{{array_get($param,'beginDate')}}">
                                          <input name="endDate" id="endDate" type="hidden" value="{{array_get($param,'endDate')}}">
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <select class="form-control" name="money">
                                               <option value="">费用状态</option>
                                               <option value="1" {{array_get($param,'money')==1?'selected':''}}>有费用</option>
                                              <option value="2">无</option>
                                            </select>
                                          </div>
                                          
			                                </form>
			                        	</div>
                                <div class="col-sm-3">
                                            <button class="btn btn-default" id="srcBtn">搜索</button>
                                          </div>
                                <div class="col-sm-3">
                                             
                                               <button class="btn btn-primary" id="exportBtn">导出</button>
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
				<th style="min-width: 35px;">
					<div class="checkbox checkbox-primary checkbox-single m-r-15">
                                                            <input id="action-checkbox" type="checkbox">
                                                            <label for="action-checkbox"></label>
                    </div>
                                                        
													</th>
						<th>姓名</th>
                        <th>电话</th>
                        <th>类别</th>
                        <th>地点</th>                       
                        
                      
                        <th>费用</th>
                        <th>备注</th> 
                        <th>等级</th> 
                        <th>状态</th>
                         
						<th>发布日期</th>
                         
					<th style="width: 200px;">操作</th>
					</tr>
					</thead>
											
                    <tbody>

                    @foreach($list as $k=>$v)
                        <tr>
                            <td>
                                {{($start+$k)}}
                                                        
                                                      
                            </td>
                                                    
            <td>
                {{$v->customer_name}}
            </td>
                                    
            <td>
                            {{$v->mobile}}
                                    </td>

                                                   
                                                    
                                    <td>
                                {{object_get($v,'category.name')}}
                                                    </td>
                                <td>
                                {{object_get($v,'depart.name')}} {{$v->gatenum}}
                                                    </td>

                              <td>{{object_get($v,'money')?$v->money.' 元':''}}</td>                    
                              <td>{{$v->content}}</td>                      
                              <td>
                                <span class="btn-sm btn btn-{{$taskStatus[$v->status]['style']}} btn-custom">{{$v->rank}}</span></td>                      
                                                    <td>
                                                   
    <a href="{{url('zadmin/task/edit',$v->id)}}"  class="btn-sm btn btn-{{$taskStatus[$v->status]['style']}} btn-custom">{{$taskStatus[$v->status]['txt']}}</a>
                                                        
                                                    </td>
                                                    <td>
                                                        {{$v->created_at}}
                                                    </td>
                                                    <td>
                                                   

<a class="btn btn-primary btn-sm btn-dispath" data-id="{{$v->id}}">派工</a>
                                                     

                                                      
@if(session('admin')->role_id==999)
                                                     
<a class="btn btn-info btn-sm" href="{{url('zadmin/task/edit',$v->id)}}">修改</a>
                                                                                                            
<a class="btn btn-danger btn-sm del"   data-id="{{$v->id}}">删除</a>
@endif
                                                    </td>
          @if($v->process)                                      </tr>
          <tr>
            <td></td>
             <td colspan="4">工单发布于： <span class="text-danger">{{$v->created_at->diffForHumans()}}</span></td>
            <td colspan="6">处理人：<span class="text-success">{{$v->workers}}</span></td>
          </tr>
          @endif
                                            @endforeach    
                                                
                                               
                                               
                                                
                                               
                                                
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $list->appends($param)->links() }}

                        		</div>
                                
                            </div> <!-- end col -->

                            
                        </div>
@endsection

@section('modal')                        
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

<!--删除工单-->
<!--派工-->
<div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          &times;
        </button>
        <h4 class="modal-title" id="myModalLabel">
          确定要删除工单吗？
        </h4>
      </div>
       <form class="form-horizontal" role="form" action="" method="get" id="delForm">
      <div class="modal-body">
       
        工单一旦删除不可恢复哦！
      
     
      
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
<script src="{{asset('admin/plugins/moment/moment.js')}}"></script>

    <script src="{{asset('admin/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script type="text/javascript">

    @if(array_get($param,'beginDate'))
      var beginDate = "{{array_get($param,'beginDate')}}";
      var endDate =   "{{array_get($param,'endDate')}}";
      $('#reportrange span').html( beginDate+ ' - ' + endDate);
    @endif

    $('#reportrange').daterangepicker({
        format: 'YYYY-MM-DD',
        startDate: moment().subtract(90, 'days'),
        endDate: moment(),
        minDate: '2018-01-01',
        maxDate: '2026-12-31',
        dateLimit: {
            days: 365
        },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
            '今天': [moment(), moment()],
            '昨天': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '最近7天': [moment().subtract(6, 'days'), moment()],
            '最近30天': [moment().subtract(29, 'days'), moment()],
            '本月': [moment().startOf('month'), moment().endOf('month')],
            '上月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'left',
        drops: 'down',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-default',
        cancelClass: 'btn-white',
        separator: ' to ',
        locale: {
            applyLabel: '确定',
            cancelLabel: '取消',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: '自定义',
            daysOfWeek: ['周日', '一', '二', '三', '四', '五', '六'],
            monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            firstDay: 1
        }
    }, function (start, end, label) {
       
        $('#reportrange span').html(start.format('YYYY年MM月DD日') + ' - ' + end.format('YYYY年MM月DD日'));
        $('#beginDate').val(start.format('YYYY-MM-DD'));
        $('#endDate').val(end.format('YYYY-MM-DD'));
        
    });
    $('.btn-dispath').on('click',function(){
        var task_id = $(this).data('id');
        $('#dispatchModal').modal('show');
        $('input[name="task_id"]').val(task_id);
    })

    $('.del').on('click',function(){
      var task_id = $(this).data('id');
     
      var url = '{{url('zadmin/task/del')}}/'+task_id;
      $('#delModal').modal('show');
      $('#delForm').attr('action',url);
      
    });

    $('#exportBtn').on('click',function(){
      var url = "{{url('zadmin/task/export')}}";
      $('#srcForm').attr('action',url).submit();
    })

    $('#srcBtn').on('click',function(){
      var url = "{{url('zadmin/task')}}";
      $('#srcForm').attr('action',url).submit();
    })
</script>
         
@endsection
    
