@extends('adminlte::page')

@section('title', 'Deserção - Criar')

@section('content_header')
<section class="content-header">   
  <h1>Deserção - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('desercao.lista')}}">Deserção - Lista</a></li>
  <li class="active">Deserção - Criar</li>
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

            {!! Form::open(['url' => route('desercao.store')]) !!}
                <v-prioritario admin="session('is_admin')" prioridade="{{$proc['prioridade']}}"></v-prioritario>
                <v-acusado-unico idp="{{$proc['id_desercao']}}" situacao="{{sistema('procSituacao','desercao')}}" ></v-acusado-unico><br>
                <v-label label="cdopm" title="OPM">
                    <v-opm cdopm="{{$proc['cdopm']}}"></v-opm>
                </v-label>
                <v-label label="id_andamentocoger" title="Andamento COGER" error="{{$errors->first('id_andamentocoger')}}">
                    {!! Form::select('id_andamentocoger',config('sistema.andamentocogerdesercao'),null, ['class' => 'form-control ']) !!}
                </v-label>
                <v-label label="fato_data" title="Data da fato" icon="fa fa-calendar">
                    <v-datepicker name="fato_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['fato_data'] ?? ''}}"></v-datepicker>
                </v-label>
                <v-label label="doc_tipo" title="Tipo de boletim">
                    {!! Form::select('doc_tipo',config('sistema.tipoBoletim'),null, ['class' => 'form-control ']) !!}
                </v-label>
                <v-label label="doc_numero" title="N° Boletim">
                    {{ Form::text('doc_numero', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="termo_exclusao" title="Termo exclusão">
                    {!! Form::select('termo_exclusao',config('sistema.termo_exclusao'),null, ['class' => 'form-control ', 'id' => 'descricao']) !!}
                </v-label>
                <v-label label="termo_exclusao_pub" title="Publicado no (Ex: BG 110/2010)">
                    {{ Form::text('termo_exclusao_pub', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="termo_captura" title="Termo Captura">
                    {!! Form::select('termo_captura',config('sistema.termo_captura'),null, ['class' => 'form-control ', 'id' => 'descricao']) !!}
                </v-label>
                <v-label label="termo_captura_pub" title="Publicado no (Ex: BG 110/2010)">
                    {{ Form::text('termo_captura_pub', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="pericia" title="Perícia">
                    {!! Form::select('pericia',config('sistema.pericia'),null, ['class' => 'form-control ', 'id' => 'descricao']) !!}
                </v-label>
                <v-label label="pericia_pub" title="Publicado no (Ex: BG 110/2010)">
                    {{ Form::text('pericia_pub', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="termo_inclusao" title="Termo Inclusão">
                    {!! Form::select('termo_inclusao',config('sistema.termo_inclusao'),null, ['class' => 'form-control ', 'id' => 'descricao']) !!}
                </v-label>
                <v-label label="termo_inclusao_pub" title="Publicado no (Ex: BG 110/2010)">
                    {{ Form::text('termo_inclusao_pub', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="referenciavajme" title="Referencia VAJME (Nº do processo, vara)">
                    {{ Form::text('referenciavajme', null, ['class' => 'form-control ']) }}
                </v-label>
            {!! Form::submit('Inserir Deserção',['class' => 'btn btn-primary btn-block']) !!}
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

