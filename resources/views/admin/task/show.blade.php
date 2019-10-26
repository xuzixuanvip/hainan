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
                                 
            <table class="table table-hover">
               <!--  <tr>
                  <td>资产编号</td>
                  <td><strong>{{$data->title}}</strong></td>
                </tr> -->
                <tr>
                  <td>姓名</td>
                  <td>{{$data->customer_name}}</td>
                </tr>
                <tr>
                  <td>手机号</td>
                  <td>{{$data->mobile}}</td>
                </tr>
                <tr>
                  <td>报修类型</td>
                  <td>{{object_get($data,'category.name')}}</td>
                </tr>
                <tr>
                  <td>报修地点</td>
                  <td>{{object_get($data,'depart.name')}}{{$data->address}}</td>
                </tr>
                <tr>
                  <td>故障内容</td>
                  <td>{{$data->content}}</td>
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
                {{--
               <tr>
                  <td colspan="2">
                    <a class="btn btn-primary btnPrint" href="{{url('zadmin/task/print',$data->id)}}" >打印</a>
                  </td>
                </tr>
                --}}
               
              </table>
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

            <a class="btn btn-success" href="{{url('zadmin/task/complete')}}?task_id={{$data->id}}">工单完成</a>
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
    
  </script>


@endsection                      
                        

                  
            
        
       

           



    
        
    
