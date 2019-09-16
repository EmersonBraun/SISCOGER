@extends('adminlte::page')

@section('title', 'Tramitação COGER')

@section('content_header')
    @include('busca.tramitacaocoger.menu', ['title' => 'Lista','page' => $ano])
@stop

@section('content')
    <section class="">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Listagem de Tramitação COGER</h3>
              </div>
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                    <tr>
                        <th style="display: none">#</th>
                        <th class='col-xs-1 col-md-1'>RG</th>
                        <th class='col-xs-2 col-md-2'>Cargo</th>
                        <th class='col-xs-2 col-md-2'>Nome</th>
                        <th class='col-xs-2 col-md-2'>OPM</th>
                        <th class='col-xs-2 col-md-4'>Descrição</th>
                        <th class='col-xs-3 col-md-1'>Digitador</th>     
                    </tr>
                  </thead>
  
                  <tbody>
                  @foreach($registros as $registro)
                    <tr>
                        <td style="display: none">{{$registro->id_tramitacao}}</td>
                        <td>{{$registro->rg}}</td>
                        <td>{{$registro->cargo}}</td>
                        <td>{{$registro->nome}}</td>
                        <td>{{$registro->opm_abreviatura}}</td> 
                        <td>{{$registro->descricao_txt}}</td>  
                        <td>{{$registro->digitador}}</td>
                    </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                        <th style="display: none">#</th>
                        <th class='col-xs-1 col-md-1'>RG</th>
                        <th class='col-xs-2 col-md-2'>Cargo</th>
                        <th class='col-xs-2 col-md-2'>Nome</th>
                        <th class='col-xs-2 col-md-2'>OPM</th>
                        <th class='col-xs-2 col-md-4'>Descrição</th>
                        <th class='col-xs-3 col-md-1'>Digitador</th>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
@stop

@section('css')
@stop

@section('js')
@stop