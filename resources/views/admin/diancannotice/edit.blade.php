@extends('admin.layouts.app')
@include('vendor.ueditor.assets')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">食堂公告管理</h4>
                                <ol class="breadcrumb">
                                    
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="card-box">
                            <h2 class="m-t-0 header-title">公告内容</h2>
                            <hr/>
                             @if(session('rs'))
                              <div class="alert alert-{{session('rs')['status']}}">
                                {{ session('rs')['msg'] }}
                              </div>
                              @endif
                              <div class="row">
                                <div class="col-md-9">
                                  <form class="form-horizontal" role="form" action="{{url('zadmin/diancan/notice/update')}}"  method="post" >
                               
                                          
                                                                                                                 
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">内容</label>
                                                  <div class="col-md-10">
                                                      <!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container');
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
    });
</script>

<!-- 编辑器容器 -->
<script id="container" name="contents" type="text/plain">{!!object_get($data,'contents')!!}</script>
                                                  </div>
                                              </div>

                                              <div class="form-group text-center">
                                                  
                                                  <button type="submit" class="btn btn-info waves-effect waves-light">保存</button>
                                              </div>
                                              
                                              
                             {{csrf_field()}}
                        <input name="id" value="{{object_get($data,'id')}}" type="hidden">
                      </form>
                                </div>
                                
                              </div>

                             
                              
                              
                            </div>
                                
                            </div> <!-- end col -->

                            
                        </div>
@endsection
                        
                        
                        

                  
            
    
       

           



    
       
    
