@extends('adminlte::page')

@section('title', 'PROC. OUTROS')

@section('content_header')
@include('procedimentos.procoutros.list.menu', ['title' => 'Consulta','page' => 'lista'])
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
                                    @if(hasPermissionTo('ver-proc-outros')) 
                                    <a class="btn btn-default2"
                                        href="{{route('procoutro.show',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i
                                            class="fa fa-fw fa-eye "></i></a>
                                    @endif
                                    @if(hasPermissionTo('editar-proc-outros')) 
                                    <a class="btn btn-info"
                                        href="{{route('procoutro.edit',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i
                                            class="fa fa-fw fa-edit "></i></a>
                                    @endif
                                    @if(hasPermissionTo('apagar-proc-outros'))
                                    <a class="btn btn-danger"
                                        href="{{route('procoutro.destroy',$registro['id_proc_outros'])}}"
                                        onclick="return confirm('Tem certeza que quer apagar?')"><i
                                            class="fa fa-fw fa-trash-o "></i></a>
                                    @endif
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