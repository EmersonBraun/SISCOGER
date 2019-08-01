@extends('adminlte::page')

@section('title', 'Exclusão - Criar')

@section('content_header')
<section class="content-header">   
  <h1>Exclusão - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('exclusao.lista')}}">Exclusão - Lista</a></li>
  <li class="active">Exclusão - Criar</li>
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
            {!! Form::open(['url' => route('exclusao.store')]) !!}
                <v-prioritario admin="session('is_admin')"></v-prioritario>
                <v-label label="rg" title="RG" lg="3" md="3" error="{{$errors->first('rg')}}">
                    {{ Form::text('rg', null, ['class' => 'form-control ','onchange' => 'completaDados(this,nome,cargo)','onkeyup' => 'completaDados(this,nome,cargo)']) }}
                </v-label>
                <v-label label="nome" title="Nome" lg="3" md="3" error="{{$errors->first('nome')}}">
                    {{ Form::text('nome', null, ['class' => 'form-control ','readonly','id' => 'nome']) }}
                </v-label>
                <v-label label="cargo" title="Posto/Graduação" lg="3" md="3" error="{{$errors->first('cargo')}}">
                    {{ Form::text('cargo', null, ['class' => 'form-control ','readonly','id' => 'cargo']) }}
                </v-label>
                <v-label label="situacao" title="Resultado" lg="3" md="3">
                    {{ Form::text('situacao', sistema('procSituacao','desercao'), ['class' => 'form-control ','readonly']) }}
                </v-label>
                <v-label label="cdopm_quandoexcluido" title="OPM em que estava servindo quando excluído" error="{{$errors->first('cdopm_quandoexcluido')}}">
                    <v-opm></v-opm>
                </v-label>
                <v-label label="id_motivoconselho" title="Motivo">
                    {!! Form::select('id_motivoconselho', config('sistema.motivoConselho'),null, ['class' => 'form-control select2', 'id' => 'descricao']) !!}
                </v-label>  
                <v-label label="processo" title="Processo, Nº do processo - Comarca.">
                    {{ Form::text('processo', null, ['class' => 'form-control ','placeholder' => 'Ex: Ação Penal Militar nº 2010.0000XXX-X - Curitiba']) }}
                </v-label>
                <v-label label="complemento" title="Artigos da Infração penal">
                    {{ Form::text('complemento', null, ['class' => 'form-control ','placeholder' => 'Ex: Ação Penal Militar nº 2010.0000XXX-X - Curitiba']) }}
                </v-label>
                <v-label label="vara" title="Vara e Comarca(Ex: 3ª Vara Criminal de Curitiba)">
                    {{ Form::text('vara', null, ['class' => 'form-control ','placeholder' => '(Ex: Art. 121 § 2º CP)']) }}
                </v-label>
                <v-label label="numerounico" title="Nº único">
                    {{ Form::text('numerounico', null, ['class' => 'form-control ','placeholder' => 'Ex: 0003956-00.2012.8.16.0013']) }}
                </v-label>
                <v-label label="data" title="Data da sentença" icon="fa fa-calendar">
                    <v-datepicker name="data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['data'] ?? ''}}"></v-datepicker>
                </v-label>
                <v-label label="exclusao_data" title="Data da exclusão (data que publicou a portaria)" icon="fa fa-calendar">
                    <v-datepicker name="exclusao_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['exclusao_data'] ?? ''}}"></v-datepicker>
                </v-label>
                <v-label label="portaria_numero" title="N° Portaria">
                    {{ Form::text('portaria_numero', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="bg_numero" title="N° BG">
                    {{ Form::text('bg_numero', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="bg_ano" title="N° Boletim">
                    {{ Form::text('bg_ano', null, ['class' => 'form-control ','placeholder' => 'aaaa']) }}
                </v-label>
                <v-label label="obs_txt" title="Sintese" lg="12" md="12" error="{{$errors->first('obs_txt')}}">
                    {!! Form::textarea('obs_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
                </v-label>
            {!! Form::submit('Inserir Exclusão',['class' => 'btn btn-primary btn-block']) !!}
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

