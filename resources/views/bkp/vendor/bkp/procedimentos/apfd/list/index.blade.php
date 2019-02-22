@extends('adminlte::page')

@section('title', 'APFD - Lista')

@section('content_header')
<section class="content-header nopadding">  
  @component('components.treeview',
  [
      'title' => 'APFD - Lista',
      'opts' => []
  ])
  @endcomponent   
  
  @component('components.menu',
  [
      'title' => 'APFD',
      'prop' => ['8','4'],
      'menu' => [
          ['md'=> 6, 'xs'=> 6, 'route'=>'apfd.lista','name'=>'lista','type' => 'success'],
          ['md'=> 6, 'xs'=> 6, 'route'=>'apfd.rel_situacao','name'=>'Rel. Situação']
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
                    <th class='col-xs-1 col-md-1'>N°/Ano</th>
                    <th class='col-xs-1 col-md-1'>Tipo</th>
                    <th class='col-xs-2 col-md-2'>Tipificação</th>
                    <th class='col-xs-2 col-md-2'>OPM</th>
                    <th class='col-xs-4 col-md-4'>Sintese</th>
                    <th class='col-xs-2 col-md-2'>Ações</th>     
                  </tr>
                  </thead>
  
                  <tbody>
                     @foreach($registros as $registro)
                  <tr>
                    <td style="display: none">{{$registro['id_apfd']}}</td>
                    <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                    <td>{{opm($registro['cdopm'])}}</td>
                    <td>{{$registro['tipo']}}</td>
                    <td>{{$registro['tipo_penal']}}/{{$registro['tipo_penal_novo']}}</td>
                    <td>{{$registro['sintese_txt']}}</td>
                    <td>
                        <span>
                        <a class="btn btn-default" href="{{route('apfd.show',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i class="fa fa-fw fa-eye "></i></a>
                        <a class="btn btn-info" href="{{route('apfd.edit',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i class="fa fa-fw fa-edit "></i></a>
                        <a class="btn btn-danger"  href="{{route('apfd.destroy',$registro['id_apfd'])}}" onclick="confirmApagar('apfd',$registro['sjd_ref'],$registro['sjd_ref_ano'])"><i class="fa fa-fw fa-trash-o "></i></a>
                        </span>
                    </td>   
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th style="display: none">#</th>
                    <th>N°/Ano</th>
                    <th>Tipo</th>
                    <th>Tipificação</th>
                    <th>OPM</th>
                    <th>Sintese</th>
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