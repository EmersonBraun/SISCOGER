<section class="content-header nopadding">  
    <h1>Locais - {{$title}} </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Locais - {{$title}}</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <div class="btn-group col-md-8 col-xs-12 nopadding">
            <a class="btn @if($page == 'index') btn-success @else btn-default @endif col-md-6 col-xs-6" href="{{route('local.index')}}">Consulta</a>
            <a class="btn @if($page == 'apagados') btn-success @else btn-default @endif col-md-6 col-xs-6" href="{{route('local.apagados')}}">Apagados</a>
        </div>
        @if(hasPermissionTo('criar-locais'))  
            <div class="col-md-4 col-xs-12 litlepadding">
                <a class="btn btn-block btn-primary" href="{{route('local.create')}}">
                <i class="fa fa-plus"></i> Adicionar Locais</a>
            </div>
        @endif
    <div>
</section>
