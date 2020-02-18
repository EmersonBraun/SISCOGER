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
                            <td>{{$registro->present()->refAno}}</td>
                            <td>{{$registro->present()->opm}}</td>
                            <td>{{$registro['abertura_data']}}</td>
                            <td>{{$registro->present()->andamento}}</td>
                            <td>{{sistema('andamentocoger',$registro['id_andamentocoger'])}}</td>
                            <td>
                            @if(!$registro['dusobrestado'])
                                <span class='label label-success'>0</span>
                            @else
                                <span class='label label-info'>{{$registro['dusobrestado']}}</span>
                            @endif
                            </td>
                            <td>{!! $registro->motivo !!}</td>
                            <td>{!! prazos($registro) !!}</td>
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
