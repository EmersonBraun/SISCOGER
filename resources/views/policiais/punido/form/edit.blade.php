@extends('adminlte::page')

@section('title', 'Punido - Editar')

@section('content_header')
<section class="content-header">   
  <h1>Punido - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('punido.index')}}">Punido - Lista</a></li>
  <li class="active">Punido - Editar</li>
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
        <div class="tab-content">
            <v-tab-item title="Editar punido - {{$proc['nome']}}" idp="principal" cls="active show">
                {!! Form::model($proc,['url' => route('punido.update',$proc['id_punicao']),'method' => 'put']) !!}
                <input type='hidden' name='rg_cadastro' value="{{session('rg')}}">
                <input type='hidden' name='opm_abreviatura' value="{{session('opm_descricao')}}">
                <input type='hidden' name='digitador' value="{{session('nome')}}">   
                <v-label label="rg" title="RG" lg="4" md="4" >
                    {{ Form::text('rg', null, ['class' => 'form-control ','readonly']) }}
                </v-label>
                <v-label label="nome" title="Nome" lg="4" md="4" >
                    {{ Form::text('nome', null, ['class' => 'form-control ','readonly']) }}
                </v-label>
                <v-label label="cargo" title="Posto/Graduação" lg="4" md="4" >
                    {{ Form::text('cargo', null, ['class' => 'form-control ','readonly']) }}
                </v-label>
                <v-label label="apenas_para_exibir" title="OPM">
                    <v-show dado='{{$proc->OPM_DESCRICAO}}'></v-show>
                </v-label>
                <v-label label="cdopm" title="OPM da Punicao" error="{{$errors->first('cdopm')}}">
                    <v-opm name='cdopm' cdopm="{{$proc['cdopm'] ?? ''}}"></v-opm>
                </v-label>
                @if($proc['procedimento'])
                    <v-label label="procedimento" title="Procedimento" error="{{$errors->first('procedimento')}}">
                        {{ Form::text('procedimento', null, ['class' => 'form-control ','readonly']) }}
                    </v-label>
                    <v-label label="sjd_ref" title="Nº Referência" error="{{$errors->first('sjd_ref')}}">
                        {{ Form::text('sjd_ref', null, ['class' => 'form-control ','readonly']) }}
                    </v-label>
                    <v-label label="sjd_ref_ano" title="Ano" error="{{$errors->first('sjd_ref_ano')}}">
                        {{ Form::text('sjd_ref_ano', null, ['class' => 'form-control ','readonly']) }}
                    </v-label>
                @else
                    <v-label label="procedimento" title="Procedimento" error="{{$errors->first('procedimento')}}">
                    @if(hasAnyRole(['COGER']))
                        {!! Form::select('procedimento',
                            ['NA' => 'FATD S/N COGER','fatd' => 'FATD', 'cd' => 'CD', 'cj' => 'CJ','adl' => 'ADL']
                            ,null, ['class' => 'form-control ']) !!}
                    @else 
                        {!! Form::select('procedimento',['NA' => 'FATD S/N COGER','fatd' => 'FATD'],null, ['class' => 'form-control ']) !!}
                    @endif
                    </v-label>
                    <v-label label="sjd_ref" title="Nº Referência" error="{{$errors->first('sjd_ref')}}">
                        {{ Form::text('sjd_ref', null, ['class' => 'form-control ']) }}
                    </v-label>
                    <v-label label="sjd_ref_ano" title="Ano" error="{{$errors->first('sjd_ref_ano')}}">
                        {{ Form::text('sjd_ref_ano', null, ['class' => 'form-control ']) }}
                    </v-label>
                @endif
                <v-label label="punicao_data" title="Data da punição" icon="fa fa-calendar" error="{{$errors->first('punicao_data')}}">
                    <v-datepicker name="punicao_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['punicao_data'] ?? ''}}"></v-datepicker>
                </v-label>
                <v-classificacao 
                :id_gradacao="{{$proc['id_gradacao'] ?? ''}}"
                :id_classpunicao="{{$proc['id_classpunicao'] ?? ''}}"
                dias="{{$proc['dias'] ?? ''}}"
                error="{{$errors->first('id_classpunicao')}}"
                ></v-classificacao>
                <v-label label="ultimodia_data" title="Ultimo dia de cumprimento da punição" tooltip="Art. 63 RDE" icon="fa fa-calendar" error="{{$errors->first('ultimodia_data')}}">
                    <v-datepicker name="ultimodia_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['ultimodia_data'] ?? ''}}"></v-datepicker>
                </v-label>
                <v-label label="descricao_txt" title="Descrição" lg="12" md="12" error="{{$errors->first('descricao_txt')}}">
                    {!! Form::textarea('descricao_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
                </v-label>
                @if(hasPermissionTo('criar-mudanca-comportamento'))
                <v-label label="id_comportamento" title="Comportamento Decorrente" lg="12" md="12" error="{{$errors->first('id_comportamento')}}">
                    {!! Form::select('id_comportamento',config('sistema.comportamento'),null, ['class' => 'form-control ']) !!}
                </v-label>
                @endif
                {!! Form::submit('Alterar Punição',['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}
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
<script>
$(document).ready(function(){
    let val = $("#local").val();
    $('#'+val).show();
});
</script>
@stop

