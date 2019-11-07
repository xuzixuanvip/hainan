@extends('admin.layouts.app')
@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">条件管理</h4>
            <ol class="breadcrumb">
                <li><a href="{{url('zadmin/')}}">系统</a></li>

                <li class="active">条件列表</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-sm-1" style="float: right">
                        <a href="{{ route('tags.create') }}" class="btn btn-primary btn-md waves-effect waves-light m-b-30"
                        ><i class="md md-add"></i>添加</a>
                    </div>
                    <div class="col-sm-4">
                        <form role="form">
                            <div class="form-group contact-search col-sm-8 m-b-30">
                                <input type="text" id="search" class="form-control"  name="keyword" value="" placeholder="输入条件名搜索">

                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
                            </div> <!-- form-group -->
                        </form>
                    </div>

                    <div class="col-sm-7">
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
                            <th>条件名称</th>
                            <th style="width: 200px;">操作</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($list as $v)
                            <tr>
                                <td>
                                    {{$v->name}}
                                </td>
                                <td>
                                    <a href="{{url('zadmin/tags/'.$v->id.'/edit')}}" ><i class="md md-edit"></i>编辑</a>
                                    <a href="{{route('tags.image_edit',$v->id)}}" ><i class="md md-edit"></i>编辑图片</a>
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
            var url="{{url('zadmin/symptom/bath-del')}}";
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



    </script>
@endsection









