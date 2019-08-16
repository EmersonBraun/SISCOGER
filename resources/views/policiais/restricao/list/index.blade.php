@extends('adminlte::page')

@section('title', 'Lista de Restrições')

@section('content_header')
@include('policiais.restricao.list.menu', ['title' => 'Consultas','page' => 'index'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Lista de Restrições</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>RG</th>
                            <th class='col-xs-1 col-md-1'>Nome</th>
                            <th class='col-xs-1 col-md-1'>OM</th>
                            <th class='col-xs-1 col-md-1'>Motivo</th>
                            <th class='col-xs-1 col-md-1'>Inicio da restricao</th>
                            <th class='col-xs-1 col-md-1'>Fim da restricao</th>
                            <th class='col-xs-1 col-md-1'>Rest. arma fogo</th>
                            <th class='col-xs-1 col-md-1'>Rest. fardamento</th>
                            <th class='col-xs-1 col-md-1'>Cadastro SJD</th>
                            <th class='col-xs-1 col-md-1'>Descadastro SJD</th>
                            <th class='col-xs-2 col-md-2'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro->id_restricao}}</td>
                            <td><a href="{{route('fdi.show',$registro->rg)}}" target="_blank">{{$registro->rg}}</a></td>
                            <td>{{$registro->nome}}</td>
                            <td>{{$registro->present()->opm}}</td>
                            <td>{{$registro->origem}}</td>
                            <td>{{$registro->inicio_data}}</td>
                            <td>{{$registro->present()->fimData}}</td>
                            <td>{!!$registro->present()->restricaoArma!!}</td>
                            <td>{!!$registro->present()->restricaoFardamento!!}</td>
                            <td>{{$registro->cadastro_data}}</td>
                            <td>{{$registro->retirada_data}}</td>
                            <td>
                                <span>
                                    @if(hasPermissionTo('editar-restricoes'))
                                    <a class="btn btn-info"
                                        href="{{route('restricao.edit',$registro->id_restricao)}}"><i
                                            class="fa fa-fw fa-edit "></i></a>
                                    @endif
                                    @if(hasPermissionTo('apagar-restricoes'))
                                    <a class="btn btn-danger"
                                        href="{{route('restricao.destroy',$registro->id_restricao)}}"
                                        onclick="return confirm('Tem certeza que quer apagar a restrição?')"><i
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
                                <th class='col-xs-1 col-md-1'>Nome</th>
                                <th class='col-xs-1 col-md-1'>OM</th>
                                <th class='col-xs-1 col-md-1'>Motivo</th>
                                <th class='col-xs-1 col-md-1'>Inicio da restricao</th>
                                <th class='col-xs-1 col-md-1'>Fim da restricao</th>
                                <th class='col-xs-1 col-md-1'>Rest. arma fogo</th>
                                <th class='col-xs-1 col-md-1'>Rest. fardamento</th>
                                <th class='col-xs-1 col-md-1'>Cadastro SJD</th>
                                <th class='col-xs-1 col-md-1'>Descadastro SJD</th>
                                <th class='col-xs-2 col-md-2'>Ações</th>
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