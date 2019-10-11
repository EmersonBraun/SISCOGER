@extends('adminlte::page')

@section('title', 'CJ - Criar')

@section('content_header')
<section class="content-header">   
  <h1>CJ - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('cj.lista')}}">CJ - Lista</a></li>
  <li class="active">CJ - Criar</li>
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

            {!! Form::open(['url' => route('cj.store')]) !!}
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
            {!! Form::submit('Inserir CJ',['class' => 'btn btn-primary btn-block']) !!}
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

