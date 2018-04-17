@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('lfems.project-management.title')</h3>
    @can('project_management_create')
        <p>
            <a href="{{ route('admin.project_managements.create') }}"
               class="btn btn-success">@lang('lfems.lf_add_new')</a>

        </p>
    @endcan

    @can('project_management_delete')
        <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.project_managements.index') }}"
                   style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('lfems.lf_all')</a></li>
            |
            <li><a href="{{ route('admin.project_managements.index') }}?show_deleted=1"
                   style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('lfems.lf_trash')</a></li>
        </ul>
        </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('lfems.lf_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($project_managements) > 0 ? 'datatable' : '' }} @can('project_management_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                <tr>
                    @can('project_management_delete')
                        @if ( request('show_deleted') != 1 )
                            <th style="text-align:center;"><input type="checkbox" id="select-all"/></th>@endif
                    @endcan

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
                            @can('project_management_delete')
                                @if ( request('show_deleted') != 1 )
                                    <td></td>@endif
                            @endcan

                            <td field-key='project_name'>{{ $project_management->project_name }}</td>
                            <td field-key='description'>{!! $project_management->description !!}</td>
                            <td field-key='deadline'>{{ $project_management->deadline }}</td>

                            <td field-key='comment'>{!! $project_management->comment !!}</td>
                            <td field-key='project_status'>{{ $project_management->project_status }}</td>
                            <td field-key='user'>{{ $project_management->user->name or '' }}</td>
                            @if( request('show_deleted') == 1 )
                                <td>
                                    @can('project_management_delete')
                                        {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'POST', 'onsubmit' => "return confirm('".trans("lfems.lf_are_you_sure")."');",'route' => ['admin.project_managements.restore', $project_management->id])) !!}
                                        {!! Form::submit(trans('lfems.lf_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                    @can('project_management_delete')
                                        {!! Form::open(array('style' => 'display: inline-block;','method' => 'DELETE','onsubmit' => "return confirm('".trans("lfems.lf_are_you_sure")."');",'route' => ['admin.project_managements.perma_del', $project_management->id])) !!}
                                        {!! Form::submit(trans('lfems.lf_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            @else
                                <td>
                                    @can('project_management_view')
                                        <a href="{{ route('admin.project_managements.show',[$project_management->id]) }}"
                                           class="btn btn-xs btn-primary">@lang('lfems.lf_view')</a>
                                    @endcan
                                    @can('project_management_edit')
                                        <a href="{{ route('admin.project_managements.edit',[$project_management->id]) }}"
                                           class="btn btn-xs btn-info">@lang('lfems.lf_edit')</a>
                                    @endcan
                                    @can('project_management_delete')
                                        {!! Form::open(array('style' => 'display: inline-block;','method' => 'DELETE','onsubmit' => "return confirm('".trans("lfems.lf_are_you_sure")."');",'route' => ['admin.project_managements.destroy', $project_management->id])) !!}
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
@stop

@section('javascript')
    <script>
        @can('project_management_delete')
                @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.project_managements.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection