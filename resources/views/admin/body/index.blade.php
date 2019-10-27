@extends('admin.layouts.app')
@section('content')
    @if (Session::has('message'))
        <div class="alert alert-info">
            <button type="button" onclick="alert(132)" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ Session::get('message') }}
        </div>
    @endif

    @if (Session::has('success'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('danger'))
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ Session::get('danger') }}
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">身体管理</h4>
            <ol class="breadcrumb">
                <li><a href="{{url('zadmin/')}}">系统</a></li>

                <li class="active">身体列表</li>
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
                                    <input type="text" id="search" class="form-control"  name="keyword" value="" placeholder="输入疾病名搜索">

                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
                            </div> <!-- form-group -->
                        </form>
                    </div>

                    <div class="col-sm-7">

                        <div class="col-sm-1" style="float: right">
                            <a href="{{ route('body.create') }}" class="btn btn-primary btn-md waves-effect waves-light m-b-30"
                            ><i class="md md-add"></i>添加</a>
                        </div>


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
                            <th>身体部位</th>
                            <th>部位性别</th>
                            <th>对应症状</th>
                            <th style="width: 200px;">操作</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($body as $v)
                            <tr>
                                <td>

                                    <input  name="ids[]" type="checkbox" value="{{$v->id}}" class="check_class">

                                </td>

                                <td onclick="display({{ $v->id }})">
                                    {{$v->name}} ( {{ count($v->son) }} )
                                </td>
                                <td>
                                    {{ $v->sex }}
                                </td>
                                <td>
                                    <a href="">对应症状添加</a>
                                </td>
                                <td>
                                    <a href="{{ route('body.edit',$v->id) }}" ><i class="md md-edit"></i>编辑</a>
                                    <a href="" data-method="delete"
                                       data-token="" data-confirm="确定删除吗?"><i class="md md-close"></i>删除</a>
                                </td>
                            </tr>
                            @foreach($v->son as $vv)
                                <tr class="son_{{ $v->id }}" hidden="">
                                    <td>
                                        <input  name="ids[]" type="checkbox" value="{{$vv->id}}" class="check_class">
                                    </td>
                                    <td>&nbsp;&nbsp;&nbsp;|-----{{$vv->name}}</td>
                                    <td>{{ $vv->sex }}</td>
                                    <td>
                                        <a href="">对应症状添加</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('body.edit',$vv->id) }}" ><i class="md md-edit"></i>编辑</a>
                                        <a href="" data-method="delete"
                                           data-token="" data-confirm="确定删除吗?"><i class="md md-close"></i>删除</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach







                        </tbody>
                    </table>

                    <button type="button" class="btn-danger bathDel">批量删除</button>

                </div>

                {!! $body->appends(Request::all())->render() !!}
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
            var url="{{url('zadmin/disease/bath-del')}}";
            var data = {};
            data.ids = ids;
            data._token = "{{csrf_token()}}";
            console.log(url);
            $.post(url,data,function(rs){

                if(rs.status==true) {
                    window.location.reload();
                }
            });
            console.info(ids);
        });

        function display(id) {
            if($('.son_'+id).attr('hidden') == 'hidden'){
                $('.son_'+id).removeAttr('hidden');
            } else {
                $('.son_'+id).attr('hidden',true);
            }
        }
    </script>
@endsection
