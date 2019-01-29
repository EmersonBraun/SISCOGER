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
    @include('home.graficos')
</section>

@stop

@section('js')
   
@stop