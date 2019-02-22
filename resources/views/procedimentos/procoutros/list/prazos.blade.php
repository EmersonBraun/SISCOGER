@extends('adminlte::page')

@section('title', 'PROC. OUTROS')

@section('content_header')
<section class="content-header">   
  <h1>PROC. OUTROS - Andamento</h1>
  <ol class="breadcrumb">
  <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">PROC. OUTROS - Andamento</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
    <div class='btn-group col-md-8 col-xs-12 ' style='padding-left: 0px'>
        <a class="btn btn-default col-md-4 col-xs-4 "  href="{{ route('procoutros.lista') }}">Lista</a>
        <a class="btn btn-default col-md-4 col-xs-4 "  href="{{ route('procoutros.andamento') }}">Andamento</a>
        <a class="btn btn-success col-md-4 col-xs-4 "  href="{{ route('procoutros.prazos') }}">Prazos</a>  
    </div>
    <div class='col-md-4 col-xs-6 '>
        <a class="btn btn-block btn-primary"  href="{{ route('procoutros.create') }}">
        <i class="fa fa-plus "></i> Adicionar PROC. OUTROS</a>
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
        <div class="registro">
          <div class="col-xs-12">
            <!-- /.box -->
  
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Listagem de PROC. OUTROS</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-1 col-md-1'>N°/Ano</th>
                    <th class='col-xs-1 col-md-1'>OPM (Abertura)</th>
                    <th class='col-xs-1 col-md-1'>OPM (Apuração)</th>
                    <th class='col-xs-1 col-md-1'>Abertura</th>
                    <th class='col-xs-1 col-md-1'>Recebimento</th>
                    <th class='col-xs-1 col-md-1'>Data limite</th>
                    <th class='col-xs-1 col-md-1'>Andamento</th>
                    <th class='col-xs-1 col-md-1'>COGER</th>
                    <th class='col-xs-1 col-md-1'>Dias totais</th>  
                    <th class='col-xs-2 col-md-2'>Dias úteis faltando</th>  
                  </tr>
                  </thead>
  
                  <tbody>
                     @foreach($registros as $registro)
                  <tr>
                    <td style="display: none">{{ $registro['id_proc_outros'] }}</td>
                    <td>{{ $registro['sjd_ref'] }}/{{ $registro['sjd_ref_ano'] }}</td>
                    <td>{{ opm($registro['cdopm']) }}</td>
                    <td>{{ opm($registro['cdopm_apuracao']) }}</td>
                    <td>{{  data_br($registro['data'])  }}</td>

                    @if($registro['dutotal']) 
                      <td>{{  data_br($registro['abertura_data'])  }}</td>
                    @else
                      <td><span class='label label-danger'>S/recebimento</span></td>
                    @endif

                    @if($registro['limite_data'] !== '0000-00-00')
                        <td>{{  data_br($registro['limite_data'])  }}</td>
                    @else
                      <td><span class='label label-danger'>S/Data limite</span></td>
                    @endif

                    @if ($registro["andamento"]!="" && $registro["andamento"]!="CONCLUÍDO" && $registro["andamento"]!="SOBRESTADO")
                      <td>{{ $registro['andamento'] }}</td>
                    @elseif ($registro["andamento"]=="CONCLUÍDO") 
                      <td>Concluído</td>
                    @elseif ($registro["andamento"]=="") 
                      <td>S/Andamento</td>
                    @endif

                    <td>{{ $registro['andamentocoger'] }}</td>

                    @if ($registro["dutotal"])
                      <td>U: {{ $registro['dutotal'] }} T: {{ $registro['dtcorridos'] }}</td>
                    @else
                      <td>S/Data recebimento</td>
                    @endif

                    <td>{{ $registro['dufaltando'] }}</td>

                  </tr>
                  @endforeach
                  </tbody>

                  <tfoot>
                  <tr>
                      <th style="display: none">#</th>
                      <th class='col-xs-1 col-md-1'>N°/Ano</th>
                      <th class='col-xs-1 col-md-1'>OPM (Abertura)</th>
                      <th class='col-xs-1 col-md-1'>OPM (Apuração)</th>
                      <th class='col-xs-1 col-md-1'>Abertura</th>
                      <th class='col-xs-1 col-md-1'>Recebimento</th>
                      <th class='col-xs-1 col-md-1'>Data limite</th>
                      <th class='col-xs-1 col-md-1'>Andamento</th>
                      <th class='col-xs-1 col-md-1'>COGER</th>
                      <th class='col-xs-1 col-md-1'>Dias totais</th>  
                      <th class='col-xs-2 col-md-2'>Dias úteis faltando</th>    
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
        <!-- /.registro -->
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
