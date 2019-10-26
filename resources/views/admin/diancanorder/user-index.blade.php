@extends('admin.layouts.app-user')
@section('css')
  <link href="{{asset('admin/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
@endsection
@section('content')

                        
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                        			<div class="row">
                                <div class="col-sm-10">
                                  <form role="form" id="srcForm">
                                          <div class="form-group contact-search m-b-30 col-sm-3">
                                            <input type="text" name="keyword" class="form-control" placeholder="输入手机号码或者姓名搜索" value="{{array_get($param,'keyword')}}">
                                              
                                          </div>
                                          

                                          <div class="form-group col-sm-2">
                                            <select class="form-control" name="shop_id">
                                               <option value="">请选择商户</option>
                                              @foreach($shops as $c)
                                             
          <option value="{{$c->id}}" {{$c->id==array_get($param,'shop_id')?'selected':''}}>{{$c->name}}</option>
                                              @endforeach
                                            </select>
                                          </div>
                                    <div class="form-group col-sm-2">
                                            <select class="form-control" name="depart">
                                               <option value="">请选择科室</option>
                                              @foreach($departs as $d)
                                             
          <option value="{{$d->name}}" {{$d->name==array_get($param,'depart')?'selected':''}}>{{$d->name}}</option>
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
                                          <div class="col-sm-1">
                                            <button class="btn btn-default" id="srcBtn">搜索</button>
                                          </div>
                                      </form>
                                </div>
                                <!-- <div class="col-sm-1">
                                             
                                               <button class="btn btn-primary" id="exportBtn">导出</button>
                                            </div> -->
                                
                              </div>

          <div class="alert alert-warning">
            <strong>订单数：</strong>{{$total->count()}}, 
            <strong>订单总额：</strong>{{$total->sum('total_price')}}
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
                         
													<th>商户名</th>
                          <th>用户</th>
                          <th>金额</th>
                          <th>订餐时间</th>
												  <th>订单状态</th>
                          <th>详情</th>
                         
													
												</tr>
											</thead>
											
                                            <tbody>

                                            @foreach($list as $k=>$v)
                                                <tr>
                                                    <td>
                                                        {{($start+$k)}}
                                                        
                                                      
                                                    </td>
                                                    <td>
                                                      {{object_get($v,'shop.name')}}
                                                    </td>
                                                    
                                                    <td>
                                                        {{object_get($v,'user.name')}}
                                                    </td>
                                                    <td>{{$v->total_price}}</td>
                                                    <td>{{$v->created_at}}</td>
                                                    <td>
                                                    <span class="btn btn-sm btn-{{$v->status_css}}">  {{$v->status_txt}}
                                                    </span>
                                                    </td>
                                                  
                                          <td>
                                            <a href="{{url('zadmin/diancan/orders',$v->id)}}">查看</a>
                                          </td>         
                                                    
                                                </tr>
                                          <tr>
                                            <td colspan="7">
                                              
                  <table style="float: right">
                   <tr>
                     <th width="200">菜品名</th>
                     <th width="100">单价</th>
                     <th width="100">数量</th>
                     <th width="100">小计</th>
                   </tr>
                  @foreach($v->products as $p)
                    <tr>
                      <td>{{$p->name}}</td>
                      <td>{{$p->product_price}}</td>
                      <td>{{$p->product_num}}</td>
                      <td>{{$p->subtotal}}</td>

                    </tr>
                 
                  @endforeach
                </table>
                
                                            </td>
                                          </tr>
                                            @endforeach    
                                                
                                               
                                               
                                                
                                               
                                                
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                    {{$list->appends($param)->links()}}
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
       
        $('#reportrange span').html(start.format('YYYY年MM月DD日') + ' - ' + end.format('YYYY年MM月DD日'));
        $('#beginDate').val(start.format('YYYY-MM-DD'));
        $('#endDate').val(end.format('YYYY-MM-DD'));
        
    });

    $('#exportBtn').on('click',function(){
      var url = "{{url('diancan-orders')}}";
      $('#srcForm').attr('action',url).submit();
    })

    $('#srcBtn').on('click',function(){
      var url = "{{url('diancan-orders')}}";
      $('#srcForm').attr('action',url).submit();
    })
  </script>
    @endsection       
       

           



    
        
    
