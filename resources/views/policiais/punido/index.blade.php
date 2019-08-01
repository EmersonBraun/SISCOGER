@extends('adminlte::page')

@section('title', 'notacoger')

@section('content_header')
@include('procedimentos.notacoger.list.menu', ['title' => 'Consultas','page' => 'lista'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Nota COGER</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>Data</th>
                            <th class='col-xs-2 col-md-2'>Situação</th>
                            <th class='col-xs-2 col-md-2'>Descrição</th>
                            <th class='col-xs-2 col-md-2'>Arquivo</th>
                            <th class='col-xs-3 col-md-3'>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro->id_notacomparecimento}}</td>
                            @if ($registro->sjd_ref != '')
                            <td>{{$registro->sjd_ref}}/{{$registro->sjd_ref_ano}}</td>
                            @else
                            <td>{{$registro->id_notacomparecimento}}</td>
                            @endif
                            <td>{{$registro->expedicao_data}}</td>
                            <td>{{$registro->status}}</td>
                            <td>{{$registro->present()->tiponotacomparecimento}}</td>
                            <td>{{$registro->present()->nota_file}}</td>
                            <td>
                                <span>
                                    @can('ver-xx') 
                                    <a class="btn btn-default"
                                        href="{{route('adl.show',['ref' => $registro->sjd_ref, 'ano' => $registro->sjd_ref_ano])}}"><i
                                            class="fa fa-fw fa-eye "></i></a>
                                    @endcan
                                    @can('editar-xx') 
                                    <a class="btn btn-info"
                                        href="{{route('adl.edit',['ref' => $registro->sjd_ref, 'ano' => $registro->sjd_ref_ano])}}"><i
                                            class="fa fa-fw fa-edit "></i></a>
                                    @endcan
                                    @can('apagar-xx') 
                                    <a class="btn btn-danger" href="{{route('adl.destroy',$registro['id_adl'])}}"
                                        onclick="return confirm('Tem certeza que quer apagar o ADL?')"><i
                                            class="fa fa-fw fa-trash-o "></i></a>
                                    @endcan
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>Data</th>
                            <th class='col-xs-2 col-md-2'>Situação</th>
                            <th class='col-xs-2 col-md-2'>Descrição</th>
                            <th class='col-xs-2 col-md-2'>Arquivo</th>
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