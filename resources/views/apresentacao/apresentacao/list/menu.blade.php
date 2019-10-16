<section class="content-header nopadding">  
    <h1>Apresentações - {{$title}} {{$ano}}  @if($cdopm) - {{opm($cdopm)}} @endif</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Apresentações - {{$title}}</li>
    </ol>
    <br>   
    <div class="row">
        <div class="btn-group col-md-8 col-xs-12 ">
            <a class="btn @if($page == 'index') btn-success @else btn-default @endif col-md-6 col-xs-6" href="{{route('apresentacao.index',['ano' => $ano])}}">Consulta</a>
            <a class="btn @if($page == 'apagados') btn-success @else btn-default @endif col-md-6 col-xs-6" href="{{route('apresentacao.apagados',['ano' => $ano])}}">Apagados</a>
        </div>
        @if(hasPermissionTo('criar-nota-coger'))  
            <div class="col-md-4 col-xs-12">
                <a class="btn btn-block btn-primary" href="{{route('apresentacao.create')}}">
                <i class="fa fa-plus"></i> Adicionar Apresentação</a>
            </div>
        @endif
        <br><br>
        {!! Form::open(['url' => route('apresentacao.search')]) !!}
        <div class="@if(hasPermissionTo('todas-unidades')) col-md-4 @else col-md-12 @endif col-xs-12 form-group @if ($errors->has('opm')) has-error @endif">
            {{ Form::select('ano', array_anos(2008), date('Y'), ['class'=>'form-control ', 'id' => 'ano']) }}                
            @if ($errors->has('ano'))
                <span class="help-block">
                    <strong>{{ $errors->first('ano') }}</strong>
                </span>
            @endif
        </div>
        @if(hasPermissionTo('todas-unidades'))
        <div class="col-md-4 col-xs-12 form-group @if ($errors->has('opm')) has-error @endif">
            {{ Form::select('cdopm', opms_sjd(), session('cdopm'), ['class'=>'form-control ', 'id' => 'opm']) }}                
            @if ($errors->has('cdopm'))
                <span class="help-block">
                    <strong>{{ $errors->first('opm') }}</strong>
                </span>
            @endif
        </div>
        @endif
        <div class="col-md-4 ">
            {!! Form::submit('Ir',['class' => 'btn btn-primary btn-block']) !!}
        </div>
        {!! Form::close() !!}
    <div>
</section>
