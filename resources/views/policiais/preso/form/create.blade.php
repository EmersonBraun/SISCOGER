@extends('adminlte::page')

@section('title', 'Preso - Criar')

@section('content_header')
<section class="content-header">   
  <h1>Preso - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('preso.index')}}">Preso - Lista</a></li>
  <li class="active">Preso - Criar</li>
  </ol>
</section>

</v-select>
@stop

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
<section class="">
    <div class="tab-content">
        <v-tab-item title="Formulário principal" idp="principal" cls="active show">
            {!! Form::open(['url' => route('preso.store')]) !!}
            <v-label label="rg" title="RG" lg="4" md="4" error="{{$errors->first('rg')}}">
                {{ Form::text('rg', null, ['class' => 'form-control ','onchange' => 'completaDados(this,nome,cargo)','onkeyup' => 'completaDados(this,nome,cargo)']) }}
            </v-label>
            <v-label label="nome" title="Nome" lg="4" md="4" error="{{$errors->first('nome')}}">
                {{ Form::text('nome', null, ['class' => 'form-control ','readonly','id' => 'nome']) }}
            </v-label>
            <v-label label="cargo" title="Posto/Graduação" lg="4" md="4" error="{{$errors->first('cargo')}}">
                {{ Form::text('cargo', null, ['class' => 'form-control ','readonly','id' => 'cargo']) }}
            </v-label>
            <v-label label="cdopm_quandopreso" title="OPM" error="{{$errors->first('cdopm_quandopreso')}}">
                <v-opm name='cdopm_quandopreso' cdopm="{{$proc['cdopm'] ?? ''}}"></v-opm>
            </v-label>
            <v-label label="local" title="Local de reclusão/detenção" error="{{$errors->first('local')}}">
                {!! Form::select('local',['quartel' => 'Quartel','civil' => 'Órgãos civis'],'quartel', 
                ['class' => 'form-control ', 'id' => 'local',
                "onchange" => "toogleOpt(this.value,['quartel','civil'])"]) !!}
            </v-label>
            <div id='quartel' style="display:none">
                <v-label label="cdopm_prisao" title="Quartel onde o policial está preso">
                    <v-opm name='cdopm_prisao' cdopm="{{$proc['cdopm_prisao'] ?? ''}}"></v-opm>
                </v-label>
            </div>
            <div id='civil' style="display:none">
                <v-label label="localreclusao" title="Local onde o policial está preso" tooltip="Ex: COCT II">
                    {{ Form::text('localreclusao', null, ['class' => 'form-control ']) }}
                </v-label>
            </div>
            <v-label label="origem_proc" md='3' lg='3' title="Procedimento vinculado">
                {!! Form::select('origem_proc',config('sistema.pocedimentosOpcoes'),null, 
                ['class' => 'form-control ', 'id' => 'proc1']) !!}
            </v-label>
            <v-label label="origem_sjd_ref" md='3' lg='3' title="Referência">
                {{ Form::text('origem_sjd_ref', null, ['class' => 'form-control ', 'id'=>'ref1','onblur' => "ajaxLigacao('1')", 'maxlength' => '4']) }}
            </v-label>
            <v-label label="origem_sjd_ref_ano" md='3' lg='3' title="Ano">
                {{ Form::text('origem_sjd_ref_ano', null, ['class' => 'form-control ','id'=>'ano1','onblur' => "ajaxLigacao('1')", 'maxlength' => '4']) }}
            </v-label>
            <v-label label="origem_opm" md='3' lg='3' title="OPM">
                {{ Form::text('origem_opm', null, ['class' => 'form-control ','id'=>'opm1', 'readonly']) }}
            </v-label>
            <v-label label="processo" title="Processo, Nº do processo - Comarca." tooltip="Ex: Ação Penal Militar nº 2010.0000XXX-X - Curitiba" error="{{$errors->first('processo')}}">
                {{ Form::text('processo', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="complemento" title="Artigos da Infração penal" tooltip="Ex: Art. 121 § 2º CP" error="{{$errors->first('complemento')}}">
                {{ Form::text('complemento', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="numeromandado" title="Nº do mandado de prisão, se houver" tooltip="Ex: 000183216-55" error="{{$errors->first('numeromandado')}}">
                {{ Form::text('numeromandado', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="id_presotipo" title="Tipo da prisão">
                {!! Form::select('id_presotipo',config('sistema.presoTipo'),null, ['class' => 'form-control ']) !!}
            </v-label>
            <v-label label="vara" title="Vara (Ex: 3ª vara Criminal)" error="{{$errors->first('vara')}}">
                {{ Form::text('vara', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="comarca" title="Comarca (Ex: Curitiba)" error="{{$errors->first('comarca')}}">
                {{ Form::text('comarca', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="inicio_data" title="Data de entrada na prisão" icon="fa fa-calendar" error="{{$errors->first('inicio_data')}}">
                <v-datepicker name="inicio_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['inicio_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="fim_data" title="Data da saída da prisão" icon="fa fa-calendar">
                <v-datepicker name="fim_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['fim_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="obs_txt" title="Observações" lg="12" md="12" error="{{$errors->first('obs_txt')}}">
                {!! Form::textarea('obs_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
            </v-label>
            {!! Form::submit('Inserir Preso',['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </v-tab-item>
    </div>
</section>
@stop

@section('css')
@stop

@section('js')
@include('vendor.adminlte.includes.vue')
<script>
$(document).ready(function(){
    let val = $("#local").val();
    $('#'+val).show();
});
</script>
@stop

