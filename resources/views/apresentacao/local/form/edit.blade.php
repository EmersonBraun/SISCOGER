@extends('adminlte::page')

@section('title', 'Local de apresentação - Editar')

@section('content_header')
<section class="content-header">   
  <h1>Local de apresentação - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('local.index')}}">Local de apresentação - Lista</a></li>
  <li class="active">Local de apresentação - Editar</li>
  </ol>
  <br>
</section>
@stop

@section('content')
<section>
    <div class="nav-tabs-custom">      
        <div class="tab-content">
            <v-tab-item title="{{ $proc['localdeapresentacao'] }} - Formulário principal" idp="principal" cls="active show">
                {!! Form::model($proc,['url' => route('local.update',$proc['id_localdeapresentacao']),'method' => 'put']) !!}
                <v-label label="localdeapresentacao" title="Nome do Local" error="{{ $errors->first('localdeapresentacao') }}">
                    {{ Form::text('localdeapresentacao', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="id_genero" title="Gênero gramatical" tooltip="para fins de geração de documentos">
                    {!! Form::select('id_genero',['1' => 'Masculino','2' => 'Feminino'],'2', ['class' => 'form-control','required']) !!}
                </v-label>
                <v-label label="uf" title="UF" tooltip="para fins de geração de documentos">
                    {!! Form::select('uf',['PR' => 'PR','BR' => 'Outros Estados'],'PR', ['class' => 'form-control','required']) !!}
                </v-label>
                <v-label label="id_municipio" title="Municipio">
                    <v-municipio id_municipio="{{$proc['id_municipio'] ?? ''}}"></v-municipio>
                </v-label>
                <v-label label="bairro" title="Bairro">
                    {{ Form::text('bairro', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="logradouro" title="Logradouro">
                    {{ Form::text('logradouro', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="numero" title="Número">
                    <the-mask mask="###############" name="numero" class="form-control"></the-mask>
                </v-label>
                <v-label label="complemento" title="Complemento">
                    {{ Form::text('complemento', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="cep" title="CEP">
                    <the-mask mask="##.###-###" name="cep" class="form-control"></the-mask>
                </v-label>
                <v-label label="telefone" title="Telefone">
                    {{ Form::text('telefone', null, ['class' => 'form-control ']) }}
                </v-label>
                {!! Form::submit('Editar Local de apresentação',['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}
            </v-tab-item>
        </div>
    </div>
</section>
@stop

@section('css')
@stop

@section('js')
@include('vendor.adminlte.includes.vue')
@stop

