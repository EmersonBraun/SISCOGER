@extends('adminlte::page')

@section('title', 'apresentacao')

@section('content_header')
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Gerar Memorando de Apresentação</h3>
            </div>
            <div class="box-body">
                <v-memorando :idp="{{$id}}"></v-memorando>
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
@stop

@section('js')
@include('vendor.adminlte.includes.vue')
@stop