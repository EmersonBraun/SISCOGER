@extends('adminlte::page')

@section('title', 'Apresentação - Editar')

@section('content_header')
<section class="content-header">   
  <h1>Apresentação - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('apresentacao.index')}}">Apresentação - Lista</a></li>
  <li class="active">Apresentação - Editar</li>
  </ol>
</section>

</v-select>
@stop

@section('content')
<section class="">
    <div class="tab-content">
        <v-tab-item title="Formulário principal" idp="principal" cls="active show">
            <v-form-apresentacao :reference="{{$ref ?? null}}" :ano="{{$ano ?? 0}}"></v-form-apresentacao>
        </v-tab-item>
    </div>
</section>
@stop

@section('css')
@stop

@section('js')
@include('vendor.adminlte.includes.vue')
@stop