@extends('adminlte::page')

@section('title', 'Relatório - Processos')

@section('content_header')
<section class="content-header">   
  <h1>Relatório de Processos</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  </ol>
</section>
@stop

@section('content')
<section class="">
    <div class="tab-content">
        <v-tab-item title="Formulário principal" idp="principal" cls="active show">
            {!! Form::open(['url' => route('processo.result')]) !!}
            <v-label label="sjd_ref_ano_ini" title="Ano Inicial" error="{{$errors->first('sjd_ref_ano_ini')}}">
                <v-ano todos name="sjd_ref_ano_ini" ano="{{$proc['sjd_ref_ano_ini'] ?? ''}}"></v-ano>
            </v-label>
            <v-label label="sjd_ref_ano_fim" title="Ano Final" error="{{$errors->first('sjd_ref_ano_fim')}}">
                <v-ano todos name="sjd_ref_ano_fim" ano="{{$proc['sjd_ref_ano_fim'] ?? ''}}"></v-ano>
            </v-label>
            @if(session('ver_todas_unidades'))
            <v-label label="cdopm" title="OPM" error="{{$errors->first('cdopm')}}">
                <v-opm todas cdopm="{{$proc['cdopm'] ?? ''}}"></v-opm>
            </v-label>
            @else 
                <input type="hidden" name="cdopm" value="{{session('cdopm')}}">
            @endif
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
