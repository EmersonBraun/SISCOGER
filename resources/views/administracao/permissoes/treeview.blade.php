@extends('adminlte::page')

@section('title_postfix', '| Permissões')

@section('content_header')
    @include('administracao.permissoes.menu', ['title' => 'Árvore','page' => 'treeview'])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de permissões</h3>
            </div>
            <div class="box-body">
                @foreach ($permissions as $name => $permission)
                <div class="col-xs-12 box-body bordaform">
                    <div class="col-xs-1">
                        <h5><b>{{strtoupper($name)}}:</b></h5>
                    </div>
                    @foreach ($permission as $p)
                        <div class="col-xs-1 nopadding">
                            <label for="{{$p['name']}}">{{ ucfirst($p['name']) }}</label>
                        </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
@stop

@section('js')
@stop