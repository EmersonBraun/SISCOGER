@extends('adminlte::page')

@section('title', 'adl')

@section('content_header')
<section class="content-header nopadding">  
    @component('components.treeview',
    [
      'title' => 'ADL - Lista',
      'opts' => []
    ])
    @endcomponent   
  
    @component('components.menu',
    [
      'title' => 'ADL',
      'prop' => ['8','4'],
      'menu' => [
        ['md'=> 2, 'xs'=> 4, 'route'=>'adl.lista','name'=>'lista','type'=>'success'],
        ['md'=> 2, 'xs'=> 4, 'route'=>'adl.andamento','name'=>'Andamento'],
        ['md'=> 2, 'xs'=> 4, 'route'=>'adl.prazos','name'=>'Prazos'],
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
                    <th class='col-xs-1 col-md-1'>OPM</th>
                    <th class='col-xs-8 col-md-8'>Sintese</th>
                    <th class='col-xs-2 col-md-2'>Ações</th>     
                  </tr>
                  </thead>
  
                  <tbody>
                  @foreach($registros as $registro)
                  <tr>
                    <td style="display: none">{{$registro->id_adl}}</td>
                    @if ($registro->sjd_ref != '')
                    <td>{{$registro->sjd_ref}}/{{$registro->sjd_ref_ano}}</td>
                    @else
                    <td>{{$registro->id_adl}}</td>
                    @endif
                    <td>{{$registro->present()->opm}}</td>
                    <td>{{$registro->sintese_txt}}</td>
                    <td>
                        <span>
                        <a class="btn btn-default" href="{{route('adl.show',['ref' => $registro['sjd_ref'], 'ano' => $registro->sjd_ref])}}"><i class="fa fa-fw fa-eye "></i></a>
                        <a class="btn btn-info" href="{{route('adl.edit',['ref' => $registro['sjd_ref'], 'ano' => $registro->sjd_ref])}}"><i class="fa fa-fw fa-edit "></i></a>
                        <a class="btn btn-danger"  href="{{route('adl.destroy',$registro['id_adl'])}}" onclick="confirmApagar('adl',$registro['sjd_ref'],$registro->sjd_ref)"><i class="fa fa-fw fa-trash-o "></i></a>
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