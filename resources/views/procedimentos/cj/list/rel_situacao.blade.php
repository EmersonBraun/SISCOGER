@extends('adminlte::page')

@section('title', 'CJ - Rel. Sit.')

@section('content_header')
    @include('procedimentos.cj.list.menu', ['title' => 'Rel. Situação','page' => 'rel_situacao'])
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
                <h3 class="box-title">Listagem de Conselhos de Justificação</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                    <table id="datable" class="table table-bordered table-striped">
  
                        <thead>
                            <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2 col-md-2'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>Fato</th>
                            <th class='col-xs-2 col-md-2'>Portaria</th>
                            <th class='col-xs-2 col-md-2'>Parecer</th>  
                            <th class='col-xs-4 col-md-4'>Check</th>
                            </tr>
                        </thead>
        
                        <tbody>
                            @foreach($registros as $registro)
                        <tr>
                            <td  style="display: none">{{$registro['id_cj']}}</td>
                            @if ($registro['sjd_ref'] != '')
                            <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                            @else
                            <td>{{$registro['id_cj']}}</td>
                            @endif
                            <td>{{data_br($registro['fato_data']) }}</td> 
                            <td>
                                {{data_br($registro['portaria_data'])}}
                            </td> 
                            <td>
                                {{data_br($registro['prescricao_data'])}}
                            </td> 
                            <td>
                                <span>
                                @if ($registro['libelo_file'])
                                    <i class="fa fa-check" style='color: green'></i>
                                @else
                                    <i class="fa fa-times" style='color: red'></i>
                                @endif
                                    Libelo</br>
                                @if ($registro['parecer_file'])
                                    <i class="fa fa-check" style='color: green'></i>
                                @else
                                    <i class="fa fa-times" style='color: red'></i>
                                @endif
                                    Parecer</br>
                                @if ($registro['decisao_file'])
                                    <i class="fa fa-check" style='color: green'></i>
                                @else
                                    <i class="fa fa-times" style='color: red'></i>
                                @endif
                                    Decisão</br>
                                @if ($registro['rec_ato_file'])
                                    <i class="fa fa-check" style='color: green'></i>
                                @else
                                    <i class="fa fa-times" style='color: red'></i>
                                @endif
                                    Rec. Ato</br>
                            </td> 
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="display: none">#</th>
                                <th>N°/Ano</th>
                                <th>Fato</th>
                                <th>Portaria</th>
                                <th>Parecer</th>  
                                <th>Check</th>
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