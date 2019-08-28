@extends('adminlte::page')

@section('title', 'SAI - Andamento')

@section('content_header')
@include('policiais.sai.list.menu', ['title' => 'Andamento','page' => 'andamento'])
@stop
        
@section('content')
<div class="">
    <section class="">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Listagem de SAI</h3>
                    </div>
                    <div class="box-body">
                        <table id="datable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="display: none">#</th>
                                    <th class='col-xs-1 col-md-1'>N°/Ano</th>
                                    <th class='col-xs-1 col-md-1'>OPM</th>
                                    <th class='col-xs-1 col-md-1'>Data</th>
                                    <th class='col-xs-2 col-md-2'>Digitador</th>
                                    <th class='col-xs-2 col-md-2'>Andamento</th>
                                    <th class='col-xs-2 col-md-2'>Andamento COGER</th>
                                    <th class='col-xs-3 col-md-3'>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registros as $registro)
                                <tr>
                                    <td style="display: none">{{$registro['id_sai']}}</td>
                                    <td>{{$registro->present()->refAno}}</td>
                                    <td>{{ $registro->opm_abreviatura}}</td>
                                    <td>{{ $registro->abertura_data}}</td>
                                    <td>{{ $registro->digitador}}</td>
                                    <td>{{ $registro->present()->andamento }}</td>
                                    <td>{{ $registro->present()->andamentocoger }}</td>
                                    <td>
                                        <span>
                                            {{-- @if(hasPermissionTo('ver-sai'))
                                            <a class="btn btn-default"
                                                href="{{route('sai.show',$registro->id_sai)}}"><i
                                                    class="fa fa-fw fa-eye "></i></a>
                                            @endif --}}
                                            @if(hasPermissionTo('editar-sai'))
                                            <a class="btn btn-info"
                                                href="{{route('sai.edit',$registro->id_sai)}}"><i
                                                    class="fa fa-fw fa-edit "></i></a>
                                            @endif
                                            @if(hasPermissionTo('apagar-sai'))
                                            <a class="btn btn-danger" href="{{route('sai.destroy',$registro->id_sai)}}"
                                                onclick="return confirm('Tem certeza que quer apagar o SAI?')"><i
                                                    class="fa fa-fw fa-trash-o "></i></a>
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <tr>
                                        <th style="display: none">#</th>
                                        <th class='col-xs-1 col-md-1'>N°/Ano</th>
                                        <th class='col-xs-1 col-md-1'>OPM</th>
                                        <th class='col-xs-1 col-md-1'>Data</th>
                                        <th class='col-xs-2 col-md-2'>Digitador</th>
                                        <th class='col-xs-2 col-md-2'>Andamento</th>
                                        <th class='col-xs-2 col-md-2'>Andamento COGER</th>
                                        <th class='col-xs-3 col-md-3'>Ações</th>
                                    </tr>
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