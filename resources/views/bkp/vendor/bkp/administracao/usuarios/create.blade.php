@extends('adminlte::page')

@section('title_postfix', '| Criar usuarios')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class='fa fa-user-plus'></i> Criar usuário</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item"><a href="usuarios">usuarios</a></li>
            <li class="breadcrumb-item active">criar</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
@stop

@section('content')
<div class=''>
    {!! Form::open(array('url' => '/usuarios/salvar')) !!}
    <div class="col-md-6 form-group @if ($errors->has('rg')) has-error @endif">
        {!! Form::label('rg', 'RG') !!}
        {!! Form::text('rg', '', array('class' => 'form-control','placeholder' => 'Busca por rg' , 'onfocusout' => 'completarnome($(this).val())' )) !!}
        @if ($errors->has('rg'))
            <span class="help-block">
                <strong>{{ $errors->first('rg') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-md-6 form-group">
        {!! Form::label('nome', 'Nome') !!}
        {!! Form::text('nome', null, array('class' => 'form-control typeahead','placeholder' => 'Busca por nome', 'onfocusout' => 'completarg($(this).val())')) !!}
        @if ($errors->has('nome'))
            <span class="help-block">
                <strong>{{ $errors->first('nome') }}</strong>
            </span>
        @endif
    </div>

    <div class="col-md-12 form-group @if ($errors->has('roles')) has-error @endif">
    <h3>Permissões</h3><br>
        @foreach ($roles as $role)
            {!! Form::checkbox('roles[]',  $role->id ) !!}
            {!! Form::label($role->name, ucfirst($role->name)) !!}<br>
        @endforeach
        @if ($errors->has('roles'))
            <span class="help-block">
                <strong>{{ $errors->first('roles') }}</strong>
            </span>
        @endif
    </div>
    </div>
    {!! Form::submit('Salvar', array('class' => 'btn btn-block btn-primary')) !!}
    {!! Form::close() !!}

@stop

@section('css')
@stop

@section('js')
    @include('vendor.adminlte.includes.nome_rg')
@stop