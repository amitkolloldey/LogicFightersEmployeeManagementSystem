@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    @can('notice_create')
    <p>
        <a href="{{ route('admin.notices.create') }}" class="btn btn-success">@lang('lfems.lf_add_new')</a>
    </p>
    @endcan

    @can('notice_delete')
    <span>
        <ul class="list-inline">
            <li><a href="{{ route('admin.notices.index') }}" style="{{ request('show_deleted') == 1 ? '' :'font-weight: 700' }}">@lang('lfems.lf_all')</a></li> |
            <li>
                <a href="{{ route('admin.notices.index') }} ?show_deleted=1" style="{{ request('show_deleted') == 1 ?
             'font-weight: 700' : '' }}">@lang('lfems.lf_trash')
                </a>
            </li>
        </ul>
    </span>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('lfems.lf_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($notices) > 0 ? 'datatable' : '' }} @can('notice_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('notice_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>Title</th>
                        <th>Details</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($notices) > 0)
                        @foreach ($notices as $notice)
                            <tr data-entry-id="{{ $notice->id }}">
                                @can('notice_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='title'>{{ $notice->title }}</td>
                                <td field-key='details'>{{ $notice->details }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('notice_delete')
                                        {!! Form::open(array('style' => 'display: inline-block;','method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("lfems.lf_are_you_sure")."');",'route'
                                         => ['admin.notices.restore', $notice->id])) !!}
                                    {!! Form::submit(trans('lfems.lf_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('notice_delete')
                                      {!! Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE',
                                      'onsubmit' => "return confirm('".trans("lfems.lf_are_you_sure")."');",'route'
                                      => ['admin.notices.perma_del', $notice->id])) !!}
                                    {!! Form::submit(trans('lfems.lf_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('notice_view')
                                    <a href="{{ route('admin.notices.show',[$notice->id]) }}" class="btn btn-xs
                                    btn-primary">@lang('lfems.lf_view')</a>
                                    @endcan
                                    @can('notice_edit')
                                    <a href="{{ route('admin.notices.edit',[$notice->id]) }}" class="btn btn-xs btn-info">@lang('lfems.lf_edit')</a>
                                    @endcan
                                    @can('notice_delete')
                                        {!! Form::open(array('style' => 'display: inline-block;','method' =>
                                        'DELETE','onsubmit' => "return confirm('".trans("lfems.lf_are_you_sure")."');
                                        ",'route' => ['admin.notices.destroy', $notice->id])) !!}
                                    {!! Form::submit(trans('lfems.lf_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">@lang('lfems.lf_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('notice_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.notices.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection