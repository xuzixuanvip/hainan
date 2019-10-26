@extends('dingcan.layouts.app')
@include('vendor.ueditor.assets')
@section('content')

                   
                        
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="card-box">
                            <h2 class="m-t-0 header-title">修改信息</h2>
                            <hr/>
                             @if(session('rs'))
                              <div class="alert alert-{{session('rs')['status']}}">
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
                              <div class="row">
                                <div class="col-md-9">
                                  <form class="form-horizontal" role="form" action="{{url('diancan/shop/shop-update')}}" enctype="multipart/form-data" method="post" >
                                    
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">店名</label>
                                                  <div class="col-md-10">
                                                      <input type="input" class="form-control" name="name" required="" value="{{$data->name}}">
                                                  </div>
                                                 
                                              </div>
                <div class="form-group">
                                                  <label class="col-md-2 control-label">图片</label>
                                                  <div class="col-md-8">
            <input type="file" class="form-control" name="pic" >
            </div>
            <div class="col-md-2">
              <img src="{{$data->pic}}" width="50" />
            </div>
                                                 
                                              </div>                              
                <div class="form-group">
                                                  <label class="col-md-2 control-label">电话</label>
                                                  <div class="col-md-10">
                                                      <input type="input" class="form-control" name="mobile" required="" value="{{$data->mobile}}">
                                                  </div>
                                                 
                                              </div>
                <div class="form-group">
                                                  <label class="col-md-2 control-label">地址</label>
                                                  <div class="col-md-10">
                                                      <input type="input" class="form-control" name="address" required="" value="{{$data->address}}">
                                                  </div>
                                                 
                                              </div>                     <div class="form-group">
                                                  <label class="col-md-2 control-label">公告摘要</label>
                                                  <div class="col-md-10">
                                                      <input type="input" class="form-control" name="notice_describe" required="" value="{{$data->notice_describe}}">
                                                  </div>
                                                 
                                              </div>                                       
                                                                                                                 
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">公告详情</label>
                                                  <div class="col-md-10">
                                                      <!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container');
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
    });
</script>

<!-- 编辑器容器 -->
<script id="container" name="notice_contents" type="text/plain">{!!$data->notice_contents!!}</script>
                                                  </div>
                                              </div>

                                              <div class="form-group text-center">
                                                  
                                                  <button type="submit" class="btn btn-info waves-effect waves-light">保存</button>
                                              </div>
                                              
                             <input type="hidden" name="id" value="{{$data->id}}" />                 
                             {{csrf_field()}}
                                          </form>
                                </div>
                                
                              </div>

                             
                              
                              
                            </div>
                                
                            </div> <!-- end col -->

                            
                        </div>
@endsection
                        
                        
                        

                  
            
    
       

           



    
       
    
