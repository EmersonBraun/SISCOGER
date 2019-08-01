<section class="content-header nopadding">  
    <h1>óbitos e lesões - {{$title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">óbitos e lesões - {{$title}}</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <div class="btn-group col-md-8 col-xs-12 nopadding">
            <a class="btn @if($page == 'lista') btn-success @else btn-default @endif @if(session('is_admin')) col-xs-6 @else col-xs-12 @endif " href="{{route('obitolesao.index')}}">Consulta</a>
            @if(session('is_admin'))
            <a class="btn @if($page == 'apagados') btn-success @else btn-default @endif col-xs-6" href="{{route('obitolesao.apagados')}}">Apagados</a>
            @endif
        </div>
        <div class="col-md-4 col-xs-12 litlepadding">
            <a class="btn btn-block btn-primary" href="{{route('obitolesao.create')}}">
            <i class="fa fa-plus"></i> Adicionar óbitos/lesões</a>
        </div>
    <div>
</section>