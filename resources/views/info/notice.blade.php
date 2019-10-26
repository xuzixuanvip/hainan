@extends('hrs.layouts.app')  
@section('css')
        <!-- Custombox css -->
        <link href="{{asset('hrs/plugins/custombox/css/custombox.css')}}" rel="stylesheet">
  
@endsection         
@section('content')

               

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            
                   
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            
                                            <th>公告</th>
                                            
                                                                                      
                                         
                                            
                                        </tr>
                                    </thead>

            <tbody>
                @foreach($list as $v)
                <tr>
                    <td style="width: 60%">
                    <a href="{{url('info/notice-show',$v->id)}}">
                      {{$v->title}}
                    </a>
                    </td>
                    
                </tr>
                @endforeach

                                        


                                        

                                    </tbody>

                                        


                                        

                                    </tbody>
                                </table>
                            </div>
                            {{ $list->appends($param)->links() }}
                        </div>

                    </div> <!-- end col -->


                </div>

               

            </div> <!-- end container -->
@endsection        



