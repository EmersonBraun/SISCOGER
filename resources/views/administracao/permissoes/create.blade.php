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
            <v-label label="name" lg='6' md='6' title="Nome" error="{{$errors->first('name')}}">
                {!! Form::text('name',null, ['class' => 'form-control','required']) !!}
            </v-label>
            <v-label label="related" lg='6' md='6' title="Relacionado a outras permissões?" error="{{$errors->first('related')}}">
                {!! Form::text('related',null, ['class' => 'form-control']) !!}
            </v-label>
            <v-label label="description" title="Descrição" lg="12" md="12" error="{{$errors->first('description')}}">
                {!! Form::textarea('description',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']) !!}
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