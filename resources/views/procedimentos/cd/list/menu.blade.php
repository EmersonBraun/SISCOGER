<section class="content-header nopadding">  
    <h1>CD - {{$title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">CD - {{$title}}</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <div class="btn-group col-md-10 col-xs-12 nopadding">
            <a class="btn @if($page == 'lista') btn-success @else btn-default @endif col-md-2 col-xs-2" href="{{route('cd.lista')}}">Consulta</a>
            <a class="btn @if($page == 'andamento') btn-success @else btn-default @endif col-md-2 col-xs-2" href="{{route('cd.andamento')}}">Andamento</a>
            <a class="btn @if($page == 'prazos') btn-success @else btn-default @endif col-md-2 col-xs-2" href="{{route('cd.prazos')}}">Prazos</a>
            <a class="btn @if($page == 'rel_situacao') btn-success @else btn-default @endif col-md-2 col-xs-2" href="{{route('cd.rel_situacao')}}">Rel. Situação</a>
            <a class="btn @if($page == 'julgamento') btn-success @else btn-default @endif col-md-2 col-xs-2" href="{{route('cd.julgamento')}}">Julgamento</a>
            @if(session('is_admin'))
            <a class="btn @if($page == 'apagados') btn-success @else btn-default @endif col-md-2 col-xs-2" href="{{route('cd.apagados')}}">Apagados</a>
            @else 
            <span class="col-md-2 col-xs-2"></span>
            @endif
        </div>
        @if(hasPermissionTo('criar-cd'))
        <div class="col-md-2 col-xs-12 litlepadding">
            <a class="btn btn-block btn-primary" href="{{route('cd.create')}}">
            <i class="fa fa-plus"></i> Adicionar CD</a>
        </div>
        @endif
    <div>
</section>
  