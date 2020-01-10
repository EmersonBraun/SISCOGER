@extends('adminlte::page')

@section('title', 'PAD')

@section('content_header')
@include('procedimentos.pad.list.menu', ['title' => 'Consulta','page' => 'lista'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de PAD</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1'>N°/Ano</th>
                            <th class='col-xs-1'>OPM</th>
                            <th class='col-xs-1'>Abertura</th>
                            <th class='col-xs-2'>Andamento</th>
                            <th class='col-xs-2'>Andamento COGER</th>
                            <th class='col-xs-3'>Sintese</th>
                            <th class='col-xs-2'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro['id_pad']}}</td>
                            <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                            <td>{{opm($registro['cdopm'])}}</td>
                            <td>{{data_br($registro['abertura_data'])}}</td>
                            <td>{{sistema('andamento',$registro['id_andamento'])}}</td>
                            <td>{{sistema('andamentocoger',$registro['id_andamentocoger'])}}</td>
                            <td>{{$registro['sintese_txt']}}</td>
                            <td>
                                <span>
                                    @if(hasPermissionTo('ver-pad')) 
                                    <a class="btn btn-default"
                                        href="{{route('pad.show',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i
                                            class="fa fa-fw fa-eye "></i></a>
                                    @endif
                                    @if(hasPermissionTo('editar-pad')) 
                                    <a class="btn btn-info"
                                        href="{{route('pad.edit',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i
                                            class="fa fa-fw fa-edit "></i></a>
                                    @endif
                                    @if(hasPermissionTo('apagar-pad')) 
                                    <a class="btn btn-danger" href="{{route('pad.destroy',$registro['id_pad'])}}"
                                    onclick="return confirm('Tem certeza que quer apagar?')"><i
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
                            <th class='col-xs-1'>N°/Ano</th>
                            <th class='col-xs-1'>OPM</th>
                            <th class='col-xs-1'>Abertura</th>
                            <th class='col-xs-2'>Andamento</th>
                            <th class='col-xs-2'>Andamento COGER</th>
                            <th class='col-xs-3'>Sintese</th>
                            <th class='col-xs-2'>Ações</th>
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