@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('lfems.departments.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('lfems.lf_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('lfems.departments.fields.name')</th>
                            <td field-key='name'>{{ $department->name }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.departments.index') }}" class="btn btn-default">@lang('lfems.lf_back_to_list')</a>
        </div>
    </div>
@stop
