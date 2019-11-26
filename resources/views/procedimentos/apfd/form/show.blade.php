@extends('adminlte::page')

@section('title', 'APFD - Visualizar')

@section('content_header')
<section class="content-header">   
  <h1>APFD - Visualizar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('apfd.lista')}}">APFD - Lista</a></li>
  <li class="active">APFD - Visualizar</li>
  </ol>
</section>
@stop

@section('content')
<section>
    <div class="nav-tabs-custom">
        <v-tab-menu
        :itens="[
            {idp: 'principal',name: 'Principal', cls: 'active'},
            {idp: 'envolvidos',name: 'Envolvidos'},
            {idp: 'membros',name: 'Membros'},
            {idp: 'movimentos',name: 'Movimentos'},
            {idp: 'encaminhamentos',name: 'Encaminhamentos'},
            {idp: 'arquivo',name: 'Arquivo'},

        ]">

        </v-tab-menu>
        
        <div class="tab-content">
            <v-tab-item title="N° {{ $proc['sjd_ref'] }} / {{ $proc['sjd_ref_ano'] }} - Formulário principal" idp="principal" cls="active show">
                <v-label label="cdopm" title="OPM" error="{{$errors->first('cdopm')}}">
                    <v-show dado="{{$proc['cdopm']}}"></v-show>
                </v-label>
                <v-label label="id_andamentocoger" title="Andamento COGER">
                    <v-show dado="{{sistema('andamentocoger',$proc['id_andamentocoger'])}}"></v-show>
                </v-label>
                <v-label label="tipo" title="Tipo" error="{{$errors->first('tipo')}}">
                        <v-show dado="{{$proc['tipo']}}"></v-show>
                </v-label>
                <v-label label="fato_data" title="Data do fato">
                    <v-show dado="{{$proc['fato_data']}}"></v-show>
                </v-label>
                <v-label label="sintese_txt" title="Síntese do fato (Quem, quando, onde, como e por quê): " lg="12" md="12" error="{{$errors->first('sintese_txt')}}">
                    <v-show dado="{{$proc['sintese_txt']}}"></v-show>
                </v-label>
                <v-label label="tipo_penal_novo" title="Tipos penais">
                    <v-show dado="{{sistema('tipo_penal_novo',$proc['tipo_penal_novo'])}}"></v-show>
                </v-label>
                <v-label label="especificar" title="Especificar (Caso tipo penal OUTROS): ">
                    <v-show dado="{{$proc['especificar']}}"></v-show>
                </v-label>
                <v-label label="doc_tipo" title="Documento da publicação: ">
                    <v-show dado="{{$proc['doc_tipo']}}"></v-show>
                </v-label>
                <v-label label="doc_tipo" title="N° Documento da publicação: ">
                    <v-show dado="{{$proc['doc_tipo']}}"></v-show>
                </v-label>
                <v-label label="referenciavajme" title="Referencia da VAJME (Nº do processo e vara)" >
                    <v-show dado="{{$proc['referenciavajme']}}"></v-show>
                </v-label>
            </v-tab-item>
            <v-tab-item title="Envolvidos" idp="envolvidos">      
                <v-acusado unique dproc="apfd" idp="{{$proc['id_apfd']}}" situacao="{{sistema('procSituacao','apfd')}}" ></v-acusado><br>
                <v-vitima unique dproc="apfd" idp="{{$proc['id_apfd']}}" ></v-vitima><br>
            </v-tab-item>
            <v-tab-item title="Membros" idp="membros">
                <v-membro unique dproc="apfd" idp="{{$proc['id_apfd']}}"></v-membro>
            </v-tab-item>
            <v-tab-item title="Movimentos" idp="movimentos">
                <v-movimento unique dproc="apfd" idp="{{$proc['id_apfd']}}" opm="{{session('opm_descricao')}}" rg="{{session('rg')}}" :admin="{{session('is_admin')}}"></v-movimento>
            </v-tab-item>
            <v-tab-item title="Encaminhamentos" idp="encaminhamentos">
                Encaminhamentos
            </v-tab-item>
            <v-tab-item title="Arquivo" idp="arquivo">
                <v-arquivo dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}" unique dproc="apfd" idp="{{$proc['id_apfd']}}" ></v-arquivo>
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

