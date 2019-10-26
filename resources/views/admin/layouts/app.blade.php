<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title>管理后台</title>

        <link href="{{asset('admin/plugins/custombox/css/custombox.css')}}" rel="stylesheet">

        <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/css/core.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/css/components.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/css/icons.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/css/pages.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/css/responsive.css')}}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="{{asset('admin/js/modernizr.min.js')}}"></script>

        @yield('css')

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            @include('admin.layouts.top')


            <!-- ========== Left Sidebar Start ========== -->

            @include('admin.layouts.left')
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">



                         @yield('content')



                    </div> <!-- container -->

                </div> <!-- content -->

                <footer class="footer text-right">
                    © 2018. All rights reserved.
                </footer>

            </div>


        <!-- Modal -->
        @yield('modal')





        </div>
        <!-- END wrapper -->



        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="{{asset('admin/js/jquery.min.js')}}"></script>
        <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('admin/js/detect.js')}}"></script>
        <script src="{{asset('admin/js/fastclick.js')}}"></script>
        <script src="{{asset('admin/js/jquery.slimscroll.js')}}"></script>
        <script src="{{asset('admin/js/jquery.blockUI.js')}}"></script>
        <script src="{{asset('admin/js/waves.js')}}"></script>
        <script src="{{asset('admin/js/wow.min.js')}}"></script>
        <script src="{{asset('admin/js/jquery.nicescroll.js')}}"></script>
        <script src="{{asset('admin/js/jquery.scrollTo.min.js')}}"></script>



        <!-- Modal-Effect -->
        <script src="{{asset('admin/plugins/custombox/js/custombox.min.js')}}"></script>
        <script src="{{asset('admin/plugins/custombox/js/legacy.min.js')}}"></script>

          @yield('js')




         <script src="{{asset('admin/js/jquery.core.js')}}"></script>
        <script src="{{asset('admin/js/jquery.app.js')}}"></script>

              <script type="text/javascript" src="{{asset('admin/js/laravel.js')}}"></script>


    </body>
</html>