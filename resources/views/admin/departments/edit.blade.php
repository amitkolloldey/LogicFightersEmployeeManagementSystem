@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('lfems.departments.title')</h3>
    
    {!! Form::model($department, ['method' => 'PUT', 'route' => ['admin.departments.update', $department->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('lfems.lf_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('lfems.departments.fields.name').'', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('lfems.lf_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

