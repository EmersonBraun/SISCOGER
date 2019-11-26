@extends('adminlte::page')

@section('title', 'Exclusão - Ver')

@section('content_header')
<section class="content-header">   
  <h1>Exclusão - Ver</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('exclusao.lista',['ano' => date('Y')])}}">Exclusão - Lista</a></li>
  <li class="active">Exclusão - Ver</li>
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
            {idp: 'encaminhamentos',name: 'Encaminhamentos'},
            {idp: 'arquivo',name: 'Arquivo'},

        ]">

        </v-tab-menu>
       
        <div class="tab-content">
            <v-tab-item title="N° {{ $proc['id_exclusaojudicial'] }} - Formulário principal" idp="principal" cls="active show">
                <v-label label="rg" title="RG" lg="3" md="3" error="{{$errors->first('rg')}}">
                    <v-show dado="{{$proc['rg']}}"></v-show>
                </v-label>
                <v-label label="nome" title="Nome" lg="3" md="3" error="{{$errors->first('nome')}}">
                    <v-show dado="{{$proc['nome']}}"></v-show>
                </v-label>
                <v-label label="cargo" title="Posto/Graduação" lg="3" md="3" error="{{$errors->first('cargo')}}">
                    <v-show dado="{{$proc['cargo']}}"></v-show>
                </v-label>
                <v-label label="situacao" title="Resultado" lg="3" md="3">
                    <v-show dado="{{sistema('procSituacao',$proc['situacao'])}}"></v-show> 
                </v-label>
                <v-label label="cdopm_quandoexcluido" title="OPM em que estava servindo quando excluído" error="{{$errors->first('cdopm_quandoexcluido')}}">
                    <v-show dado="{{$proc['cdopm_quandoexcluido']}}"></v-show>
                </v-label>
                <v-label label="id_motivoconselho" title="Motivo">
                    <v-show dado="{{sistema('motivoConselho',$proc['id_motivoconselho'])}}"></v-show> 
                </v-label>  
                <v-label label="processo" title="Processo, Nº do processo - Comarca." error="{{$errors->first('processo')}}">
                    <v-show dado="{{$proc['processo']}}"></v-show>
                </v-label>
                <v-label label="complemento" title="Artigos da Infração penal" error="{{$errors->first('complemento')}}">
                    <v-show dado="{{$proc['complemento']}}"></v-show>
                </v-label>
                <v-label label="vara" title="Vara e Comarca(Ex: 3ª Vara Criminal de Curitiba)" error="{{$errors->first('vara')}}">
                    <v-show dado="{{$proc['vara']}}"></v-show>
                </v-label>
                <v-label label="numerounico" title="Nº único" error="{{$errors->first('numerounico')}}">
                    <v-show dado="{{$proc['numerounico']}}"></v-show>
                </v-label>
                <v-label label="data" title="Data da sentença" icon="fa fa-calendar">
                    <v-show dado="{{$proc['data']}}"></v-show>
                </v-label>
                <v-label label="exclusao_data" title="Data da exclusão (data que publicou a portaria)" icon="fa fa-calendar">
                    <v-show dado="{{$proc['exclusao_data']}}"></v-show>
                </v-label>
                <v-label label="portaria_numero" title="N° Portaria">
                    <v-show dado="{{$proc['portaria_numero']}}"></v-show>
                </v-label>
                <v-label label="bg_numero" title="N° BG">
                    <v-show dado="{{$proc['bg_numero']}}"></v-show>
                </v-label>
                <v-label label="bg_ano" title="N° Boletim">
                    <v-show dado="{{$proc['bg_ano']}}"></v-show>
                </v-label>
                <v-label label="obs_txt" title="Sintese" lg="12" md="12" error="{{$errors->first('obs_txt')}}">
                    <v-show dado="{{$proc['obs_txt']}}"></v-show>
                </v-label>
            </v-tab-item>
            <v-tab-item title="Envolvidos" idp="envolvidos">
                <v-proced-origem unique dproc="exclusaojudicial" dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}"></v-proced-origem><br>           
                <v-acusado unique dproc="exclusaojudicial" idp="{{$proc['id_exclusaojudicail']}}" situacao="{{sistema('procSituacao','exclusaojudicail')}}" ></v-acusado><br>
            </v-tab-item>
            <v-tab-item title="Encaminhamentos" idp="encaminhamentos">
                Encaminhamentos
            </v-tab-item>
            <v-tab-item title="Arquivo" idp="arquivo">
                <v-arquivo unique dref="{{$proc['sjd_ref']}}" dano="{{$proc['sjd_ref_ano']}}" dproc="exclusaojudicial" idp="{{$proc['id_exclusaojudicail']}}" ></v-arquivo>
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

