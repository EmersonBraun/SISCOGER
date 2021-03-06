@extends('adminlte::page')

@section('title', 'IPM - Rel. Sit.')

@section('content_header')
@include('procedimentos.ipm.list.menu', ['title' => 'Rel. Situação','page' => 'rel_situacao'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Inquérito Policial Militar</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2 col-md-2'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>OPM</th>
                            <th class='col-xs-1 col-md-1'>Fato</th>
                            <th class='col-xs-1 col-md-1'>Abertura</th>
                            <th class='col-xs-1 col-md-1'>Autuação</th>
                            <th class='col-xs-5 col-md-5'>Check</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro['id_ipm']}}</td>
                            <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                            <td>{{opm($registro['cdopm'])}}</td>
                            <td>{{data_br($registro['fato_data']) }}</td>
                            <td>{{data_br($registro['abertura_data']) }}</td>
                            <td>{{data_br($registro['autuacao_data']) }}</td>
                            <td>
                                <span>
                                    @if ($registro['relato_enc_file'])
                                    <i class="fa fa-check" style='color: green'></i>
                                    @else
                                    <i class="fa fa-times" style='color: red'></i>
                                    @endif
                                    Rel. Encarregado<br>
                                    @if ($registro['relato_cmtopm_file'])
                                    <i class="fa fa-check" style='color: green'></i>
                                    @else
                                    <i class="fa fa-times" style='color: red'></i>
                                    @endif
                                    Rel. OPM<br>
                                    @if ($registro['relato_cmtgeral_file'])
                                    <i class="fa fa-check" style='color: green'></i>
                                    @else
                                    <i class="fa fa-times" style='color: red'></i>
                                    @endif
                                    Rel. CMT Geral<br>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2 col-md-2'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>OPM</th>
                            <th class='col-xs-1 col-md-1'>Fato</th>
                            <th class='col-xs-1 col-md-1'>Abertura</th>
                            <th class='col-xs-1 col-md-1'>Autuação</th>
                            <th class='col-xs-5 col-md-5'>Check</th>
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