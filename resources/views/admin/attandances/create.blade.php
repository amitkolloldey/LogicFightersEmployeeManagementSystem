@extends('layouts.app')

@section('content')
    <h3 class="page-title">Add new @lang('lfems.attandance.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.attandances.store']]) !!}

    <div class="panel panel-default">
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('date', trans('lfems.attandance.fields.date').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('date', old('date'), ['class' => 'form-control date', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('date'))
                        <p class="help-block">
                            {{ $errors->first('date') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('user_id', trans('lfems.attandance.fields.user').'', ['class' => 'control-label']) !!}
                    {!! Form::select('user_id', $users, NULL, ['class' => 'form-control select2']) !!}
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
                    {!! Form::label('attendance', trans('lfems.attandance.fields.attendance').'*', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('attendance'))
                        <p class="help-block">
                            {{ $errors->first('attendance') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('attendance', '1', false, ['required' => '']) !!}
                            Present
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('attendance', '2', false, ['required' => '']) !!}
                            Absent
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('entry', trans('lfems.attandance.fields.entry').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('entry', old('entry'), ['class' => 'form-control timepicker', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('entry'))
                        <p class="help-block">
                            {{ $errors->first('entry') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('exit', trans('lfems.attandance.fields.exit').'', ['class' => 'control-label']) !!}
                    {!! Form::text('exit', old('exit'), ['class' => 'form-control timepicker', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('exit'))
                        <p class="help-block">
                            {{ $errors->first('exit') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('lfems.lf_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
            $('.timepicker').datetimepicker({
                format: "{{ config('app.time_format_moment') }}",
            });
            
        });
    </script>
            
@stop