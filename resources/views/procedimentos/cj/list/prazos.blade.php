@extends('adminlte::page')

@section('title', 'CJ - Prazos')

@section('content_header')
@include('procedimentos.cj.list.menu', ['title' => 'Prazos','page' => 'prazos'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Conselhos de Justificação</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>N°/Ano</th>
                            <th class='col-xs-1 col-md-1'>Fato</th>
                            <th class='col-xs-2 col-md-2'>Presidente</th>
                            <th class='col-xs-1 col-md-1'>Andamento</th>
                            <th class='col-xs-1 col-md-1'>Andamento COGER</th>
                            <th class='col-xs-2 col-md-2'>Sobrestamento</th>
                            <th class='col-xs-2 col-md-2'>Motivo Sobrestamento</th>
                            <th class='col-xs-2 col-md-2'>Prazo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro['id_cj']}}</td>
                            <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                            <td>{{data_br($registro['abertura_data'])}}</td>
                            <td>{{$registro['cargo']}} {{special_ucwords($registro['nome'])}}</td>
                            <td>{{sistema('andamento',$registro['id_andamento'])}}</td>
                            <td>{{sistema('andamentocoger',$registro['id_andamentocoger'])}}</td>
                            <td>
                                @if($registro['dusobrestado'] == '' || $registro['dusobrestado'] == NULL)
                                <span class='label label-success'>0</span>
                                @else
                                <span class='label label-info'>{{$registro['dusobrestado']}}</span>
                                @endif
                            </td>
                            {{--motivo do sobrestamento--}}
                            @if (sistema('andamentocj',$registro['id_andamento']) == 'SOBRESTADO')
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
                            @if ( sistema('andamentocj',$registro["id_andamento"]) == 'ANDAMENTO')
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
                            @elseif ( sistema('andamentocj',$registro["id_andamento"]) == 'CONCLUÍDO')
                            <td>
                                <span class='label label-success'>Concluido</span>
                            </td>
                            @elseif (sistema('andamentocj',$registro['id_andamento']) == '')
                            <td>
                                S/Andamento
                            </td>
                            @elseif ( sistema('andamentocj',$registro['id_andamento']) == 'SOBRESTADO')
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
                            <th>Fato</th>
                            <th>Presidente</th>
                            <th>Andamento</th>
                            <th>Andamento COGER</th>
                            <th>Sobrestamento</th>
                            <th>Motivo Sobrestamento</th>
                            <th>Prazo</th>
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