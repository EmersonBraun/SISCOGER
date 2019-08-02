@extends('adminlte::page')

@section('title', 'Óbitos e lesões | Apagados')

@section('content_header')
    @include('policiais.obitolesao.menu', ['title' => 'Apagados','page' => 'apagados'])
@stop

@section('content')
<section class="">
    <div class="row">
        <div class="col-xs-12">
        <!-- /.box -->

        <div class="box">
            <div class="box-header">
            <h3 class="box-title">Listagem de Óbitos e lesões - Apagados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table id="datable" class="table table-bordered table-striped">

                <thead>
                <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-1 col-md-1'>RG</th>
                    <th class='col-xs-1 col-md-1'>Cargo</th>
                    <th class='col-xs-1 col-md-1'>OM atual</th>
                    <th class='col-xs-1 col-md-1'>Processo</th>
                    <th class='col-xs-2 col-md-2'>Art. da Infração Penal</th>
                    <th class='col-xs-1 col-md-1'>Início</th>
                    <th class='col-xs-1 col-md-1'>Fim</th> 
                    <th class='col-xs-1 col-md-1'>Ações</th>     
                </tr>
                </thead>
                <tbody>
                @foreach($registros as $registro)
                <tr>
                    <td style="display: none">{{$registro->id_falecimento}}</td>
                    <td><a href="{{route('fdi.show',$registro->rg)}}" target="_blank">{{$registro->rg}}</a></td>
                    <td>{{$registro->cargo}}</td>
                    <td>{{$registro->nome}}</td>
                    <td>{{$registro->present()->opm}}</td>
                    <td>{{$registro->processo}}</td>
                    <td>{{$registro->infracao}}</td>
                    <td>{{$registro->inicio_data}}</td>
                    <td>{{$registro->fim_data}}</td>
                    <td>
                        <span>
                        {{-- <a class="btn btn-default" href="{{route('obitolesao.show',$registro['id_falecimento'])}}"><i class="fa fa-fw fa-eye "></i></a> --}}
                        <a class="btn btn-info" href="{{route('obitolesao.restore',$registro['id_falecimento'])}}"><i class="fa fa-fw fa-recycle "></i></a>
                        <a class="btn btn-danger"  href="{{route('obitolesao.forceDelete',$registro['id_falecimento'])}}" onclick="return confirm('Tem certeza que quer apagar o DEFINITIVO o Óbito/Lesão?')"><i class="fa fa-fw fa-trash"></i></a>
                        </span>
                    </td>   
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-1 col-md-1'>RG</th>
                            <th class='col-xs-1 col-md-1'>Cargo</th>
                            <th class='col-xs-1 col-md-1'>OM atual</th>
                            <th class='col-xs-1 col-md-1'>Processo</th>
                            <th class='col-xs-2 col-md-2'>Art. da Infração Penal</th>
                            <th class='col-xs-1 col-md-1'>Início</th>
                            <th class='col-xs-1 col-md-1'>Fim</th> 
                            <th class='col-xs-1 col-md-1'>Ações</th> 
                    </tr>
                </tfoot>
            </table>
            </div>
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