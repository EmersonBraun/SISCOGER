@extends('adminlte::page')

@section('title', 'IT - Rel. Val.')

@section('content_header')
<section class="content-header">   
  <h1>IT - Relatório Valores</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">IT - Relatório Valores</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
    <div class='btn-group col-md-8 col-xs-12 ' style='padding-left: 0px'>
      <a class="btn btn-default col-md-2 col-xs-4 "  href="{{route('it.lista')}}">Lista</a>
      <a class="btn btn-default col-md-2 col-xs-4 "  href="{{route('it.andamento')}}">Andamento</a>
      <a class="btn btn-default col-md-2 col-xs-4 "  href="{{route('it.prazos')}}">Prazos</a>  
      <a class="btn btn-success col-md-2 col-xs-4 "  href="{{route('it.rel_valores')}}">Rel. Valores</a> 
    </div>
    <div class='col-md-2 col-xs-6 '>
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
                    <th class="col-md-2 col-xs-2">N°/Ano</th>
                    <th class="col-md-2 col-xs-2">OPM</th>
                    <th class="col-md-2 col-xs-2">Viatura</th>
                    <th class="col-md-3 col-xs-3">Dano estimado</th>
                    <th class="col-md-3 col-xs-3">Dano real</th>
                  </tr>
                  </thead>
  
                  <tbody>
                     @foreach($registros as $registro)
                  <tr>
                    <td style="display: none">{{$registro['id_it']}}</td>
                    <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                    <td>{{opm($registro['cdopm'])}}</td>
                    <td>{{$registro['vtr_prefixo']}}, (placa {{$registro['vtr_placa']}})</td>
                    <td>@if($registro['danoestimado_rs'] != '') R$ {{$registro['danoestimado_rs']}}@endif</td>
                    <td>@if($registro['danoreal_rs'] != '') R$ {{$registro['danoreal_rs']}}@endif</td> 
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                        <th style="display: none">#</th>
                        <th class="col-md-2 col-xs-2">N°/Ano</th>
                        <th class="col-md-2 col-xs-2">OPM</th>
                        <th class="col-md-2 col-xs-2">Viatura</th>
                        <th class="col-md-3 col-xs-3">Dano estimado</th>
                        <th class="col-md-3 col-xs-3">Dano real</th>
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