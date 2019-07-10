<section class="content-header nopadding">  
    <h1>Deserção - {{$title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Deserção - {{$title}}</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <div class="btn-group col-md-10 col-xs-12 nopadding">
            <a class="btn @if($page == 'lista') btn-success @else btn-default @endif col-md-4 col-xs-4" href="{{route('desercao.lista')}}">Consulta</a>
            <a class="btn @if($page == 'rel_situacao') btn-success @else btn-default @endif col-md-4 col-xs-4" href="{{route('desercao.rel_situacao')}}">Rel. Situação</a>
            <a class="btn @if($page == 'apagados') btn-success @else btn-default @endif col-md-4 col-xs-4" href="{{route('desercao.apagados')}}">Apagados</a>
        </div>
        <div class="col-md-2 col-xs-12 litlepadding">
            <a class="btn btn-block btn-primary" href="{{route('desercao.create')}}">
            <i class="fa fa-plus"></i> Adicionar Deserção</a>
        </div>
    <div>
</section>