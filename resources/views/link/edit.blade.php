@extends('adminlte::page')

@section('title', 'Link - Editar')

@section('content_header')
<section class="content-header">   
  <h1>Link - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('link.index')}}">Link - Lista</a></li>
  <li class="active">Link - Editar</li>
  </ol>
</section>

</v-select>
@stop

@section('content')
<section class="">
    <div class="tab-content">
        <v-tab-item title="Formulário principal" idp="principal" cls="active show">
            {!! Form::model($proc,['url' => route('link.update',$proc->id_link_uteis),'method' => 'put']) !!}
            {!! Form::open(['url' => route('link.store')]) !!}
            <v-label label="link" title="link" lg="6" md="6" tooltip="Endereço WEB, Ex: http://www.endereco.com.br/local" error="{{$errors->first('link')}}">
                {{ Form::text('link', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="nome" title="Nome" lg="6" md="6" tooltip="Nome que vai aparecer para ser clicado" error="{{$errors->first('nome')}}">
                {{ Form::text('nome', null, ['class' => 'form-control ']) }}
            </v-label>
            {!! Form::submit('Editar Link',['class' => 'btn btn-primary btn-block']) !!}
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

