@extends('adminlte::page')

@section('title', 'Deserção')

@section('content_header')
@include('procedimentos.desercao.list.menu', ['title' => 'Rel. Situação','page' => 'rel_situacao'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Deserção</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>N°/Ano</th>
                            <th class='col-xs-1 col-md-1'>OPM</th>
                            <th class='col-xs-2 col-md-2'>Fato</th>
                            <th class='col-xs-2 col-md-2'>Termo 1</th>
                            <th class='col-xs-2 col-md-2'>Termo captura</th>
                            <th class='col-xs-2 col-md-2'>Perícia</th>
                            <th class='col-xs-2 col-md-2'>Inclusão/Reversão</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro['id_desercao']}}</td>
                            <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                            <td>{{opm($registro['cdopm'])}}</td>
                            <td>{{data_br($registro['fato_data']) }}</td>
                            <td>{{$registro['termo_exclusao']}}</td>
                            <td>{{$registro['termo_captura']}}</td>
                            <td>{{$registro['pericia']}}</td>
                            <td>{{$registro['termo_inclusao']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <th style="display: none">#</th>
                        <th>N°/Ano</th>
                        <th>OPM</th>
                        <th>Fato</th>
                        <th>Termo 1</th>
                        <th>Termo captura</th>
                        <th>Perícia</th>
                        <th>Inclusão/Reversão</th>
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