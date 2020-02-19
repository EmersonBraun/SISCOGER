@extends('adminlte::page')

@section('title', 'IT - Lista')

@section('content_header')
@include('procedimentos.it.list.menu', ['title' => 'Apagados','page' => 'apagados'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Inquérito Técnico</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2 col-md-2'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>OPM</th>
                            <th class='col-xs-2 col-md-2'>Objeto proc.</th>
                            <th class='col-xs-4 col-md-4'>Sintese</th>
                            <th class='col-xs-2 col-md-2'>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro['id_it']}}</td>
                            <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                            <td>{{opm($registro['cdopm'])}}</td>
                            <td>{{$registro['objetoprocedimento']}}</td>
                            <td>{{$registro['sintese_txt']}}</td>
                            <td>
                                <span>
                                    {{-- <a class="btn btn-default2" href="{{route('it.show',$registro['id_it'])}}"><i
                                        class="fa fa-fw fa-eye "></i></a> --}}
                                    <a class="btn btn-info"
                                    href="{{route('it.restore',$registro['id_it'])}}"><i
                                        class="fa fa-fw fa-recycle "></i></a>
                                    <a class="btn btn-danger"
                                        href="{{route('it.forceDelete',$registro['id_it'])}}"
                                        onclick="return confirm('Tem certeza que quer apagar o DEFINITIVO o it?')"><i
                                            class="fa fa-fw fa-trash"></i></a>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2 col-md-2'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>OPM</th>
                            <th class='col-xs-2 col-md-2'>Objeto proc.</th>
                            <th class='col-xs-4 col-md-4'>Sintese</th>
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