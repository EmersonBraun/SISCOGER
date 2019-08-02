@extends('adminlte::page')

@section('title', 'IPM - Editar')

@section('content_header')
<section class="content-header">   
  <h1>IPM - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('ipm.lista',['ano' => date('Y')])}}">IPM - Lista</a></li>
  <li class="active">IPM - Editar</li>
  </ol>
  <br>
</section>
@stop

@section('content')
<div class="">
<section>
    <div class="nav-tabs-custom">
        <v-tab-menu
        :itens="[
            {idp: 'principal',name: 'Principal', cls: 'active'},
            {idp: 'indiciados',name: 'Indiciados'},
            {idp: 'documentos',name: 'Documentos'},
            {idp: 'membros',name: 'Membros'},
            {idp: 'movimentos',name: 'Movimentos'},
            {idp: 'sobrestamentos',name: 'Sobrestamentos'},
            {idp: 'encaminhamentos',name: 'Encaminhamentos'},
            {idp: 'vajme',name: 'Vajme'},
            {idp: 'arquivo',name: 'Arquivo'},
        ]">
        </v-tab-menu>
        <div class="tab-content">
            <v-tab-item title="N° {{ $proc['sjd_ref'] }} / {{ $proc['sjd_ref_ano'] }} - Formulário principal" idp="principal" cls="active show">
                {!! Form::model($proc,['url' => route('ipm.update',$proc['id_ipm']),'method' => 'put']) !!}
                    <v-prioritario admin="session('admin')" prioridade="{{$proc['prioridade']}}"></v-prioritario>
                    <v-label label="id_andamento" title="Andamento" error="{{$errors->first('id_andamento')}}">
                        {!! Form::select('id_andamento',config('sistema.andamentoIPM'),null, ['class' => 'form-control ']) !!}
                    </v-label>
                    <v-label label="id_andamentocoger" title="Andamento COGER" error="{{$errors->first('id_andamentocoger')}}">
                        {!! Form::select('id_andamentocoger',config('sistema.andamentocogerIPM'),null, ['class' => 'form-control ']) !!}
                    </v-label>
                    <v-label label="cdopm" title="OPM" error="{{$errors->first('cdopm')}}">
                        <v-opm cdopm="{{$proc['cdopm'] ?? ''}}"></v-opm>
                    </v-label>
                    <v-label label="fato_data" title="Data da fato" icon="fa fa-calendar">
                        <v-datepicker name="fato_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['fato_data'] ?? ''}}"></v-datepicker>
                    </v-label>
                    <v-label label="abertura_data" title="Data da portaria de delegação de poderes" icon="fa fa-calendar">
                        <v-datepicker name="abertura_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['abertura_data'] ?? ''}}"></v-datepicker>
                    </v-label>
                    <v-label label="autuacao_data" title="Data da portaria de instauração" icon="fa fa-calendar">
                        <v-datepicker name="autuacao_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['autuacao_data'] ?? ''}}"></v-datepicker>
                    </v-label>
                    <v-label label="portaria_numero" title="Nº da portaria de delegação de poderes">
                        {{ Form::text('portaria_numero', null, ['class' => 'form-control ']) }}
                    </v-label>
                    <v-label label="crime" title="Crime">
                        {!! Form::select('crime',config('sistema.crime'),null, ['class' => 'form-control ', 'id' => 'descricao']) !!}
                    </v-label>
                    <v-label label="id_municipio" title="Municipio">
                        <v-municipio id_municipio="{{$proc['id_municipio'] ?? ''}}"></v-municipio>
                    </v-label>
                    <v-label label="bou_ano" title="BOU (Ano)">
                        <v-ano ano="{{$proc['bou_ano']}}"></v-ano>
                    </v-label>
                    <v-label label="bou_numero" title="N° BOU">
                        {{ Form::text('bou_numero', null, ['class' => 'form-control ']) }}
                    </v-label>
                    <v-label label="n_eproc" title="N° Eproc">
                        {{ Form::text('n_eproc', null, ['class' => 'form-control ']) }}
                    </v-label>
                    <v-label label="ano_eproc" title="Eproc (Ano)">
                        <v-ano ano="{{$proc['ano_eproc']}}"></v-ano>
                    </v-label>
                    <v-label label="relato_enc" title="Conclusão do encarregado">
                        {{ Form::text('relato_enc', null, ['class' => 'form-control ']) }}
                    </v-label>
                    <v-label label="sintese_txt" title="Sintese" lg="12" md="12" error="{{$errors->first('sintese_txt')}}">
                        {!! Form::textarea('sintese_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
                    </v-label>
                {!! Form::submit('Alterar IPM',['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}
            </v-tab-item>
            <v-tab-item title="Indiciados" idp="indiciados">
                <v-proced-origem></v-proced-origem><br>           
                <v-acusado idp="{{$proc['id_ipm']}}" situacao="{{sistema('procSituacao','ipm')}}" reu></v-acusado><br>
            </v-tab-item>
            <v-tab-item title="Documentos" idp="documentos">
                <file-upload 
                title="PDF - Conclusão do encarregado:"
                name="relato_enc_file"
                proc="ipm"
                idp="{{$proc['id_ipm']}}"
                :ext="['pdf']" 
                :candelete="{{session('is_admin')}}"
                ></file-upload>
                <v-item-unique title="Data" proc="ipm" idp="{{$proc['id_ipm']}}" name="relato_enc_data"></v-item-unique>
                <v-item-unique title="Conclusão do encarregado" proc="ipm" idp="{{$proc['id_ipm']}}" name="relato_enc"></v-item-unique>
                <file-upload 
                title="PDF - Solução do Cmt OPM:"
                name="relato_cmtopm_file"
                proc="ipm"
                idp="{{$proc['id_ipm']}}"
                :ext="['pdf']" 
                :candelete="{{session('is_admin')}}"
                ></file-upload>
                <v-item-unique title="Data" proc="ipm" idp="{{$proc['id_ipm']}}" name="relato_cmtopm_data"></v-item-unique>
                <v-item-unique title="Conclusão do Cmt. OPM" proc="ipm" idp="{{$proc['id_ipm']}}" name="relato_cmtopm"></v-item-unique>
                <file-upload 
                title="PDF - Decisão do Cmt Geral:"
                name="relato_cmtgeral_file"
                proc="ipm"
                idp="{{$proc['id_ipm']}}"
                :ext="['pdf']" 
                :candelete="{{session('is_admin')}}"
                ></file-upload>
                <v-item-unique title="Data" proc="ipm" idp="{{$proc['id_ipm']}}" name="relato_cmtgeral_data"></v-item-unique>
                <v-item-unique title="Conclusão do Cmt. Geral" proc="ipm" idp="{{$proc['id_ipm']}}" name="relato_cmtgeral"></v-item-unique>
                
                <file-upload 
                    title="Relatório complementar"
                    name="relcomplemtentar_file"
                    proc="ipm"
                    idp="{{$proc['id_ipm']}}"
                    :ext="['pdf']" 
                    :candelete="{{session('is_admin')}}"
                    >
                </file-upload>
                <v-item-unique title="Data" proc="ipm" idp="{{$proc['id_ipm']}}" name="relato_cmtgeral_data"></v-item-unique>
            </v-tab-item>
            <v-tab-item title="Membros" idp="membros">
                <v-membro idp="{{$proc['id_ipm']}}"></v-membro>
            </v-tab-item>
            <v-tab-item title="Movimentos" idp="movimentos">
                <v-movimento idp="{{$proc['id_ipm']}}" opm="{{session('opm_descricao')}}" rg="{{session('rg')}}" :admin="{{session('is_admin')}}"></v-movimento>
            </v-tab-item>
            <v-tab-item title="Sobrestamentos" idp="sobrestamentos">
                <v-sobrestamento idp="{{$proc['id_ipm']}}" ></v-sobrestamento>
            </v-tab-item>
            <v-tab-item title="Encaminhamentos" idp="encaminhamentos">
                Encaminhamentos
            </v-tab-item>
            <v-tab-item title="Vajme" idp="vajme">
                <v-item-unique title="Referência da Vajme (Nº do processo, vara)" proc="ipm" idp="{{$proc['id_ipm']}}" name="vajme_ref"></v-item-unique>
                <v-item-unique title="Referência da Justiça Comum (Nº do processo, vara)" proc="ipm" idp="{{$proc['id_ipm']}}" name="justicacomum_ref"></v-item-unique>
            </v-tab-item>
            <v-tab-item title="Arquivo" idp="arquivo">
                <v-arquivo idp="{{$proc['id_ipm']}}" ></v-arquivo>
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

