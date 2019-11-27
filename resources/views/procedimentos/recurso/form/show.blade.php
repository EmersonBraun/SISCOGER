@extends('adminlte::page')

@section('title', 'Recurso - Ver')

@section('content_header')
<section class="content-header">   
  <h1>Recurso - Ver</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('recurso.lista',['ano' => date('Y')])}}">Recurso - Lista</a></li>
  <li class="active">Recurso - Ver</li>
  </ol>
  <br>
</section>
  
@stop

@section('content')

<section>
    <div class="nav-tabs-custom">
        <v-tab-item title="Recurso do {{strtoupper($proc['procedimento'])}} N° {{ $proc['sjd_ref'] }} / {{ $proc['sjd_ref_ano'] }} - Formulário principal" idp="principal" cls="active show">
            <v-label label="procedimento" title="Procedimento">
                <v-show dado="{{sistema('pocedimentosOpcoes',$proc['procedimento'])}}"></v-show>
            </v-label>
            <v-label label="sjd_ref" title="Referência">
                <v-show dado="{{$proc['sjd_ref']}}"></v-show>
            </v-label>
            <v-label label="sjd_ref_ano" title="Ano">
                <v-show dado="{{$proc['sjd_ref_ano']}}"></v-show>
            </v-label>
            <v-label label="portaria_data" title="Data e hora do recebimento (automático)" icon="fa fa-calendar" lg="12" md="12">
                <v-show dado="{{$proc['portaria_data']}}"></v-show>
            </v-label>
        </v-tab-item>
    </div>
    <div class="content-footer"><br></div>
</section>
@stop

@section('css')
@stop

@section('js')
@include('vendor.adminlte.includes.vue')
@stop

