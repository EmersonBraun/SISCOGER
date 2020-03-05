@extends('adminlte::page')

@section('title', 'IPM - Ver')

@section('content_header')
<section class="content-header">   
  <h1>IPM - Ver</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('ipm.lista',['ano' => date('Y')])}}">IPM - Lista</a></li>
  <li class="active">IPM - Ver</li>
  </ol>
  <br>
</section>
@stop

@section('content')
<div class="">
<section>
    <div class="nav-tabs-custom">
        <v-tab-menu
        :itens="[
            {idp: 'principal',name: 'Principal', cls: 'active'},
            {idp: 'indiciados',name: 'Indiciados'},
            {idp: 'documentos',name: 'Documentos'},
            {idp: 'membros',name: 'Membros'},
            {idp: 'movimentos',name: 'Movimentos'},
            {idp: 'sobrestamentos',name: 'Sobrestamentos'},
            {idp: 'encaminhamentos',name: 'Encaminhamentos'},
            {idp: 'vajme',name: 'Vajme'},
            {idp: 'arquivo',name: 'Arquivo'},
        ]">
        </v-tab-menu>
        <div class="tab-content">
            <v-tab-item title="N° {{ $proc['sjd_ref'] }} / {{ $proc['sjd_ref_ano'] }} - Formulário principal" idp="principal" cls="active show">
                <v-label label="id_andamento" title="Andamento" error="{{$errors->first('id_andamento')}}">
                    <v-show dado="{{sistema('andamento',$proc['id_andamento'])}}"></v-show>
                </v-label>
                <v-label label="id_andamentocoger" title="Andamento COGER" error="{{$errors->first('id_andamentocoger')}}">
                    <v-show dado="{{sistema('andamentocoger',$proc['id_andamentocoger'])}}"></v-show>
                </v-label>
                <v-label label="cdopm" title="OPM" error="{{$errors->first('cdopm')}}">
                    <v-show dado="{{$proc['cdopm']}}"></v-show>
                </v-label>
                <v-label label="fato_data" title="Data da fato" icon="fa fa-calendar">
                    <v-show dado="{{$proc['fato_data']}}"></v-show>
                </v-label>
                <v-label label="abertura_data" title="Data da portaria de delegação de poderes" icon="fa fa-calendar">
                    <v-show dado="{{$proc['abertura_data']}}"></v-show>
                </v-label>
                <v-label label="autuacao_data" title="Data da portaria de instauração" icon="fa fa-calendar">
                    <v-show dado="{{$proc['autuacao_data']}}"></v-show>
                </v-label>
                <v-label label="portaria_numero" title="Nº da portaria de delegação de poderes">
                    <v-show dado="{{$proc['portaria_numero']}}"></v-show>
                </v-label>
                <v-label label="crime" title="Crime">
                    <v-show dado="{{sistema('crime',$proc['crime'])}}"></v-show>
                </v-label>
                <v-label label="id_municipio" title="Municipio">
                    <v-show dado="{{$proc['id_municipio']}}"></v-show>
                </v-label>
                <v-label label="bou_ano" title="BOU (Ano)">
                    <v-show dado="{{$proc['bou_ano']}}"></v-show>
                </v-label>
                <v-label label="bou_numero" title="N° BOU">
                    <v-show dado="{{$proc['bou_numero']}}"></v-show>
                </v-label>
                <v-label label="n_eproc" title="N° Eproc">
                    <v-show dado="{{$proc['n_eproc']}}"></v-show>
                </v-label>
                <v-label label="ano_eproc" title="Eproc (Ano)">
                    <v-show dado="{{$proc['ano_eproc']}}"></v-show>
                </v-label>
                <v-label label="relato_enc" title="Conclusão do encarregado">
                    <v-show dado="{{$proc['relato_enc']}}"></v-show>
                </v-label>
                <v-label label="sintese_txt" title="Sintese" lg="12" md="12" error="{{$errors->first('sintese_txt')}}">
                    <v-show dado="{{$proc['sintese_txt']}}"></v-show>
                </v-label>
            </v-tab-item>
            <v-tab-item title="Indiciados" idp="indiciados">
                <v-proced-origem dproc="ipm" dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}" show></v-proced-origem><br>           
                <v-acusado dproc="ipm" idp="{{$proc['id_ipm']}}" situacao="{{sistema('procSituacao','ipm')}}" reu show></v-acusado><br>
            </v-tab-item>
            <v-tab-item title="Documentos" idp="documentos">
                <file-upload 
                title="PDF - Conclusão do encarregado:"
                name="relato_enc_file"
                dproc="ipm" idp="{{$proc['id_ipm']}}"
                :ext="['pdf']"
                show 
                ></file-upload>
                <v-item-unique title="Data" proc="ipm" dproc="ipm" idp="{{$proc['id_ipm']}}" name="relato_enc_data" show></v-item-unique>
                <v-item-unique title="Conclusão do encarregado" proc="ipm" dproc="ipm" idp="{{$proc['id_ipm']}}" name="relato_enc" show></v-item-unique>
                <file-upload 
                title="PDF - Solução do Cmt OPM:"
                name="relato_cmtopm_file"
                dproc="ipm" idp="{{$proc['id_ipm']}}"
                :ext="['pdf']"
                show 
                ></file-upload>
                <v-item-unique title="Data" proc="ipm" dproc="ipm" idp="{{$proc['id_ipm']}}" name="relato_cmtopm_data" show></v-item-unique>
                <v-item-unique title="Conclusão do Cmt. OPM" proc="ipm" dproc="ipm" idp="{{$proc['id_ipm']}}" name="relato_cmtopm" show></v-item-unique>
                <file-upload 
                title="PDF - Decisão do Cmt Geral:"
                name="relato_cmtgeral_file"
                dproc="ipm" idp="{{$proc['id_ipm']}}"
                :ext="['pdf']"
                show 
                ></file-upload>
                <v-item-unique title="Data" proc="ipm" dproc="ipm" idp="{{$proc['id_ipm']}}" name="relato_cmtgeral_data" show></v-item-unique>
                <v-item-unique title="Conclusão do Cmt. Geral" proc="ipm" dproc="ipm" idp="{{$proc['id_ipm']}}" name="relato_cmtgeral" show></v-item-unique>
                
                <file-upload 
                    title="Relatório complementar"
                    name="relcomplemtentar_file"
                    dproc="ipm" idp="{{$proc['id_ipm']}}"
                    :ext="['pdf']"
                    show 

                    >
                </file-upload>
                <v-item-unique title="Data" proc="ipm" dproc="ipm" idp="{{$proc['id_ipm']}}" name="relato_cmtgeral_data" show></v-item-unique>
            </v-tab-item>
            <v-tab-item title="Membros" idp="membros">
                <v-membro dproc="ipm" idp="{{$proc['id_ipm']}}" show></v-membro>
            </v-tab-item>
            <v-tab-item title="Movimentos" idp="movimentos">
                <v-movimento dproc="ipm" idp="{{$proc['id_ipm']}}" opm="{{session('opm_descricao')}}" rg="{{session('rg')}}" show></v-movimento>
            </v-tab-item>
            <v-tab-item title="Sobrestamentos" idp="sobrestamentos">
                <v-sobrestamento dproc="ipm" idp="{{$proc['id_ipm']}}" show></v-sobrestamento>
            </v-tab-item>
            <v-tab-item title="Encaminhamentos" idp="encaminhamentos">
                Encaminhamentos
            </v-tab-item>
            <v-tab-item title="Vajme" idp="vajme">
                <v-item-unique title="Referência da Vajme (Nº do processo, vara)" dproc="ipm" idp="{{$proc['id_ipm']}}" name="vajme_ref" show></v-item-unique>
                <v-item-unique title="Referência da Justiça Comum (Nº do processo, vara)" dproc="ipm" idp="{{$proc['id_ipm']}}" name="justicacomum_ref" show></v-item-unique>
            </v-tab-item>
            <v-tab-item title="Arquivo" idp="arquivo">
                <v-arquivo dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}" dproc="ipm" idp="{{$proc['id_ipm']}}" show></v-arquivo>
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

