@extends('adminlte::page')

@section('title', 'Reintegrados')

@section('content_header')
@include('policiais.reintegrado.list.menu', ['title' => 'Apagados','page' => 'apagados'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Reintegrados</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2 col-md-2'>RG</th>
                            <th class='col-xs-3 col-md-3'>Nome</th>
                            <th class='col-xs-2 col-md-2'>Motivo</th>
                            <th class='col-xs-2 col-md-2'>Boletim Geral</th>
                            <th class='col-xs-3 col-md-3'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro->id_reintegrado}}</td>
                            <td><a href="{{route('fdi.show',$registro->rg)}}" target="_blanck">{{$registro->rg}}</a></td>
                            <td>{{$registro->nome}}</td>
                            <td>{{$registro->motivo}}</td>
                            <td>{{$registro->bg_numero}}/{{$registro->bg_ano}}</td>
                            <td>
                                <span>
                                    <a class="btn btn-info" href="{{route('reintegrado.restore',$registro->id_reintegrado)}}"><i
                                            class="fa fa-recycle"></i></a>
                                    <a class="btn btn-danger" href="{{route('reintegrado.forceDelete',$registro->id_reintegrado)}}"
                                        onclick="return  confirm('Tem certeza que quer apagar DEFINITIVO o Reintegrado?')"><i
                                            class="fa fa-fw fa-trash-o "></i></a>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2 col-md-2'>RG</th>
                            <th class='col-xs-3 col-md-3'>Nome</th>
                            <th class='col-xs-2 col-md-2'>Motivo</th>
                            <th class='col-xs-2 col-md-2'>Boletim Geral</th>
                            <th class='col-xs-3 col-md-3'>Ações</th>
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