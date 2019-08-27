@extends('adminlte::page')

@section('title', 'Medalha - Criar')

@section('content_header')
<section class="content-header">   
  <h1>Medalha - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('preso.index')}}">Medalha - Lista</a></li>
  <li class="active">Medalha - Criar</li>
  </ol>
</section>

</v-select>
@stop

@section('content')
<section class="">
    <div class="tab-content">
        <v-tab-item title="Formulário principal" idp="principal" cls="active show">
            {!! Form::open(['url' => route('medalha.store')]) !!}
            <input type="hidden" name="rg_cadastro" value="{{session('rg')}}">
            <v-label label="rg" title="RG" lg="4" md="4" error="{{$errors->first('rg')}}">
                {{ Form::text('rg', null, ['class' => 'form-control ','onchange' => 'completaDados(this,nome,cargo)','onkeyup' => 'completaDados(this,nome,cargo)']) }}
            </v-label>
            <v-label label="nome" title="Nome" lg="4" md="4" error="{{$errors->first('nome')}}">
                {{ Form::text('nome', null, ['class' => 'form-control ','readonly','id' => 'nome']) }}
            </v-label>
            <v-label label="cargo" title="Posto/Graduação" lg="4" md="4" error="{{$errors->first('cargo')}}">
                {{ Form::text('cargo', null, ['class' => 'form-control ','readonly','id' => 'cargo']) }}
            </v-label>
            <v-label label="nome_medalha" title="Nome da Medalha" error="{{$errors->first('nome_medalha')}}">
                {{ Form::text('nome_medalha', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="bi_num" title="Nº Boletim" error="{{$errors->first('bi_num')}}">
                {{ Form::text('bi_num', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="bi_data" title="Data do Boletim" icon="fa fa-calendar">
                <v-datepicker name="bi_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['bi_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="obs_txt" title="Observações" lg="12" md="12" error="{{$errors->first('obs_txt')}}">
                {!! Form::textarea('obs_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
            </v-label>
            {!! Form::submit('Inserir Medalha',['class' => 'btn btn-primary btn-block']) !!}
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

