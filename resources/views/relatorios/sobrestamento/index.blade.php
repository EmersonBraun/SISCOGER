@extends('adminlte::page')

@section('title', 'sobrestamentos')

@section('content_header')
    @include('relatorios.sobrestamento.menu', ['page' => $proc])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de sobrestamentos</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1'>N°/Ano</th>
                            <th class='col-xs-1'>OPM Apuração</th>
                            <th class='col-xs-6'>Sintese do fato</th>
                            <th class='col-xs-1'>Motivo Sobrestamento</th>
                            <th class='col-xs-1'>Data do fato</th>
                            <th class='col-xs-1'>Data de abertura</th>   
                            <th class='col-xs-1'>Data início</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($registros as $registro)
                    <tr>
                        <td style="display: none">{{$registro['id_'.$proc.'']}}</td>
                        <td><a href="{{route(strtolower($proc).'.index',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}">{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</a></td>
                        <td>{{opm($registro['cdopm'])}}</td>
                        <td>{{$registro['sintese_txt']}}</td>
                        @if ($registro['motivo_outros'])
                            <td>Outros: {{$registro['motivo_outros']}}</td>
                        @else
                            <td>{{$registro['motivo']}}</td>
                        @endif
                        <td>{{data_br($registro['fato_data'])}}</td>
                        <td>{{data_br($registro['abertura_data'])}}</td>
                        <td>{{data_br($registro['inicio_data'])}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1'>N°/Ano</th>
                            <th class='col-xs-1'>OPM Apuração</th>
                            <th class='col-xs-6'>Sintese do fato</th>
                            <th class='col-xs-1'>Motivo Sobrestamento</th>
                            <th class='col-xs-1'>Data do fato</th>
                            <th class='col-xs-1'>Data de abertura</th>   
                            <th class='col-xs-1'>Data início</th>
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