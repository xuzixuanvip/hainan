@extends('hrs.layouts.app')  
@section('css')

<link href="{{asset('hrs/plugins/ladda-buttons/css/ladda-themeless.min.css')}}" rel="stylesheet" type="text/css" />
@endsection         
@section('content')

                

                <div class="row" style="padding: 5px;text-align: center;">
                  <div class="col-md-12 col-xs-12">
                  请大家放心提交您的投诉意见，您的上报记录我将会屏障，希望有您的意见能让东湖边的更美好！意见箱将不定期向领导反馈。
                </div>
                </div>

               <div class="row">
                   <div class="col-md-12">
                       <div class="card-box">
                        @if(array_get(session('rs'),'msg'))
                    <div class="alert alert-{{session('rs')['status']}}">
                        <i class="md  md-highlight-remove"></i> {{session('rs')['msg']}}
                    </div>
                    
                    @endif
                           <div class="row">

                            <form class="form-horizontal" action="{{url('user/yijian-save')}}" role="form" method="post">                                    
                             
                                                                                                                     
                              <div class="form-group">
                                  <label class="col-md-2 control-label">投诉建议：</label>
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


    

</script>


@endsection