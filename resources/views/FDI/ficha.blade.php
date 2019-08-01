@extends('adminlte::page')

@section('title_postfix', '| FDI')

@section('content_header')
<section class="content-header">   
<h1><i class='fa fa-user'></i> Ficha Individual:</h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('busca.pm')}}">Busca PM/BM</a></li>
    <li class="breadcrumb-item active">FDI - Visualizar</li>
</ol>
</section>
<div class="form-group col-md-4"> 
    <a class="btn btn-default col-md-6 col-xs-6"  href="#" onclick="expandirTudo()">Expandir tudo</a>
    <a class="btn btn-default col-md-6 col-xs-6"  href="#" onclick="recolherTudo()">Recolher Tudo</a>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        @include('FDI.principal')

    <div class="nav-tabs-custom">
        @include('FDI.tabs')
            <div class="tab-content">
                @include('FDI.denuncias')
                @include('FDI.outras_denuncias')
                @include('FDI.prisoes')
                @include('FDI.restricoes')
                @include('FDI.sai')
                @include('FDI.fdi')
                @include('FDI.objeto')
                @include('FDI.membro')
                @include('FDI.apresentacoes')
                @include('FDI.proc_outros')
                <div class="tab-pane" id="cautelas">
                    <v-cautelas rg="{{$pm->RG}}"></v-cautelas>
                </div>
            </div>
            <!-- /.tab-content -->
        </div>
        @can('ver-afastamentos')
            @include('FDI.afastamentos')
        @endcan
        @can('ver-dependentes')
            @include('FDI.dependentes')
        @endcan
        @can('ver-tramite-coger')
            @include('FDI.tramitecoger')
        @endcan
        @can('ver-tramite-opm')
            @include('FDI.tramiteopm')
        @endcan
    <div>
        <input type="button" onclick="cont();" value="Imprimir">
    </div>


@stop

@section('css')
@stop

@section('js')
<script type="text/javascript">
$( document ).ready(function() {
    $('.a').first().addClass('active');
});

function mudaTab(id)
{
    $('.a').removeClass('active');
    $('.'+id).addClass('active');
    $('.tab-pane').removeClass('show');
    $('.tab-pane').removeClass('active');
    $('#'+id).addClass('active');
    $('#'+id).addClass('show');
}
</script>
@include('vendor.adminlte.includes.vue')
@stop