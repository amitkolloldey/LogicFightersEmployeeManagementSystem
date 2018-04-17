@inject('request', 'Illuminate\Http\Request')
<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/admin/home') }}" class="logo"
       style="font-size: 16px;">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
           @lang('lfems.lfems_title')</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
           @lang('lfems.lfems_title')</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">{{$notice_count}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Latest Notices</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                @foreach($notices as $notice)
                                <li>
                                    <a href="{{url('/admin/notices').'/'.$notice->id}}">
                                         {{$notice->title}}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="footer"><a href="{{url('/admin/notices')}}">View all</a></li>
                    </ul>
                </li>
                <li class="dropdown user user-menu">
                    <a href="{{url('admin/users/').'/'.auth()->user()->id}}" class="dropdown-toggle" data-toggle="dropdown"
                       aria-expanded="false">
                        <img src="{{url('/').'/'.auth()->user()->employee_image}}" class="user-image" alt="{{auth()->user()->name}}">
                        <span class="hidden-xs">{{auth()->user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <a href="{{url('admin/users/').'/'.auth()->user()->id}}"  >
                            <img src="{{url('/').'/'.auth()->user()->employee_image}}" class="img-circle" alt="{{auth
                            ()->user()->name}}" width="100px">
                            <p>
                                {{auth()->user()->name}}
                            </p>
                            </a>
                        </li>



                        <li class="user-footer {{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                            <div class="pull-left">
                                <a href="{{ route('auth.change_password') }}">
                                    <i class="fa fa-key"></i>
                                    <span class="title">@lang('lfems.lf_change_password')</span>
                                </a>
                            </div>
                            <div class="pull-right">
                                <a href="#logout" onclick="$('#logout').submit();">
                                    <i class="fa fa-arrow-left"></i>
                                    <span class="title">@lang('lfems.lf_logout')</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </nav>

</header>



