@extends('adminlte::page')

@section('title', 'CD - Lista')

@section('content_header')
<section class="content-header nopadding">  
  @component('components.treeview',
  [
      'title' => 'CD - Lista',
      'opts' => []
  ])
  @endcomponent   
  
  @component('components.menu',
  [
      'title' => 'CD',
      'prop' => ['8','4'],
      'menu' => [
          ['md'=> 2, 'xs'=> 4, 'route'=>'cd.lista','name'=>'Lista','type' => 'success'],
          ['md'=> 3, 'xs'=> 4, 'route'=>'cd.andamento','name'=>'Andamento'],
          ['md'=> 2, 'xs'=> 4, 'route'=>'cd.prazos','name'=>'Prazos'],
          ['md'=> 3, 'xs'=> 4, 'route'=>'cd.rel_situacao','name'=>'Rel. Situação'],
          ['md'=> 2, 'xs'=> 4, 'route'=>'cd.julgamento','name'=>'Julgamento']
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
                <h3 class="box-title">Listagem de Conselhos de Disciplina</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-2 col-md-2'>N°/Ano</th>
                    <th class='col-xs-2 col-md-2'>Motivo</th>
                    <th class='col-xs-6 col-md-6'>Sintese</th>
                    <th class='col-xs-2 col-md-2'>Ações</th>     
                  </tr>
                  </thead>
  
                  <tbody>
                     @foreach($registros as $registro)
                  <tr>
                    <td  style="display: none">{{$registro['id_cd']}}</td>
                    <td class='col-xs-2 col-md-2'>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                    @if($registro['id_decorrenciaconselho'] == 13)
                    <td>Outros ({{$registro['outromotivo']}})</td>
                    @else
                    <td>{{sistema('decorrenciaConselho',$registro['id_decorrenciaconselho'])}}</td>
                    @endif
                    <td class='col-xs-6 col-md-6'>{{$registro['sintese_txt']}}</td>
                    <td class='col-xs-3 col-md-3'>
                        <span>
                        <a class="btn btn-default" href="{{route('cd.show',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i class="fa fa-fw fa-eye "></i></a>
                        <a class="btn btn-info" href="{{route('cd.edit',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i class="fa fa-fw fa-edit "></i></a>
                        <a class="btn btn-danger"  href="{{route('cd.destroy',$registro['id_cd'])}}" onclick="confirmApagar('cd',$registro['sjd_ref'],$registro['sjd_ref_ano'])"><i class="fa fa-fw fa-trash-o "></i></a>
                        </span>
                    </td>   
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-2 col-md-2'>N°/Ano</th>
                    <th class='col-xs-2 col-md-2'>Motivo</th>
                    <th class='col-xs-6 col-md-6'>Sintese</th>
                    <th class='col-xs-2 col-md-2'>Ações</th>
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