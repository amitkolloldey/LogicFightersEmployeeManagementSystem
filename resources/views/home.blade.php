@extends('layouts.app')
@section('custom_css')
    <link href="{{ url('adminlte/plugins/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet"/>
    <link href="{{ url('adminlte/plugins/fullcalendar/fullcalendar.print.min.css')}}" media="print"/>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('lfems.lf_dashboard')</div>
                <div class="row">
                    <div class="col-md-12">
                        <div style="padding: 15px 20px;margin-bottom: 20px; background: rgb(243, 156, 18); z-index:
                        999999;
                        font-size:16px; font-weight: 600;">
                            <strong style="color: #fff">Today's Attendance {{date('d.m.y')}}</strong>
                            <a href="{{url('/admin/attandances')}}" style="color: rgb(249, 249, 249); display:
                            inline-block; margin-right: 10px;text-decoration: underline;">Mark Your Attendance If You have not Done Already!
                            </a> </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-blue"><i class="fa fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Resources</span>
                                <span class="info-box-number">{{count($users)}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-cubes"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Departments</span>
                                <span class="info-box-number">{{count($departments)}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="fa fa-briefcase"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Projects</span>
                                <span class="info-box-number">{{count($projects)}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel-body">
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Total Resources</h3>
                                    <div class="box-tools pull-right">
                                        <span class="label label-danger">{{$users_count}} Employees</span>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <ul class="users-list clearfix">
                                        @foreach($users as $user)
                                            <li>
                                                <img src="{{url('/'.$user->employee_image)}}"
                                                     alt="{{$user->name}}" width="50px">
                                                <a class="users-list-name"
                                                   href="{{url('users/'.$user->id)}}">{{$user->name}}</a>
                                                <span class="users-list-date">{{$user->role->title}}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <!-- /.users-list -->
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer text-center">
                                    <a href="{{url('admin/users')}}" class="uppercase">View All</a>
                                </div>
                                <!-- /.box-footer -->
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel-body">
                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Recent Projects</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <ul class="users-list clearfix">
                                        <li style="width: 100%">
                                            <strong class="pull-left">Project Name</strong>
                                            <strong class="pull-right">Assigned To</strong>
                                        </li>
                                        @foreach($projects as $project)
                                            <li style="width:100%;">
                                            <span class="pull-left"><a
                                                        href="{{url('admin/project_managements').'/'.$project->id
                                                        }}">{{$project->project_name}}</a></span>
                                                <span class="pull-right">{{$project->user->name}}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <!-- /.users-list -->
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer text-center">
                                    <a href="{{url('admin/project_managements')}}" class="uppercase">View All</a>
                                </div>
                                <!-- /.box-footer -->
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection