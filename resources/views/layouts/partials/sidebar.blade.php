<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
    @endif

    <!-- Sidebar Menu -->
        <ul class="sidebar-menu">

            <li class="{{ active('profile') }}">
                <a href="{{ url('profile') }}"><i class="fa fa-user"></i><span>{{ t('profile.profile') }}</span></a>
            </li>

            @can('system.view')
                <li class="{{ active('home') }}">
                    <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i><span>{{ t('navbar.dashboard') }}</span></a>
                </li>
                @foreach( get_data_tables() as $table )
                    <li class="{{ active( normalize_data_table( $table)) }}">
                        <a href="{{ url( normalize_data_table($table) ) }}">
                            <span>{{ normalize_data_table( $table) }} </span>
                        </a>
                    </li>
                @endforeach
            @endcan


            @can('users.view')
                <li class="header">{{ t('navbar.system') }}</li>
                <li class="treeview {{ active(['users*','permissions','roles*']) }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="fa fa-users"></i> <span>{{ t('navbar.users.users') }}</span>
                        <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li class="{{ active('users/create') }}">
                            <a href="{{ route('users.create') }}">
                                <i class="fa fa-user-plus"></i> {{ t('navbar.users.create') }} </a></li>
                        <li class="{{ active('users') }}">
                            <a href="{{ route('users.index') }}">
                                <i class="fa fa-group"></i> {{ t('navbar.users.index') }} </a>
                        </li>
                        <li class="{{ active('roles') }}">
                            <a href="{{ route('roles.index') }}">
                                <i class="fa fa-legal"></i>{{ t('navbar.roles') }}</a>
                        </li>
                        <li class="{{ active('permissions') }}">
                            <a href="{{ route('permissions.index') }}">
                                <i class="fa fa-user-secret"></i>{{ t('navbar.permissions') }}
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan

            {{--@can('system.view')--}}
            {{--<li class="treeview {{ active(['settings*']) }}">--}}
            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">--}}
            {{--<i class="fa fa-gears"></i> <span>{{ t('navbar.system') }}</span>--}}
            {{--<i class="fa fa-angle-left pull-right"></i></a>--}}
            {{--<ul class="treeview-menu">--}}
            {{--<li class="{{ active('settings*') }}">--}}
            {{--<a href="{{ route('settings.index') }}"><i class="fa fa-circle-o"></i>{{ t('navbar.settings') }}--}}
            {{--</a></li>--}}

            {{--</ul>--}}
            {{--</li>--}}
            {{--@endcan--}}

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
