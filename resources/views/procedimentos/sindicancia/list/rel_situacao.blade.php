@extends('adminlte::page')

@section('title', 'Sindicância - Rel. Sit.')

@section('content_header')
    @include('procedimentos.sindicancia.list.menu', ['title' => 'Rel. Situação','page' => 'rel_situacao'])  
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de SINDICÂNCIA</h3>
            </div>
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class='col-xs-2 col-md-2'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>OPM</th>
                            <th class='col-xs-2 col-md-2'>Fato</th>
                            <th class='col-xs-2 col-md-2'>Despacho</th>  
                            <th class='col-xs-2 col-md-2'>Abertura</th>
                            <th class='col-xs-2 col-md-2'>Check</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($registros as $registro)
                    <tr>
                        <td class='col-xs-2 col-md-2'>{{$registro['sjd_ref']}} / {{$registro['sjd_ref_ano']}}</td>
                        <td class='col-xs-2 col-md-2'>{{opm($registro['cdopm'])}}</td>
                        <td class='col-xs-2 col-md-2'>{{date('d/m/Y',strtotime($registro['fato_data'])) }}</td> 
                        <td class='col-xs-2 col-md-2'>
                            {{date('d/m/Y',strtotime($registro['portaria_data']))}}
                        </td> 
                        <td class='col-xs-2 col-md-2'>
                            {{date('d/m/Y',strtotime($registro['abertura_data']))}}
                        </td> 
                        <td class='col-xs-2 col-md-2'>
                            <span>
                            @if ($registro['fato_file'])
                                <i class="fa fa-check" style='color: green'></i>
                            @else
                                <i class="fa fa-times" style='color: red'></i>
                            @endif
                                Imputação<br>
                            @if ($registro['relatorio_file'])
                                <i class="fa fa-check" style='color: green'></i>
                            @else
                                <i class="fa fa-times" style='color: red'></i>
                            @endif
                                Relatório<br>
                            @if ($registro['sol_cmt_file'])
                                <i class="fa fa-check" style='color: green'></i>
                            @else
                                <i class="fa fa-times" style='color: red'></i>
                            @endif
                                Solução<br>
                            @if ($registro['notapunicao_file'])
                                <i class="fa fa-check" style='color: green'></i>
                            @else
                                <i class="fa fa-times" style='color: red'></i>
                            @endif
                                N° Punição<br>
                        </td> 
                    </tr>
                    @endforeach
                    </tbody>
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