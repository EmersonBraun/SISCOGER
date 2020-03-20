@extends('adminlte::page')

@section('title', 'CJ - Visualizar')

@section('content_header')
<section class="content-header">   
  <h1>CJ - Visualizar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('cj.lista')}}">CJ - Lista</a></li>
  <li class="active">CJ - Visualizar</li>
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
                {idp: 'acordaos',name: 'Acórdãos'},
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
                    <v-label label="id_motivoconselho" title="Motivo CJ (Lei nº 16.544/2010)" link="https://goo.gl/L1m5Ps" icon="fa fa-link text-info">
                        <v-show dado="{{sistema('motivoConselho',$proc['id_motivoconselho'])}}"></v-show> 
                    </v-label>
                    <v-label label="id_situacaoconselho" title="Situação">
                        <v-show dado="{{sistema('situacaoConselho',$proc['id_situacaoconselho'])}}"></v-show> 
                    </v-label>
                    <v-label label="id_decorrenciaconselho" title="Em decorrência de">
                        <v-show dado="{{sistema('decorrenciaConselho',$proc['id_decorrenciaconselho'])}}"></v-show> 
                    </v-label>
                    <v-label label="outromotivo" title="Especificar (no caso de outros motivos)">
                        <v-show dado="{{$proc['outromotivo']}}"></v-show> 
                    </v-label>
                    <v-label label="portaria_numero" title="N° Portaria CG">
                        <v-show dado="{{$proc['portaria_numero']}}"></v-show>
                    </v-label>
                    <v-label label="portaria_data" title="Data da Portaria do CG" icon="fa fa-calendar">
                        <v-show dado="{{$proc['portaria_data']}}"></v-show>
                    </v-label>
                    <v-label label="doc_tipo" title="Tipo de boletim">
                        <v-show dado="{{sistema('tipoBoletim',$proc['doc_tipo'])}}"></v-show>
                    </v-label>
                    <v-label label="doc_numero" title="N° Boletim">
                        <v-show dado="{{$proc['doc_numero']}}"></v-show>
                    </v-label>
                    <v-label label="fato_data" title="Data da fato" icon="fa fa-calendar">
                        <v-show dado="{{$proc['fato_data']}}"></v-show>
                    </v-label>
                    <v-label label="abertura_data" title="Data da abertura" icon="fa fa-calendar">
                        <v-show dado="{{$proc['abertura_data']}}"></v-show>
                    </v-label>
                    <v-label label="prescricao_data" title="Data da prescricao" icon="fa fa-calendar">
                        <v-show dado="{{$proc['prescricao_data']}}"></v-show>
                    </v-label>
                    <v-label label="doc_prorrogacao" title="Documento da prorrogação de prazo">
                        <v-show dado="{{$proc['doc_prorrogacao']}}"></v-show>
                    </v-label>
                    <v-label label="sintese_txt" title="Sintese" lg="12" md="12">
                        <v-show dado="{{$proc['sintese_txt']}}"></v-show>
                    </v-label>
                </v-tab-item>
                <v-tab-item title="Envolvidos" idp="envolvidos">
                    <v-proced-origem dproc="cj" dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}" show></v-proced-origem><br>           
                    <v-acusado dproc="cj" idp="{{$proc['id_cj']}}" situacao="{{sistema('procSituacao','cj')}}" show ></v-acusado><br>
                    <v-vitima dproc="cj" idp="{{$proc['id_cj']}}" show ></v-vitima><br>
                </v-tab-item>
                <v-tab-item title="Documentos" idp="documentos">
                <file-upload 
                        title="Documento Juntado:"
                        name="relato_enc_file"
                        dproc="cj" idp="{{$proc['id_cj']}}"
                        :ext="['pdf']"
                        show 
                        ></file-upload>
                        <v-item-unique title="Data" proc="cj" dproc="cj" idp="{{$proc['id_cj']}}" name="relato_enc_data" show></v-item-unique>
                <v-item-unique title="Conclusão do encarregado" proc="cj" dproc="cj" idp="{{$proc['id_cj']}}" name="relato_enc" show></v-item-unique>
                <file-upload 
                title="PDF - Solução do Cmt OPM:"
                name="relato_cmtopm_file"
                dproc="cj" idp="{{$proc['id_cj']}}"
                :ext="['pdf']"
                show 
                ></file-upload>
                <v-item-unique title="Data" proc="cj" dproc="cj" idp="{{$proc['id_cj']}}" name="relato_cmtopm_data" show></v-item-unique>
                <v-item-unique title="Conclusão do Cmt. OPM" proc="cj" dproc="cj" idp="{{$proc['id_cj']}}" name="relato_cmtopm" show></v-item-unique>
                <file-upload 
                title="PDF - Decisão do Cmt Geral:"
                name="relato_cmtgeral_file"
                dproc="cj" idp="{{$proc['id_cj']}}"
                :ext="['pdf']"
                show 
                ></file-upload>
                <v-item-unique title="Data" proc="cj" dproc="cj" idp="{{$proc['id_cj']}}" name="relato_cmtgeral_data" show></v-item-unique>
                <v-item-unique title="Conclusão do Cmt. Geral" proc="cj" dproc="cj" idp="{{$proc['id_cj']}}" name="relato_cmtgeral" show></v-item-unique>
                
                <file-upload 
                    title="Relatório complementar"
                    name="relcomplemtentar_file"
                    dproc="cj" idp="{{$proc['id_cj']}}"
                    :ext="['pdf']"
                    show 

                    >
                </file-upload>
                </v-tab-item>
                <v-tab-item title="Acórdãos" idp="acordaos">
                    <file-upload 
                        title="TJ-PR:"
                        name="tjpr_file"
                        dproc="cj" idp="{{$proc['id_cj']}}"
                        :ext="['pdf']"
                        show 
                        ></file-upload>
    
                    <file-upload 
                        title="STJ/STF:"
                        name="stj_file"
                        dproc="cj" idp="{{$proc['id_cj']}}"
                        :ext="['pdf']"
                        show 
                        ></file-upload>
                </v-tab-item>
                <v-tab-item title="Recursos" idp="recursos">
                    <file-upload 
                        title="Reconsideração de ato (solução):"
                        name="rec_ato_file"
                        dproc="cj" idp="{{$proc['id_cj']}}"
                        :ext="['pdf']"
                        show 
                        >
                    </file-upload>
    
                    <file-upload 
                        title="Recurso ao Governador (solução):"
                        name="rec_gov_file"
                        dproc="cj" idp="{{$proc['id_cj']}}"
                        :ext="['pdf']"
                        show 
                        >
                    </file-upload>
                </v-tab-item>
                <v-tab-item title="Membros" idp="membros">
                    <v-membro dproc="cj" idp="{{$proc['id_cj']}}" show></v-membro>
                </v-tab-item>
                <v-tab-item title="Movimentos" idp="movimentos">
                    <v-movimento dproc="cj" idp="{{$proc['id_cj']}}" show></v-movimento>
                </v-tab-item>
                <v-tab-item title="Sobrestamentos" idp="sobrestamentos" show>
                    <v-sobrestamento dproc="cj" idp="{{$proc['id_cj']}}" show ></v-sobrestamento>
                </v-tab-item>
                <v-tab-item title="Encaminhamentos" idp="encaminhamentos">
                    Encaminhamentos
                </v-tab-item>
                <v-tab-item title="Arquivo" idp="arquivo">
                    <v-arquivo dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}" dproc="cj" idp="{{$proc['id_cj']}}" show ></v-arquivo>
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

