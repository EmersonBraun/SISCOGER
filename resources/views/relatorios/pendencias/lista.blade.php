@extends('adminlte::page')

@section('title_postfix', '| Pendencias lista')

@section('content_header')
    @include('relatorios.pendencias.menu', ['title' => 'Lista','page' => 'lista'])
@stop

@section('content')
<section class="content nopadding">
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Pendências Gerais
                    </h3>
                </div>
                <div class="box-body">
                    <table class="table table-striped" id="datable">
                        <thead>
                            <tr>
                                <th>OPM</th>
                                <th>FATD punição</th>
                                <th>FATD prazo</th>
                                <th>FATD abertura</th>
                                <th>IPM prazo</th>
                                <th>IPM abertura</th>
                                <th>Sindicância prazo</th>
                                <th>Sindicância abertura</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($pendencias as $pendencia) 
                            <tr>
                                <td>{{opm($pendencia->cdopm)}}</td>
                                <td>{{$pendencia->fatd_punicao}}</td>
                                <td>{{$pendencia->fatd_prazo}}</td>
                                <td>{{$pendencia->fatd_abertura}}</td>
                                <td>{{$pendencia->ipm_prazo}}</td>
                                <td>{{$pendencia->ipm_abertura}}</td>
                                <td>{{$pendencia->sindicancia_prazo}}</td>
                                <td>{{$pendencia->sindicancia_abertura}}</td>
                                <td>{{$pendencia->total}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>OPM</th>
                                <th>FATD punição</th>
                                <th>FATD prazo</th>
                                <th>FATD abertura</th>
                                <th>IPM prazo</th>
                                <th>IPM abertura</th>
                                <th>Sindicância prazo</th>
                                <th>Sindicância abertura</th>
                                <th>Total</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>           
            </div>
        </div>
    </div>
</section>
@stop

@section('js')
@stop