@extends('adminlte::page')

@section('title', 'Email')

@section('content_header')
@include('apresentacao.dados_opm.menu', ['title' => 'Outras autoridades','page' => 'outras'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Outras autoridades</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2'>RG</th>
                            <th class='col-xs-2'>Função</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro->id_cadastroopmcogerautoridade}}</td>
                            <td>{{$registro->rg}}</td>
                            <td>{{$registro->funcao}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
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