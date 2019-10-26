@extends('hrs.layouts.app')  
@section('css')
<!--Morris Chart CSS -->
  <link rel="stylesheet" href="{{asset('hrs/plugins/morris/morris.css')}}">
  
@endsection         
@section('content')
        
            <div class="container">

              


                <div class="row card-box">
                    <div class="col-xs-3">
                        <div class="widget-xs-color-icon  fadeInDown animated">
                            <div class="xs-icon xs-icon-info pull-left">
                                <i class="md md-attach-money text-info"></i>
                            </div>
                            <div class="text-right">
                            <p class="text-muted">待处理</p>
                                <h3 class="text-dark"><b class="counter">0</b></h3>
                                
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div class="col-xs-3">
                        <div class="widget-xs-color-icon">
                            <div class="xs-icon xs-icon-pink pull-left">
                                <i class="md md-add-shopping-cart text-pink"></i>
                            </div>
                            <div class="text-right">
                                
                                <p class="text-muted">处理中</p>
                                <h3 class="text-dark"><b class="counter">0</b></h3>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    

                    <div class="col-xs-3">
                        <div class="widget-xs-color-icon">
                            <div class="xs-icon xs-icon-success pull-left">
                                <i class="md md-remove-red-eye text-success"></i>
                            </div>
                            <div class="text-right">
                                
                                <p class="text-muted">已完结</p>
                                <h3 class="text-dark"><b class="counter">0</b></h3>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div class="col-xs-3">
                        <div class="widget-xs-color-icon">
                            <div class="xs-icon xs-icon-pink pull-left">
                                <i class="md md-add-shopping-cart text-pink"></i>
                            </div>
                            <div class="text-right">
                                
                                <p class="text-muted">总工单</p>
                                <h3 class="text-dark"><b class="counter">0</b></h3>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                   
                </div>

                <div class="row">

                    <div class="card-box">
                    <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            
                                            <th>标题</th>
                                            <th>状态</th>
                                           
                                         
                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($tasks as $v)
                                        <tr>
                                           

                                               
                                           

                                            <td>
                                                {{$v->title or ''}}
                                            </td>

                                           
                                            
                                           
                                            <td>                                       

                                                

                                               {{$v->status}}
                                                
                                            </td>
                                        </tr>
                                        @endforeach

                                        


                                        

                                    </tbody>
                                </table>
                            </div>
                            {{ $tasks->appends($param)->links() }}
                        </div>    


                </div>
                <!-- end row -->




                

            </div>
       
@endsection

@section('js')
<script src="{{asset('hrs/js/modernizr.min.js')}}"></script>
<script src="{{asset('hrs/plugins/peity/jquery.peity.min.js')}}"></script>

        <!-- jQuery  -->
        <script src="{{asset('hrs/plugins/waypoints/lib/jquery.waypoints.js')}}"></script>
        <script src="{{asset('hrs/plugins/counterup/jquery.counterup.min.js')}}"></script>

        <script src="{{asset('hrs/plugins/morris/morris.min.js')}}"></script>
        <script src="{{asset('hrs/plugins/raphael/raphael-min.js')}}"></script>

        <script src="{{asset('hrs/plugins/jquery-knob/jquery.knob.js')}}"></script>

        <script src="{{asset('hrs/pages/jquery.dashboard.js')}}"></script>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });

                $(".knob").knob();

            });
        </script>
@endsection

