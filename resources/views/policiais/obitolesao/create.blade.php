@extends('adminlte::page')

@section('title', 'Óbito/Lesão - Criar')

@section('content_header')
<section class="content-header">   
  <h1>Óbito/Lesão - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('obitolesao.index')}}">Óbito/Lesão - Lista</a></li>
  <li class="active">Óbito/Lesão - Criar</li>
  </ol>
</section>

</v-select>
@stop

@section('content')
<section class="">
    <div class="tab-content">
        <v-tab-item title="Formulário principal" idp="principal" cls="active show">
            {!! Form::open(['url' => route('obitolesao.store')]) !!}
            <v-label label="rg" title="RG" lg="4" md="4" error="{{$errors->first('rg')}}">
                {{ Form::text('rg', null, ['class' => 'form-control ','onchange' => 'completaDados(this,nome,cargo)','onkeyup' => 'completaDados(this,nome,cargo)']) }}
            </v-label>
            <v-label label="nome" title="Nome" lg="4" md="4" error="{{$errors->first('nome')}}">
                {{ Form::text('nome', null, ['class' => 'form-control ','readonly','id' => 'nome']) }}
            </v-label>
            <v-label label="cargo" title="Posto/Graduação" lg="4" md="4" error="{{$errors->first('cargo')}}">
                {{ Form::text('cargo', null, ['class' => 'form-control ','readonly','id' => 'cargo']) }}
            </v-label>
            <v-label label="data" title="Data de início" icon="fa fa-calendar" error="{{$errors->first('data')}}">
                <v-datepicker name="data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="id_municipio" title="Municipio" error="{{$errors->first('id_municipio')}}">
                <v-municipio id_municipio="{{$proc['id_municipio'] ?? ''}}"></v-municipio>
            </v-label>
            <v-label label="endereco" title='Rua/Av' error="{{$errors->first('endereco')}}">
                {{ Form::text('endereco', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="endereco_numero" title=' nº e compl.' error="{{$errors->first('endereco_numero')}}">
                {{ Form::text('endereco_numero', null, ['class' => 'form-control ']) }}
            </v-label>
            {{-- <v-proced-origem></v-proced-origem><br>   --}}
            <v-label label="cdopm" title="OPM" error="{{$errors->first('cdopm')}}">
                <v-opm cdopm="{{$proc['cdopm'] ?? ''}}"></v-opm>
            </v-label>
            <v-label label="bou_ano" title="BOU (Ano)">
                <v-ano ano="{{$proc['bou_ano'] ?? date('Y')}}"></v-ano>
            </v-label>
            <v-label label="bou_numero" title="N° BOU" error="{{$errors->first('bou_numero')}}">
                {{ Form::text('bou_numero', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="id_situacao" title="Situação">
                {!! Form::select('id_situacao',config('sistema.situacaoOCOR'),null, ['class' => 'form-control ', 'id' => 'descricao']) !!}
            </v-label>
            <v-label label="resultado" title="Situação">
                {!! Form::select('resultado',['Obito' => 'Óbito','Lesao Corporal' => 'Lesão Corporal'],null, ['class' => 'form-control ', 'id' => 'descricao']) !!}
            </v-label>
            <v-label label="descricao_txt" title="Descrição do fato" lg="12" md="12" error="{{$errors->first('descricao_txt')}}">
                {!! Form::textarea('descricao_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
            </v-label>
            {!! Form::submit('Inserir Óbito/Lesão',['class' => 'btn btn-primary btn-block']) !!}
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

