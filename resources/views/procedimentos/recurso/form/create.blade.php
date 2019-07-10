@extends('adminlte::page')

@section('title', 'Recurso - Criar')

@section('content_header')
<section class="content-header">   
  <h1>Recurso - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('recurso.lista')}}">Recurso - Lista</a></li>
  <li class="active">Recurso - Criar</li>
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

            {!! Form::open(['url' => route('recurso.store')]) !!}
                <v-prioritario admin="session('is_admin')" prioridade="{{$proc['prioridade']}}"></v-prioritario>
                <v-label label="procedimento" title="Procedimento">
                    {!! Form::select('procedimento',config('sistema.pocedimentosOpcoes'),null, ['class' => 'form-control ']) !!}
                </v-label>
                <v-label label="sjd_ref" title="Referência">
                    {{ Form::text('sjd_ref', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="sjd_ref_ano" title="Ano">
                    <v-ano name="sjd_ref_ano" ano="{{$proc['sjd_ref_ano']}}"></v-ano>
                </v-label>
                <v-label label="portaria_data" title="Data e hora do recebimento (automático)" icon="fa fa-calendar" lg="12" md="12">
                    <v-datepicker name="portaria_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['portaria_data'] ?? ''}}"></v-datepicker>
                </v-label>
            {!! Form::submit('Inserir Recurso',['class' => 'btn btn-primary btn-block']) !!}
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
