<section class="content-header nopadding">  
    <h1>APFD - {{$title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">APFD - {{$title}}</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <div class="btn-group col-md-8 col-xs-12 nopadding">
            <a class="btn @if($page == 'lista') btn-success @else btn-default @endif col-md-4 col-xs-4" href="{{route('apfd.lista')}}">Consulta</a>
            <a class="btn @if($page == 'rel_situacao') btn-success @else btn-default @endif col-md-4 col-xs-4" href="{{route('apfd.rel_situacao')}}">Rel. Situação</a>
            @if(session('is_admin'))
            <a class="btn @if($page == 'apagados') btn-success @else btn-default @endif col-md-4 col-xs-4" href="{{route('apfd.apagados')}}">Apagados</a>
            @else 
            <span class="col-md-4 col-xs-4"></span>
            @endif
        </div>
        <div class="col-md-4 col-xs-12 litlepadding">
            <a class="btn btn-block btn-primary" href="{{route('apfd.create')}}">
            <i class="fa fa-plus"></i> Adicionar APFD</a>
        </div>
    <div>
</section>
