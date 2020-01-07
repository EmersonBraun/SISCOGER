<section class="content-header nopadding">
    <h1>Apresentações - {{$title}} {{$ano}} @if($cdopm) - {{opm($cdopm)}} @endif</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Apresentações - {{$title}}</li>
    </ol>
    <br>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="box box-info collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">Listar Outras
                    </h3>
                    <div class="box-tools pull-right"><button type="button" data-widget="collapse"
                            class="btn btn-box-tool"><i class="fa fa-plus"></i></button></div>
                </div>
                <div class="box-body" style="display: none;">
                    {!! Form::open(['url' => route('apresentacao.search')]) !!}
                    <div
                        class="@if(hasPermissionTo('todas-unidades')) col-md-4 @else col-md-12 @endif col-xs-12 form-group @if ($errors->has('opm')) has-error @endif">
                        {{ Form::select('ano', array_anos(2008), date('Y'), ['class'=>'form-control ', 'id' => 'ano']) }}
                        @if ($errors->has('ano'))
                        <span class="help-block">
                            <strong>{{ $errors->first('ano') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div
                        class="@if(hasPermissionTo('todas-unidades')) col-md-4 @else col-md-12 @endif col-xs-12 form-group @if ($errors->has('opm')) has-error @endif">
                        {{ Form::select('mes', array_meses(2008), date('m'), ['class'=>'form-control ', 'id' => 'mes']) }}
                        @if ($errors->has('mes'))
                        <span class="help-block">
                            <strong>{{ $errors->first('mes') }}</strong>
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
                </div>
            </div>
        </div>
        <div class="btn-group col-md-8 col-xs-12 ">
            <a class="btn @if($page == 'index') btn-success @else btn-default @endif col-md-6 col-xs-6"
                href="{{route('apresentacao.index',['ano' => $ano])}}">Consulta</a>
            <a class="btn @if($page == 'apagados') btn-success @else btn-default @endif col-md-6 col-xs-6"
                href="{{route('apresentacao.apagados',['ano' => $ano])}}">Apagados</a>
        </div>
        @if(hasPermissionTo('criar-apresentacao'))
        <div class="col-md-4 col-xs-12">
            <a class="btn btn-block btn-primary" href="{{route('apresentacao.create')}}">
                <i class="fa fa-plus"></i> Adicionar Apresentação</a>
        </div>
        @endif

       

    <div>
</section>