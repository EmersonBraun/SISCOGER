@extends('adminlte::page')

@section('title', 'Punidos')

@section('content_header')
@include('policiais.punido.list.menu', ['title' => 'Gerais','page' => 'geral'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Punições - Gerais</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>RG</th>
                            <th class='col-xs-1 col-md-1'>Nome</th>
                            <th class='col-xs-1 col-md-1'>Data punição</th>
                            <th class='col-xs-1 col-md-1'>Ultimo dia</th>
                            <th class='col-xs-1 col-md-1'>Gradação</th>
                            <th class='col-xs-1 col-md-1'>Punição</th>
                            <th class='col-xs-1 col-md-1'>Dias</th>
                            <th class='col-xs-1 col-md-1'>OPM</th>
                            <th class='col-xs-1 col-md-1'>Comportamento</th>
                            <th class='col-xs-1 col-md-1'>Procedimento</th>
                            <th class='col-xs-2 col-md-2'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro->id_punicao}}</td>
                            <td><a href="{{route('fdi.show',$registro->rg)}}" target="_blanck">{{$registro->rg}}</a></td>
                            <td>{{$registro->cargo}} {{$registro->nome}}</td>
                            <td>{{$registro->punicao_data}}</td>
                            <td>{{$registro->ultimodia_data}}</td>
                            <td>{{$registro->present()->gradacao}}</td>
                            <td>{{$registro->present()->classpunicao}}</td>
                            <td>{{$registro->dias}}</td>
                            <td>{{$registro->opm_abreviatura}}</td>
                            <td>{{$registro->present()->comportamento}}</td>
                            @if(hasPermissionTo('editar-'.$registro->procedimento))
                                <td>
                                    <a href="{{route($registro->procedimento.'.edit',['ref' =>$registro->sjd_ref, 'ano' => $registro->sjd_ref_ano])}}" target="_blanck">
                                        {{$registro->procedimento}} {{$registro->sjd_ref}}/{{$registro->sjd_ref_ano}}
                                    </a>
                                </td>
                            @else  
                                <td>{{$registro->procedimento}} {{$registro->sjd_ref}}/{{$registro->sjd_ref_ano}}</td>
                            @endif
                            <td>
                                <span>
                                    @if(!$registro->id_punicao && hasPermissionTo('criar-punidos'))
                                    <a class="btn btn-secondary"
                                        href="{{route('punido.create',['rg' => $registro->rg, 'proc' => $registro->procedimento, 'sjd_ref' => $registro->sjd_ref, 'sjd_ref_ano' => $registro->sjd_ref_ano])}}">Criar</a>
                                    @endif
                                    @if($registro->id_punicao && hasPermissionTo('editar-punidos'))
                                    <a class="btn btn-info"
                                        href="{{route('punido.edit',$registro->id_punicao)}}">Editar</a>
                                    @endif
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>RG</th>
                            <th class='col-xs-1 col-md-1'>Nome</th>
                            <th class='col-xs-1 col-md-1'>Data punição</th>
                            <th class='col-xs-1 col-md-1'>Ultimo dia</th>
                            <th class='col-xs-1 col-md-1'>Gradação</th>
                            <th class='col-xs-1 col-md-1'>Punição</th>
                            <th class='col-xs-1 col-md-1'>Dias</th>
                            <th class='col-xs-1 col-md-1'>OPM</th>
                            <th class='col-xs-1 col-md-1'>Comportamento</th>
                            <th class='col-xs-1 col-md-1'>Procedimento</th>
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