@extends('adminlte::page')

@section('title', 'CD - Andamento ')

@section('content_header')
@include('procedimentos.cd.list.menu', ['title' => 'Andamento','page' => 'andamento'])
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
                            <th class='col-xs-1 col-md-1'>N°/Ano</th>
                            <th class='col-xs-1 col-md-1'>Fato</th>
                            <th class='col-xs-1 col-md-1'>Portaria</th>
                            <th class='col-xs-1 col-md-1'>Prescrição</th>
                            <th class='col-xs-2 col-md-2'>Presidente</th>
                            <th class='col-xs-2 col-md-2'>Andamento</th>
                            <th class='col-xs-2 col-md-2'>Andamento COGER</th>
                            <th class='col-xs-2 col-md-2'>Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro['id_cd']}}</td>
                            <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                            <td>{{data_br($registro['fato_data'])}}</td>
                            <td>{{data_br($registro['portaria_data'])}}</td>
                            <td>{{data_br($registro['prescricao_data'])}}</td>
                            <td>{{$registro['cargo']}} {{special_ucwords($registro['nome'])}}</td>
                            <td>{{sistema('andamento',$registro['id_andamento'])}}</td>
                            <td>{{sistema('andamentocoger',$registro['id_andamentocoger'])}}</td>
                            <td>
                                <span>
                                    @if(hasPermissionTo('ver-cd')) 
                                    <a class="btn btn-default2"
                                        href="{{route('cd.show',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i
                                            class="fa fa-fw fa-eye "></i></a>
                                    @endif
                                    @if(hasPermissionTo('editar-cd'))
                                    <a class="btn btn-info"
                                        href="{{route('cd.edit',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i
                                            class="fa fa-fw fa-edit "></i></a>
                                    @endif
                                    @if(hasPermissionTo('apagar-cd'))
                                    <a class="btn btn-danger" href="{{route('cd.destroy',$registro['id_cd'])}}"
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
                            <th>N°/Ano</th>
                            <th>Fato</th>
                            <th>Portaria</th>
                            <th>Presidente</th>
                            <th>Andamento</th>
                            <th>Andamento COGER</th>
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