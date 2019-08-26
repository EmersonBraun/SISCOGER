@extends('adminlte::page')

@section('title', 'Excluido - Criar')

@section('content_header')
<section class="content-header">   
  <h1>Excluido - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('excluido.conselho')}}">Excluido - Lista</a></li>
  <li class="active">Excluido - Criar</li>
  </ol>
</section>

</v-select>
@stop

@section('content')
<section class="">
    <div class="tab-content">
        <v-tab-item title="Formulário principal" idp="principal" cls="active show">
            {!! Form::open(['url' => route('excluido.store')]) !!}
            <v-label label="rg" title="RG" lg="4" md="4" error="{{$errors->first('rg')}}">
                {{ Form::text('rg', null, ['class' => 'form-control ','onchange' => 'completaDados(this,nome,cargo)','onkeyup' => 'completaDados(this,nome,cargo)']) }}
            </v-label>
            <v-label label="nome" title="Nome" lg="4" md="4" error="{{$errors->first('nome')}}">
                {{ Form::text('nome', null, ['class' => 'form-control ','id' => 'nome']) }}
            </v-label>
            <v-label label="cargo" title="Posto/Graduação" lg="4" md="4" error="{{$errors->first('cargo')}}">
                {{ Form::text('cargo', null, ['class' => 'form-control ','id' => 'cargo']) }}
            </v-label>
            <v-label label="exclusaoportaria_numero" title="Nº da portaria de exclusão" error="{{$errors->first('exclusaoportaria_numero')}}">
                {{ Form::text('exclusaoportaria_numero', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="exclusaoportaria_data" title="Data da portaria da exclusao" icon="fa fa-calendar">
                <v-datepicker name="exclusaoportaria_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['exclusaoportaria_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="exclusaoboletim" title="Publicado em Boletim">
                {!! Form::select('exclusaoboletim',['BG' => 'BG', 'BR' => 'BR'],null, ['class' => 'form-control ']) !!}
            </v-label>
            <v-label label="exclusaobg_numero" title="N° Boletim">
                {{ Form::text('exclusaobg_numero', null, ['class' => 'form-control ', 'id'=>'ref1','onblur' => "ajaxLigacao('1')", 'maxlength' => '4']) }}
            </v-label>
            <v-label label="exclusaobg_ano" title="Ano Boletim">
                {{ Form::text('exclusaobg_ano', null, ['class' => 'form-control ','id'=>'ano1','onblur' => "ajaxLigacao('1')", 'maxlength' => '4']) }}
            </v-label>
            <v-label label="exclusaobg_data" title="Data do BG" icon="fa fa-calendar">
                <v-datepicker name="exclusaobg_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['exclusaobg_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="exclusaoopm" title="OPM">
                <v-opm name='exclusaoopm' cdopm="{{$proc['exclusaoopm'] ?? ''}}"></v-opm>
            </v-label>
            {!! Form::submit('Inserir Exclusão',['class' => 'btn btn-primary btn-block']) !!}
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

