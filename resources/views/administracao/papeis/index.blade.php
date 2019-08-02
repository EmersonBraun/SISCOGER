@extends('adminlte::page')

@section('title_postfix', '| regras')

@section('content_header')
@include('administracao.papeis.menu')

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
                                    @if(hasPermissionTo('editar-papeis')) 
                                    <a href="{{ route('role.edit',$role->id) }}" class="btn btn-info"
                                        style="margin-right: 3px;">Editar</i></a>
                                    @endif
                                    @if(hasPermissionTo('apagar-papeis'))
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['role.destroy', $role->id] ]) !!}
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