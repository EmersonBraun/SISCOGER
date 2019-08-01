@extends('adminlte::page')

@section('title', 'IPM - Prazos')

@section('content_header')
@include('procedimentos.ipm.list.menu', ['title' => 'Prazos','page' => 'prazos'])
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
                            <th class='col-xs-2 col-md-2'>Instauração</th>
                            <th class='col-xs-2 col-md-2'>Encarregado</th>
                            <th class='col-xs-2 col-md-2'>Andamento</th>
                            <th class='col-xs-2 col-md-2'>Prazo decorrido</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro['id_ipm']}}</td>
                            <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                            <td>{{opm($registro['cdopm'])}}</td>
                            <td>{{ data_br($registro['autuacao_data']) }}</td>
                            <td>{{$registro['cargo']}} {{special_ucwords($registro['nome'])}}</td>
                            <td>{{sistema('andamento',$registro['id_andamento'])}}</td>
                            @if ( sistema('andamento',$registro["id_andamento"]) == 'ANDAMENTO')
                            @if ($registro['diasuteis'])
                            @if ($registro["diasuteis"]>60)
                            <td><span class='label label-danger'>{{$registro['diasuteis']}}</span></td>
                            @else
                            <td>{{$registro['diasuteis']}}</td>
                            @endif
                            @else
                            <td>
                                <span class='label label-error'>S/Data abertura</span>
                            </td>
                            @endif
                            @elseif ( sistema('andamento',$registro["id_andamento"]) == 'CONCLUÍDO')
                            <td>
                                <span class='label label-success'>Concluido</span>
                            </td>
                            @elseif (sistema('andamento',$registro['id_andamento']) == '')
                            <td>
                                <span class='label label-danger'>S/Andamento</span>
                            </td>
                            @elseif ( sistema('andamento',$registro['id_andamento']) == 'SOBRESTADO')
                            <td>
                                <span class='label label-error'>Sobrestado</span>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2 col-md-2'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>OPM</th>
                            <th class='col-xs-2 col-md-2'>Instauração</th>
                            <th class='col-xs-2 col-md-2'>Encarregado</th>
                            <th class='col-xs-2 col-md-2'>Andamento</th>
                            <th class='col-xs-2 col-md-2'>Prazo decorrido</th>
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