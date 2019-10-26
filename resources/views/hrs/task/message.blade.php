@extends('hrs.layouts.app')  
@section('css')

<link href="{{asset('hrs/plugins/ladda-buttons/css/ladda-themeless.min.css')}}" rel="stylesheet" type="text/css" />
@endsection         
@section('content')
@if($list->count()>0)
<div class="row">
  <div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>留言内容</th>                        
                    <th>留言时间</th>
                                            
                    <th>回复</th>
                                           
                                         
                                            
                </tr>
            </thead>

            <tbody>
                @foreach($list as $v)
                <tr>
                    <td style="width: 60%">
                    {{$v->contents}}
                    </td>
                    <td>                                       
                       {{$v->created_at}}                                               
                    </td>
                    <td>
                    {{$v->reply==''?'无回复':$v->reply}}
                   
                    
                    </td>
                </tr>
                @endforeach
             </tbody>
           </table>
        </div>
    {{ $list->appends($where)->links() }}
  </div>
</div>
@endif
                

               <div class="row">
                   <div class="col-md-12">
                       <div class="card-box">
                           <div class="row">

                            <form class="form-horizontal" action="{{url('user/message/save')}}" role="form">                                    
                             
                                                                                                                     
                              <div class="form-group">
                                  <label class="col-md-2 control-label">留言：</label>
                                  <div class="col-md-10">
                  <textarea required="" class="form-control" rows="5" name="contents"></textarea>
                                  </div>
                              </div>

                              <button type="submit" class="btn btn-purple waves-effect waves-light">提交</button>
                              {{csrf_field()}}
                          </form>


                           </div>
                       </div>
                  </div>
               </div>            
                               

      





@endsection        


        
@section('js')
<script src="{{asset('hrs/plugins/ladda-buttons/js/spin.min.js')}}"></script>
<script src="{{asset('hrs/plugins/ladda-buttons/js/ladda.min.js')}}"></script>
<script src="{{asset('hrs/plugins/ladda-buttons/js/ladda.jquery.min.js')}}"></script>
 <script src="{{asset('hrs/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')}}" type="text/javascript"></script>

<script type="text/javascript">
 $(function() {
    $('#btnDispatch').click(function(e){
        e.preventDefault();
        var l = Ladda.create(this);
        l.start();
        $('#DispatchForm').submit();      
        return false;
    });

   
});

  

    

</script>


@endsection