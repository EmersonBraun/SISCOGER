@extends('adminlte::page')

@section('title', 'FATD - Prazos')

@section('content_header')
@include('procedimentos.fatd.list.menu', ['title' => 'Prazos','page' => 'prazos'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Formulários de Transgração Disciplinar</h3>
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
                            <td style="display: none">{{$registro['id_fatd']}}</td>
                            <td>{{$registro['sjd_ref']}} / {{$registro['sjd_ref_ano']}}</td>
                            <td>{{opm($registro['cdopm'])}}</td>
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
                            <td>{{$registro['motivo_outros']}}</td>
                            @else
                            <td>{{$registro['motivo']}}</td>
                            @endif
                            @else
                            <td>
                                <span class='label label-success'>Não Sobrest.</span>
                            </td>
                            @endif
                            {{--andamento--}}
                            @if ( sistema('andamento',$registro["id_andamento"]) == 'ANDAMENTO')
                            @if ($registro['dutotal'])
                            @if ($registro["diasuteis"]>30)
                            <td>{{$registro['diasuteis']}}</td>
                            @else
                            <td>{{$registro['diasuteis']}}</td>
                            @endif
                            @else
                            <td>
                                S/Data abertura
                            </td>
                            @endif
                            @elseif ( sistema('andamento',$registro["id_andamento"]) == 'CONCLUÍDO')
                            <td>
                                <span class='label label-success'>Concluido</span>
                            </td>
                            @elseif (sistema('andamento',$registro['id_andamento']) == '')
                            <td>
                                S/Andamento
                            </td>
                            @elseif ( sistema('andamento',$registro['id_andamento']) == 'SOBRESTADO')
                            <td>
                                Sobrestado
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th>N°/Ano</th>
                            <th>OPM</th>
                            <th>Abertura</th>
                            <th>Sobrestamento</th>
                            <th>Motivo Sobrestamento</th>
                            <th>Ações</th>
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