@extends('adminlte::page')

@section('title', 'ADL - Julgamento')

@section('content_header')
@include('procedimentos.adl.list.menu', ['title' => 'Julgamento','page' => 'julgamento'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Apuração Disciplinar de Licenciamento</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2 col-md-2'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>Acusado</th>
                            <th class='col-xs-2 col-md-2'>Andamento</th>
                            <th class='col-xs-2 col-md-2'>Comissão</th>
                            <th class='col-xs-2 col-md-2'>CMT Geral</th>
                            <th class='col-xs-2 col-md-2'>Julgamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro->id_adl }}</td>
                            <td>{{ $registro->present()->refAno}}</td>
                            <td>{{$registro->present()->cargoENome}}</td>
                            <td>{{ $registro->present()->andamento }}</td>
                            <td>{{$registro->parecer_comissao }}</td>
                            <td>{{$registro->parecer_cmtgeral }}</td>
                            <td>{{$registro->resultado }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th>N°/Ano</th>
                            <th>Acusado</th>
                            <th>Andamento</th>
                            <th>Comissão</th>
                            <th>CMT Geral</th>
                            <th>Julgamento</th>
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