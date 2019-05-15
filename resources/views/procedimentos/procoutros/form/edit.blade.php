@extends('adminlte::page')

@section('title', 'Proc. Outros - Editar')

@section('content_header')
<section class="content-header">   
  <h1>Proc. Outros - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('procoutros.lista',['ano' => date('Y')])}}">Proc. Outros - Lista</a></li>
  <li class="active">Proc. Outros - Editar</li>
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
            {idp: 'resultado',name: 'Resultado'},
            {idp: 'membros',name: 'Membros'},
            {idp: 'movimentos',name: 'Movimentos'},
            {idp: 'encaminhamentos',name: 'Encaminhamentos'},
            {idp: 'arquivo',name: 'Arquivo'},

        ]">

        </v-tab-menu>
       
        <div class="tab-content">
            <v-tab-item title="N° {{ $proc['sjd_ref'] }} / {{ $proc['sjd_ref_ano'] }} - Formulário principal" idp="principal" cls="active show">
                {!! Form::model($proc,['url' => route('procoutros.update',$proc['id_proc_outros']),'method' => 'put']) !!}
                <v-label label="id_andamento" title="Andamento">
                    {{-- {!! Form::select('id_andamento',config('sistema.andamentoPROCOUTROS'),null, ['class' => 'form-control ']) !!} --}}
                </v-label>
                <v-label label="id_andamentocoger" title="Andamento COGER">
                    {{-- {!! Form::select('id_andamentocoger',config('sistema.andamentocogerPROCOUTROS'),null, ['class' => 'form-control ']) !!} --}}
                </v-label>
                <v-label label="num_pid" title="N° PID">
                    {{ Form::text('num_pid', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="data" title="Data da abertura" icon="fa fa-calendar">
                    <v-datepicker name="data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['data'] ?? ''}}"></v-datepicker>
                </v-label>
                <v-label label="abertura_data" title="Data de recebimento" icon="fa fa-calendar">
                    <v-datepicker name="abertura_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['abertura_data'] ?? ''}}"></v-datepicker>
                </v-label>
                <v-label label="limite_data" title="Data limite" icon="fa fa-calendar">
                    <v-datepicker name="limite_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['limite_data'] ?? ''}}"></v-datepicker>
                </v-label>
                <v-label label="cdopm" title="OPM">
                    <v-opm cdopm="{{$proc['cdopm']}}"></v-opm>
                </v-label>
                <v-label label="doc_origem" title="Doc. Origem">---arrumar---
                    {!! Form::select('doc_origem',[],null, ['class' => 'form-control ', 'id' => 'descricao']) !!}
                </v-label>
                <v-label label="num_doc_origem" title="Nº Documento, ou descrição outros documentos">
                    {{ Form::text('num_doc_origem', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="motivo_abertura" title="Motivo Abertura">---arrumar---
                    {!! Form::select('motivo_abertura',[],null, ['class' => 'form-control ', 'id' => 'descricao']) !!}
                </v-label>
                <v-label label="desc_outros" title="Descrição outros motivos:">
                    {{ Form::text('desc_outros', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="id_municipio" title="Municipio">
                    <v-municipio id_municipio="{{$proc['id_municipio']}}"></v-municipio>
                </v-label>
                --subform viaturas--
                <v-label label="sintese_txt" title="Sintese" lg="12" md="12" error="{{$errors->first('sintese_txt')}}">
                    {!! Form::textarea('sintese_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
                </v-label>
                {!! Form::submit('Alterar Proc. Outros',['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}
            </v-tab-item>
            <v-tab-item title="Envolvidos" idp="envolvidos">
                <v-proced-origem></v-proced-origem><br>           
                <v-acusado idp="{{$proc['id_proc_outros']}}" situacao="{{sistema('procSituacao','proc_outros')}}" ></v-acusado><br>
                <v-vitima idp="{{$proc['id_proc_outros']}}" ></v-vitima><br>
            </v-tab-item>
            <v-tab-item title="Documentos" idp="documentos">
                <file-upload 
                        title="Documento Juntado:"
                        name="relatorio1_file"
                        proc="proc_outros"
                        idp="{{$proc['id_proc_outros']}}"
                        :ext="['pdf']" 
                        :candelete="{{session('is_admin')}}"
                        ></file-upload>--alterar para vários--
                --nome documento--
                --data documento--
            </v-tab-item>
            <v-tab-item title="Resultado" idp="resultado">
               --procedimento resultante--
            </v-tab-item>
            <v-tab-item title="Membros" idp="membros">
                <v-membro idp="{{$proc['id_proc_outros']}}"></v-membro>
            </v-tab-item>
            <v-tab-item title="Movimentos" idp="movimentos">
                <v-movimento idp="{{$proc['id_proc_outros']}}" opm="{{session('opm_descricao')}}" rg="{{session('rg')}}" :admin="{{session('is_admin')}}"></v-movimento>
            </v-tab-item>
            <v-tab-item title="Encaminhamentos" idp="encaminhamentos">
                Encaminhamentos
            </v-tab-item>
            <v-tab-item title="Arquivo" idp="arquivo">
                <v-arquivo idp="{{$proc['id_proc_outros']}}" ></v-arquivo>
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

