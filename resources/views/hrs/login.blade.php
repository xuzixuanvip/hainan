<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
		<meta name="author" content="Coderthemes">

		<link rel="shortcut icon" href="assets/images/favicon_1.ico">

		<title>登录</title>

		<link href="{{asset('hrs/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('hrs/css/core.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('hrs/css/components.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('hrs/css/icons.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('hrs/css/pages.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('hrs/css/responsive.css')}}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

       

	</head>
	<body>

		<div class="account-pages"></div>
		<div class="clearfix"></div>
		
		<div class="wrapper-page">
			<div class="card-box">
				<div class="panel-heading">
					<h3 class="text-center"> 平台登录</h3>
				</div>

				<div class="panel-body">
					<div class="alert alert-danger" style="display: {{session('rs')?'block':'none'}}">
                                {{ array_get(session('rs'),'msg') }}
                    </div>
					<form class="form-horizontal m-t-20" action="{{url('logindo')}}" method="post">
						{{csrf_field()}}

						<div class="form-group m-t-10">
							<div class="col-xs-12">
                                <input type="text"  name="username" value="{{old('username')}}" class="form-control" placeholder="用户名" required="">
                            </div>
                        	
                        </div>

						<div class="form-group m-t-10">
							
							<div class="col-xs-12">
								<input class="form-control" type="password" required="" placeholder="密码" name="password" required="">
								
							</div>
						</div>

						

						<div class="form-group text-center m-t-40">
							<div class="text-center p-20">
								<button class="btn btn-default btn-block text-uppercase waves-effect waves-light" type="submit">
									登录
								</button>
							</div>
							
						</div>

						
						
						
						
						
					</form>

				</div>
			</div>
			

		</div>

	
		<!-- jQuery  -->
        <script src="{{asset('hrs/js/jquery.min.js')}}"></script>
        <script src="{{asset('hrs/js/bootstrap.min.js')}}"></script>
       

	</body>
</html>
<script type="text/javascript">
	// $('#sendmsg').on('click',function(){
       
        
 //        var mobile = $('input[name="mobile"]').val();
 //        var url = "{{url('sendmsg')}}?mobile="+mobile;
 //        $.get(url,function(rs){
 //            if(rs.status) {
 //                $('.alert').empty().show().removeClass('alert-danger').addClass('alert-success').append(rs.msg);

 //            } else {
 //                $('.alert').empty().show().removeClass('alert-success').addClass('alert-danger').append(rs.msg);    
 //            }
 //        });
 //    })
</script>