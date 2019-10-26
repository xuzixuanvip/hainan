<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        

        <title>{{config('app.name')}}</title>

       

        <link href="{{asset('hrs/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('hrs/css/core.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('hrs/css/components.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('hrs/css/icons.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('hrs/css/pages.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('hrs/css/menu.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('hrs/css/responsive.css')}}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        @yield('css')
        

    </head>


    <body>

@include('hrs.layouts.topnav')
        

        
        @yield('content')
      
      


        <!-- jQuery  -->
        <script src="{{asset('hrs/js/jquery.min.js')}}"></script>
        <script src="{{asset('hrs/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('hrs/js/detect.js')}}"></script>
        <script src="{{asset('hrs/js/fastclick.js')}}"></script>

        <script src="{{asset('hrs/js/jquery.slimscroll.js')}}"></script>
        <script src="{{asset('hrs/js/jquery.blockUI.js')}}"></script>
        <script src="{{asset('hrs/js/waves.js')}}"></script>
        <script src="{{asset('hrs/js/wow.min.js')}}"></script>
        <script src="{{asset('hrs/js/jquery.nicescroll.js')}}"></script>
        <script src="{{asset('hrs/js/jquery.scrollTo.min.js')}}"></script>

       
        <script src="{{asset('hrs/js/jquery.core.js')}}"></script>
        <script src="{{asset('hrs/js/jquery.app.js')}}"></script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>

        @yield('js')
        

@include('hrs.layouts.footer')
    </body>
</html>