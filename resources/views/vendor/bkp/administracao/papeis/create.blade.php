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
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($permissions as $permission)
            <tr>
                <td>{{ Form::checkbox('permissions[]',  $permission->id ) }}</td>
                <td>{{ Form::label($permission->name, ucfirst($permission->name)) }}</td>
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
    {{$permissions->links()}}
    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
</div>
@stop

@section('css')
@stop

@section('js')
    @include('vendor.adminlte.includes.tabelas')
@stop