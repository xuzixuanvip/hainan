<!-- ========== Left Sidebar Start ========== -->

<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Divider -->
        <div id="sidebar-menu">
            <ul>


                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="ti-home"></i> <span> 首台首页 </span> <span
                                class="menu-arrow"></span></a>
                    <ul class="list-unstyled">

                        <li><a href="{{url('diancan/shop/')}}">控制台</a></li>

                        <li><a href="{{url('diancan/shop/logout')}}">退出</a></li>
                    </ul>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i
                                class="ti-light-bulb"></i><span> 餐厅管理 </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{url('diancan/shop/home')}}" class="waves-effect"> <span> 餐厅信息 </span></a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i
                                class="ti-user"></i><span> 用户管理 </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{url('diancan/shop/users')}}" class="waves-effect"> <span> 用户管理 </span></a></li>
                        <li><a href="{{url('diancan/shop/users/create')}}" class="waves-effect"> <span> 添加用户 </span></a></li>

                    </ul>
                </li>

                
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i
                                class="ti-receipt"></i><span> 订单管理 </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{url('diancan/shop/orders')}}" class="waves-effect"> <span> 订单信息 </span></a></li>

                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i
                                class="ti-cup"></i><span> 菜品管理 </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{url('diancan/shop/products')}}" class="waves-effect"> <span> 菜品信息 </span></a></li>
                        <li><a href="{{url('diancan/shop/products/create')}}" class="waves-effect"> <span> 添加菜品 </span></a></li>
                        <li><a href="{{url('diancan/shop/cates')}}" class="waves-effect"> <span> 菜品分类 </span></a></li>
                        <li><a href="{{url('diancan/shop/cates/create')}}" class="waves-effect"> <span> 添加分类 </span></a></li>

                    </ul>
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Left Sidebar End -->
