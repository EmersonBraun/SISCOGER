@extends('adminlte::page')

@section('title', 'Suspenso - Criar')

@section('content_header')
<section class="content-header">   
  <h1>Suspenso - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('suspenso.index')}}">Suspenso - Lista</a></li>
  <li class="active">Suspenso - Criar</li>
  </ol>
</section>

</v-select>
@stop

@section('content')
<section class="">
    <div class="tab-content">
        <v-tab-item title="Formulário principal" idp="principal" cls="active show">
            {!! Form::open(['url' => route('suspenso.store')]) !!}
            <v-label label="rg" title="RG" lg="4" md="4" error="{{$errors->first('rg')}}">
                {{ Form::text('rg', null, ['class' => 'form-control ','onchange' => 'completaDados(this,nome,cargo)','onkeyup' => 'completaDados(this,nome,cargo)']) }}
            </v-label>
            <v-label label="nome" title="Nome" lg="4" md="4" error="{{$errors->first('nome')}}">
                {{ Form::text('nome', null, ['class' => 'form-control ','readonly','id' => 'nome']) }}
            </v-label>
            <v-label label="cargo" title="Posto/Graduação" lg="4" md="4" error="{{$errors->first('cargo')}}">
                {{ Form::text('cargo', null, ['class' => 'form-control ','readonly','id' => 'cargo']) }}
            </v-label>
            <v-label label="processo" lg='12' md='12' title="Processo, Nº do processo - Comarca (Ex: Ação Penal Militar nº 2010.000xxx0x - Curitiba)" error="{{$errors->first('processo')}}">
                {{ Form::text('processo', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="infracao" lg='12' md='12' title="Artigos da infração penal" error="{{$errors->first('infracao')}}">
                {{ Form::text('infracao', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="numerounico" lg='12' md='12' title="Nº único" error="{{$errors->first('numerounico')}}">
                {{ Form::text('numerounico', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="inicio_data" lg='6' title="Data de início" icon="fa fa-calendar">
                <v-datepicker name="inicio_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['inicio_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="fim_data" lg='6' title="Data de fim da suspensão" icon="fa fa-calendar">
                <v-datepicker name="fim_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['fim_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="obs_txt" title="Observações" lg="12" md="12" error="{{$errors->first('obs_txt')}}">
                {!! Form::textarea('obs_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
            </v-label>
            {!! Form::submit('Inserir Suspenso',['class' => 'btn btn-primary btn-block']) !!}
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

