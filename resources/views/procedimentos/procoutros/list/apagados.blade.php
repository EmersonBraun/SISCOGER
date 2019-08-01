@extends('adminlte::page')

@section('title', 'PROC. OUTROS')

@section('content_header')
@include('procedimentos.procoutros.list.menu', ['title' => 'Apagados','page' => 'apagados'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de PROC. OUTROS</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>N°/Ano</th>
                            <th class='col-xs-1 col-md-1'>OPM (Abertura)</th>
                            <th class='col-xs-1 col-md-1'>OPM (Apuração)</th>
                            <th class='col-xs-6 col-md-6'>Sintese</th>
                            <th class='col-xs-1 col-md-1'>Motivo</th>
                            <th class='col-xs-2 col-md-2'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro['id_proc_outros']}}</td>
                            <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                            <td>{{opm($registro['cdopm'])}}</td>
                            <td>{{opm($registro['cdopm_apuracao'])}}</td>
                            <td>{{$registro['sintese_txt']}}</td>
                            <td>{{$registro['motivo_abertura']}}</td>
                            <td>
                                <span>
                                    {{-- <a class="btn btn-default" href="{{route('procoutro.show',$registro['id_proc_outros'])}}"><i
                                        class="fa fa-fw fa-eye "></i></a> --}}
                                    <a class="btn btn-info"
                                    href="{{route('procoutro.restore',$registro['id_proc_outros'])}}"><i
                                        class="fa fa-fw fa-recycle "></i></a>
                                    <a class="btn btn-danger"
                                        href="{{route('procoutro.forceDelete',$registro['id_proc_outros'])}}"
                                        onclick="return confirm('Tem certeza que quer apagar o DEFINITIVO o procoutro?')"><i
                                            class="fa fa-fw fa-trash"></i></a>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>N°/Ano</th>
                            <th class='col-xs-1 col-md-1'>OPM (Abertura)</th>
                            <th class='col-xs-1 col-md-1'>OPM (Apuração)</th>
                            <th class='col-xs-6 col-md-6'>Sintese</th>
                            <th class='col-xs-1 col-md-1'>Motivo</th>
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