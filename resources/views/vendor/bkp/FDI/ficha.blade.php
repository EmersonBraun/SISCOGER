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
        @include('vendor.FDI.principal')

    <div class="nav-tabs-custom">
        @include('vendor.FDI.tabs')
            <div class="tab-content">
                @include('vendor.FDI.denuncias')
                @include('vendor.FDI.outras_denuncias')
                @include('vendor.FDI.prisoes')
                @include('vendor.FDI.restricoes')
                @include('vendor.FDI.sai')
                @include('vendor.FDI.fdi')
                @include('vendor.FDI.objeto')
                @include('vendor.FDI.membro')
                @include('vendor.FDI.apresentacoes')
                @include('vendor.FDI.proc_outros')
            </div>
            <!-- /.tab-content -->
          </div>
        @include('vendor.FDI.afastamentos')
        @include('vendor.FDI.dependentes')
        @include('vendor.FDI.tramitecoger')
        @include('vendor.FDI.tramiteopm')
    <div>
        <input type="button" onclick="cont();" value="Imprimir">
    </div>


@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script type="text/javascript">

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
@stop