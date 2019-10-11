@extends('adminlte::page')

@section('title', 'Relatório quantitativo encarregado')

@section('content_header')
<section class="content-header">   
  <h1>Relatório quantitativo encarregado</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  </ol>
</section>
@stop

@section('content')
<section class="">
    <div class="tab-content">
        <v-tab-item title="Formulário principal" idp="principal" cls="active show">
            {!! Form::open(['url' => route('relatorio.encarregado.result')]) !!}
            <v-label label="sjd_ref_ano" title="Ano Inicial" error="{{$errors->first('sjd_ref_ano')}}">
                <v-ano todos name="sjd_ref_ano" ano="{{$proc['sjd_ref_ano'] ?? ''}}"></v-ano>
            </v-label>
            <v-label label="procedimento" title="Processo/Procedimento">
                {!! Form::select('procedimento',
                    [
                    "adl" => "Apuração Disciplinar de Licenciamento",
                    "apfd" => "Auto de Prisão em Flagrante Delito",
                    "cd" => "Conselho de Disciplina",
                    "cj" => "Conselho de Justificação",
                    "desercao" => "Deserção",
                    "fatd" => "Formulário de Apuração de Transgressão Disciplinar",
                    "ipm" => "Inquérito Policial Militar",
                    "it" => "Inquérito Técnico",
                    "iso" => "Inquérito Sanitário de Origem",
                    "sindicancia" => "Sindicância",
                    "sai" => "Investigação Policial",
                    "proc_outros" => "Procedimento Outros",
                    "pad" => "Processo Administrativo"
                ]
                ,'adl', ['class' => 'form-control']) !!}
            </v-label>
            @if(session('ver_todas_unidades'))
            <v-label label="cdopm" title="OPM" error="{{$errors->first('cdopm')}}">
                <v-opm todas cdopm="{{$proc['cdopm'] ?? ''}}"></v-opm>
            </v-label>
            @else 
                <input type="hidden" name="cdopm" value="{{session('cdopm')}}">
            @endif
            <v-label slim label="tipo" md="12" lg="12">
                {!! Form::submit('Buscar',['class' => 'btn btn-primary btn-block']) !!}
            </v-label>
            {!! Form::close() !!}
        </v-tab-item>
    </div>
</section>
@stop

@section('css')
@stop

@section('js')
@include('vendor.adminlte.includes.vue')
@stop

