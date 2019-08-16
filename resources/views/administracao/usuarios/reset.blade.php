@extends('adminlte::master')

@section('title_postfix', '| Alterar senha')

<div class="text-center">
  <h1>BEM VINDO(A) AO SISCOGER!</h1>
  <h2>Altere a senha padrão para ter acesso ao sistema!</h2>
</div>
<div class='col-md-10 col-md-offset-1'>
    {{ Form::model($user, array('route' => array('user.passupdate', $user->id), 'method' => 'PUT')) }}
    <div class="form-group col-lg-12 @if ($errors->has('password')) has-error @endif">
        {{ Form::label('password', 'Senha') }}<br>
        {{ Form::password('password', array('class' => 'form-control')) }}
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group col-lg-12 @if ($errors->has('password')) has-error @endif">
        {{ Form::label('password', 'Confirme a Senha') }}<br>
        {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif
    </div>
      {{ Form::submit('Atualizar', array('class' => 'btn btn-primary btn-lg btn-block')) }}
      {{ Form::close() }}
</div>

@section('css')
@stop

@section('js')

@stop