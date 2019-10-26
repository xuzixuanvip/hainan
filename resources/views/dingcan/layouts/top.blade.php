<!-- Top Bar Start -->
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <a href="index.html" class="logo"><i class="icon-magnet icon-c-logo"></i><span>商户后台</span></a>
            <!-- Image Logo here -->
            <!--<a href="index.html" class="logo">-->
            <!--<i class="icon-c-logo"> <img src="assets/images/logo_sm.png" height="42"/> </i>-->
            <!--<span><img src="assets/images/logo_light.png" height="20"/></span>-->
            <!--</a>-->
        </div>
    </div>

    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="">
                <div class="pull-left">
                    <button class="button-menu-mobile open-left waves-effect waves-light">
                        <i class="md md-menu"></i>
                    </button>
                    <span class="clearfix"></span>
                </div>


                <form role="search" class="navbar-left app-search pull-left hidden-xs">
                    <input type="text" placeholder="Search..." class="form-control">
                    <a href=""><i class="fa fa-search"></i></a>
                </form>


                <ul class="nav navbar-nav navbar-right pull-right">
                    <li class="dropdown top-menu-item-xs">

                        <ul class="dropdown-menu dropdown-menu-lg">

                            <li class="list-group slimscroll-noti notification-list">
                                <!-- list item-->


                                <!-- list item-->
                                <a href="{{url('zadmin/task?status=1')}}" class="list-group-item">
                                    <div class="media">
                                        <div class="pull-left p-r-10">
                                            <em class="fa fa-bell-o  noti-warning"></em>
                                        </div>

                                    </div>
                                </a>


                            </li>

                        </ul>
                    </li>
                    <li class="hidden-xs">
                        <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i
                                    class="icon-size-fullscreen"></i></a>
                    </li>


                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>
            