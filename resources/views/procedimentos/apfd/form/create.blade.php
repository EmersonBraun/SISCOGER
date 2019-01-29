@extends('adminlte::page')

@section('title', 'apfd - Criar')

@section('content_header')
<section class="content-header">   
  <h1>APFD - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('apfd.lista')}}">APFD - Lista</a></li>
  <li class="active">APFD - Criar</li>
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

            {!! Form::open(['url' => route('apfd.store')]) !!}
            <div class='col-md-12 col-xs-12'>
            {!! Form::label('prioridade', 'Processo prioritário') !!}
            {!! Form::checkbox('prioridade', '1') !!}
            </div>

            @component('components.form.select',
            ['titulo' => 'Andamento','campo' => 'id_andamento', 'opt' => config('sistema.andamentoAPFD')])
            @endcomponent

            @component('components.form.select',
            ['titulo' => 'Andamento COGER','campo' => 'andamentocoger', 'opt' => config('sistema.andamentocogerAPFD'), 'class' => 'select2'])
            @endcomponent

            @component('components.form.opm',
            ['titulo' => 'OPM/OBM','campo' => 'cdopm', 'opms' => $opms])
            @endcomponent

            @component('components.form.select',
            ['titulo' => 'Tipo','campo' => 'tipo', 'opt' => ['Crime comum','Crime militar']])
            @endcomponent

            @component('components.form.date',['titulo' => 'Data do fato','campo' => 'fato_data'])
            @endcomponent

            @component('components.form.tipo_penal',
            ['titulo' => 'Tipos penais (Do mais grave ao menos grave)','campo' => 'tipo_penal_novo'])
            @endcomponent

            @component('components.form.text',['titulo' => 'Especificar (no caso de outros motivos)','campo' => 'especificar'])
            @endcomponent

            @component('components.form.select',
            ['titulo' => 'Tipo de boletim','campo' => 'doc_tipo', 'opt' => config('sistema.tipoBoletim')])
            @endcomponent

            @component('components.form.text',['titulo' => 'N° Boletim','campo' => 'doc_numero'])
            @endcomponent

            @component('components.form.text',['titulo' => 'Referencia da VAJME (Nº do processo e vara)','campo' => 'referenciavajme'])
            @endcomponent

            @component('components.form.textarea',['titulo' => 'Síntese do fato (Quem, quando, onde, como e por quê)','campo' => 'sintese_txt'])
            @endcomponent

            <br>
            
            @component('components.subform',
            [
                'title' => 'Procedimento(s) de Origem (apenas se houver)',
                'btn' => 'Adicionar documento de origem',
                'arquivo' => 'ligacao',
                'relacao' => NULL,
                'proc' => 'apfd',
                'unico' => false
            ])    
            @endcomponent
            

            @component('components.subform',
            [
                'title' => 'Acusado',
                'btn' => 'Adicionar acusado',
                'arquivo' => 'envolvido',
                'relacao' => NULL,
                'proc' => 'apfd',
                'unico' => false
            ])    
            @endcomponent

            @component('components.subform',
            [
                'title' => 'Vítima (apenas se houver)',
                'btn' => 'Adicionar vítima',
                'arquivo' => 'ofendido',
                'relacao' => NULL,
                'proc' => 'apfd',
                'unico' => false
            ])    
            @endcomponent

            <div class='col-md-12 col-xs-12'>
            <br>
            {!! Form::submit('Inserir apfd',['class' => 'btn btn-primary btn-block']) !!}
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
    $(document).ready(function(){
        addObjectForm('envolvido','apfd');
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
</script>
@stop

