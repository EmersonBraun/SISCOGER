<section class="content-header nopadding">  
    <h1>Medalha - {{$title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Medalha - {{$title}}</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <div class="btn-group col-md-6 col-xs-12 nopadding">
            <a class="btn @if($page == 'lista') btn-success @else btn-default @endif 
            @if(session('is_admin')) col-md-6 
            @else col-md-12 @endif col-xs-12"
            href="{{route('medalha.index')}}">Consulta</a>
            @if(session('is_admin'))
            <a class="btn @if($page == 'apagados') btn-success @else btn-default @endif col-md-6 col-xs-12" href="{{route('medalha.apagados')}}">Apagados</a>
            @else 
            <span class="col-md-2 col-xs-2"></span>
            @endif
        </div>
        @if(hasPermissionTo('criar-medalhas'))
        <div class="col-md-6 col-xs-12 litlepadding">
            <a class="btn btn-block btn-primary" href="{{route('medalha.create')}}">
            <i class="fa fa-plus"></i> Adicionar Medalha</a>
        </div>
        @endif
    <div>
</section>