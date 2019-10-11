@extends('adminlte::page')

@section('title', 'ADL - Criar')

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
<section class="">
    <div class="tab-content">
        <v-tab-item title="Formulário principal" idp="principal" cls="active show">
            {!! Form::open(['url' => route('adl.store')]) !!}
            <v-prioritario prioridade="{{$proc['prioridade'] ?? ''}}"></v-prioritario>
            <v-label label="id_andamento" title="Andamento" error="{{$errors->first('id_andamento')}}">
                {!! Form::select('id_andamento',config('sistema.andamentoADL'),null, ['class' => 'form-control','required']) !!}
            </v-label>
            <v-label label="id_andamentocoger" title="Andamento COGER" error="{{$errors->first('id_andamentocoger')}}">
                {!! Form::select('id_andamentocoger',config('sistema.andamentocogerADL'),null, ['class' => 'form-control','required']) !!}
            </v-label>
            <v-label label="id_motivoconselho" title="Motivo ADL (Lei nº 16.544/2010)" link="https://goo.gl/L1m5Ps" icon="fa fa-link text-info">
                {!! Form::select('id_motivoconselho', config('sistema.motivoConselho'),null, ['class' => 'form-control select2', 'id' => 'descricao']) !!}
            </v-label>
            <v-label label="check" title="Selecione: " md="12" lg="12">
                <v-checkbox name="ac_desempenho_bl" true-value="S" false-value="0"
                text="Procedido incorretamente no desempenho do cargo ou função.">
                </v-checkbox>
                <v-checkbox name="ac_conduta_bl" true-value="S" false-value="0"
                text="Conduta irregular ou ato que venha a denegrir a imagem da Corporação.">
                </v-checkbox>
                <v-checkbox name="ac_honra_bl" true-value="S" false-value="0"
                text="Praticado ato que afete a honra pessoal, o pundonor militar ou o decoro da classe.">
                </v-checkbox>
            </v-label>
            <v-label label="outromotivo" title="Especificar (no caso de outros motivos)">
                {{ Form::text('outromotivo', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="id_situacaoconselho" title="Situação">
                {!! Form::select('id_situacaoconselho',config('sistema.situacaoConselho'),null, ['class' => 'form-control ', 'id' => 'descricao']) !!}
            </v-label>
            <v-label label="id_decorrenciaconselho" title="Em decorrência de">
                {!! Form::select('id_decorrenciaconselho',config('sistema.decorrenciaConselho'),null, ['class' => 'form-control ', 'id' => 'descricao']) !!}
            </v-label>
            <v-label label="portaria_numero" title="N° Portaria">
                {{ Form::text('portaria_numero', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="portaria_data" title="Data da Portaria" icon="fa fa-calendar">
                <v-datepicker name="portaria_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['portaria_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="doc_tipo" title="Tipo de boletim">
                {!! Form::select('doc_tipo',config('sistema.tipoBoletim'),null, ['class' => 'form-control ']) !!}
            </v-label>
            <v-label label="doc_numero" title="N° Boletim">
                {{ Form::text('doc_numero', null, ['class' => 'form-control ']) }}
            </v-label>
            <v-label label="fato_data" title="Data da fato" icon="fa fa-calendar">
                <v-datepicker name="fato_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['fato_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="abertura_data" title="Data da abertura" icon="fa fa-calendar">
                <v-datepicker name="abertura_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['abertura_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="prescricao_data" title="Data da prescricao" icon="fa fa-calendar">
                <v-datepicker name="prescricao_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['prescricao_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="sintese_txt" title="Sintese" lg="12" md="12" error="{{$errors->first('sintese_txt')}}">
                {!! Form::textarea('sintese_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
            </v-label>
            {!! Form::submit('Inserir ADL',['class' => 'btn btn-primary btn-block']) !!}
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

