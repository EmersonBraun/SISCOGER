@extends('adminlte::page')

@section('title', 'ADL - Andamento')

@section('content_header')
@include('procedimentos.adl.list.menu', ['title' => 'Prazos','page' => 'prazos'])
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
                            <th class='col-xs-1 col-md-1'>N°/Ano</th>
                            <th class='col-xs-1 col-md-1'>Data</th>
                            <th class='col-xs-2 col-md-2'>Presidente</th>
                            <th class='col-xs-2 col-md-2'>Andamento</th>
                            <th class='col-xs-2 col-md-2'>Andamento COGER</th>
                            <th class='col-xs-1 col-md-1'>Sobrestamento</th>
                            <th class='col-xs-2 col-md-2'>Motivo Sobrestamento</th>
                            <th class='col-xs-1 col-md-1'>Prazo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro['id_adl']}}</td>
                            <td>{{$registro->present()->refAno}}</td>
                            <td>{{ $registro->abertura_data }}</td>
                            <td>{{$registro->present()->cargoENome}}</td>
                            <td>{{$registro->present()->andamento}}</td>
                            <td>{{$registro->present()->andamentocoger}}</td>
                            <td>
                                @if($registro['dusobrestado'] == '' || $registro['dusobrestado'] == NULL)
                                <span class='label label-success'>0</span>
                                @else
                                <span class='label label-info'>{{$registro['dusobrestado']}}</span>
                                @endif
                            </td>
                            {{--motivo do sobrestamento--}}
                            <td>
                                @if ( sistema('andamento',$registro['id_andamento']) == 'SOBRESTADO')
                                @if ($registro['motivo']=='' || $registro['motivo']=='outros')
                                {{$registro['motivo_outros']}}
                                @else
                                {{$registro['motivo']}}
                                @endif
                                @else
                                <span class='label label-warning'>Não Sobrest.</span>
                                @endif
                            </td>
                            {{--andamento--}}
                            <td>
                                @if ( sistema('andamento',$registro["id_andamento"]) == 'ANDAMENTO')
                                @if ($registro['dutotal'])
                                @if ($registro["diasuteis"]>30)
                                {{$registro['diasuteis']}}
                                @else
                                {{$registro['diasuteis']}}
                                @endif
                                @else
                                S/Data abertura
                                @endif
                                @elseif ( sistema('andamento',$registro["id_andamento"]) == 'CONCLUÍDO')
                                <span class='label label-success'>Concluido</span>
                                @elseif (sistema('andamento',$registro['id_andamento']) == '')
                                S/Andamento
                                @elseif ( sistema('andamento',$registro['id_andamento']) == 'SOBRESTADO')
                                Sobrestado
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>N°/Ano</th>
                            <th class='col-xs-1 col-md-1'>Data</th>
                            <th class='col-xs-2 col-md-2'>Presidente</th>
                            <th class='col-xs-2 col-md-2'>Andamento</th>
                            <th class='col-xs-2 col-md-2'>Andamento COGER</th>
                            <th class='col-xs-1 col-md-1'>Sobrestamento</th>
                            <th class='col-xs-2 col-md-2'>Motivo Sobrestamento</th>
                            <th class='col-xs-1 col-md-1'>Prazo</th>
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