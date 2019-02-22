@extends('adminlte::page')

@section('title', 'IT - Prazos')

@section('content_header')
<section class="content-header">   
  <h1>IT - Prazos</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">IT - Prazos</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
    <div class='btn-group col-md-8 col-xs-12 ' style='padding-left: 0px'>
      <a class="btn btn-default col-md-2 col-xs-4 "  href="{{route('it.lista')}}">Lista</a>
      <a class="btn btn-default col-md-2 col-xs-4 "  href="{{route('it.andamento')}}">Andamento</a>
      <a class="btn btn-success col-md-2 col-xs-4 "  href="{{route('it.prazos')}}">Prazos</a>  
      <a class="btn btn-default col-md-2 col-xs-4 "  href="{{route('it.rel_valores')}}">Rel. Valores</a> 
    </div>
    <div class='col-md-4 col-xs-6 '>
        <a class="btn btn-block btn-primary"  href="{{route('it.create')}}">
        <i class="fa fa-plus "></i> Adicionar IT</a>
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
                <h3 class="box-title">Listagem de Inquérito Técnico</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-2 col-md-2'>N°/Ano</th>
                    <th class='col-xs-2 col-md-2'>OPM</th>
                    <th class='col-xs-2 col-md-2'>Abertura</th>
                    <th class='col-xs-2 col-md-2'>Sobrestamento</th>
                    <th class='col-xs-2 col-md-2'>Motivo Sobrestamento</th>
                    <th class='col-xs-2 col-md-2'>Prazo</th>     
                  </tr>
                  </thead>
  
                  <tbody>
                     @foreach($registros as $registro)
                  <tr>
                    <td style="display: none">{{$registro['id_it']}}</td>
                    <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                    <td>{{opm($registro['cdopm'])}}</td>
                    <td>{{$registro['cargo']}} {{special_ucwords($registro['nome'])}}</td>
                    <td>{{ data_br($registro['abertura_data']) }}</td>
                    <td>
                    @if($registro['dusobrestado'] == '' || $registro['dusobrestado'] == NULL)
                      <span class='label label-success'>0</span>
                    @else
                      <span class='label label-info'>{{$registro['dusobrestado']}}</span>
                    @endif
                    </td>
                    {{--motivo do sobrestamento--}}
                      @if ( sistema('andamento',$registro['id_andamento']) == 'SOBRESTADO') 
                        @if ($registro['motivo']=='' || $registro['motivo']=='outros')
                          <td class='col-xs-2 col-md-2'>{{$registro['motivo_outros']}}</td>
                        @else
                          <td class='col-xs-2 col-md-2'>{{$registro['motivo']}}</td>
                        @endif
                      @else
                        <td class='col-xs-2 col-md-2'>
                          <span class='label label-success'>Não Sobrest.</span>
                        </td>
                      @endif
                      {{--andamento--}}
                      @if ( sistema('andamento',$registro["id_andamento"]) == 'ANDAMENTO')
                        @if ($registro['dutotal'])
                          @if ($registro["diasuteis"]>30) 
                          <td class='col-xs-2 col-md-2'>{{$registro['diasuteis']}}</td>
                          @else 
                          <td class='col-xs-2 col-md-2'>{{$registro['diasuteis']}}</td>
                          @endif
                        @else 
                        <td class='col-xs-2 col-md-2'>
                          <span class='label label-error'>S/Data abertura</span>
                        </td>
                        @endif
                      @elseif ( sistema('andamentocd',$registro["id_andamento"]) == 'CONCLUÍDO')
                        <td class='col-xs-2 col-md-2'>
                          <span class='label label-success'>Concluido</span>
                        </td>
                      @elseif (sistema('andamentocd',$registro['id_andamento']) == '') 
                        <td class='col-xs-2 col-md-2'>
                          <span class='label label-danger'>S/Andamento</span>
                        </td>
                      @elseif ( sistema('andamentocd',$registro['id_andamento']) == 'SOBRESTADO') 
                        <td class='col-xs-2 col-md-2'>
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
                      <th class='col-xs-2 col-md-2'>Abertura</th>
                      <th class='col-xs-2 col-md-2'>Sobrestamento</th>
                      <th class='col-xs-2 col-md-2'>Motivo Sobrestamento</th>
                      <th class='col-xs-2 col-md-2'>Prazo</th>     
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
