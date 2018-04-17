@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('lfems.salery.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('lfems.lf_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('lfems.salery.fields.user')</th>
                            <td field-key='user'>{{ $salery->user->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('lfems.salery.fields.base-salery')</th>
                            <td field-key='base_salery'>{{ $salery->base_salery }}</td>
                        </tr>
                        <tr>
                            <th>@lang('lfems.salery.fields.month')</th>
                            <td field-key='month'>{{ $salery->month }}</td>
                        </tr>
                        <tr>
                            <th>@lang('lfems.salery.fields.due')</th>
                            <td field-key='due'>{{ $salery->due }}</td>
                        </tr>
                        <tr>
                            <th>@lang('lfems.salery.fields.bonus')</th>
                            <td field-key='bonus'>{{ $salery->bonus }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.saleries.index') }}" class="btn btn-default">@lang('lfems.lf_back_to_list')</a>
        </div>
    </div>
@stop
