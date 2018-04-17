@extends('layouts.auth')

@section('content')

    <div class="login-box">
        <div class="login-logo">
            <a href="{{url('/')}}"><b>LF</b>EMS</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <div class="panel-body">

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>@lang('lfems.lf_whoops')</strong> @lang('lfems.lf_there_were_problems_with_input'):
                        <br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="form-horizontal"
                      role="form"
                      method="POST"
                      action="{{ url('login') }}">
                    <input type="hidden"
                           name="_token"
                           value="{{ csrf_token() }}">

                    <div class="form-group">

                        <div class="col-md-12">
                            <input type="email"
                                   class="form-control"
                                   name="email"
                                    placeholder="Email">
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="col-md-12">
                            <input type="password"
                                   class="form-control"
                                   name="password" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 ">
                            <a href="{{ route('auth.password.reset') }}">@lang('lfems.lf_forgot_password')</a>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-12  ">
                            <label>
                                <input type="checkbox"
                                       name="remember"> @lang('lfems.lf_remember_me')
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 ">
                            <button type="submit"
                                    class="btn btn-primary"
                                    style="margin-right: 15px;">
                                @lang('lfems.lf_login')
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.login-box-body -->
    </div>
@endsection