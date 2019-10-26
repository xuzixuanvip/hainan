@extends('hrs.layouts.app')  
@section('css')
        <!-- Custombox css -->
        <link href="{{asset('hrs/plugins/custombox/css/custombox.css')}}" rel="stylesheet">
  
@endsection         
@section('content')

               

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-sm-8">
                                   <a href="{{url('info/notice')}}">公告列表</a>
                                </div>
                                
                            </div>
                  
                            <div class="table-responsive">
                               
                      <h2>{{$data->title}}</h2>
                      <p>
                          发布时间：{{$data->created_at}}
                      </p>
                      <p>{{$data->contents}}</p>
                    
                                        


                                        

                                
                            </div>
                          
                        </div>

                    </div> <!-- end col -->


                </div>

               

            </div> <!-- end container -->
@endsection        



