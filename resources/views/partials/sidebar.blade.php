@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

             

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('lfems.lf_dashboard')</span>
                </a>
            </li>

            
            @can('employee_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cubes"></i>
                    <span class="title">@lang('lfems.employee-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                
                @can('attandance_access')
                <li class="{{ $request->segment(2) == 'attandances' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.attandances.index') }}">
                            <i class="fa fa-adn"></i>
                            <span class="title">
                                @lang('lfems.attandance.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('department_access')
                <li class="{{ $request->segment(2) == 'departments' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.departments.index') }}">
                            <i class="fa fa-gears"></i>
                            <span class="title">
                                @lang('lfems.departments.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('salery_access')
                <li class="{{ $request->segment(2) == 'saleries' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.saleries.index') }}">
                            <i class="fa fa-money"></i>
                            <span class="title">
                                @lang('lfems.salery.title')
                            </span>
                        </a>
                    </li>
                @endcan
                    @can('notice_access')
                    <li class=" ">
                        <a href="{{ route('admin.notices.index') }}">
                            <i class="fa fa-bell"></i>
                            <span class="title">
                                Notices
                            </span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('project_management_access')
            <li class="{{ $request->segment(2) == 'project_managements' ? 'active' : '' }}">
                <a href="{{ route('admin.project_managements.index') }}">
                    <i class="fa fa-copy"></i>
                    <span class="title">@lang('lfems.project-management.title')</span>
                </a>
            </li>
            @endcan

            @can('roles_and_user_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('lfems.roles-and-users.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-user-secret"></i>
                            <span class="title">
                                @lang('lfems.roles.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('user_access')
                <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('lfems.users.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan

        </ul>
    </section>
</aside>

