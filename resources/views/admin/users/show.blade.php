@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('lfems.users.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('lfems.lf_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('lfems.users.fields.name')</th>
                            <td field-key='name'>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('lfems.users.fields.email')</th>
                            <td field-key='email'>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('lfems.users.fields.role')</th>
                            <td field-key='role'>{{ $user->role->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('lfems.users.fields.employee-image')</th>
                            <td field-key='employee_image'>@if($user->employee_image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $user->employee_image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $user->employee_image) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('lfems.users.fields.phone-no')</th>
                            <td field-key='phone_no'>{{ $user->phone_no }}</td>
                        </tr>
                        <tr>
                            <th>@lang('lfems.users.fields.joining-date')</th>
                            <td field-key='joining_date'>{{ $user->joining_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('lfems.users.fields.cv')</th>
                            <td field-key='cv'>@if($user->cv)<a href="{{ asset(env('UPLOAD_PATH').'/' . $user->cv) }}" target="_blank">Download file</a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#salery" aria-controls="salery" role="tab" data-toggle="tab">Salery</a></li>
<li role="presentation" class=""><a href="#attandance" aria-controls="attandance" role="tab" data-toggle="tab">Attandance</a></li>
<li role="presentation" class=""><a href="#project_management" aria-controls="project_management" role="tab" data-toggle="tab">Project Management</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="salery">
<table class="table table-bordered table-striped {{ count($saleries) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('lfems.salery.fields.user')</th>
                        <th>@lang('lfems.salery.fields.base-salery')</th>
                        <th>@lang('lfems.salery.fields.month')</th>
                        <th>@lang('lfems.salery.fields.due')</th>
                        <th>@lang('lfems.salery.fields.bonus')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($saleries) > 0)
            @foreach ($saleries as $salery)
                <tr data-entry-id="{{ $salery->id }}">
                    <td field-key='user'>{{ $salery->user->name or '' }}</td>
                                <td field-key='base_salery'>{{ $salery->base_salery }}</td>
                                <td field-key='month'>{{ $salery->month }}</td>
                                <td field-key='due'>{{ $salery->due }}</td>
                                <td field-key='bonus'>{{ $salery->bonus }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("lfems.lf_are_you_sure")."');",
                                        'route' => ['saleries.restore', $salery->id])) !!}
                                    {!! Form::submit(trans('lfems.lf_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("lfems.lf_are_you_sure")."');",
                                        'route' => ['saleries.perma_del', $salery->id])) !!}
                                    {!! Form::submit(trans('lfems.lf_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('saleries.show',[$salery->id]) }}" class="btn btn-xs btn-primary">@lang('lfems.lf_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('saleries.edit',[$salery->id]) }}" class="btn btn-xs btn-info">@lang('lfems.lf_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("lfems.lf_are_you_sure")."');",
                                        'route' => ['saleries.destroy', $salery->id])) !!}
                                    {!! Form::submit(trans('lfems.lf_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('lfems.lf_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="attandance">
<table class="table table-bordered table-striped {{ count($attandances) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('lfems.attandance.fields.date')</th>
                        <th>@lang('lfems.attandance.fields.user')</th>
                        <th>@lang('lfems.attandance.fields.attendance')</th>
                        <th>@lang('lfems.attandance.fields.entry')</th>
                        <th>@lang('lfems.attandance.fields.exit')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($attandances) > 0)
            @foreach ($attandances as $attandance)
                <tr data-entry-id="{{ $attandance->id }}">
                    <td field-key='date'>{{ $attandance->date }}</td>
                                <td field-key='user'>{{ $attandance->user->name or '' }}</td>
                                <td field-key='attendance'>{{ $attandance->attendance }}</td>
                                <td field-key='entry'>{{ $attandance->entry }}</td>
                                <td field-key='exit'>{{ $attandance->exit }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("lfems.lf_are_you_sure")."');",
                                        'route' => ['attandances.restore', $attandance->id])) !!}
                                    {!! Form::submit(trans('lfems.lf_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("lfems.lf_are_you_sure")."');",
                                        'route' => ['attandances.perma_del', $attandance->id])) !!}
                                    {!! Form::submit(trans('lfems.lf_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('attandances.show',[$attandance->id]) }}" class="btn btn-xs btn-primary">@lang('lfems.lf_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('attandances.edit',[$attandance->id]) }}" class="btn btn-xs btn-info">@lang('lfems.lf_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("lfems.lf_are_you_sure")."');",
                                        'route' => ['attandances.destroy', $attandance->id])) !!}
                                    {!! Form::submit(trans('lfems.lf_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('lfems.lf_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="project_management">
<table class="table table-bordered table-striped {{ count($project_managements) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('lfems.project-management.fields.project-name')</th>
                        <th>@lang('lfems.project-management.fields.description')</th>
                        <th>@lang('lfems.project-management.fields.deadline')</th>
                        <th>@lang('lfems.project-management.fields.comment')</th>
                        <th>@lang('lfems.project-management.fields.project-status')</th>
                        <th>@lang('lfems.project-management.fields.user')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($project_managements) > 0)
            @foreach ($project_managements as $project_management)
                <tr data-entry-id="{{ $project_management->id }}">
                    <td field-key='project_name'>{{ $project_management->project_name }}</td>
                                <td field-key='description'>{!! $project_management->description !!}</td>
                                <td field-key='deadline'>{{ $project_management->deadline }}</td>
                                <td field-key='document'>@if($project_management->document)<a href="{{ asset(env('UPLOAD_PATH').'/' . $project_management->document) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='comment'>{!! $project_management->comment !!}</td>
                                <td field-key='project_status'>{{ $project_management->project_status }}</td>
                                <td field-key='user'>{{ $project_management->user->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("lfems.lf_are_you_sure")."');",
                                        'route' => ['project_managements.restore', $project_management->id])) !!}
                                    {!! Form::submit(trans('lfems.lf_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("lfems.lf_are_you_sure")."');",
                                        'route' => ['project_managements.perma_del', $project_management->id])) !!}
                                    {!! Form::submit(trans('lfems.lf_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('project_managements.show',[$project_management->id]) }}" class="btn btn-xs btn-primary">@lang('lfems.lf_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('project_managements.edit',[$project_management->id]) }}" class="btn btn-xs btn-info">@lang('lfems.lf_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("lfems.lf_are_you_sure")."');",
                                        'route' => ['project_managements.destroy', $project_management->id])) !!}
                                    {!! Form::submit(trans('lfems.lf_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="12">@lang('lfems.lf_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.users.index') }}" class="btn btn-default">@lang('lfems.lf_back_to_list')</a>
        </div>
    </div>
@stop
