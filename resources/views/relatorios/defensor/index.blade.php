@extends('adminlte::page')

@section('title', 'Relatório - Defensores')

@section('content_header')
<section class="content-header">   
  <h1>Relatório de Defensores</h1>
  <ol class="breadcrumb">
    <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  </ol>
</section>
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Relatório de Defensores</b></h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th>RG</th>
                            <th>Posto/Grad</th>
                            <th>Nome</th>
                            <th>Processo/Procedimento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{ $registro->id_envolvido }}</td>
                            <td>{{ $registro->rg }}</td>
                            <td>{{ $registro->cargo }}</td>
                            <td>{{ $registro->nome }}</td>
                            <td>
                                @if($registro->id_ipm > 0) IPM @endif
                                @if($registro->id_sindicancia > 0) Sindicância @endif
                                @if($registro->id_cd > 0) CD @endif
                                @if($registro->id_cj > 0) CJ @endif
                                @if($registro->id_apfd > 0) APFD @endif
                                @if($registro->id_fatd > 0) FATD @endif
                                @if($registro->id_iso > 0) ISO @endif
                                @if($registro->id_desercao > 0) Deserção @endif
                                @if($registro->id_it > 0) IT @endif
                                @if($registro->id_adl > 0) ADL @endif
                                @if($registro->id_pad > 0) PAD @endif
                                @if($registro->id_sai > 0) SAI @endif
                                @if($registro->id_proc_outros > 0) Proc. Outros @endif
                            </td>  
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th>RG</th>
                            <th>Posto/Grad</th>
                            <th>Nome</th>
                            <th>Processo/Procedimento</th>
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