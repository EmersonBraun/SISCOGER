@extends('adminlte::page')

@section('title', 'Sindicância - andamento')

@section('content_header')
    @include('procedimentos.sindicancia.list.menu', ['title' => 'Andamento','page' => 'andamento'])  
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
                <h3 class="box-title">Listagem de SINDICÂNCIA</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th class='col-xs-1 col-md-1'>N°/Ano</th>
                    <th class='col-xs-1 col-md-1'>OPM</th>
                    <th class='col-xs-2 col-md-2'>Abertura</th>
                    <th class='col-xs-2 col-md-2'>Andamento</th>
                    <th class='col-xs-2 col-md-2'>Andamento COGER</th>
                    <th class='col-xs-2 col-md-2'>Ações</th>     
                  </tr>
                  </thead>
  
                  <tbody>
                     @foreach($registros as $registro)
                  <tr>
                    <td class='col-xs-2 col-md-2'>{{$registro['sjd_ref']}} / {{$registro['sjd_ref_ano']}}</td>
                    <td class='col-xs-2 col-md-2'>{{opm($registro['cdopm'])}}</td>
                    <td class='col-xs-2 col-md-2'>{{data_br($registro['abertura_data'])}}</td>
                    <td class='col-xs-2 col-md-2'>{{sistema('andamento',$registro['id_andamento'])}}</td>
                    <td class='col-xs-2 col-md-2'>{{sistema('andamentocoger',$registro['id_andamentocoger'])}}</td>
                    <td class='col-xs-3 col-md-3'>
                         <span>
                        <a class="btn btn-default" href="{{route('sindicancia.show',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i class="fa fa-fw fa-eye "></i></a>
                        <a class="btn btn-info" href="{{route('sindicancia.edit',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i class="fa fa-fw fa-edit "></i></a>
                        <a class="btn btn-danger"  href="{{route('sindicancia.destroy',$registro['id_sindicancia'])}}"><i class="fa fa-fw fa-trash-o "></i></a>
                        </span>
                    </td>   
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                      <th class='col-xs-1 col-md-1'>N°/Ano</th>
                      <th class='col-xs-1 col-md-1'>OPM</th>
                      <th class='col-xs-2 col-md-2'>Abertura</th>
                      <th class='col-xs-2 col-md-2'>Andamento</th>
                      <th class='col-xs-2 col-md-2'>Andamento COGER</th>
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