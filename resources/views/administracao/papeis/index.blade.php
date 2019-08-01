@extends('adminlte::page')

@section('title_postfix', '| regras')

@section('content_header')
<section class="content-header">
    <h1><i class="fa fa-key"></i> Gerenciamento de papéis</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Gerenciamento de papéis</li>
    </ol>
    <br>
    <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
        @can('listar-usuarios')       
        <div class='btn-group col-md-4 col-xs-12 '>
            <a href="{{ route('user.index') }}" class="btn btn-default btn-block">Usuários</a>
        </div>
        @endcan
        @can('listar-permissoes')   
        <div class='btn-group col-md-4 col-xs-12 '>
            <a href="{{ route('permission.index') }}" class="btn btn-default btn-block">Permissões</a>
        </div>
        @endcan
        @can('criar-papeis')            
        <div class='btn-group col-md-4 col-xs-12 '>
            <a href="{{ route('role.create') }}" class="btn btn-success btn-block">
                <i class="fa fa-plus "></i> Adicionar papeis</a>
        </div>
        @endcan
    <div>
</section>

@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-header">
                    <h3 class="box-title">Listagem de papeis</h3>
                </div>
                <div class="box-body">
                    <table id="datable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="display: none">#</th>
                                <th class='col'>Papel</th>
                                <th class='col'>Permissões</th>
                                <th class='col'>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td style="display: none">{{$role->id}}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>
                                <td>
                                    @can('editar-papeis') 
                                    <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-info"
                                        style="margin-right: 3px;">Editar</i></a>
                                    @endcan
                                    @can('apagar-papeis') 
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
                                    {!! Form::submit('Apagar', ['class' => 'btn btn-danger', 'onclick' => 'return
                                    confirm("Você tem certeza?");']) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="display: none">#</th>
                                <th class='col'>Papel</th>
                                <th class='col'>Permissões</th>
                                <th class='col'>Ações</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
</section>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop