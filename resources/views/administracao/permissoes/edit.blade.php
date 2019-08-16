@extends('adminlte::page')

@section('title_postfix', '| Editar permissões')

@section('content_header')
<h1><i class='fa fa-key'></i> Editar {{$permission->name}}</h1>
@stop

@section('content')
<section class="">
    <div class="tab-content">
        <v-tab-item title="Editar Permissão" idp="principal" cls="active show">
            {{ Form::model($permission, array('route' => array('permission.update', $permission->id), 'method' => 'PUT')) }}
            <v-label label="name" lg='12' md='12' title="Nome" error="{{$errors->first('name')}}">
                {!! Form::text('name',null, ['class' => 'form-control','required']) !!}
            </v-label>

            {!! Form::submit('Editar Permissão',['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
        </v-tab-item>
    </div>
</section>

@stop

@section('css')
@stop

@section('js')
@include('vendor.adminlte.includes.vue')
@stop