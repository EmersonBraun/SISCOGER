<section class="content-header nopadding">  
    <h1>Pendências gerais - {{$title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pendências gerais - {{$title}}</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <div class="btn-group col-md-12 col-xs-12 nopadding">
            <a class="btn @if($page == 'lista') btn-success @else btn-default @endif col-xs-6 " href="{{route('pendencia.gerais')}}">Lista</a>
            <a class="btn @if($page == 'graficos') btn-success @else btn-default @endif col-xs-6 " href="{{route('pendencia.graficos')}}">Gráficos</a>
        </div>
    <div>
</section>