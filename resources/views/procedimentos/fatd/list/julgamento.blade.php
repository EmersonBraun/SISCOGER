@extends('adminlte::page')

@section('title', 'FATD - Julgamento')

@section('content_header')
    @include('procedimentos.fatd.list.menu', ['title' => 'Julgamento','page' => 'julgamento'])
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
                <h3 class="box-title">Listagem de Formulários de Transgração Disciplinar</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-2 col-md-2'>N°/Ano</th>
                    <th class='col-xs-2 col-md-2'>OPM</th>
                    <th class='col-xs-3 col-md-3'>Acusado</th>
                    <th class='col-xs-3 col-md-3'>Andamento</th> 
                    <th class='col-xs-2 col-md-2'>Resultado</th>  
                  </tr>
                  </thead>
  
                  <tbody>
                     @foreach($registros as $registro)
                  <tr>
                    <td style="display: none">{{$registro['id_fatd']}}</td>
                    <td>{{$registro['sjd_ref']}} / {{$registro['sjd_ref_ano']}}</td>
                    <td>{{opm($registro['cdopm'])}}</td>
                    <td>{{$registro['cargo']}} {{$registro['nome']}}</td>
                    <td>{{sistema('andamento',$registro['id_andamento'])}}</td> 
                    <td>
                    @if ($registro['resultado'] == "Punido")
                        @if (!$registro['id_punicao'])
                            Cadastrar
                        @else
                            <strong>
                            Punição: {{sistema('classPunicao',$registro['id_classpunicao'])}}
                            </strong></br>
                            {{-- 1 é advertência e 3 repreenção, então esses não coloca os dias --}}
                            @if($registro['id_gradacao'] != 1 && $registro['id_gradacao'] != 3)
                                {{$registro['dias']}} dia(s) -  
                            @endif
                            {{sistema('gradacao',$registro['id_gradacao'])}}
                        @endif
                    @endif
                    </td> 
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th style="display: none">#</th>
                    <th>N°/Ano</th>
                    <th>OPM</th>
                    <th>Acusado</th>
                    <th>Andamento</th> 
                    <th>Resultado</th>
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