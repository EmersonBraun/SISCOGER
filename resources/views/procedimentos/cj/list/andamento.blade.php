@extends('adminlte::page')

@section('title', 'CJ - Andamento ')

@section('content_header')
<section class="content-header nopadding">  
   
  @component('components.treeview',['title' => 'CJ - Andamento','opts' => []])
  @endcomponent   
  
  @component('components.menu',
  [
      'title' => 'CJ',
      'prop' => ['8','4'],
      'menu' => [
          ['md'=> 2, 'xs'=> 4, 'route'=>'cj.lista','name'=>'Lista'],
          ['md'=> 3, 'xs'=> 4, 'route'=>'cj.andamento','name'=>'Andamento','type' => 'success'],
          ['md'=> 2, 'xs'=> 4, 'route'=>'cj.prazos','name'=>'Prazos'],
          ['md'=> 3, 'xs'=> 4, 'route'=>'cj.rel_situacao','name'=>'Rel. Situação'],
          ['md'=> 2, 'xs'=> 4, 'route'=>'cj.julgamento','name'=>'Julgamento']
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
                    <th class='col-xs-1 col-md-1'>N°/Ano</th>
                    <th class='col-xs-1 col-md-1'>Fato</th>
                    <th class='col-xs-1 col-md-1'>Portaria</th>
                    <th class='col-xs-1 col-md-1'>Prescrição</th>
                    <th class='col-xs-2 col-md-2'>Presidente</th>
                    <th class='col-xs-2 col-md-2'>Andamento</th>
                    <th class='col-xs-2 col-md-2'>Andamento COGER</th>
                    <th class='col-xs-2 col-md-2'>Ações</th>     
                  </tr>
                  </thead>
  
                  <tbody>
                     @foreach($registros as $registro)
                  <tr>
                    <td  style="display: none">{{$registro['id_cj']}}</td>
                    <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                    <td>{{data_br($registro['fato_data'])}}</td>
                    <td>{{data_br($registro['portaria_data'])}}</td>
                    <td>{{data_br($registro['prescricao_data'])}}</td>
                    <td>{{$registro['cargo']}} {{special_ucwords($registro['nome'])}}</td>
                    <td>{{sistema('andamento',$registro['id_andamento'])}}</td>
                    <td>{{sistema('andamentocoger',$registro['id_andamentocoger'])}}</td>
                    <td>
                         <span>
                        <a class="btn btn-default" href="{{route('cj.show',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i class="fa fa-fw fa-eye "></i></a>
                        <a class="btn btn-info" href="{{route('cj.edit',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i class="fa fa-fw fa-edit "></i></a>
                        <a class="btn btn-danger"  href="{{route('cj.destroy',$registro['id_cj'])}}"><i class="fa fa-fw fa-trash-o "></i></a>
                        </span>
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
                      <th>Presidente</th>
                      <th>Andamento</th>
                      <th>Andamento COGER</th>
                      <th>Ações</th>    
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