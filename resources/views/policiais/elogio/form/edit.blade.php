@extends('adminlte::page')

@section('title', 'Elogio - Editar')

@section('content_header')
<section class="content-header">   
  <h1>Elogio - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('elogio.index')}}">Elogio - Lista</a></li>
  <li class="active">Elogio - Editar</li>
  </ol>
</section>

</v-select>
@stop

@section('content')
<section class="">
    <div class="tab-content">
        <v-tab-item title="Formulário principal" idp="principal" cls="active show">
            {!! Form::model($proc,['url' => route('elogio.update',$proc['id_elogio']),'method' => 'put']) !!}
            <input type=hidden name=rg_cadastro value="{{session('rg')}}">
            <input type=hidden name=opm_abreviatura value="{{session('opm_abreviatura')}}">
            <input type=hidden name=digitador value="{{session('nome')}}">
            <v-label label="rg" title="RG" lg="4" md="4" error="{{$errors->first('rg')}}">
                {{ Form::text('rg', null, ['class' => 'form-control ','onchange' => 'completaDados(this,nome,cargo)','onkeyup' => 'completaDados(this,nome,cargo)']) }}
            </v-label>
            <v-label label="nome" title="Nome" lg="4" md="4" error="{{$errors->first('nome')}}">
                {{ Form::text('nome', null, ['class' => 'form-control ','readonly','id' => 'nome']) }}
            </v-label>
            <v-label label="cargo" title="Posto/Graduação" lg="4" md="4" error="{{$errors->first('cargo')}}">
                {{ Form::text('cargo', null, ['class' => 'form-control ','readonly','id' => 'cargo']) }}
            </v-label>
            <v-label label="cdopm" title="OPM">
                <v-opm name='cdopm' cdopm="{{$proc['cdopm'] ?? ''}}"></v-opm>
            </v-label>
            <v-label label="elogio_data" title="Data da publicação" icon="fa fa-calendar">
                <v-datepicker name="elogio_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['elogio_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="publicacao" title="Publicação N°" tooltip="Ex: BI N° 100/2014" error="{{$errors->first('publicacao')}}">
                {{ Form::text('publicacao', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="descricao_txt" lg="12" md="12" title="Descrição"  error="{{$errors->first('descricao_txt')}}">
                {!! Form::textarea('descricao_txt',null,['class' => 'form-control ', 'rows' => '15', 'cols' => '50']) !!}
            </v-label>

            {!! Form::submit('Editar Elogio',['class' => 'btn btn-primary btn-block']) !!}
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

