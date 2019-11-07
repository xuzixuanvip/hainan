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
            <h4 class="page-title">公告管理</h4>
            <ol class="breadcrumb">
                <li><a href="{{url('zadmin/')}}">系统</a></li>

                <li class="active">公告列表</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
{{--                <div class="row">--}}
{{--                    <div class="col-sm-4">--}}
{{--                        <form role="form" action="{{ route('body.index') }}" method="get">--}}
{{--                            <div class="form-group contact-search col-sm-8 m-b-30">--}}
{{--                                --}}{{--                                {{ csrf_field() }}--}}
{{--                                <input type="text" id="name" class="form-control"  name="name" value="{{ request()->name ??  request()->name }}" placeholder="输入疾病名搜索">--}}

{{--                            </div>--}}
{{--                            <div class="col-sm-4">--}}
{{--                                <button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>--}}
{{--                            </div> <!-- form-group -->--}}
{{--                        </form>--}}
{{--                    </div>--}}

{{--                    <div class="col-sm-7">--}}

{{--                        <div class="col-sm-1" style="float: right">--}}
{{--                            <a href="{{ route('body.create') }}" class="btn btn-primary btn-md waves-effect waves-light m-b-30"--}}
{{--                            ><i class="md md-add"></i>添加</a>--}}
{{--                        </div>--}}


{{--                    </div>--}}
{{--                </div>--}}

                @if(session('rs'))
                    <div class="alert alert-{{session('rs')['status']}}">
                        {{ session('rs')['msg'] }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            {{--                            <th style="min-width: 35px;">--}}
                            {{--                                <input id="checkAll" type="checkbox" value=""/>全选--}}

                            {{--                            </th>--}}
                            <th>公告内容</th>
                            <th style="width: 200px;">操作</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if($content)
                            <tr>

                                <td>
                                   <p style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;width:500px" alt="{{ $content->content }}">{{ $content->content }}</p>
                                </td>

                                        <td>
                                            <a href="{{ route('content.edit',$content->id) }}" ><i class="md md-edit"></i>编辑</a>
{{--                                            <a type="submit" href="javascript:;" onclick="return delete_body('{{ $vv->id }}')"  data-method="delete"--}}
{{--                                               data-token=""><i class="md md-close"></i>删除</a>--}}
                                        </td>
                                    </tr>
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
            var url="{{ route('body.deleteAll') }}";
            var data = {
                'ids':ids,
                '_method':'DELETE',
                '_token' :'{{ csrf_token() }}'
            };
            // data.ids = ids;
            {{--data._token = "{{csrf_token()}}";--}}
            $.post(url,data,function(data){
                // if(data,code == 200) {
                window.location.reload();
                // }
            },'json');
            // console.info(ids);
        });

        function display(id) {
            if($('.son_'+id).attr('hidden') == 'hidden'){
                $('.son_'+id).removeAttr('hidden');
            } else {
                $('.son_'+id).attr('hidden',true);
            }
        }

        function delete_body(id) {
            if(!confirm('您确定要删除'+id)){
                return false;
            }

            $.post('{{ route('body.delete') }}',{'id':id,'_token':'{{ csrf_token() }}','_method':'DELETE'},function (data) {
                if(data.code == 200){
                    window.location.href = '{{ route('body.index') }}';
                }
            },'json');

            return false;
        }
    </script>
@endsection
