@extends('adminlte::page')

@section('title', 'APFD - Editar')

@section('content_header')
<section class="content-header">   
  <h1>APFD - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('apfd.lista')}}">APFD - Lista</a></li>
  <li class="active">APFD - Editar</li>
  </ol>
  <br>
</section>
  
@stop

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
<section>
    <div class="nav-tabs-custom">
        <v-tab-menu
        :itens="[
            {idp: 'principal',name: 'Principal', cls: 'active'},
            {idp: 'envolvidos',name: 'Envolvidos'},
            {idp: 'membros',name: 'Membros'},
            {idp: 'movimentos',name: 'Movimentos'},
            {idp: 'encaminhamentos',name: 'Encaminhamentos'},
            {idp: 'arquivo',name: 'Arquivo'},

        ]">

        </v-tab-menu>
       
        <div class="tab-content">
            <v-tab-item title="N° {{ $proc['sjd_ref'] }} / {{ $proc['sjd_ref_ano'] }} - Formulário principal" idp="principal" cls="active show">
                {!! Form::model($proc,['url' => route('apfd.update',$proc['id_apfd']),'method' => 'put']) !!}
                <v-prioritario prioridade="{{$proc['prioridade'] ?? ''}}"></v-prioritario>
                <v-label label="cdopm" title="OPM" error="{{$errors->first('cdopm')}}">
                    <v-opm cdopm="{{$proc['cdopm']}}"></v-opm>
                </v-label>
                <v-label label="id_andamentocoger" title="Andamento COGER">
                    {!! Form::select('id_andamentocoger',config('sistema.andamentocogerAPFD'),null, ['class' => 'form-control ']) !!}
                </v-label>
                <v-label label="tipo" title="Tipo" error="{{$errors->first('tipo')}}">
                    {!! Form::select('tipo', ['Crime comum','Crime militar'],null, ['class' => 'form-control select2']) !!}
                </v-label>
                <v-label label="fato_data" title="Data do fato">
                    <v-datepicker name="fato_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['fato_data'] ?? ''}}"></v-datepicker>
                </v-label>
                <v-label label="sintese_txt" title="Síntese do fato (Quem, quando, onde, como e por quê): " lg="12" md="12" error="{{$errors->first('sintese_txt')}}">
                    {!! Form::textarea('sintese_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
                </v-label>
                <v-label label="tipo_penal_novo" title="Tipos penais (Do mais grave ao menos grave): ">
                    {!! Form::select('tipo_penal_novo', config('sistema.tipo_penal_novo'),null, ['class' => 'form-control select2']) !!}
                </v-label>
                <v-label label="especificar" title="Especificar (Caso tipo penal OUTROS): ">
                    {{ Form::text('especificar', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="doc_tipo" title="Documento da publicação: ">
                    {!! Form::select('doc_tipo',['BI','BG','BR'],null, ['class' => 'form-control ', 'id' => 'descricao']) !!}
                </v-label>
                <v-label label="doc_tipo" title="N° Documento da publicação: ">
                    {{ Form::text('doc_tipo', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="referenciavajme" title="Referencia da VAJME (Nº do processo e vara)" >
                    {{ Form::text('referenciavajme', null, ['class' => 'form-control ']) }}
                </v-label>
                {!! Form::submit('Alterar APFD',['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}
            </v-tab-item>
            <v-tab-item title="Envolvidos" idp="envolvidos">      
                <v-acusado dproc="apfd" idp="{{$proc['id_apfd']}}" situacao="{{sistema('procSituacao','apfd')}}" ></v-acusado><br>
                <v-vitima dproc="apfd" idp="{{$proc['id_apfd']}}" ></v-vitima><br>
            </v-tab-item>
            <v-tab-item title="Membros" idp="membros">
                <v-membro dproc="apfd" idp="{{$proc['id_apfd']}}"></v-membro>
            </v-tab-item>
            <v-tab-item title="Movimentos" idp="movimentos">
                <v-movimento dproc="apfd" idp="{{$proc['id_apfd']}}" opm="{{session('opm_descricao')}}" rg="{{session('rg')}}" :admin="{{session('is_admin')}}"></v-movimento>
            </v-tab-item>
            <v-tab-item title="Encaminhamentos" idp="encaminhamentos">
                Encaminhamentos
            </v-tab-item>
            <v-tab-item title="Arquivo" idp="arquivo">
                <v-arquivo dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}" dproc="apfd" idp="{{$proc['id_apfd']}}" ></v-arquivo>
            </v-tab-item>
        </div>
    </div>

    <div class="content-footer">
        <br>
        
    </div>

</section>
@stop

@section('css')
@stop

@section('js')
@include('vendor.adminlte.includes.vue')
@stop

