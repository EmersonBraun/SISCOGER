@extends('adminlte::page')

@section('title', 'Locais')

@section('content_header')
@include('apresentacao.local.list.menu', ['title' => 'Consultas','page' => 'index'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Locais</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2'>Local</th>
                            <th class='col-xs-1'>Município</th>
                            <th class='col-xs-2'>Bairro</th>
                            <th class='col-xs-2'>Logradouro</th>
                            <th class='col-xs-1'>N°</th>
                            <th class='col-xs-2'>Telefone</th>
                            <th class='col-xs-2'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro->id_localdeapresentacao}}</td>
                            <td>{{$registro->localdeapresentacao}}</td>
                            <td>{{$registro->present()->municipio}}</td>
                            <td>{{$registro->bairro}}</td>
                            <td>{{$registro->logradouro}}</td>
                            <td>{{$registro->numero}}</td>
                            <td>{{$registro->telefone}}</td>
                            <td>
                                <span>
                                    @if(hasPermissionTo('editar-locais'))
                                    <a class="btn btn-info"
                                        href="{{route('local.edit',$registro->id_localdeapresentacao)}}"><i
                                            class="fa fa-fw fa-edit "></i></a>
                                    @endif
                                    @if(hasPermissionTo('apagar-locais'))
                                    <a class="btn btn-danger"
                                        href="{{route('local.destroy',$registro->id_localdeapresentacao)}}"
                                        onclick="return confirm('Tem certeza que quer apagar o local?')"><i
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
                            <th class='col-xs-2'>Local</th>
                            <th class='col-xs-1'>Município</th>
                            <th class='col-xs-2'>Bairro</th>
                            <th class='col-xs-2'>Logradouro</th>
                            <th class='col-xs-1'>N°</th>
                            <th class='col-xs-2'>Telefone</th>
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