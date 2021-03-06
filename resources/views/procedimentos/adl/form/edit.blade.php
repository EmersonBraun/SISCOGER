@extends('adminlte::page')

@section('title', 'ADL - Editar')

@section('content_header')
<section class="content-header">   
  <h1>ADL - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('adl.lista')}}">ADL - Lista</a></li>
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
            {idp: 'encaminhamentos',name: 'Encaminhamentos'},
            {idp: 'arquivo',name: 'Arquivo'},

        ]">

        </v-tab-menu>
       
        <div class="tab-content">
            <v-tab-item title="N° {{ $proc['sjd_ref'] }} / {{ $proc['sjd_ref_ano'] }} - Formulário principal" idp="principal" cls="active show">
                {!! Form::model($proc,['url' => route('adl.update',$proc['id_adl']),'method' => 'put']) !!}
                <v-prioritario prioridade="{{$proc['prioridade'] ?? ''}}"></v-prioritario>
                <v-label label="id_andamento" title="Andamento">
                    {!! Form::select('id_andamento',config('sistema.andamentoADL'),null, ['class' => 'form-control ']) !!}
                </v-label>
                <v-label label="id_andamentocoger" title="Andamento COGER">
                    {!! Form::select('id_andamentocoger',config('sistema.andamentocogerADL'),null, ['class' => 'form-control ']) !!}
                </v-label>
                <v-label label="id_motivoconselho" title="Motivo ADL (Lei nº 16.544/2010)" link="https://goo.gl/L1m5Ps" icon="fa fa-link text-info">
                    {!! Form::select('id_motivoconselho', config('sistema.motivoConselho'),null, ['class' => 'form-control select2', 'id' => 'descricao']) !!}
                </v-label>
                <v-label label="check" title="Selecione: " md="12" lg="12">
                    <v-checkbox value="{{$proc['ac_desempenho_bl']}}" name="ac_desempenho_bl" true-value="S" false-value="0"
                    text="Procedido incorretamente no desempenho do cargo ou função.">
                    </v-checkbox>
                    <v-checkbox value="{{$proc['ac_conduta_bl']}}" name="ac_conduta_bl" true-value="S" false-value="0"
                    text="Conduta irregular ou ato que venha a denegrir a imagem da Corporação.">
                    </v-checkbox>
                    <v-checkbox value="{{$proc['ac_honra_bl']}}" name="ac_honra_bl" true-value="S" false-value="0"
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
                {!! Form::submit('Alterar ADL',['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}
            </v-tab-item>
            <v-tab-item title="Envolvidos" idp="envolvidos">
                <v-proced-origem dproc="adl" dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}"></v-proced-origem><br>           
                <v-acusado dproc="adl" idp="{{$proc['id_adl']}}" situacao="{{sistema('procSituacao','adl')}}" ></v-acusado><br>
                <v-vitima dproc="adl" idp="{{$proc['id_adl']}}" ></v-vitima><br>
            </v-tab-item>
            <v-tab-item title="Documentos" idp="documentos">
                <file-upload 
                        title="Libelo:"
                        name="libelo_file"
                        dproc="adl"
                        idp="{{$proc['id_adl']}}"
                        :ext="['pdf']" 
                        ></file-upload>

                <file-upload 
                    title="Parecer:"
                    name="parecer_file"
                    dproc="adl"
                    idp="{{$proc['id_adl']}}"
                    :ext="['pdf']"
                    ></file-upload>
                <v-item-unique title="Parecer comissão" dproc="adl" idp="{{$proc['id_adl']}}" name="parecer_comissao"></v-item-unique>

                <file-upload 
                    title="Parecer CMT Geral:"
                    name="decisao_file"
                    dproc="adl"
                    idp="{{$proc['id_adl']}}"
                    :ext="['pdf']"
                    ></file-upload>
                <v-item-unique title="Parecer CMT Geral" dproc="adl" idp="{{$proc['id_adl']}}" name="parecer_cmtgeral"></v-item-unique>
            </v-tab-item>
            <v-tab-item title="Recursos" idp="recursos">
                <file-upload 
                    title="Reconsideração de ato (solução):"
                    name="rec_ato_file"
                    dproc="adl"
                    idp="{{$proc['id_adl']}}"
                    :ext="['pdf']"
                    >
                </file-upload>

                <file-upload 
                    title="Recurso CMT OPM:"
                    name="rec_cmt_file"
                    dproc="adl"
                    idp="{{$proc['id_adl']}}"
                    :ext="['pdf']"
                    >
                </file-upload>

                <file-upload 
                    title="Recurso CMT CRPM:"
                    name="rec_crpm_file"
                    dproc="adl"
                    idp="{{$proc['id_adl']}}"
                    :ext="['pdf']"
                    >
                </file-upload>

                <file-upload 
                    title="Recurso CMT Geral:"
                    name="rec_cg_file"
                    dproc="adl"
                    idp="{{$proc['id_adl']}}"
                    :ext="['pdf']"
                    >
                </file-upload>
            </v-tab-item>
            <v-tab-item title="Membros" idp="membros">
                <v-membro dproc='adl' idp="{{$proc['id_adl']}}"></v-membro>
            </v-tab-item>
            <v-tab-item title="Movimentos" idp="movimentos">
                <v-movimento dproc='adl' idp="{{$proc['id_adl']}}"></v-movimento>
            </v-tab-item>
            <v-tab-item title="Sobrestamentos" idp="sobrestamentos">
                <v-sobrestamento dproc='adl' idp="{{$proc['id_adl']}}" ></v-sobrestamento>
            </v-tab-item>
            <v-tab-item title="Encaminhamentos" idp="encaminhamentos">
                Encaminhamentos
            </v-tab-item>
            <v-tab-item title="Arquivo" idp="arquivo">
                <v-arquivo dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}" dproc='adl' idp="{{$proc['id_adl']}}" ></v-arquivo>
            </v-tab-item>
        </div>
    </div>

    <div class="content-footer">
        <br>
        
    </div>

</section>
@stop

@section('css')
@stop

@section('js')
@include('vendor.adminlte.includes.vue')
@stop

