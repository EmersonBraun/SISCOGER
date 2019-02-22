@extends('adminlte::page')

@section('title_postfix', '| Criar permissões')

@section('content_header')
 
@stop

@section('content')
<div class='col-md-12'>
    <h1><i class='fa fa-key'></i> Editar {{$permission->name}}</h1>
    <br>
    {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}
    {{-- Vinculação de modelo de formulário para preencher automaticamente nossos campos com dados de permissão --}}

    <div class="form-group">
        {{ Form::label('name', 'Permission Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>
    <br>
    {{ Form::submit('Editar', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
</div>
@stop

@section('css')
@stop

@section('js')
@stop