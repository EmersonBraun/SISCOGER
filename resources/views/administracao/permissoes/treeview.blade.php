@extends('adminlte::page')

@section('title_postfix', '| Permissões')

@section('content_header')
    @include('administracao.permissoes.menu', ['title' => 'Árvore','page' => 'treeview'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de permissões</h3>
            </div>
            <div class="box-body">
                @foreach ($permissions as $name => $permissionGroup)
                <div class="col-md-4 col-xs-12">
                    <div class="box box-info collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{$name}}</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-toggle="collapse" data-target="#{{$name}}">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body" id="{{$name}}">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($permissionGroup as $permission)    
                                            <tr>
                                                <td>{{$permission['name']}}</td>
                                                <td>
                                                    @can('editar-permissoes') 
                                                    <a href="{{ route('permission.edit',$permission['id']) }}" class="btn btn-info pull-left"
                                                        style="margin-right: 3px;">Edit</a>
                                                    @endcan
                                                    @can('apagar-permissoes') 
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['permission.destroy',
                                                    $permission['id']] ]) !!}
                                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => 'return
                                                    confirm("Você tem certeza?");']) !!}
                                                    {!! Form::close() !!}
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
@stop

@section('js')
@stop