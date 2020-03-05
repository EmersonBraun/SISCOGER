@extends('adminlte::page')

@section('title', 'Proc. Outros - Ver')

@section('content_header')
<section class="content-header">   
  <h1>Proc. Outros - Ver</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('procoutro.lista',['ano' => date('Y')])}}">Proc. Outros - Lista</a></li>
  <li class="active">Proc. Outros - Ver</li>
  </ol>
  <br>
</section>
  
@stop

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
<section>
    <div class="nav-tabs-custom">
        <v-tab-menu
        :itens="[
            {idp: 'principal',name: 'Principal', cls: 'active'},
            {idp: 'envolvidos',name: 'Envolvidos'},
            {idp: 'documentos',name: 'Documentos'},
            {idp: 'resultado',name: 'Resultado'},
            {idp: 'membros',name: 'Membros'},
            {idp: 'movimentos',name: 'Movimentos'},
            {idp: 'encaminhamentos',name: 'Encaminhamentos'},
            {idp: 'arquivo',name: 'Arquivo'},

        ]">

        </v-tab-menu>
       
        <div class="tab-content">
            <v-tab-item title="N° {{ $proc['sjd_ref'] }} / {{ $proc['sjd_ref_ano'] }} - Formulário principal" idp="principal" cls="active show">
                <v-label label="id_andamento" title="Andamento" error="{{$errors->first('andamento')}}">
                    <v-show dado="{{$proc['andamento']}}"></v-show>
                </v-label>
                <v-label label="id_andamentocoger" title="Andamento COGER" error="{{$errors->first('andamentocoger')}}">
                    <v-show dado="{{$proc['andamentocoger']}}"></v-show>
                </v-label>
                <v-label label="num_pid" title="N° PID">
                    <v-show dado="{{$proc['num_pid']}}"></v-show>
                </v-label>
                <v-label label="data" title="Data da abertura" icon="fa fa-calendar">
                    <v-show dado="{{$proc['data']}}"></v-show>
                </v-label>
                <v-label label="abertura_data" title="Data de recebimento" icon="fa fa-calendar">
                    <v-show dado="{{$proc['abertura_data']}}"></v-show>
                </v-label>
                <v-label label="limite_data" title="Data limite" icon="fa fa-calendar">
                    <v-show dado="{{$proc['limite_data']}}"></v-show>
                </v-label>
                <v-label label="cdopm" title="OPM">
                    <v-show dado="{{$proc['cdopm']}}"></v-show>
                </v-label>
                <v-label label="doc_origem" title="Doc. Origem">
                    <v-show dado="{{$proc['doc_origem']}}"></v-show>
                </v-label>
                <v-label label="num_doc_origem" title="Nº Documento, ou descrição outros documentos">
                    <v-show dado="{{$proc['num_doc_origem']}}"></v-show>
                </v-label>
                <v-label label="motivo_abertura" title="Motivo Abertura">
                    <v-show dado="{{$proc['motivo_abertura']}}"></v-show>
                </v-label>
                <v-label label="desc_outros" title="Descrição outros motivos:">
                    <v-show dado="{{$proc['desc_outros']}}"></v-show>
                </v-label>
                <v-label label="id_municipio" title="Municipio">
                    <v-show dado="{{$proc['id_municipio']}}"></v-show>
                </v-label>
                --subform viaturas--
                <v-label label="sintese_txt" title="Sintese" lg="12" md="12" error="{{$errors->first('sintese_txt')}}">
                    <v-show dado="{{$proc['sintese_txt']}}"></v-show>
                </v-label>
            </v-tab-item>
            <v-tab-item title="Envolvidos" idp="envolvidos">
                <v-proced-origem dproc="proc_outros" dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}" show></v-proced-origem><br>           
                <v-acusado dproc="proc_outros" idp="{{$proc['id_proc_outros']}}" situacao="{{sistema('procSituacao','proc_outros')}}" show></v-acusado><br>
                <v-vitima dproc="proc_outros" idp="{{$proc['id_proc_outros']}}" show></v-vitima><br>
            </v-tab-item>
            <v-tab-item title="Documentos" idp="documentos">
                <file-upload 
                        title="Documento Juntado:"
                        name="relatorio1_file"
                        dproc="proc_outros" idp="{{$proc['id_proc_outros']}}"
                        :ext="['pdf']"
                        show 
                        ></file-upload>
            </v-tab-item>
            <v-tab-item title="Resultado" idp="resultado">
                <v-proced-origem dproc="proc_outros" destino dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}" show></v-proced-origem><br>
            </v-tab-item>
            <v-tab-item title="Membros" idp="membros">
                <v-membro dproc="proc_outros" idp="{{$proc['id_proc_outros']}}" show></v-membro>
            </v-tab-item>
            <v-tab-item title="Movimentos" idp="movimentos">
                <v-movimento dproc="proc_outros" idp="{{$proc['id_proc_outros']}}" show></v-movimento>
            </v-tab-item>
            <v-tab-item title="Encaminhamentos" idp="encaminhamentos">
                --Encaminhamentos, em desenvolvimento--
            </v-tab-item>
            <v-tab-item title="Arquivo" idp="arquivo">
                <v-arquivo dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}" dproc="proc_outros" idp="{{$proc['id_proc_outros']}}" show></v-arquivo>
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

