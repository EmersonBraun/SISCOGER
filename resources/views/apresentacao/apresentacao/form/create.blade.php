@extends('adminlte::page')

@section('title', 'Apresentação - Criar')

@section('content_header')
<section class="content-header">   
  <h1>Apresentação - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('apresentacao.index')}}">Apresentação - Lista</a></li>
  <li class="active">Apresentação - Criar</li>
  </ol>
</section>

</v-select>
@stop

@section('content')
<section class="">
    <div class="tab-content">
        <v-tab-item title="Formulário principal" idp="principal" cls="active show">
            {!! Form::open(['url' => route('apresentacao.store')]) !!}
        'id_notacomparecimento',
        
		'pessoa_posto',
		'pessoa_quadro',
		'pessoa_email',
		'pessoa_unidade_lotacao_meta4',
		'pessoa_unidade_lotacao_codigo',
		'pessoa_unidade_lotacao_sigla',
		'pessoa_unidade_lotacao_descricao',
		'pessoa_opm_meta4',
		'pessoa_opm_codigo',
		'pessoa_opm_sigla',
		'pessoa_opm_descricao',
		'documento_de_origem',
		'documento_de_origem_data',
		'documento_de_origem_file',
		'id_apresentacaotipoprocesso',
		'autos_numero',
		'autos_ano',
		'acusados',
		'id_apresentacaocondicao',
		'comparecimento_data',
		'comparecimento_hora',
		'comparecimento_dh',
		'comparecimento_local_txt',
		'id_localdeapresentacao',
		'observacao_txt',
		'usuario_rg',
		'criacao_dh',
		'sjd_ref',
		'sjd_ref_ano',
		'cdopm',
		'memorando_pdf'
            <v-label label="id_apresentacaosituacao" title="Classificação de sigilo" error="{{$errors->first('id_apresentacaosituacao')}}">
                {!! Form::select('id_apresentacaosituacao',config('sistema.apresentacaoClassificacaoSigilo'),null, ['class' => 'form-control','required']) !!}
            </v-label>
            <v-label label="id_apresentacaoclassificacaosigilo" title="Situação" error="{{$errors->first('id_apresentacaoclassificacaosigilo')}}">
                {!! Form::select('id_apresentacaoclassificacaosigilo',config('sistema.apresentacaoSituacao'),null, ['class' => 'form-control','required']) !!}
            </v-label>
            <v-label label="pessoa_rg" title="RG" lg="4" md="4" error="{{$errors->first('pessoa_rg')}}">
                {{ Form::text('pessoa_rg', null, ['class' => 'form-control ',
                'onchange' => 'completaDados(this,pessoa_nome,pessoa_posto)',
                'onkeyup' => 'completaDados(this,pessoa_nome,pessoa_posto)']) }}
            </v-label>
            <v-label label="pessoa_nome" title="Nome" lg="4" md="4" error="{{$errors->first('pessoa_nome')}}">
                {{ Form::text('pessoa_nome', null, ['class' => 'form-control ','readonly','id' => 'pessoa_nome']) }}
            </v-label>
            <v-label label="pessoa_posto" title="Posto/Graduação" lg="4" md="4" error="{{$errors->first('pessoa_posto')}}">
                {{ Form::select('pessoa_posto', config('sistema.postos'),null, ['class' => 'form-control ','readonly','id' => 'pessoa_posto']) }}
            </v-label>
            <v-label label="cdopm" title="OPM">
                <v-opm name='cdopm' cdopm="{{$proc['cdopm'] ?? ''}}"></v-opm>
            </v-label>
            <v-label label="id_andamentocoger" title="Andamento COGER" error="{{$errors->first('id_andamentocoger')}}">
                {!! Form::select('id_andamentocoger',config('sistema.andamentocogerADL'),null, ['class' => 'form-control','required']) !!}
            </v-label>
            <v-label label="id_motivoconselho" title="Motivo ADL (Lei nº 16.544/2010)" link="https://goo.gl/L1m5Ps" icon="fa fa-link text-info">
                {!! Form::select('id_motivoconselho', config('sistema.motivoConselho'),null, ['class' => 'form-control select2', 'id' => 'descricao']) !!}
            </v-label>

            <v-label label="outromotivo" title="Especificar (no caso de outros motivos)">
                {{ Form::text('outromotivo', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="id_situacaoconselho" title="Situação">
                {!! Form::select('id_situacaoconselho',config('sistema.situacaoConselho'),null, ['class' => 'form-control ', 'id' => 'descricao']) !!}
            </v-label>
            <v-label label="id_decorrenciaconselho" title="Em decorrência de">
                {!! Form::select('id_decorrenciaconselho',config('sistema.decorrenciaConselho'),null, ['class' => 'form-control ', 'id' => 'descricao']) !!}
            </v-label>
            <v-label label="portaria_numero" title="N° Portaria">
                {{ Form::text('portaria_numero', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="portaria_data" title="Data da Portaria" icon="fa fa-calendar">
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
            <v-label label="sintese_txt" title="Sintese" lg="12" md="12" error="{{$errors->first('sintese_txt')}}">
                {!! Form::textarea('sintese_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
            </v-label>
            {!! Form::submit('Inserir ADL',['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </v-tab-item>
    </div>
</section>
@stop

@section('css')
@stop

@section('js')
@include('vendor.adminlte.includes.vue')
@stop

