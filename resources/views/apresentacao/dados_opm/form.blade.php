@extends('adminlte::page')

@section('title', 'Dados Unidades')

@section('content_header')
<section class="content-header">   
  <h1>Dados Unidades</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Dados Unidades</li>
  </ol>
</section>

</v-select>
@stop

@section('content')

<section class="">
    <div class="tab-content">
       <v-dados-opm></v-dados-opm>
    </div>
</section>
@stop

@section('css')
@stop

@section('js')
@include('vendor.adminlte.includes.vue')
@stop

