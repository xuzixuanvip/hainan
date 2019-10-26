@extends('hrs.layouts.app')  
@section('css')

<link href="{{asset('hrs/plugins/ladda-buttons/css/ladda-themeless.min.css')}}" rel="stylesheet" type="text/css" />
@endsection         
@section('content')
<div class="row">
  <div class="col-lg-9 col-md-8">
    <div class="card-box">
    <form method="post"  action="{{url('user/message/save')}}">
      <div class="row">
      <div class="col-md-12">      
                                <span class="input-icon icon-right">
                                    <textarea rows="2" class="form-control"
                                              placeholder="填写留言内容" name="contents" required=""></textarea>
                                </span>
      </div>
      <div class="col-md-12">                          
                                <div class="p-t-10 m-b-10 pull-right">
                                    <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light">提交</button>
                                </div>
      </div>                          
 {{csrf_field()}}
                            </form>
                       </div>     
<div class="card-box">
                                
                                
                                @foreach($list as $v)
                                <div class="comment">
                                    <img src="{{$v->avatar}}" alt="" class="comment-avatar">
                                    <div class="comment-body">
                                        <div class="comment-text">
                                            <div class="comment-header">
                                                <a href="#" title="">{{$v->nickname}}</a>
                                                <span>{{$v->created_at}}</span>
                                            </div>
                                            {{$v->contents}}

                                            
                                        </div>

                                        <div class="comment-footer">
                                            
                                           
                                            <a href="#" class="btn-reply
                                            ">回复</a>
                                          
                                        </div>
                                    </div>
                                    @foreach($v->subMessage as $sm)
                                    <div class="comment">
                                        <img src="{{$sm->avatar}}" alt="" class="comment-avatar">
                                        <div class="comment-body">
                                            <div class="comment-text">
                                                <div class="comment-header">
                                                    <a href="#" title="">{{$sm->nickname}}</a><span>{{$sm->created_at}}</span>
                                                </div>
                                                {{$sm->contents}}
                                            </div>
                                            <div class="comment-footer">
                                               
                                                <a href="#" class=" btn-reply
                                            ">回复</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach

                                <div class="m-t-30 text-center">
                                    {{ $list->appends($where)->links() }}
                                </div>
                            </div>
      </div>
</div> 

<!--回复模态框-->
<div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          &times;
        </button>
        <h4 class="modal-title" id="myModalLabel">
          回复留言
        </h4>
      </div>
       <form class="form-horizontal" role="form" action="{{url('user/message/save')}}" method="post">
      <div class="modal-body">
       
         <div class="form-group">
                  <label class="control-label">内容</label>
                 
                    <textarea class="form-control"  name="contents" id="contents"></textarea>
                 
                </div> 
     
       <input type="hidden" name="pid" value="" id="pid" />
       {{csrf_field()}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭
        </button>
        <button type="submit" class="btn btn-primary">
          提交
        </button>
      </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal -->
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

    $('.btn-reply').on('click',function(){
      var _this = $(this);
      $('#replyModal').modal('show');
      $('#pid').val(_this.data('pid'));
    });

   
});

  

    

</script>


@endsection