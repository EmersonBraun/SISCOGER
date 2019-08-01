@extends('adminlte::page')

@section('title', 'IT - Prazos')

@section('content_header')
@include('procedimentos.it.list.menu', ['title' => 'Prazos','page' => 'prazos'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Inquérito Técnico</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2 col-md-2'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>OPM</th>
                            <th class='col-xs-2 col-md-2'>Abertura</th>
                            <th class='col-xs-2 col-md-2'>Sobrestamento</th>
                            <th class='col-xs-2 col-md-2'>Motivo Sobrestamento</th>
                            <th class='col-xs-2 col-md-2'>Prazo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro['id_it']}}</td>
                            <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                            <td>{{opm($registro['cdopm'])}}</td>
                            <td>{{$registro['cargo']}} {{special_ucwords($registro['nome'])}}</td>
                            <td>{{ data_br($registro['abertura_data']) }}</td>
                            <td>
                                @if($registro['dusobrestado'] == '' || $registro['dusobrestado'] == NULL)
                                <span class='label label-success'>0</span>
                                @else
                                <span class='label label-info'>{{$registro['dusobrestado']}}</span>
                                @endif
                            </td>
                            {{--motivo do sobrestamento--}}
                            @if ( sistema('andamento',$registro['id_andamento']) == 'SOBRESTADO')
                            @if ($registro['motivo']=='' || $registro['motivo']=='outros')
                            <td class='col-xs-2 col-md-2'>{{$registro['motivo_outros']}}</td>
                            @else
                            <td class='col-xs-2 col-md-2'>{{$registro['motivo']}}</td>
                            @endif
                            @else
                            <td class='col-xs-2 col-md-2'>
                                <span class='label label-success'>Não Sobrest.</span>
                            </td>
                            @endif
                            {{--andamento--}}
                            @if ( sistema('andamento',$registro["id_andamento"]) == 'ANDAMENTO')
                            @if ($registro['dutotal'])
                            @if ($registro["diasuteis"]>30)
                            <td class='col-xs-2 col-md-2'>{{$registro['diasuteis']}}</td>
                            @else
                            <td class='col-xs-2 col-md-2'>{{$registro['diasuteis']}}</td>
                            @endif
                            @else
                            <td class='col-xs-2 col-md-2'>
                                <span class='label label-error'>S/Data abertura</span>
                            </td>
                            @endif
                            @elseif ( sistema('andamentocd',$registro["id_andamento"]) == 'CONCLUÍDO')
                            <td class='col-xs-2 col-md-2'>
                                <span class='label label-success'>Concluido</span>
                            </td>
                            @elseif (sistema('andamentocd',$registro['id_andamento']) == '')
                            <td class='col-xs-2 col-md-2'>
                                <span class='label label-danger'>S/Andamento</span>
                            </td>
                            @elseif ( sistema('andamentocd',$registro['id_andamento']) == 'SOBRESTADO')
                            <td class='col-xs-2 col-md-2'>
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
                            <th class='col-xs-2 col-md-2'>Abertura</th>
                            <th class='col-xs-2 col-md-2'>Sobrestamento</th>
                            <th class='col-xs-2 col-md-2'>Motivo Sobrestamento</th>
                            <th class='col-xs-2 col-md-2'>Prazo</th>
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