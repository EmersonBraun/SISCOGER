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
                            <th>Ref/Ano</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{ $registro->id_envolvido }}</td>
                            <td><a href="{{route('fdi.show',$registro->rg)}}" target="_blanck">{{ $registro->rg }}</a></td>
                            <td>{{ $registro->cargo }}</td>
                            <td>{{ $registro->nome }}</td>
                            @if($registro->id_ipm > 0) <td><a href="{{route('ipm.edit',$registro->id_ipm)}}" target="_blanck">IPM</a></td><td> {{refAno('ipm',$registro->id_ipm)}} @endif
                            @if($registro->id_sindicancia > 0) <td><a href="{{route('sindicancia.edit',$registro->id_sindicancia)}}" target="_blanck">Sindicância</a></td><td> {{refAno('sindicancia',$registro->id_sindicancia)}} @endif
                            @if($registro->id_cd > 0) <td><a href="{{route('cd.edit',$registro->id_cd)}}" target="_blanck">CD</a></td><td> {{refAno('cd',$registro->id_cd)}} @endif
                            @if($registro->id_cj > 0) <td><a href="{{route('cj.edit',$registro->id_cj)}}" target="_blanck">CJ</a></td><td> {{refAno('cj',$registro->id_cj)}} @endif
                            @if($registro->id_apfd > 0) <td><a href="{{route('apfd.edit',$registro->id_apfd)}}" target="_blanck">APFD</a></td><td> {{refAno('apfd',$registro->id_apfd)}} @endif
                            @if($registro->id_fatd > 0) <td><a href="{{route('fatd.edit',$registro->id_fatd)}}" target="_blanck">FATD</a></td><td> {{refAno('fatd',$registro->id_fatd)}} @endif
                            @if($registro->id_iso > 0) <td><a href="{{route('iso.edit',$registro->id_iso)}}" target="_blanck">ISO</a></td><td> {{refAno('iso',$registro->id_iso)}} @endif
                            @if($registro->id_desercao > 0) <td><a href="{{route('desercao.edit',$registro->id_desercao)}}" target="_blanck">Deserção</a></td><td> {{refAno('desercao',$registro->id_desercao)}} @endif
                            @if($registro->id_it > 0) <td><a href="{{route('it.edit',$registro->id_it)}}" target="_blanck">IT</a></td><td> {{refAno('it',$registro->id_it)}} @endif
                            @if($registro->id_adl > 0) <td><a href="{{route('adl.edit',$registro->id_adl)}}" target="_blanck">ADL</a></td><td> {{refAno('adl',$registro->id_adl)}} @endif
                            @if($registro->id_pad > 0) <td><a href="{{route('pad.edit',$registro->id_pad)}}" target="_blanck">PAD</a></td><td> {{refAno('pad',$registro->id_pad)}} @endif
                            @if($registro->id_sai > 0) <td><a href="{{route('sai.edit',$registro->id_sai)}}" target="_blanck">SAI</a></td><td> {{refAno('sai',$registro->id_sai)}} @endif
                            @if($registro->id_proc_outros > 0) <td><a href="{{route('proc_outros.edit',$registro->id_proc_outros)}}" target="_blanck">Proc. Outros.</a></td><td> {{refAno('proc_outros',$registro->id_proc_outros)}} @endif
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
                            <th>Ref/Ano</th>
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