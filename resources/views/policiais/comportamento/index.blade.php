@extends('adminlte::page')

@section('title', 'Comportamento')

@section('content_header')
    @include('policiais.comportamento.menu', ['title' => $posto,'page' => $posto, 'parte' => $parte])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Comportamento</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2'>RG</th>
                            <th class='col-xs-2'>Nome</th>
                            <th class='col-xs-2'>PM/BM</th>
                            <th class='col-xs-2'>OM</th>
                            <th class='col-xs-2'>Comportamento</th>
                            <th class='col-xs-1'>Data do comportamento</th>
                            <th class='col-xs-1'>Tempo (anos)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        {{-- @php
                        dd($registro);
                        @endphp --}}
                        <tr>
                            <td style="display: none">{{$registro['rg']}}</td>
                            <td><a href="{{route('fdi.show',$registro['rg'])}}" target="_blanck">{{$registro['rg']}}</a></td>
                            <td>{{$registro['nome']}}</td>
                            <td>{{$registro['classe']}}</td>
                            <td>{{$registro['opm_descricao']}}</td>
                            <td>{{sistema('comportamento',$registro['id_comportamento'])}}</td>
                            <td>{{data_br($registro['data_comportamento'])}}</td>
                            <td>{{idade($registro['data_comportamento'])}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2'>RG</th>
                            <th class='col-xs-2'>Nome</th>
                            <th class='col-xs-2'>PM/BM</th>
                            <th class='col-xs-2'>OM</th>
                            <th class='col-xs-2'>Comportamento</th>
                            <th class='col-xs-1'>Data do comportamento</th>
                            <th class='col-xs-1'>Tempo (anos)</th>
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