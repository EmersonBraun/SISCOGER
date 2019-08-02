@extends('adminlte::page')

@section('title', 'Óbitos e lesões | Lista')

@section('content_header')
@include('policiais.obitolesao.menu', ['title' => 'Consultas','page' => 'lista'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Óbitos e lesões</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>RG</th>
                            <th class='col-xs-1 col-md-1'>Cargo</th>
                            <th class='col-xs-1 col-md-1'>Nome</th>
                            <th class='col-xs-1 col-md-1'>Data</th>
                            <th class='col-xs-1 col-md-1'>OPM</th>
                            <th class='col-xs-2 col-md-2'>Município</th>
                            <th class='col-xs-1 col-md-1'>Resultado</th>
                            <th class='col-xs-1 col-md-1'>Situação</th>
                            <th class='col-xs-1 col-md-1'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro->id_falecimento}}</td>
                            <td><a href="{{route('fdi.show',$registro->rg)}}" target="_blank">{{$registro->rg}}</a></td>
                            <td>{{$registro->cargo}}</td>
                            <td>{{$registro->nome}}</td>
                            <td>{{$registro->data}}</td>
                            <td>{{$registro->present()->opm}}</td>
                            <td>{{$registro->present()->municipio}}</td>
                            <td>{{$registro->resultado}}</td>
                            <td>{{$registro->present()->situacao}}</td>
                            <td>
                                <span>
                                    {{-- @if(hasPermissionTo('ver-obitos-lesoes'))
                                    <a class="btn btn-default" href="{{route('obitolesao.show',$registro['id_falecimento'])}}"><i
                                        class="fa fa-fw fa-eye "></i></a>
                                    @endif --}}
                                    @if(hasPermissionTo('editar-obitos-lesoes'))
                                    <a class="btn btn-info"
                                        href="{{route('obitolesao.edit',$registro['id_falecimento'])}}"><i
                                            class="fa fa-fw fa-edit "></i></a>
                                    @endif
                                    @if(('apagar-obitos-lesoes'))
                                    <a class="btn btn-danger"
                                        href="{{route('obitolesao.destroy',$registro['id_falecimento'])}}"
                                        onclick="return confirm('Tem certeza que quer apagar o obitolesao?')"><i
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
                            <th class='col-xs-1 col-md-1'>RG</th>
                            <th class='col-xs-1 col-md-1'>Cargo</th>
                            <th class='col-xs-1 col-md-1'>Nome</th>
                            <th class='col-xs-1 col-md-1'>OM atual</th>
                            <th class='col-xs-1 col-md-1'>Processo</th>
                            <th class='col-xs-2 col-md-2'>Art. da Infração Penal</th>
                            <th class='col-xs-1 col-md-1'>Início</th>
                            <th class='col-xs-1 col-md-1'>Fim</th>
                            <th class='col-xs-1 col-md-1'>Ações</th>
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