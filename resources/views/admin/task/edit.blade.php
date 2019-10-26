@extends('admin.layouts.app')
@section('content')

                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">工单管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                    <li><a href="{{url('zadmin/task')}}">任务管理</a></li>
                                    <li class="active">任务详情</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                            <h2 class="m-t-0 header-title">工单详情</h2>
                            <hr/>
                             
      <div class="row">
			   <div class="col-md-9">
            
            <form method="post" action="{{url('zadmin/task/update')}}">                     
            <table class="table table-hover">
             
                <tr>
                  <td>姓名</td>
                  <td>{{$data->customer_name}}</td>
                </tr>
                <tr>
                  <td>手机号</td>
                  <td><input name="mobile" class="form-control" value="{{$data->mobile}}" /></td>
                </tr>
                <tr>
                  <td>报修类型</td>
                  <td>
                    <select class="form-control" name="category_id">
                      @foreach($cates as $cate)
                      <option value="{{$cate->id}}" {{$cate->id==$data->category_id?'selected':''}}>{{$cate->name}}</option>
                      @endforeach
                    </select></td>
                </tr>
                <tr>
                  <td>报修地点</td>
                  <td>
                    <select class="form-control" name="depart_id">
                      @foreach($departs as $d)
                      <option value="{{$d->id}}" {{$d->id==$data->depart_id?'selected':''}}>{{$d->name}}</option>
                      @endforeach
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>故障内容</td>
                  <td>
                    <textarea class="form-control" name="content">{{$data->content}}</textarea>
                  </td>
                </tr>
                <tr>
                  <td>故障图像</td>
                  <td><img src="{{$data->thumb}}" width="600" /></td>
                </tr>
                @if($data->vide)
                <tr>
                  <td>视频</td>
                  <td>
                    <video src="{{$data->video}}" controls="controls" width="500">
您的浏览器不支持 video 标签。
</video>
                  </td>
                </tr>
                @endif
                <tr>
                  <td>预约时间</td>
                  <td>{{$data->service_time}}</td>
                </tr>
                <tr>
                  <td>当前状态</td>
                  <td><label class="label label-{{$taskStatus[$data->status]['style']}}">{{$taskStatus[$data->status]['txt']}}</label></td>
                </tr>
               <tr>
                  <td>备注</td>
                  <td><textarea class="form-control" name="remark">{{$data->remark}}</textarea></td>
                </tr>
                <tr>
                  <td>等级</td>
                  <td>
                    <button type="button" class="btn btn-{{$data->rank=='A'?'purple':'default'}} btn-rank" data-rank="A">A</button>
                    <button type="button" class="btn btn-{{$data->rank=='B'?'purple':'default'}} btn-rank" data-rank="B">B</button>
                    <button type="button" class="btn btn-{{$data->rank=='C'?'purple':'default'}} btn-rank" data-rank="C">C</button>
                    <button type="button" class="btn btn-{{$data->rank=='D'?'purple':'default'}} btn-rank" data-rank="D">D</button>
                    <input name="rank" class="form-control" value="{{$data->rank}}" type="hidden" /></td>
                </tr>
              </table>
              <button class="btn btn-success">更新</button>
              <a class="btn btn-primary" href="{{url('zadmin/task/complete')}}?task_id={{$data->id}}">工单完成</a>
              <a class="btn btn-default btn-sm btn-dispath" data-id="{{$data->id}}">派工</a>
              {{csrf_field()}}
              <input name="id" value="{{$data->id}}" type="hidden" />
              </form> 
            </div>


            <div class="col-md-3">
                <table class="table table-hover">
                <tr>
                  <td>微信昵称</td>
                  <td><strong>{{$wechatInfo['nickname']}}</strong></td>
                </tr>
                <tr>
                  <td>微信头像</td>
                  <td><img src="{{$wechatInfo['headimgurl']}}" width="100" /></td>
                </tr>
              </table>
            </div>

            
            
            
          </div>
             
              
              
             <hr/>
              @if($process)
              <div class="row">
              <h4>派工信息</h4>       
                     <div class="col-md-12">
                     <table class="table">
                      <tr>
                        <th>维修人</th>
                        <th>备注</th>
                        <th>工单状态</th>
                        <th>图片</th>
                        <th>派工时间</th>
                      </tr>
                       @foreach($process as $pro)
                       <tr>
                        <td>
                     {{object_get($pro,'worker.truename')}} &nbsp;{{object_get($pro,'worker.mobile')}}</td>
                      <td>
                        {{$pro->remark}} &nbsp;&nbsp; 
                        </td>
                        <td><label class="label label-{{$taskStatus[$pro->status]['style']}} ">{{$taskStatus[$pro->status]['txt']}}</label>
                      </td>
                      <td>
                        <?php 
    $pics = explode(',',rtrim($pro->work_pic,','));
    if(is_array($pics)) {
      $thumbs = explode(',',rtrim($pro->work_thumb,','));
      foreach($thumbs as $k=>$t){
        echo '<a href="'.$pics[$k].'" target="_blank"><img src="'.$t.'" width="100"  /></a>';
      }  
    }
    
?>
                      </td>
                      <td>{{$pro->created_at}}               
                      </td>
                      </tr>
                       @endforeach
                        </table>
                     </div>
                </div>     
                     
             
              @endif
              
              @if($comment)
              <div class="row">
                <h4>评价信息</h4>
                <div class="col-md-12">
                  {{$comment->point}}分,{{$comment->remark}}
                </div>
              </div>
              @endif
              
                                              
                                           
                            
              
                                              
                                           
                            
                                          
       	                        	
			</div>
    </div>
                                
                            </div> <!-- end col -->

                            
                      
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
<!-- /.modal -->                        
@endsection       
                        
  @section('js')
  <script src="{{asset('admin/js/jquery.printPage.js')}}"></script>
  <script type="text/javascript">
      $(document).ready(function() {
        $(".btnPrint").printPage({
          url:"{{url('zadmin/task/print',$data->id)}}",
          attr:"href",
        });
      });

    $('.task-btn').on('click',function(){
      var status = $(this).data('status');
      $('input[name="status"]').val(status);
      $('#form1').submit();
    });


    $('.btn-dispath').on('click',function(){
        var task_id = $(this).data('id');
        $('#dispatchModal').modal('show');
        $('input[name="task_id"]').val(task_id);
    })

    $('.btn-rank').on('click',function(){
      var rank = $(this).data('rank');
      $('input[name="rank"]').val(rank);
      $('.btn-rank').removeClass('btn-purple').addClass('btn-default');
      $(this).removeClass('btn-default').addClass('btn-purple');
    });
    
  </script>


@endsection                      
                        

                  
            
        
       

           



    
        
    
