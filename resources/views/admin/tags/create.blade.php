@extends('admin.layouts.app')

@section('content')
    <style>
        .file {
            position: relative;
            display: inline-block;
            background: #D0EEFF;
            border: 1px solid #99D3F5;
            border-radius: 4px;
            padding: 4px 12px;
            overflow: hidden;
            color: #1E88C7;
            text-decoration: none;
            text-indent: 0;
            line-height: 20px;
        }
        .file input {
            position: absolute;
            font-size: 100px;
            right: 0;
            top: 0;
            opacity: 0;
        }
        .file:hover {
            background: #AADFFD;
            border-color: #78C3F3;
            color: #004974;
            text-decoration: none;
        }
    </style>


    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">条件管理</h4>
            <ol class="breadcrumb">
                <li><a href="{{url('zadmin/')}}">系统</a></li>
                <li><a href="{{route('tags.index')}}">条件列表</a></li>
                <li class="active">新建条件</li>
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
                        <form class="form-horizontal" role="form" action="{{ route('tags.store') }}" method="post" enctype="multipart/form-data">
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">条件名称</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="name" required="" value="{{old('name')}}">
                                </div>
                            </div>
                            {{--                            ==========================--}}

                            {{--                            =============================--}}
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">状态</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="status">
                                        <option value="1" >激活</option>
                                        <option value="0" >暂停</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">图片</label>
                                <div class="col-md-9">
                                    <input type="file" name="img" class="file" >
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



    </script>
@endsection

