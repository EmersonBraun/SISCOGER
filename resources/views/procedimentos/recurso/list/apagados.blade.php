@extends('adminlte::page')

@section('title', 'RECURSOS - Lista')

@section('content_header')
@include('procedimentos.recurso.list.menu', ['title' => 'Apagados','page' => 'apagados'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Recursos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2 col-md-2'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>Proc.</th>
                            <th class='col-xs-2 col-md-2'>OPM</th>
                            <th class='col-xs-4 col-md-4'>Data-hora do recebimento</th>
                            <th class='col-xs-2 col-md-2'>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro['id_recurso']}}</td>
                            <td>{{$registro['sjd_ref']}} / {{$registro['sjd_ref_ano']}}</td>
                            <td>{{$registro['procedimento']}}</td>
                            <td>{{opm($registro['cdopm'])}}</td>
                            <td>{{date( 'd/m/Y H:i:s' , strtotime($registro['datahora']))}}</td>
                            <td>
                                <span>
                                    {{-- <a class="btn btn-default" href="{{route('recurso.show',$registro['id_recurso'])}}"><i
                                        class="fa fa-fw fa-eye "></i></a> --}}
                                    <a class="btn btn-info"
                                    href="{{route('recurso.restore',$registro['id_recurso'])}}"><i
                                        class="fa fa-fw fa-recycle "></i></a>
                                    <a class="btn btn-danger"
                                        href="{{route('recurso.forceDelete',$registro['id_recurso'])}}"
                                        onclick="return confirm('Tem certeza que quer apagar o DEFINITIVO o recurso?')"><i
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
                            <th class='col-xs-2 col-md-2'>Proc.</th>
                            <th class='col-xs-2 col-md-2'>OPM</th>
                            <th class='col-xs-4 col-md-4'>Data-hora do recebimento</th>
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