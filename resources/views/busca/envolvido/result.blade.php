@extends('adminlte::page')

@section('title', 'Busca - Envolvidos')

@section('content_header')
<section class="content-header">   
  <h1>Busca de Envolvidos</h1>
  <ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('busca.envolvido.search')}}"><i class="fa fa-dashboard"></i> Busca</a></li>
  </ol>
</section>
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Busca de Envolvidos </h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th>Procedimento</th>
                            <th>RG</th>
                            <th>Nome</th>
                            <th>Situação</th>
                            <th>Cargo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{ $registro->id_envolvido }}</td>
                            <td><a href="{{route($proc.'.show',['ref' => $registro->sjd_ref, 'ano' => $registro->sjd_ref_ano])}}" target="_black">{{ $proc }}: {{ $registro->sjd_ref }}/{{ $registro->sjd_ref_ano }}</a></td>
                            <td>{{ $registro->nome }}</td>
                            <td>{{ $registro->rg }}</td>
                            <td>{{ $registro->situacao }}</td>
                            <td>{{ $registro->cargo }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th>Procedimento</th>
                            <th>RG</th>
                            <th>Nome</th>
                            <th>Situação</th>
                            <th>Cargo</th>
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