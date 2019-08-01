@extends('adminlte::page')

@section('title', 'Suspenso | Apagados')

@section('content_header')
@include('policiais.suspenso.menu', ['title' => 'Consultas','page' => $page])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Suspensos - Apagados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">

                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>RG</th>
                            <th class='col-xs-1 col-md-1'>Cargo</th>
                            <th class='col-xs-1 col-md-1'>OM atual</th>
                            <th class='col-xs-1 col-md-1'>Processo</th>
                            <th class='col-xs-2 col-md-2'>Art. da Infração Penal</th>
                            <th class='col-xs-1 col-md-1'>Início</th>
                            <th class='col-xs-1 col-md-1'>Fim</th>
                            <th class='col-xs-1 col-md-1'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro->id_suspenso}}</td>
                            <td><a href="{{route('fdi.show',$registro->rg)}}" target="_blank">{{$registro->rg}}</a></td>
                            <td>{{$registro->cargo}}</td>
                            <td>{{$registro->nome}}</td>
                            <td>{{$registro->present()->opm}}</td>
                            <td>{{$registro->processo}}</td>
                            <td>{{$registro->infracao}}</td>
                            <td>{{$registro->inicio_data}}</td>
                            <td>{{$registro->fim_data}}</td>
                            <td>
                                <span>
                                    {{-- <a class="btn btn-default" href="{{route('suspenso.show',$registro['id_suspenso'])}}"><i
                                        class="fa fa-fw fa-eye "></i></a> --}}
                                    <a class="btn btn-info"
                                        href="{{route('suspenso.restore',$registro['id_suspenso'])}}"><i
                                            class="fa fa-fw fa-recycle "></i></a>
                                    <a class="btn btn-danger"
                                        href="{{route('suspenso.forceDelete',$registro['id_suspenso'])}}"
                                        onclick="return confirm('Tem certeza que quer apagar o DEFINITIVO o Suspenso?')"><i
                                            class="fa fa-fw fa-trash"></i></a>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>RG</th>
                            <th class='col-xs-1 col-md-1'>Cargo</th>
                            <th class='col-xs-1 col-md-1'>OM atual</th>
                            <th class='col-xs-1 col-md-1'>Processo</th>
                            <th class='col-xs-2 col-md-2'>Art. da Infração Penal</th>
                            <th class='col-xs-1 col-md-1'>Início</th>
                            <th class='col-xs-1 col-md-1'>Fim</th>
                            <th class='col-xs-1 col-md-1'>Ações</th>
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