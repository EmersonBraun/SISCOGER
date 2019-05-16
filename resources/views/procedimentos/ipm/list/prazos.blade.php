@extends('adminlte::page')

@section('title', 'IPM - Prazos')

@section('content_header')
<section class="content-header">   
    <h1>IPM - Prazos</h1>
    <ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">IPM - Prazos</li>
    </ol>
    <br>
    <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
        <div class='btn-group col-md-8 col-xs-12 ' style='padding-left: 0px'>
        <a class="btn btn-default col-md-2 col-xs-4 "  href="{{route('ipm.lista',['ano' => $ano])}}">Lista</a>
        <a class="btn btn-default col-md-2 col-xs-4 "  href="{{route('ipm.andamento',['ano' => $ano])}}">Andamento</a>
        <a class="btn btn-success col-md-2 col-xs-4 "  href="{{route('ipm.prazos',['ano' => $ano])}}">Prazos</a>  
        <a class="btn btn-default col-md-2 col-xs-4 "  href="{{route('ipm.rel_situacao',['ano' => $ano])}}">Rel. Situação</a> 
        <a class="btn btn-default col-md-2 col-xs-4 "  href="{{route('ipm.resultado',['ano' => $ano])}}">Resultado</a> 
        </div>
        <div class='col-md-2 col-xs-6 '>
            <a class="btn btn-block btn-primary"  href="{{route('ipm.create')}}">
            <i class="fa fa-plus "></i> Adicionar IPM</a>
        </div>
        <div class='col-md-2 col-xs-6  pull-right'>
            <div class="pull-right">
            <label for="navegaco">Listar ano: </label>
            <select class="" id="navegacao" data-toggle="tooltip" data-placement="bottom" 
            title="O ano apenas modifica a listagem,os dados continuam sendo inseridos em {{date('Y')}}"> 
                <option selected='selected'> {{ $ano }} </option>
                @for ($i = date('Y'); $i >= 2008; $i--)
                @if($i != $ano)
                    <option onclick="javascript:location.href='{{route('ipm.prazos',['ano' => $i])}}'"> {{ $i }} </option>
                @endif
                @endfor  
            </select> 
            </div>
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
                    <th class='col-xs-2 col-md-2'>Instauração</th>
                    <th class='col-xs-2 col-md-2'>Encarregado</th>
                    <th class='col-xs-2 col-md-2'>Andamento</th> 
                    <th class='col-xs-2 col-md-2'>Prazo decorrido</th>    
                  </tr>
                  </thead>
  
                  <tbody>
                     @foreach($registros as $registro)
                  <tr>
                    <td style="display: none">{{$registro['id_ipm']}}</td>
                    <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                    <td>{{opm($registro['cdopm'])}}</td>
                    <td>{{ data_br($registro['autuacao_data']) }}</td>
                    <td>{{$registro['cargo']}} {{special_ucwords($registro['nome'])}}</td>
                    <td>{{sistema('andamento',$registro['id_andamento'])}}</td>
                    @if ( sistema('andamento',$registro["id_andamento"]) == 'ANDAMENTO')
                        @if ($registro['diasuteis'])
                          @if ($registro["diasuteis"]>60) 
                          <td><span class='label label-danger'>{{$registro['diasuteis']}}</span></td>
                          @else 
                          <td>{{$registro['diasuteis']}}</td>
                          @endif
                        @else 
                        <td>
                          <span class='label label-error'>S/Data abertura</span>
                        </td>
                        @endif
                      @elseif ( sistema('andamento',$registro["id_andamento"]) == 'CONCLUÍDO')
                        <td>
                          <span class='label label-success'>Concluido</span>
                        </td>
                      @elseif (sistema('andamento',$registro['id_andamento']) == '') 
                        <td>
                          <span class='label label-danger'>S/Andamento</span>
                        </td>
                      @elseif ( sistema('andamento',$registro['id_andamento']) == 'SOBRESTADO') 
                        <td>
                          <span class='label label-error'>Sobrestado</span>
                        </td>
                      @endif 
                  </tr>
                  @endforeach
                  </tbody>

                  <tfoot>
                  <tr>
                      <th style="display: none">#</th>
                      <th class='col-xs-2 col-md-2'>N°/Ano</th>
                      <th class='col-xs-2 col-md-2'>OPM</th>
                      <th class='col-xs-2 col-md-2'>Instauração</th>
                      <th class='col-xs-2 col-md-2'>Encarregado</th>
                      <th class='col-xs-2 col-md-2'>Andamento</th> 
                      <th class='col-xs-2 col-md-2'>Prazo decorrido</th>    
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
