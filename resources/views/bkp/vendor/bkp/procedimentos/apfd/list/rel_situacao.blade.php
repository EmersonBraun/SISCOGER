@extends('adminlte::page')

@section('title', 'APFD - Rel. Sit.')

@section('content_header')
<section class="content-header nopadding"> 
  @component('components.treeview',
  [
      'title' => 'APFD - Relatório de Situação',
      'opts' => []
  ])
  @endcomponent   
  
  @component('components.menu',
  [
      'title' => 'APFD',
      'prop' => ['8','4'],
      'menu' => [
          ['md'=> 6, 'xs'=> 6, 'route'=>'apfd.lista','name'=>'lista'],
          ['md'=> 6, 'xs'=> 6, 'route'=>'apfd.rel_situacao','name'=>'Rel. Situação','type' => 'success']
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
                <h3 class="box-title">Listagem de Autos de prisão em flagrante delito</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-1 col-md-1'>N°</th>
                    <th class='col-xs-1 col-md-1'>OPM</th>
                    <th class='col-xs-2 col-md-2'>Policial</th>
                    <th class='col-xs-1 col-md-1'>Fato</th>
                    <th class='col-xs-1 col-md-1'>Crime</th>  
                    <th class='col-xs-2 col-md-2'>Especificar</th>
                    <th class='col-xs-2 col-md-2'>Publicação</th>
                    <th class='col-xs-2 col-md-2'>Andamento</th>
                  </tr>
                  </thead>
  
                  <tbody>
                    @foreach($registros as $registro)
                  <tr>
                    <td style="display: none">{{$registro['id_apfd']}}</td> 
                    <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                    <td>{{opm($registro['cdopm'])}}</td>
                    <td>{{$registro['cargo']}} {{special_ucwords($registro['nome'])}}</td>
                    <td>{{data_br($registro['fato_data']) }}</td> 
                    <td>{{$registro['tipo']}}</td> 
                    @if($registro["tipo_penal_novo"]=="Outros")
                    <td>{{$registro['especificar']}}</td>
                    @else
                    <td>{{$registro['tipo_penal_novo']}}</td> 
                    @endif
                    <td>{{$registro['doc_tipo']}} 
                        @if($registro['doc_numero'] != '') nº:{{$registro['doc_numero']}} @else s/nº @endif
                    </td> 
                    <td>{{sistema('andamentocoger',$registro['id_andamentocoger'])}}</td> 
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th style="display: none">#</th>
                      <th class='col-xs-1 col-md-1'>N°</th>
                      <th class='col-xs-1 col-md-1'>OPM</th>
                      <th class='col-xs-2 col-md-2'>Policial</th>
                      <th class='col-xs-1 col-md-1'>Fato</th>
                      <th class='col-xs-1 col-md-1'>Crime</th>  
                      <th class='col-xs-2 col-md-2'>Especificar</th>
                      <th class='col-xs-2 col-md-2'>Publicação</th>
                      <th class='col-xs-2 col-md-2'>Andamento</th>
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