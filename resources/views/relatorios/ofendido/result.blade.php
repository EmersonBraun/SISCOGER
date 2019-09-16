@extends('adminlte::page')

@section('title', 'Relatório - Ofendidos')

@section('content_header')
<section class="content-header">   
  <h1>Relatório de Ofendidos</h1>
  <ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('relatorio.ofendido.search')}}"><i class="fa fa-dashboard"></i> Busca</a></li>
  </ol>
</section>
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        @foreach ($registros as $key => $registro) 
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Relatório de ofendidos - {{strtoupper($proc)}} agrupados por <b>{{ucwords($key)}}</b></h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped">
                        @foreach($registro as $r)
                        <tr>
                            <td class="col-xs-6"><b>{{ $r->grupo ?? '-'}}</b></td>
                            <td class="col-xs-6">{{ $r->quantidade }}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        @endforeach
    </div>
</section>
@stop

@section('css')
@stop

@section('js')

@stop