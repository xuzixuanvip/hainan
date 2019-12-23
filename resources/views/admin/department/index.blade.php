@extends('admin.layouts.app')
@section('content')
    <style>
        #department::-webkit-scrollbar {
            display: none;
        }
    </style>
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">科室管理</h4>
            <ol class="breadcrumb">
                <li><a href="{{url('zadmin/')}}">系统</a></li>

                <li class="active">科室列表</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-sm-4">
                        <form role="form" href="{{ route('department.index') }}">
                            <div class="form-group contact-search col-sm-8 m-b-30">
                                <input type="text" id="search" class="form-control"  name="name" value="{{ Request()->name ?? '' }}" placeholder="输入科室名搜索">

                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
                            </div> <!-- form-group -->
                        </form>
                    </div>



                    <div class="col-sm-7">

                        <div class="col-sm-1" style="float: right">
                            <a href="{{  route('department.create') }}" class="btn btn-primary btn-md waves-effect waves-light m-b-30"
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
                            <th>科室名称</th>
                            <th>性别</th>
                            <th>对应疾病</th>
                            <th style="width: 200px;">操作</th>
                        </tr>
                        </thead>

                        @if($dep)
                        <tbody>
                            @foreach($dep as $v)
                                <tr>

                                    <td>
                                        {{$v->name}}
                                    </td>

                                    <td id="department">
                                        @foreach($v->tags as $vv)
                                            <span style="float:left;border: 1px solid;border-radius: 10px;padding: 3px;">{{ $vv->name }}</span>
                                        @endforeach
                                    </td>

                                    <td>
                                        <a href="{{url('zadmin/disease/symptom/'.$v->id)}}">{{$v->name}}({{$v->diseases->count()}})</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('department.edit',$v->id) }}" ><i class="md md-edit"></i>编辑</a>
                                        <a type="submit" href="javascript:;" onclick="return delete_body('{{ $v->id }}')"  data-method="delete"
                                           data-token=""><i class="md md-close"></i>删除</a>
                                    </td>
                                </tr>

                            @endforeach
                            {!!  $dep->appends(Request::all())->render()  !!}
                        @else

                            暂无数据~
                        @endif


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

        function delete_body(id) {
            if(!confirm('您确定要删除'+id)){
                return false;
            }

            $.post('{{ route('department.delete') }}',{'id':id,'_token':'{{ csrf_token() }}','_method':'DELETE'},function (data) {
                if(data.code == 200){
                    window.location.href = '{{ route('department.index') }}';
                }
            },'json');

            return false;
        }

    </script>
@endsection









