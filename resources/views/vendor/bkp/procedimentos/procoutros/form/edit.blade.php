@extends('adminlte::page')

@section('title', 'fatd - Editar')

@section('content_header')
<section class="content-header">   
  <h1>FATD - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('fatd.lista',['ano' => date('Y')])}}">Fatd - Lista</a></li>
  <li class="active">FATD - Editar</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
    <div class='btn-group col-md-8 col-xs-12 ' style='padding-left: 0px'>
      <a class="btn btn-success col-md-3 col-xs-4 "  href="#">Editar</a>
    <a class="btn btn-default col-md-3 col-xs-4 "  href="{{route('fatd.movimentos',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])}}">Movimentos</a>
      <a class="btn btn-default col-md-3 col-xs-4 "  href="{{route('fatd.sobrestamentos',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])}}">Sobrestamentos</a>   
    </div>
  <div>
</section>
  
@stop

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
<section class="">
    <div class="row">

        <div class="col-xs-12">

        <div class="box">{{-- formulário principal --}}
            <div class="box-header">
                {{-- sjd_ref / sjd_ref_ano --}}
                <h4 class="box-title">N° {{ $proc['sjd_ref'] }} / {{ $proc['sjd_ref_ano'] }} - Formulário principal</h4>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-plus"></i>
                    </button> 
                </div>             
            </div>

            <div class="box-body">

            {!! Form::model($proc,['url' => route('fatd.update',['id' => $proc['id_fatd']]),'method' => 'put', 'files' => true]) !!}
            <div class='col-md-12 col-xs-12'>
            {!! Form::label('prioritario', 'Processo prioritário') !!}
            {!! Form::checkbox('prioritario', '1') !!}
            </div>

            {{-- linha --}}
            <div class='col-md-6 col-xs-12'>
            {!! Form::label('andamento', 'Andamento')!!} <br>
            {!! Form::select('id_andamento', config('sistema.andamentoFATD')) !!}
            @if ($errors->has('andamento'))
                <span class="help-block">
                    <strong>{{ $errors->first('andamento') }}</strong>
                </span>
            @endif
            </div>

            <div class='col-md-6 col-xs-12'>
            {!! Form::label('andamentocoger', 'Andamento COGER')!!} <br>
            {!! Form::select('id_andamentocoger', config('sistema.andamentocogerFATD')) !!}
            @if ($errors->has('andamentocoger'))
                <span class="help-block">
                    <strong>{{ $errors->first('andamentocoger') }}</strong>
                </span>
            @endif
            </div>

            {{-- linha --}}
            <div class='col-md-4 col-xs-12'>
            {!! Form::label('doc_origem_txt', 'Documentos de origem: ')!!} <br>
            {!! Form::text('doc_origem_txt',$proc['doc_origem_txt']) !!}
            </div>

            <div class='col-md-4 col-xs-12'>
            <i class="fa fa-calendar"></i> {!! Form::label('fato_data', 'Data do fato: ')!!} <br>
            {!! Form::text('fato_data',data_br($proc['fato_data']) ,['class' => 'datepicker']) !!}              
            </div>

            <div class='col-md-4 col-xs-12'>
            {!! Form::label('cdopm', 'OPM')!!} <br>
            {!! Form::text('cdopm',opm($proc['cdopm'])) !!}
            </div>

            {{-- linha --}}
            @if($proc['motivo_outros'])
                <div class='col-md-8 col-xs-12'>
                {!! Form::label('motivo_fatd', 'Motivo FATD')!!} <br>
                {!! Form::select('motivo_fatd',config('sistema.motivoFATD'),'', ['class' => 'select2', 'id' => 'descricao']) !!}
                </div>

                <div class='col-md-4 col-xs-12' class='descricao_outros'>
                {!! Form::label('motivo_outros', 'Motivo Outros' )!!} <br>
                {!! Form::text('motivo_outros',$proc['motivo_outros']) !!}
                </div>
            @else
                    <div class='col-md-12 col-xs-12'>
                    {!! Form::label('motivo_fatd', 'Motivo FATD')!!} <br>
                    {!! Form::select('motivo_fatd',config('sistema.motivoFATD'),'', ['class' => 'select2', 'id' => 'descricao']) !!}
                    </div>
            @endif

            {{-- linha --}}
            <div class='col-md-4 col-xs-12'>
            {!! Form::label('situacao_fatd', 'Situação')!!} <br>
            {!! Form::select('situacao_fatd', config('sistema.situacaoOCOR')) !!}
            </div>

            <div class='col-md-4 col-xs-12'>
            {!! Form::label('doc_tipo', 'Tipo de boletim')!!} <br>
            {!! Form::select('doc_tipo', config('sistema.tipoBoletim')) !!}
            </div>

            <div class='col-md-4 col-xs-12'>
            {!! Form::label('doc_numero', 'N° Boletim')!!} <br>
            {!! Form::text('doc_numero') !!}
            </div>

            {{-- linha --}}
            <div class='col-md-12 col-xs-12'>
            {!! Form::label('sintese_txt', 'Síntese do fato')!!} <br>
            {!! Form::textarea('sintese_txt',$proc['sintese_txt'],['class' => 'form-control', 'rows' => '5']) !!}
            </div>

            {{-- linha --}}
            <div class='col-md-4 col-xs-12'>
            <small>{!! Form::label('despacho_numero', 'Nº do despacho que designa o Encarregado : ')!!}</small> <br>
            {!! Form::text('despacho_numero',$proc['despacho_numero'],['class' => 'despacho','placeholder' => '12345/2000'] ) !!}
            </div>

            <div class='col-md-4 col-xs-12'>
            <i class="fa fa-calendar"></i> {!! Form::label('portaria_data', 'Data do despacho: ')!!} <br>
            {!! Form::text('portaria_data',data_br($proc['portaria_data']) ,['class' => 'datepicker']) !!} 
            </div>

            <div class='col-md-4 col-xs-12'>
            <i class="fa fa-calendar"></i> {!! Form::label('abertura_data', 'Data do despacho: ')!!} <br>
            {!! Form::text('abertura_data',data_br($proc['abertura_data']) ,['class' => 'datepicker']) !!} 
            </div>

            </div>
        </div>
    </div>{{-- procedimento principal --}}

</div>

@include('vendor.procedimentos.fatd.documentos')

@include('vendor.procedimentos.fatd.recursos')

@include('vendor.procedimentos.fatd.membros')

@include('vendor.procedimentos.fatd.acusado')

<div class="content-footer">
    <br>
    {!! Form::submit('Alterar FATD',['class' => 'btn btn-primary btn-block']) !!}
    {!! Form::close() !!}
</div>


</section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
  @include('vendor.adminlte.includes.pickers')
  @include('vendor.adminlte.includes.select2')
<script>

    $("#descricao").on('load, change',function ()
    {
        var campo = $("#descricao").val();
        console.log(campo);
        if (campo == 'Outro') 
        {
            $(".descricao_outros").show();
        }
        else
        {
            $(".descricao_outros").hide();
        }
    });

</script>
@stop

