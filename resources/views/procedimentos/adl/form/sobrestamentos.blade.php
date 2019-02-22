@extends('adminlte::page')

@section('title', 'ADL - Sobrestamentos')

@section('content_header')
<section class="content-header">   
  <h1>{{ strtoupper('adl') }} - Sobrestamentos</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('adl.lista',['ano' => date('Y')])}}">{{ sistema('procedimentosTipos',strtoupper('adl')) }} - Lista</a></li>
  <li><a href="{{route('adl.edit',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])}}">{{ sistema('procedimentosTipos',strtoupper('adl')) }} - Editar</a></li>
  <li class="active">{{ sistema('procedimentosTipos',strtoupper('adl')) }} - Sobrestamentos</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
    <div class='btn-group col-md-8 col-xs-12 ' style='padding-left: 0px'>
        <a class="btn btn-default col-md-4 col-xs-4 "  href="#">Editar</a>
        <a class="btn btn-default col-md-4 col-xs-4 "  href="{{route('adl.movimentos',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])}}">Movimentos</a>
        <a class="btn btn-success col-md-4 col-xs-4 "  href="{{route('adl.sobrestamentos',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])}}">Sobrestamentos</a>   
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
        <h3>{{ sistema('procedimentosTipos',strtoupper('adl')) }} - Nº {{ $proc['sjd_ref'] }} / {{ $proc['sjd_ref_ano'] }}</h3>
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
                <p><strong>OPM/OBM:</strong></p><p> {{ opm($proc['cdopm']) }}</p>
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

        <div class="row">{{-- Sobrestamentos --}}
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h2 class="box-title">Sobrestamentos</h2>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button> 
                        </div>             
                    </div>
        
                    <div class="box-body">
    
                        <div class="col-md-12 col-xs-12">
                                <div class="col-md-2 col-xs-2"><strong>Início</strong></div>
                                <div class="col-md-2 col-xs-2"><strong>Doc. Início</strong></div> 
                                <div class="col-md-2 col-xs-2"><strong>Termino</strong></div>
                                <div class="col-md-2 col-xs-2"><strong>Doc. Término</strong></div>
                                <div class="col-md-4 col-xs-4"><strong>Motivo</strong></div>
                                
                                @forelse ($sobrestamentos as $sobrestamento)
                                    <div class="col-md-2 col-xs-2">{{ $sobrestamento->inicio_data }}</div> 
                                    <div class="col-md-2 col-xs-2">({{ $sobrestamento->publicacao_inicio }})</div>
                                    <div class="col-md-2 col-xs-2">{{ $sobrestamento->termino_data }}</div>
                                    <div class="col-md-2 col-xs-2">({{ $sobrestamento->publicacao_termino }})</div>
                                    <div class="col-md-4 col-xs-4">
                                        @if($sobrestamento->motivo == '' || $sobrestamento->motivo == 'Outros')
                                            {{ $sobrestamento->motivo_outros }}
                                        @else
                                            {{ $sobrestamento->motivo }}
                                        @endif
                                    </div>
                                @empty
                                    <div class="col-md-12">Não Há Sobrestamentos</div>
                                @endforelse
                        </div>
    
                    </div>   
                </div>
            </div>     
        </div>{{-- /Sobrestamentos --}}

        @component('components.sobrestamento',['proc' => $proc, 'name' => 'adl'])
        @endcomponent
            
        {{-- @component('components.listaenvolvidos',['envolvidos' => $envolvidos])
        @endcomponent --}}
        </div>{{-- /Formulário --}}

        
        
</section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@include('vendor.adminlte.includes.pickers')
<script>
    function expandirTudo(){
        $( ".box" ).removeClass( "collapsed-box" );
        $( ".box-body" ).show();
        $( ".fa-plus" ).removeClass( "fa-plus" ).addClass( "fa-minus" );
    }
    function recolherTudo(){
        $( ".box" ).addClass( "collapsed-box" );
        $( ".box-body" ).hide();
        $( ".fa-minus" ).removeClass( "fa-minus" ).addClass( "fa-plus" );
    }

    function outrosMotivos(){
        var motivo = $('.inputmotivo option:selected').text();
        if(motivo == 'Outros'){
            $( ".divmotivo" ).removeClass( "col-md-12" ).addClass( "col-md-6" );
            $( ".divoutros" ).show();
            $( ".divoutros" ).attr('required');
        }else{
            $( ".divmotivo" ).removeClass( "col-md-6" ).addClass( "col-md-12" );
            $( ".divoutros" ).hide();
            $( ".divoutros" ).removeAttr('required');
        }

    }

</script>
@stop

