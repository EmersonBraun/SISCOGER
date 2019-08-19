@extends('adminlte::page')

@section('title', 'Presos')

@section('content_header')
@include('policiais.preso.list.menu', ['title' => 'Preso','page' => 'lista'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Presos</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2 col-md-2'>Nome</th>
                            <th class='col-xs-1 col-md-1'>OPM Atual</th>
                            <th class='col-xs-1 col-md-1'>Local</th>
                            <th class='col-xs-1 col-md-1'>Local Prisão</th>
                            <th class='col-xs-1 col-md-1'>Tipo</th>
                            <th class='col-xs-1 col-md-1'>Início</th>
                            <th class='col-xs-1 col-md-1'>Término</th>
                            <th class='col-xs-1 col-md-1'>Vara/Comarca</th>
                            <th class='col-xs-1 col-md-1'>Artigo</th>
                            <th class='col-xs-2 col-md-2'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro->id_preso}}</td>
                            <td><a href="{{route('fdi.show',$registro->rg)}}">{{$registro->nome}}</a></td>
                            <td>{{$registro->present()->opmatual}}</td>
                            <td>{{$registro->local}}</td>
                            <td>{{$registro->local}} {{$registro->localreclusao}}</td>
                            <td>{{$registro->present()->presotipo}}</td>
                            <td>{{$registro->inicio_data}}</td>
                            <td>{{$registro->fim_data}}</td>
                            <td>{{$registro->vara}}</td>
                            <td>{{$registro->complemento}}</td>
                            <td>
                                <span>
                                    {{-- @if(hasPermissionTo('ver-presos'))
                                    <a class="btn btn-default"
                                        href="{{route('preso.show',$registro->id_preso)}}"><i
                                            class="fa fa-fw fa-eye "></i></a>
                                    @endif --}}
                                    @if(hasPermissionTo('editar-presos'))
                                    <a class="btn btn-info"
                                        href="{{route('preso.edit',$registro->id_preso)}}"><i
                                            class="fa fa-fw fa-edit "></i></a>
                                    @endif
                                    @if(hasPermissionTo('apagar-presos'))
                                    <a class="btn btn-danger"
                                        href="{{route('preso.destroy',$registro->id_preso)}}"
                                        onclick="return confirm('Tem certeza que quer apagar o preso?')"><i
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
                            <th class='col-xs-2 col-md-2'>Nome</th>
                            <th class='col-xs-1 col-md-1'>OPM Atual</th>
                            <th class='col-xs-1 col-md-1'>Local</th>
                            <th class='col-xs-1 col-md-1'>Local Prisão</th>
                            <th class='col-xs-1 col-md-1'>Tipo</th>
                            <th class='col-xs-1 col-md-1'>Início</th>
                            <th class='col-xs-1 col-md-1'>Término</th>
                            <th class='col-xs-1 col-md-1'>Vara/Comarca</th>
                            <th class='col-xs-1 col-md-1'>Artigo</th>
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
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop