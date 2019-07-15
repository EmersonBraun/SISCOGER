@extends('adminlte::page')

@section('title', 'Deserção - Editar')

@section('content_header')
<section class="content-header">   
  <h1>Deserção - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('desercao.lista')}}">Deserção - Lista</a></li>
  <li class="active">Deserção - Editar</li>
  </ol>
  <br>
</section>
@stop

@section('content')
<div class="">
<section>
    <div class="nav-tabs-custom">
        <v-tab-menu
        :itens="[
            {idp: 'principal',name: 'Principal', cls: 'active'},
            {idp: 'reus',name: 'Réus'},
            {idp: 'movimentos',name: 'Movimentos'},
            {idp: 'encaminhamentos',name: 'Encaminhamentos'},
            {idp: 'arquivo',name: 'Arquivo'},
        ]">
        </v-tab-menu>
        <div class="tab-content">
            <v-tab-item title="N° {{ $proc['sjd_ref'] }} / {{ $proc['sjd_ref_ano'] }} - Formulário principal" idp="principal" cls="active show">
                {!! Form::model($proc,['url' => route('desercao.update',$proc['id_desercao']),'method' => 'put']) !!}
                    <v-prioritario admin="session('is_admin')" prioridade="{{$proc['prioridade']}}"></v-prioritario>
                    <v-acusado-unico idp="{{$proc['id_desercao']}}" situacao="{{sistema('procSituacao','desercao')}}" ></v-acusado-unico><br>
                    <v-label label="cdopm" title="OPM">
                        <v-opm cdopm="{{$proc['cdopm']}}"></v-opm>
                    </v-label>
                    <v-label label="id_andamentocoger" title="Andamento COGER" error="{{$errors->first('id_andamentocoger')}}">
                        {!! Form::select('id_andamentocoger',config('sistema.andamentocogerADL'),null, ['class' => 'form-control ']) !!}
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
                {!! Form::submit('Alterar Desercao',['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}
            </v-tab-item>
            <v-tab-item title="Réus" idp="reus">
                Reus
            </v-tab-item>
            <v-tab-item title="Movimentos" idp="movimentos">
                <v-movimento idp="{{$proc['id_desercao']}}" opm="{{session('opm_descricao')}}" rg="{{session('rg')}}" :admin="{{session('is_admin')}}"></v-movimento>
            </v-tab-item>
            <v-tab-item title="Encaminhamentos" idp="encaminhamentos">
                Encaminhamentos
            </v-tab-item>
            <v-tab-item title="Arquivo" idp="arquivo">
                <v-arquivo idp="{{$proc['id_desercao']}}" ></v-arquivo>
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

