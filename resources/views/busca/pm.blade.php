@extends('adminlte::page')

@section('title_postfix', '| Busca PM/BM')

@section('content_header')
<section class="content-header">
    <h1><i class='fa fa-user'></i> Busca PM/BM</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item active"><a href="#">Busca PM/BM</a></li>
    </ol>
</section>
@stop

@section('content')
    <div class="box">
        <div class="box-body">
            <vue-simple-suggest mode="select"></vue-simple-suggest> 
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@include('vendor.adminlte.includes.vue')
@stop