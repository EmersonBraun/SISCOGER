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
    <div class='btn-group col-md-4 col-xs-12 '>
      <a href="{{ route('users.index') }}" class="btn btn-default btn-block">Usuários</a>
    </div>
    <div class='btn-group col-md-4 col-xs-12 '>
      <a href="{{ route('roles.create') }}" class="btn btn-success btn-block">
        <i class="fa fa-plus "></i> Adicionar papeis</a>
    </div>
    <div class='btn-group col-md-4 col-xs-12 '>
      <a href="{{ route('permissions.index') }}" class="btn btn-default btn-block">Permissões</a>
    </div>
  <div>
</section>
 
@stop

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
   

    <!-- Main content -->
    <section class="">
        <div class="row">
          <div class="col-xs-12">
            <!-- /.box -->
  
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Listagem de papeis</h3>
              </div>
              <!-- /.box-header -->
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
                    <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-info" style="margin-right: 3px;">Editar</i></a>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}
                    {!! Form::submit('Apagar', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Você tem certeza?");']) !!}
                    {!! Form::close() !!}
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
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
  @include('vendor.adminlte.includes.tabelas')
@stop