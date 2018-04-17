@extends('layouts.app')

@section('content')
    <h3 class="page-title">Notice</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.notices.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            Create
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

    {!! Form::submit(trans('lfems.lf_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

