@extends('adminlte::page')

@section('title', 'ADL - Rel. Sit')

@section('content_header')
@include('procedimentos.adl.list.menu', ['title' => 'Rel. Situação','page' => 'rel_situacao'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Apuração Disciplinar de Licenciamento</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2 col-md-2'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>Fato</th>
                            <th class='col-xs-2 col-md-2'>Portaria</th>
                            <th class='col-xs-2 col-md-2'>Parecer</th>
                            <th class='col-xs-4 col-md-4'>Check</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro['id_adl']}}</td>
                            <td>{{ $registro->present()->refAno}}</td>
                            <td>{{ $registro->fato_data}}</td>
                            <td>{{ $registro->portaria_data}}</td>
                            <td>{{ $registro->prescricao_data}}</td>
                            <td>
                                <span>
                                    {!! $registro->present()->libeloIcon !!}
                                    Libelo<br>
                                    {!! $registro->present()->parecerIcon !!}
                                    Parecer<br>
                                    {!! $registro->present()->decisaoIcon !!}
                                    Decisão<br>
                                    {!! $registro->present()->recAtoIcon !!}
                                    Rec. Ato<br>
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
                            <th>Parecer</th>
                            <th>Check</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
@stop

@section('js')
@stop