@extends('adminlte::page')

@section('title', 'Deserção - Ver')

@section('content_header')
<section class="content-header">   
  <h1>Deserção - Ver</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('desercao.lista')}}">Deserção - Lista</a></li>
  <li class="active">Deserção - Ver</li>
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
                <v-acusado-unico unico dproc="desercao" idp="{{$proc['id_desercao'] ?? ''}}" situacao="{{sistema('procSituacao','desercao')}}" ></v-acusado-unico><br>
                <v-label label="cdopm" title="OPM">
                    <v-show dado="{{$proc['cdopm']}}"></v-show>
                </v-label>
                <v-label label="id_andamentocoger" title="Andamento COGER" error="{{$errors->first('id_andamentocoger')}}">
                    <v-show dado="{{sistema('andamentocoger',$proc['id_andamentocoger'])}}"></v-show>
                </v-label>
                <v-label label="fato_data" title="Data da fato" icon="fa fa-calendar">
                    <v-show dado="{{$proc['fato_data']}}"></v-show>
                </v-label>
                <v-label label="doc_tipo" title="Tipo de boletim">
                    <v-show dado="{{sistema('tipoBoletim',$proc['doc_tipo'])}}"></v-show>
                </v-label>
                <v-label label="doc_numero" title="N° Boletim">
                    <v-show dado="{{$proc['doc_numero']}}"></v-show>
                </v-label>
                <v-label label="termo_exclusao" title="Termo exclusão">
                    <v-show dado="{{sistema('termo_exclusao',$proc['termo_exclusao'])}}"></v-show>
                </v-label>
                <v-label label="termo_exclusao_pub" title="Publicado no (Ex: BG 110/2010)">
                    <v-show dado="{{$proc['termo_exclusao_pub']}}"></v-show>
                </v-label>
                <v-label label="termo_captura" title="Termo Captura">
                    <v-show dado="{{sistema('termo_captura',$proc['termo_captura'])}}"></v-show>
                </v-label>
                <v-label label="termo_captura_pub" title="Publicado no (Ex: BG 110/2010)">
                    <v-show dado="{{$proc['termo_captura_pub']}}"></v-show>
                </v-label>
                <v-label label="pericia" title="Perícia">
                    <v-show dado="{{sistema('pericia',$proc['pericia'])}}"></v-show>
                </v-label>
                <v-label label="pericia_pub" title="Publicado no (Ex: BG 110/2010)">
                    <v-show dado="{{$proc['pericia_pub']}}"></v-show>
                </v-label>
                <v-label label="termo_inclusao" title="Termo Inclusão">
                    <v-show dado="{{sistema('termo_inclusao',$proc['termo_inclusao'])}}"></v-show>
                </v-label>
                <v-label label="termo_inclusao_pub" title="Publicado no (Ex: BG 110/2010)">
                    <v-show dado="{{$proc['termo_inclusao_pub']}}"></v-show>
                </v-label>
                <v-label label="referenciavajme" title="Referencia VAJME (Nº do processo, vara)">
                    <v-show dado="{{$proc['referenciavajme']}}"></v-show>
                </v-label>
            </div>
        </div>
    </div>

    </div>{{-- procedimento principal --}}
  
</section>
@stop

@section('css')
@stop

@section('js')
@include('vendor.adminlte.includes.vue')
@stop

