@extends('admin.layouts.app')
@section('content')

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="page-title">配件管理</h4>
                                <ol class="breadcrumb">
                                    <li><a href="{{url('zadmin/')}}">系统</a></li>
                                    
                                    <li class="active">配件列表</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="row">
                        	<div class="col-lg-12">
                        		<div class="card-box">
                        			<div class="row">
			                        	<div class="col-sm-4">
			                        		<form role="form">
			                                    <div class="form-group contact-search col-sm-8 m-b-30">
			                                    	<input type="text" id="search" class="form-control"  name="keyword" value="{{array_get($where,'keyword')}}" placeholder="输入配件名搜索">
			                                        
			                                    </div>
                                          <div class="col-sm-4">
                                            <button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
                                          </div> <!-- form-group -->
			                                </form>
			                        	</div>
			                        	
                                <div class="col-sm-7">
                <form enctype="multipart/form-data" method="post" action="{{url('zadmin/goods/import')}}">                                  
                  <div class="col-sm-6">
                    <input type="file" required="" name="excel" class="form-control" >
                  
                  </div>
                  <div class="col-sm-2">
                    <button  class="btn btn-danger btn-md waves-effect waves-light m-b-30"><i class="md  md-file-upload">导入</i></button>
                  </div>
                  <div class="col-sm-2">
                    <a href="{{url('excel/批量导入配件模板.xlsx')}}"  class="btn btn-default btn-md waves-effect waves-light m-b-30"><i class="md  md-file-download">模板</i></a>
                  </div>
                  <div class="col-sm-1"> 
                                  <a href="{{url('zadmin/goods/create')}}" class="btn btn-primary btn-md waves-effect waves-light m-b-30"  
                                  ><i class="md md-add"></i>添加</a>
                                </div>
                  {{csrf_field()}}
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
													<input id="checkAll" type="checkbox" value=""/>全选
                                                        
													</th>
													<th>配件名称</th>
													<th>原厂编码</th>
                          <th>库存</th>
                          <th>进货价</th>
                          <th>零售价</th>
                          <th>库存变更记录</th>
                         
                         
													<th style="width: 200px;">操作</th>
												</tr>
											</thead>
											
                                            <tbody>

                                            @foreach($list as $v)
                                                <tr>
                                                    <td>
                                                       
                                                        <input  name="ids[]" type="checkbox" value="{{$v->id}}" class="check_class">
                                                      
                                                    </td>
                                                    
                                        <td>
                    {{$v->name}}
                                                    </td>
                        <td>{{$v->source_code}}</td>
                        <td>
                          <span class="label label-{{$v->store_num>2?'success':'danger'}}">{{$v->store_num}}</span></td>
                                                     <td>
                                                        {{$v->in_price}}
                                                    </td>
                                                     <td>
                                                        {{$v->out_price}}
                                                    </td>

                                                  <td>
                                                    <a class="btn btn-info btn-sm" href="{{url('zadmin/goodslogs')}}?goods_id={{$v->id}}">
                                                      库存变更记录
                                                    </a>
                                                  </td>
                                                    
                                                
                                                    
                                                   
                                                    <td>
                                                    	<a href="{{url('zadmin/goods/'.$v->id.'/edit')}}" ><i class="md md-edit"></i>编辑</a>
                                                    	<a href="{{url('zadmin/goods',$v->id)}}" data-method="delete"
  data-token="{{csrf_token()}}" data-confirm="确定删除吗?"><i class="md md-close"></i>删除</a>
                                                    </td>
                                                </tr>
      
                                            @endforeach
                                                
                                               
                                               
                                                
                                               
                                                
                                            
                                            </tbody>
                                        </table>
                                      
            <button type="button" class="btn-danger bathDel">批量删除</button>
                                        
                                    </div>
                                    
                                    {{$list->links()}}
                        		</div>
                               
                            </div> <!-- end col -->

                            
                        </div>
@endsection
                        
                        
                        

                  
            
    @section('modal')        
        <!-- Modal -->
      <div id="custom-modal" class="modal-demo">
          <button type="button" class="close" onclick="Custombox.close();">
              <span>&times;</span><span class="sr-only">Close</span>
          </button>
          <h4 class="custom-modal-title">添加配件</h4>
          <div class="custom-modal-text text-left">
              <form class="form-horizontal" role="form" action="{{url('zadmin/goods')}}" method="post" enctype="multipart/form-data">                                    
                                             
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">地点名称</label>
                                                  <div class="col-md-10">
                                                      <input type="text" class="form-control" name="name" value="" required="">
                                                  </div>
                                              </div>
                                              
                                                                                                                    
                                              <div class="form-group">
                                                  <label class="col-md-2 control-label">备注</label>
                                                  <div class="col-md-10">
                                                      <textarea class="form-control" rows="5" name="remark"></textarea>
                                                  </div>
                                              </div>

                                              <div class="form-group text-center">
                                                  
                                                  <button type="submit" class="btn btn-info waves-effect waves-light">保存</button>
                                              </div>
                                              
                                              
                             {{csrf_field()}}
                                          </form>
          </div>
      </div>
    @endsection  

    @section('js')
    <script type="text/javascript">
    $('#checkAll').click(function () {    
      $('input:checkbox').prop('checked', this.checked);    
    });


  $('.bathDel').on('click',function(){
    var ids = $('.check_class:checked').map(function() {
      return this.value;
    }).get();
    if(ids==''){
      alert('请选择要删除的数据');return;
    }
    var url="{{url('zadmin/goods/bath-del')}}";
    var data = {};
    data.ids = ids;
    data._token = "{{csrf_token()}}";
    $.post(url,data,function(rs){
      if(rs.status==true) {
        window.location.reload();
      }
    });
    console.info(ids);
  });
    
    
  
</script>
    @endsection      
       

           



    
        
    
