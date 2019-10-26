@extends('dingcan.layouts.app')
@section('content')



<div class="row">
    <div class="col-lg-12">
        <div class="row">
                            <div class="col-md-4 col-sm-4 col-lg-3">
                                <div class="card-box widget-box-1 bg-white">
                                    <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                                    <h4 class="text-dark">今日送餐</h4>
                                    <h2 class="text-primary text-center"><span data-plugin="counterup">{{$data['today_num']}} 件</span></h2>
                                    <p class="text-muted">今日收入: ￥{{$data['today_money']}} </p>
                                </div>
                            </div>

                           

                            <div class="col-md-3 col-sm-3 col-lg-3">
                                <div class="card-box widget-box-1 bg-white">
                                    <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                                    <h4 class="text-dark">本月送餐</h4>
                                    <h2 class="text-success text-center"><span data-plugin="counterup">{{$data['month_num']}} 件</span></h2>
                                    <p class="text-muted">本月收入: ￥{{$data['month_money']}} </p>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-3 col-lg-3">
                                <div class="card-box widget-box-1 bg-white">
                                    <i class="fa fa-info-circle text-muted pull-right inform" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Last 24 Hours"></i>
                                    <h4 class="text-dark">订单总量</h4>
                                    <h2 class="text-warning text-center"><span data-plugin="counterup">{{$data['all_num']}} 件</span></h2>
                                    <p class="text-muted">总收入: ￥{{$data['all_money']}} </p>
                                </div>
                            </div>

                        </div>
        <div class="card-box">
            
            <div class="row">
                
                <div class="col-sm-2">


                     <a href="{{url('diancan/shop/orders')}}" class="btn btn-primary btn-md waves-effect waves-light m-b-30" ><i class="md md-add"></i>刷新</a>

                     <a href="{{url('diancan/shop/orders?status=1')}}" class="btn btn-danger btn-md waves-effect waves-light m-b-30" ><i class="md md-add"></i>未送达订单</a>

                </div>

            </div>

            @if(session('rs'))
            <div class="alert alert-{{session('rs')['status']}}">
                {{ session('rs')['msg'] }}
            </div>
            @endif

            <div class="row">
                @foreach($list as $v)
                <div class="panel panel-border panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
            {{date('Ymd')}}→【<span class="btn btn-sm btn-danger"> {{$v->serial_num}}</span>】份</h3>
                                    </div>
                                    <div class="panel-body">

                <table class="table">
                    <tbody>
                    <tr>                       
                        <td>编号</td>
                        <td>{{$v->code}}</td>
                    </tr>
                    <tr>    
                        <td>用户</td>
                        <td>{{object_get($v,'user.name')}}，电话 <a href="tel:{{object_get($v,'user.mobile')}}">{{object_get($v,'user.mobile')}}</a>
                       <p>
                                        {{object_get($v,'user.department')}}
                                   </p>
                        </td>
                    </tr>
                    
                    <tr>    
                        <td>下单时间</td><td>{{$v->created_at}}</td>
                    </tr>
                    <tr>
                        <td>
                            商品
                        </td>
                        <td>
                            <table>
                                
                                @foreach($v->products as $p)
                                <tr>
                                    <td width="100">{{$p->name}}</td>
                                    <td>X{{$p->product_num}}</td>
                                    <td style="padding: 10px;">{{$p->subtotal}}
                                    </td>
                                <tr>
                                
                                @endforeach
                                
                            </table>
                        </td>
                    </tr>
                    <tr>    
                        <td>订单金额：{{$v->total_price}}</td><td>
                            <span class="btn btn-{{$v->status_css}}"> {{$v->status_txt}}</span></td>   
                    </tr>
                    @if($v->remark)
                     <tr>    
                        <td>备注信息：</td>
                        <td><span class="label label-danger">{{$v->remark}}</span></td>   
                    </tr>
                    @endif
<!--
                    <tr>
                        
                        <td colspan="2">
<form action="{{url('diancan/shop/match-face')}}" enctype="multipart/form-data" method="post">
                            刷脸吃饭：<input type="file" accept="image/*" class="form-control" capture="camera" name="pic"> 
                         <input type="hidden" name="user_id" value="{{$v->user_id}}" />
                         <input type="hidden" name="order_id" value="{{$v->id}}"/>
                         <button type="submit" class="btn btn-primary">人脸比对</button>
                         {{csrf_field()}}
                        </form></td>
                        
                       
                    </tr>
                -->
                    </tbody>
                </table>    
                </div>
            </div>      
                    @endforeach


                    </tbody>
                </table>
            </div>
{{$list->links()}}
        </div>

    </div> <!-- end col -->


</div>
@endsection






@section('modal')




@endsection









