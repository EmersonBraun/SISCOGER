@extends('adminlte::page')

@section('title_postfix', '| Criar papéis')

@section('content_header')
 
@stop

@section('content')
<div class='col-lg-12'>
    <h1><i class='fa fa-key'></i> Criar papéis</h1>
    <hr>
    {{ Form::open(array('url' => 'roles')) }}

    <div class="form-group">
        {{ Form::label('name', 'Nome') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <h5><b>Atribuir Permissões</b></h5>
    <div class="col-md-12 col-xs-12">
        @foreach ($permissions as $permission)
        <div class="col-xs-3 nopadding">
            {{ Form::checkbox('permissions[]',  $permission->id ) }}
            {{ Form::label($permission->name, ucfirst($permission->name)) }}
        </div>
        @endforeach
    </div>
    {{ Form::submit('Save', array('class' => 'btn btn-block btn-primary')) }}
    {{ Form::close() }}
</div>
@stop

@section('css')
@stop

@section('js')
    @include('vendor.adminlte.includes.tabelas')
@stop