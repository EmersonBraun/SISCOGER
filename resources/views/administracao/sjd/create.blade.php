@extends('adminlte::page')

@section('title_postfix', '| Adicionar SJD')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class='fa fa-user-plus'></i> Adicionar SJD</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('sjd.index')}}">Lista SJD</a></li>
            <li class="breadcrumb-item active">criar</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
@stop

@section('content')
<section class="">
    <div class="tab-content">
        <v-tab-item title="Inserir SJD" idp="principal" cls="active show">
            {!! Form::open(['url' => route('sjd.store')]) !!}
            <v-label label="rg" title="RG" error="{{$errors->first('rg')}}">
                <the-mask mask="#############" class="form-control" type="text" maxlength="15" name="rg" placeholder="Nº"/>
            </v-label>
            <v-label label="cpf" title="CPF" error="{{$errors->first('cpf')}}">
                <the-mask mask="###.###.###-##" class="form-control" type="text" maxlength="12" name="cpf" placeholder="Nº"/>
            </v-label>
            <v-label label="celular" title="Celular">
                <the-mask mask="#####-####" class="form-control" type="text" maxlength="12" name="celular" placeholder="Nº"/>
            </v-label>
            <v-label label="telefone_secao" title="Telefone da Seção">
                <the-mask mask="####-####" class="form-control" type="text" maxlength="12" name="telefone_secao" placeholder="Nº"/>
            </v-label>
            <v-label label="email" title="Email">
                {!! Form::email('email', null, array('class' => 'form-control','placeholder' => 'email')) !!}
            </v-label>
            <v-label label="assuncao_data" title="Data de assunção">
                <v-datepicker name="assuncao_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['assuncao_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="saida_data" title="Data de saída">
                <v-datepicker name="saida_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['saida_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="ead_inicio_data" title="Data do início EAD">
                <v-datepicker name="ead_inicio_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['ead_inicio_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="ead_fim_data" title="Data do fim EAD">
                <v-datepicker name="ead_fim_data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['ead_fim_data'] ?? ''}}"></v-datepicker>
            </v-label>
            <v-label label="ead_conclusao" title="">
                <v-checkbox name="ead_conclusao" true-value="1" false-value="0" text="Conclusão EAD"></v-checkbox>
                <v-checkbox name="cred" true-value="1" false-value="0" text="Credenciado"></v-checkbox>
                <v-checkbox name="cert" true-value="1" false-value="0" text="Certificado"></v-checkbox>
            </v-label>
            {!! Form::submit('Inserir SJD',['class' => 'btn btn-primary btn-block']) !!}
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