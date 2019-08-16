@extends('adminlte::page')

@section('title', 'Relatório Respondendo')

@section('content_header')
<section class="content-header nopadding">  
    <h1>Relatório de policiais ou que responderam procedimentos - Resultado Busca</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('respondendo.index')}}"> Relatório - Busca</a></li>
        <li class="active">Relatório - Resultado</li>
    </ol>
    <br>   
    <div class="col-md-12 col-xs-12 nopadding">
        <a class="btn btn-block btn-primary" href="{{route('respondendo.index')}}">
        <i class="fa fa-arrow-left"></i> Realizar outra busca</a>
    <div>
</section>
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Relatório de policiais respondendo - Resultado</h3>
            </div>
            <div class="box-body">             
                <table id='datable' class="table table-bordered table-striped display">
                    <thead>
                        <tr>
                            <th style="display:none">#</th>
                            <th class='col-xs-1 col-md-1'>Procedimento</th>
                            <th class='col-xs-1 col-md-1'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>Andamento</th>
                            <th class='col-xs-2 col-md-2'>OM</th>
                            <th class='col-xs-2 col-md-2'>Posto/Grad.</th>
                            <th class='col-xs-2 col-md-2'>Nome</th>
                            <th class='col-xs-2 col-md-2'>Situação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registros as $registro)
                        <tr>
                            <td style="display:none">{{$registro['id_'.$registro['procedimento']]}}</td>
                            <td>{{ $registro->procedimento }}</td>
                            <td>{{ $registro->sjd_ref}}/{{ $registro->sjd_ref_ano }}</td>
                            <td>{{sistema('andamento',$registro->id_andamento)}}</td>
                            <td>{{ $registro->present()->opm}}</td>
                            <td>{{$registro->cargo}}</td>
                            <td>{{$registro->nome}}</td>
                            <td>{{sistema('procSituacao',$registro['procedimento'])}}</td>
                        </tr>
                        @empty
                        <tr><td colspan="7">Não há resultados para essa busca</td></tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display:none">#</th>
                            <th class='col-xs-1 col-md-1'>Procedimento</th>
                            <th class='col-xs-1 col-md-1'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>Andamento</th>
                            <th class='col-xs-2 col-md-2'>OM</th>
                            <th class='col-xs-2 col-md-2'>Posto/Grad.</th>
                            <th class='col-xs-2 col-md-2'>Nome</th>
                            <th class='col-xs-2 col-md-2'>Situação</th>
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