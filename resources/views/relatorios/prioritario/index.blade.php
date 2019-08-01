@extends('adminlte::page')

@section('title', 'Relatórios | Prioritários')

@section('content_header')
    @include('relatorios.prioritario.menu', ['page' => $proc])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de - {{sistema('procedimentosTipos',strtoupper($proc))}}</h3>
            </div>
                <div class="box-body">
                    <table id="datable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="display: none">#</th>
                                <th class='col-xs-1 col-md-1'>N°/Ano</th>
                                <th class='col-xs-2 col-md-1'>OPM Apuração</th>
                                <th class='col-xs-2 col-md-4'>Sintese do fato</th>
                                <th class='col-xs-2 col-md-1'>Data do fato</th>
                                <th class='col-xs-2 col-md-1'>Data de abertura</th>
                                <th class='col-xs-3 col-md-2'>Andamento</th>   
                                <th class='col-xs-3 col-md-2'>Andamento COGER</th>  
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro['id_'.$proc.'']}}</td>
                            <td><a href="{{route(strtolower($proc).'.index',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}">{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</a></td>
                            <td>{{opm($registro['cdopm'])}}</td>
                            <td>{{$registro['sintese_txt']}}</td>
                            <td>{{data_br($registro['fato_data'])}}</td>
                            <td>{{data_br($registro['abertura_data'])}}</td>
                            <td>{{sistema('andamento',$registro['id_andamento'])}}</td>
                            <td>{{sistema('andamentocoger',$registro['id_andamentocoger'])}}</td>  
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="display: none">#</th>
                                <th class='col-xs-1 col-md-1'>N°/Ano</th>
                                <th class='col-xs-2 col-md-1'>OPM Apuração</th>
                                <th class='col-xs-2 col-md-4'>Sintese do fato</th>
                                <th class='col-xs-2 col-md-1'>Data do fato</th>
                                <th class='col-xs-2 col-md-1'>Data de abertura</th>
                                <th class='col-xs-3 col-md-2'>Andamento</th>   
                                <th class='col-xs-3 col-md-2'>Andamento COGER</th>  
                            </tr>
                        </tfoot>
                    </table>
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop