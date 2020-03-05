@extends('adminlte::page')

@section('title', 'ADL - Ver')

@section('content_header')
<section class="content-header">   
  <h1>ADL - Ver</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('adl.lista')}}">ADL - Lista</a></li>
  <li class="active">ADL - Ver</li>
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
                <v-label label="id_motivoconselho" title="Motivo ADL (Lei nº 16.544/2010)" link="https://goo.gl/L1m5Ps" icon="fa fa-link text-info">
                    <v-show dado="{{sistema('motivoconselho',$proc['id_motivoconselho'])}}"></v-show>
                </v-label>
                <v-label label="ac_desempenho_bl" title="Procedido incorretamente no desempenho do cargo ou função">
                    <v-show dado="{{$proc['ac_desempenho_bl']}}"></v-show>
                </v-label>
                <v-label label="ac_conduta_bl" title="Conduta irregular ou ato que venha a denegrir a imagem da Corporação">
                    <v-show dado="{{$proc['ac_conduta_bl']}}"></v-show>
                </v-label>
                <v-label label="ac_honra_bl" title="Praticado ato que afete a honra pessoal, o pundonor militar ou o decoro da classe">
                    <v-show dado="{{$proc['ac_honra_bl']}}"></v-show>
                </v-label>
                <v-label label="outromotivo" title="Especificar (no caso de outros motivos)">
                    <v-show dado="{{$proc['outromotivo']}}"></v-show>
                </v-label>
                <v-label label="id_situacaoconselho" title="Situação">
                    <v-show dado="{{sistema('situacaoconselho',$proc['id_situacaoconselho'])}}"></v-show>
                </v-label>
                <v-label label="id_decorrenciaconselho" title="Em decorrência de">
                    <v-show dado="{{sistema('situacaoconselho',$proc['id_decorrenciaconselho'])}}"></v-show>
                </v-label>
                <v-label label="portaria_numero" title="N° Portaria">
                    <v-show dado="{{$proc['portaria_numero']}}"></v-show>
                </v-label>
                <v-label label="portaria_data" title="Data da Portaria" icon="fa fa-calendar">
                    <v-show dado="{{$proc['portaria_data']}}"></v-show>
                </v-label>
                <v-label label="doc_tipo" title="Tipo de boletim">
                    <v-show dado="{{$proc['doc_tipo']}}"></v-show>
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
                <v-label label="sintese_txt" title="Sintese" lg="12" md="12">
                    <v-show dado="{{$proc['sintese_txt']}}"></v-show>
                </v-label>
            </v-tab-item>
            <v-tab-item title="Envolvidos" idp="envolvidos">
                <v-proced-origem dproc="adl" dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}" show></v-proced-origem><br>           
                <v-acusado unique idp="{{$proc['id_adl']}}" situacao="{{sistema('procSituacao','adl')}}" ></v-acusado><br>
                <v-vitima unique idp="{{$proc['id_adl']}}" ></v-vitima><br>
            </v-tab-item>
            <v-tab-item title="Envolvidos" idp="envolvidos">
                <v-proced-origem dproc="adl" dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}"></v-proced-origem><br>           
                <v-acusado dproc="adl" idp="{{$proc['id_adl']}}" situacao="{{sistema('procSituacao','adl')}}" ></v-acusado><br>
                <v-vitima dproc="adl" idp="{{$proc['id_adl']}}" ></v-vitima><br>
            </v-tab-item>
            <v-tab-item title="Documentos" idp="documentos">
                <file-upload 
                        title="Libelo:"
                        name="libelo_file"
                        dproc="adl"
                        idp="{{$proc['id_adl']}}"
                        :ext="['pdf']"
                        show 
                        ></file-upload>

                <file-upload 
                    title="Parecer:"
                    name="parecer_file"
                    dproc="adl"
                    idp="{{$proc['id_adl']}}"
                    :ext="['pdf']"
                    show
                    ></file-upload>
                <v-item-unique title="Parecer comissão" dproc="adl" idp="{{$proc['id_adl']}}" name="parecer_comissao"></v-item-unique>

                <file-upload 
                    title="Parecer CMT Geral:"
                    name="decisao_file"
                    dproc="adl"
                    idp="{{$proc['id_adl']}}"
                    :ext="['pdf']"
                    show
                    ></file-upload>
                <v-item-unique title="Parecer CMT Geral" dproc="adl" idp="{{$proc['id_adl']}}" name="parecer_cmtgeral"></v-item-unique>
            </v-tab-item>
            <v-tab-item title="Recursos" idp="recursos">
                <file-upload 
                    title="Reconsideração de ato (solução):"
                    name="rec_ato_file"
                    dproc="adl"
                    idp="{{$proc['id_adl']}}"
                    :ext="['pdf']"
                    show
                    >
                </file-upload>

                <file-upload 
                    title="Recurso CMT OPM:"
                    name="rec_cmt_file"
                    dproc="adl"
                    idp="{{$proc['id_adl']}}"
                    :ext="['pdf']"
                    show
                    >
                </file-upload>

                <file-upload 
                    title="Recurso CMT CRPM:"
                    name="rec_crpm_file"
                    dproc="adl"
                    idp="{{$proc['id_adl']}}"
                    :ext="['pdf']"
                    show
                    >
                </file-upload>

                <file-upload 
                    title="Recurso CMT Geral:"
                    name="rec_cg_file"
                    dproc="adl"
                    idp="{{$proc['id_adl']}}"
                    :ext="['pdf']"
                    show
                    >
                </file-upload>
            </v-tab-item>
            <v-tab-item title="Membros" idp="membros">
                <v-membro dproc='adl' idp="{{$proc['id_adl']}}" show></v-membro>
            </v-tab-item>
            <v-tab-item title="Movimentos" idp="movimentos">
                <v-movimento dproc='adl' idp="{{$proc['id_adl']}}" show></v-movimento>
            </v-tab-item>
            <v-tab-item title="Sobrestamentos" idp="sobrestamentos" >
                <v-sobrestamento dproc='adl' idp="{{$proc['id_adl']}}" show ></v-sobrestamento>
            </v-tab-item>
            <v-tab-item title="Encaminhamentos" idp="encaminhamentos">
                Encaminhamentos
            </v-tab-item>
            <v-tab-item title="Arquivo" idp="arquivo">
                <v-arquivo dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}" dproc='adl' idp="{{$proc['id_adl']}}" show ></v-arquivo>
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
