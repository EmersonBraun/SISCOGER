@extends('adminlte::page')

@section('title_postfix', '| usuários')

@section('content_header')
@include('administracao.usuarios.menu', ['title' => 'Gerenciamento de Usuários','page' => 'usuarios'])
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
                                    @if(hasPermissionTo('editar-usuarios'))
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endif
                                    @if(hasPermissionTo('apagar-usuarios'))
                                        <a href="{{ route('user.destroy', $user->id) }}" class="btn btn-danger" onclick='return confirm("Você tem certeza?");'>
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    @endif
                                   
                                    @if($user->block == 0)
                                        @if(hasPermissionTo('bloquear-usuarios'))     
                                        <a href="{{ route('user.block', $user->id) }}" class="btn btn-warning">
                                            <i class="fa fa-unlock"></i>
                                        </a>
                                        @endif
                                    @else
                                        @if(hasPermissionTo('desbloquear-usuarios'))
                                        <a href="{{ route('user.unblock', $user->id) }}" class="btn btn-secondary">
                                            <i class="fa fa-lock"></i>
                                        </a>
                                        @endif
                                    @endif
                                        <a href="{{ route('user.sendMail', ['id' =>$user->id, 'resend' => true]) }}" class="btn btn-success">
                                            <i class="fa fa-envelope"></i>
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