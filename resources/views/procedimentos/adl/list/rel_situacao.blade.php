@extends('adminlte::page')

@section('title', 'ADL - Rel. Sit')

@section('content_header')
<section class="content-header nopadding"> 
    @component('components.treeview',
    [
        'title' => 'ADL - Relatório de Situação',
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
            ['md'=> 2, 'xs'=> 4, 'route'=>'adl.rel_situacao','name'=>'Rel. Situação','type'=>'success'],
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
        <div class="row ">
          <div class="col-xs-12">
            <!-- /.box -->
  
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Listagem de Apuração Disciplinar de Licenciamento</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">

                <v-table ref="vuetable"
                    api-url="https://vuetable.ratiw.net/api/users"
                    :fields="['name', 'nickname', 'email', 'gender']"
                    data-path=""
                    pagination-path=""
                  >
                </v-table>
                
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
                    <td style="display: none">{{$registro['id_adl']}}</td>
                    <td>{{ $registro->present()->refAno}}</td>
                    <td>{{ $registro->fato_data}}</td> 
                    <td>{{ $registro->portaria_data}}</td>
                    <td>{{ $registro->prescricao_data}}</td> 
                    <td>
                        <span>
                            <i class="fa {{ $registro->present()->libeloIcon }}" style='color: {{ $registro->present()->libeloColor }}'></i>
                            Libelo<br>
                            <i class="fa {{ $registro->present()->parecerIcon }}" style='color: {{ $registro->present()->parecerColor }}'></i>
                            Parecer<br>
                            <i class="fa {{ $registro->present()->decisaoIcon }}" style='color: {{ $registro->present()->decisaoColor }}'></i>
                            Decisão<br>
                            <i class="fa {{ $registro->present()->recAtoIcon }}" style='color: {{ $registro->present()->recAtoColor }}'></i>
                            Rec. Ato<br>
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