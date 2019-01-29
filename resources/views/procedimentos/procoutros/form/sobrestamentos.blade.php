@extends('adminlte::page')

@section('title', 'fatd - Sobrestamentos')

@section('content_header')
<section class="content-header">   
  <h1>FATD - Sobrestamentos</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('fatd.lista',['ano' => date('Y')])}}">Fatd - Lista</a></li>
  <li><a href="{{route('fatd.edit',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])}}">Fatd - Editar</a></li>
  <li class="active">FATD - Sobrestamentos</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
    <div class='btn-group col-md-8 col-xs-12 ' style='padding-left: 0px'>
        <a class="btn btn-default col-md-3 col-xs-4 "  href="#">Editar</a>
        <a class="btn btn-default col-md-3 col-xs-4 "  href="{{route('fatd.movimentos',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])}}">Movimentos</a>
        <a class="btn btn-success col-md-3 col-xs-4 "  href="{{route('fatd.sobrestamentos',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])}}">Sobrestamentos</a>   
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
        <h3>Formulário de Transgressão Disciplinar - Nº {{ $proc['sjd_ref'] }} / {{ $proc['sjd_ref_ano'] }}</h3>
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
            <div class="col-md-6 col-xs-12">
                <p><strong>Andamento:</strong></p><p> {{ sistema('andamentoFATD',$proc['id_andamento']) }}</p>
            </div>
            <div class="col-md-6 col-xs-12">
                <p><strong>Andamento COGER:</strong></p><p> {{ sistema('andamentocogerFATD',$proc['id_andamentocoger']) }}</p>
            </div>

            <div class="col-md-12 col-xs-12">
                <p><strong>Documentos de origem:</strong></p><p> {{ $proc['doc_origem_txt'] }}</p>
            </div>

            <div class="col-md-6 col-xs-12">
                <p><strong>Data do fato:</strong></p><p> {{ date('d/m/Y',strtotime($proc['fato_data'])) }}</p>
            </div>
            <div class="col-md-6 col-xs-12">
                <p><strong>OPM/OBM:</strong></p><p> {{ opm($proc['cdopm']) }}</p>
            </div>

            <div class="col-md-4 col-xs-12">
                <p><strong>Motivo:</strong></p><p> {{ sistema('motivoFATD',$proc['motivo_fatd']) }}</p>
            </div>
            <div class="col-md-4 col-xs-12">
                <p><strong>Outros Motivos:</strong></p>
                @if($proc['motivo_outros'] != '')
                    <p> {{ $proc['motivo_outros'] }}</p>
                @else
                    <p>Não há</p>
                @endif
            </div>
            <div class="col-md-4 col-xs-12">
                <p><strong>Situação:</strong></p><p> {{ sistema('situacaoOCOR',$proc['situacao_fatd']) }}</p>
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
                                    <div class="col-md-2 col-xs-2">{{data_br($sobrestamento->inicio_data)}}</div> 
                                    <div class="col-md-2 col-xs-2">({{$sobrestamento->publicacao_inicio}})</div>
                                    <div class="col-md-2 col-xs-2">{{data_br($sobrestamento->termino_data)}}</div>
                                    <div class="col-md-2 col-xs-2">({{$sobrestamento->publicacao_termino}})</div>
                                    @if($sobrestamento->motivo == '' || $sobrestamento->motivo == 'Outros')
                                        <div class="col-md-2 col-xs-2">{{$sobrestamento->motivo_outros}}</div>
                                    @else
                                        <div class="col-md-2 col-xs-2">{{$sobrestamento->motivo}}</div>
                                    @endif
                                @empty
                                    <p class="col-md-12">Não Há Sobrestamentos</p>
                                @endforelse
                        </div>
    
                    </div>   
                </div>
            </div>     
        </div>{{-- /Sobrestamentos --}}

        <div class="row">{{-- Formulário --}}
            <div class="col-xs-12">
                <div class="box">
        
                    <div class="box-body">
    
                        <div class="col-md-12 col-xs-12">
                        {!! Form::open(['url' => route('sobrestamento.inserir',['id' => $proc['id_fatd']])]) !!}
                        
                        <div class='col-md-4 col-xs-12'>
                        <i class="fa fa-calendar"></i> {!! Form::label('inicio_data', 'Data de início: ')!!} <br>
                        {!! Form::text('inicio_data','' ,['class' => 'datepicker']) !!}
                        @if ($errors->has('inicio_data'))
                            <span class="help-block">
                                <strong>{{ $errors->first('inicio_data') }}</strong>
                            </span>
                        @endif 
                        <br>             
                        </div>

                        <div class='col-md-4 col-xs-12'>
                        {!! Form::label('publicacao_inicio', 'Publicação de início: ')!!} <br>
                        {!! Form::text('publicacao_inicio','' ) !!}
                        <br>             
                        </div>

                        <div class='col-md-4 col-xs-12'>
                        {!! Form::label('doc_controle_inicio', 'N° Documento: ')!!} <br>
                        {!! Form::text('doc_controle_inicio','' ) !!}
                        <br>             
                        </div>

                        <div class='col-md-4 col-xs-12'>
                        <i class="fa fa-calendar"></i> {!! Form::label('termino_data', 'Data de término: ')!!} <br>
                        {!! Form::text('termino_data','' ,['class' => 'datepicker']) !!}
                        @if ($errors->has('termino_data'))
                            <span class="help-block">
                                <strong>{{ $errors->first('termino_data') }}</strong>
                            </span>
                        @endif 
                        <br>             
                        </div>

                        <div class='col-md-4 col-xs-12'>
                        {!! Form::label('publicacao_termino', 'Publicação de término: ')!!} <br>
                        {!! Form::text('publicacao_termino','' ) !!}
                        <br>             
                        </div>

                        <div class='col-md-4 col-xs-12'>
                        {!! Form::label('doc_controle_termino', 'N° Documento: ')!!} <br>
                        {!! Form::text('doc_controle_termino','' ) !!}
                        <br>             
                        </div>

                        <div class='col-md-12 col-xs-12'>
                        {!! Form::textarea('motivo','',['placeholder' => 'Motivo','class' => 'form-control ', 'rows' => '5']) !!}
                        <input type="hidden" name="proc" value="fatd">
                        @if ($errors->has('motivo'))
                            <span class="help-block">
                                <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('motivo') }}</strong>
                            </span>
                        @endif
                        </div>

                
                        {!! Form::submit('Inserir Sobrestamento',['class' => 'btn btn-primary btn-block']) !!}
                        {!! Form::close() !!}
                        </div>
    
                    </div>   
                </div>
            </div>     
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
</script>
@stop

