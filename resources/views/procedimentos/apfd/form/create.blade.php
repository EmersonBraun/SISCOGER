@extends('adminlte::page')

@section('title', 'apfd - Criar')

@section('content_header')
<section class="content-header">   
  <h1>APFD - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('apfd.lista')}}">APFD - Lista</a></li>
  <li class="active">APFD - Criar</li>
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

            {!! Form::open(['url' => route('apfd.store')]) !!}
            <v-prioritario prioridade="{{$proc['prioridade'] ?? ''}}"></v-prioritario>
            <v-label label="cdopm" title="OPM">
                <v-opm></v-opm>
            </v-label>
            <v-label label="id_andamentocoger" title="Andamento COGER">
                {!! Form::select('id_andamentocoger',config('sistema.andamentocogerAPFD'),null, ['class' => 'form-control ']) !!}
            </v-label>
            <v-label label="tipo" title="Tipo" error="{{$errors->first('tipo')}}">
                {!! Form::select('tipo', ['Crime comum','Crime militar'],null, ['class' => 'form-control select2']) !!}
            </v-label>
            <v-label label="fato_data" title="Data do fato">
                <v-datepicker name="fato_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['fato_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="sintese_txt" title="Síntese do fato (Quem, quando, onde, como e por quê): " lg="12" md="12" error="{{$errors->first('sintese_txt')}}">
                {!! Form::textarea('sintese_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
            </v-label>
            <v-label label="tipo_penal_novo" title="Tipos penais (Do mais grave ao menos grave): ">
                {!! Form::select('tipo_penal_novo', config('sistema.tipo_penal_novo'),null, ['class' => 'form-control select2']) !!}
            </v-label>
            <v-label label="especificar" title="Especificar (Caso tipo penal OUTROS): ">
                {{ Form::text('especificar', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="doc_tipo" title="Documento da publicação: ">
                {!! Form::select('doc_tipo',['BI','BG','BR'],null, ['class' => 'form-control ', 'id' => 'descricao']) !!}
            </v-label>
            <v-label label="doc_tipo" title="N° Documento da publicação: ">
                {{ Form::text('doc_tipo', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="referenciavajme" title="Referencia da VAJME (Nº do processo e vara)" >
                {{ Form::text('referenciavajme', null, ['class' => 'form-control ']) }}
            </v-label>
            {!! Form::submit('Inserir apfd',['class' => 'btn btn-primary btn-block']) !!}
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

