@extends('adminlte::page')

@section('title_postfix', '| LOG Acessos')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i class="fa fa-bug"> LOG Acessos</i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="home">Home</a></li>
                    <li class="breadcrumb-item active">LOG Acessos</li>
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
            <div class="box-header">
                <h3 class="box-title">Listagem Acessos</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>RG</th>
                            <th>Nome</th>
                            <th>IP</th>
                            <th>Data/hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($logs as $log)
                        <tr>
                            <td>{{ $log->id_log_acessos }}</td>
                            <td>{{ $log->rg }}</td>
                            <td>{{ $log->nome }}</td>
                            <td>{{ $log->ip }}</td>
                            <td>{{date( 'd/m/Y-h:i:s' , strtotime($log->created_at))}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td>Não há registros ainda</td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>RG</th>
                            <th>Nome</th>
                            <th>IP</th>
                            <th>Data/hora</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop