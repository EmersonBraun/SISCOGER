@extends('adminlte::page')

@section('title', 'adl - Editar')

@section('content_header')
<section class="content-header">   
  <h1>ADL - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('adl.lista',['ano' => date('Y')])}}">ADL - Lista</a></li>
  <li class="active">ADL - Editar</li>
  </ol>
  <br>
</section>
  
@stop

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
<section>
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="a principal active"><a href="#principal" data-toggle="tab" aria-expanded="true" onclick="mudaTab('principal')">Principal </a></li>
            <li class="a envolvidos"><a href="#envolvidos" data-toggle="tab" aria-expanded="false" onclick="mudaTab('envolvidos')">Envolvidos </a></li>
            <li class="a documentos"><a href="#documentos" data-toggle="tab" aria-expanded="false" onclick="mudaTab('documentos')">Documentos </a></li>
            <li class="a recursos"><a href="#recursos" data-toggle="tab" aria-expanded="false" onclick="mudaTab('recursos')">Recursos</a></li>
            <li class="a membros "><a href="#membros" data-toggle="tab" aria-expanded="false" onclick="mudaTab('membros')">Membros</a></li>
            <li class="a movimentos "><a href="#movimentos" data-toggle="tab" aria-expanded="false" onclick="mudaTab('movimentos')">Movimentos</a></li>
            <li class="a sobrestamentos "><a href="#sobrestamentos" data-toggle="tab" aria-expanded="false" onclick="mudaTab('sobrestamentos')">Sobrestamentos</a></li>
        </ul>
        <div class="tab-content">
            <div class="row tab-pane active show" id="principal">
                <div class="col-xs-12">
                    <div class="box">{{-- formulário principal --}}
                        <div class="box-header">
                            {{-- sjd_ref / sjd_ref_ano --}}
                            <h4 class="box-title">N° {{ $proc['sjd_ref'] }} / {{ $proc['sjd_ref_ano'] }} - Formulário principal</h4>
                            {{-- <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                    <i class="fa fa-plus"></i>
                                </button> 
                            </div> --}}
                        </div>

                        <div class="box-body">
                            {!! Form::model($proc,['url' => route('adl.update',$proc['id_adl']),'method' => 'put']) !!}
                            <v-label label="id_andamento" title="Andamento">
                                {!! Form::select('id_andamento',config('sistema.andamentoADL'),null, ['class' => 'form-control ']) !!}
                            </v-label>
                            <v-label label="id_andamentocoger" title="Andamento COGER">
                                {!! Form::select('id_andamentocoger',config('sistema.andamentocogerADL'),null, ['class' => 'form-control ']) !!}
                            </v-label>
                            <v-label label="id_motivoconselho" title="Motivo ADL (Lei nº 16.544/2010)" link="https://goo.gl/L1m5Ps" icon="fa fa-link text-info">
                                {!! Form::select('id_motivoconselho', config('sistema.motivoConselho'),null, ['class' => 'form-control select2', 'id' => 'descricao']) !!}
                            </v-label>
                            <v-label label="outromotivo" title="Especificar (no caso de outros motivos)">
                                {{ Form::text('outromotivo', null, ['class' => 'form-control ']) }}
                            </v-label>
                            <v-label label="id_situacaoconselho" title="Situação">
                                {!! Form::select('id_situacaoconselho',config('sistema.situacaoConselho'),null, ['class' => 'form-control ', 'id' => 'descricao']) !!}
                            </v-label>
                            <v-label label="portaria_numero" title="N° Portaria">
                                {{ Form::text('portaria_numero', null, ['class' => 'form-control ']) }}
                            </v-label>
                            <v-label label="portaria_data" title="Data da portaria" icon="fa fa-calendar">
                                {{ Form::text('portaria_data', null, ['class' => 'form-control ']) }}
                            </v-label>
                            <v-label label="doc_tipo" title="Tipo de boletim">
                                {!! Form::select('doc_tipo',config('sistema.tipoBoletim'),null, ['class' => 'form-control ']) !!}
                            </v-label>
                            <v-label label="doc_numero" title="N° Boletim">
                                {{ Form::text('doc_numero', null, ['class' => 'form-control ']) }}
                            </v-label>
                            <v-label label="fato_data" title="Data da fato" icon="fa fa-calendar">
                                {{ Form::text('fato_data', null, ['class' => 'form-control ']) }}
                            </v-label>
                            <v-label label="abertura_data" title="Data da abertura" icon="fa fa-calendar">
                                {{ Form::text('abertura_data', null, ['class' => 'form-control ']) }}
                            </v-label>
                            <v-label label="prescricao_data" title="Data da prescricao" icon="fa fa-calendar">
                                {{ Form::text('prescricao_data', null, ['class' => 'form-control ']) }}
                            </v-label>
                            <v-label label="sintese_txt" title="Sintese" lg="12" md="12" error="{{$errors->first('sintese_txt')}}">
                                {!! Form::textarea('sintese_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
                            </v-label>
                            {!! Form::submit('Alterar ADL',['class' => 'btn btn-primary btn-block']) !!}
                            {!! Form::close() !!}
                        </div>
                        
                    </div>
                </div>{{-- procedimento principal --}}
            </div>
            <div class="box tab-pane" id="envolvidos">{{-- formulário principal --}}
                <div class="box-header">
                    {{-- sjd_ref / sjd_ref_ano --}}
                    <h4 class="box-title">Envolvidos</h4> 
                    <div class="box-body">
                        <v-proced-origem></v-proced-origem><br>           
                        <v-acusado idp="{{$proc['id_adl']}}" situacao="{{sistema('procSituacao','adl')}}" ></v-acusado><br>
                        <v-vitima idp="{{$proc['id_adl']}}" ></v-vitima><br>
                    </div>           
                </div>
            </div>
            {{-- DOCUMENTOS --}}
            <div class="box tab-pane" id="documentos">{{-- formulário principal --}}
                <div class="box-header">
                    {{-- sjd_ref / sjd_ref_ano --}}
                    <h4 class="box-title">Documentos</h4>            
                </div>

                <div class="box-body">
                    <file-upload 
                        title="Libelo:"
                        name="libelo_file"
                        proc="adl"
                        idp="{{$proc['id_adl']}}"
                        :ext="['pdf']" 
                        :candelete="{{session('is_admin')}}"
                        ></file-upload>

                    <file-upload 
                        title="Parecer:"
                        name="parecer_file"
                        proc="adl"
                        idp="{{$proc['id_adl']}}"
                        :ext="['pdf']" 
                        :candelete="{{session('is_admin')}}"
                        ></file-upload>

                    <v-label label="parecer_comissao" title="Parecer comissão" lg="12" md="12">
                        {!! Form::text('parecer_comissao', null, ['class' => 'form-control']) !!}
                    </v-label>

                    <file-upload 
                        title="Parecer CMT Geral:"
                        name="decisao_file"
                        proc="adl"
                        idp="{{$proc['id_adl']}}"
                        :ext="['pdf']" 
                        :candelete="{{session('is_admin')}}"
                        ></file-upload>
                    <v-label label="parecer_cmtgeral" title="Parecer CMT Geral" lg="12" md="12">
                        {!! Form::text('parecer_cmtgeral', null, ['class' => 'form-control']) !!}
                    </v-label>
                </div>
            </div>
            {{-- \DOCUMENTOS --}}
            {{-- RECURSOS --}}
            <div class="box tab-pane" id="recursos">
                <div class="box-header">
                    {{-- sjd_ref / sjd_ref_ano --}}
                    <h4 class="box-title">Recursos</h4>            
                </div>

                <div class="box-body">

                {{-- linha --}}
                <file-upload 
                    title="Reconsideração de ato (solução):"
                    name="rec_ato_file"
                    proc="adl"
                    idp="{{$proc['id_adl']}}"
                    :ext="['pdf']" 
                    :candelete="{{session('is_admin')}}"
                    >
                </file-upload>

                <file-upload 
                    title="Recurso CMT OPM:"
                    name="rec_cmt_file"
                    proc="adl"
                    idp="{{$proc['id_adl']}}"
                    :ext="['pdf']" 
                    :candelete="{{session('is_admin')}}"
                    >
                </file-upload>

                <file-upload 
                    title="Recurso CMT CRPM:"
                    name="rec_crpm_file"
                    proc="adl"
                    idp="{{$proc['id_adl']}}"
                    :ext="['pdf']" 
                    :candelete="{{session('is_admin')}}"
                    >
                </file-upload>

                <file-upload 
                    title="Recurso CMT Geral:"
                    name="rec_cg_file"
                    proc="adl"
                    idp="{{$proc['id_adl']}}"
                    :ext="['pdf']" 
                    :candelete="{{session('is_admin')}}"
                    >
                </file-upload>

                </div>
            </div>
            {{-- \RECURSOS --}}
            {{-- MEMBROS --}}
            <div class="box tab-pane" id="membros">
                <div class="box-header">
                    {{-- sjd_ref / sjd_ref_ano --}}
                    <h4 class="box-title">Membros</h4>            
                </div>

                <div class="box-body">

                {{--  presidente --}}
                <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
                    {!! Form::label('presidente-rg', 'RG do presidente')!!} <br>
                    {!! Form::text('presidente-rg',$presidente['rg'],
                    ['onblur' => "completaDados($(this).val(),'presidente-nome','presidente-posto')",'class' => 'form-control']) !!}
                </div>

                <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
                    {!! Form::label('presidente-nome', 'Nome do presidente')!!} <br>
                    {!! Form::text('presidente-nome',$presidente['nome'],['readonly','class' => 'form-control']) !!}
                </div>

                <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
                    {!! Form::label('presidente-posto', 'Posto/Graduação')!!} <br>
                    {!! Form::text('presidente-posto',$presidente['cargo'],['readonly','class' => 'form-control']) !!}
                </div>

                {{--  escrivao --}}
                <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
                    {!! Form::label('escrivao-rg', 'RG do escrivao')!!} <br>
                    {!! Form::text('escrivao-rg',$escrivao['rg'],
                    ['onblur' => "completaDados($(this).val(),'escrivao-nome','escrivao-posto')",'class' => 'form-control']) !!}
                </div>

                <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
                    {!! Form::label('escrivao-nome', 'Nome do escrivao')!!} <br>
                    {!! Form::text('escrivao-nome',$escrivao['nome'],['readonly','class' => 'form-control']) !!}
                </div>

                <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
                    {!! Form::label('escrivao-posto', 'Posto/Graduação')!!} <br>
                    {!! Form::text('escrivao-posto',$escrivao['cargo'],['readonly','class' => 'form-control']) !!}
                </div>

                {{--  defensor --}}
                <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
                    {!! Form::label('defensor-rg', 'RG do defensor')!!} <br>
                    {!! Form::text('defensor-rg',$defensor['rg'],
                    ['onblur' => "completaDados($(this).val(),'defensor-nome','defensor-posto')",'class' => 'form-control']) !!}
                </div>

                <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
                    {!! Form::label('defensor-nome', 'Nome do defensor')!!} <br>
                    {!! Form::text('defensor-nome',$defensor['nome'],['readonly','class' => 'form-control']) !!}
                </div>

                <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
                    {!! Form::label('defensor-posto', 'Posto/Graduação')!!} <br>
                    {!! Form::text('defensor-posto',$defensor['cargo'],['readonly','class' => 'form-control']) !!}
                </div>

                </div>
            </div>
            {{-- \MEMBROS --}}
        </div>
    </div>

    <div class="content-footer">
        <br>
        
    </div>

</section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
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
@include('vendor.adminlte.includes.vue')
@stop

