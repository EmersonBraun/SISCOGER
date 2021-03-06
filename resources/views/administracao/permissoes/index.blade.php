@extends('adminlte::page')

@section('title_postfix', '| Permissões')

@section('content_header')
    @include('administracao.permissoes.menu', ['title' => 'Lista','page' => 'lista'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de permissões</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col'>Permissões</th>
                            <th class='col'>Relação</th>
                            <th class='col'>Descrição</th>
                            <th class='col'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                        <tr>
                            <td style="display: none">{{$permission->id}}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->related }}</td>
                            <td>{{ $permission->description }}</td>
                            <td>
                                @if(hasPermissionTo('editar-permissoes'))
                                <a href="{{ route('permission.edit',$permission->id) }}" class="btn btn-info pull-left"
                                    style="margin-right: 3px;">Editar</a>
                                @endif
                                @if(hasPermissionTo('apagar-permissoes'))
                                {!! Form::open(['method' => 'DELETE', 'route' => ['permission.destroy',
                                $permission->id] ]) !!}
                                {!! Form::submit('Apagar', ['class' => 'btn btn-danger', 'onclick' => 'return
                                confirm("Você tem certeza?");']) !!}
                                {!! Form::close() !!}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col'>Permissões</th>
                            <th class='col'>Relação</th>
                            <th class='col'>Descrição</th>
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
@stop

@section('js')
@stop