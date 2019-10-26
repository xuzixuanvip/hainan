@extends('admin.layouts.app')
@section('content')

<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <h4 class="page-title">菜品管理</h4>
        <ol class="breadcrumb">
            <li><a href="#">系统</a></li>
            
            <li class="active">菜品列表</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="row">
                <div class="col-sm-8">
                    <form role="form">
                        <div class="form-group contact-search m-b-30">
                            <input type="text" id="search" class="form-control" placeholder="Search...">
                            <button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
                        </div> <!-- form-group -->
                    </form>
                </div>
                <div class="col-sm-2">


                     <a href="{{url('zadmin/diancan/products/create')}}" class="btn btn-primary btn-md waves-effect waves-light m-b-30" ><i class="md md-add"></i>添加</a>
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
                        

                        <th>菜名</th>
                        <th>图片</th>
                        <th>价格</th>
                        <th>时间段</th>
                        <th>分类</th>
                        


                        <th style="width: 200px;">操作</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($list as $v)
                    <tr>
                        <td>
                            {{$v->id}}
                        </td>

                        <td>
                            {{$v->name}}
                        </td>
                      
                        <td><img src="{{$v->pic}}" width="50" /></td>

                        <td>{{$v->price}}</td>
                        <td>{{object_get($v,'type.name')}}</td>
                        <td>{{object_get($v,'cate.name')}}</td>





                        <td>
<a href="{{url('zadmin/diancan/products/repeat/'.$v->id)}}" ><i class="md md-edit"></i>复制</a>
                <a href="{{url('zadmin/diancan/products/'.$v->id.'/edit')}}" ><i class="md md-edit"></i>编辑</a>

                        <a href="{{url('zadmin/diancan/products',$v->id)}}" data-method="delete"
                               data-token="{{csrf_token()}}" data-confirm="确定删除吗?"><i class="md md-close"></i>删除</a>

                        </td>
                    </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
{{--            {{$list->links()}}--}}
        </div>

    </div> <!-- end col -->


</div>
@endsection






@section('modal')







@endsection









