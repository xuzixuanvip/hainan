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
                                            
                                            <th>微信名</th>
                                            <th>头像</th>
                                            <th>电话</th>
                                            <th>工种</th>
                                            <th>备注</th>
                                            
                                                                                      
                                         
                                            
                                        </tr>
                                    </thead>

            <tbody>
                @foreach($list as $v)
                <tr>
                    <td>{{$v->nickname}}</td>
                    <td><img src="{{$v->avatar}}" width="50"/></td>
                    <td>{{$v->mobile}}</td>
                    <td>{{$v->worktype->name or ''}}</td>
                    <td>{{$v->remark}}</td>
                    
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



