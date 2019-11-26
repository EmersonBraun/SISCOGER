@extends('adminlte::page')

@section('title', 'Exclusão - Lista')

@section('content_header')
@include('procedimentos.exclusao.list.menu', ['title' => 'Consulta','page' => 'lista'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Exclusão</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>RG</th>
                            <th class='col-xs-2 col-md-2'>Nome</th>
                            <th class='col-xs-1 col-md-1'>OPM</th>
                            <th class='col-xs-1 col-md-1'>Data Sentença</th>
                            <th class='col-xs-1 col-md-1'>Data Exclusão</th>
                            <th class='col-xs-2 col-md-2'>Artigos</th>
                            <th class='col-xs-1 col-md-1'>Portaria CG</th>
                            <th class='col-xs-1 col-md-1'>Boletim Geral</th>
                            <th class='col-xs-2 col-md-2'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro->id_exclusaojudicial}}</td>
                            <td><a href="{{route('fdi.show',$registro->rg)}}" target="_blanck">{{$registro->rg}}</a>
                            </td>
                            <td>{{$registro->cargo}} {{special_ucwords($registro->nome)}}</td>
                            <td>{{$registro->present()->opm}}</td>
                            <td>{{data_br($registro->data)}}</td>
                            <td>{{data_br($registro->exclusao_data)}}</td>
                            <td>{{$registro->complemento}}</td>
                            <td>{{$registro->portaria_numero}}</td>
                            <td>{{$registro->bg_numero}}/{{$registro->bg_ano}}</td>
                            <td>
                                <span>
                                    @if(hasPermissionTo('ver-exclusao'))
                                    <a class="btn btn-default"
                                        href="{{route('exclusao.show',$registro->id_exclusaojudicial)}}"><i
                                            class="fa fa-fw fa-eye "></i></a>
                                    @endif
                                    @if(hasPermissionTo('editar-exclusao')) 
                                    <a class="btn btn-info"
                                        href="{{route('exclusao.edit',$registro->id_exclusaojudicial)}}"><i
                                            class="fa fa-fw fa-edit "></i></a>
                                    @endif
                                    @if(hasPermissionTo('apagar-exclusao'))
                                    <a class="btn btn-danger"
                                        href="{{route('exclusao.destroy',$registro->id_exclusaojudicial)}}"
                                        onclick="return  confirmApagar('exclusao',$registro->id_exclusaojudicial)"><i
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
                            <th>RG</th>
                            <th>Nome</th>
                            <th>OPM</th>
                            <th>Data Sentença</th>
                            <th>Data Exclusão</th>
                            <th>Artigos</th>
                            <th>Portaria CG</th>
                            <th>Boletim Geral</th>
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
@stop

@section('js')
@stop