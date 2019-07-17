@extends('adminlte::page')

@section('title', 'RECURSOS - Lista')

@section('content_header')
    @include('procedimentos.recurso.list.menu', ['title' => 'Apagados','page' => 'apagados']) 
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
                <h3 class="box-title">Listagem de Recursos</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-2 col-md-2'>N°/Ano</th>
                    <th class='col-xs-2 col-md-2'>Proc.</th>
                    <th class='col-xs-2 col-md-2'>OPM</th>
                    <th class='col-xs-4 col-md-4'>Data-hora do recebimento</th>
                    <th class='col-xs-2 col-md-2'>Ações</th>     
                  </tr>
                  </thead>
  
                  <tbody>
                  @foreach($registros as $registro)
                  <tr>
                    <td style="display: none">{{$registro['id_recurso']}}</td>
                    <td>{{$registro['sjd_ref']}} / {{$registro['sjd_ref_ano']}}</td>
                    <td>{{$registro['procedimento']}}</td>
                    <td>{{opm($registro['cdopm'])}}</td>
                    <td>{{date( 'd/m/Y H:i:s' , strtotime($registro['datahora']))}}</td>
                    <td>
                        <span>
                        <a class="btn btn-default" href="{{route('recurso.show',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i class="fa fa-fw fa-eye "></i></a>
                        <a class="btn btn-info" href="{{route('recurso.edit',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i class="fa fa-fw fa-edit "></i></a>
                        <a class="btn btn-danger"  href="{{route('recurso.destroy',$registro['id_recursos'])}}" onclick="confirmApagar('recursos',$registro['sjd_ref'],$registro['sjd_ref_ano'])"><i class="fa fa-fw fa-trash-o "></i></a>
                        </span>
                    </td>   
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-2 col-md-2'>N°/Ano</th>
                    <th class='col-xs-2 col-md-2'>Proc.</th>
                    <th class='col-xs-2 col-md-2'>OPM</th>
                    <th class='col-xs-4 col-md-4'>Data-hora do recebimento</th>
                    <th class='col-xs-2 col-md-2'>Ações</th> 
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