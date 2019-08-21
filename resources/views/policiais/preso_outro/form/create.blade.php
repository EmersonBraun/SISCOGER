@extends('adminlte::page')

@section('title', 'Preso outro - Criar')

@section('content_header')
<section class="content-header">   
  <h1>Preso outro - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('presooutro.index')}}">Preso outro - Lista</a></li>
  <li class="active">Preso outro - Criar</li>
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
            {!! Form::open(['url' => route('presooutro.store')]) !!}
            <v-label label="rg" title="RG" error="{{$errors->first('rg')}}">
                {{ Form::text('rg', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="uf" title="Estado" error="{{$errors->first('uf')}}">
                <v-estado name='uf' uf="{{$proc['uf'] ?? ''}}"></v-estado>
            </v-label>
            <v-label label="cpf" title="CPF" error="{{$errors->first('cpf')}}">
                {{ Form::text('cpf', null, ['class' => 'form-control cpf']) }}
            </v-label>
            <v-label label="nome" title="Nome" error="{{$errors->first('nome')}}">
                {{ Form::text('nome', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="ocupacao" title="Ocupação" error="{{$errors->first('ocupacao')}}">
                {{ Form::text('ocupacao', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="cdopm_prisao" title="OPM que está preso" error="{{$errors->first('cdopm_prisao')}}">
                <v-opm name='cdopm_prisao' cdopm="{{$proc['cdopm_prisao'] ?? ''}}"></v-opm>
            </v-label>
            <v-label label="localreclusao" title="Local onde o está preso" tooltip="Ex: COCT II">
                {{ Form::text('localreclusao', null, ['class' => 'form-control ']) }}
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
            <v-label label="Vara" title="Vara (Ex: 3ª Vara Criminal)" error="{{$errors->first('Vara')}}">
                {{ Form::text('Vara', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="comarca" title="Comarca (Ex: Curitiba)" error="{{$errors->first('comarca')}}">
                {{ Form::text('comarca', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="inicio_data" title="Data de entrada na prisão" icon="fa fa-calendar">
                <v-datepicker name="inicio_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['inicio_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="inicio_data" title="Data da saída da prisão" icon="fa fa-calendar">
                <v-datepicker name="inicio_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['inicio_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="obs_txt" title="Observações" lg="12" md="12" error="{{$errors->first('obs_txt')}}">
                {!! Form::textarea('obs_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
            </v-label>
            {!! Form::submit('Inserir Preso outro',['class' => 'btn btn-primary btn-block']) !!}
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

