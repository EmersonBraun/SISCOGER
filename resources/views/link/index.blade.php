@extends('adminlte::page')

@section('title', 'Link')

@section('content_header')
<section class="content-header nopadding">  
    <h1>Links Úteis</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Links Úteis</li>
    </ol>
    <br> 
    @if(session('is_admin'))  
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <a class="btn btn-success col-xs-12 " href="{{route('link.create')}}"><i class="fa fa-plus"></i> Adicionar Link</a>
    <div>
    @endif
</section>
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Links Úteis</h3>
            </div>
            <div class="box-body">
                @foreach($registros as $registro)
                    <p>
                        <a href="{{$registro->link}}" target="_blanck">{{$registro->nome}}</a>
                        <span>
                            @if(session('is_admin'))
                            <a class="btn btn-info"
                                href="{{route('link.edit',$registro->id_link_uteis)}}"><i
                                    class="fa fa-fw fa-edit "></i></a>
                            <a class="btn btn-danger"
                                href="{{route('link.destroy',$registro->id_link_uteis)}}"
                                onclick="return confirm('Tem certeza que quer apagar o link?')"><i
                                    class="fa fa-fw fa-trash-o "></i></a>
                            @endif
                        </span>
                    </p>
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