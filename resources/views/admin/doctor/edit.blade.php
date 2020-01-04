@extends('admin.layouts.app')
@section('content')
    <style>
        .form-group::-webkit-scrollbar {
            display: none;
        }
    </style>
    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">医生管理</h4>
            <ol class="breadcrumb">
                <li><a href="{{url('zadmin/')}}">系统</a></li>
                <li><a href="{{url('zadmin/doctor')}}">医生列表</a></li>
                <li class="active">修改医生</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h2 class="m-t-0 header-title">修改医生</h2>
                <hr/>
                @if(session('rs'))
                    <div class="alert alert-{{session('rs')['status']}}">
                        {{ session('rs')['msg'] }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal" role="form" action="{{ route('doctor.update',$doctor->id) }}" method="post" enctype="multipart/form-data">{{ method_field('PUT') }}
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">大夫姓名</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="name" required="" value="{{$doctor->name}}">
                                </div>
                            </div>


                            <div class="form-group col-md-6" style="height: 84px;width: 789px;overflow:scroll">
                                <label class="col-md-3 control-label">推荐科室</label>
                                <div class="col-md-9" style="">
                                        @foreach($department as $v)
                                            <label><input type="checkbox" name="department[]" {{ in_array($v->id,$department_id)  ? 'checked' : '' }} style="flaot:left;margin:4px" value="{{$v->id}}">{{ $v->name }}</label>
                                        @endforeach
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">职位</label>
                                <div class="col-md-9">
                                    <textarea type="text" class="form-control" name="title"  value="{{ old('title') }}">{{ old('title',$doctor->title) }}</textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">医生简介</label>
                                <div class="col-md-9">
                                    <textarea type="text"  class="form-control" name="content"  value="{{ old('content') }}">{{ old('content', $doctor->content) }}</textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">专业特长</label>
                                <div class="col-md-9">
                                    <textarea type="text" value="{{ old('remark', $doctor->remark) }}" class="form-control" name="remark" >{{ old('content', $doctor->remark) }}</textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-7">
                                <label class="col-md-2 control-label">头像</label>
                                <div class="col-md-9">
                                    <input type="file"  name="img" class="file" >
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <img style="width: 100px" src="{{ url('/').$doctor->image }}" alt="">
                            </div>
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
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
            <form role="form" method="post" action="{{url('zadmin/disease/add-money')}}">

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


