@extends('adminlte::page')

@section('title', 'ADL - Andamento')

@section('content_header')
@include('procedimentos.adl.list.menu', ['title' => 'Andamento','page' => 'andamento'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Apuração Disciplinar de Licenciamento</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>N°/Ano</th>
                            <th class='col-xs-1 col-md-1'>Data</th>
                            <th class='col-xs-1 col-md-1'>Prescrição</th>
                            <th class='col-xs-2 col-md-2'>Encarregado</th>
                            <th class='col-xs-2 col-md-2'>Andamento</th>
                            <th class='col-xs-2 col-md-2'>Andamento COGER</th>
                            <th class='col-xs-3 col-md-3'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro['id_adl']}}</td>
                            <td>{{$registro->present()->refAno}}</td>
                            <td>{{ $registro->fato_data}}</td>
                            <td>{{ $registro->prescricao_data}}</td>
                            <td>{{ $registro->present()->cargoeENome}}</td>
                            <td>{{ $registro->present()->andamento }}</td>
                            <td>{{ $registro->present()->andamentocoger }}</td>
                            <td>
                                <span>
                                    @if(hasPermissionTo('ver-adl'))
                                    <a class="btn btn-default"
                                        href="{{route('adl.show',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i
                                            class="fa fa-fw fa-eye "></i></a>
                                    @endif
                                    @if(hasPermissionTo('editar-adl')) 
                                    <a class="btn btn-info"
                                        href="{{route('adl.edit',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i
                                            class="fa fa-fw fa-edit "></i></a>
                                    @endif
                                    @if(hasPermissionTo('apagar-adl'))
                                    <a class="btn btn-danger" href="{{route('adl.destroy',$registro['id_adl'])}}"
                                        onclick="return confirmApagar('adl',$registro['sjd_ref'],$registro['sjd_ref_ano'])"><i
                                            class="fa fa-fw fa-trash-o "></i></a>
                                    @endif
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th>N°/Ano</th>
                            <th>Data</th>
                            <th>Prescrição</th>
                            <th>Encarregado</th>
                            <th>Andamento</th>
                            <th>Andamento COGER</th>
                            <th>Ações</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop