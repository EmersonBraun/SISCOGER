@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('public/vendor/adminlte/css/auth.css') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')
    <div class="login-box" id="app">
        <div class="login-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', 'SISCOGER') !!}</a><br>
            <h4>Controle Processual da PMPR</h4>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">{{ config('adminlte.login_message') }}</p>
            {!! Form::open(['url' => url(config('adminlte.login_url', 'login'))]) !!}

                <div class="form-group has-feedback {{ $errors->has('rg') ? 'has-error' : '' }}">
                    {{ Form::text('rg', null, ['class' => 'form-control ','id' => 'rg', 'placegolder' => 'RG']) }}
                    <span class="fa fa-user form-control-feedback"></span>
                    @if ($errors->has('rg'))
                        <span class="help-block">
                            <strong>{{ $errors->first('rg') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control" placeholder="{{ config('adminlte.password') }}">
                    <span class="fa fa-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-7">
                       <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}" class="btn btn-default btn-block btn-flat">
                        {{ config('adminlte.i_forgot_my_password') }}
                        </a>
                    </div>
                    <div class="col-xs-5">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            {{ config('adminlte.sign_in') }}
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}
                 
                {{-- @if (config('adminlte.register_url', 'register'))
                    <a href="{{ url(config('adminlte.register_url', 'register')) }}"
                       class="text-center"
                    >{{ config('adminlte.register_a_new_membership') }}</a>
                @endif  --}}
            </div>

        <div >
            <br><br>
            <p class="text-uppercase texto-branco">Não tem acesso ao sistema?</p>
            <p class="texto-branco"> Solicite sua senha junto à Corregedoria-Geral</p>
            <p class="texto-branco">Email: coger-adm@pm.pr.gov.br</p>
            <br>
        </div>

    </div>
    
@stop

@section('adminlte_js')
@yield('js')
@stop
