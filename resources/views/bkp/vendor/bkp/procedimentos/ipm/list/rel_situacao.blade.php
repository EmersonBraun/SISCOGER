@extends('adminlte::page')

@section('title', 'IPM - Rel. Sit.')

@section('content_header')
<section class="content-header">   
  <h1>IPM - Relatório de Situação</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">IPM - Relatório de Situação</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
    <div class='btn-group col-md-8 col-xs-12 ' style='padding-left: 0px'>
      <a class="btn btn-default col-md-2 col-xs-4 "  href="{{route('ipm.lista')}}">Lista</a>
      <a class="btn btn-default col-md-2 col-xs-4 "  href="{{route('ipm.andamento')}}">Andamento</a>
      <a class="btn btn-default col-md-2 col-xs-4 "  href="{{route('ipm.prazos')}}">Prazos</a>  
      <a class="btn btn-success col-md-2 col-xs-4 "  href="{{route('ipm.rel_situacao')}}">Rel. Situação</a> 
      <a class="btn btn-default col-md-2 col-xs-4 "  href="{{route('ipm.resultado')}}">Resultado</a> 
    </div>
    <div class='col-md-4 col-xs-6 '>
        <a class="btn btn-block btn-primary"  href="{{route('ipm.create')}}">
        <i class="fa fa-plus "></i> Adicionar IPM</a>
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
                <h3 class="box-title">Listagem de Inquérito Policial Militar</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-2 col-md-2'>N°/Ano</th>
                    <th class='col-xs-2 col-md-2'>OPM</th>
                    <th class='col-xs-1 col-md-1'>Fato</th>
                    <th class='col-xs-1 col-md-1'>Abertura</th> 
                    <th class='col-xs-1 col-md-1'>Autuação</th>
                    <th class='col-xs-5 col-md-5'>Check</th>
                  </tr>
                  </thead>
  
                  <tbody>
                     @foreach($registros as $registro)
                  <tr>
                    <td style="display: none">{{$registro['id_ipm']}}</td>
                    <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                    <td>{{opm($registro['cdopm'])}}</td>
                    <td>{{data_br($registro['fato_data']) }}</td> 
                    <td>{{data_br($registro['abertura_data']) }}</td>
                    <td>{{data_br($registro['autuacao_data']) }}</td>
                    <td>
                        <span>
                        @if ($registro['relato_enc_file'])
                            <i class="fa fa-check" style='color: green'></i>
                        @else
                            <i class="fa fa-times" style='color: red'></i>
                        @endif
                            Rel. Encarregado</br>
                        @if ($registro['relato_cmtopm_file'])
                            <i class="fa fa-check" style='color: green'></i>
                        @else
                            <i class="fa fa-times" style='color: red'></i>
                        @endif
                            Rel. OPM</br>
                        @if ($registro['relato_cmtgeral_file'])
                            <i class="fa fa-check" style='color: green'></i>
                        @else
                            <i class="fa fa-times" style='color: red'></i>
                        @endif
                            Rel. CMT Geral</br>
                    </td> 
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <th style="display: none">#</th>
                    <th class='col-xs-2 col-md-2'>N°/Ano</th>
                    <th class='col-xs-2 col-md-2'>OPM</th>
                    <th class='col-xs-1 col-md-1'>Fato</th>
                    <th class='col-xs-1 col-md-1'>Abertura</th> 
                    <th class='col-xs-1 col-md-1'>Autuação</th>
                    <th class='col-xs-5 col-md-5'>Check</th>
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