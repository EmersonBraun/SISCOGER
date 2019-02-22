@extends('adminlte::page')

@section('title', 'adl - Criar')

@section('content_header')
<section class="content-header">   
  <h1>ADL - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('adl.lista')}}">ADL - Lista</a></li>
  <li class="active">ADL - Criar</li>
  </ol>
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
                <h4 class="box-title">N° * / {{date('Y')}} - Formulário principal</h4>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-plus"></i>
                    </button> 
                </div>             
            </div>

            <div class="box-body">

            {!! Form::open(['url' => route('adl.store')]) !!}
            <div class='col-md-12 col-xs-12'>
            {!! Form::label('prioritario', 'Processo prioritário') !!}
            {!! Form::checkbox('prioritario', '1') !!}
            </div>

            {{-- linha --}}
            <div class='col-md-6 col-xs-12'>
            {!! Form::label('id_andamento', 'Andamento')!!} <br>
            {!! Form::select('id_andamento', config('sistema.andamentoADL')) !!}
            @if ($errors->has('id_andamento'))
                <span class="help-block">
                    <strong>{{ $errors->first('id_andamento') }}</strong>
                </span>
            @endif
            </div>

            <div class='col-md-6 col-xs-12'>
            {!! Form::label('andamentocoger', 'Andamento COGER')!!} <br>
            {!! Form::select('id_andamentocoger', config('sistema.andamentocogerADL')) !!}
            @if ($errors->has('id_andamentocoger'))
                <span class="help-block">
                    <strong>{{ $errors->first('id_andamentocoger') }}</strong>
                </span>
            @endif
            </div>

            {{-- linha --}}
            <div class='col-md-6 col-xs-12'>
            {!! Form::label('id_motivoconselho', 'Motivo ADL')!!} <br>
            {!! Form::select('id_motivoconselho', config('sistema.motivoConselho'),'', ['class' => 'select2', 'id' => 'descricao']) !!}
            @if ($errors->has('id_motivoconselho'))
                <span class="help-block">
                    <strong>{{ $errors->first('id_motivoconselho') }}</strong>
                </span>
            @endif
            </div>

            <div class='col-md-6 col-xs-12'>
            {!! Form::label('outromotivo', 'Especificar (no caso de outros motivos)')!!} <br>
            {!! Form::text('outromotivo', '') !!}
            @if ($errors->has('outromotivo'))
                <span class="help-block">
                    <strong>{{ $errors->first('outromotivo') }}</strong>
                </span>
            @endif
            </div>

            {{-- linha --}}
            <div class='col-md-6 col-xs-12'>
            {!! Form::label('id_situacaoconselho', 'Situação')!!} <br>
            {!! Form::select('id_situacaoconselho', config('sistema.situacaoConselho'),'', ['class' => 'select2', 'id' => 'descricao']) !!}
            @if ($errors->has('id_situacaoconselho'))
                <span class="help-block">
                    <strong>{{ $errors->first('id_situacaoconselho') }}</strong>
                </span>
            @endif
            </div>
            
            <div class='col-md-6 col-xs-12'>
            {!! Form::label('id_decorrenciaconselho', 'Em decorrência de')!!} <br>
            {!! Form::select('id_decorrenciaconselho', config('sistema.decorrenciaConselho')) !!}
            @if ($errors->has('id_decorrenciaconselho'))
                <span class="help-block">
                    <strong>{{ $errors->first('id_decorrenciaconselho') }}</strong>
                </span>
            @endif
            </div>
            {{-- linha --}}
            <div class='col-md-3 col-xs-12'>
            {!! Form::label('portaria_numero', 'N° Portaria')!!} <br>
            {!! Form::text('portaria_numero', '') !!}
            @if ($errors->has('portaria_numero'))
                <span class="help-block">
                    <strong>{{ $errors->first('portaria_numero') }}</strong>
                </span>
            @endif
            </div>

            <div class='col-md-3 col-xs-12'>
            <i class="fa fa-calendar"></i> {!! Form::label('portaria_data', 'Data da portaria: ')!!} <br>
            {!! Form::text('portaria_data','' ,['class' => 'datepicker']) !!}
            @if ($errors->has('portaria_data'))
                <span class="help-block">
                    <strong>{{ $errors->first('portaria_data') }}</strong>
                </span>
            @endif              
            </div>

            <div class='col-md-3 col-xs-12'>
            {!! Form::label('doc_tipo', 'Tipo de boletim')!!} <br>
            {!! Form::select('doc_tipo', config('sistema.tipoBoletim')) !!}
            @if ($errors->has('doc_tipo'))
                <span class="help-block">
                    <strong>{{ $errors->first('doc_tipo') }}</strong>
                </span>
            @endif
            </div>

            <div class='col-md-3 col-xs-12'>
            {!! Form::label('doc_numero', 'N° Boletim')!!} <br>
            {!! Form::text('doc_numero', '') !!}
            @if ($errors->has('doc_numero'))
                <span class="help-block">
                    <strong>{{ $errors->first('doc_numero') }}</strong>
                </span>
            @endif
            </div>

            {{-- linha --}}
            <div class='col-md-4 col-xs-12'>
            <i class="fa fa-calendar"></i> {!! Form::label('fato_data', 'Data da fato: ')!!} <br>
            {!! Form::text('fato_data','' ,['class' => 'datepicker']) !!}
            @if ($errors->has('fato_data'))
                <span class="help-block">
                    <strong>{{ $errors->first('fato_data') }}</strong>
                </span>
            @endif              
            </div>

            <div class='col-md-4 col-xs-12'>
            <i class="fa fa-calendar"></i> {!! Form::label('abertura_data', 'Data da abertura: ')!!} <br>
            {!! Form::text('abertura_data','' ,['class' => 'datepicker']) !!}
            @if ($errors->has('abertura_data'))
                <span class="help-block">
                    <strong>{{ $errors->first('abertura_data') }}</strong>
                </span>
            @endif              
            </div>

            <div class='col-md-4 col-xs-12'>
            <i class="fa fa-calendar"></i> {!! Form::label('prescricao_data', 'Data da prescricao: ')!!} <br>
            {!! Form::text('prescricao_data','' ,['class' => 'datepicker']) !!}
            @if ($errors->has('prescricao_data'))
                <span class="help-block">
                    <strong>{{ $errors->first('prescricao_data') }}</strong>
                </span>
            @endif              
            </div>

            {{-- linha --}}
            <div class='col-md-12 col-xs-12'>
            {!! Form::label('sintese_txt', 'Síntese do fato')!!} <br>
            {!! Form::textarea('sintese_txt','',['class' => 'form-control', 'rows' => '5']) !!}
            @if ($errors->has('sintese_txt'))
                <span class="help-block">
                    <strong>{{ $errors->first('sintese_txt') }}</strong>
                </span>
            @endif
            </div>

            <div class='col-md-12 col-xs-12'>
            <br>
            {!! Form::submit('Inserir adl',['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
            </div>
        </div>
    </div>

    </div>{{-- procedimento principal --}}
  
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

