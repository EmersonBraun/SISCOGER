@extends('adminlte::page')

@section('title', 'Excluidos - Conselhos')

@section('content_header')
@include('policiais.excluido.list.menu', ['title' => 'Conselhos','page' => 'conselho'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Para figurar nesta lista, o militar deve ser marcado como 'Excluido' em um dos seguintes procedimentos: CD, CJ ou ADL</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2 col-md-2'>Nome</th>
                            <th class='col-xs-1 col-md-1'>Procedimento</th>
                            <th class='col-xs-2 col-md-2'>Situação</th>
                            <th class='col-xs-2 col-md-2'>Decorrência</th>
                            <th class='col-xs-2 col-md-2'>Portaria de Exclusao</th>
                            <th class='col-xs-1 col-md-1'>Boletim Geral</th>
                            <th class='col-xs-2 col-md-2'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                            <td style="display: none">{{$registro['rg']}}</td>
                            <td><a href="{{route('fdi.show',$registro['rg'])}}">{{$registro['cargo']}} {{$registro['nome']}}</a></td>
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
                            <td>
                                @if($registro[$proc."_sit"] == '1')
                                    Em serviço ou atendimento de ocorrência
                                @else 
                                    Fora de serviço ou outras circunstâncias
                                @endif
                                {{-- {{sistema($registro[$proc."_sit"],'situacaoOCOR')}} --}}
                            </td>
                            <td>{{sistema($registro[$proc."_decorr"],'decorrenciaConselho')}} 
                                @if($registro[$proc."_om"]) {{$registro[$proc."_om"] ?? ''}} @endif
                            </td>
                            <td>Nº {{$registro['exclusaoportaria_numero']}} de {{data_br($registro['exclusaoportaria_data']) }}</td>
                            <td>BG N° {{$registro['exclusaobg_numero']}}/{{$registro['exclusaobg_ano']}} de {{data_br($registro['exclusaobg_data'])}}</td>

                            <td>
                                <span>
                                    {{-- @if(hasPermissionTo('ver-nota-coger'))
                                    <a class="btn btn-default"
                                        href="{{route('notacoger.show',$registro['id_envolvido'])}}"><i
                                            class="fa fa-fw fa-eye "></i></a>
                                    @endif --}}
                                    @if(hasPermissionTo('editar-envolvido'))
                                    <a class="btn btn-info"
                                        href="{{route('excluido.edit',$registro['id_envolvido'])}}"><i
                                            class="fa fa-fw fa-edit "></i></a>
                                    @endif
                                    @if(hasPermissionTo('apagar-envolvido'))
                                    <a class="btn btn-danger"
                                        href="{{route('excluido.destroy',$registro['id_envolvido'])}}"
                                        onclick="return confirm('Tem certeza que quer apagar o notacoger?')"><i
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
                            <th class='col-xs-2 col-md-2'>Nome</th>
                            <th class='col-xs-1 col-md-1'>Procedimento</th>
                            <th class='col-xs-2 col-md-2'>Situação</th>
                            <th class='col-xs-2 col-md-2'>Decorrência</th>
                            <th class='col-xs-2 col-md-2'>Portaria de Exclusao</th>
                            <th class='col-xs-1 col-md-1'>Boletim Geral</th>
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