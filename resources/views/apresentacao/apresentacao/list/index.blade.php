@extends('adminlte::page')

@section('title', 'apresentacao')

@section('content_header')
@include('apresentacao.apresentacao.list.menu', ['title' => 'Consultas','page' => 'index','cdopm' => $cdopm, 'ano' => $ano, $mes => 'mes'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem Apresentações em Juízo</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1'>Data de comparecimento</th>
                            <th class='col-xs-1'>N°/Ano</th>
                            <th class='col-xs-1'>Situação</th>
                            <th class='col-xs-1'>Local</th>
                            <th class='col-xs-1'>RG</th>
                            <th class='col-xs-1'>Nome</th>
                            <th class='col-xs-1'>Tipo Processo</th>
                            <th class='col-xs-1'>Autos</th>
                            <th class='col-xs-1'>Data de criação</th>
                            <th class='col-xs-1'>Acusados</th>
                            <th class='col-xs-1'>OPM</th>
                            <th class='col-xs-1'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro->comparecimento_dh}}</td>
                            <td>{{$registro->comparecimento_dh}}</td>
                            <td>{{$registro->present()->refAno}}</td>
                            <td>{{$registro->present()->situacao}}</td>
                            <td>{{$registro->comparecimento_local_txt}}</td>
                            <td>{{$registro->pessoa_rg}}</td>
                            <td><b>{{$registro->pessoa_posto}}</b> {{$registro->pessoa_nome}}</td>
                            <td>{{$registro->present()->tipoProcesso}}</td>
                            <td>{{$registro->autos_numero}}<br><b>N°/Of:{{$registro->documento_de_origem}}</b></td>
                            <td>{{$registro->present()->criacao_dh}}</td>
                            <td>{{$registro->acusados}}</td>
                            <td>{{$registro->pessoa_unidade_lotacao_sigla}}</td>
                           
                            <td>
                                <span>
                                    {{-- @if(hasPermissionTo('ver-apresentacao'))
                                    <a class="btn btn-default"
                                        href="{{route('apresentacao.show',['ref' => $registro->sjd_ref, 'ano' => $registro->sjd_ref_ano])}}"><i
                                            class="fa fa-fw fa-eye "></i></a>
                                    @endif --}}
                                    @if(hasPermissionTo('editar-apresentacao'))
                                    <a class="btn btn-info"
                                        href="{{route('apresentacao.edit',['ref' => $registro->sjd_ref, 'ano' => $registro->sjd_ref_ano])}}"><i
                                            class="fa fa-fw fa-edit "></i></a>
                                    @endif
                                    @if(hasPermissionTo('apagar-apresentacao'))
                                    <a class="btn btn-danger"
                                        href="{{route('apresentacao.destroy',$registro['id_apresentacao'])}}"
                                        onclick="return confirm('Tem certeza que quer apagar o apresentacao?')"><i
                                            class="fa fa-fw fa-trash-o "></i></a>
                                    @endif
                                    <a class="btn btn-success" href="{{route('apresentacao.memorando',$registro['id_apresentacao'])}}">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1'>Data de comparecimento</th>
                            <th class='col-xs-1'>N°/Ano</th>
                            <th class='col-xs-1'>Situação</th>
                            <th class='col-xs-1'>Local</th>
                            <th class='col-xs-1'>RG</th>
                            <th class='col-xs-1'>Nome</th>
                            <th class='col-xs-1'>Tipo Processo</th>
                            <th class='col-xs-1'>Autos</th>
                            <th class='col-xs-1'>Data de criação</th>
                            <th class='col-xs-1'>Acusados</th>
                            <th class='col-xs-1'>OPM</th>
                            <th class='col-xs-1'>Ações</th>
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