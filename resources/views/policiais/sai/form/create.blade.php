@extends('adminlte::page')

@section('title', 'SAI - Criar')

@section('content_header')
<section class="content-header">   
  <h1>SAI - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('sai.index')}}">SAI - Lista</a></li>
  <li class="active">SAI - Criar</li>
  </ol>
</section>

</v-select>
@stop

@section('content')
<section class="">
    <div class="tab-content">
        
        <v-tab-item title="Formulário principal" idp="principal" cls="active show">
            {!! Form::open(['url' => route('sai.store')]) !!}
            <input type=hidden name=rg_cadastro value="{{session('rg')}}">
            <input type=hidden name=cdopm value="{{session('cdopm')}}">
            <input type=hidden name=opm_abreviatura value="{{session('opm_descricao')}}">

            <v-prioritario admin="session('is_admin')"></v-prioritario>
            <v-label label="id_andamento" title="Andamento" error="{{$errors->first('id_andamento')}}">
                {!! Form::select('id_andamento',config('sistema.andamentoSAI'),null, ['class' => 'form-control','required']) !!}
            </v-label>
            <v-label label="id_andamentocoger" title="Andamento COGER" error="{{$errors->first('id_andamentocoger')}}">
                {!! Form::select('id_andamentocoger',config('sistema.andamentocogerSAI'),null, ['class' => 'form-control','required']) !!}
            </v-label>
            <v-label label="arquivopasta" title="Local de Arquivo" error="{{$errors->first('arquivopasta')}}">
                {{ Form::text('arquivopasta', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="data" title="Data do fato" icon="fa fa-calendar" error="{{$errors->first('data')}}">
                <v-datepicker name="data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="cdopm_fato" title="OPM (Local do fato)" error="{{$errors->first('cdopm_fato')}}">
                <v-opm name='cdopm_fato' cdopm="{{$proc['cdopm_fato'] ?? ''}}"></v-opm>
            </v-label>
            <v-label label="cdopm_controle" title="OPM (Local do fato)" error="{{$errors->first('cdopm_controle')}}">
                <v-opm name='cdopm_controle' cdopm="{{$proc['cdopm_controle'] ?? ''}}"></v-opm>
            </v-label>
            <v-label label="abertura_data" title="Data da abertura" icon="fa fa-calendar" error="{{$errors->first('abertura_data')}}">
                <v-datepicker name="abertura_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['abertura_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="id_municipio" title="Cidade do fato">
                <v-municipio id_municipio="{{$proc['id_municipio'] ?? ''}}"></v-municipio>
            </v-label>
            <v-label label="bairro" title="Bairro" error="{{$errors->first('bairro')}}">
                {{ Form::text('bairro', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="logradouro" title="Logradouro" error="{{$errors->first('logradouro')}}">
                {{ Form::text('logradouro', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="bou_ano1" title="1°BOU (Ano)">
                <v-ano ano="{{$proc['bou_ano1'] ?? ''}}"></v-ano>
            </v-label>
            <v-label label="bou_numero1" title="1°N° BOU">
                {{ Form::text('bou_numero1', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="bou_ano2" title="2°BOU (Ano)">
                <v-ano ano="{{$proc['bou_ano2'] ?? ''}}"></v-ano>
            </v-label>
            <v-label label="bou_numero2" title="2°N° BOU">
                {{ Form::text('bou_numero2', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="bou_ano3" title="3°BOU (Ano)">
                <v-ano ano="{{$proc['bou_ano3'] ?? ''}}"></v-ano>
            </v-label>
            <v-label label="bou_numero3" title="3°N° BOU">
                {{ Form::text('bou_numero3', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="docorigem" title="Doc. Origem" >
                {!! Form::select('docorigem', 
                [
                    '-' => '-',
                    'audiencia de custodia' => 'Audiência de custódia',
                    'direto' => 'Direto',
                    'e-mail' => 'E-mail',
                    'informacao' => 'Informação',
                    'noticia de fato' => 'Notícia de fato',
                    'pedido de providencia' => 'Pedido de providência',
                    'termo' => 'Termo',
                    '0800' => '0800',
                    '181' => '181',
                    'CI' => 'CI',
                    'EI' => 'EI',
                    'MP' => 'MP',
                    'PM' => 'PM',
                    'DH' => 'DH',
                    'PJM' => 'PJM',
                    'PB' => 'PB',
                    'RI' => 'RI',
                    'SPPA' => 'SPPA',
                    'outros' => 'Outros'
                ]
                ,null, ['class' => 'form-control select2']) !!}
            </v-label>
            <v-label label="numerodoc" title="°N° Documento" tooltip="Nº ou descrição, outros documentos">
                {{ Form::text('numerodoc', null, ['class' => 'form-control ']) }}
            </v-label>    
            <v-label label="pid" title="PID">
                {{ Form::text('pid', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="motivo_principal" title="Motivo Principal" >
                {!! Form::select('motivo_principal', 
                [
                    '-' => '-',
                    'corrupcao' => 'Corrupção',
                    'prevaricacao' => 'Prevaricação',
                    'abuso de autoridade' => 'Abuso de autoridade',
                    'tortura' => 'Tortura',
                    'lesao corporal' => 'Lesão corporal',
                    'homicidio' => 'Homicídio',
                    'trafico de drogas' => 'Tráfico de drogas',
                    'uso de entorpecente' => 'Uso de entorpecente',
                    'improbidade administrativa' => 'Improbiedade administrativa',
                    'servico (bico)' => 'Serviço (Bico)',
                    'roubo / furto' => 'Roubo / Furto',
                    'caixa eletronico' => 'Caixa eletrônico',
                    'lei maria da penha' => 'Lei Maria da Penha',
                    'abordagem' => 'Abordagem',
                    'outros' => 'Outros'
                ]
                ,null, ['class' => 'form-control select2']) !!}
            </v-label> 
            <v-label label="motivo_secundario" title="Motivo Principal" >
                {!! Form::select('motivo_secundario', 
                [
                    '-' => '-',
                    'corrupcao' => 'Corrupção',
                    'prevaricacao' => 'Prevaricação',
                    'abuso de autoridade' => 'Abuso de autoridade',
                    'tortura' => 'Tortura',
                    'lesao corporal' => 'Lesão corporal',
                    'homicidio' => 'Homicídio',
                    'trafico de drogas' => 'Tráfico de drogas',
                    'uso de entorpecente' => 'Uso de entorpecente',
                    'improbidade administrativa' => 'Improbiedade administrativa',
                    'servico (bico)' => 'Serviço (Bico)',
                    'roubo / furto' => 'Roubo / Furto',
                    'caixa eletronico' => 'Caixa eletrônico',
                    'lei maria da penha' => 'Lei Maria da Penha',
                    'abordagem' => 'Abordagem',
                    'outros' => 'Outros'
                ]
                ,null, ['class' => 'form-control select2']) !!}
            </v-label>
            <v-label label="desc_outros" lg='12' md='12' title="Descrição outros motivos">
                {{ Form::text('desc_outros', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="sintese_txt" title="Sintese" lg="12" md="12" error="{{$errors->first('sintese_txt')}}">
                {!! Form::textarea('sintese_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
            </v-label>
            <v-label label="vtr1_placa" title="Placa da viatura (sem traço)">
                {{ Form::text('vtr1_placa', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="vtr1_prefixo" title="Prefixo da viatura">
                {{ Form::text('vtr1_prefixo', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="vtr2_placa" title="Placa da viatura (sem traço)">
                {{ Form::text('vtr2_placa', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="vtr2_prefixo" title="Prefixo da viatura">
                {{ Form::text('vtr2_prefixo', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="vtr3_placa" title="Placa da viatura (sem traço)">
                {{ Form::text('vtr3_placa', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="vtr3_prefixo" title="Prefixo da viatura">
                {{ Form::text('vtr3_prefixo', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="Digitador" lg='12' md='12' title="Digitador">
                {{ Form::text('Digitador', session('nome'), ['class' => 'form-control ']) }}
            </v-label>
            {!! Form::submit('Inserir sai',['class' => 'btn btn-primary btn-block']) !!}
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

