@extends('adminlte::page')

@section('title', 'FATD - Editar')

@section('content_header')
<section class="content-header">   
  <h1>FATD - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('fatd.lista',['ano' => date('Y')])}}">FATD - Lista</a></li>
  <li class="active">FATD - Editar</li>
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
                {!! Form::model($proc,['url' => route('fatd.update',$proc['id_fatd']),'method' => 'put']) !!}
                    <v-prioritario prioridade="{{$proc['prioridade'] ?? ''}}"></v-prioritario>
                    <v-label label="id_andamento" title="Andamento" error="{{$errors->first('id_andamento')}}">
                        {!! Form::select('id_andamento',config('sistema.andamentoFATD'),null, ['class' => 'form-control ']) !!}
                    </v-label>
                    <v-label label="id_andamentocoger" title="Andamento COGER" error="{{$errors->first('id_andamentocoger')}}">
                        {!! Form::select('id_andamentocoger',config('sistema.andamentocogerFATD'),null, ['class' => 'form-control ']) !!}
                    </v-label>
                    <v-label label="doc_origem_txt" title="Documentos de origem">
                        {{ Form::text('doc_origem_txt', null, ['class' => 'form-control ']) }}
                    </v-label>
                    <v-label label="fato_data" title="Data da fato" icon="fa fa-calendar">
                        <v-datepicker name="fato_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['fato_data'] ?? ''}}"></v-datepicker>
                    </v-label>
                    <v-label label="cdopm" title="OPM" error="{{$errors->first('cdopm')}}">
                        <v-opm cdopm="{{$proc['cdopm']}}"></v-opm>
                    </v-label>
                    <v-label label="motivo_fatd" title="Motivo" >
                        {!! Form::select('motivo_fatd', config('sistema.motivoFATD'),null, ['class' => 'form-control select2', 'id' => 'descricao']) !!}
                    </v-label>
                    <v-label label="outromotivo" title="Especificar (no caso de outros motivos)">
                        {{ Form::text('outromotivo', null, ['class' => 'form-control ']) }}
                    </v-label>
                    <v-label label="situacao_fatd" title="Situação">
                        {!! Form::select('situacao_fatd',config('sistema.situacaoOCOR'),null, ['class' => 'form-control ', 'id' => 'descricao']) !!}
                    </v-label>
                    <v-label label="despacho_numero" title="Nº do despacho que designa o Encarregado">
                        {{ Form::text('despacho_numero', null, ['class' => 'form-control ']) }}
                    </v-label>
                    <v-label label="portaria_data" title="Data do despacho" icon="fa fa-calendar">
                        <v-datepicker name="portaria_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['portaria_data'] ?? ''}}"></v-datepicker>
                    </v-label>
                    <v-label label="doc_tipo" title="Tipo de boletim">
                        {!! Form::select('doc_tipo',config('sistema.tipoBoletim'),null, ['class' => 'form-control ']) !!}
                    </v-label>
                    <v-label label="doc_numero" title="N° Boletim">
                        {{ Form::text('doc_numero', null, ['class' => 'form-control ']) }}
                    </v-label>
                    <v-label label="abertura_data" title="Data da abertura" icon="fa fa-calendar">
                        <v-datepicker name="abertura_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['abertura_data'] ?? ''}}"></v-datepicker>
                    </v-label>
                    <v-label label="sintese_txt" title="Sintese" lg="12" md="12" error="{{$errors->first('sintese_txt')}}">
                        {!! Form::textarea('sintese_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
                    </v-label>
                {!! Form::submit('Alterar FATD',['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}
            </v-tab-item>
            <v-tab-item title="Envolvidos" idp="envolvidos">
                <v-proced-origem dproc="fatd" dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}"></v-proced-origem><br>           
                <v-acusado dproc="fatd" idp="{{$proc['id_fatd']}}" situacao="{{sistema('procSituacao','fatd')}}" ></v-acusado><br>
                <v-vitima dproc="fatd" idp="{{$proc['id_fatd']}}" ></v-vitima><br>
            </v-tab-item>
            <v-tab-item title="Documentos" idp="documentos">
                <file-upload 
                title="Relato do fato imputado:"
                name="fato_file"
                dproc="fatd" idp="{{$proc['id_fatd']}}"
                :ext="['pdf']" 
                ></file-upload>

                <file-upload 
                title="Relatório:"
                name="relatorio_file"
                dproc="fatd" idp="{{$proc['id_fatd']}}"
                :ext="['pdf']" 
                ></file-upload>

                <file-upload 
                title="Solução do Comandante:"
                name="sol_cmt_file"
                dproc="fatd" idp="{{$proc['id_fatd']}}"
                :ext="['pdf']" 
                ></file-upload>

                <file-upload 
                title="Solução do Cmt Geral:"
                name="sol_cg_file"
                dproc="fatd" idp="{{$proc['id_fatd']}}"
                :ext="['pdf']" 
                ></file-upload>

                <file-upload 
                title="Nota de punição:"
                name="notapunicao_file"
                dproc="fatd" idp="{{$proc['id_fatd']}}"
                :ext="['pdf']" 
                ></file-upload>

                <v-item-unique title="Publicação da nota de punição (Ex: BI nº 12/2011)" proc="fatd" dproc="fatd" idp="{{$proc['id_fatd']}}" name="publicacaonp"></v-item-unique>
            </v-tab-item>
            <v-tab-item title="Recursos" idp="recursos">
                <file-upload 
                    title="Reconsideração de ato (solução):"
                    name="rec_ato_file"
                    dproc="fatd" idp="{{$proc['id_fatd']}}"
                    :ext="['pdf']" 
                    ></file-upload>

                <file-upload 
                    title="Recurso CMT OPM:"
                    name="rec_cmt_file"
                    dproc="fatd" idp="{{$proc['id_fatd']}}"
                    :ext="['pdf']" 
                    ></file-upload>

                <file-upload 
                    title="Recurso CMT CRPM:"
                    name="rec_crpm_file"
                    dproc="fatd" idp="{{$proc['id_fatd']}}"
                    :ext="['pdf']" 
                    ></file-upload>

                <file-upload 
                    title="Recurso CMT Geral:"
                    name="rec_cg_file"
                    dproc="fatd" idp="{{$proc['id_fatd']}}"
                    :ext="['pdf']" 
                    ></file-upload>
            </v-tab-item>
            <v-tab-item title="Membros" idp="membros">
                <v-membro dproc="fatd" idp="{{$proc['id_fatd']}}"></v-membro>
            </v-tab-item>
            <v-tab-item title="Movimentos" idp="movimentos">
                <v-movimento dproc="fatd" idp="{{$proc['id_fatd']}}"></v-movimento>
            </v-tab-item>
            <v-tab-item title="Sobrestamentos" idp="sobrestamentos">
                <v-sobrestamento dproc="fatd" idp="{{$proc['id_fatd']}}" ></v-sobrestamento>
            </v-tab-item>
            <v-tab-item title="Encaminhamentos" idp="encaminhamentos">
                Encaminhamentos
            </v-tab-item>
            <v-tab-item title="Arquivo" idp="arquivo">
                <v-arquivo dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}" dproc="fatd" idp="{{$proc['id_fatd']}}" ></v-arquivo>
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

