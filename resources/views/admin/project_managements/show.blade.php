@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('lfems.project-management.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('lfems.lf_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('lfems.project-management.fields.project-name')</th>
                            <td field-key='project_name'>{{ $project_management->project_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('lfems.project-management.fields.description')</th>
                            <td field-key='description'>{!! $project_management->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('lfems.project-management.fields.deadline')</th>
                            <td field-key='deadline'>{{ $project_management->deadline }}</td>
                        </tr>
                        <tr>
                            <th>@lang('lfems.project-management.fields.document')</th>
                            <td field-key='document's> @foreach($project_management->getMedia('document') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                        <tr>
                            <th>@lang('lfems.project-management.fields.comment')</th>
                            <td field-key='comment'>{!! $project_management->comment !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('lfems.project-management.fields.project-status')</th>
                            <td field-key='project_status'>{{ $project_management->project_status }}</td>
                        </tr>
                        <tr>
                            <th>@lang('lfems.project-management.fields.user')</th>
                            <td field-key='user'>{{ $project_management->user->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.project_managements.index') }}" class="btn btn-default">@lang('lfems.lf_back_to_list')</a>
        </div>
    </div>
@stop
