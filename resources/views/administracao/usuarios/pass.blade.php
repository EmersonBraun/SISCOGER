@extends('adminlte::page')

@section('title_postfix', '| Alterar senha')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class='fa fa-user-plus'></i> Alterar senha</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">modificar senha</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
@stop

@section('content')
<div class='col-lg-12'>
    {{ Form::model($user, array('route' => array('user.update', $user->id), 'method' => 'PUT')) }}
    <div class="form-group col-lg-6 @if ($errors->has('password')) has-error @endif">
        {{ Form::label('password', 'Senha') }}<br>
        {{ Form::password('password', array('class' => 'form-control')) }}
    </div>
    <div class="form-group col-lg-6 @if ($errors->has('password')) has-error @endif">
        {{ Form::label('password', 'Confirmar Senha') }}<br>
        {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
    </div>
    {{ Form::submit('Atualizar', array('class' => 'btn btn-primary btn-block')) }}
    {{ Form::close() }}
</div>
@stop

@section('css')
@stop

@section('js')

@stop