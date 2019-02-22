@extends('adminlte::page')

@section('title', 'CJ - Julgamento')

@section('content_header')
<section class="content-header nopadding"> 
  @component('components.treeview',
  [
      'title' => 'CJ - Julgamento',
      'opts' => []
  ])
  @endcomponent   
  
  @component('components.menu',
  [
      'title' => 'CJ',
      'prop' => ['8','4'],
      'menu' => [
          ['md'=> 2, 'xs'=> 4, 'route'=>'cj.lista','name'=>'Lista'],
          ['md'=> 3, 'xs'=> 4, 'route'=>'cj.andamento','name'=>'Andamento'],
          ['md'=> 2, 'xs'=> 4, 'route'=>'cj.prazos','name'=>'Prazos'],
          ['md'=> 3, 'xs'=> 4, 'route'=>'cj.rel_situacao','name'=>'Rel. Situação'],
          ['md'=> 2, 'xs'=> 4, 'route'=>'cj.julgamento','name'=>'Julgamento','type' => 'success']
      ]
  ])   
  @endcomponent   
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
                <h3 class="box-title">Listagem de Conselhos de Justificação</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <table id="datable" class="table table-bordered table-striped">
  
                      <thead>
                      <tr>
                        <th style="display: none">#</th>
                        <th class='col-xs-2 col-md-2'>N°/Ano</th>
                        <th class='col-xs-2 col-md-2'>Data</th>
                        <th class='col-xs-2 col-md-2'>Acusado</th>
                        <th class='col-xs-2 col-md-2'>Andamento</th>  
                        <th class='col-xs-2 col-md-2'>Julgamento</th>
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
                        <td>{{data_br($registro['fato_data'])}}</td>
                        <td>{{$registro['cargo']}} {{$registro['nome']}}</td>
                        <td>{{sistema('andamento',$registro['id_andamento'])}}</td>
                        <td>{{$registro['resultado']}}</td>
                      </tr>
                      @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                          <th style="display: none">#</th>
                          <th>N°/Ano</th>
                          <th>Data</th>
                          <th>Acusado</th>
                          <th>Andamento</th>  
                          <th>Julgamento</th> 
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