@extends('adminlte::page')

@section('title_postfix', '| Permissões')

@section('content_header')
<section class="content-header">   
  <h1><i class="fa fa-key"></i> Gerenciamento de permissões</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Gerenciamento de permissões</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
    <div class='btn-group col-md-4 col-xs-12 '>
      <a href="{{ route('users.index') }}" class="btn btn-default btn-block">Usuários</a>
    </div>
    <div class='btn-group col-md-4 col-xs-12 '>
      <a href="{{ route('roles.index') }}" class="btn btn-default btn-block">
         Papéis</a>
    </div>
    <div class='btn-group col-md-4 col-xs-12 '>
      <a href="{{ route('permissions.create') }}" class="btn btn-success btn-block">
          <i class="fa fa-plus "></i> Adicionar Permissões</a>
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
                <h3 class="box-title">Listagem de permissões</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col'>Permissões</th>
                    <th class='col'>Ações</th> 
                  </tr>
                  </thead>
  
                  <tbody>
                @foreach ($permissions as $permission)
                <tr>
                    <td style="display: none">{{$permission->id}}</td>
                    <td>{{ $permission->name }}</td> 
                    <td>
                    <a href="{{ route('permissions.edit',$permission->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Você tem certeza?");']) !!}
                    {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th style="display: none">#</th>
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