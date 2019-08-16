@extends('adminlte::page')

@section('title', 'Relatório - Respondendo')

@section('content_header')
<section class="content-header">   
  <h1>Relatório de policiais respondendo ou que responderam procedimentos</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  </ol>
</section>
@stop

@section('content')
<section class="">
    <div class="tab-content">
        <v-tab-item title="Formulário principal" idp="principal" cls="active show">
            {!! Form::open(['url' => route('respondendo.search')]) !!}
            <v-label lg='4' md='4' label="cdopm" title="OPM" error="{{$errors->first('cdopm')}}">
                <v-opm cdopm="{{$proc['cdopm'] ?? ''}}"></v-opm>
            </v-label>
            <v-label lg='2' md='2' label="sjd_ref_ano_ini" title="Ano Inicial" error="{{$errors->first('sjd_ref_ano_ini')}}">
                <v-ano todos name="sjd_ref_ano_ini" ano="{{$proc['sjd_ref_ano_ini'] ?? ''}}"></v-ano>
            </v-label>
            <v-label lg='2' md='2' label="sjd_ref_ano_fim" title="Ano Final" error="{{$errors->first('sjd_ref_ano_fim')}}">
                <v-ano todos name="sjd_ref_ano_fim" ano="{{$proc['sjd_ref_ano_fim'] ?? ''}}"></v-ano>
            </v-label>
            <v-label lg='4' md='4' label="andamento" title="Andamento" error="{{$errors->first('andamento')}}">
                {!! Form::select('andamento',config('sistema.andamentoUnico'),null, ['class' => 'form-control']) !!}
            </v-label>
            <v-label slim label="proc" md="12" lg="12" title="Processos e Procedimentos">
                {{-- <v-label slim label="todos_proc" title="Todos" md="1" lg="1">{!! Form::select('todos_proc',['0' => 'Não','1' => 'Sim'],'0', ['class' => 'form-control']) !!}</v-checkbox></v-label> --}}
                <v-label slim label="proc" md="1" lg="1"><v-checkbox name="proc[adl]" true-value="1" false-value="0" text="ADL" check></v-checkbox></v-label>
                <v-label slim label="proc" md="1" lg="1"><v-checkbox name="proc[apfd]" true-value="1" false-value="0" text="APFD" check></v-checkbox></v-label>
                <v-label slim label="proc" md="1" lg="1"><v-checkbox name="proc[cd]" true-value="1" false-value="0" text="CD" check></v-checkbox></v-label>
                <v-label slim label="proc" md="1" lg="1"><v-checkbox name="proc[cj]" true-value="1" false-value="0" text="CJ" check></v-checkbox></v-label>
                <v-label slim label="proc" md="1" lg="1"><v-checkbox name="proc[fatd]" true-value="1" false-value="0" text="FATD" check></v-checkbox></v-label>
                <v-label slim label="proc" md="1" lg="1"><v-checkbox name="proc[iso]" true-value="1" false-value="0" text="ISO" check></v-checkbox></v-label>
                <v-label slim label="proc" md="1" lg="1"><v-checkbox name="proc[ipm]" true-value="1" false-value="0" text="IPM" check></v-checkbox></v-label>
                <v-label slim label="proc" md="1" lg="1"><v-checkbox name="proc[it]" true-value="1" false-value="0" text="IT" check></v-checkbox></v-label>
                <v-label slim label="proc" md="1" lg="1"><v-checkbox name="proc[sindicancia]" true-value="1" false-value="0" text="Sindicância" check></v-checkbox></v-label>
            </v-label>
            <v-label slim label="proc" md="12" lg="12" title="Postos/Graduações">
                {{-- <v-label slim label="todos_cargo" title="Todos" md="1" lg="1">{!! Form::select('todos_cargo',['0' => 'Não','1' => 'Sim'],'0', ['class' => 'form-control']) !!}</v-checkbox></v-label> --}}
                <v-label slim label="cargo" md="1" lg="1"><v-checkbox name="cargo[SD2C]" true-value="1" false-value="0" text="SD2C" check></v-checkbox></v-label>
                <v-label slim label="cargo" md="1" lg="1"><v-checkbox name="cargo[SD1C]" true-value="1" false-value="0" text="SD1C"></v-checkbox></v-label>
                <v-label slim label="cargo" md="1" lg="1"><v-checkbox name="cargo[CABO]" true-value="1" false-value="0" text="CABO"></v-checkbox></v-label>
                <v-label slim label="cargo" md="1" lg="1"><v-checkbox name="cargo[3SGT]" true-value="1" false-value="0" text="3SGT"></v-checkbox></v-label>
                <v-label slim label="cargo" md="1" lg="1"><v-checkbox name="cargo[1SGT]" true-value="1" false-value="0" text="1SGT"></v-checkbox></v-label>
                <v-label slim label="cargo" md="1" lg="1"><v-checkbox name="cargo[SUBTEN]" true-value="1" false-value="0" text="SUBTEN"></v-checkbox></v-label>
                <v-label slim label="cargo" md="1" lg="1"><v-checkbox name="cargo[ALUNO1A]" true-value="1" false-value="0" text="ALUNO1A"></v-checkbox></v-label>
                <v-label slim label="cargo" md="1" lg="1"><v-checkbox name="cargo[ALUNO2A]" true-value="1" false-value="0" text="ALUNO2A"></v-checkbox></v-label>
                <v-label slim label="cargo" md="1" lg="1"><v-checkbox name="cargo[ALUNO3A]" true-value="1" false-value="0" text="SD2C"></v-checkbox></v-label>
                <v-label slim label="cargo" md="1" lg="1"><v-checkbox name="cargo[ALUNO]" true-value="1" false-value="0" text="ALUNO"></v-checkbox></v-label>
                <v-label slim label="cargo" md="1" lg="1"><v-checkbox name="cargo[ASPOF]" true-value="1" false-value="0" text="ASPOF"></v-checkbox></v-label>
            </v-label>
            <v-label slim label="proc" md="12" lg="12">
                <v-label slim label="cargo" md="1" lg="1"><v-checkbox name="cargo[2TEN]" true-value="1" false-value="0" text="2TEN"></v-checkbox></v-label>
                <v-label slim label="cargo" md="1" lg="1"><v-checkbox name="cargo[1TEN]" true-value="1" false-value="0" text="1TEN"></v-checkbox></v-label>
                <v-label slim label="cargo" md="1" lg="1"><v-checkbox name="cargo[CAP]" true-value="1" false-value="0" text="CAP"></v-checkbox></v-label>
                <v-label slim label="cargo" md="1" lg="1"><v-checkbox name="cargo[MAJ]" true-value="1" false-value="0" text="MAJ"></v-checkbox></v-label>
                <v-label slim label="cargo" md="1" lg="1"><v-checkbox name="cargo[CEL]" true-value="1" false-value="0" text="CEL"></v-checkbox></v-label>
                <v-label slim label="cargo" md="1" lg="1"><v-checkbox name="cargo[TENCEL]" true-value="1" false-value="0" text="TENCEL"></v-checkbox></v-label>
                <v-label slim label="cargo" md="1" lg="1"><v-checkbox name="cargo[CELAGREG]" true-value="1" false-value="0" text="CELAGREG"></v-checkbox></v-label>
            </v-label>
            <v-label slim label="tipo" md="12" lg="12">
                Resultado da busca: {!! Form::select('tipo_relatorio',['lista' => 'Listagem', 'relatorio' => 'Relatório'],null, ['class' => 'form-control']) !!}
            </v-label>
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

