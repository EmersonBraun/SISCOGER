@extends('adminlte::page')

@section('title', 'Feriado - Criar')

@section('content_header')
<section class="content-header">   
  <h1>Feriado - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('feriado.index')}}">Feriado - Lista</a></li>
  <li class="active">Feriado - Criar</li>
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
        <v-tab-item title="Formulário" idp="principal" cls="active show">
            {!! Form::open(['url' => route('feriado.store')]) !!}
                <v-label lg="6" label="data" title="Data" icon="fa fa-calendar" error="{{$errors->first('data')}}">
                    <v-datepicker name="data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['data'] ?? ''}}"></v-datepicker>
                </v-label>
                <v-label lg="6" label="feriado" title="Descrição" error="{{$errors->first('feriado')}}">
                    {{ Form::text('feriado', null, ['class' => 'form-control ']) }}
                </v-label>
                {!! Form::submit('Inserir Feriado',['class' => 'btn btn-primary btn-block']) !!}
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

