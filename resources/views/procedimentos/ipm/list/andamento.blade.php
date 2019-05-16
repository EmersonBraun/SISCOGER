@extends('adminlte::page')

@section('title', 'IPM - Andamento')

@section('content_header')
<section class="content-header">   
  <h1>IPM - Andamento</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">IPM - Andamento</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
    <div class='btn-group col-md-8 col-xs-12 ' style='padding-left: 0px'>
      <a class="btn btn-default col-md-2 col-xs-4 "  href="{{route('ipm.lista',['ano' => $ano])}}">Lista</a>
      <a class="btn btn-success col-md-2 col-xs-4 "  href="{{route('ipm.andamento',['ano' => $ano])}}">Andamento</a>
      <a class="btn btn-default col-md-2 col-xs-4 "  href="{{route('ipm.prazos',['ano' => $ano])}}">Prazos</a>  
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
                <option onclick="javascript:location.href='{{route('ipm.andamento',['ano' => $i])}}'"> {{ $i }} </option>
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
                    <th class='col-xs-1 col-md-1'>N°/Ano</th>
                    <th class='col-xs-1 col-md-1'>OPM</th>
                    <th class='col-xs-1 col-md-1'>Data Abertura</th>
                    <th class='col-xs-2 col-md-2'>Encarregado</th>
                    <th class='col-xs-2 col-md-2'>Andamento</th>
                    <th class='col-xs-2 col-md-2'>Andamento COGER</th>
                    <th class='col-xs-3 col-md-3'>Ações</th>     
                  </tr>
                  </thead>
  
                  <tbody>
                     @foreach($registros as $registro)
                  <tr>
                    <td style="display: none">{{$registro['id_ipm']}}</td>
                    <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                    <td>{{opm($registro['cdopm'])}}</td>
                    <td>{{data_br($registro['abertura_data'])}}</td>
                    <td>{{$registro['cargo']}} {{special_ucwords($registro['nome'])}}</td>
                    <td>{{sistema('andamento',$registro['id_andamento'])}}</td>
                    <td>{{sistema('andamentocoger',$registro['id_andamentocoger'])}}</td>
                    <td>
                         <span>
                        <a class="btn btn-default" href="{{route('ipm.show',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i class="fa fa-fw fa-eye "></i></a>
                        <a class="btn btn-info" href="{{route('ipm.edit',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i class="fa fa-fw fa-edit "></i></a>
                        <a class="btn btn-danger"  href="{{route('ipm.destroy',$registro['id_ipm'])}}"><i class="fa fa-fw fa-trash-o "></i></a>
                        </span>
                    </td>   
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                      <th style="display: none">#</th>
                      <th>N°/Ano</th>
                      <th>OPM</th>
                      <th>Data Abertura</th>
                      <th>Encarregado</th>
                      <th>Andamento</th>
                      <th>Andamento COGER</th>
                      <th>Ações</th>  
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