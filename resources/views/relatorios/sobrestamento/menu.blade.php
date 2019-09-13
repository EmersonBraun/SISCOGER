<section class="content-header nopadding">  
    <h1>Procedimentos Sobrestados - {{sistema('procedimentosTipos',strtoupper($page))}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Procedimentos Sobrestados - {{strtoupper($page)}}</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <a class="btn @if($page == 'adl') btn-success @else btn-default @endif col-md-2 col-xs-2" href="{{route('relatorio.sobrestamento','adl')}}">ADL</a>
        <a class="btn @if($page == 'cd') btn-success @else btn-default @endif col-md-2 col-xs-2" href="{{route('relatorio.sobrestamento','cd')}}">CD</a>
        <a class="btn @if($page == 'cj') btn-success @else btn-default @endif col-md-2 col-xs-2" href="{{route('relatorio.sobrestamento','cj')}}">CJ</a>
        <a class="btn @if($page == 'fatd') btn-success @else btn-default @endif col-md-2 col-xs-2" href="{{route('relatorio.sobrestamento','fatd')}}">FATD</a>
        <a class="btn @if($page == 'it') btn-success @else btn-default @endif col-md-2 col-xs-2" href="{{route('relatorio.sobrestamento','it')}}">IT</a>
        <a class="btn @if($page == 'sindicancia') btn-success @else btn-default @endif col-md-2 col-xs-2" href="{{route('relatorio.sobrestamento','sindicancia')}}">Sindicancia</a>
    <div>
</section>