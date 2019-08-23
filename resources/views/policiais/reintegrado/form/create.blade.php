@extends('adminlte::page')

@section('title', 'Reintegrado - Criar')

@section('content_header')
<section class="content-header">   
  <h1>Reintegrado - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('reintegrado.index')}}">Reintegrado - Lista</a></li>
  <li class="active">Reintegrado - Criar</li>
  </ol>
</section>

</v-select>
@stop

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
<section class="">
    <div class="tab-content">
        <v-tab-item idp="principal" cls="active show">
            {!! Form::open(['url' => route('reintegrado.store')]) !!}
            <v-label label="rg" title="RG" lg="4" md="4" error="{{$errors->first('rg')}}">
                {{ Form::text('rg', null, ['class' => 'form-control ','onchange' => 'completaDados(this,nome,cargo)','onkeyup' => 'completaDados(this,nome,cargo)']) }}
            </v-label>
            <v-label label="nome" title="Nome" lg="4" md="4" error="{{$errors->first('nome')}}">
                {{ Form::text('nome', null, ['class' => 'form-control ','readonly','id' => 'nome']) }}
            </v-label>
            <v-label label="cargo" title="Posto/Graduação" lg="4" md="4" error="{{$errors->first('cargo')}}">
                {{ Form::text('cargo', null, ['class' => 'form-control ','readonly','id' => 'cargo']) }}
            </v-label>
            <v-label label="motivo" md='3' lg='3' title="Motivo da reinclusão" error="{{$errors->first('motivo')}}">
                {!! Form::select('motivo',['Recurso ADM' => 'Recurso administrativo','Acao Judicial' => 'Ação judicial'],'Recurso ADM', 
                ['class' => 'form-control ']) !!}
            </v-label>
            <v-label label="procedimento" md='3' lg='3' title="Procedimento" error="{{$errors->first('procedimento')}}">
                {!! Form::select('procedimento',['cd' => 'CD','cj' => 'CJ','adl' => 'ADL'],'cd', ['class' => 'form-control ']) !!}
            </v-label>
            <v-label label="sjd_ref" md='3' lg='3' title="Referência">
                {{ Form::text('sjd_ref', null, ['class' => 'form-control ', 'maxlength' => '5']) }}
            </v-label>
            <v-label label="sjd_ref_ano" md='3' lg='3' title="Ano" tooltip="Ano com 4 dígitos">
                {{ Form::text('sjd_ref_ano', null, ['class' => 'form-control ', 'maxlength' => '4', 'placeholder' => 'Ano com 4 dígitos']) }}
            </v-label>
            <v-label label="retorno_data" title="Data da reintegração do policial" icon="fa fa-calendar">
                <v-datepicker name="retorno_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['retorno_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="bg_numero" title="Nº Boletim"  error="{{$errors->first('processo')}}">
                {{ Form::text('bg_numero', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="bg_ano" title="Ano Boletim" tooltip="Ano com 4 dígitos" error="{{$errors->first('bg_ano')}}">
                {{ Form::text('bg_ano', null, ['class' => 'form-control ', 'placeholder' => 'Ano com 4 dígitos']) }}
            </v-label>
            {!! Form::submit('Inserir Reintegrado',['class' => 'btn btn-primary btn-block']) !!}
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

