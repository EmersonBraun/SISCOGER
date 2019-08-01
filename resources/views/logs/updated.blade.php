@extends('adminlte::page')

@section('title_postfix', '| LOG')

@section('content_header')
    @include('logs.menu', ['title' => $name,'page' => $page])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de logs {{$name}}</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>RG</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Data/hora</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($logs as $log)
                        <tr>
                            <td>{{ $log->id }}</td>
                            <td>{{ $log->present()->rg }}</td>
                            <td>{{ $log->present()->nome }}</td>
                            <td>
                            @include('logs.properties', ['properties' => json_decode($log->properties)])
                            </td>              
                            <td>{{date( 'd/m/Y h:i:s' , strtotime($log->created_at))}}</td>                                     
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
                            <th>Descrição</th>
                            <th>Data/hora</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>
@stop

@section('js')
@stop