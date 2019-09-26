@extends('adminlte::page')

@section('title_postfix', '| Editar papéis')

@section('content_header')
<section class="content-header">
    <h1><i class='fa fa-key'></i> Atualizar papel: {{$role->name}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('role.index')}}">Lista</a></li>
        <li class="active">Editar papéis</li>
    </ol>
    <br>
</section>
@stop

@section('content')
<section class="content nopadding">
    <div class="box">
        <div class="box-header">
            <h2 class="box-title">Atualizar papel</h2>
        </div>
        <div class="box-body">
            {{ Form::model($role, array('route' => array('role.update', $role->id), 'method' => 'PUT')) }}

            {{ Form::label('name', 'Papel nome') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
            @if ($errors->has('name'))
            <span class="help-block">
                <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('name') }}</strong>
            </span>
            @endif
            <a class="btn btn-primary btn-block" onclick="limpaSelecao()">Limpar Toda seleção</a>
            @foreach ($permissions as $name => $permission)
            <div class="col-xs-12 box-body bordaform">
                <div class="col-xs-11">
                    <h5><b>{{strtoupper($name)}}</b></h5>
                </div>
                <div class="col-xs-1">
                    <a class="btn btn-primary btn-sm float-rigth" onclick="selectAll('{{$name}}')"><i class="fa fa-check-square"></i></a>
                    <a class="btn btn-danger btn-sm float-rigth" onclick="unselectAll('{{$name}}')"><i class="fa fa-square"></i></a>
                </div>
                @foreach ($permission as $p)
                    <div class="col-xs-3 nopadding">
                        {{Form::checkbox('permissions[]',  $p['id'], $role->permissions ,['class' => 'perm '.$name]) }}
                        <label for="{{$p['name']}}">{{ ucfirst($p['name']) }}</label>
                    </div>
                @endforeach
            </div>
            @endforeach
            {{ Form::submit('Editar', array('class' => 'btn btn-primary btn-block')) }}
            {{ Form::close() }}
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
@stop

@section('js')
<script>
    function limpaSelecao() {
        $(".perm").prop("checked", false); 
    }
    function selectAll(related) {
        $('.'+related).prop("checked", true);
    }
    function unselectAll(related) {
        $('.'+related).prop("checked", false);
    }
</script>
@stop