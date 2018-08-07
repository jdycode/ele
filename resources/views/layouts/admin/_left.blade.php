<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar admin panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                      @auth('admin')
                    <p>{{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name}}</p>
                    @endauth
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
            <li class="header">MAIN NAVIGATION</li>
            @foreach(\App\Models\Nav::where('pid',0)->get() as $nav)
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>{{$nav->name}}</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    @foreach(\App\Models\Nav::where('pid',$nav->id)->get() as $n)
                    <li><a href="{{route($n->url)}}"><i class="fa fa-circle-o"></i>{{$n->name}}</a></li>
                    @endforeach
                </ul>
            </li>
            @endforeach

            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>关于我们</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>帮助</span></a></li>
            {{--<li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>--}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>