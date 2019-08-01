@extends('adminlte::page')

@section('title', 'Sindicância - prazos')

@section('content_header')
    @include('procedimentos.sindicancia.list.menu', ['title' => 'Prazos','page' => 'prazos'])   
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Sindicância</h3> 
                @component(
                'components.tooltip',
                ['text' => 'Calculo do prazo dos sindicancia - contado em dias uteis, EXCLUI-SE o primeiro dia. (Portaria 338) Sao descontados os dias em que o procedimento ficou sobrestado. Data de referência:',
                'compl' => date('d/m/Y')])
                @endcomponent
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class='col-xs-1 col-md-1'>N°/Ano</th>
                            <th class='col-xs-1 col-md-1'>OPM</th>
                            <th class='col-xs-2 col-md-2'>Abertura</th>
                            <th class='col-xs-1 col-md-1'>Andamento</th>
                            <th class='col-xs-1 col-md-1'>Adamento COGER</th>
                            <th class='col-xs-2 col-md-2'>Sobrestamento</th>
                            <th class='col-xs-2 col-md-2'>Motivo Sobrestamento</th>
                            <th class='col-xs-2 col-md-2'>Prazo</th>     
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($registros as $registro)
                        <tr>
                            <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                            <td>{{opm($registro['cdopm'])}}</td>
                            <td>{{ data_br($registro['abertura_data']) }}</td>
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
                            <td>
                            @if ( sistema('andamento',$registro['id_andamento']) == 'SOBRESTADO') 
                                @if ($registro['motivo']=='' || $registro['motivo']=='outros')
                                {{$registro['motivo_outros']}}
                                @else
                                {{$registro['motivo']}}
                                @endif
                            @else
                                <span class='label label-success'>Não Sobrest.</span>
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
                                <span class='label label-error'>S/Data abertura</span>
                                @endif
                            @elseif ( sistema('andamento',$registro["id_andamento"]) == 'CONCLUÍDO')
                                <span class='label label-success'>Concluido</span>
                            @elseif (sistema('andamento',$registro['id_andamento']) == '') 
                                <span class='label label-danger'>S/Andamento</span>
                            @elseif ( sistema('andamento',$registro['id_andamento']) == 'SOBRESTADO') 
                                <span class='label label-error'>Sobrestado</span>
                            @endif 
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class='col-xs-1 col-md-1'>N°/Ano</th>
                            <th class='col-xs-1 col-md-1'>OPM</th>
                            <th class='col-xs-2 col-md-2'>Abertura</th>
                            <th class='col-xs-1 col-md-1'>Andamento</th>
                            <th class='col-xs-1 col-md-1'>Adamento COGER</th>
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
