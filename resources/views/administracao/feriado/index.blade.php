@extends('adminlte::page')

@section('title', 'Feriado')

@section('content_header')
<section class="content-header nopadding">  
    <h1>Feriado - Lista</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Feriado - Lista</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <div class="btn-group col-md-6 col-xs-12 nopadding">
            <a class="btn btn-success col-md-2 col-xs-2" href="{{route('feriado.index')}}">Consulta</a>
        </div>
        @can('criar-feriados')     
        <div class="col-md-6 col-xs-12 litlepadding">
            <a class="btn btn-block btn-primary" href="{{route('feriado.create')}}">
            <i class="fa fa-plus"></i> Adicionar Feriado</a>
        </div>
        @endcan
    <div>
</section>
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
                                    @can('editar-feriados') 
                                    <a class="btn btn-info" href="{{route('feriado.edit',$registro->id_feriado)}}"><i class="fa fa-fw fa-edit "></i></a>
                                    @endcan
                                    @can('apagar-feriados') 
                                    <a class="btn btn-danger"  href="{{route('feriado.destroy',$registro->id_feriado)}}" onclick="return confirm('Tem certeza que quer apagar o Feriado?')"><i class="fa fa-fw fa-trash-o "></i></a>
                                    @endcan
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