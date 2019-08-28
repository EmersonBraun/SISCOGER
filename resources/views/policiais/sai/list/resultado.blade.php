@extends('adminlte::page')

@section('title', 'SAI - Resultado')

@section('content_header')
@include('policiais.sai.list.menu', ['title' => 'Resultado','page' => 'resultado'])
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
                            <th class='col-xs-2 col-md-2'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>OPM</th>
                            <th class='col-xs-2 col-md-2'>Motivo Principal</th>
                            <th class='col-xs-2 col-md-2'>Cidade</th>
                            <th class='col-xs-2 col-md-2'>Data do fato</th>
                            <th class='col-xs-2 col-md-2'>Resultado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro->id_adl }}</td>
                            <td>{{$registro->present()->refAno}}</td>
                            <td>{{$registro->opm_abreviatura}}</td>
                            <td>{{$registro->motivo_principal }}</td>
                            <td>{{$registro->present()->municipio }}</td>
                            <td>{{$registro->fato_data }}</td>
                            <td>{{ $registro->present()->resultado }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2 col-md-2'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>OPM</th>
                            <th class='col-xs-2 col-md-2'>Motivo Principal</th>
                            <th class='col-xs-2 col-md-2'>Cidade</th>
                            <th class='col-xs-2 col-md-2'>Data do fato</th>
                            <th class='col-xs-2 col-md-2'>Resultado</th>
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