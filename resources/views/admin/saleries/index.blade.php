@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('lfems.salery.title')</h3>
    @can('salery_create')
    <p>
        <a href="{{ route('admin.saleries.create') }}" class="btn btn-success">@lang('lfems.lf_add_new')</a>
        
    </p>
    @endcan

    @can('salery_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.saleries.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('lfems.lf_all')</a></li> |
            <li><a href="{{ route('admin.saleries.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('lfems.lf_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('lfems.lf_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($saleries) > 0 ? 'datatable' : '' }} @can('salery_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('salery_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

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
                                @can('salery_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='user'>{{ $salery->user->name or '' }}</td>
                                <td field-key='base_salery'>{{ $salery->base_salery }}</td>
                                <td field-key='month'>{{ $salery->month }}</td>
                                <td field-key='due'>{{ $salery->due }}</td>
                                <td field-key='bonus'>{{ $salery->bonus }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('salery_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("lfems.lf_are_you_sure")."');",
                                        'route' => ['admin.saleries.restore', $salery->id])) !!}
                                    {!! Form::submit(trans('lfems.lf_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('salery_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("lfems.lf_are_you_sure")."');",
                                        'route' => ['admin.saleries.perma_del', $salery->id])) !!}
                                    {!! Form::submit(trans('lfems.lf_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('salery_view')
                                    <a href="{{ route('admin.saleries.show',[$salery->id]) }}" class="btn btn-xs btn-primary">@lang('lfems.lf_view')</a>
                                    @endcan
                                    @can('salery_edit')
                                    <a href="{{ route('admin.saleries.edit',[$salery->id]) }}" class="btn btn-xs btn-info">@lang('lfems.lf_edit')</a>
                                    @endcan
                                    @can('salery_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("lfems.lf_are_you_sure")."');",
                                        'route' => ['admin.saleries.destroy', $salery->id])) !!}
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
        @can('salery_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.saleries.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection