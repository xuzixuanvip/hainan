@extends('admin.layouts.app')
@section('css')
  <link href="{{asset('admin/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">


@endsection
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">统计分析</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                    <li><a href="#">系统设置</a></li>
                                    <li class="active">统计分析</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                        			<div class="row">
			                        	<div class="col-sm-12">
			                        		<form role="form" id="censusForm" method="post" action="">
			                                    <div class="form-group contact-search m-b-30">
                                            <div class="col-lg-2">
			                                    	<input type="text"  class="form-control" name=
                                            "truename" placeholder="维修工姓名" value="{{array_get($param,
                                            'truename')}}">
                                          </div>
			                            <div class="col-lg-4">
                                            <div id="reportrange" class="pull-right form-control">
                                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                                <span></span>
                                            </div>
                                        </div>
                                            <div class="col-lg-2">
                                              <button type="button" class="btn btn-primary" id="srcBtn">查询</button>
                                               <button type="button" class="btn btn-primary" id="exportBtn">导出</button>
                                            </div>

                                  
			                                    </div> <!-- form-group -->
                                          {{csrf_field()}}
                                          <input name="beginDate" id="beginDate" type="hidden">
                                          <input name="endDate" id="endDate" type="hidden">
			                                </form>
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
													ID
                                                        
													</th>
													<th>维修工</th>
													<th>任务量</th>
                          <th>收费</th>
                          <th>完成任务数</th>
                          <th>完成率</th>
                         
                         
												
												</tr>
											</thead>
											
                                            <tbody>

                                            @foreach($list as $v)
                                                <tr>
                                                    <td>
                                                        {{$v->id}}
                                                        
                                                      
                                                    </td>
                                                    
                                                    <td>
                                                        {{$v->username}}
                                                    </td>
                                                    <td>
                                                        {{$v->task_num}}
                                                    </td>
                                                    <td>
                                                        {{$v->money}}
                                                    </td>
                                                     <td>
                                                        {{$v->finish_num}}
                                                    </td>
                                                     <td>
                                                        {{$v->finish_rate}}
                                                    </td>
                                                    
                                                    
                                                    
                                                
                                                    
                                                   
                                                    
                                                </tr>
                                            @endforeach    
                                                
                                               
                                               
                                                
                                               
                                                
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                    {{ $list->appends($param)->links() }}
                        		</div>
                                
                            </div> <!-- end col -->

                            
                        </div>
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
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange span').html(start.format('YYYY年MM月DD日') + ' - ' + end.format('YYYY年MM月DD日'));
        $('#beginDate').val(start.format('YYYY-MM-DD'));
        $('#endDate').val(end.format('YYYY-MM-DD'));
    });

    var srcUrl = '{{url('zadmin/census/worker-count')}}';
    var exportUrl = '{{url('zadmin/census/worker-count-export')}}';

    $('#srcBtn').on('click',function(){
      $('#censusForm').attr('action',srcUrl).submit();

    })
    $('#exportBtn').on('click',function(){
      $('#censusForm').attr('action',exportUrl).submit();

    })
    </script>

    @endsection  
       

           



    
        
    
