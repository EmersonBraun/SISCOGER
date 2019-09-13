@extends('adminlte::page')

@section('title', 'Relatório - Processos Resultado')

@section('content_header')
<section class="content-header">   
  <h1>Relatório de Processos Resultado</h1>
  <ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('processo.search')}}"><i class="fa fa-dashboard"></i> Busca Processos</a></li>
  </ol>
</section>
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Relatório quantitativo de procedimentos instaurados <b>OM: {{$om}}</b></h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th>Tipo</th>
                            @for ($i = $inicio; $i <= $fim; $i++)
                                <th>{{ $i }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $key => $registro)
                        <tr>
                            <td style="display: none">{{ $loop->iteration }}</td>
                            <td>{{strtoupper($key)}}</td>
                            @foreach ($registro as $r)
                                <td>{{ $r }}</td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th>Tipo</th>
                            @for ($i = $inicio; $i <= $fim; $i++)
                                <th>{{ $i }}</th>
                            @endfor
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