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
                                    <form role="form">
                                        <div class="form-group contact-search m-b-30">
                                            <input type="text" id="search" class="form-control" name="keyword" placeholder="请输入工单标题">
                                            <button type="submit" class="btn btn-white"><i class="fa fa-search"></i></button>
                                        </div> <!-- form-group -->
                                    </form>
                                </div>
                                
                            </div>
                    @if(array_get(session('rs'),'msg'))
                    <div class="alert alert-{{session('rs')['status']}}">
                        <i class="md  md-highlight-remove"></i> {{session('rs')['msg']}}
                    </div>
                    
                    @endif
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            
                                            <th>工单</th>
                                            
                                            <th>状态</th>
                                           
                                         
                                            
                                        </tr>
                                    </thead>

            <tbody>
                @foreach($list as $v)
                <tr>
                    <td style="width: 60%">
                    <a href="{{url('user/task/show',$v->id)}}">
                        {{object_get($v,'category.name')}} {{$v->customer_name}} ({{$v->mobile}})
                    </a>
                    </td>
                    <td>                                       
                        <span class="btn btn-{{$taskStatus[$v->status]['style']}}"> {{$taskStatus[$v->status]['txt']}}</span>
                                                
                    </td>
                    <td>
                    @if($v->status==1)
                    <a href="{{url('user/task/edit',$v->id)}}" class="btn btn-warning">修改</a>
                    @endif
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

        
@section('js')
  <!-- Modal-Effect -->
        <script src="{{asset('hrs/plugins/custombox/js/custombox.min.js')}}"></script>
        <script src="{{asset('hrs/plugins/custombox/js/legacy.min.js')}}"></script>

       
@endsection

