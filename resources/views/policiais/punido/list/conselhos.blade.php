@extends('adminlte::page')

@section('title', 'Punidos')

@section('content_header')
@include('policiais.punido.list.menu', ['title' => 'Conselhos','page' => 'conselho'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Para figurar nesta lista, o militar deve ser marcado como 'Punido' em um dos seguintes procedimentos: CD, CJ ou ADL</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2 col-md-2'>Nome</th>
                            <th class='col-xs-2 col-md-2'>OPM</th>
                            <th class='col-xs-1 col-md-1'>Procedimento</th>
                            <th class='col-xs-1 col-md-1'>Situação</th>
                            <th class='col-xs-1 col-md-1'>Decorência</th>
                            <th class='col-xs-1 col-md-1'>Punição</th>
                            <th class='col-xs-1 col-md-1'>Classificação</th>
                            <th class='col-xs-1 col-md-1'>Data</th>
                            <th class='col-xs-2 col-md-2'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro['id_punicao']}}</td>
                            <td><a href="{{route('fdi.show',$registro['rg'])}}">{{$registro['cargo']}} {{$registro['nome']}}</a></td>
                            <td>{{$registro['ABREVIATURA']}}</td>
                            @php 
                                if (!empty($registro["id_adl"])) $proc="adl";
                                if (!empty($registro["id_cd"])) $proc="cd";
                                if (!empty($registro["id_cj"])) $proc="cj";
                            @endphp
                            @if(hasPermissionTo('editar-'.$proc))
                            <td><a href="{{route($proc.'.edit',['ref' => $registro[$proc."_ref"],'ano' => $registro[$proc."_ano"]])}}" target='_blanck'>
                                {{strtoupper($proc)}} n° {{$registro[$proc."_ref"]}}/{{$registro[$proc."_ano"]}}</a>
                            </td>
                            @else 
                            <td>{{strtoupper($proc)}} n° {{$registro[$proc."_ref"]}}/{{$registro[$proc."_ano"]}}</td>
                            @endif
                            <td>{{sistema($registro[$proc."_sit"],'situacaoConselho')}}</td>
                            <td>{{sistema($registro[$proc."_decorr"],'decorrenciaConselho')}} 
                                @if($registro[$proc."_om"]) {{$registro[$proc."_om"] ?? ''}} @endif
                            </td>
                            <td>{{$registro['gradacao'] ?? ''}}</td>
                            <td>{{$registro['classpunicao'] ?? ''}}</td>
                            <td>{{data_br($registro['punicao_data'])}}</td>
                            <td>
                                <span>
                                    @if(!$registro['id_punicao'] && hasPermissionTo('criar-punidos'))
                                    <a class="btn btn-secondary"
                                        href="{{route('punido.create',['rg' => $registro['rg'], 'proc' => $proc, 'id' => $registro['id_'.$proc]])}}">Criar</a>
                                    @endif
                                    @if($registro['id_punicao'] && hasPermissionTo('editar-punidos'))
                                    <a class="btn btn-info"
                                        href="{{route('punido.edit',$registro['id_punicao'])}}">Editar</a>
                                    @endif
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2 col-md-2'>Nome</th>
                            <th class='col-xs-2 col-md-2'>OPM</th>
                            <th class='col-xs-1 col-md-1'>Procedimento</th>
                            <th class='col-xs-1 col-md-1'>Situação</th>
                            <th class='col-xs-1 col-md-1'>Decorência</th>
                            <th class='col-xs-1 col-md-1'>Punição</th>
                            <th class='col-xs-1 col-md-1'>Classificação</th>
                            <th class='col-xs-1 col-md-1'>Data</th>
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