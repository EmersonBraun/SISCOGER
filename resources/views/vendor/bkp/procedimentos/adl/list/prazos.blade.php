@extends('adminlte::page')

@section('title', 'ADL - Andamento')

@section('content_header')
<section class="content-header nopadding"> 
    @component('components.treeview',
    [
      'title' => 'ADL - Andamento',
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
        ['md'=> 2, 'xs'=> 4, 'route'=>'adl.prazos','name'=>'Prazos','type'=>'success'],
        ['md'=> 2, 'xs'=> 4, 'route'=>'adl.rel_situacao','name'=>'Rel. Situação'],
        ['md'=> 2, 'xs'=> 4, 'route'=>'adl.julgamento','name'=>'Julgamento']
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
                    <th class='col-xs-1 col-md-1'>N°/Ano</th>
                    <th class='col-xs-1 col-md-1'>Data</th>
                    <th class='col-xs-2 col-md-2'>Presidente</th>
                    <th class='col-xs-2 col-md-2'>Andamento</th>
                    <th class='col-xs-2 col-md-2'>Andamento COGER</th>
                    <th class='col-xs-1 col-md-1'>Sobrestamento</th>
                    <th class='col-xs-2 col-md-2'>Motivo Sobrestamento</th>
                    <th class='col-xs-1 col-md-1'>Prazo</th>     
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
                    <td>{{ data_br($registro['abertura_data']) }}</td>
                    <td>{{$registro['cargo']}} {{special_ucwords($registro['nome'])}}</td>
                    <td>{{sistema('andamento',$registro['id_andamento'])}}</td>
                    <td>{{sistema('andamentocoger',$registro['id_andamentocoger'])}}</td>
                    
                    <td>
                      @if($registro['dusobrestado'] == '' || $registro['dusobrestado'] == NULL)
                        <span class='label label-success'>0</span>
                      @else
                        <span class='label label-info'>{{$registro['dusobrestado']}}</span>
                      @endif
                    </td>

                    {{--motivo do sobrestamento--}}
                    <td>
                      @if ( sistema('andamento',$registro['id_andamento']) == 'SOBRESTADO') 
                        @if ($registro['motivo']=='' || $registro['motivo']=='outros')
                          {{$registro['motivo_outros']}}
                        @else
                          {{$registro['motivo']}}
                        @endif
                      @else
                        <span class='label label-success'>Não Sobrest.</span>
                      @endif
                    </td>
                    
                      {{--andamento--}}
                    <td>
                      @if ( sistema('andamento',$registro["id_andamento"]) == 'ANDAMENTO')
                        @if ($registro['dutotal'])
                          @if ($registro["diasuteis"]>30) 
                            {{$registro['diasuteis']}}
                          @else 
                            {{$registro['diasuteis']}}
                          @endif
                        @else 
                        <span class='label label-error'>S/Data abertura</span>
                        @endif
                      @elseif ( sistema('andamento',$registro["id_andamento"]) == 'CONCLUÍDO')
                        <span class='label label-success'>Concluido</span>
                      @elseif (sistema('andamento',$registro['id_andamento']) == '') 
                        <span class='label label-danger'>S/Andamento</span>
                      @elseif ( sistema('andamento',$registro['id_andamento']) == 'SOBRESTADO') 
                        <span class='label label-error'>Sobrestado</span>
                      @endif 
                    </td>
                  </tr>

                  @endforeach
                  </tbody>

                  <tfoot>
                      <tr>
                        <th style="display: none">#</th>
                        <th class='col-xs-1 col-md-1'>N°/Ano</th>
                        <th class='col-xs-1 col-md-1'>Data</th>
                        <th class='col-xs-2 col-md-2'>Presidente</th>
                        <th class='col-xs-2 col-md-2'>Andamento</th>
                        <th class='col-xs-2 col-md-2'>Andamento COGER</th>
                        <th class='col-xs-1 col-md-1'>Sobrestamento</th>
                        <th class='col-xs-2 col-md-2'>Motivo Sobrestamento</th>
                        <th class='col-xs-1 col-md-1'>Prazo</th>      
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
