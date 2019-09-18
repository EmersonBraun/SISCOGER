@extends('adminlte::page')

@section('title', 'Email')

@section('content_header')
@include('apresentacao.email.menu', ['title' => 'Lista','page' => $ano])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Emails</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1'>Contexto</th>
                            <th class='col-xs-1'>Remetente</th>
                            <th class='col-xs-1'>Destinatário</th>
                            <th class='col-xs-1'>Assunto</th>
                            <th class='col-xs-6'>Mensagem</th>
                            <th class='col-xs-1'>RG</th>
                            <th class='col-xs-1'>Data/Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro->id_email}}</td>
                            <td>{{$registro->contexto_email}}</td>
                            <td>{{$registro->remetente_nome}}</td>
                            <td>{{$registro->destinatario_nome}}</td>
                            <td>{{$registro->assunto}}</td>
                            <td>{{$registro->mensagem_txt}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1'>Contexto</th>
                            <th class='col-xs-1'>Remetente</th>
                            <th class='col-xs-1'>Destinatário</th>
                            <th class='col-xs-1'>Assunto</th>
                            <th class='col-xs-6'>Mensagem</th>
                            <th class='col-xs-1'>RG</th>
                            <th class='col-xs-1'>Data/Hora</th>
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