@extends('adminlte::page')

@section('title', 'ADL - Julgamento')

@section('content_header')
<section class="content-header nopadding">
    @component('components.treeview',
    [
      'title' => 'ADL - Julgamento',
      'opts' => []
    ])
    @endcomponent   
  
    @component('components.menu',
    [
      'title' => 'ADL',
      'prop' => ['8','4'],
      'menu' => [
        ['md'=> 2, 'xs'=> 4, 'route'=>'adl.lista','name'=>'lista'],
        ['md'=> 2, 'xs'=> 4, 'route'=>'adl.andamento','name'=>'Andamento'],
        ['md'=> 2, 'xs'=> 4, 'route'=>'adl.prazos','name'=>'Prazos'],
        ['md'=> 2, 'xs'=> 4, 'route'=>'adl.rel_situacao','name'=>'Rel. Situação'],
        ['md'=> 2, 'xs'=> 4, 'route'=>'adl.julgamento','name'=>'Julgamento','type'=>'success']
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
                <h3 class="box-title">Listagem de Apuração Disciplinar de Licenciamento</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                    <tr>
                      <th style="display: none">#</th>
                      <th class='col-xs-2 col-md-2'>N°/Ano</th>
                      <th class='col-xs-2 col-md-2'>Acusado</th>
                      <th class='col-xs-2 col-md-2'>Andamento</th> 
                      <th class='col-xs-2 col-md-2'>Comissão</th> 
                      <th class='col-xs-2 col-md-2'>CMT Geral</th>  
                      <th class='col-xs-2 col-md-2'>Julgamento</th>
                    </tr>
                  </thead>
  
                  <tbody>
                  @foreach($registros as $registro)
                  <tr>
                    <td style="display: none">{{$registro['id_adl']}}</td>
                    @if ($registro['sjd_ref'] != '')
                    <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                    @else
                    <td>{{$registro['id_adl']}}</td>
                    @endif
                    <td>{{$registro['cargo']}} {{$registro['nome']}}</td>
                    <td>{{sistema('andamento',$registro['id_andamento'])}}</td>
                    <td>{{$registro['parecer_comissao']}}</td>
                    <td>{{$registro['parecer_cmtgeral']}}</td>
                    <td>{{$registro['resultado']}}</td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th style="display: none">#</th>
                      <th>N°/Ano</th>
                      <th>Acusado</th>
                      <th>Andamento</th> 
                      <th>Comissão</th> 
                      <th>CMT Geral</th>  
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