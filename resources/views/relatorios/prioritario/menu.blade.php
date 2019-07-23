<section class="content-header nopadding">  
    <h1>Procedimentos Prioritários - {{sistema('procedimentosTipos',strtoupper($page))}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Procedimentos Prioritários - {{strtoupper($page)}}</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <a class="btn @if($page == 'adl') btn-success @else btn-default @endif col-md-1 col-xs-1" href="{{route('relatorios.prioritarios','adl')}}">ADL</a>
        <a class="btn @if($page == 'apfd') btn-success @else btn-default @endif col-md-1 col-xs-1" href="{{route('relatorios.prioritarios','apfd')}}">APFD</a>
        <a class="btn @if($page == 'cd') btn-success @else btn-default @endif col-md-1 col-xs-1" href="{{route('relatorios.prioritarios','cd')}}">CD</a>
        <a class="btn @if($page == 'cj') btn-success @else btn-default @endif col-md-1 col-xs-1" href="{{route('relatorios.prioritarios','cj')}}">CJ</a>
        <a class="btn @if($page == 'desercao') btn-success @else btn-default @endif col-md-2 col-xs-2" href="{{route('relatorios.prioritarios','desercao')}}">Deserção</a>
        <a class="btn @if($page == 'fatd') btn-success @else btn-default @endif col-md-1 col-xs-1" href="{{route('relatorios.prioritarios','fatd')}}">FATD</a>
        <a class="btn @if($page == 'ipm') btn-success @else btn-default @endif col-md-1 col-xs-1" href="{{route('relatorios.prioritarios','ipm')}}">IPM</a>
        <a class="btn @if($page == 'iso') btn-success @else btn-default @endif col-md-1 col-xs-1" href="{{route('relatorios.prioritarios','iso')}}">ISO</a>
        <a class="btn @if($page == 'it') btn-success @else btn-default @endif col-md-1 col-xs-1" href="{{route('relatorios.prioritarios','it')}}">IT</a>
        <a class="btn @if($page == 'sindicancia') btn-success @else btn-default @endif col-md-1 col-xs-1" href="{{route('relatorios.prioritarios','sindicancia')}}">Sindicancia</a>
        <a class="btn @if($page == 'pad') btn-success @else btn-default @endif col-md-1 col-xs-1" href="{{route('relatorios.prioritarios','pad')}}">PAD</a>
    <div>
</section>