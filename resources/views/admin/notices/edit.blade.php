@extends('layouts.app')

@section('content')
    <h3 class="page-title">Edit Notice</h3>
    
    {!! Form::model($notice, ['method' => 'PUT', 'route' => ['admin.notices.update', $notice->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('lfems.lf_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-12 form-group">
                    {!! Form::label('details', 'Details', ['class' => 'control-label']) !!}
                    {!! Form::textarea('details', old('details'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('details'))
                        <p class="help-block">
                            {{ $errors->first('details') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('lfems.lf_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

