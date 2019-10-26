<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="assets/images/favicon_1.ico">

    <title>订单详情</title>

   

    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/css/core.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/css/components.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/css/icons.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/css/pages.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/css/responsive.css')}}" rel="stylesheet" type="text/css"/>





</head>


<body>

<!-- Begin page -->
<div id="wrapper">



<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
           
            @if(isset($rs))
                <div class="alert alert-{{$rs['status']}}">
                {{ $rs['msg'] }}
                </div>
            @endif

            <div class="row">
                
                <div class="panel panel-border panel-success">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">{{$data->code}}</h3>
                                    </div>
                                    <div class="panel-body">

                <table class="table">
                    <tbody>
                    <tr>                       
                        <td>编号</td>
                        <td>{{$data->code}}</td>
                    </tr>
                    <tr>    
                        <td>用户</td>
                        <td>{{object_get($data,'user.name')}}，电话 <a href="tel:{{object_get($data,'user.mobile')}}">{{object_get($data,'user.mobile')}}</a>
                       <p>
                                        {{object_get($data,'user.department')}}
                                   </p>
                        </td>
                    </tr>
                    <tr>    
                        <td>下单时间</td><td>{{$data->created_at}}</td>
                    </tr>
                    <tr>
                        <td>
                            商品
                        </td>
                        <td>
                            <table>
                                
                                @foreach($data->products as $p)
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
                        <td>订单金额：{{$data->total_price}}</td><td>{{$data->status_txt}}</td>   
                    </tr>
                    @if($data->remark)
                     <tr>    
                        <td>备注信息：</td>
                        <td><span class="label label-danger">{{$data->remark}}</span></td>   
                    </tr>
                    @endif
                    </tbody>
                </table>    
                </div>
                <a class="btn btn-primary" href="{{url('diancan/shop/orders')}}">
                    订单列表
                </a>
            </div>      
                  


               
            </div>

        </div>

    </div> <!-- end col -->


</div>
</div>
</body>
</html>















