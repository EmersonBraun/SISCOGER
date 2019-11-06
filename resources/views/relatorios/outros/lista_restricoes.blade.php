@extends('adminlte::page')

@section('title', 'Relatório - Operação Verão')

@section('content_header')
<section class="content-header">   
  <h1>Relatório de Operação Verão</h1>
  <ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  </ol>
</section>
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Relatório de Operação Verão</b></h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th>RG</th>
                            <th>Nome</th>
                            <th>Denunciado</th>
                            <th>Excluído</th>
                            <th>Preso</th>
                            <th>Restrição Arma</th>
                            <th>Restrição Fardamento</th>
                            <th>Suspenso</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $key => $registro)   
                            <tr>
                                <td style="display: none">{{ $key }}</td>
                                <td>{{ $registro['rg'] }}</td>
                                <td>{{ $registro['nome'] }}</td>
                                <td>{{ $registro['denunciado'] }}</td>
                                <td>{{ $registro['excluido'] }}</td>
                                <td>{{ $registro['preso'] }}</td>
                                <td>{{ $registro['restricao_arma'] }}</td>
                                <td>{{ $registro['restricao_fardamento'] }}</td>
                                <td>{{ $registro['suspenso'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th>RG</th>
                            <th>Nome</th>
                            <th>Denunciado</th>
                            <th>Excluído</th>
                            <th>Preso</th>
                            <th>Restrição Arma</th>
                            <th>Restrição Fardamento</th>
                            <th>Suspenso</th>
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