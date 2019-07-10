@extends('adminlte::page')

@section('title', 'fatd')

@section('content_header')
    @include('procedimentos.fatd.list.menu', ['title' => 'Rel. Situação','page' => 'rel_situacao'])
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
                <h3 class="box-title">Listagem de Formulários de Transgração Disciplinar</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-2 col-md-2'>N°/Ano</th>
                    <th class='col-xs-2 col-md-2'>OPM</th>
                    <th class='col-xs-2 col-md-2'>Fato</th>
                    <th class='col-xs-2 col-md-2'>Despacho</th>  
                    <th class='col-xs-2 col-md-2'>Abertura</th>
                    <th class='col-xs-2 col-md-2'>Check</th>
                  </tr>
                  </thead>
  
                  <tbody>
                     @foreach($registros as $registro)
                  <tr>
                    <td style="display: none">{{$registro['id_fatd']}}</td>
                    <td class='col-xs-2 col-md-2'>{{$registro['sjd_ref']}} / {{$registro['sjd_ref_ano']}}</td>
                    <td class='col-xs-2 col-md-2'>{{opm($registro['cdopm'])}}</td>
                    <td class='col-xs-2 col-md-2'>{{data_br($registro['fato_data']) }}</td> 
                    <td class='col-xs-2 col-md-2'>
                        {{data_br($registro['portaria_data'])}}
                    </td> 
                    <td class='col-xs-2 col-md-2'>
                        {{data_br($registro['abertura_data'])}}
                    </td> 
                    <td class='col-xs-2 col-md-2'>
                        <span>
                        @if ($registro['fato_file'])
                            <i class="fa fa-check" style='color: green'></i>
                        @else
                            <i class="fa fa-times" style='color: red'></i>
                        @endif
                            Imputação</br>
                        @if ($registro['relatorio_file'])
                            <i class="fa fa-check" style='color: green'></i>
                        @else
                            <i class="fa fa-times" style='color: red'></i>
                        @endif
                            Relatório</br>
                        @if ($registro['sol_cmt_file'])
                            <i class="fa fa-check" style='color: green'></i>
                        @else
                            <i class="fa fa-times" style='color: red'></i>
                        @endif
                            Solução</br>
                        @if ($registro['notapunicao_file'])
                            <i class="fa fa-check" style='color: green'></i>
                        @else
                            <i class="fa fa-times" style='color: red'></i>
                        @endif
                            N° Punição</br>
                    </td> 
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th style="display: none">#</th>
                      <th class='col-xs-2 col-md-2'>N°/Ano</th>
                      <th class='col-xs-2 col-md-2'>OPM</th>
                      <th class='col-xs-2 col-md-2'>Fato</th>
                      <th class='col-xs-2 col-md-2'>Despacho</th>  
                      <th class='col-xs-2 col-md-2'>Abertura</th>
                      <th class='col-xs-2 col-md-2'>Check</th>
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