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
                <v-tabs nav-style="pills" justified>
                @forelse ($registros as $key => $registro)               
                    <v-tab header="{{strtoupper($key)}} ({{sistema('procSituacao',$key)}})" :badge="{{ count($registro)}}">
                        <table class="table table-bordered table-striped display">
                            <thead>
                                <tr>
                                    <th style="display:none">#</th>
                                    <th class='col-xs-1 col-md-1'>N°/Ano</th>
                                    <th class='col-xs-2 col-md-2'>Andamento</th>
                                    <th class='col-xs-2 col-md-2'>OM</th>
                                    <th class='col-xs-2 col-md-2'>Posto/Grad.</th>
                                    <th class='col-xs-2 col-md-2'>Nome</th>
                                    @if(hasAnyPermission(['ver-'.$key,'editar-'.$key]))
                                    <th class='col-xs-3 col-md-3'>Ações</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registro as $r)
                                <tr>
                                    <td style="display:none">{{$r['id_'.$key]}}</td>
                                    <td>{{ $r->sjd_ref}}/{{ $r->sjd_ref_ano }}</td>
                                    <td>{{sistema('andamento',$r->id_andamento)}}</td>
                                    <td>{{ $r->present()->opm}}</td>
                                    <td>{{$r->cargo}}</a></td>
                                    <td><a href="{{route('fdi.show', $r->rg)}}" target="_blanck">{{$r->nome}}</a></td>
                                    <td>
                                        <span>
                                            @if(hasPermissionTo('ver-'.$key))
                                            <a class="btn btn-secondary" href="{{route($key.'.show',['ref' => $r->sjd_ref, 'ano' => $r->sjd_ref_ano])}}" target="_black">
                                                <i class="fa fa-fw fa-eye "></i>
                                            </a>
                                            @endif
                                            @if(hasPermissionTo('editar-'.$key))
                                            <a class="btn btn-info" href="{{route($key.'.edit',['ref' => $r->sjd_ref, 'ano' => $r->sjd_ref_ano])}}" target="_black">
                                                <i class="fa fa-fw fa-edit "></i>
                                            </a>
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </v-tab>
                    @empty
                    <h4>Não há resultados para essa busca</h4>
                    @endforelse
                </v-tabs>
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
@stop

@section('js')
@include('vendor.adminlte.includes.vue')
@stop