@extends('adminlte::page')

@section('title', 'Busca Nominal')

@section('content_header')
<section class="content-header">   
  <h1>Busca Nominal</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  </ol>
</section>
@stop

@section('content')
<section class="">
    <div class="tab-content">
        <v-tab-item title="Formulário principal" idp="principal" cls="active show">
            {!! Form::open(['url' => route('busca.nominal.result')]) !!}
            <v-label label="rg" title="RG" error="{{$errors->first('rg')}}">
                {{ Form::text('rg', null, ['class' => 'form-control ','onchange' => 'completaDados(this,nome,cargo)','onkeyup' => 'completaDados(this,nome,cargo)']) }}
            </v-label>
            <v-label label="nome" title="Nome" error="{{$errors->first('nome')}}">
                {{ Form::text('nome', null, ['class' => 'form-control ','id' => 'nome']) }}
            </v-label>
            <v-label label="cargo" title="Posto/Graduação" error="{{$errors->first('cargo')}}">
                {{ Form::text('cargo', null, ['class' => 'form-control ','id' => 'cargo']) }}
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

