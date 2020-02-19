@extends('adminlte::page')

@section('title', 'IT - Criar')

@section('content_header')
<section class="content-header">   
  <h1>IT - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('it.lista',['ano' => date('Y')])}}">IT - Lista</a></li>
  <li class="active">IT - Criar</li>
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

            {!! Form::open(['url' => route('it.store')]) !!}
                <v-prioritario prioridade="{{$proc['prioridade'] ?? ''}}"></v-prioritario>
                <v-label label="id_andamento" title="Andamento" error="{{$errors->first('id_andamento')}}">
                    {!! Form::select('id_andamento',config('sistema.andamentoIT'),null, ['class' => 'form-control ']) !!}
                </v-label>
                <v-label label="id_andamentocoger" title="Andamento COGER" error="{{$errors->first('id_andamentocoger')}}">
                    {!! Form::select('id_andamentocoger',config('sistema.andamentocogerIT'),null, ['class' => 'form-control ']) !!}
                </v-label>
                <v-label label="cdopm" title="OPM" error="{{$errors->first('cdopm')}}">
                    <v-opm></v-opm>
                </v-label>
                <v-label label="fato_data" title="Data da fato" icon="fa fa-calendar">
                    <v-datepicker name="fato_data" placeholder="dd/mm/aaaa"></v-datepicker>
                </v-label>
                <v-label label="abertura_data" title="Data da abertura" icon="fa fa-calendar">
                    <v-datepicker name="abertura_data" placeholder="dd/mm/aaaa" clear-button ></v-datepicker>
                </v-label>
                <v-it-objeto-procedimento></v-it-objeto-procedimento>
                <v-label label="boletiminterno_numero" title="Boletim Interno da Publicação">
                    {{ Form::text('boletiminterno_numero', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="boletiminterno_data" title="Data da Publicação do Boletim">
                    <v-datepicker name="boletiminterno_data" placeholder="dd/mm/aaaa" clear-button></v-datepicker>
                </v-label>
                <v-label label="br_numero" title="Nº do BR da publicação">
                    {{ Form::text('br_numero', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="portaria_numero" title="Nº da portaria">
                    {{ Form::text('portaria_numero', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="situacao_objeto" title="Nº do BR da publicação">
                    {{ Form::text('situacao_objeto', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="acordoamigavel" title="Ressarcimento Extrajudicial">
                    {!! Form::select('acordoamigavel', ['-','S','N'],null, ['class' => 'form-control select2', 'id' => 'descricao']) !!}
                </v-label>
                <v-label label="resp_civil" title="Responsabilidade civil">
                    {!! Form::select('resp_civil', config('sistema.respCivil'),null, ['class' => 'form-control select2', 'id' => 'descricao']) !!}
                </v-label>
                <v-label label="id_causa_acidente" title="Causa acidente" error="{{$errors->first('id_causa_acidente')}}">
                    {!! Form::select('id_causa_acidente',config('sistema.causaAcidente'),null, ['class' => 'form-control ']) !!}
                </v-label>
                <v-label label="arquivo_numero" title="Número do arquivo">
                    {{ Form::text('arquivo_numero', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="protocolo_numero" title="Número do protocolo">
                    {{ Form::text('protocolo_numero', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="acaojudicial" title="Ação judicial">
                    {!! Form::select('acaojudicial', ['-','S','N'],null, ['class' => 'form-control select2', 'id' => 'descricao']) !!}
                </v-label>
                <v-label label="danoestimado_rs" title="Valor do dano estimado">
                    <money class="form-control" placeholder="R$" name="danoestimado_rs" value="{{ $proc['danoestimado_rs'] ?? ''}}"/>
                </v-label>
                <v-label label="danoreal_rs" title="Valor do dano real">
                    <money class="form-control" placeholder="R$" name="danoreal_rs" value="{{ $proc['danoreal_rs'] ?? ''}}"/>
                </v-label>
                <v-label label="sintese_txt" title="Sintese" lg="12" md="12" error="{{$errors->first('sintese_txt')}}">
                    {!! Form::textarea('sintese_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
                </v-label>
            {!! Form::submit('Inserir IT',['class' => 'btn btn-primary btn-block']) !!}
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

