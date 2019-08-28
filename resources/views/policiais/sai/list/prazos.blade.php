@extends('adminlte::page')

@section('title', 'SAI - Prazos')

@section('content_header')
@include('policiais.sai.list.menu', ['title' => 'Prazos','page' => 'prazos'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de SAI</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>OPM</th>
                            <th class='col-xs-2 col-md-2'>Abertura</th>
                            <th class='col-xs-2 col-md-2'>Dias Úteis</th>
                            <th class='col-xs-2 col-md-2'>Andamento COGER</th>
                            <th class='col-xs-1 col-md-1'>Sobrestamento</th>
                            <th class='col-xs-2 col-md-2'>Dias Totais</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro['id_sai']}}</td>
                            @if ($registro->sjd_ref != '')
                            <td>{{$registro->sjd_ref}}/{{$registro->sjd_ref_ano}}</td>
                            @else
                            <td>{{$registro->id_sai}}</td>
                            @endif
                            <td>{{ $registro->opm_abreviatura }}</td>
                            <td>{{ $registro->abertura_data }}</td>
                            <td>{{ $registro->dutotal }}</td>
                            <td>{{ $registro->present()->andamento}}</td>
                            <td>{{ $registro->dusobrestado }}</td>
                            <td>{{ $registro->dutotal }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>OPM</th>
                            <th class='col-xs-2 col-md-2'>Abertura</th>
                            <th class='col-xs-2 col-md-2'>Dias Úteis</th>
                            <th class='col-xs-2 col-md-2'>Andamento COGER</th>
                            <th class='col-xs-1 col-md-1'>Sobrestamento</th>
                            <th class='col-xs-2 col-md-2'>Dias Totais</th>
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