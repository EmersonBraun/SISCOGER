<section class="content-header nopadding">  
    <h1>Proc. Outros - {{$title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Proc. Outros - {{$title}}</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <div class="btn-group col-md-10 col-xs-12 nopadding">
            <a class="btn @if($page == 'lista') btn-success @else btn-default @endif col-md-3 col-xs-3" href="{{route('procoutros.lista')}}">Consulta</a>
            <a class="btn @if($page == 'andamento') btn-success @else btn-default @endif col-md-3 col-xs-3" href="{{route('procoutros.andamento')}}">Andamento</a>
            <a class="btn @if($page == 'prazos') btn-success @else btn-default @endif col-md-3 col-xs-3" href="{{route('procoutros.prazos')}}">Prazos</a>
            <a class="btn @if($page == 'apagados') btn-success @else btn-default @endif col-md-3 col-xs-3" href="{{route('procoutros.apagados')}}">Apagados</a>
        </div>
        <div class="col-md-2 col-xs-12 litlepadding">
            <a class="btn btn-block btn-primary" href="{{route('procoutros.create')}}">
            <i class="fa fa-plus"></i> Adicionar Proc. Outros</a>
        </div>
    <div>
</section>