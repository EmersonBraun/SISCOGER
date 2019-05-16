@extends('adminlte::page')

@section('title', 'Recurso - Editar')

@section('content_header')
<section class="content-header">   
  <h1>Recurso - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('recurso.lista',['ano' => date('Y')])}}">Recurso - Lista</a></li>
  <li class="active">Recurso - Editar</li>
  </ol>
  <br>
</section>
  
@stop

@section('content')

<section>
    <div class="nav-tabs-custom">
        <v-tab-item title="Recurso do {{strtoupper($proc['procedimento'])}} N° {{ $proc['sjd_ref'] }} / {{ $proc['sjd_ref_ano'] }} - Formulário principal" idp="principal" cls="active show">
            {!! Form::model($proc,['url' => route('recurso.update',$proc['id_recurso']),'method' => 'put']) !!}
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
            {!! Form::submit('Alterar Recurso',['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
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

