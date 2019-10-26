@extends('hrs.layouts.app')  
@section('css')

<link data="{{asset('hrs/plugins/ladda-buttons/css/ladda-themeless.min.css')}}" rel="stylesheet" type="text/css" />
@endsection         
@section('content')

 @if(array_get(session('rs'),'msg'))
                    <div class="alert alert-{{session('rs')['status']}}">
                        <i class="md  md-bookmark-outline"></i> {!!session('rs')['msg']!!}
                    </div>
                    
                    @endif
<div class="row">
  <div class="col-sm-9" style="padding: 20px;">

                                            
    <p class="text-muted m-b-30 font-14">
      {!! $notice->contents !!}
    </p> 

                                            <div class="button-list">
                                               
                                                <button class="emerg btn btn-default btn-lg waves-effect waves-light" data-url="{{url('user/emergency/send-msg')}}?room=一楼">一楼</button>
                                               <button class="emerg btn btn-white btn-lg" data-url="{{url('user/emergency/send-msg')}}?room='二楼'">二楼</button>
                                                <button class="emerg btn btn-primary btn-lg" data-url="{{url('user/emergency/send-msg')}}?room=三楼">三楼</a>
                                                 <button class="emerg btn btn-success btn-lg" data-url="{{url('user/emergency/send-msg')}}?room=四楼">四楼</button>
                                                 <button class="emerg btn btn-info btn-lg" data-url="{{url('user/emergency/send-msg')}}?room=五楼">五楼</button> 

                                                 <button class="emerg btn btn-default btn-lg" data-url="{{url('user/emergency/send-msg')}}?room=六楼">六楼</button>
                                                 <button class="emerg btn btn-purple btn-lg" data-url="{{url('user/emergency/send-msg')}}?room=七楼">七楼</button>
                                            </div>
                                        </div>
  
  
</div>    


<!--退单模态框-->
<div class="modal fade" id="my-Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
          &times;
        </button>
        <h4 class="modal-title" id="myModalLabel">
          一键求助
        </h4>
      </div>
       <form id="form1" class="form-horizontal" role="form" action="" method="get">
      <div class="modal-body">
       
         <div class="form-group">
                  <label class="control-label">求输入求救码</label>
                 
                    <input class="form-control"  name="code" id="code"/>
                 
                </div> 
     
       
       {{csrf_field()}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭
        </button>
        <button type="button" class="btn btn-primary" id="btn-send">
          发送
        </button>
      </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal -->
</div>


@endsection        

@section('js')
<script type="text/javascript">
  $('.emerg').on('click',function(){
    $('#my-Modal').modal('show');
    var url = $(this).data('url')
    $('#form1').attr('action',url);

  });

  $('#btn-send').on('click',function(){
    var code = $('#code').val();
    if(code == "{{$system->warning_code}}") {
      $('#form1').submit();  
    } else {
      alert('求救码错误！');
    }
  });


</script>
@endsection
        
