<section class="content-header nopadding">  
    <h1>FATD - {{$title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">FATD - {{$title}}</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <div class="btn-group col-md-8 col-xs-12 nopadding">
            <a class="btn @if($page == 'lista') btn-success @else btn-default @endif col-md-2 col-xs-2" href="{{route('fatd.lista',['ano' => $ano])}}">Consulta</a>
            <a class="btn @if($page == 'andamento') btn-success @else btn-default @endif col-md-2 col-xs-2" href="{{route('fatd.andamento',['ano' => $ano])}}">Andamento</a>
            <a class="btn @if($page == 'julgamento') btn-success @else btn-default @endif col-md-2 col-xs-2" href="{{route('fatd.julgamento',['ano' => $ano])}}">Julgamento</a>
            <a class="btn @if($page == 'rel_situacao') btn-success @else btn-default @endif col-md-2 col-xs-2" href="{{route('fatd.rel_situacao',['ano' => $ano])}}">Rel. Situação</a>
            <a class="btn @if($page == 'prazos') btn-success @else btn-default @endif col-md-2 col-xs-2" href="{{route('fatd.prazos',['ano' => $ano])}}">Prazos</a>
            @if(session('is_admin'))
            <a class="btn @if($page == 'apagados') btn-success @else btn-default @endif col-md-2 col-xs-2" href="{{route('fatd.apagados',['ano' => $ano])}}">Apagados</a>
            @else 
            <span class="col-md-2 col-xs-2"></span>
            @endif
        </div>
        @if(hasPermissionTo('criar-fatd'))
        <div class="col-md-2 col-xs-12 litlepadding">
            <a class="btn btn-block btn-primary" href="{{route('fatd.create')}}">
            <i class="fa fa-plus"></i> Adicionar FATD</a>
        </div>
        @endif
        <div class='col-md-2 col-xs-6  pull-right'>
            <button type="button" class="btn btn-default btn-block dropdown-toggle" data-toggle="dropdown" >
                Listar ano:
                <span class="caret" data-toggle="tooltip" data-placement="bottom" 
                title="O ano apenas modifica a listagem,os dados continuam sendo inseridos em {{date('Y')}}"></span>
            </button>
            <ul class="dropdown-menu">
                @for ($i = date('Y'); $i >= 2008; $i--)
                    @if($i != $ano)
                    <li><a href="{{route('fatd.'.$page,['ano' => $i])}}">{{ $i }}</a></li>
                    @endif
                @endfor 
            </ul>
        </div>
    <div>
</section>
