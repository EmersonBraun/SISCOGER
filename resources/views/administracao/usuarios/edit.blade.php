@extends('adminlte::page')

@section('title_postfix', '| Editar usuarios')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h2><i class='fa fa-user-plus'></i> Atualizar RG:{{$user->rg}}</h2>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="usuarios">usuarios</a></li>
            <li class="breadcrumb-item active">atualizar</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
@stop

@section('content')
<div class='col-lg-12'>
    {{ Form::model($user, array('route' => array('user.update', $user->id), 'method' => 'PUT')) }}
    <div class="form-group col-lg-12 @if ($errors->has('rg')) has-error @endif">
        {{ Form::label('rg', 'rg') }}
        {{ Form::text('rg', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group col-lg-12 @if ($errors->has('email')) has-error @endif">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', null, array('class' => 'form-control')) }}
    </div>
    <h5><b>Permissões</b></h5>
    <div class="form-group col-lg-12 @if ($errors->has('roles')) has-error @endif">
        @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id, $user->roles ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>
        @endforeach
    </div>
    {{ Form::submit('Atualizar', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
</div>
@stop

@section('css')
@stop

@section('js')

@stop