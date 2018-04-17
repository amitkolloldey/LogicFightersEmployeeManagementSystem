@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('lfems.attandance.title')</h3>
    @can('attandance_create')
    <p>
        <a href="{{ route('admin.attandances.create') }}" class="btn btn-success">@lang('lfems.lf_add_new')</a>
        
    </p>
    @endcan

    @can('attandance_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.attandances.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('lfems.lf_all')</a></li> |
            <li><a href="{{ route('admin.attandances.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('lfems.lf_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('lfems.lf_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($attandances) > 0 ? 'datatable' : '' }} @can('attandance_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('attandance_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

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
                                @can('attandance_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='date'>{{ $attandance->date }}</td>
                                <td field-key='user'>{{ $attandance->user->name or '' }}</td>
                                <td field-key='attendance'>{{ $attandance->attendance }}</td>
                                <td field-key='entry'>{{ $attandance->entry }}</td>
                                <td field-key='exit'>{{ $attandance->exit }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('attandance_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("lfems.lf_are_you_sure")."');",
                                        'route' => ['admin.attandances.restore', $attandance->id])) !!}
                                    {!! Form::submit(trans('lfems.lf_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('attandance_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("lfems.lf_are_you_sure")."');",
                                        'route' => ['admin.attandances.perma_del', $attandance->id])) !!}
                                    {!! Form::submit(trans('lfems.lf_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('attandance_view')
                                    <a href="{{ route('admin.attandances.show',[$attandance->id]) }}" class="btn btn-xs btn-primary">@lang('lfems.lf_view')</a>
                                    @endcan
                                    @can('attandance_edit')
                                    <a href="{{ route('admin.attandances.edit',[$attandance->id]) }}" class="btn btn-xs btn-info">@lang('lfems.lf_edit')</a>
                                    @endcan
                                    @can('attandance_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("lfems.lf_are_you_sure")."');",
                                        'route' => ['admin.attandances.destroy', $attandance->id])) !!}
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
    </div>
@stop

@section('javascript') 
    <script>
        @can('attandance_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.attandances.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection