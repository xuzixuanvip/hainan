@extends('admin.layouts.app')
@include('vendor.ueditor.assets')
@section('content')


    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">公告管理</h4>
            <ol class="breadcrumb">
                <li><a href="{{url('zadmin/')}}">系统</a></li>
                <li><a href="{{ route('content.index') }}">公告列表</a></li>
                <li class="active">修改公告</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h2 class="m-t-0 header-title">修改公告</h2>
                <hr/>
                @if(session('rs'))
                    <div class="alert alert-{{session('rs')['status']}}">
                        {{ session('rs')['msg'] }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal" role="form" action="{{ route('content.update',$content->id) }}" method="post" enctype="multipart/form-data">
{{--                            <div class="form-group col-md-6">--}}
{{--                                <label class="col-md-3 control-label">公告内容</label>--}}
{{--                                <div class="col-md-9">--}}
{{--                                    <textarea name="content" id="" cols="150" rows="10">{{ $content->content }}</textarea>--}}
{{--                                </div>--}}
{{--                            </div>--}}




                            <script type="text/javascript">
                                var ue = UE.getEditor('container');
                                ue.ready(function() {
                                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                                });
                            </script>
                            <!-- 编辑器容器 -->
                            <script id="container" name="content" type="text/plain">{!!  $content->content  !!}</script>
{{--                            <input name="id" value="{{ $content->id }}" type="hidden">--}}




                            {{csrf_field()}}
                            <div class="form-group text-center col-md-12">
                                <button type="submit" class="btn btn-info waves-effect waves-light">保存</button>
                            </div>
                        </form>

                    </div>

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
        <h4 class="custom-modal-title">账户充值</h4>
        <div class="custom-modal-text text-left">
            <form role="form" method="post" action="{{url('zadmin/seller/add-money')}}">

                <div class="form-group">
                    <label for="position">卖家</label>
                    <input type="text" class="form-control" id="seller_name" disabled="" />
                </div>
                <div class="form-group">
                    <label for="name">充值金额</label>
                    <input type="number" class="form-control" name="money" placeholder="">
                </div>



                <div class="form-group">
                    <label for="position">备注信息</label>
                    <textarea class="form-control" name="remark" ></textarea>
                </div>


                <button type="submit" class="btn btn-default waves-effect waves-light">保存</button>
                <button type="button" class="btn btn-danger waves-effect waves-light m-l-10" onclick="Custombox.close();">取消</button>

                <input type="hidden" name="seller_id" />
                {{csrf_field()}}
            </form>
        </div>
    </div>
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

