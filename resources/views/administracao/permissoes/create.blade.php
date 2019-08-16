@extends('adminlte::page')

@section('title_postfix', '| Criar permissões')

@section('content_header')
<h1><i class='fa fa-key'></i> Adicionar permissão</h1>
@stop

@section('content')
<section class="">
    <div class="tab-content">
        <v-tab-item title="Formulário Adicionar permissão" idp="principal" cls="active show">
            {!! Form::open(['url' => route('permission.store')]) !!}
            <v-label label="name" lg='12' md='12' title="Nome" error="{{$errors->first('name')}}">
                {!! Form::text('name',null, ['class' => 'form-control','required']) !!}
            </v-label>

            <v-label label="roles" lg='12' md='12' title="Atribuir Permissão a Funções">
                @if(!$roles->isEmpty())
                    @foreach ($roles as $role)
                        <v-label label="roles" lg='2' md='2' slim>
                            {{ Form::checkbox('roles[]',  $role->id ) }}
                            {{ Form::label($role->name, ucfirst($role->name)) }}
                        </v-label>
                    @endforeach
                @endif
            </v-label>

            {!! Form::submit('Inserir Permissão',['class' => 'btn btn-primary btn-block']) !!}
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