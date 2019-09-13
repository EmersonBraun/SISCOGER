@extends('adminlte::page')

@section('title', 'Relatório - Elogio')

@section('content_header')
<section class="content-header">   
  <h1>Busca Envolvido</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  </ol>
</section>
@stop

@section('content')
<section class="">
    <div class="tab-content">
        <v-tab-item title="Formulário principal" idp="principal" cls="active show">
            {!! Form::open(['url' => route('busca.envolvido')]) !!}
            <v-label label="rg" title="RG" lg="3" md="3" error="{{$errors->first('rg')}}">
                {{ Form::text('rg', null, ['class' => 'form-control ','onchange' => 'completaDados(this,nome,cargo)','onkeyup' => 'completaDados(this,nome,cargo)']) }}
            </v-label>
            <v-label label="nome" title="Nome" lg="3" md="3" error="{{$errors->first('nome')}}">
                {{ Form::text('nome', null, ['class' => 'form-control ','readonly','id' => 'nome']) }}
            </v-label>
            <v-label label="cargo" title="Posto/Graduação" lg="3" md="3" error="{{$errors->first('cargo')}}">
                {{ Form::text('cargo', null, ['class' => 'form-control ','readonly','id' => 'cargo']) }}
            </v-label>
            <v-label label="check" title="Selecione: " md="12" lg="12">
                <v-checkbox name="ipm" true-value="1" false-value="0" text="ac_desempenho_bl"></v-checkbox>
                <v-checkbox name="iso" true-value="1" false-value="0" text="ac_desempenho_bl"></v-checkbox>
                <v-checkbox name="it" true-value="1" false-value="0" text="ac_desempenho_bl"></v-checkbox>
                <v-checkbox name="fatd" true-value="1" false-value="0" text="ac_desempenho_bl"></v-checkbox>
                <v-checkbox name="cd" true-value="1" false-value="0" text="ac_desempenho_bl"></v-checkbox>
                <v-checkbox name="cj" true-value="1" false-value="0" text="ac_desempenho_bl"></v-checkbox>
                <v-checkbox name="ac_desempenho_bl" true-value="1" false-value="0" text="ac_desempenho_bl"></v-checkbox>
                <v-checkbox name="ac_desempenho_bl" true-value="1" false-value="0" text="ac_desempenho_bl"></v-checkbox>
                <v-checkbox name="ac_desempenho_bl" true-value="1" false-value="0" text="ac_desempenho_bl"></v-checkbox>
                <v-checkbox name="ac_desempenho_bl" true-value="1" false-value="0" text="ac_desempenho_bl"></v-checkbox>
                <v-checkbox name="ac_desempenho_bl" true-value="1" false-value="0" text="ac_desempenho_bl"></v-checkbox>
                <v-checkbox name="ac_desempenho_bl" true-value="1" false-value="0" text="ac_desempenho_bl"></v-checkbox>
                <v-checkbox name="ac_desempenho_bl" true-value="1" false-value="0" text="ac_desempenho_bl"></v-checkbox>
            </v-label>
            <v-label slim label="tipo" md="12" lg="12">
                {!! Form::submit('Buscar',['class' => 'btn btn-primary btn-block']) !!}
            </v-label>
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

