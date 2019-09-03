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
            <v-principal rg="{{$rg}}"></v-principal>
        </div>     
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <v-tabs nav-style="pills" justified>
                        @if(hasPermissionTo('ver-denuncias'))
                            <v-denuncias rg="{{$rg}}"></v-denuncias>
                        @endif
                        @if(hasPermissionTo('ver-outras-denuncias'))
                            <v-outras-denuncias rg="{{$rg}}"></v-outras-denuncias>
                        @endif
                        @if(hasPermissionTo('ver-prisoes'))
                            <v-prisoes rg="{{$rg}}"></v-prisoes>
                        @endif
                        @if(hasPermissionTo('ver-restricoes'))
                            <v-restricoes rg="{{$rg}}"></v-restricoes>
                        @endif
                        @if(hasPermissionTo('listar-sai'))
                            <v-sai rg="{{$rg}}"></v-sai>
                        @endif
                        @if(hasAnyPermission(['ver-mudanca-comportamento','ver-elogios']))
                            <v-fdi rg="{{$rg}}"></v-fdi>
                        @endif
                        @if(hasPermissionTo('ver-objetos'))
                            <v-objeto rg="{{$rg}}"></v-objeto>
                        @endif
                        @if(hasPermissionTo('ver-membros'))
                            <v-membro rg="{{$rg}}"></v-membro>
                        @endif
                        @if(hasPermissionTo('ver-aprestacoes'))
                            <v-apresentacoes rg="{{$rg}}"></v-apresentacoes>
                        @endif
                        @if(hasPermissionTo('ver-proc-outros'))
                            <v-proc-outros rg="{{$rg}}"></v-proc-outros>
                        @endif
                        @if(hasPermissionTo('ver-cautelas'))
                            <v-cautelas rg="{{$rg}}"></v-cautelas>
                        @endif
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
    @if(session('is_admin'))
        <v-log-fdi rg="{{$rg}}"></v-log-fdi>
    @endif
    {{-- <div>
        <input type="button" onclick="cont();" value="Imprimir">
    </div> --}}
</section>
@stop

@section('css')
@stop

@section('js')
@include('vendor.adminlte.includes.vue')
@stop