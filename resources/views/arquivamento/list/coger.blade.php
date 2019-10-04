@extends('adminlte::page')

@section('title', 'Arquivo')

@section('content_header')
<section class="content-header">   
    @include('arquivamento.list.menu', ['title' => 'COGER', 'page' => 'coger', 'numero' => '1'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de arquivo - COGER</b></h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class="col-xs-1">Data</th>
                            <th class="col-xs-1">Procedimento</th>
                            <th class="col-xs-2">Referência</th>
                            <th class="col-xs-2">Ano</th>
                            <th class="col-xs-1">Número</th>
                            <th class="col-xs-1">Letra</th>
                            <th class="col-xs-2">RG</th>
                            <th class="col-xs-2">Observações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{ $registro->id_arquivo }}</td>
                            <td>{{ $registro->arquivo_data }}</td>
                            <td>{{ $registro->procedimento }}</td>
                            <td>{{ $registro->sjd_ref }}</td>
                            <td>{{ $registro->sjd_ref_ano }}</td>
                            <td>{{ $registro->numero }}</td>
                            <td>{{ $registro->letra }}</td>
                            <td>{{ $registro->rg }}</td>
                            <td>{{ $registro->obs }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <tr>
                                <th style="display: none">#</th>
                                <th class="col-xs-1">Data</th>
                                <th class="col-xs-1">Procedimento</th>
                                <th class="col-xs-2">Referência</th>
                                <th class="col-xs-2">Ano</th>
                                <th class="col-xs-1">Número</th>
                                <th class="col-xs-1">Letra</th>
                                <th class="col-xs-2">RG</th>
                                <th class="col-xs-2">Observações</th>
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