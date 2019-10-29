


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>



                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-home"></i> <span> 首台首页 </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">

                                    <li><a href="{{url('zadmin/')}}">控制台</a></li>

                                    <li><a href="{{url('zadmin/logout')}}">退出</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-paint-bucket"></i> <span> 工单管理 </span> <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                    <!-- <li><a href="{{url('zadmin/task/add')}}">添加任务</a></li> -->
                                    <li><a href="{{url('zadmin/task')}}?status=1">待处理工单</a></li>
                                    <li><a href="{{url('zadmin/task')}}?status=50">处理中</a></li>
                                    <li><a href="{{url('zadmin/task')}}?status=100">已完工</a></li>

                                    <li><a href="{{url('zadmin/task')}}">所有报修单</a></li>
                                    <li><a href="{{url('zadmin/census/worker-count')}}">统计报表</a></li>




                                </ul>
                            </li>
                             @if(session('admin')->role_id == 999)
                            <li class="has_sub">
                               <a href="javascript:void(0);" class="waves-effect"><i class="ti-light-bulb"></i><span> 用户管理 </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">

                         <li><a href="{{url('zadmin/wechat/wxuser')}}" class="waves-effect"> <span> 微信用户 </span></a></li>
                         <li><a href="{{url('zadmin/users')}}" class="waves-effect"> <span> 用户管理 </span></a> </li>
                         <li><a href="{{url('zadmin/emergency')}}" class="waves-effect"><span>应急支援</span></a></li>

                                </ul>
                            </li>
                            @endif

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-pencil-alt"></i><span> 库存管理 </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">

                                    <li><a href="{{url('zadmin/goods')}}">配件信息</a></li>
                                    <li><a href="{{url('zadmin/purchases')}}">采购单</a></li>


                                    <li><a href="{{url('zadmin/outstock')}}">出库单</a></li>

                                    <li><a href="{{url('zadmin/goodslogs')}}">出库记录</a></li>

                                <li>
                                    <a href="{{url('zadmin/goodscates')}}">配件分类
                                    </a>
                                </li>


                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-pencil-alt"></i><span> 服務信息 </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                   <!--  <li><a href="{{url('zadmin/admins')}}">管理员</a></li> -->
                                    <li><a href="{{url('zadmin/notice')}}">公告管理</a></li>
                                     <li><a href="{{url('zadmin/worktype')}}">工种管理</a></li>
                                    <li><a href="{{url('zadmin/category')}}">报修类型</a></li>
                                    <li><a href="{{url('zadmin/depart')}}">部门管理</a></li>
                                     <li><a href="{{url('zadmin/services')}}">维修内容</a></li>
                                   <!--  <li><a href="{{url('zadmin/worklog')}}">服務日誌</a></li>-->



                                </ul>
                            </li>


                             @if(session('admin')->role_id == 999)
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-pencil-alt"></i><span> 系统设置 </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                   <li><a href="{{url('zadmin/system')}}">全局配置</a></li>
                                    <li><a href="{{url('zadmin/roles')}}">角色管理</a></li>

                                    <li><a href="{{url('zadmin/wechat/menu')}}" target="_blank">菜单更新</a></li>
                                    <li><a href="{{url('zadmin/wechat/msgtpl')}}">微信消息模板</a></li>

                                </ul>
                            </li>

                            @endif


                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-money"></i><span> 收费信息 </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="{{url('zadmin/fee')}}">收费记录</a>
                                    </li>
                                     <li>
                                        <a href="{{url('zadmin/fee/create')}}">新增收费</a>
                                    </li>
                                    <li>
                                        <a href="{{url('zadmin/yezhu')}}">业主信息</a>
                                    </li>
                                    <li>
                                        <a href="{{url('zadmin/feetype')}}">费用类型</a>
                                    </li>

                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-pencil-alt"></i><span> 留言/意见 </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">

                                    <li><a href="{{url('zadmin/message')}}">留言列表</a></li>
                                    <li><a href="{{url('zadmin/yijian')}}">意见列表</a></li>


                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-money"></i><span> 食堂管理 </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="{{url('zadmin/diancan/shops')}}">商户</a>
                                    </li>
                                    <li>
                                        <a href="{{url('zadmin/diancan/notice')}}">公告</a>
                                    </li>
                    <li>
                        <a href="{{url('zadmin/diancan/products')}}">菜品</a>
                    </li>
                    <li>
                        <a href="{{url('zadmin/diancan/cates')}}">菜品分类</a>
                    </li>
                                     <li>
                                        <a href="{{url('zadmin/diancan/users')}}">职工</a>
                                    </li>
                                    <li>
                                        <a href="{{url('zadmin/diancan/orders')}}">订单</a>
                                    </li>

                                    <li>
                                        <a href="{{url('zadmin/diancan/types')}}">时间段管理</a>
                                    </li>


                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-pencil-alt"></i><span>智能导诊</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">

                                    <li
                                    ><a href="{{url('zadmin/symptom')}}">症状管理</a></li>
                                    <li><a href="{{url('zadmin/disease')}}">疾病管理</a></li>
                                    <li><a href="{{url('zadmin/body')}}">身体管理</a></li>
                                    <li><a href="{{url('zadmin/tags')}}">条件管理</a></li>
                                    <li><a href="2">科室管理</a></li>


                                </ul>
                            </li>



                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End -->
