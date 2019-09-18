@extends('adminlte::page')

@section('title', 'Email')

@section('content_header')
@include('apresentacao.dados_opm.menu', ['title' => 'Comando/Direção','page' => 'comando'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Autoridades</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2'>OM</th>
                            <th class='col-xs-2'>OM intermediária</th>
                            <th class='col-xs-2'>Nome</th>
                            <th class='col-xs-2'>RG</th>
                            <th class='col-xs-2'>Função</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro->id_cadastroopmcoger}}</td>
                            <td>{{$registro->opm_nome_por_extenso}}</td>
                            <td>{{$registro->opm_intermediaria_nome_por_extenso}}</td>
                            <td>{{$registro->opm_autoridade_nome}}</td>
                            <td>{{$registro->opm_autoridade_rg}}</td>
                            <td>{{$registro->opm_autoridade_funcao}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2'>OM</th>
                            <th class='col-xs-2'>OM intermediária</th>
                            <th class='col-xs-2'>Nome</th>
                            <th class='col-xs-2'>RG</th>
                            <th class='col-xs-2'>Função</th>
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