@extends('adminlte::page')

@section('title', 'PAD - Visualizar')

@section('content_header')
<section class="content-header">   
  <h1>PAD - Visualizar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('pad.lista')}}">PAD - Lista</a></li>
  <li class="active">PAD - Visualizar</li>
  </ol>
</section>
@stop

@section('content')

<div class="">
<section>
    <div class="nav-tabs-custom">
        <v-tab-menu
        :itens="[
            {idp: 'principal',name: 'Principal', cls: 'active'},
            {idp: 'envolvidos',name: 'Envolvidos'},
            {idp: 'documentos',name: 'Documentos'},
            {idp: 'recursos',name: 'Recursos'},
            {idp: 'membros',name: 'Membros'},
            {idp: 'movimentos',name: 'Movimentos'},
            {idp: 'sobrestamentos',name: 'Sobrestamentos'},
            {idp: 'encaminhamentos',name: 'Encaminhamentos'},
            {idp: 'arquivo',name: 'Arquivo'},

        ]">

        </v-tab-menu>
        
        <div class="tab-content">
            <v-tab-item title="N° {{ $proc['sjd_ref'] }} / {{ $proc['sjd_ref_ano'] }} - Formulário principal" idp="principal" cls="active show">
                <v-label label="id_andamento" title="Andamento">
                    <v-show dado="{{sistema('andamento',$proc['id_andamento'])}}"></v-show>
                </v-label>
                <v-label label="id_andamentocoger" title="Andamento COGER">
                    <v-show dado="{{sistema('andamentocoger',$proc['id_andamentocoger'])}}"></v-show>
                </v-label>
                <v-label label="doc_origem_txt" title="Documentos de origem">
                    <v-show dado="{{$proc['doc_origem_txt']}}"></v-show>
                </v-label>
                <v-label label="fato_data" title="Data da fato" icon="fa fa-calendar">
                    <v-show dado="{{$proc['fato_data']}}"></v-show>
                </v-label>
                <v-label label="cdopm" title="OPM">
                    <v-show dado="{{$proc['cdopm']}}"></v-show>
                </v-label>
                <v-label label="portaria_numero" title="N° Portaria">
                    <v-show dado="{{$proc['portaria_numero']}}"></v-show>
                </v-label>
                <v-label label="portaria_data" title="Data da Portaria" icon="fa fa-calendar">
                    <v-show dado="{{$proc['portaria_data']}}"></v-show>
                </v-label>
                <v-label label="doc_tipo" title="Tipo de boletim">
                    <v-show dado="{{sistema('tipoBoletim',$proc['doc_tipo'])}}"></v-show>
                </v-label>
                <v-label label="doc_numero" title="N° Boletim">
                    <v-show dado="{{$proc['doc_numero']}}"></v-show>
                </v-label>
                <v-label label="abertura_data" title="Data da abertura" icon="fa fa-calendar">
                    <v-show dado="{{$proc['abertura_data']}}"></v-show>
                </v-label>
                <v-label label="sintese_txt" title="Sintese" lg="12" md="12" error="{{$errors->first('sintese_txt')}}">
                    <v-show dado="{{$proc['sintese_txt']}}"></v-show>
                </v-label>
            </v-tab-item>
            <v-tab-item title="Envolvidos" idp="envolvidos">      
                <v-acusado dproc="pad" idp="{{$proc['id_iso']}}" situacao="{{sistema('procSituacao','iso')}}" show></v-acusado><br>
                <v-vitima dproc="pad" idp="{{$proc['id_iso']}}" show></v-vitima><br>
                ---falta pessoa juridica---
            </v-tab-item>
            <v-tab-item title="Documentos" idp="documentos">
                <file-upload 
                    title="Relatório:"
                    name="relatorio_file"
                    dproc="pad" idp="{{$proc['id_iso']}}"
                    :ext="['pdf']"
                    show 
                    ></file-upload>

                <file-upload 
                    title="Solução:"
                    name="solucao_file"
                    dproc="pad" idp="{{$proc['id_iso']}}"
                    :ext="['pdf']"
                    show
                    ></file-upload>
            </v-tab-item>
            <v-tab-item title="Membros" idp="membros">
                <v-membro dproc="pad" idp="{{$proc['id_iso']}}" show></v-membro>
            </v-tab-item>
            <v-tab-item title="Movimentos" idp="movimentos">
                <v-movimento dproc="pad" idp="{{$proc['id_iso']}}" show></v-movimento>
            </v-tab-item>
            <v-tab-item title="Sobrestamentos" idp="sobrestamentos">
                <v-sobrestamento dproc="pad" idp="{{$proc['id_iso']}}" show></v-sobrestamento>
            </v-tab-item>
            <v-tab-item title="Encaminhamentos" idp="encaminhamentos">
                Encaminhamentos
            </v-tab-item>
            <v-tab-item title="Arquivo" idp="arquivo">
                <v-arquivo dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}" dproc="pad" idp="{{$proc['id_iso']}}" show></v-arquivo>
            </v-tab-item>
        </div>
    </div>

    <div class="content-footer">
        <br>
        
    </div>

</section>
@stop

@section('css')
@stop

@section('js')
@include('vendor.adminlte.includes.vue')
@stop

