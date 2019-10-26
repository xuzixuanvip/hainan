@extends('dingcan.layouts.app')
@section('content')



<div class="row">
    <div class="col-lg-12 col-sm-12">
        
            <div class="row">
               
                <div class="col-sm-6">
                    <a href="{{url('diancan/shop/cates/create')}}" class="btn btn-primary btn-md waves-effect waves-light m-b-30"><i class="md md-add"></i>添加菜品分类</a>
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
                       
                        

                        <th>分类名</th>
                        <th>菜品数量</th>
                       


                        <th>操作</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($list as $v)
                    <tr>
                       

                        <td>
                            <a href="{{url('diancan/shop/cates/'.$v->id.'/edit')}}" >{{$v->name}}
                            </a>
                        </td>
                        <td>
                            <a href="{{url('diancan/shop/cates/'.$v->id.'/edit')}}" >
                            {{$v->products->count()}}
                        </a>
                        </td>





                        <td>

                          

                            <a class="btn btn-sm btn-danger" href="{{url('diancan/shop/cates',$v->id)}}" data-method="delete"
                               data-token="{{csrf_token()}}" data-confirm="确定删除吗?"><i class="md md-close"></i>删除</a>

                        </td>
                    </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
{{--            {{$list->links()}}--}}
        

    </div> <!-- end col -->


</div>
@endsection






@section('modal')





@endsection









