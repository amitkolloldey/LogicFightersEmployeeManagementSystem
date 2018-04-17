@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('lfems.attandance.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('lfems.lf_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('lfems.attandance.fields.date')</th>
                            <td field-key='date'>{{ $attandance->date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('lfems.attandance.fields.user')</th>
                            <td field-key='user'>{{ $attandance->user->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('lfems.attandance.fields.attendance')</th>
                            <td field-key='attendance'>{{ $attandance->attendance }}</td>
                        </tr>
                        <tr>
                            <th>@lang('lfems.attandance.fields.entry')</th>
                            <td field-key='entry'>{{ $attandance->entry }}</td>
                        </tr>
                        <tr>
                            <th>@lang('lfems.attandance.fields.exit')</th>
                            <td field-key='exit'>{{ $attandance->exit }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.attandances.index') }}" class="btn btn-default">@lang('lfems.lf_back_to_list')</a>
        </div>
    </div>
@stop
