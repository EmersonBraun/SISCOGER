@extends('adminlte::page')

@section('title_postfix', '| FDI')

@section('content_header')
<section class="content-header noppading">   
<h1><i class='fa fa-user'></i> Ficha Individual:</h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="{{route('busca.pm')}}">Busca PM/BM</a></li>
    <li class="breadcrumb-item active">FDI - Visualizar</li>
</ol>
</section>
@stop

@section('content')
<section class="noppading">
    <div class="row">
        <div class="col-xs-12">
            {{-- @include('FDI.principal') --}}
            <v-principal rg="{{$rg}}"></v-principal>
        </div>     
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <v-tabs nav-style="pills" justified>
                        <v-denuncias rg="{{$rg}}"></v-denuncias>
                        <v-tab header="outras_denuncias">
                            @include('FDI.outras_denuncias')
                        </v-tab>
                        <v-tab header="prisoes">
                            @include('FDI.prisoes')
                        </v-tab>
                        <v-tab header="restricoes">
                            @include('FDI.restricoes')
                        </v-tab>
                        <v-tab header="sai">
                            @include('FDI.sai')
                        </v-tab>
                        <v-tab header="fdi">
                            @include('FDI.fdi')
                        </v-tab>
                        <v-tab header="objeto">
                            @include('FDI.objeto')
                        </v-tab>
                        <v-tab header="membro">
                            @include('FDI.membro')
                        </v-tab>
                        <v-apresentacoes rg="{{$rg}}"></v-apresentacoes>
                        <v-tab header="proc_outros">
                            @include('FDI.proc_outros')
                        </v-tab>
                        <v-tab header="cautelas">
                            <v-cautelas rg="{{$rg}}"></v-cautelas>
                        </v-tab>
                    </v-tabs>
                </div>   
            </div>
        </div>     
    </div>      

    @if(hasPermissionTo('ver-afastamentos'))
        <v-afastamentos rg="{{$rg}}"></v-afastamentos>
    @endif
    @if(hasPermissionTo('ver-dependentes'))
        <v-dependentes rg="{{$rg}}"></v-dependentes>
    @endif
    @if(hasPermissionTo('ver-tramite-coger'))
        <v-tramite-coger rg="{{$rg}}"></v-tramite-coger>
    @endif
    @if(hasPermissionTo('ver-tramite-opm'))
        <v-tramite-opm rg="{{$rg}}"></v-tramite-opm>
    @endif
    <div>
        <input type="button" onclick="cont();" value="Imprimir">
    </div>
</section>
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