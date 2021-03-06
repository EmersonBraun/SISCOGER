@extends('adminlte::page')

@section('title', 'Sindicância - lista')

@section('content_header')
    @include('procedimentos.sindicancia.list.menu', ['title' => 'Apagados','page' => 'apagados'])   
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de SINDICÂNCIA</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class='col-xs-2 col-md-2'>N°/Ano</th>
                            <th class='col-xs-2 col-md-2'>OPM</th>
                            <th class='col-xs-6 col-md-6'>Sintese</th>
                            <th class='col-xs-2 col-md-2'>Ações</th>     
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                    <tr>
                        <td>{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</td>
                        <td>{{opm($registro['cdopm'])}}</td>
                        <td>{{$registro['sintese_txt']}}</td>
                        <td>
                            <span>
                                {{-- <a class="btn btn-default2" href="{{route('sindicancia.show',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i class="fa fa-fw fa-eye "></i></a> --}}
                                <a class="btn btn-info" href="{{route('sindicancia.restore',$registro['id_sindicancia'])}}"><i class="fa fa-fw fa-recycle "></i></a>
                                <a class="btn btn-danger"  href="{{route('sindicancia.forceDelete',$registro['id_sindicancia'])}}" onclick="return confirm('Tem certeza que quer apagar DEFINITIVAMENTE a sindicância?')"><i class="fa fa-fw fa-trash-o "></i></a>
                            </span>
                            </td>   
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>N°/Ano</th>
                            <th>OPM</th>
                            <th>Sintese</th>
                            <th>Ações</th> 
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