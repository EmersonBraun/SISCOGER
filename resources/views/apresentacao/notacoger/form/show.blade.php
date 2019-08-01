@extends('adminlte::page')

@section('title', 'Nota COGER - Ver')

@section('content_header')
<section class="content-header">   
  <h1>Nota COGER - Ver</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('notacoger.index')}}">Nota COGER - Lista</a></li>
  <li class="active">Nota COGER - Ver</li>
  </ol>
</section>

</v-select>
@stop

@section('content')
<section class="">
    <div class="tab-content">
        <v-tab-item title="Nota COGER" idp="principal" cls="active show">
            <v-label label="sjd_ref" title="Referência">
                <v-show dado="{{$proc['sjd_ref']}}"></v-show> 
            </v-label>
            <v-label label="sjd_ref_ano" title="Ano">
                <v-show dado="{{$proc['sjd_ref_ano']}}"></v-show> 
            </v-label>
            <v-label label="status" title="Estatus">
                <v-show dado="{{$proc['status']}}"></v-show> 
            </v-label>
            <v-label label="expedicao_data" title="Data" icon="fa fa-calendar" error="{{$errors->first('expedicao_data')}}">
                <v-show dado="{{$proc['expedicao_data']}}"></v-show>
            </v-label>
            <v-label label="id_tiponotacomparecimento" title="Andamento COGER" >
                <v-show dado="{{sistema('tipoNotaComparecimento',$proc['id_tiponotacomparecimento'])}}"></v-show>
            </v-label>
            <file-upload 
                        title="Arquivo PDF:"
                        name="nota_file"
                        proc="adl"
                        idp="{{$proc['id_notacoger']}}"
                        :ext="['pdf']" 
                        :candelete="{{session('is_admin')}}"
                        ></file-upload>
            <v-label label="sintese_txt" title="Sintese" lg="12" md="12" error="{{$errors->first('sintese_txt')}}">
                <v-show dado="{{$proc['sintese_txt']}}"></v-show>
            </v-label>            
        </v-tab-item>
    </div>
</section>
@stop

@section('css')
@stop

@section('js')
@include('vendor.adminlte.includes.vue')
@stop
                