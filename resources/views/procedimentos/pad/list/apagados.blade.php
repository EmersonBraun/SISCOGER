@extends('adminlte::page')

@section('title', 'PAD')

@section('content_header')
    @include('procedimentos.pad.list.menu', ['title' => 'Apagados','page' => 'apagados']) 
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
                <h3 class="box-title">Listagem de PAD</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped table-hover">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col'>N°/Ano</th>
                    <th class='col'>OPM</th>
                    <th class='col'>Abertura</th>
                    <th class='col'>Andamento</th>
                    <th class='col'>Andamento COGER</th>
                    <th class='col'>Sintese</th>
                    <th class='col'>Ações</th>     
                  </tr>
                  </thead>
  
                  <tbody>
                     @foreach($registros as $registro)
                  <tr>
                    <td style="display: none">{{$registro['id_pad']}}</td>
                    <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                    <td>{{opm($registro['cdopm'])}}</td>
                    <td>{{data_br($registro['abertura_data'])}}</td>
                    <td>{{sistema('andamento',$registro['id_andamento'])}}</td>
                    <td>{{sistema('andamentocoger',$registro['id_andamentocoger'])}}</td>
                    <td>{{$registro['sintese_txt']}}</td>
                    <td>
                        <span>
                        <a class="btn btn-default" href="{{route('pad.show',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i class="fa fa-fw fa-eye "></i></a>
                        <a class="btn btn-info" href="{{route('pad.edit',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i class="fa fa-fw fa-edit "></i></a>
                        <a class="btn btn-danger"  href="{{route('pad.destroy',$registro['id_pad'])}}" onclick="confirmApagar('pad',$registro['sjd_ref'],$registro['sjd_ref_ano'])"><i class="fa fa-fw fa-trash-o "></i></a>
                        </span>
                    </td>   
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                      <th style="display: none">#</th>
                      <th class='col'>N°/Ano</th>
                      <th class='col'>OPM</th>
                      <th class='col'>Abertura</th>
                      <th class='col'>Andamento</th>
                      <th class='col'>Andamento COGER</th>
                      <th class='col'>Sintese</th>
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