@extends('dingcan.layouts.app')
@section('content')



<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
               
                <div class="col-sm-6">
                    <a href="{{url('diancan/shop/products/create')}}" class="btn btn-primary btn-md waves-effect waves-light m-b-30" ><i class="md md-add"></i>添加菜品</a>
                </div>
                
            </div>

            @if(session('rs'))
            <div class="alert alert-{{session('rs')['status']}}">
                {{ session('rs')['msg'] }}
            </div>
            @endif

            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        
                        

                        <th>菜名</th>
                        <th>图片</th>
                        <th>价格</th>
                        <th>时间段</th>
                        <th>分类</th>
                        

                    </tr>
                    </thead>

                    <tbody>

                    @foreach($list as $v)
                    <tr>
                        
                        <td>
                            {{$v->name}}
                        </td>
                      
                        <td><img src="{{$v->pic}}" width="50" /></td>

                        <td>{{$v->price}}</td>
                        <td>{{object_get($v,'type.name')}}</td>
                        <td>{{object_get($v,'cate.name')}}</td>
                    </tr>
                    <tr>
                        <td colspan="3">
<a href="{{url('diancan/shop/products/repeat/'.$v->id)}}" ><i class="md md-edit"></i>复制</a>
                <a href="{{url('diancan/shop/products/'.$v->id.'/edit')}}" ><i class="md md-edit"></i>编辑</a>

                        <a href="{{url('diancan/shop/products',$v->id)}}" data-method="delete"
                               data-token="{{csrf_token()}}" data-confirm="确定删除吗?"><i class="md md-close"></i>删除</a>

                        </td>
                        <td>
                            <button class="btn btn-info btn-sm">{{$v->status==1?'销售中':'已下架'}}</button>
                        </td>
                        <td>
                            <a href="{{url('diancan/shop/products/change-status')}}?id={{$v->id}}&status={{$v->status==1?0:1}}" class="btn btn-{{$v->status==1?'danger':'success'}} btn-sm">{{$v->status==1?'下架':'上架'}}</a>
                        </td>
                    </tr>
                    @endforeach


                    </tbody>
                </table>
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
    <h4 class="custom-modal-title">添加菜品</h4>
    <div class="custom-modal-text text-left">
        <form class="form-horizontal" role="form" action="{{url('zadmin/users')}}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-md-2 control-label">账号</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="username" value="" required="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">密码</label>
                <div class="col-md-10">
                    <input type="password" class="form-control" name="password" value="" required="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">密码确认</label>
                <div class="col-md-10">
                    <input type="password" class="form-control" name="password2" value="" required="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">手机号码</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="mobile" value="" required="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">E-mail</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="email" value="" required="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">真实姓名</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="truename" value="" required="">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">来源</label>
                <div class="col-md-10">
                    <input type="text" class="form-control" name="source" value="" >
                </div>
            </div>
            @if(session('dcadmin')->rank==100)
            
            <div class="form-group">
                <label class="col-md-2 control-label">角色</label>
                <div class="col-md-10">
                    <select  class="form-control" name="rank" value="" required="">
                        <option value="">请选择角色</option>
                       
                        <option value="1">员工</option>
                        <option value="100">负责人</option>
                    </select>
                </div>
            </div>
            @endif



            <div class="form-group text-center">

                <button type="submit" class="btn btn-info waves-effect waves-light">保存</button>
            </div>


            {{csrf_field()}}
        </form>
    </div>
</div>






@endsection









