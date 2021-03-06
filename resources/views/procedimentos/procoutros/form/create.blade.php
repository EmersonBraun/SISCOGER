@extends('adminlte::page')

@section('title', 'Proc. Outros - Criar')

@section('content_header')
<section class="content-header">   
  <h1>Proc. Outros - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('procoutro.lista')}}">Proc. Outros - Lista</a></li>
  <li class="active">Proc. Outros - Criar</li>
  </ol>
</section>
  
@stop

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
<section class="">
    <div class="row">

        <div class="col-xs-12">

        <div class="box">{{-- formulário principal --}}
            <div class="box-header">
                {{-- sjd_ref / sjd_ref_ano --}}
                <h4 class="box-title">N° * / {{date('Y')}} - Formulário principal</h4>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-plus"></i>
                    </button> 
                </div>             
            </div>

            <div class="box-body">

            {!! Form::open(['url' => route('procoutro.store')]) !!}
                <v-prioritario prioridade="{{$proc['prioridade'] ?? ''}}"></v-prioritario>
                <v-label label="id_andamento" title="Andamento" error="{{$errors->first('andamento')}}">
                    {!! Form::select('andamento',[
                        'abertura' => 'Abertura', 
                        'em andamento' => 'Em andamento', 
                        'concluido' => 'Concluído'
                        ],null, ['class' => 'form-control ']) !!}
                </v-label>
                <v-label label="id_andamentocoger" title="Andamento COGER" error="{{$errors->first('andamentocoger')}}">
                    {!! Form::select('andamentocoger',[
                        "unidade" => "Unidade",
                        "arquivo" => "Arquivo",
                        "COGER" => "COGER",
                        "poder judiciario" => "Poder Judiciário",
                        "ministerio publico" => "Ministério Público",
                        "outros orgaos" => "Outros Orgãos"
                        ],null, ['class' => 'form-control ']) !!}
                </v-label>
                <v-label label="num_pid" title="N° PID">
                    {{ Form::text('num_pid', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="data" title="Data da abertura" icon="fa fa-calendar">
                    <v-datepicker name="data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['data'] ?? ''}}"></v-datepicker>
                </v-label>
                <v-label label="abertura_data" title="Data de recebimento" icon="fa fa-calendar">
                    <v-datepicker name="abertura_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['abertura_data'] ?? ''}}"></v-datepicker>
                </v-label>
                <v-label label="limite_data" title="Data limite" icon="fa fa-calendar">
                    <v-datepicker name="limite_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['limite_data'] ?? ''}}"></v-datepicker>
                </v-label>
                <v-label label="cdopm" title="OPM">
                    <v-opm cdopm="{{$proc['cdopm'] ?? ''}}"></v-opm>
                </v-label>
                <v-label label="doc_origem" title="Doc. Origem">
                    {!! Form::select('doc_origem',[
                        "audiencia de custodia" => "Audiência de custódia",
                        "noticia de fato" => "Notícia de fato",
                        "pedido de providencia" => "Pedido de providência",
                        "outros" => "Outros"
                        ],null, ['class' => 'form-control ', 'id' => 'descricao']) !!}
                </v-label>
                <v-label label="num_doc_origem" title="Nº Documento, ou descrição outros documentos">
                    {{ Form::text('num_doc_origem', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="motivo_abertura" title="Motivo Abertura">
                    {!! Form::select('motivo_abertura',[
                        "abordagem" => "Abordagem",
                        "abuso de autoridade" => "Abuso de autoridade",
                        "caixa eletronico" => "Caixa eletrônico",
                        "corrupcao" => "Corrupção",
                        "crimes sexuais" => "Crimes sexuais",
                        "discriminacao racial" => "Discriminação racial",
                        "estatuto do desarmamento" => "Estatuto do desarmamento",
                        "estelionato" => "Estelionato",
                        "extorsao" => "Extorsão",
                        "homicidio" => "Homicídio",
                        "improbidade administrativa" => "Improbiedade administrativa",
                        "lei maria da penha" => "Lei Maria da Penha",
                        "lesao corporal" => "Lesão corporal",				
                        "prevaricacao" => "Prevaricação",
                        "roubo / furto" => "Roubo / Furto",
                        "servico (bico)" => "Serviço (Bico)",			
                        "tortura" => "Tortura",
                        "trafico de drogas" => "Tráfico de drogas",
                        "uso de entorpecente" => "Uso de entorpecente",
                        "outros" => "Outros"
                        ],null, ['class' => 'form-control ', 'id' => 'descricao']) !!}
                </v-label>
                <v-label label="desc_outros" title="Descrição outros motivos:">
                    {{ Form::text('desc_outros', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="id_municipio" title="Municipio" error="{{$errors->first('id_municipio')}}">
                    <v-municipio id_municipio="{{$proc['id_municipio'] ?? ''}}"></v-municipio>
                </v-label>
                --subform viaturas--
                <v-label label="sintese_txt" title="Sintese" lg="12" md="12" error="{{$errors->first('sintese_txt')}}">
                    {!! Form::textarea('sintese_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
                </v-label>
            {!! Form::submit('Inserir Proc. Outros',['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
            </div>
        </div>
    </div>

    </div>{{-- procedimento principal --}}
  
</section>
@stop

@section('css')
@stop

@section('js')
@include('vendor.adminlte.includes.vue')
@stop

