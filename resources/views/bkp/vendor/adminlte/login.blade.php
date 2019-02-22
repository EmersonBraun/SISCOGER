@extends('adminlte::master')
@section('adminlte_css')
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', 'SISCOGER') !!}</a><br>
            <h4>Controle Processual da PMPR</h4>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">{{ config('adminlte.login_message') }}</p>
            <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
                {!! csrf_field() !!}

                <div class="form-group has-feedback {{ $errors->has('rg') ? 'has-error' : '' }}">
                    <input type="text" name="rg" id="rg" class="form-control numero" value="{{ old('rg') }}"
                           placeholder="RG">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('rg'))
                        <span class="help-block">
                            <strong>{{ $errors->first('rg') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control"
                           placeholder="{{ config('adminlte.password') }}">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-6">
                       <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}"
                        class="btn btn-default btn-block btn-flat">
                        {{ config('adminlte.i_forgot_my_password') }}
                        </a>
                    </div>
                    <div class="col-xs-6">
                        <button type="submit"
                                class="btn btn-primary btn-block btn-flat">{{ config('adminlte.sign_in') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>         
                 <!-- 
                @if (config('adminlte.register_url', 'register'))
                    <a href="{{ url(config('adminlte.register_url', 'register')) }}"
                       class="text-center"
                    >{{ config('adminlte.register_a_new_membership') }}</a>
                @endif /.login-box-body -->
            </div>

        <!-- /.login-box-body -->
        <div >
            <br><br>
            <p class="text-uppercase texto-branco">Não tem acesso ao sistema?</p>
            <p class="texto-branco"> Solicite sua senha junto à Corregedoria-Geral</p>
            <p class="texto-branco">Email: coger-adm@pm.pr.gov.br</p>
            <br>
        </div>
    </div><!-- /.login-box -->

@stop

@section('adminlte_js')
@yield('js')
@stop
