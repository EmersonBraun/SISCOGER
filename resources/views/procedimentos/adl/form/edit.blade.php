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
        <v-tab-menu
        :itens="[
            {idp: 'principal',name: 'Principal', cls: 'active'},
            {idp: 'envolvidos',name: 'Envolvidos'},
            {idp: 'documentos',name: 'Documentos'},
            {idp: 'recursos',name: 'Recursos'},
            {idp: 'membros',name: 'Membros'},
            {idp: 'movimentos',name: 'Movimentos'},
            {idp: 'sobrestamentos',name: 'Sobrestamentos'},

        ]">

        </v-tab-menu>
       
        <div class="tab-content">
            <v-tab-item title="N° {{ $proc['sjd_ref'] }} / {{ $proc['sjd_ref_ano'] }} - Formulário principal" idp="principal" cls="active show">
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
            </v-tab-item>
            <v-tab-item title="Envolvidos" idp="envolvidos">
                <v-proced-origem></v-proced-origem><br>           
                <v-acusado idp="{{$proc['id_adl']}}" situacao="{{sistema('procSituacao','adl')}}" ></v-acusado><br>
                <v-vitima idp="{{$proc['id_adl']}}" ></v-vitima><br>
            </v-tab-item>
            <v-tab-item title="Documentos" idp="documentos">
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
                <v-item-unique title="Parecer comissão" proc="adl" idp="{{$proc['id_adl']}}" name="parecer_comissao"></v-item-unique>

                <file-upload 
                    title="Parecer CMT Geral:"
                    name="decisao_file"
                    proc="adl"
                    idp="{{$proc['id_adl']}}"
                    :ext="['pdf']" 
                    :candelete="{{session('is_admin')}}"
                    ></file-upload>
                <v-item-unique title="Parecer CMT Geral" proc="adl" idp="{{$proc['id_adl']}}" name="parecer_cmtgeral"></v-item-unique>
            </v-tab-item>
            <v-tab-item title="Recursos" idp="recursos">
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
            </v-tab-item>
            <v-tab-item title="Membros" idp="membros">
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
            </v-tab-item>
            <v-tab-item title="Movimentos" idp="movimentos">
                asdasd
            </v-tab-item>
            <v-tab-item title="Sobrestamentos" idp="sobrestamentos">
                sobrest
            </v-tab-item>
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

