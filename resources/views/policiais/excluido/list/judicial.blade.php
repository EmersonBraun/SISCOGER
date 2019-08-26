@extends('adminlte::page')

@section('title', 'Excluidos - Judicial')

@section('content_header')
@include('policiais.excluido.list.menu', ['title' => 'Judicial','page' => 'judicial'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Excluidos Judicialmente</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>Nome</th>
                            <th class='col-xs-1 col-md-1'>Procedimento</th>
                            <th class='col-xs-2 col-md-2'>OM</th>
                            <th class='col-xs-2 col-md-2'>Processo</th>
                            <th class='col-xs-2 col-md-2'>Complemento</th>
                            <th class='col-xs-2 col-md-2'>Vara</th>
                            <th class='col-xs-2 col-md-2'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                            <td style="display: none">{{$registro['rg']}}</td>
                            <td><a href="{{route('fdi.show',$registro['rg'])}}">{{$registro['cargo']}} {{$registro['nome']}}</a></td>
                            @if(hasPermissionTo('editar-'.$registro["origem_proc"]))
                            <td><a href="{{route($registro["origem_proc"].'.edit',['ref' => $registro["origem_sjd_ref"],'ano' => $registro['origem_sjd_ref_ano']])}}" target='_blanck'>
                                {{strtoupper($registro["origem_proc"])}} n° {{$registro["origem_sjd_ref"]}}/{{$registro["origem_sjd_ref_ano"]}}</a>
                            </td>
                            @else 
                            <td>{{strtoupper($registro["origem_proc"])}} n° {{$registro["origem_sjd_ref"]}}/{{$registro["origem_sjd_ref_ano"]}}</td>
                            @endif
                            <td>{{$registro["origem_opm"]}}</td>
                            <td>{{$registro["processo"]}}</td>
                            <td>{{$registro["complemento"]}}</td>
                            <td>{{$registro["vara"]}}</td>
                            <td>
                                <span>
                                    {{-- @if(hasPermissionTo('ver-nota-coger'))
                                    <a class="btn btn-default"
                                        href="{{route('exclusao.show',$registro['id_exclusaojudicial'])}}"><i
                                            class="fa fa-fw fa-eye "></i></a>
                                    @endif --}}
                                    @if(hasPermissionTo('editar-exclusao'))
                                    <a class="btn btn-info"
                                        href="{{route('exclusao.edit',$registro['id_exclusaojudicial'])}}"><i
                                            class="fa fa-fw fa-edit "></i></a>
                                    @endif
                                    @if(hasPermissionTo('apagar-exclusao'))
                                    <a class="btn btn-danger"
                                        href="{{route('exclusao.destroy',$registro['id_exclusaojudicial'])}}"
                                        onclick="return confirm('Tem certeza que quer apagar o exclusaojudicial?')"><i
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
                            <th class='col-xs-1 col-md-1'>Nome</th>
                            <th class='col-xs-1 col-md-1'>Procedimento</th>
                            <th class='col-xs-2 col-md-2'>OM</th>
                            <th class='col-xs-2 col-md-2'>Processo</th>
                            <th class='col-xs-2 col-md-2'>Complemento</th>
                            <th class='col-xs-2 col-md-2'>Vara</th>
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