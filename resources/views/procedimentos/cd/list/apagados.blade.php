@extends('adminlte::page')

@section('title', 'CD - Lista')

@section('content_header')
@include('procedimentos.cd.list.menu', ['title' => 'Apagados','page' => 'apagados'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Conselhos de Disciplina</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2 col-md-2'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>Motivo</th>
                            <th class='col-xs-6 col-md-6'>Sintese</th>
                            <th class='col-xs-2 col-md-2'>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro['id_cd']}}</td>
                            <td class='col-xs-2 col-md-2'>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                            @if($registro['id_decorrenciaconselho'] == 13)
                            <td>Outros ({{$registro['outromotivo']}})</td>
                            @else
                            <td>{{sistema('decorrenciaConselho',$registro['id_decorrenciaconselho'])}}</td>
                            @endif
                            <td class='col-xs-6 col-md-6'>{{$registro['sintese_txt']}}</td>
                            <td class='col-xs-3 col-md-3'>
                                <span>
                                    {{-- <a class="btn btn-default2" href="{{route('cd.show',$registro['id_cd'])}}"><i
                                        class="fa fa-fw fa-eye "></i></a> --}}
                                    <a class="btn btn-info"
                                    href="{{route('cd.restore',$registro['id_cd'])}}"><i
                                        class="fa fa-fw fa-recycle "></i></a>
                                    <a class="btn btn-danger"
                                        href="{{route('cd.forceDelete',$registro['id_cd'])}}"
                                        onclick="return confirm('Tem certeza que quer apagar o DEFINITIVO o cd?')"><i
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
                            <th class='col-xs-2 col-md-2'>Motivo</th>
                            <th class='col-xs-6 col-md-6'>Sintese</th>
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