@extends('adminlte::page')

@section('title', 'Arquivo')

@section('content_header')
<section class="content-header">   
    @include('arquivamento.list.menu', ['title' => 'Prateleiras', 'page' => 'prateleira', 'numero' => $numero])
@stop

@section('content')
<div class="form-group col-md-12 col-xs-12 nopadding">
    <div class="btn-group col-md-12 col-xs-12 nopadding">
        @for($i = 0; $i <= $maxnumero; $i++)
            <a class="btn @if($numero == $i) btn-success @else btn-default @endif col-xs-1" href="{{route('arquivamento.prateleira',$i)}}">{{$i}}</a>
        @endfor
    </div>
<div>
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de arquivo - Prateleiras <b>N°{{$numero}}</b></h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    @foreach($registros as $key => $registro)
                        <tr>
                            <td>{{ strtoupper($key) }}</td>
                            @foreach($registro as $r)
                                <td>{{ strtoupper($r->procedimento) }} {{ $r->sjd_ref }} {{ $r->sjd_ref_ano }}</td>
                            @endforeach
                            {{-- <td><a class="btn btn-primary btn-block" href="{{route('arquivamento.create',['numero' => $numero, 'letra' => $key])}}">Cadastrar</a></td> --}}
                        </tr>
                    @endforeach
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