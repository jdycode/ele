<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                @auth
                    <p>{{\Illuminate\Support\Facades\Auth::guard()->user()->name}} </p>
                @endauth
               {{--<p>管理员</p>--}}
                <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="搜索">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">List-info</li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>商家管理</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    {{--<li class="active"><a href="#"><i class="fa fa-circle-o"></i>商家分类</a>--}}
                    {{--</li>--}}
                    {{--<li><a href="#"><i class="fa fa-circle-o"></i> 信息管理</a>--}}
                    {{--</li>--}}
                    <li><a href="{{route('user.index')}}"><i class="fa fa-circle-o"></i> 商家帐号管理</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>菜品管理</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('menu_cate.index')}}"><i class="fa fa-circle-o"></i> 菜品分类</a></li>
                    <li><a href="{{route('menu.index')}}"><i class="fa fa-circle-o"></i> 菜品信息</a></li>
                    {{--<li><a href="pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>--}}
                    {{--<li><a href="pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>--}}
                </ul>
            </li>
            {{--<li class="treeview">--}}
                {{--<a href="#">--}}
                    {{--<i class="fa fa-files-o"></i>--}}
                    {{--<span>Layout Options</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<span class="label label-primary pull-right">4</span>--}}
            {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>--}}
                    {{--<li><a href="pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>--}}
                    {{--<li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>--}}
                    {{--<li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="pages/widgets.html">--}}
                    {{--<i class="fa fa-th"></i> <span>Widgets</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<small class="label pull-right bg-green">new</small>--}}
            {{--</span>--}}
                {{--</a>--}}
            {{--</li>--}}

            {{--<li class="treeview">--}}
                {{--<a href="#">--}}
                    {{--<i class="fa fa-laptop"></i>--}}
                    {{--<span>平台管理员管理</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>--}}
                    {{--<li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>--}}
                    {{--<li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>--}}
                    {{--<li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>--}}
                    {{--<li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>--}}
                    {{--<li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>店铺数据管理</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('order.index')}}"><i class="fa fa-circle-o"></i>订单管理</a></li>
                    <li><a href="{{route('order.day')}}"><i class="fa fa-circle-o"></i>每日统计</a></li>
                    <li><a href="{{route('order.month')}}"><i class="fa fa-circle-o"></i>每月统计</a></li>
                </ul>
            </li>
            {{--<li class="treeview">--}}
                {{--<a href="#">--}}
                    {{--<i class="fa fa-table"></i> <span>Tables</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>--}}
                    {{--<li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="pages/calendar.html">--}}
                    {{--<i class="fa fa-calendar"></i> <span>Calendar</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<small class="label pull-right bg-red">3</small>--}}
              {{--<small class="label pull-right bg-blue">17</small>--}}
            {{--</span>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="pages/mailbox/mailbox.html">--}}
                    {{--<i class="fa fa-envelope"></i> <span>Mailbox</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<small class="label pull-right bg-yellow">12</small>--}}
              {{--<small class="label pull-right bg-green">16</small>--}}
              {{--<small class="label pull-right bg-red">5</small>--}}
            {{--</span>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="treeview">--}}
                {{--<a href="#">--}}
                    {{--<i class="fa fa-folder"></i> <span>活动信息</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href=""><i class="fa fa-circle-o"></i>商家活动</a></li>--}}
                    {{--<li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>--}}
                    {{--<li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>--}}
                    {{--<li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>--}}
                    {{--<li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>--}}
                    {{--<li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>--}}
                    {{--<li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>--}}
                    {{--<li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>--}}
                    {{--<li><a href="pages/examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-share"></i> <span>活动信息</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('activity.show')}}"><i class="fa fa-circle-o"></i> 商家活动</a></li>
                    <li><a href="{{route('event.list')}}"><i class="fa fa-circle-o"></i> 抽奖活动</a></li>
                    {{--<li class="treeview">--}}
                        {{--<a href="#"><i class="fa fa-circle-o"></i> Level One--}}
                            {{--<span class="pull-right-container">--}}
                  {{--<i class="fa fa-angle-left pull-right"></i>--}}
                {{--</span>--}}
                        {{--</a>--}}
                        {{--<ul class="treeview-menu">--}}
                            {{--<li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>--}}
                            {{--<li class="treeview">--}}
                                {{--<a href="#"><i class="fa fa-circle-o"></i> Level Two--}}
                                    {{--<span class="pull-right-container">--}}
                      {{--<i class="fa fa-angle-left pull-right"></i>--}}
                    {{--</span>--}}
                                {{--</a>--}}
                                {{--<ul class="treeview-menu">--}}
                                    {{--<li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>--}}
                                    {{--<li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</li>--}}
                    {{--<li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>--}}
                </ul>
            </li>
            <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>关于我们</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>帮助</span></a></li>
            {{--<li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>--}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>