@extends('adminlte::page')

@section('title', 'Restrição - Editar')

@section('content_header')
<section class="content-header">   
  <h1>Restrição - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('restricao.index')}}">Restrição - Lista</a></li>
  <li class="active">Restrição - Editar</li>
  </ol>
  <br>
</section>
@stop

@section('content')
<section>
    <div class="tab-content">
        <v-tab-item title="Editar Restrição" idp="principal" cls="active show">
            {!! Form::model($proc,['url' => route('suspenso.update',$proc['id_suspenso']),'method' => 'put']) !!}
            <v-label label="rg" title="RG" lg="4" md="4" error="{{$errors->first('rg')}}">
                {{ Form::text('rg', null, ['class' => 'form-control ','readonly']) }}
            </v-label>
            <v-label label="nome" title="Nome" lg="4" md="4" error="{{$errors->first('nome')}}">
                {{ Form::text('nome', null, ['class' => 'form-control ','readonly','id' => 'nome']) }}
            </v-label>
            <v-label label="cargo" title="Posto/Graduação" lg="4" md="4" error="{{$errors->first('cargo')}}">
                {{ Form::text('cargo', null, ['class' => 'form-control ','readonly','id' => 'cargo']) }}
            </v-label>
            <v-label label="check" title="Restrições: " md="12" lg="12">
                <v-checkbox name="arma_bl" value="{{$proc['arma_bl']}}" true-value="S" false-value="0"
                text="Restrição de Porte de arma de fogo">
                </v-checkbox>
                <v-checkbox name="fardamento_bl" value="{{$proc['fardamento_bl']}}" true-value="S" false-value="0"
                text="Restrição de uso de fardamento">
                </v-checkbox>
            </v-label>
            <v-label label="origem" title="Situação">
                {!! Form::select('origem',config('sistema.origemRestricao'),null, ['class' => 'form-control ', 'id' => 'descricao']) !!}
            </v-label>
            <v-label label="inicio_data" title="Início da restrição" icon="fa fa-calendar">
                <v-datepicker name="inicio_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['inicio_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="fim_data" title="Fim da restrição" icon="fa fa-calendar">
                <v-datepicker name="fim_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['fim_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="obs_txt" title="Observações" lg="12" md="12" error="{{$errors->first('obs_txt')}}">
                {!! Form::textarea('obs_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
            </v-label>
            <v-label label="" title="Data de cadastro" lg="6" md="6">
                <v-show dado="{{$proc['cadastro_data']}}"></v-show> 
            </v-label>
            <v-label label="" title="Data de retirada das restrições" lg="6" md="6">
                <v-show dado="{{$proc['retirada_data']}}"></v-show> 
            </v-label>

            {!! Form::submit('Alterar Restrições',['class' => 'btn btn-primary btn-block']) !!}
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

