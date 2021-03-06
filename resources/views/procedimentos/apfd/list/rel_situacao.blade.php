@extends('adminlte::page')

@section('title', 'APFD - Rel. Sit.')

@section('content_header')
@include('procedimentos.apfd.list.menu', ['title' => 'Rel. Situação','page' => 'rel_situacao'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Autos de prisão em flagrante delito</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>N°</th>
                            <th class='col-xs-1 col-md-1'>OPM</th>
                            <th class='col-xs-2 col-md-2'>Policial</th>
                            <th class='col-xs-1 col-md-1'>Fato</th>
                            <th class='col-xs-1 col-md-1'>Crime</th>
                            <th class='col-xs-2 col-md-2'>Especificar</th>
                            <th class='col-xs-2 col-md-2'>Publicação</th>
                            <th class='col-xs-2 col-md-2'>Andamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro['id_apfd']}}</td>
                            <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                            <td>{{opm($registro['cdopm'])}}</td>
                            <td>{{$registro['cargo']}} {{special_ucwords($registro['nome'])}}</td>
                            <td>{{data_br($registro['fato_data']) }}</td>
                            <td>{{$registro['tipo']}}</td>
                            @if($registro["tipo_penal_novo"]=="Outros")
                            <td>{{$registro['especificar']}}</td>
                            @else
                            <td>{{$registro['tipo_penal_novo']}}</td>
                            @endif
                            <td>{{$registro['doc_tipo']}}
                                @if($registro['doc_numero'] != '') nº:{{$registro['doc_numero']}} @else s/nº @endif
                            </td>
                            <td>{{sistema('andamentocoger',$registro['id_andamentocoger'])}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>N°</th>
                            <th class='col-xs-1 col-md-1'>OPM</th>
                            <th class='col-xs-2 col-md-2'>Policial</th>
                            <th class='col-xs-1 col-md-1'>Fato</th>
                            <th class='col-xs-1 col-md-1'>Crime</th>
                            <th class='col-xs-2 col-md-2'>Especificar</th>
                            <th class='col-xs-2 col-md-2'>Publicação</th>
                            <th class='col-xs-2 col-md-2'>Andamento</th>
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