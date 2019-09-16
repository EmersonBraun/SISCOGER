@extends('adminlte::page')

@section('title', 'Relatório - Encarregados')

@section('content_header')
<section class="content-header">   
  <h1>Relatório de Encarregados</h1>
  <ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('relatorio.encarregado.search')}}"><i class="fa fa-dashboard"></i> Busca</a></li>
  </ol>
</section>
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Relatório quantitativo por encarregado </h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th>Posto/Grad Nome</th>
                            <th>Quantidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{ $registro->quantidade }}</td>
                            <td>{{$registro->grupo}}</td>
                            <td>{{$registro->quantidade}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th>Posto/Grad Nome</th>
                            <th>Quantidade</th>
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