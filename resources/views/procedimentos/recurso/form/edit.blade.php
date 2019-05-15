@extends('adminlte::page')

@section('title', 'ADL - Editar')

@section('content_header')
<section class="content-header">   
  <h1>ADL - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('adl.lista',['ano' => date('Y')])}}">ADL - Lista</a></li>
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
        ]">

        </v-tab-menu>
       
        <div class="tab-content">
            <v-tab-item title="N° {{ $proc['sjd_ref'] }} / {{ $proc['sjd_ref_ano'] }} - Formulário principal" idp="principal" cls="active show">
                {!! Form::model($proc,['url' => route('recurso.update',$proc['id_recurso']),'method' => 'put']) !!}
                <v-label label="procedimento" title="Procedimento">
                    {!! Form::select('procedimento',[],null, ['class' => 'form-control ']) !!}
                </v-label>--arrumar--
                <v-label label="sjd_ref" title="Referência">
                    {{ Form::text('sjd_ref', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="sjd_ref_ano" title="Ano">
                    {{ Form::text('sjd_ref_ano', null, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="portaria_data" title="Data e hora do recebimento (automático)" icon="fa fa-calendar">
                    <v-datepicker name="portaria_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['portaria_data'] ?? ''}}"></v-datepicker>
                </v-label>
                {!! Form::submit('Alterar Recurso',['class' => 'btn btn-primary btn-block']) !!}
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
@stop

