@extends('adminlte::page')

@section('title', 'CJ - Editar')

@section('content_header')
<section class="content-header">   
  <h1>CJ - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('cd.lista')}}">CJ - Lista</a></li>
  <li class="active">CJ - Editar</li>
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
                {!! Form::model($proc,['url' => route('cj.update',$proc['id_cj']),'method' => 'put']) !!}
                    <v-prioritario prioridade="{{$proc['prioridade'] ?? ''}}"></v-prioritario>
                    <v-label label="id_andamento" title="Andamento" error="{{$errors->first('id_andamento')}}">
                        {!! Form::select('id_andamento',config('sistema.andamentoCJ'),null, ['class' => 'form-control ']) !!}
                    </v-label>
                    <v-label label="id_andamentocoger" title="Andamento COGER" error="{{$errors->first('id_andamentocoger')}}">
                        {!! Form::select('id_andamentocoger',config('sistema.andamentocogerCJ'),null, ['class' => 'form-control ']) !!}
                    </v-label>
                    <v-label label="id_motivoconselho" title="Motivo CJ (Lei nº 16.544/2010)" link="https://goo.gl/L1m5Ps" icon="fa fa-link text-info">
                        {!! Form::select('id_motivoconselho', config('sistema.motivoConselho'),null, ['class' => 'form-control select2', 'id' => 'descricao']) !!}
                    </v-label>
                    <v-label label="id_situacaoconselho" title="Situação">
                        {!! Form::select('id_situacaoconselho',config('sistema.situacaoConselho'),null, ['class' => 'form-control ', 'id' => 'descricao']) !!}
                    </v-label>
                    <v-label label="id_decorrenciaconselho" title="Em decorrência de">
                        {!! Form::select('id_decorrenciaconselho',config('sistema.decorrenciaConselho'),null, ['class' => 'form-control ', 'id' => 'descricao']) !!}
                    </v-label>
                    <v-label label="outromotivo" title="Especificar (no caso de outros motivos)">
                        {{ Form::text('outromotivo', null, ['class' => 'form-control ']) }}
                    </v-label>
                    <v-label label="portaria_numero" title="N° Portaria CG">
                        {{ Form::text('portaria_numero', null, ['class' => 'form-control ']) }}
                    </v-label>
                    <v-label label="portaria_data" title="Data da Portaria do CG" icon="fa fa-calendar">
                        <v-datepicker name="portaria_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['portaria_data'] ?? ''}}"></v-datepicker>
                    </v-label>
                    <v-label label="doc_tipo" title="Tipo de boletim">
                        {!! Form::select('doc_tipo',config('sistema.tipoBoletim'),null, ['class' => 'form-control ']) !!}
                    </v-label>
                    <v-label label="doc_numero" title="N° Boletim">
                        {{ Form::text('doc_numero', null, ['class' => 'form-control ']) }}
                    </v-label>
                    <v-label label="fato_data" title="Data da fato" icon="fa fa-calendar">
                        <v-datepicker name="fato_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['fato_data'] ?? ''}}"></v-datepicker>
                    </v-label>
                    <v-label label="abertura_data" title="Data da abertura" icon="fa fa-calendar">
                        <v-datepicker name="abertura_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['abertura_data'] ?? ''}}"></v-datepicker>
                    </v-label>
                    <v-label label="prescricao_data" title="Data da prescricao" icon="fa fa-calendar">
                        <v-datepicker name="prescricao_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['prescricao_data'] ?? ''}}"></v-datepicker>
                    </v-label>
                    <v-label label="doc_prorrogacao" title="Documento da prorrogação de prazo">
                        {{ Form::text('doc_prorrogacao', null, ['class' => 'form-control ']) }}
                    </v-label>
                    <v-label label="sintese_txt" title="Sintese" lg="12" md="12" error="{{$errors->first('sintese_txt')}}">
                        {!! Form::textarea('sintese_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
                    </v-label>
                {!! Form::submit('Alterar CJ',['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}
            </v-tab-item>
            <v-tab-item title="Envolvidos" idp="envolvidos">
                <v-proced-origem dproc="cj" dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}"></v-proced-origem><br>           
                <v-acusado dproc="cj" idp="{{$proc['id_cj']}}" situacao="{{sistema('procSituacao','cj')}}" ></v-acusado><br>
                <v-vitima dproc="cj" idp="{{$proc['id_cj']}}" ></v-vitima><br>
            </v-tab-item>
            <v-tab-item title="Acórdãos" idp="acordaos">
                <file-upload 
                    title="TJ-PR:"
                    name="tjpr_file"
                    dproc="cj" idp="{{$proc['id_cj']}}"
                    :ext="['pdf']" 
                    ></file-upload>

                <file-upload 
                    title="STJ/STF:"
                    name="stj_file"
                    dproc="cj" idp="{{$proc['id_cj']}}"
                    :ext="['pdf']" 
                    ></file-upload>
            </v-tab-item>
            <v-tab-item title="Recursos" idp="recursos">
                <file-upload 
                    title="Reconsideração de ato (solução):"
                    name="rec_ato_file"
                    dproc="cj" idp="{{$proc['id_cj']}}"
                    :ext="['pdf']" 
                    >
                </file-upload>

                <file-upload 
                    title="Recurso ao Governador (solução):"
                    name="rec_gov_file"
                    dproc="cj" idp="{{$proc['id_cj']}}"
                    :ext="['pdf']" 
                    >
                </file-upload>
            </v-tab-item>
            <v-tab-item title="Membros" idp="membros">
                <v-membro dproc="cj" idp="{{$proc['id_cj']}}"></v-membro>
            </v-tab-item>
            <v-tab-item title="Movimentos" idp="movimentos">
                <v-movimento dproc="cj" idp="{{$proc['id_cj']}}"></v-movimento>
            </v-tab-item>
            <v-tab-item title="Sobrestamentos" idp="sobrestamentos">
                <v-sobrestamento dproc="cj" idp="{{$proc['id_cj']}}" ></v-sobrestamento>
            </v-tab-item>
            <v-tab-item title="Encaminhamentos" idp="encaminhamentos">
                Encaminhamentos
            </v-tab-item>
            <v-tab-item title="Arquivo" idp="arquivo">
                <v-arquivo dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}" dproc="cj" idp="{{$proc['id_cj']}}" ></v-arquivo>
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

