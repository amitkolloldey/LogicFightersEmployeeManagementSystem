@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('lfems.roles.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('lfems.lf_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('lfems.roles.fields.title')</th>
                            <td field-key='title'>{{ $role->title }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#users" aria-controls="users" role="tab" data-toggle="tab">Employees</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="users">
<table class="table table-bordered table-striped {{ count($users) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('lfems.users.fields.name')</th>
                        <th>@lang('lfems.users.fields.email')</th>
                        <th>@lang('lfems.users.fields.role')</th>
                        <th>@lang('lfems.users.fields.employee-image')</th>
                        <th>@lang('lfems.users.fields.phone-no')</th>
                        <th>@lang('lfems.users.fields.joining-date')</th>
                        <th>@lang('lfems.users.fields.cv')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($users) > 0)
            @foreach ($users as $user)
                <tr data-entry-id="{{ $user->id }}">
                    <td field-key='name'>{{ $user->name }}</td>
                                <td field-key='email'>{{ $user->email }}</td>
                                <td field-key='role'>{{ $user->role->title or '' }}</td>
                                <td field-key='employee_image'>@if($user->employee_image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $user->employee_image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $user->employee_image) }}"/></a>@endif</td>
                                <td field-key='phone_no'>{{ $user->phone_no }}</td>
                                <td field-key='joining_date'>{{ $user->joining_date }}</td>
                                <td field-key='cv'>@if($user->cv)<a href="{{ asset(env('UPLOAD_PATH').'/' . $user->cv) }}" target="_blank">Download file</a>@endif</td>
                                                                <td>
                                    @can('view')
                                    <a href="{{ route('users.show',[$user->id]) }}" class="btn btn-xs btn-primary">@lang('lfems.lf_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('users.edit',[$user->id]) }}" class="btn btn-xs btn-info">@lang('lfems.lf_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("lfems.lf_are_you_sure")."');",
                                        'route' => ['users.destroy', $user->id])) !!}
                                    {!! Form::submit(trans('lfems.lf_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="14">@lang('lfems.lf_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.roles.index') }}" class="btn btn-default">@lang('lfems.lf_back_to_list')</a>
        </div>
    </div>
@stop
