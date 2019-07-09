@extends('adminlte::page')

@section('title', 'Deserção - Lista')

@section('content_header')
<section class="content-header nopadding">  
    @component('components.treeview',['title' => 'Deserção - Lista','opts' => []])
    @endcomponent   
    
    @component('components.menu',
    [
        'title' => 'Deserção',
        'prop' => ['8','4'],
        'menu' => [
            ['md'=> 6, 'xs'=> 6, 'route'=>'desercao.lista','name'=>'Lista','type' => 'success'],
            ['md'=> 6, 'xs'=> 6, 'route'=>'desercao.rel_situacao','name'=>'Rel. Situação']
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
                <h3 class="box-title">Listagem de Deserção</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-2 col-md-2'>N°/Ano</th>
                    <th class='col-xs-2 col-md-2'>OPM</th>
                    <th class='col-xs-2 col-md-2'>Desertor</th>
                    <th class='col-xs-2 col-md-2'>RG</th>
                    <th class='col-xs-2 col-md-2'>Documento</th>
                    <th class='col-xs-2 col-md-2'>Ações</th>     
                  </tr>
                  </thead>
  
                  <tbody>
                     @foreach($registros as $registro)
                  <tr>
                    <td style="display: none">{{$registro['id_desercao']}}</td>
                    <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                    <td>{{opm($registro['cdopm'])}}</td>
                    <td>{{$registro['nome']}}</td> 
                    <td><a href="{{route('fdi.show',$registro['rg'])}}" target="_blanck">{{$registro['rg']}}</a></td>
                    <td>{{$registro['doc_tipo']}} Nº {{$registro['doc_numero']}}</td>  
                    <td>
                        <span>
                        <a class="btn btn-default" href="{{route('desercao.show',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i class="fa fa-fw fa-eye "></i></a>
                        <a class="btn btn-info" href="{{route('desercao.edit',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i class="fa fa-fw fa-edit "></i></a>
                        <a class="btn btn-danger"  href="{{route('desercao.destroy',$registro['id_desercao'])}}" onclick="confirmApagar('desercao',$registro['sjd_ref'],$registro['sjd_ref_ano'])"><i class="fa fa-fw fa-trash-o "></i></a>
                        </span>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                      <th style="display: none">#</th>
                      <th>N°/Ano</th>
                      <th>OPM</th>
                      <th>Desertor</th>
                      <th>RG</th>
                      <th>Documento</th>
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