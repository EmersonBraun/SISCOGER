@extends('adminlte::page')

@section('title_postfix', '| Editar papéis')

@section('content_header')
<section class="content-header">   
<h1><i class='fa fa-key'></i> Atualizar papel: {{$role->name}}</h1>
<ol class="breadcrumb">
<li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Editar papéis</li>
</ol>
<br>
</section>
@stop

@section('content')
<div class="content"> 
    <div class="box">
        <div class="box-header">
            <h2 class="box-title">Atualizar papel: {{$role->name}}</h2>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button> 
            </div>             
        </div>
        {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}

        {{ Form::label('name', 'Papel nome') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
        @if ($errors->has('name'))
            <span class="help-block">
                <strong><i class="fa fa-times-circle-o"></i> {{ $errors->first('name') }}</strong>
            </span>
        @endif

        <div class="box-body">               
            <div class="col-md-12 col-xs-12">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                            </tr>
                        </thead>
                
                        <tbody>
                            @foreach ($permissions as $permission)
                            <tr>
                                <td>{{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}</td>
                                <td>{{ Form::label($permission->name, ucfirst($permission->name)) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                            </tr>
                        </tfoot>
                    </table>
                    {{ Form::submit('Editar', array('class' => 'btn btn-primary btn-block')) }}
                    {{ Form::close() }}   
            </div>
        </div>
    </div>
</div>


@stop

@section('css')
@stop

@section('js')
    @include('vendor.adminlte.includes.tabelas')
@stop