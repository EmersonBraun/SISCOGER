@extends('adminlte::page')

@section('title', 'Relatório - Elogio')

@section('content_header')
<section class="content-header">   
  <h1>Relatório de elogio policiais</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  </ol>
</section>
@stop

@section('content')
<section class="">
    <div class="tab-content">
        <v-tab-item title="Formulário principal" idp="principal" cls="active show">
            {!! Form::open(['url' => route('elogio.search')]) !!}
            @if(session('ver_todas_unidades'))
            <v-label label="cdopm" title="OPM" error="{{$errors->first('cdopm')}}">
                <v-opm cdopm="{{$proc['cdopm'] ?? ''}}"></v-opm>
            </v-label>
            @else 
                <input type="hidden" name="cdopm" value="{{session('cdopm')}}">
            @endif
            <v-label label="elogio_data_ini" title="Ano Inicial" error="{{$errors->first('elogio_data_ini')}}">
                <v-ano todos name="elogio_data_ini" ano="{{$proc['elogio_data_ini'] ?? ''}}"></v-ano>
            </v-label>
            <v-label label="elogio_data_fim" title="Ano Final" error="{{$errors->first('elogio_data_fim')}}">
                <v-ano todos name="elogio_data_fim" ano="{{$proc['elogio_data_fim'] ?? ''}}"></v-ano>
            </v-label>
            <v-label label="cargo" title="Posto/Graduação" error="{{$errors->first('cargo')}}">
                {!! Form::select('cargo',
                [
                    "SD2C" => "SD2C",
                    "SD1C" => "SD1C",
                    "CABO" => "CABO",
                    "3SGT" => "3SGT",
                    "1SGT" => "1SGT",
                    "SUBTEN" => "SUBTEN",
                    "ALUNO1A" => "ALUNO1A",
                    "ALUNO2A" => "ALUNO2A",
                    "ALUNO3A" => "ALUNO3A",
                    "ALUNO" => "ALUNO",
                    "ASPOF" => "ASPOF",
                    "2TEN" => "2TEN",
                    "1TEN" => "1TEN",
                    "CAP" => "CAP",
                    "MAJ" => "MAJ",
                    "CEL" => "CEL",
                    "TENCEL" => "TENCEL",
                    "CELAGREG" => "CELAGREG",
                ]
                ,'SD2C', ['class' => 'form-control', 'onchange' => 'isS1()','id' => 'cargo']) !!}
            </v-label> 
            <v-label slim label="tipo" md="12" lg="12">
                {!! Form::submit('Buscar',['class' => 'btn btn-primary btn-block']) !!}
            </v-label>
            {!! Form::close() !!}
        </v-tab-item>
    </div>
</section>
@stop

@section('css')
@stop

@section('js')
@include('vendor.adminlte.includes.vue')
<script>
function isS1(){
    var selector = document.getElementById('cargo');
    var value = selector[selector.selectedIndex].value;

    var selector2 = document.getElementById('cdopm');
    var opm = selector2[selector2.selectedIndex].value;

    if(!opm && value == 'SD1C') {
        alert('Para a busca de SD1C não ficar lenta escolha apenas uma OM ou um período de tempo de até 2 anos')
    } 
}
</script>
@stop

