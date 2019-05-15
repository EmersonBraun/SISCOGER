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
                {!! Form::model($proc,['url' => route('it.update',$proc['id_it']),'method' => 'put']) !!}
                <v-label label="id_andamento" title="Andamento">
                    {!! Form::select('id_andamento',config('sistema.andamentoIT'),null, ['class' => 'form-control ']) !!}
                </v-label>
                <v-label label="id_andamentocoger" title="Andamento COGER">
                    {!! Form::select('id_andamentocoger',config('sistema.andamentocogerIT'),null, ['class' => 'form-control ']) !!}
                </v-label>
                <v-label label="cdopm" title="OPM">
                    <v-opm cdopm="{{$proc['cdopm']}}"></v-opm>
                </v-label>
                <v-label label="fato_data" title="Data da fato" icon="fa fa-calendar">
                    <v-datepicker name="fato_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['fato_data'] ?? ''}}"></v-datepicker>
                </v-label>
                <v-label label="abertura_data" title="Data da abertura" icon="fa fa-calendar">
                    <v-datepicker name="abertura_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['abertura_data'] ?? ''}}"></v-datepicker>
                </v-label>
                <v-label label="objetoprocedimento" title="Objeto do procedimento">---arrumar---
                    {!! Form::select('objetoprocedimento', [],null, ['class' => 'form-control select2', 'id' => 'descricao']) !!}
                </v-label>
                <v-label label="vtr_placa" title="Placa da viatura (sem traço)">
                    {{ Form::text('vtr_placa', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="vtr_prefixo" title="Prefixo da viatura">
                    {{ Form::text('vtr_prefixo', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="boletiminterno_numero" title="N° Boletim">
                    {{ Form::text('boletiminterno_numero', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="boletiminterno_data" title="Data boletim">
                    <v-datepicker name="boletiminterno_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['boletiminterno_data'] ?? ''}}"></v-datepicker>
                </v-label>
                <v-label label="tipo_acidente" title="Situação Viatura">---arrumar---
                    {!! Form::select('tipo_acidente', [],null, ['class' => 'form-control select2', 'id' => 'descricao']) !!}
                </v-label>
                <v-label label="br_numero" title="Nº do BR da publicação">
                    {{ Form::text('br_numero', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="situacao_objeto" title="Nº do BR da publicação">
                    {{ Form::text('situacao_objeto', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="acordoamigavel" title="Ressarcimento Extrajudicial">---arrumar---
                    {!! Form::select('acordoamigavel', [],null, ['class' => 'form-control select2', 'id' => 'descricao']) !!}
                </v-label>
                <v-label label="id_causa_acidente" title="Causa do acidente">---arrumar---
                    {!! Form::select('id_causa_acidente', [],null, ['class' => 'form-control select2', 'id' => 'descricao']) !!}
                </v-label>
                <v-label label="resp_civil" title="Responsabilidade civil">---arrumar---
                    {!! Form::select('resp_civil', [],null, ['class' => 'form-control select2', 'id' => 'descricao']) !!}
                </v-label>
                <v-label label="arquivo_numero" title="Número do arquivo">
                    {{ Form::text('arquivo_numero', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="protocolo_numero" title="Número do protocolo">
                    {{ Form::text('protocolo_numero', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="acaojudicial" title="Ação judicial">---arrumar---
                    {!! Form::select('acaojudicial', [],null, ['class' => 'form-control select2', 'id' => 'descricao']) !!}
                </v-label>
                <v-label label="danoestimado_rs" title="Valor do dano estimado">--arrumar R$--
                    {{ Form::text('danoestimado_rs', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="danoreal_rs" title="Valor do dano real">--arrumar R$--
                    {{ Form::text('danoreal_rs', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="sintese_txt" title="Sintese" lg="12" md="12" error="{{$errors->first('sintese_txt')}}">
                    {!! Form::textarea('sintese_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
                </v-label>
                {!! Form::submit('Alterar IT',['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}
            </v-tab-item>
            <v-tab-item title="Envolvidos" idp="envolvidos">          
                <v-acusado idp="{{$proc['id_it']}}" situacao="{{sistema('procSituacao','it')}}" ></v-acusado><br>
                <v-vitima idp="{{$proc['id_it']}}" ></v-vitima><br>
            </v-tab-item>
            <v-tab-item title="Documentos" idp="documentos">
                <file-upload 
                    title="Relatório do Oficial Encarregado:"
                    name="relatorio_file"
                    proc="it"
                    idp="{{$proc['id_it']}}"
                    :ext="['pdf']" 
                    :candelete="{{session('is_admin')}}"
                    ></file-upload>
                    <v-item-unique title="Data do relatório" proc="it" idp="{{$proc['id_it']}}" name="relatorio_data"></v-item-unique>---arrumar---

                <file-upload 
                    title="Solução Unidade:"
                    name="solucao_unidade_file"
                    proc="it"
                    idp="{{$proc['id_it']}}"
                    :ext="['pdf']" 
                    :candelete="{{session('is_admin')}}"
                    ></file-upload>
                    <v-item-unique title="Data do relatório" proc="it" idp="{{$proc['id_it']}}" name="solucao_unidade_data"></v-item-unique>---arrumar---

                <file-upload 
                    title="Solução Complementar:"
                    name="solucao_complementar_file"
                    proc="it"
                    idp="{{$proc['id_it']}}"
                    :ext="['pdf']" 
                    :candelete="{{session('is_admin')}}"
                    ></file-upload>
                    <v-item-unique title="Data do relatório" proc="it" idp="{{$proc['id_it']}}" name="solucao_complementar_data"></v-item-unique>---arrumar---
            </v-tab-item>
            <v-tab-item title="Membros" idp="membros">
                <v-membro idp="{{$proc['id_it']}}"></v-membro>
            </v-tab-item>
            <v-tab-item title="Movimentos" idp="movimentos">
                <v-movimento idp="{{$proc['id_it']}}" opm="{{session('opm_descricao')}}" rg="{{session('rg')}}" :admin="{{session('is_admin')}}"></v-movimento>
            </v-tab-item>
            <v-tab-item title="Sobrestamentos" idp="sobrestamentos">
                <v-sobrestamento idp="{{$proc['id_it']}}" ></v-sobrestamento>
            </v-tab-item>
            <v-tab-item title="Encaminhamentos" idp="encaminhamentos">
                Encaminhamentos
            </v-tab-item>
            <v-tab-item title="Arquivo" idp="arquivo">
                <v-arquivo idp="{{$proc['id_it']}}" ></v-arquivo>
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

