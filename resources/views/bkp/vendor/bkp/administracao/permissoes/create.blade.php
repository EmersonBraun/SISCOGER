@extends('adminlte::page')

@section('title_postfix', '| Criar permissões')

@section('content_header')
 
@stop

@section('content')
<div class='col-md-12'>
    <h1><i class='fa fa-key'></i> Adicionar permissão</h1>
    <br>

    {{ Form::open(array('url' => 'permissoes/salvar')) }}

    <div class="form-group">
        {{ Form::label('name', 'Nome') }}
        {{ Form::text('name', '', array('class' => 'form-control')) }}
    </div><br>
    @if(!$roles->isEmpty())
        <h4>Atribuir Permissão a Funções</h4>
         <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
               @foreach ($roles as $role)
                <tr>
                    <td>{{ Form::checkbox('roles[]',  $role->id ) }}</td>
                    <td>{{ Form::label($role->name, ucfirst($role->name)) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
              <tr>
                  <th>#</th>
                  <th>Nome</th>
              </tr>
            </tfoot>
        </table>
    @endif
    <br>
    {{ Form::submit('Adicionar', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
</div>
@stop

@section('css')
@stop

@section('js')
    @include('vendor.adminlte.includes.tabelas')
@stop