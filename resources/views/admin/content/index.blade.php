@extends('admin.layouts.app')
@section('content')

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

                @if(session('rs'))
                    <div class="alert alert-{{session('rs')['status']}}">
                        {{ session('rs')['msg'] }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>

                            <th>公告内容</th>
                            <th>开关</th>
                            <th style="width: 200px;">操作</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if($content)
                            @foreach($content as $k =>$v)
                            <tr>
                                @if($k < 2)
                                <td>
                                   <p style="white-space: nowrap;width:500px" alt="">{!!   $v->content !!}</p>
                                </td>
                                <td>
                                    <a href="javascript:;" onclick="content_status('{{ $v->id }}','{{ $status[$v->id] }}')">{{ $status[$v->id] == 1 ? '开' : '关' }}</a>
                            
                                </td>

                                        <td>
                                            <a href="{{ route('content.edit',$v->id) }}" ><i class="md md-edit"></i>编辑</a>
{{--                                            <a type="submit" href="javascript:;" onclick="return delete_body('{{ $vv->id }}')"  data-method="delete"--}}
{{--                                               data-token=""><i class="md md-close"></i>删除</a>--}}
                                        </td>
                                @endif
                                @if($k == 2)
                                    <td>
                                        <img src="{{url('/').$v->content}} " style="width:50px" alt="">
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        <a href="{{ route('content.image.edit',['id'=>$v->id,'content'=>'img'] )}}" ><i class="md md-edit"></i>编辑</a>

                                    </td>
                                @endif
                            </tr>
                            @endforeach
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


        function content_status(id,status) {
            if(id == '' && status == '') {
                return false;
            }
            if(status == 1) {
                status = 0;
            } else {
                status = 1;
            }
            // cons
            $.post('{{route('content.status')}}',{'_token':'{{ csrf_token() }}','id':id,'status':status},function (data) {
                    window.location.reload();
            },'json')

        }
    </script>
@endsection
