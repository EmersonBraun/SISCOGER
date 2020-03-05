@extends('adminlte::page')

@section('title', 'IT - Editar')

@section('content_header')
<section class="content-header">   
  <h1>IT - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('it.lista',['ano' => date('Y')])}}">IT - Lista</a></li>
  <li class="active">IT - Editar</li>
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
                <v-label label="id_andamentocoger" title="Andamento COGER" error="{{$errors->first('cdopm')}}">
                    <v-show dado="{{sistema('andamentocoger',$proc['id_andamentocoger'])}}"></v-show>
                </v-label>
                <v-label label="cdopm" title="OPM">
                    <v-show dado="{{$proc['cdopm']}}"></v-show>
                </v-label>
                <v-label label="fato_data" title="Data da fato" icon="fa fa-calendar">
                    <v-show dado="{{$proc['fato_data']}}"></v-show>
                </v-label>
                <v-label label="abertura_data" title="Data da abertura" icon="fa fa-calendar">
                    <v-show dado="{{$proc['abertura_data']}}"></v-show>
                </v-label>
                <v-label label="objetoprocedimento" title="Data da abertura" icon="fa fa-calendar">
                    <v-show dado="{{$proc['objetoprocedimento']}}"></v-show>
                </v-label>
                @switch($proc['objetoprocedimento'])
                    @case('viatura')
                            <v-label label="vtr_placa" title="Placa da viatura (sem traço)">
                                <v-show dado="{{$proc['vtr_placa']}}"></v-show>
                            </v-label>
                            <v-label label="vtr_prefixo" title="Prefixo da viatura">
                                <v-show dado="{{$proc['vtr_prefixo']}}"></v-show>
                            </v-label>
                            <v-label label="tipo_acidente" title="Tipo acidente">
                                <v-show dado="{{sistema('tipoAcidente',$proc['tipo_acidente'])}}"></v-show>
                            </v-label>
                            <v-label label="avarias" title="Avarias">
                                <v-show dado="{{sistema('avarias',$proc['avarias'])}}"></v-show>
                            </v-label>
                            <v-label label="situacaoviatura" title="Situação Viatura">
                                <v-show dado="{{sistema('situacaoviatura',$proc['situacaoviatura'])}}"></v-show>
                            </v-label>
                        @break
                    @case('arma')
                        <v-label label="identificacao_arma" title="Identificação da arma">
                            <v-show dado="{{$proc['vtr_placa']}}"></v-show>
                        </v-label>
                        @break
                    @case('munição')
                            <v-label label="identificacao_municao" title="Identificação da munição">
                                <v-show dado="{{$proc['vtr_placa']}}"></v-show>
                            </v-label>
                        @break
                    @case('semovente')
                            <v-label label="identificacao_semovente" title="Identificação do semovente">
                                <v-show dado="{{$proc['vtr_placa']}}"></v-show>
                            </v-label>
                        @break
                    @case('outros')
                            <v-label label="outros" title="Identificação Outros">
                                <v-show dado="{{$proc['vtr_placa']}}"></v-show>
                            </v-label>
                        @break
                    @default
                        <h4>Objeto do procedimento não cadastrado</h4>  
                @endswitch
                <v-label label="boletiminterno_numero" title="N° Boletim">
                    <v-show dado="{{$proc['boletiminterno_numero']}}"></v-show>
                </v-label>
                <v-label label="boletiminterno_data" title="Data boletim">
                    <v-show dado="{{$proc['boletiminterno_data']}}"></v-show>
                </v-label>
                <v-label label="br_numero" title="Nº do BR da publicação">
                    <v-show dado="{{$proc['br_numero']}}"></v-show>
                </v-label>
                <v-label label="situacao_objeto" title="Nº do BR da publicação">
                    <v-show dado="{{$proc['situacao_objeto']}}"></v-show>
                </v-label>
                <v-label label="acordoamigavel" title="Ressarcimento Extrajudicial">
                    <v-show dado="{{$proc['acordoamigavel']}}"></v-show>
                </v-label>
                <v-label label="resp_civil" title="Responsabilidade civil">
                    <v-show dado="{{$proc['resp_civil']}}"></v-show>
                </v-label>
                <v-label label="arquivo_numero" title="Número do arquivo">
                    <v-show dado="{{$proc['arquivo_numero']}}"></v-show>
                </v-label>
                <v-label label="protocolo_numero" title="Número do protocolo">
                    <v-show dado="{{$proc['protocolo_numero']}}"></v-show>
                </v-label>
                <v-label label="acaojudicial" title="Ação judicial">
                    <v-show dado="{{$proc['acaojudicial']}}"></v-show>
                </v-label>
                <v-label label="danoestimado_rs" title="Valor do dano estimado">
                    <v-show dado="{{$proc['danoestimado_rs']}}"></v-show>
                </v-label>
                <v-label label="danoreal_rs" title="Valor do dano real">
                    <v-show dado="{{$proc['danoreal_rs']}}"></v-show>
                </v-label>
                <v-label label="sintese_txt" title="Sintese" lg="12" md="12" error="{{$errors->first('sintese_txt')}}">
                    <v-show dado="{{$proc['sintese_txt']}}"></v-show>
                </v-label>
            </v-tab-item>
            <v-tab-item title="Envolvidos" idp="envolvidos">          
                <v-acusado dproc="it" idp="{{$proc['id_it']}}" situacao="{{sistema('procSituacao','it')}}" show></v-acusado><br>
                <v-vitima dproc="it" idp="{{$proc['id_it']}}" show></v-vitima><br>
            </v-tab-item>
            <v-tab-item title="Documentos" idp="documentos">
                <file-upload 
                    title="Relatório do Oficial Encarregado:"
                    name="relatorio_file"
                    dproc="it" idp="{{$proc['id_it']}}"
                    :ext="['pdf']"
                    show 
                    ></file-upload>

                <file-upload 
                    title="Solução Unidade:"
                    name="solucao_unidade_file"
                    dproc="it" idp="{{$proc['id_it']}}"
                    :ext="['pdf']"
                    show 
                    ></file-upload>

                <file-upload 
                    title="Solução Complementar:"
                    name="solucao_complementar_file"
                    dproc="it" idp="{{$proc['id_it']}}"
                    :ext="['pdf']"
                    show 
                    ></file-upload>
            </v-tab-item>
            <v-tab-item title="Membros" idp="membros">
                <v-membro dproc="it" idp="{{$proc['id_it']}}" show></v-membro>
            </v-tab-item>
            <v-tab-item title="Movimentos" idp="movimentos">
                <v-movimento dproc="it" idp="{{$proc['id_it']}}" show></v-movimento>
            </v-tab-item>
            <v-tab-item title="Sobrestamentos" idp="sobrestamentos">
                <v-sobrestamento dproc="it" idp="{{$proc['id_it']}}" show></v-sobrestamento>
            </v-tab-item>
            <v-tab-item title="Encaminhamentos" idp="encaminhamentos">
                Encaminhamentos
            </v-tab-item>
            <v-tab-item title="Arquivo" idp="arquivo">
                <v-arquivo dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}" dproc="it" idp="{{$proc['id_it']}}" show></v-arquivo>
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

