@extends('adminlte::page')

@section('title', 'Mudar OPM')

@section('content_header')
<section class="content-header">   
  <h1>Mudar OPM - Dashboard</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Mudar OPM - Dashboard</li>
  </ol>
</section>
  
@stop

@section('content')
<section class="">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class='col-md-12 col-xs-12'>
                    {!! Form::open(['url' => route('pendencia.homeoutraom')]) !!}
                    <div class="col-lg-12 col-md-12 col-xs-12 form-group @if ($errors->has('opm')) has-error @endif">
                        {!! Form::label('opm', 'OPM') !!}
                        {{ Form::select('opm', $opms, session('cdopm'), ['class'=>'form-control ', 'id' => 'opm']) }}                
                        @if ($errors->has('opm'))
                            <span class="help-block">
                                <strong>{{ $errors->first('opm') }}</strong>
                            </span>
                        @endif
                    </div>
                    {!! Form::submit('Ver outra OM',['class' => 'btn btn-primary btn-block']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('css')
@stop

@section('js')

@stop

