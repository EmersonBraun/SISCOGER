@extends('adminlte::page')

@section('title_postfix', '| Dasboard geral')

@section('content_header')
    @include('relatorios.pendencias.menu', ['title' => 'Gráficos','page' => 'graficos'])
@stop

@section('content')
<section class="content">
    <div class="row">
        <div class="row">
            <div class="col-md-4 col-xs-12">
                <crpms-chart 
                    :values="{{json_encode($totais)}}"
                    label='Pendências Totais'
                    name='totais'
                ></crpms-chart>
            </div>
            <div class="col-md-4 col-xs-12">
                <crpms-chart 
                    :values="{{json_encode($fatd_punicao)}}"
                    label='FATD Punição'
                    name='fatd_punicao'
                ></crpms-chart>
            </div>
            <div class="col-md-4 col-xs-12">
                <crpms-chart 
                    :values="{{json_encode($fatd_abertura)}}"
                    label='FATD Abertura'
                    name='fatd_abertura'
                ></crpms-chart>
            </div>
            <div class="col-md-4 col-xs-12">
                <crpms-chart 
                    :values="{{json_encode($fatd_prazo)}}"
                    label='FATD Prazo'
                    name='fatd_prazo'
                ></crpms-chart>
            </div>
            <div class="col-md-4 col-xs-12">
                <crpms-chart 
                    :values="{{json_encode($ipm_abertura)}}"
                    label='IPM Abertura'
                    name='ipm_abertura'
                ></crpms-chart>
            </div>
            <div class="col-md-4 col-xs-12">
                <crpms-chart 
                    :values="{{json_encode($ipm_prazo)}}"
                    label='IPM Prazo'
                    name='ipm_prazo'
                ></crpms-chart>
            </div>
            <div class="col-md-4 col-xs-12">
                <crpms-chart 
                    :values="{{json_encode($sindicancia_abertura)}}"
                    label='Sindicância Abertura'
                    name='sindicancia_abertura'
                ></crpms-chart>
            </div>
            <div class="col-md-4 col-xs-12">
                <crpms-chart 
                    :values="{{json_encode($sindicancia_prazo)}}"
                    label='Sindicância Prazo'
                    name='sindicancia_prazo'
                ></crpms-chart>
            </div>
        </div>
    </div>
</section>

@stop

@section('js')
@include('vendor.adminlte.includes.vue')
@stop