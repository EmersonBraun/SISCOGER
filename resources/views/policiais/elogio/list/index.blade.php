@extends('adminlte::page')

@section('title', 'Elogios')

@section('content_header')
@include('policiais.elogio.list.menu',['query' => $query])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Elogios</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>RG</th>
                            <th class='col-xs-1 col-md-1'>Nome</th>
                            <th class='col-xs-1 col-md-1'>Data</th>
                            <th class='col-xs-1 col-md-1'>Publicação</th>
                            <th class='col-xs-1 col-md-1'>OPM</th>
                            <th class='col-xs-5 col-md-5'>Descrição</th>
                            <th class='col-xs-2 col-md-2'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                            <td style="display: none">{{$registro['rg']}}</td>
                            <td><a href="{{route('fdi.show',$registro['rg'])}}">{{$registro['rg']}}</a></td>
                            <td><a href="{{route('fdi.show',$registro['rg'])}}">{{$registro['cargo']}} {{$registro['nome']}}</a></td>
                            <td>{{$registro['elogio_data']}}</td>
                            <td>{{$registro['publicacao']}}</td>
                            <td>{{$registro['opm_abreviatura']}}</td>
                            <td>{{$registro['descricao_txt']}}</td>
                            <td>
                                <span>
                                    {{-- @if(hasPermissionTo('ver-nota-coger'))
                                    <a class="btn btn-default"
                                        href="{{route('notacoger.show',$registro['id_elogio'])}}"><i
                                            class="fa fa-fw fa-eye "></i></a>
                                    @endif --}}
                                    @if(hasPermissionTo('editar-elogio'))
                                    <a class="btn btn-info"
                                        href="{{route('elogio.edit',$registro['id_elogio'])}}"><i
                                            class="fa fa-fw fa-edit "></i></a>
                                    @endif
                                    @if(hasPermissionTo('apagar-elogio'))
                                    <a class="btn btn-danger"
                                        href="{{route('elogio.destroy',$registro['id_elogio'])}}"
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
                            <th class='col-xs-1 col-md-1'>RG</th>
                            <th class='col-xs-1 col-md-1'>Nome</th>
                            <th class='col-xs-1 col-md-1'>Data</th>
                            <th class='col-xs-1 col-md-1'>Publicação</th>
                            <th class='col-xs-1 col-md-1'>OPM</th>
                            <th class='col-xs-5 col-md-5'>Descrição</th>
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