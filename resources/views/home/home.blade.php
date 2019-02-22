@extends('adminlte::page')

@section('title_postfix', '| Dasboard')

@section('content_header')
<section class="content-header nopadding">
    <h1>Dashboard<small>- Pendências</small></h1>
        @if($nome_unidade != '')OPM/OBM:  {{$nome_unidade}} @endif
    <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Home</li>
    </ol>
</section>
@stop

@section('content')
<section class="content nopadding">
    @include('home.infoboxes')
    <div class="row">
        @include('home.transferencias')
        @include('home.comportamento')
        @include('home.fatd_punicao')
        @include('home.fatd_prazos')
        @include('home.fatd_abertura')
        @include('home.ipm_prazos')
        @include('home.ipm_instauracao')
        @include('home.sindicancia_abertura')
        @include('home.sindicancia_prazos')
        @include('home.cd_abertura')
        @include('home.ipm_instauracao')
        @include('home.ipm_instauracao')
        @include('home.ipm_instauracao')
        @include('home.ipm_instauracao')
    </div>
    <div class="row"><!-- *************.Gráficos********************* -->
        <div class="col-md-12 col-xs-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Efetivo OPM/OBM</h3>
            </div>
            <div class="box-body" style="width:75%;">
                {{-- @include('vendor.adminlte.includes.graficos') --}}
                {!! $efetivo_chartjs->render() !!}
                <div class="d-flex flex-row">
                    <div class="p-6"><strong>Total efetivo: {{$total_efetivo->qtd}}</strong></div>
                    <div class="p-6">Fonte: RHPARANA - data {{date('d/m/Y')}}</div>       
                <div>         
            </div>
        </div>
    </div>
    </div>
    
    <div class="row"><!-- *************.Gráficos********************* -->
        <div class="col-md-12 col-xs-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Quantitativo procedimetos por ano</h3>
            </div>
            <div class="box-body" style="width:75%;">
                {{-- @include('vendor.adminlte.includes.graficos') --}}
                {!! $chartjs->render() !!}
                <div class="d-flex flex-row">
                    <div class="p-6">Fonte: Banco de dados SISCOGER - data {{date('d/m/Y')}}</div>       
                <div>         
            </div>
        </div>
    </div>
    </div>
</section>

@stop

@section('js')
   
@stop