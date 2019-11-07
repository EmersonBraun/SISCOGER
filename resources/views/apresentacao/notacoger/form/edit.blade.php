@extends('adminlte::page')

@section('title', 'Nota COGER - Editar')

@section('content_header')
<section class="content-header">   
  <h1>Nota COGER - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('notacoger.index')}}">Nota COGER - Lista</a></li>
  <li class="active">Nota COGER - Editar</li>
  </ol>
</section>
@stop

@section('content')
<section>
    <v-tabs nav-style="tabs" justified>
        <v-tab header="Atualizar Nota {{$proc['sjd_ref']}}/{{$proc['sjd_ref_ano']}}">
            {!! Form::model($proc,['url' => route('notacoger.update',$proc['id_notacomparecimento']),'method' => 'put']) !!}
            {!! Form::open(['url' => route('notacoger.store')]) !!}
            <v-label label="status" title="Estatus" error="{{$errors->first('status')}}">
                {!! Form::select('status',['pendente' => 'Pendente','publicada' => 'Publicada'],null, ['class' => 'form-control','required']) !!}
            </v-label>
            <v-label label="expedicao_data" title="Data" icon="fa fa-calendar" error="{{$errors->first('expedicao_data')}}">
                <v-datepicker name="expedicao_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['expedicao_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="id_tiponotacomparecimento" title="Andamento COGER" error="{{$errors->first('id_tiponotacomparecimento')}}">
                {!! Form::select('id_tiponotacomparecimento',config('sistema.tipoNotaComparecimento'),null, ['class' => 'form-control','required']) !!}
            </v-label>
            <file-upload 
                        title="Arquivo PDF:"
                        name="nota_file"
                        proc="notacomparecimento"
                        idp="{{$proc['id_notacomparecimento']}}"
                        :ext="['pdf']" 
                        :candelete="{{session('is_admin')}}"
                        ></file-upload>
            <v-label label="observacao_txt" title="Sintese" lg="12" md="12" error="{{$errors->first('observacao_txt')}}">
                {!! Form::textarea('observacao_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
            </v-label>            
            {!! Form::submit('Editar Nota COGER',['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </v-tab>
        <v-tab header="Inserir Apresentações">
            <v-form-apresentacao-nota :id_notacomparecimento="{{$proc['id_notacomparecimento']}}"></v-form-apresentacao-nota>
        </v-tab>
    </v-tabs>
</section>
@stop

@section('css')
@stop

@section('js')
@include('vendor.adminlte.includes.vue')
@stop
                