@extends('adminlte::page')

@section('title', 'Deserção')

@section('content_header')
<section class="content-header nopadding">  
    @component('components.treeview',['title' => 'Deserção - Relatório de Situação','opts' => []])
    @endcomponent   
    
    @component('components.menu',
    [
        'title' => 'Deserção',
        'prop' => ['8','4'],
        'menu' => [
            ['md'=> 6, 'xs'=> 6, 'route'=>'desercao.lista','name'=>'Lista'],
            ['md'=> 6, 'xs'=> 6, 'route'=>'desercao.rel_situacao','name'=>'Rel. Situação','type' => 'success']
        ]
    ])   
    @endcomponent 
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
                <h3 class="box-title">Listagem de Deserção</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-1 col-md-1'>N°/Ano</th>
                    <th class='col-xs-1 col-md-1'>OPM</th>
                    <th class='col-xs-2 col-md-2'>Fato</th>
                    <th class='col-xs-2 col-md-2'>Termo 1</th>  
                    <th class='col-xs-2 col-md-2'>Termo captura</th>
                    <th class='col-xs-2 col-md-2'>Perícia</th>
                    <th class='col-xs-2 col-md-2'>Inclusão/Reversão</th>
                  </tr>
                  </thead>
  
                  <tbody>
                     @foreach($registros as $registro)
                  <tr>
                    <td style="display: none">{{$registro['id_desercao']}}</td>
                    <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                    <td>{{opm($registro['cdopm'])}}</td>
                    <td>{{data_br($registro['fato_data']) }}</td>   
                    <td>{{$registro['termo_exclusao']}}</td>  
                    <td>{{$registro['termo_captura']}}</td>  
                    <td>{{$registro['pericia']}}</td>
                    <td>{{$registro['termo_inclusao']}}</td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <th style="display: none">#</th>
                    <th>N°/Ano</th>
                    <th>OPM</th>
                    <th>Fato</th>
                    <th>Termo 1</th>  
                    <th>Termo captura</th>
                    <th>Perícia</th>
                    <th>Inclusão/Reversão</th>
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