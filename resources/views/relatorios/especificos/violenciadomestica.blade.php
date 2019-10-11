@extends('adminlte::page')

@section('title', 'Relatório - Violência Doméstica')

@section('content_header')
<section class="content-header">   
  <h1>Relatório de Violência Doméstica</h1>
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
                <h3 class="box-title">Relatório de Violência Doméstica/Lei n° 11.340/2006 </h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class="col-xs-1">Proc.</th>
                            <th class="col-xs-1">Ref</th>
                            <th class="col-xs-1">Ano</th>
                            <th class="col-xs-1">Andamento</th>
                            <th class="col-xs-1">Andamento COGER</th>
                            <th class="col-xs-1">RG</th>
                            <th class="col-xs-1">Posto/Grad.</th>
                            <th class="col-xs-1">Nome</th>
                            <th class="col-xs-1">OPM</th>
                            <th class="col-xs-3">Síntese</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $proc => $registro)
                            @foreach($registro as $r)
                            <tr>
                                <td style="display: none">{{ $r['id_'.$proc]}}</td>
                                <td>{{strtoupper($proc)}}</td>
                                <td>{{$r['sjd_ref']}}</td>
                                <td>{{$r['sjd_ref_ano']}}</td>
                                <td>{{sistema('andamento',$r['id_andamento'])}}</td>
                                <td>{{sistema('andamentocoger',$r['id_andamentocoger'])}}</td>
                                <td>{{$r['rg']}}</td>
                                <td>{{$r['cargo']}}</td>
                                <td>{{$r['nome']}}</td>
                                <td>{{opm($r['cdopm'])}}</td>
                                <td>{{$r['sintese_txt']}}</td>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class="col-xs-1">Proc.</th>
                            <th class="col-xs-1">Ref</th>
                            <th class="col-xs-1">Ano</th>
                            <th class="col-xs-1">Andamento</th>
                            <th class="col-xs-1">Andamento COGER</th>
                            <th class="col-xs-1">RG</th>
                            <th class="col-xs-1">Posto/Grad.</th>
                            <th class="col-xs-1">Nome</th>
                            <th class="col-xs-1">OPM</th>
                            <th class="col-xs-3">Síntese</th>
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