@extends('adminlte::page')

@section('title', 'sobrestamentos')

@section('content_header')

  
@stop

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content">
    <!-- Content Header (Page header) -->
   

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <!-- /.box -->
  
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Listagem de sobrestamentos</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th class='col-xs-2'>N°/Ano</th>
                    <th class='col-xs-2'>SJD</th>
                    <th class='col-xs-2'>COGER</th>
                    <th class='col-xs-2'>OPM</th>
                    <th class='col-xs-2'>sintese</th>
                    <th class='col-xs-2'>Ações</th>
                    
                    
                  </tr>
                  </thead>
  
                  <tbody>
                     @foreach($registros as $registro)
                  <tr>
                    <td>{{$registro->sjd_ref.'/'. $registro->sjd_ref_ano}}</td>
                    <td>{{$registro->andamento}}</td>
                    <td>{{$registro->andamentocoger}}</td>
                    <td>{{ $registro->sobrestamentosopm }}</td>
                    <td>{{ $registro->motivo_outros }}</td>
                    
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                     <th class='col-xs-2'>N°/Ano</th>
                    <th class='col-xs-2'>SJD</th>
                    <th class='col-xs-2'>COGER</th>
                    <th class='col-xs-2'>OPM</th>
                    <th class='col-xs-2'>sintese</th>
                    <th class='col-xs-2'>Ações</th>
                    
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