@extends('admin.layouts.app')
@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">疾病管理</h4>
            <ol class="breadcrumb">
                <li><a href="{{url('zadmin/')}}">系统</a></li>
                <li><a href="{{url('zadmin/symptom')}}">疾病列表</a></li>
                <li class="active">修改疾病</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h2 class="m-t-0 header-title">修改疾病</h2>
                <hr/>
                @if(session('rs'))
                    <div class="alert alert-{{session('rs')['status']}}">
                        {{ session('rs')['msg'] }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-horizontal" role="form" action="{{url('zadmin/disease/'.$data->id)}}" method="post" enctype="multipart/form-data">{{ method_field('PUT') }}
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">疾病名称</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="name" required="" value="{{$data->name}}">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">性别</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="sex">
                                        <option value="1" {{$data->sex == 1?'selected':''}} >男</option>
                                        <option value="2" {{$data->sex == 2?'selected':''}} >女</option>
                                        <option value="0" {{$data->sex == 3?'selected':''}} >不限</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">推荐科室</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="department_id">
                                        @foreach($department as $v)
                                            <option value="{{ $v->id }}" {{ $department_id[0] == $v->id ? 'selected' : '' }} >{{ $v->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">伴随症状</label>
                                <div class="col-md-9">
                                    <textarea type="text" class="form-control" name="concomitant"  value="">{{ old('concomitant',$data->concomitant) }}</textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">临床表现</label>
                                <div class="col-md-9">
                                    <textarea type="text" class="form-control" name="clinical"  value="">{{ old('clinical',$data->clinical) }}</textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">疾病原因</label>
                                <div class="col-md-9">
                                    <textarea type="text" class="form-control" name="cause"  value="">{{ old('cause',$data->cause) }}</textarea>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-md-3 control-label">疾病治疗</label>
                                <div class="col-md-9">
                                    <textarea type="text" class="form-control" name="treatment"  value="">{{ old('treatment',$data->treatment) }}</textarea>
                                </div>
                            </div>
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


