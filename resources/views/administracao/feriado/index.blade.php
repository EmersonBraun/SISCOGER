@extends('adminlte::page')

@section('title', 'Feriado')

@section('content_header')
@include('administracao.feriado.menu')
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Feriados</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-3 col-md-3'>Data</th>
                            <th class='col-xs-3 col-md-3'>Dia da semana</th>
                            <th class='col-xs-3 col-md-3'>Descrição</th>
                            <th class='col-xs-2 col-md-2'>Ações</th>     
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                            <tr>
                            <td style="display: none">{{$registro->id_feriado}}</td>
                            <td>{{$registro->data}}</td>
                            <td>{{$registro->present()->dayOfWeek}}</td>
                            <td>{{$registro->feriado}}</td>
                            <td>
                                <span>
                                    @if(hasPermissionTo('editar-feriados'))
                                    <a class="btn btn-info" href="{{route('feriado.edit',$registro->id_feriado)}}"><i class="fa fa-fw fa-edit "></i></a>
                                    @endif
                                    @if(hasPermissionTo('apagar-feriados'))
                                    <a class="btn btn-danger"  href="{{route('feriado.destroy',$registro->id_feriado)}}" onclick="return confirm('Tem certeza que quer apagar o Feriado?')"><i class="fa fa-fw fa-trash-o "></i></a>
                                    @endif
                                </span>
                            </td>   
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-3 col-md-3'>Data</th>
                            <th class='col-xs-3 col-md-3'>Dia da semana</th>
                            <th class='col-xs-3 col-md-3'>Descrição</th>
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