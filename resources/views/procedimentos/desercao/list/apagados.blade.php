@extends('adminlte::page')

@section('title', 'Deserção - Lista')

@section('content_header')
@include('procedimentos.desercao.list.menu', ['title' => 'Apagados','page' => 'apagados'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Deserção</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2 col-md-2'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>OPM</th>
                            <th class='col-xs-2 col-md-2'>Desertor</th>
                            <th class='col-xs-2 col-md-2'>RG</th>
                            <th class='col-xs-2 col-md-2'>Documento</th>
                            <th class='col-xs-2 col-md-2'>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro['id_desercao']}}</td>
                            <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                            <td>{{opm($registro['cdopm'])}}</td>
                            <td>{{$registro['nome']}}</td>
                            <td><a href="{{route('fdi.show',$registro['rg'])}}" target="_blanck">{{$registro['rg']}}</a>
                            </td>
                            <td>{{$registro['doc_tipo']}} Nº {{$registro['doc_numero']}}</td>
                            <td>
                                <span>
                                    {{-- <a class="btn btn-default2" href="{{route('desercao.show',$registro['id_desercao'])}}"><i
                                        class="fa fa-fw fa-eye "></i></a> --}}
                                    <a class="btn btn-info"
                                    href="{{route('desercao.restore',$registro['id_desercao'])}}"><i
                                        class="fa fa-fw fa-recycle "></i></a>
                                    <a class="btn btn-danger"
                                        href="{{route('desercao.forceDelete',$registro['id_desercao'])}}"
                                        onclick="return confirm('Tem certeza que quer apagar o DEFINITIVO o desercao?')"><i
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
                            <th>OPM</th>
                            <th>Desertor</th>
                            <th>RG</th>
                            <th>Documento</th>
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
@stop

@section('js')
@stop