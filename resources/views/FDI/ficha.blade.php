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
            <v-principal :pm="{{$pm}}"></v-principal>
        </div>     
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <v-tabs nav-style="pills" justified>
                        @if(hasPermissionTo('ver-protocolo-fdi'))
                            <v-protocolo rg="{{$pm->RG}}"></v-protocolo>
                        @endif
                        @if(hasPermissionTo('ver-denuncias'))
                            <v-denuncias rg="{{$pm->RG}}"></v-denuncias>
                        @endif
                        @if(hasPermissionTo('ver-outras-denuncias'))
                            <v-outras-denuncias :pm="{{$pm}}"></v-outras-denuncias>
                        @endif
                        @if(hasPermissionTo('ver-prisoes'))
                            <v-prisoes :pm="{{$pm}}"></v-prisoes>
                        @endif
                        @if(hasPermissionTo('ver-restricoes'))
                            <v-restricoes :pm="{{$pm}}"></v-restricoes>
                        @endif
                        @if(hasPermissionTo('listar-sai'))
                            <v-sai rg="{{$pm->RG}}"></v-sai>
                        @endif
                        @if(hasAnyPermission(['ver-mudanca-comportamento','ver-elogios']))
                            <v-fdi :pm="{{$pm}}"></v-fdi>
                        @endif
                        @if(hasPermissionTo('listar-punidos'))
                            <v-punicao :pm="{{$pm}}"></v-punicao>
                        @endif
                        @if(hasPermissionTo('ver-objetos'))
                            <v-objeto rg="{{$pm->RG}}"></v-objeto>
                        @endif
                        @if(hasPermissionTo('ver-membros'))
                            <v-membro rg="{{$pm->RG}}"></v-membro>
                        @endif
                        @if(hasPermissionTo('ver-aprestacoes'))
                            <v-apresentacoes rg="{{$pm->RG}}"></v-apresentacoes>
                        @endif
                        @if(hasPermissionTo('ver-proc-outros'))
                            <v-proc-outros rg="{{$pm->RG}}"></v-proc-outros>
                        @endif
                    </v-tabs>
                </div>   
            </div>
        </div>  
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <v-tabs nav-style="pills" justified>
                        @if(hasPermissionTo('ver-afastamentos'))
                            <v-afastamentos rg="{{$pm->RG}}"></v-afastamentos>
                        @endif
                        @if(hasPermissionTo('ver-cautelas'))
                            <v-cautelas rg="{{$pm->RG}}"></v-cautelas>
                        @endif
                        @if(hasPermissionTo('ver-dependentes'))
                            <v-dependentes rg="{{$pm->RG}}"></v-dependentes>
                        @endif
                        @if(hasPermissionTo('ver-tramite-coger'))
                            <v-tramite-coger :pm="{{$pm}}"></v-tramite-coger>
                        @endif
                        @if(hasPermissionTo('ver-tramite-opm'))
                            <v-tramite-opm :pm="{{$pm}}"></v-tramite-opm>
                        @endif
                    </v-tabs>
                </div>   
            </div>
            @if(session('is_admin'))
                <v-log-fdi rg="{{$pm->RG}}"></v-log-fdi>
            @endif   
        </div> 
    </div>      
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