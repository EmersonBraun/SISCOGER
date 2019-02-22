@extends('adminlte::page')

@section('title', 'ADL - Movimentos')

@section('content_header')
<section class="content-header">   
  <h1>{{ strtoupper('adl') }} - Movimentos</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('adl.lista',['ano' => date('Y')])}}">{{ sistema('procedimentosTipos',strtoupper('adl')) }} - Lista</a></li>
  <li><a href="{{route('adl.edit',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])}}">{{ sistema('procedimentosTipos',strtoupper('adl')) }} - Editar</a></li>
  <li class="active">{{ sistema('procedimentosTipos',strtoupper('adl')) }} - Movimentos</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
    <div class='btn-group col-md-8 col-xs-12 ' style='padding-left: 0px'>
        <a class="btn btn-default col-md-4 col-xs-4 "  href="{{route('adl.edit',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])}}">Editar</a>
        <a class="btn btn-success col-md-4 col-xs-4 "  href="{{route('adl.movimentos',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])}}">Movimentos</a>
        <a class="btn btn-default col-md-4 col-xs-4 "  href="{{route('adl.sobrestamentos',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])}}">Sobrestamentos</a>   
    </div>
    <div class="form-group col-md-4"> 
        <a class="btn btn-default col-md-6 col-xs-6"  href="#" onclick="expandirTudo()">Expandir tudo</a>
        <a class="btn btn-default col-md-6 col-xs-6"  href="#" onclick="recolherTudo()">Recolher Tudo</a>
    </div>
  <div>
</section>
@stop

@section('content')

<div class="">
<section class="">
        <div class="col-md-8">
        <h3>{{ nome_ext('adl') }} - Nº {{ $proc['sjd_ref'] }} / {{ $proc['sjd_ref_ano'] }}</h3>
        </div>
        
    <div class="row">

    <div class="col-xs-12"> 
        <div class="box">
            <div class="box-header">
                {{-- sjd_ref / sjd_ref_ano --}}
                <h2 class="box-title">Formulário principal</h2>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button> 
                </div>             
            </div>

        <div class="box-body">    
            <div class="col-md-4 col-xs-12">
                <p><strong>OM de origem:</strong></p><p> {{ OPM($proc['cdopm']) }}</p>
            </div>           
            <div class="col-md-4 col-xs-12">
                <p><strong>Andamento:</strong></p><p> {{ sistema('andamento',$proc['id_andamento']) }}</p>
            </div>
            <div class="col-md-4 col-xs-12">
                <p><strong>Andamento COGER:</strong></p><p> {{ sistema('andamentocoger',$proc['id_andamentocoger']) }}</p>
            </div>

            <div class="col-md-6 col-xs-12">
                <p><strong>Data do fato:</strong></p><p> {{ $proc['fato_data'] }}</p>
            </div>

            <div class="col-md-6 col-xs-12">
                <p><strong>Data de abertura:</strong></p><p> {{ $proc['abertura_data'] }}</p>
            </div>

            <div class="col-md-12 col-xs-12">
                <p><strong>Sintese do fato:</strong></p><p> {{ $proc['sintese_txt'] }}</p>
            </div>
        </div>
    </div>{{-- procedimento principal --}}
          
    <div class="row">{{-- Movimentos --}}
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h2 class="box-title">Movimentos</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button> 
                    </div>             
                </div>
    
                <div class="box-body">
    
                    <div class="col-md-12 col-xs-12">
    
                        <div class="col-md-2 col-xs-2"><strong>Data</strong></div>
                        <div class="col-md-6 col-xs-6"><strong>Descrição</strong></div> 
                        <div class="col-md-2 col-xs-2"><strong>RG</strong></div>
                        <div class="col-md-2 col-xs-2"><strong>Nome</strong></div>
                        
                        @forelse ($movimentos as $movimento)
                        <div class="col-md-12">
                            <div class="col-md-2 col-xs-2">{{$movimento->data}}</div> 
                            <div class="col-md-6 col-xs-6">{{$movimento->descricao}}</div>
                            @if($movimento->rg != '' && $movimento->rg != NULL)
                                <div class="col-md-2 col-xs-2">{{$movimento->rg}}</div>
                                <div class="col-md-2 col-xs-2">{{special_ucwords(pm('nome',$movimento->rg))}}</div>  
                            @else
                                <div class="col-md-2 col-xs-2">Não há</div>
                                <div class="col-md-2 col-xs-2">Não há</div>
                            @endif
                        </div>
                        @empty
                            <div class="col-md-12">Não Há Movimentos</div>
                        @endforelse
                    </div>
                
                </div>   
            </div>
        </div>     
    </div>{{-- /Movimentos --}}

    @component('components.movimento',['proc' => $proc, 'name' => 'adl'])
    @endcomponent

    @component('components.listaenvolvidos',['envolvidos' => $envolvidos])
    @endcomponent

    </div>
       
        
</section>
@stop

@section('css')
@stop

@section('js')

@stop

