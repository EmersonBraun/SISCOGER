@extends('adminlte::page')

@section('title', 'APFD - Lista')

@section('content_header')
@include('procedimentos.apfd.list.menu', ['title' => 'Apagados','page' => 'apagados'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Autos de prisão em flagrante delito</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>N°/Ano</th>
                            <th class='col-xs-1 col-md-1'>Tipo</th>
                            <th class='col-xs-2 col-md-2'>Tipificação</th>
                            <th class='col-xs-2 col-md-2'>OPM</th>
                            <th class='col-xs-4 col-md-4'>Sintese</th>
                            <th class='col-xs-2 col-md-2'>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro['id_apfd']}}</td>
                            <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                            <td>{{opm($registro['cdopm'])}}</td>
                            <td>{{$registro['tipo']}}</td>
                            <td>{{$registro['tipo_penal']}}/{{$registro['tipo_penal_novo']}}</td>
                            <td>{{$registro['sintese_txt']}}</td>
                            <td>
                                <span>
                                    {{-- <a class="btn btn-default2" href="{{route('apfd.show',$registro['id_apfd'])}}"><i
                                        class="fa fa-fw fa-eye "></i></a> --}}
                                    <a class="btn btn-info"
                                    href="{{route('apfd.restore',$registro['id_apfd'])}}"><i
                                        class="fa fa-fw fa-recycle "></i></a>
                                    <a class="btn btn-danger"
                                        href="{{route('apfd.forceDelete',$registro['id_apfd'])}}"
                                        onclick="return confirm('Tem certeza que quer apagar o DEFINITIVO o apfd?')"><i
                                            class="fa fa-fw fa-trash"></i></a>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th>N°/Ano</th>
                            <th>Tipo</th>
                            <th>Tipificação</th>
                            <th>OPM</th>
                            <th>Sintese</th>
                            <th>Ações</th>
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