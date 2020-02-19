@extends('adminlte::page')

@section('title_postfix', '| usuários')

@section('content_header')
@include('administracao.usuarios.menu', ['title' => 'Gerenciamento de Usuários','page' => 'apagados'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Usuários</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class='col-xs-1'>RG</th>
                            <th class='col-xs-2'>Nome</th>
                            <th class='col-xs-1'>Posto/Grad</th>
                            <th class='col-xs-1'>Quadro</th>
                            <th class='col-xs-1'>Email</th>
                            <th class='col-xs-2'>Unidade</th>
                            <th class='col-xs-2'>Papéis</th>
                            <th class='col-xs-2'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->rg }}</td>
                            <td>{{ $user->nome }}</td>
                            <td>{{ $user->cargo }}</td>
                            <td>{{ $user->quadro }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->opm_descricao }}</td>
                            <td>{{ $user->roles()->pluck('name')->implode('/') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('user.restore', $user->id) }}" class="btn btn-info">
                                        <i class="fa fa-recycle"></i>
                                    </a>
                                    <a href="{{ route('user.forceDelete', $user->id) }}" class="btn btn-danger" onclick='return confirm("Você tem certeza?");'>
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class='col-xs-1'>RG</th>
                            <th class='col-xs-2'>Nome</th>
                            <th class='col-xs-1'>Posto/Grad</th>
                            <th class='col-xs-1'>Quadro</th>
                            <th class='col-xs-1'>Email</th>
                            <th class='col-xs-2'>Unidade</th>
                            <th class='col-xs-2'>Papéis</th>
                            <th class='col-xs-2'>Ações</th>
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