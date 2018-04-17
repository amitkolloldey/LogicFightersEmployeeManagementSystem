@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('lfems.salery.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.saleries.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('lfems.lf_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('user_id', trans('lfems.salery.fields.user').'', ['class' => 'control-label']) !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('user_id'))
                        <p class="help-block">
                            {{ $errors->first('user_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('base_salery', trans('lfems.salery.fields.base-salery').'', ['class' => 'control-label']) !!}
                    {!! Form::text('base_salery', old('base_salery'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('base_salery'))
                        <p class="help-block">
                            {{ $errors->first('base_salery') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('month', trans('lfems.salery.fields.month').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('month', old('month'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('month'))
                        <p class="help-block">
                            {{ $errors->first('month') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('due', trans('lfems.salery.fields.due').'', ['class' => 'control-label']) !!}
                    {!! Form::text('due', old('due'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('due'))
                        <p class="help-block">
                            {{ $errors->first('due') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('bonus', trans('lfems.salery.fields.bonus').'', ['class' => 'control-label']) !!}
                    {!! Form::text('bonus', old('bonus'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('bonus'))
                        <p class="help-block">
                            {{ $errors->first('bonus') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('lfems.lf_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

