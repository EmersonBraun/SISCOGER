@extends('adminlte::page')

@section('title', 'OM')

@section('content_header')
<section class="content-header nopadding">  
    <h1>OM</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">OM</li>
    </ol>
    <br>   
</section>
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de OM (Meta4)</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2'>Nome</th>
                            <th class='col-xs-1'>Código</th>
                            <th class='col-xs-2'>Descrição</th>
                            <th class='col-xs-1'>Abreviatura</th>
                            <th class='col-xs-1'>Tipo</th>
                            <th class='col-xs-1'>Município</th>
                            <th class='col-xs-1'>Título</th>
                            <th class='col-xs-1'>Código Base</th>
                            <th class='col-xs-1'>Código Novo</th>
                            <th class='col-xs-1'>Telefone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro->CODIGO}}</td>
                            <td>{{ $registro->NOME_META4}}</td>
                            <td>{{ $registro->CODIGO}}</td>
                            <td>{{ $registro->DESCRICAO}}</td>
                            <td>{{ $registro->ABREVIATURA}}</td>
                            <td>{{ $registro->TIPO}}</td>
                            <td>{{ $registro->MUNICIPIO}}</td>
                            <td>{{ $registro->TITULO}}</td>
                            <td>{{ $registro->CODIGOBASE}}</td>
                            <td>{{ $registro->CODIGONOVO}}</td>
                            <td>{{ $registro->TELEFONE}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-2'>Nome</th>
                            <th class='col-xs-1'>Código</th>
                            <th class='col-xs-2'>Descrição</th>
                            <th class='col-xs-1'>Abreviatura</th>
                            <th class='col-xs-1'>Tipo</th>
                            <th class='col-xs-1'>Município</th>
                            <th class='col-xs-1'>Título</th>
                            <th class='col-xs-1'>Código Base</th>
                            <th class='col-xs-1'>Código Novo</th>
                            <th class='col-xs-1'>Telefone</th>
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