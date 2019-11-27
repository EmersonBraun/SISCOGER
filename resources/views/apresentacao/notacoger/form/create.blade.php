@extends('adminlte::page')

@section('title', 'Nota COGER - Criar')

@section('content_header')
<section class="content-header">   
  <h1>Nota COGER - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('notacoger.index')}}">Nota COGER - Lista</a></li>
  <li class="active">Nota COGER - Criar</li>
  </ol>
</section>

@stop

@section('content')
<section class="">
    <div class="tab-content">
        <v-tab-item title="Formulário principal" idp="principal" cls="active show">
            {!! Form::open(['url' => route('notacoger.store')]) !!}
            <v-label label="status" title="Estatus" error="{{$errors->first('status')}}">
                {!! Form::select('status',['pendente' => 'Pendente','publicada' => 'Publicada'],null, ['class' => 'form-control','required']) !!}
            </v-label>
            <v-label label="expedicao_data" title="Data" icon="fa fa-calendar" error="{{$errors->first('expedicao_data')}}">
                <v-datepicker name="expedicao_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['expedicao_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="id_tiponotacomparecimento" title="Andamento COGER" error="{{$errors->first('id_tiponotacomparecimento')}}">
                {!! Form::select('id_tiponotacomparecimento',config('sistema.tipoNotaComparecimento'),null, ['class' => 'form-control','required']) !!}
            </v-label>
            <v-label label="nota_file" title="Arquivo PDF" error="{{$errors->first('nota_file')}}">
                <h5>Ficará disponível após inserção</h5>
            </v-label>
            <v-label label="observacao_txt" title="Sintese" lg="12" md="12" error="{{$errors->first('observacao_txt')}}">
                {!! Form::textarea('observacao_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
            </v-label> 
            <v-label label="autoridade_rg" title="RG" lg="3" md="3" error="{{$errors->first('autoridade_rg')}}">
                {{ Form::text('autoridade_rg', null, ['class' => 'form-control ','onchange' => 'completaDados(this,nome,cargo,quadro)','onkeyup' => 'completaDados(this,nome,cargo)']) }}
            </v-label>
            <v-label label="autoridade_nome" title="Nome" lg="3" md="3" error="{{$errors->first('autoridade_nome')}}">
                {{ Form::text('autoridade_nome', null, ['class' => 'form-control ','readonly','id' => 'nome']) }}
            </v-label>
            <v-label label="autoridade_cargo" title="Posto/Graduação" lg="2" md="2" error="{{$errors->first('autoridade_cargo')}}">
                {{ Form::text('autoridade_cargo', null, ['class' => 'form-control ','readonly','id' => 'cargo']) }}
            </v-label>    
            <v-label label="autoridade_quadro" title="Quadro" lg="2" md="2" error="{{$errors->first('autoridade_quadro')}}">
                {{ Form::text('autoridade_quadro', null, ['class' => 'form-control ','readonly','id' => 'quadro']) }}
            </v-label> 
            <v-label label="autoridade_funcao" title="Função" lg="2" md="2" error="{{$errors->first('autoridade_funcao')}}">
                {{ Form::text('autoridade_funcao', 'Corregedor-Geral', ['class' => 'form-control ','readonly','id' => 'funcao']) }}
            </v-label>      
            {!! Form::submit('Inserir Nota COGER',['class' => 'btn btn-primary btn-block']) !!}
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

