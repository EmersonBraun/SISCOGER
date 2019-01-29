@extends('adminlte::page')

@section('title', 'Exclusão - Lista')

@section('content_header')
<section class="content-header nopadding">   
    @component('components.treeview',['title' => 'Exclusão - Lista','opts' => []])
    @endcomponent   
    
    @component('components.menu',
    [
        'title' => 'Exclusão',
        'prop' => ['0','12'],
        'menu' => []
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
                <h3 class="box-title">Listagem de Exclusão</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-2 col-md-2'>RG</th>
                    <th class='col-xs-2 col-md-2'>Nome</th>
                    <th class='col-xs-1 col-md-1'>OPM</th>
                    <th class='col-xs-1 col-md-1'>Data Sentença</th>
                    <th class='col-xs-1 col-md-1'>Data Exclusão</th>
                    <th class='col-xs-3 col-md-3'>Artigos</th>
                    <th class='col-xs-1 col-md-1'>Portaria CG</th>  
                    <th class='col-xs-1 col-md-1'>Boletim Geral</th>    
                  </tr>
                  </thead>
  
                  <tbody>
                     @foreach($registros as $registro)
                  <tr>
                    <td style="display: none">{{$registro['id_exclusao']}}</td>
                    <td><a href="{{route('fdi.show',$registro['rg'])}}" target="_blanck">{{$registro['rg']}}</a></td>
                    <td>{{$registro['cargo']}} {{special_ucwords($registro['nome'])}}</td>
                    <td>{{opm($registro['cdopm_quandoexcluido'])}}</td>
                    <td>{{data_br($registro['data'])}}</td>  
                    <td>{{data_br($registro['exclusao_data'])}}</td>  
                    <td>{{$registro['complemento']}}</td> 
                    <td>{{$registro['portaria_numero']}}</td> 
                    <td>{{$registro['bg_numero']}}/{{$registro['bg_ano']}}</td>  
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th style="display: none">#</th>
                    <th>RG</th>
                    <th>Nome</th>
                    <th>OPM</th>
                    <th>Data Sentença</th>
                    <th>Data Exclusão</th>
                    <th>Artigos</th>
                    <th>Portaria CG</th>  
                    <th>Boletim Geral</th>  
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