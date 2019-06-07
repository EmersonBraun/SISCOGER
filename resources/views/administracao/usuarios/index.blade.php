@extends('adminlte::page')

@section('title_postfix', '| usuários')

@section('content_header')
<section class="content-header">   
  <h1><i class="fa fa-key"></i> Gerenciamento de Usuários</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Gerenciamento de Usuários</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
    <div class='btn-group col-md-4 col-xs-12 '>
      <a href="{{ route('users.create') }}" class="btn btn-success btn-block">
          <i class="fa fa-plus "></i> Adicionar Usuários</a>
    </div>
    <div class='btn-group col-md-4 col-xs-12 '>
      <a href="{{ route('roles.index') }}" class="btn btn-default btn-block">
          Papéis</a>
    </div>
    <div class='btn-group col-md-4 col-xs-12 '>
      <a href="{{ route('permissions.index') }}" class="btn btn-default btn-block">
          Permissões</a>
    </div>
  <div>
</section>  
@stop

@section('content')
<section>

  <div class="col-md-12">

    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Listagem de Usuários</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="datable" class="table table-bordered table-striped">

          <thead>
              <tr>
                  <th class='col-xs-1 col-md-1'>#</th>
                  <th class='col-xs-1 col-md-1'>RG</th>
                  <th class='col-xs-2 col-md-2'>Email</th>
                  <th class='col-xs-2 col-md-2'>Unidade</th>
                  <th class='col-xs-2 col-md-2'>Papéis</th>
                  <th class='col-xs-4 col-md-4'>Ações</th>
              </tr>
          </thead>

          <tbody>
            @foreach ($users as $user)
              <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->rg }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->opm_descricao }}</td>
                  <td>{{ $user->roles()->pluck('name')->implode('/') }}</td>
                  <td>
                    <div class="btn-group">
                      <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Editar</a>
                      {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id],'style' => 'display: inline' ]) !!}
                      {!! Form::submit('Apagar', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Você tem certeza?");','style' => 'display: inline']) !!}
                      {!! Form::close() !!}
                  @if($user->block == '0')
                    <a href="{{ route('users.block', $user->id) }}" class="btn btn-warning" style="">Bloquear</a>
                  @else
                    <a href="{{ route('users.unblock', $user->id) }}" class="btn btn-success" style="">Desbloquear</a>
                  @endif
                    </div>
                  </td>
                  
                  
              </tr>
              @endforeach
          </tbody>

          <tfoot>
            <tr>
                <th class='col-xs-1 col-md-1'>#</th>
                  <th class='col-xs-1 col-md-1'>RG</th>
                  <th class='col-xs-2 col-md-2'>Email</th>
                  <th class='col-xs-2 col-md-2'>Unidade</th>
                  <th class='col-xs-2 col-md-2'>Papéis</th>
                  <th class='col-xs-4 col-md-4'>Ações</th>
            </tr>
          </tfoot>

        </table>
        
      </div>
      <!-- /.box-body -->
    </div>

  </div>

</section>

@stop

@section('css')
    
@stop

@section('js')
  @include('vendor.adminlte.includes.tabelas')
@stop