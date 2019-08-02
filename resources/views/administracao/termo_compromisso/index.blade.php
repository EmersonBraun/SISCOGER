@extends('adminlte::page')

@section('title_postfix', '| Termos')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fa fa-key"></i> Listagem de Termos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Termos</li>
                </ol>
            </div>
        </div>
    </div>
</section>

@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <h3 class="box-title">Listagem de Termos</h3>
        </div>
        <div class="box-body">
            <table id="datable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="display: none">#</th>
                        <th class='col-md-3 clo-xs-3'>Nome</th>
                        <th class='col-md-2 clo-xs-2'>Email</th>
                        <th class='col-md-2 clo-xs-2'>Expresso</th>
                        <th class='col-md-1 clo-xs-1'>Telefone</th>
                        <th class='col-md-1 clo-xs-1'>Celular</th>
                        <th class='col-md-1 clo-xs-1'>OPM</th>
                        <th class='col-md-1 clo-xs-1'>IP</th>
                        <th class='col-md-1 clo-xs-1'>Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($terms as $term)
                    <tr>
                        <td style="display: none">{{ $term->datahora }}</td>
                        <td>{{ special_ucwords($term->nome) }}</td>
                        <td>{{ $term->email }}</td>
                        <td>{{ $term->UserExpresso }}</td>
                        <td>{{ $term->telefone }}</td>
                        <td>{{ $term->celular }}</td>
                        <td>{{ $term->opm }}</td>
                        <td>{{ $term->ip }}</td>
                        <td>{{ data_br($term->datahora,1) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th style="display: none">#</th>
                        <th class='col-md-3 clo-xs-3'>Nome</th>
                        <th class='col-md-2 clo-xs-2'>Email</th>
                        <th class='col-md-2 clo-xs-2'>Expresso</th>
                        <th class='col-md-1 clo-xs-1'>Telefone</th>
                        <th class='col-md-1 clo-xs-1'>Celular</th>
                        <th class='col-md-1 clo-xs-1'>OPM</th>
                        <th class='col-md-1 clo-xs-1'>IP</th>
                        <th class='col-md-1 clo-xs-1'>Data</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</section>
@stop

@section('css')
@stop

@section('js')
@stop