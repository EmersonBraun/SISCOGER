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
<div class=''>
    <h4 style="padding-left: 3%"><b>Buscar por:</b></h4>
    {{ Form::open(array('route' => array('busca.fdi'))) }}
    <div class="col-md-12 form-group">
        <div class="col-md-6 form-group @if ($errors->has('rg')) has-error @endif">
            {!! Form::label('rg', 'RG') !!}
            {!! Form::text('rg', '', array('class' => 'form-control numero','placeholder' => 'Busca por rg' , 'onblur' => 'completaCampos($(this).val(),array(nome),array(NOME)' )) !!}
            @if ($errors->has('rg'))
                <span class="help-block">
                    <strong>{{ $errors->first('rg') }}</strong>
                </span>
            @endif
        </div>
    
        <div class="col-md-6 form-group">
            {!! Form::label('nome', 'Nome') !!}
            {!! Form::text('nome', null, array('class' => 'form-control typeahead','placeholder' => 'Busca por nome', 'onfocusout' => 'completarg($(this).val())')) !!}
            @if ($errors->has('nome'))
                <span class="help-block">
                    <strong>{{ $errors->first('nome') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-md-12 form-group">
            {!! Form::submit('Ver', array('class' => 'btn btn-primary btn-block')) !!}
        </div>
    </div>

    {!! Form::close() !!}
    <div id="tabela">

    </div>
</div>
@stop

@section('css')
@stop

@section('js')
    @include('vendor.adminlte.includes.nome_rg')
@stop