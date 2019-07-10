@extends('adminlte::page')

@section('title', 'IPM - Criar')

@section('content_header')
<section class="content-header">   
  <h1>IPM - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('ipm.lista',['ano' => date('Y')])}}">IPM - Lista</a></li>
  <li class="active">IPM - Criar</li>
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

            {!! Form::open(['url' => route('ipm.store')]) !!}
                <v-prioritario admin="session('admin')" prioridade="{{$proc['prioridade']}}"></v-prioritario>
                <v-label label="id_andamento" title="Andamento">
                    {!! Form::select('id_andamento',config('sistema.andamentoIPM'),null, ['class' => 'form-control ']) !!}
                </v-label>
                <v-label label="id_andamentocoger" title="Andamento COGER">
                    {!! Form::select('id_andamentocoger',config('sistema.andamentocogerIPM'),null, ['class' => 'form-control ']) !!}
                </v-label>
                <v-label label="cdopm" title="OPM">
                    <v-opm cdopm="{{$proc['cdopm']}}"></v-opm>
                </v-label>
                <v-label label="fato_data" title="Data da fato" icon="fa fa-calendar">
                    <v-datepicker name="fato_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['fato_data'] ?? ''}}"></v-datepicker>
                </v-label>
                <v-label label="abertura_data" title="Data da portaria de delegação de poderes" icon="fa fa-calendar">
                    <v-datepicker name="abertura_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['abertura_data'] ?? ''}}"></v-datepicker>
                </v-label>
                <v-label label="autuacao_data" title="Data da portaria de instauração" icon="fa fa-calendar">
                    <v-datepicker name="autuacao_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['autuacao_data'] ?? ''}}"></v-datepicker>
                </v-label>
                <v-label label="portaria_numero" title="Nº da portaria de delegação de poderes">
                    {{ Form::text('portaria_numero', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="crime" title="Crime">
                    {!! Form::select('crime',config('sistema.crime'),null, ['class' => 'form-control ', 'id' => 'descricao']) !!}
                </v-label>
                <v-label label="id_municipio" title="Municipio">
                    <v-municipio id_municipio="{{$proc['id_municipio']}}"></v-municipio>
                </v-label>
                <v-label label="bou_ano" title="BOU (Ano)">
                    <v-ano ano="{{$proc['bou_ano']}}"></v-ano>
                </v-label>
                <v-label label="bou_numero" title="N° BOU">
                    {{ Form::text('bou_numero', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="n_eproc" title="N° Eproc">
                    {{ Form::text('n_eproc', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="ano_eproc" title="Eproc (Ano)">
                    <v-ano ano="{{$proc['ano_eproc']}}"></v-ano>
                </v-label>
                <v-label label="relato_enc" title="Conclusão do encarregado">
                    {{ Form::text('relato_enc', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="sintese_txt" title="Sintese" lg="12" md="12" error="{{$errors->first('sintese_txt')}}">
                    {!! Form::textarea('sintese_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
                </v-label>
            {!! Form::submit('Inserir IPM',['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
            </div>
        </div>
    </div>

    </div>{{-- procedimento principal --}}
  
</section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@include('vendor.adminlte.includes.vue')
@stop

