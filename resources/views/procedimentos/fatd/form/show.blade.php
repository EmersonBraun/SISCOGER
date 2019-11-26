@extends('adminlte::page')

@section('title', 'fatd - Visualizar')

@section('content_header')
<section class="content-header">   
  <h1>FATD - Visualizar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('fatd.lista',['ano' => date('Y')])}}">Fatd - Lista</a></li>
  <li class="active">FATD - Visualizar</li>
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
                <v-label label="cdopm" title="OPM" >
                    <v-show dado="{{$proc['cdopm']}}"></v-show>
                </v-label>
                <v-label label="motivo_fatd" title="Motivo" >
                    <v-show dado="{{sistema('motivoFATD',$proc['motivo_fatd'])}}"></v-show>
                </v-label>
                <v-label label="outromotivo" title="Especificar (no caso de outros motivos)">
                    <v-show dado="{{$proc['outromotivo']}}"></v-show>
                </v-label>
                <v-label label="situacao_fatd" title="Situação">
                    <v-show dado="{{sistema('situacaoOCOR',$proc['situacao_fatd'])}}"></v-show>
                </v-label>
                <v-label label="despacho_numero" title="Nº do despacho que designa o Encarregado">
                    <v-show dado="{{$proc['despacho_numero']}}"></v-show>
                </v-label>
                <v-label label="portaria_data" title="Data do despacho" icon="fa fa-calendar">
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
                <v-label label="sintese_txt" title="Sintese" lg="12" md="12" >
                    <v-show dado="{{$proc['sintese_txt']}}"></v-show>
                </v-label>
            </v-tab-item>
            <v-tab-item title="Envolvidos" idp="envolvidos">
                <v-proced-origem unique dproc="fatd" dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}"></v-proced-origem><br>           
                <v-acusado unique dproc="fatd" idp="{{$proc['id_fatd']}}" situacao="{{sistema('procSituacao','fatd')}}" ></v-acusado><br>
                <v-vitima unique dproc="fatd" idp="{{$proc['id_fatd']}}" ></v-vitima><br>
            </v-tab-item>
            <v-tab-item title="Documentos" idp="documentos">
                <file-upload 
                unique
                title="Relato do fato imputado:"
                name="fato_file"
                dproc="fatd" idp="{{$proc['id_fatd']}}"
                :ext="['pdf']" 
                ></file-upload>

                <file-upload 
                unique
                title="Relatório:"
                name="relatorio_file"
                dproc="fatd" idp="{{$proc['id_fatd']}}"
                :ext="['pdf']" 
                ></file-upload>

                <file-upload 
                unique
                title="Solução do Comandante:"
                name="sol_cmt_file"
                dproc="fatd" idp="{{$proc['id_fatd']}}"
                :ext="['pdf']" 
                ></file-upload>

                <file-upload 
                unique
                title="Solução do Cmt Geral:"
                name="sol_cg_file"
                dproc="fatd" idp="{{$proc['id_fatd']}}"
                :ext="['pdf']" 
                ></file-upload>

                <file-upload 
                unique
                title="Nota de punição:"
                name="notapunicao_file"
                dproc="fatd" idp="{{$proc['id_fatd']}}"
                :ext="['pdf']" 
                ></file-upload>

                <v-item-unique unique title="Publicação da nota de punição (Ex: BI nº 12/2011)" proc="fatd" dproc="fatd" idp="{{$proc['id_fatd']}}" name="publicacaonp"></v-item-unique>
            </v-tab-item>
            <v-tab-item title="Recursos" idp="recursos">
                <file-upload 
                    unique
                    title="Reconsideração de ato (solução):"
                    name="rec_ato_file"
                    dproc="fatd" idp="{{$proc['id_fatd']}}"
                    :ext="['pdf']" 
                    ></file-upload>

                <file-upload 
                    unique
                    title="Recurso CMT OPM:"
                    name="rec_cmt_file"
                    dproc="fatd" idp="{{$proc['id_fatd']}}"
                    :ext="['pdf']" 
                    ></file-upload>

                <file-upload 
                    unique
                    title="Recurso CMT CRPM:"
                    name="rec_crpm_file"
                    dproc="fatd" idp="{{$proc['id_fatd']}}"
                    :ext="['pdf']" 
                    ></file-upload>

                <file-upload
                    unique 
                    title="Recurso CMT Geral:"
                    name="rec_cg_file"
                    dproc="fatd" idp="{{$proc['id_fatd']}}"
                    :ext="['pdf']" 
                    ></file-upload>
            </v-tab-item>
            <v-tab-item title="Membros" idp="membros">
                <v-membro unique dproc="fatd" idp="{{$proc['id_fatd']}}"></v-membro>
            </v-tab-item>
            <v-tab-item title="Movimentos" idp="movimentos">
                <v-movimento unique dproc="fatd" idp="{{$proc['id_fatd']}}"></v-movimento>
            </v-tab-item>
            <v-tab-item title="Sobrestamentos" idp="sobrestamentos">
                <v-sobrestamento unique dproc="fatd" idp="{{$proc['id_fatd']}}" ></v-sobrestamento>
            </v-tab-item>
            <v-tab-item title="Encaminhamentos" idp="encaminhamentos">
                Encaminhamentos
            </v-tab-item>
            <v-tab-item title="Arquivo" idp="arquivo">
                <v-arquivo unique dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}" dproc="fatd" idp="{{$proc['id_fatd']}}" ></v-arquivo>
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

