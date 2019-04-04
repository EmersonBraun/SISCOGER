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
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
    <div class='btn-group col-md-8 col-xs-12 ' style='padding-left: 0px'>
      <a class="btn btn-success col-md-3 col-xs-4 "  href="#">Editar</a>
    <a class="btn btn-default col-md-3 col-xs-4 "  href="{{route('adl.movimentos',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])}}">Movimentos</a>
      <a class="btn btn-default col-md-3 col-xs-4 "  href="{{route('adl.sobrestamentos',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])}}">Sobrestamentos</a>   
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

            {!! Form::model($proc,['url' => route('adl.update',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']]),'method' => 'put', 'files' => true]) !!}
            @component('components.form.select',
            ['titulo' => 'Andamento','campo' => 'id_andamento', 'opt' => config('sistema.andamentoADL')])
            @endcomponent

            @component('components.form.select',
            ['titulo' => 'Andamento COGER','campo' => 'andamentocoger', 'opt' => config('sistema.andamentocogerADL'), 'class' => 'select2'])
            @endcomponent

            @component('components.form.text',['titulo' => 'Modelo','campo' => 'modelo'])
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

            @component('components.form.date',['titulo' => 'Data da fato','campo' => 'fato_data'])
            @endcomponent

            @component('components.form.date',['titulo' => 'Data da abertura','campo' => 'abertura_data'])
            @endcomponent

            @component('components.form.date',['titulo' => 'Data da prescricao','campo' => 'prescricao_data'])
            @endcomponent

            @component('components.form.sintese_txt')
            @endcomponent

            {{-- linha --}}
            <v-proced-origem></v-proced-origem>
            <br>
                        
            <v-acusado idp="{{$proc['id_adl']}}" situacao="{{sistema('procSituacao','adl')}}"></v-acusado>
            <br>

            <v-vitima idp="{{$proc['id_adl']}}"></v-vitima>
            <br>
            
            </div>
        </div>
    </div>{{-- procedimento principal --}}

</div>
{{-- DOCUMENTOS --}}
<div class="box">{{-- formulário principal --}}
    <div class="box-header">
        {{-- sjd_ref / sjd_ref_ano --}}
        <h4 class="box-title">Documentos</h4>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i>
            </button> 
        </div>             
    </div>

    <div class="box-body">

        <file-upload 
            title="Libelo"
            name="libelo_file"
            proc="adl"
            idp="{{$proc['id_adl']}}"
            :ext="['pdf']" 
            >
        </file-upload>

    {{-- linha --}}
    <div class='col-lg-6 col-md-6 col-xs-12 form-group'>
        {!! Form::sfile('libelo_file','Libelo:','adl',$proc['libelo_file'], ['class' => 'form-control']) !!}
        @if ($errors->has('libelo_file'))
            <span class="help-block">
                <strong>{{ $errors->first('libelo_file') }}</strong>
            </span>
        @endif
    </div>

    <div class='col-lg-6 col-md-6 col-xs-12 form-group'>
    {!! Form::label('parecer_comissao', 'Parecer comissão')!!} <br>
    {!! Form::text('parecer_comissao', $proc['parecer_comissao'], ['class' => 'form-control']) !!}
    @if ($errors->has('parecer_comissao'))
        <span class="help-block">
            <strong>{{ $errors->first('parecer_comissao') }}</strong>
        </span>
    @endif
    </div>

    <div class='col-lg-6 col-md-6 col-xs-12 form-group'>
        {!! Form::sfile('parecer_file','Parecer:','adl',$proc['parecer_file'], ['class' => 'form-control']) !!}
        @if ($errors->has('parecer_file'))
            <span class='help-block'>
                <strong>{{$errors->first('parecer_file')}}</strong>
            </span>
        @endif
    </div>
    {{-- linha --}}

    <div class='col-lg-6 col-md-6 col-xs-12 form-group'>
    {!! Form::label('parecer_cmtgeral', 'Parecer CMT Geral')!!} <br>
    {!! Form::text('parecer_cmtgeral', $proc['parecer_cmtgeral'], ['class' => 'form-control']) !!}
    @if ($errors->has('parecer_cmtgeral'))
        <span class="help-block">
            <strong>{{ $errors->first('parecer_cmtgeral') }}</strong>
        </span>
    @endif
    </div>

    <div class='col-lg-6 col-md-6 col-xs-12 form-group'>
        {!! Form::sfile('decisao_file','Parecer CMT Geral:','adl',$proc['decisao_file'], ['class' => 'form-control']) !!}
        @if ($errors->has('decisao_file'))
            <span class='help-block'>
                <strong>{{$errors->first('decisao_file')}}</strong>
            </span>
        @endif
    </div>

    {{-- <div class='col-lg-12 col-md-12 col-xs-12 form-group'>
        <h5>Arquivos excluídos</h5>
        @forelse ($arquivos_apagados as $aa)
            <div class='col-lg-12 col-md-12 col-xs-12 form-group'>
                <a href="{{asset('public/storage/arquivo/adl/'.$proc['id_adl'].'/'.$aa->objeto.'')}}" target='_blank'>
                    <i class='fa fa-file-pdf-o'></i>{{$aa->objeto}}
                </a>&emsp;Excluído por {{special_ucwords($aa->nome)}}, RG:{{$aa->rg}}, em: {{$aa->created_at}}
            </div>   
        @empty
        <h6>Nenhum arquivo</h6>
        @endforelse
    </div> --}}

    </div>
</div>
{{-- \DOCUMENTOS --}}
{{-- RECURSOS --}}
<div class="box">
    <div class="box-header">
        {{-- sjd_ref / sjd_ref_ano --}}
        <h4 class="box-title">Recursos</h4>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i>
            </button> 
        </div>             
    </div>

    <div class="box-body">

    {{-- linha --}}
    <div class='col-md-6 col-xs-12'>
        {!! Form::sfile('rec_ato_file','Reconsideração de ato (solução): ','fatd',$proc['rec_ato_file']) !!}
    </div>

    <div class='col-md-6 col-xs-12'>
        {!! Form::sfile('rec_cmt_file','Recurso CMT OPM','fatd',$proc['rec_cmt_file']) !!}
    </div>

    {{-- linha --}}
    <div class='col-md-6 col-xs-12'>
        {!! Form::sfile('rec_crpm_file','Recurso CMT CRPM:','fatd',$proc['rec_crpm_file']) !!}
    </div>

    <div class='col-md-6 col-xs-12'>
        {!! Form::sfile('rec_cg_file','Recurso CMT Geral:','fatd',$proc['rec_cg_file']) !!}
    </div>

    </div>
</div>
{{-- \RECURSOS --}}
{{-- MEMBROS --}}
<div class="box">
    <div class="box-header">
        {{-- sjd_ref / sjd_ref_ano --}}
        <h4 class="box-title">Membros</h4>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i>
            </button> 
        </div>             
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


<div class="content-footer">
    <br>
    {!! Form::submit('Alterar ADL',['class' => 'btn btn-primary btn-block']) !!}
    {!! Form::close() !!}
</div>


</section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@include('vendor.adminlte.includes.vue')
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

