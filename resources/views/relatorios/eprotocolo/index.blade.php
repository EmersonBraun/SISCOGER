@extends('adminlte::page')

@section('title', 'Relatório - e-protocolo')

@section('content_header')
<section class="content-header">   
  <h1>Relatório de e-protocolo</h1>
  <ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  </ol>
</section>
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Relatório de e-protocolo</b></h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class="col-xs-1">N° Documento</th>
                            <th class="col-xs-6">Descrição</th>
                            <th class="col-xs-1">RG Envolvido</th>
                            <th class="col-xs-1">RG Analista</th>
                            <th class="col-xs-3">Observações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{ $registro->id_protocolo }}</td>
                            <td>{{ $registro->numero }}</td>
                            <td>{{ $registro->descricao_txt }}</td>
                            <td><a href="{{route('fdi.show',$registro->rg)}}" target="_blanck">{{ $registro->rg }}</a></td>
                            <td>{{ $registro->rg_analista }}</td>
                            <td>{{ $registro->obs }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <tr>
                                <th style="display: none">#</th>
                                <th class="col-xs-1">N° Documento</th>
                                <th class="col-xs-6">Descrição</th>
                                <th class="col-xs-1">RG Envolvido</th>
                                <th class="col-xs-1">RG Analista</th>
                                <th class="col-xs-3">Observações</th>
                            </tr>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
@stop

@section('js')

@stop