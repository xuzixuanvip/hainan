@extends('admin.layouts.app')

@section('content')


    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">身体管理</h4>
            <ol class="breadcrumb">
                <li><a href="{{url('zadmin/')}}">系统</a></li>
                <li><a href="{{route('body.index')}}">身体列表</a></li>
                <li class="active">新建身体</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h2 class="m-t-0 header-title">新建身体</h2>
                <hr/>
                @if(session('rs'))
                    <div class="alert alert-{{session('rs')['status']}}">
                        {{ session('rs')['msg'] }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal" role="form" action="{{ route('body.store') }}" method="post" enctype="multipart/form-data">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">身体名称</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="name" required="" value="{{old('name')}}">
                                </div>
                            </div>
{{--                            ==========================--}}
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">选择分类</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="pid">
                                        <option value="0" >顶级分类</option>
                                        @foreach($body_son as $k => $v)
                                            <option value="{{ $k }}" >{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
{{--                            =============================--}}
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">性别</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="sex">
                                        <option value="1" >男</option>
                                        <option value="2" >女</option>
                                        <option value="0" >不限</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group text-center col-md-12">

                                <button type="submit" class="btn btn-info waves-effect waves-light">保存</button>
                            </div>
                            {{csrf_field()}}
                        </form>
                    </div>

                </div>




            </div>

        </div> <!-- end col -->


    </div>
@endsection






@section('modal')

@endsection







@section('js')

    <script type="text/javascript">


        $('.type').on('change',function(){
            var _val = $(this).val();
            if(_val==2) {
                $('.money').show();
                $('.rate').hide();
            }else{
                $('.rate').show();
                $('.money').hide();
            }
        });
    </script>
@endsection

