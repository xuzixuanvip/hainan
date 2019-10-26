<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title>{{env('APP_NAME')}}</title>

        <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/css/core.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/css/components.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/css/icons.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/css/pages.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/css/responsive.css')}}" rel="stylesheet" type="text/css" />

        
        
    </head>
    <body>

        <div class="account-pages"></div>
        <div class="clearfix"></div>
        <div class="wrapper-page">
        	<div class=" card-box">
            <div class="panel-heading"> 
                <h3 class="text-center">  <strong class="text-custom">系统登陆</strong> </h3>
            </div> 

    @if(session('rs'))
    <div class="alert alert-danger">
    {{ session('rs') }}
    </div>
    @endif
            <div class="panel-body">
            <form class="form-horizontal m-t-20" method="post" action="{{url('zadmin/logindo')}}">
                
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" required="" name="username" placeholder="Username">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" required="" placeholder="Password" name="password">
                    </div>
                </div>

                
                
                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">登录</button>
                    </div>
                </div>

                

                {{csrf_field()}}
            </form> 
            
            </div>   
            </div>                              
                
            
        </div>
        
        

        
    	

        <!-- jQuery  -->
        <script src="{{asset('admin/js/jquery.min.js')}}"></script>
        <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
      
	
	</body>
</html>