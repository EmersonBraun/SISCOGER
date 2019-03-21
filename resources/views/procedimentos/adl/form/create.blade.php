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

</v-select>
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
            {!! Form::label('prioridade', 'Processo prioritário') !!}
            {!! Form::checkbox('prioridade', '1') !!}
            </div>

            

            @component('components.form.select',
            ['titulo' => 'Andamento','campo' => 'id_andamento', 'opt' => config('sistema.andamentoADL')])
            @endcomponent

            @component('components.form.select',
            ['titulo' => 'Andamento COGER','campo' => 'andamentocoger', 'opt' => config('sistema.andamentocogerADL'), 'class' => 'select2'])
            @endcomponent


            {{-- linha --}}
            <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
            {!! Form::label('id_motivoconselho', 'Motivo ADL (Lei nº 16.544/2010)')!!} <a href="https://goo.gl/L1m5Ps" target="_blank"><i class="fa fa-link text-info"></i></a><br>
            {!! Form::select('id_motivoconselho', config('sistema.motivoConselho'),'', ['class' => 'form-control select2', 'id' => 'descricao']) !!}
            @if ($errors->has('id_motivoconselho'))
                <span class="help-block">
                    <strong>{{ $errors->first('id_motivoconselho') }}</strong>
                </span>
            @endif
            </div>

            @component('components.form.text',['titulo' => 'Especificar (no caso de outros motivos)','campo' => 'outromotivo'])
            @endcomponent

            @component('components.form.select',
            ['titulo' => 'Situação','campo' => 'id_situacaoconselho', 'opt' => config('sistema.situacaoConselho'), 'id' => 'descricao'])
            @endcomponent

            @component('components.form.text',['titulo' => 'N° Portaria','campo' => 'portaria_numero'])
            @endcomponent
            
            @component('components.form.date',['titulo' => 'Data da portaria','campo' => 'portaria_data'])
            @endcomponent

            @component('components.form.select',
            ['titulo' => 'Tipo de boletim','campo' => 'doc_tipo', 'opt' => config('sistema.tipoBoletim')])
            @endcomponent

            @component('components.form.text',['titulo' => 'N° Boletim','campo' => 'doc_numero'])
            @endcomponent

            <v-datepicker title="Dato do fato" name="fato_data"></v-datepicker>

            @component('components.form.date',['titulo' => 'Data da fato','campo' => 'fato_data'])
            @endcomponent

            @component('components.form.date',['titulo' => 'Data da abertura','campo' => 'abertura_data'])
            @endcomponent

            @component('components.form.date',['titulo' => 'Data da prescricao','campo' => 'prescricao_data'])
            @endcomponent

            @component('components.form.sintese_txt')
            @endcomponent

            {{-- linha --}}
            
            <br>
            
            @component('components.subform',
            [
                'title' => 'Procedimento(s) de Origem (apenas se houver)',
                'btn' => 'Adicionar documento de origem',
                'arquivo' => 'ligacao',
                'relacao' => NULL,
                'proc' => 'adl',
                'unico' => false
            ])    
            @endcomponent
            

            @component('components.subform',
            [
                'title' => 'Acusado',
                'btn' => 'Adicionar acusado',
                'arquivo' => 'envolvido',
                'relacao' => NULL,
                'proc' => 'adl',
                'unico' => false
            ])    
            @endcomponent

            @component('components.subform',
            [
                'title' => 'Vítima (apenas se houver)',
                'btn' => 'Adicionar vítima',
                'arquivo' => 'ofendido',
                'relacao' => NULL,
                'proc' => 'adl',
                'unico' => false
            ])    
            @endcomponent

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
  {{-- @include('vendor.adminlte.includes.pickers') --}}
  {{-- @include('vendor.adminlte.includes.select2') --}}
{{-- <script>
    $(document).ready(function(){
        addObjectForm('envolvido','adl');
    });

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
</script> --}}
@include('vendor.adminlte.includes.vue')
@stop

