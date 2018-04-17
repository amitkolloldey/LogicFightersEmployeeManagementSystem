@extends('layouts.app')

@section('content')
    <h3 class="page-title">View Notice</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('lfems.lf_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Title</th>
                            <td field-key='title'>{{ $notice->title}}</td>

                        </tr>
                        <tr>
                            <th>Details</th>
                            <td field-key='details'>{{ $notice->details}}</td>
                        </tr>
                    </table>
                </div>
            </div>


            <a href="{{ route('admin.notices.index') }}" class="btn btn-default">@lang('lfems.lf_back_to_list')</a>
        </div>
    </div>
@stop
