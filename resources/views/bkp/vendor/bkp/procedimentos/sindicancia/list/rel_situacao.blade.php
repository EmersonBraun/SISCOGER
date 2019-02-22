@extends('adminlte::page')

@section('title', 'Sindicância - Rel. Sit.')

@section('content_header')
<section class="content-header nopadding">
    @component('components.treeview',
    [
        'title' => 'Sindicância - Relatório de Situação',
        'opts' => []
    ])
    @endcomponent   
    
    @component('components.menu',
    [
        'title' => 'Sindicância',
        'prop' => ['8','4'],
        'menu' => [
            ['md'=> 2, 'xs'=> 4, 'route'=>'sindicancia.lista','name'=>'Lista'],
            ['md'=> 3, 'xs'=> 4, 'route'=>'sindicancia.andamento','name'=>'Andamento'],
            ['md'=> 2, 'xs'=> 4, 'route'=>'sindicancia.prazos','name'=>'Prazos'],
            ['md'=> 3, 'xs'=> 4, 'route'=>'sindicancia.rel_situacao','name'=>'Rel. Situação'],
            ['md'=> 2, 'xs'=> 4, 'route'=>'sindicancia.resultado','name'=>'resultado','type' => 'success']
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
                <h3 class="box-title">Listagem de SINDICÂNCIA</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th class='col-xs-2 col-md-2'>N°/Ano</th>
                    <th class='col-xs-2 col-md-2'>OPM</th>
                    <th class='col-xs-2 col-md-2'>Fato</th>
                    <th class='col-xs-2 col-md-2'>Despacho</th>  
                    <th class='col-xs-2 col-md-2'>Abertura</th>
                    <th class='col-xs-2 col-md-2'>Check</th>
                  </tr>
                  </thead>
  
                  <tbody>
                     @foreach($registros as $registro)
                  <tr>
                    <td class='col-xs-2 col-md-2'>{{$registro['sjd_ref']}} / {{$registro['sjd_ref_ano']}}</td>
                    <td class='col-xs-2 col-md-2'>{{opm($registro['cdopm'])}}</td>
                    <td class='col-xs-2 col-md-2'>{{date('d/m/Y',strtotime($registro['fato_data'])) }}</td> 
                    <td class='col-xs-2 col-md-2'>
                        {{date('d/m/Y',strtotime($registro['portaria_data']))}}
                    </td> 
                    <td class='col-xs-2 col-md-2'>
                        {{date('d/m/Y',strtotime($registro['abertura_data']))}}
                    </td> 
                    <td class='col-xs-2 col-md-2'>
                        <span>
                        @if ($registro['fato_file'])
                            <i class="fa fa-check" style='color: green'></i>
                        @else
                            <i class="fa fa-times" style='color: red'></i>
                        @endif
                            Imputação</br>
                        @if ($registro['relatorio_file'])
                            <i class="fa fa-check" style='color: green'></i>
                        @else
                            <i class="fa fa-times" style='color: red'></i>
                        @endif
                            Relatório</br>
                        @if ($registro['sol_cmt_file'])
                            <i class="fa fa-check" style='color: green'></i>
                        @else
                            <i class="fa fa-times" style='color: red'></i>
                        @endif
                            Solução</br>
                        @if ($registro['notapunicao_file'])
                            <i class="fa fa-check" style='color: green'></i>
                        @else
                            <i class="fa fa-times" style='color: red'></i>
                        @endif
                            N° Punição</br>
                    </td> 
                  </tr>
                  @endforeach
                  </tbody>
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