@extends('adminlte::page')

@section('title', 'IT')

@section('content_header')
@include('procedimentos.it.list.menu', ['title' => 'Julgamento','page' => 'julgamento'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Inquérito Técnico</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class='col-xs-2 col-md-2'>#</th>
                            <th class='col-xs-2 col-md-2'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>OPM</th>
                            <th class='col-xs-2 col-md-2'>Acusado</th>
                            <th class='col-xs-2 col-md-2'>Andamento</th>
                            <th class='col-xs-2 col-md-2'>Resultado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td class='col-xs-2 col-md-2'>{{$registro['id_it']}}</td>
                            <td class='col-xs-2 col-md-2'>{{$registro['sjd_ref']}} / {{$registro['sjd_ref_ano']}}</td>
                            <td class='col-xs-2 col-md-2'>{{opm($registro['itopm'])}}</td>
                            <td class='col-xs-2 col-md-2'>{{$registro['cargo']}} {{$registro['nome']}}</td>
                            <td class='col-xs-2 col-md-2'>{{sistema('andamentoit',$registro['id_andamento'])}}</td>
                            <td class='col-xs-2 col-md-2'>
                                @if ($registro['resultado'] == "Punido")
                                @if (!$registro['id_punicao'])
                                Cadastrar
                                @else
                                <strong>
                                    Punição: {{sistema('classPunicao',$registro['id_classpunicao'])}}
                                </strong><br>
                                {{-- 1 é advertência e 3 repreenção, então esses não coloca os dias --}}
                                @if($registro['id_gradacao'] != 1 && $registro['id_gradacao'] != 3)
                                {{$registro['dias']}} dia(s) -
                                @endif
                                {{sistema('gradacao',$registro['id_gradacao'])}}
                                @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class='col-xs-2 col-md-2'>#</th>
                            <th class='col-xs-2 col-md-2'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>OPM</th>
                            <th class='col-xs-2 col-md-2'>Acusado</th>
                            <th class='col-xs-2 col-md-2'>Andamento</th>
                            <th class='col-xs-2 col-md-2'>Resultado</th>
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