<aside class="main-sidebar">
    <section class="sidebar">


        <ul class="sidebar-menu" data-widget="tree">
            {{-- <div class="user-panel">
                <div class="info" style="color: white; font-weight: bold; padding: 10px;">
                    <p style="margin: 0; font-size: 16px;">{{ Auth::user()->name }}</p>
                    <a href="#" style="color: white; font-size: 14px;">
                        <i class="fa fa-circle text-success"></i> Online
                    </a>
                </div>
            </div> --}}

            <li class="header" style="color: #ccc; text-transform: uppercase;">Main Navigation</li>

            <li>
                <a href="{{ url('/') }}">
                    <i class="fa fa-dashboard"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-tasks"></i>
                    <span class="title">Tasks Manage</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('tasks.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">Tasks</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i>
                    <span class="title">Logout</span>
                </a>
            </li>
        </ul>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </section>
</aside>
