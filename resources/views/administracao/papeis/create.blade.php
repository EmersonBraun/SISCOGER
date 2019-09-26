@extends('adminlte::page')

@section('title_postfix', '| Criar papéis')

@section('content_header')
 
@stop

@section('content')
<section class="content nopadding">
        <div class="box">
            <div class="box-header">
                <h2 class="box-title">Criar papel</h2>
            </div>
            <div class="box-body">
            {{ Form::open(array('url' => route('role.store'))) }}
            </div>
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
                            {{Form::checkbox('permissions[]',  $p['id'], null ,['class' => 'perm '.$name]) }}
                            <label for="{{$p['name']}}">{{ ucfirst($p['name']) }}</label>
                        </div>
                    @endforeach
                </div>
                @endforeach
            {{ Form::submit('Criar', array('class' => 'btn btn-block btn-primary')) }}
            {{ Form::close() }}
        </div>
    </div>
</div>
</section>
@stop

@section('css')
@stop

@section('js')
    @include('vendor.adminlte.includes.tabelas')
@stop