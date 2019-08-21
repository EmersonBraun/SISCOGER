@extends('adminlte::page')

@section('title', 'Denunciados')

@section('content_header')
<section class="content-header nopadding">  
    <h1>Policiais Denunciados</h1>
    <h4>Para figurar nesta lista, o militar deve ser marcado como 'Denunciado' em IPM, APFD ou Deserção</h4>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Denunciados</li>
    </ol> 
</section>
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Denunciados</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2 col-md-2'>Nome</th>
                            <th class='col-xs-2 col-md-2'>OPM atual</th>
                            <th class='col-xs-2 col-md-2'>Procedimento</th>
                            <th class='col-xs-1 col-md-1'>Proc Crime</th>
                            <th class='col-xs-1 col-md-1'>Motivo</th>
                            <th class='col-xs-1 col-md-1'>Outro Motivo</th>
                            <th class='col-xs-1 col-md-1'>Julgamento</th>
                            <th class='col-xs-1 col-md-1'>T. julgado</th>
                            <th class='col-xs-1 col-md-1'>Pena</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro['rg']}}</td>
                            <td><a href="route('fdi.show',$registro['rg'])" target="_blanck">{{$registro['cargo']}} {{$registro['nome']}}</a></td>
                            <td>{{$registro['ABREVIATURA']}}</td>
                            @php $proc = $registro['proc'] @endphp
                            <td>{{$proc}} nº {{$registro[$proc."_ref"]}} / {{$registro[$proc."_ano"]}}</td>
                            <td>{{$registro['ipm_processocrime']}}</td>

                            <td>{{$registro[$proc.'_motivo'] ?? '-'}}</td>
                            <td>{{$registro[$proc.'_outro'] ?? '-'}}</td>
                            <td>{{$registro['ipm_julgamento']}}</td>
                            <td>
                            {{-- Coluna de transito julgado se aplica apenas para Condenado --}}
                            @if ($registro['ipm_julgamento'] == 'Condenado')
                                @if ($registro['ipm_transitojulgado_bl']) Sim @else Não @endif 
                            @else
                                -
                            @endif
                            </td>
                            {{-- Pena --}}
                            <td>
                            @if ($registro['ipm_julgamento']=="Condenado")
                                {{$registro['ipm_pena_anos']}}a {{$registro['ipm_pena_meses']}}m {{$registro['ipm_pena_dias']}}d {{$registro['ipm_tipodapena']}}
                            @else
                                -
                            @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2 col-md-2'>Nome</th>
                            <th class='col-xs-2 col-md-2'>OPM atual</th>
                            <th class='col-xs-2 col-md-2'>Procedimento</th>
                            <th class='col-xs-1 col-md-1'>Proc Crime</th>
                            <th class='col-xs-1 col-md-1'>Motivo</th>
                            <th class='col-xs-1 col-md-1'>Outro Motivo</th>
                            <th class='col-xs-1 col-md-1'>Julgamento</th>
                            <th class='col-xs-1 col-md-1'>T. julgado</th>
                            <th class='col-xs-1 col-md-1'>Pena</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
@stop

@section('js')
@stop