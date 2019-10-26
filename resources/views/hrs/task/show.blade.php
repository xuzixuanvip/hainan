@extends('hrs.layouts.app')  
@section('css')

<link href="{{asset('hrs/plugins/ladda-buttons/css/ladda-themeless.min.css')}}" rel="stylesheet" type="text/css" />
@endsection         
@section('content')

                

               <div class="row">
                   <div class="col-md-12">
                       <div class="card-box">
                           <div class="row">
                               

      <div class="col-md-12" >
                                   
              <h3>工单详情</h3>       

              <table class="table table-hover">
                
                <tr>
                  <td>姓名</td>
                  <td>{{$data->customer_name}}</td>
                </tr>
                <tr>
                  <td>单位</td>
                  <td>{{$data->danwei}}</td>
                </tr>
                <tr>
                  <td>手机号</td>
                  <td>{{$data->mobile}}</td>
                </tr>
                <tr>
                  <td>故障类别</td>
                  <td>{{object_get($data,'category.name')}}</td>
                </tr>
                <tr>
                  <td>故障地點</td>
                  <td>{{object_get($data,'depart.name')}}{{$data->address}} </td>
                </tr>
                
                @if($data->thumb)
                <tr>
                  <td colspan="2">故障图像</td>
                </tr>
                
                <tr>  
                  <td colspan="2">
                    <a href="{{$data->pic}}">
                      @if($data->thumb)
                      <img src="{{$data->thumb}}" width="200" />
                      @else 
                      <img src="{{$data->pic}}" width="200" />
                      @endif
                    
                    </a>
                </td>
                </tr>
                @endif
                @if($data->video)
                <tr>
                  <td colspan="2">视频</td>
                </tr>
                <tr>  
                  <td colspan="2">
                    <video src="{{$data->video}}" controls="controls" width="320" height="240" controls>
您的浏览器不支持 video 标签。
</video>
                  </td>
                </tr>
                @endif
                <tr>
                  <td>故障描述</td>
                  <td><strong>{{$data->content}}</strong></td>
                </tr>
                <tr>
                  <td>预约时间</td>
                  <td>{{$data->service_time}}</td>
                </tr>
                <tr>
                  <td>提交时间</td>
                  <td>{{$data->created_at}}</td>
                </tr>
                <tr>
                  <td>状态</td>
                  <td><label class="label label-{{$taskStatus[$data->status]['style']}}">{{$taskStatus[$data->status]['txt']}}</label></td>
                </tr>
                @if($comment)
                <tr>
                  <td>评价</td>
                  <td>
                    {{$comment->point}}分,{{$comment->remark}}
                  </td>
                </tr>
                @endif
              </table>
              @if($process)
                <h3>处理信息</h3>
                <table class="table">
                      <tr>
                        <th>维修人</th>
                        <th>备注</th>
                        <th>工单状态</th>
                        <th>派工时间</th>
                      </tr>
                       @foreach($process as $pro)
                       <tr>
                        <td>
                     {{object_get($pro,'worker.truename')}} ({{object_get($pro,'worker.mobile')}})</td>
                      <td>
                        {{$pro->remark}} &nbsp;&nbsp; 
                        </td>
                        <td><label class="label label-{{$taskStatus[$pro->status]['style']}} ">{{$taskStatus[$pro->status]['txt']}}</label>
                      </td>
                      <td>{{$pro->created_at}}
                       
                      </td>
                      </tr>
                       @endforeach
                        </table>
              @endif


              @if( ($data->status==App\Http\Controllers\Controller::COMPLETED_STATUS) && empty($comment) && ($data->openid==$user_openid))
              <!--评价打分-->
              <div class="row">
                <div class="col-md-12">
                  <button type="button" class="btn btn-success btn-comment">请对本次维修进行评价</button>
                </div>
              </div>
              @endif
             
             @if( $data->status==App\Http\Controllers\Controller::WAIT_STATUS && (object_get($user,'role_id')==100 || object_get($user,'role_id')==999) )
               <hr/>
               <div class="row">
                <div class="col-md-12">
                  <button type="button" class="btn btn-warning btn-refund">退单</button> &nbsp;
                  <button type="button" class="btn btn-success btn-dispatch">派工</button>
                </div>
              </div>                
              @endif
             
              @if( $data->status!=App\Http\Controllers\Controller::COMPLETED_STATUS && !empty($user) )
               <hr/>
              <div class="row">
                <div class="col-sm-6 col-md-6">
                  <button type="button" class="btn btn-success btn-service">报价</button>
                                         
                   <button type="button" class="btn btn-primary btn-complete" >完成</button>

                </div>
              </div>
              @endif
                                        

                                      
                                       

                                       
                                   
                               </div>
                           </div>
                           <!-- end row -->
                          </div> 
</div>
                         
                   </div> <!-- end col -->


<!--退单模态框-->
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
       <form class="form-horizontal" role="form" action="{{url('user/task/refund')}}" method="post">
      <div class="modal-body">
       
         <div class="form-group">
                  <label class="control-label">退单原因</label>
                 
                    <textarea class="form-control"  name="refund_reason" id="refund_reason"></textarea>
                 
                </div> 
     
       <input type="hidden" name="task_id" value="{{$data->id}}" id="task_id" />
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
  </div><!-- /.modal -->
</div>


