@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">消息模板管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="#">系统</a></li>
                                    <li><a href="#">系统设置</a></li>
                                    <li class="active">消息模板列表</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                          
                        	<div class="col-lg-12">
                        		<div class="card-box">
                        			<div class="row">
                                <a href="{{url('zadmin/wechat/msgtpl-import')}}" class="btn btn-default" >导入模板</a>
                              
                                <a href="{{url('zadmin/wechat/msgtpl-all')}}" class="btn btn-info" >微信端模板</a>
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
													
													<th>模板id</th>
													<!-- <th>维修内容编码</th>
                          <th>收费类型</th> -->
                          <th>名称</th>
                          <th>CODE</th>
                          <th>操作</th>
                         
													
												</tr>
											</thead>
											
                      <tbody>

                      @foreach($list as $k=>$v)
                      <tr>
                          <td>

                            {{$v['template_id']}} 
                          </td>
                          <td>
                            {{$v['title']}}
                          </td>
                          <td>{{$v['code']}}</td>
                          <td>
                          
                         
                          <a class="btn btn-info" href="{{url('zadmin/wechat/msgtpl-edit',$v->id)}}">编辑</a>

                          <a class="btn btn-danger" href="{{url('zadmin/wechat/msgtpl-del',$v['template_id'])}}">删除</a>
                          </td>

                      </tr>
                      @endforeach
                      </tbody>
                                        </table>
                                    </div>
                        		</div>
                                
                            </div> <!-- end col -->

                            
                        </div>
@endsection
                        
                        
                        

                  
            
    @section('modal')        
        <!-- Modal -->
     <div class="modal fade" id="tpl-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          &times;
        </button>
        <h4 class="modal-title" id="tplTitle">
          消息模板详情
        </h4>
      </div>
     
      <div class="modal-body">
        <div class="row" id="tplContent">
          
        </div>
        <div class="row" id="tplExample">
          
        </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭
        </button>
        <button type="submit" class="btn btn-primary">
          确定
        </button>
      </div>
   
    </div><!-- /.modal-content -->
  </div><!-- /.modal -->
</div>
    @endsection        
       

    @section('js')
    <script type="text/javascript">
      $('.btn-tpl').on('click',function(){
        var tpl_key = $(this).data('tpl_key');
        var url = "{{url('zadmin/wechat/msgtpl-show/')}}/"+tpl_key;
        //alert(url);
        $.get(url,function(rs){
          $('#tpl-modal').modal('show');
          $('#tplContent').html(rs.content);
          $('#tplExample').html(rs.example);
          $('#tplTitle').text(rs.title+' '+rs.template_id)
          console.info(rs);
        })
        
      })
    </script>
    @endsection        



    
        
    
