@extends('adminlte::page')

@section('title', 'Relatório - Nominal')

@section('content_header')
<section class="content-header">   
  <h1>Relatório de Nominal</h1>
  <ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('busca.nominal.search')}}"><i class="fa fa-dashboard"></i> Busca</a></li>
  </ol>
</section>
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Relatório Nominal </h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th>Proc. N°/Ano</th>
                            <th>Sintese</th>
                            <th>Envolvimento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{ $registro->id_envolvido }}</td>
                            <td>
                                <a href="{{route($registro->proc.'.show',['ref' => $registro->sjd_ref, 'ano' => $registro->sjd_ref_ano])}}">
                                    {{$registro->proc}}: {{$registro->sjd_ref}}/{{$registro->sjd_ref_ano}}
                                </a>
                            </td>
                            <td>{{$registro->sintese_txt}}</td>
                            <td>{{$registro->situacao}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th>Proc. N°/Ano</th>
                            <th>Sintese</th>
                            <th>Envolvimento</th>
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