<!--派工的模态框-->
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
       <form method="post" action="{{url('user/task/process')}}" id="DispatchForm" >
      <div class="modal-body">
        <div class="form-group row"> 
                 <label class="col-md-4 control-label">选择维修人员
                 </label> 
                  <div class="col-md-8">
                    <select name="worker_id" class="form-control">
                      <option value="">请选择维修人员</option>
                      @foreach($workers as $worker)
                      <option value="{{$worker->id}}">  {{$worker->truename}} ({{$worker->mobile}})
                      </option>
                      @endforeach
                    </select>
                  </div>                    
                </div>       
            <div class="form-group row">
                  <label class="col-md-4 control-label">备注</label>
                  <div class="col-md-8">
                    <textarea class="form-control" rows="5" name="remark" placeholder="备注"></textarea>
                  </div>
                </div> 
                 <input type="hidden" name="task_id" value="{{$data->id}}" />
       {{csrf_field()}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭
        </button>
        <button type="button" class="ladda-button btn btn-primary" id="btnDispatch">
          确定
        </button>
      </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal -->
</div>

<!--维修选择服务项目收费-->
<div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          &times;
        </button>
        <h4 class="modal-title" id="myModalLabel">
          服务报价
        </h4>
      </div>
       <form method="post" action="{{url('user/task/process-price')}}" >
      <div class="modal-body">
        <div class="form-group row"> 
                 <label class="col-md-4 control-label">选择服务内容
                 </label> 
                  <div class="col-md-8">
                    <select name="service_id" id="service_id" class="form-control">
                      <option value="">请选择</option>
                      @foreach($services as $s)
                      <option value="{{$s->id}}" data-name="{{$s->name}}" data-price="{{$s->price}}">{{$s->name}} 
                      </option>
                      @endforeach
                      <option value="0" data-price="" data-name="其他">其他</option>
                    </select>
                  </div>                    
                </div>       
                <div class="form-group row">
                  <label class="col-md-4 control-label">价格</label>
                  <div class="col-md-8">
                    <input class="form-control"  name="service_price" id="price"/>
                  </div>
                </div>  
                 <input type="hidden" name="task_id" value="{{$data->id}}" />
                 <input type="hidden" name="service_name" id="service_name" value="" />
                 <input type="hidden" name="task_openid" value="{{$data->openid}}" />
       {{csrf_field()}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭
        </button>
        <button type="submit" class="btn btn-primary">
          确定
        </button>
      </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal -->
</div>


<!--评价的模态框-->
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          &times;
        </button>
        <h4 class="modal-title" id="myModalLabel">
          请对本次维修进行评价
        </h4>
      </div>
       <form class="form-horizontal" role="form" action="{{url('user/task/comment')}}" method="post">
      <div class="modal-body">
       
        <p>
       <input type="radio" name="point" value="5"> 5分（很好）
     </p>
     <p>
       <input type="radio" name="point" value="4"> 4分（较好）
      </p> 

      <p>
       <input type="radio" name="point" value="3"> 3分（合格）
      </p>
      
      <p> 
       <input type="radio" name="point" value="2"> 2分（较差）
      </p>
      <p> 
       <input type="radio" name="point" value="1"> 1分（很差）
      </p>
      <p> 
       <input type="radio" name="point" value="0">没修好，需要重来
      </p> 
       <input type="hidden" name="task_id" value="{{$data->id}}" />
       {{csrf_field()}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭
        </button>
        <button type="submit" class="btn btn-primary">
          提交评价
        </button>
      </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal -->
</div>

<!--完成模态框-->
<div class="modal fade" id="completeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          &times;
        </button>
        <h4 class="modal-title" id="myModalLabel">
          完工
        </h4>
      </div>
       <form class="form-horizontal" role="form" action="{{url('user/task/process-complete')}}" method="post" enctype="multipart/form-data" id="completeForm">
      <div class="modal-body">

          <div class="form-group">
                  <label class="control-label">上传完工图1<span class="text-danger">*</span></label>
                  
                  <input type="file" class="filestyle" data-buttontext="选择图片" data-buttonname="btn-white" name="work_pic"  accept="image/*" required="" />                
                 

          </div>
          
         

          <div class="form-group">
                  <label class="control-label">处理结果</label>

                    <textarea class="form-control" required=""  name="remark"></textarea>

          </div>

      <input type="hidden" name="task_id" value="{{$data->id}}" />
       {{csrf_field()}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭
        </button>
        <button type="button" class="btn btn-primary" id="completeBtn">
          提交
        </button>
      </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal -->
</div>


@endsection        


        
@section('js')
<script src="{{asset('hrs/plugins/ladda-buttons/js/spin.min.js')}}"></script>
<script src="{{asset('hrs/plugins/ladda-buttons/js/ladda.min.js')}}"></script>
<script src="{{asset('hrs/plugins/ladda-buttons/js/ladda.jquery.min.js')}}"></script>
 <script src="{{asset('hrs/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')}}" type="text/javascript"></script>

<script type="text/javascript">
 $(function() {
    $('#btnDispatch').click(function(e){
        e.preventDefault();
        var l = Ladda.create(this);
        l.start();
        $('#DispatchForm').submit();      
        return false;
    });

    $('#completeBtn').click(function(e){
        e.preventDefault();
        var l = Ladda.create(this);
        l.start();
        $('#completeForm').submit();      
        return false;
    });
});

  $('.btn-comment').on('click',function(){
    $('#commentModal').modal('show');
  });

  $('.btn-refund').on('click',function(){
    $('#refundModal').modal('show');
  });

  $('.btn-dispatch').on('click',function(){
    $('#dispatchModal').modal('show');
  })

   $('.btn-service').on('click',function(){
    $('#serviceModal').modal('show');
  })

  $('.btn-complete').on('click',function(){
    $('#completeModal').modal('show');
  });


  $('#service_id').on('change',function(){
    var price        = $(this).find(':selected').data('price')
    var service_id   = $(this).val();
    var service_name = $(this).find(':selected').data('name')
    //alert(price);
    $('#price').val(price);
   
    $('#service_name').val(service_name);
  })



    

</script>


@endsection