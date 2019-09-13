@extends('adminlte::page')

@section('title', 'Arquivamento - Criar')

@section('content_header')
<section class="content-header">   
  <h1>Arquivamento - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Arquivamento - Criar</li>
  </ol>
</section>

</v-select>
@stop

@section('content')
<section class="">
    <div class="tab-content">
        <v-tab-item title="Formulário principal" idp="principal" cls="active show">
            {!! Form::open(['url' => route('arquivamento.save')]) !!}
                <v-label label="local_atual" title="Local">
                    {!! Form::select('local_atual',
                    ['Arquivo COGER'=>'Arquivo COGER','Arquivo Geral(PMPR)' => 'Arquivo Geral(PMPR)','Cautela (Saída)' =>'Cautela (Saída)'],'Arquivo COGER', 
                    ['class' => 'form-control ']) !!}
                </v-label>
                <v-label label="numero" title="Número">
                    {{ Form::selectRange('numero',1,100, $numero, ['class' => 'form-control ']) }}
                </v-label>
                <v-label label="letra" title="Letra">
                        {!! Form::select('letra',
                        ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'],$letra, 
                        ['class' => 'form-control ']) !!}
                </v-label>
                <v-label label="obs" title="Observações" lg="12" md="12">
                    {!! Form::textarea('obs',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
                </v-label>
            
            {{-- <v-label label="data" title="Data de início" icon="fa fa-calendar">
                <v-datepicker name="data" placeholder="dd/mm/aaaa" clear-button value="{{$proc['data'] ?? ''}}"></v-datepicker>
            </v-label>
            
            <v-label label="bou_ano" title="BOU (Ano)">
                <v-ano ano="{{$proc['bou_ano'] ?? date('Y')}}"></v-ano>
            </v-label> --}}
            
            {!! Form::submit('Inserir Arquivamento',['class' => 'btn btn-primary btn-block']) !!}
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

