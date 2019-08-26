<section class="content-header nopadding">  
    <h1>Policiais Punidos - {{$title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Policiais Punidos - {{$title}}</li>
    </ol>
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <a class="btn @if($page == 'fatd') btn-success @else btn-default @endif col-md-2 "href="{{route('punido.index','fatd')}}">FATD</a>
        <a class="btn @if($page == 'cd') btn-success @else btn-default @endif col-md-2 "href="{{route('punido.index','cd')}}">CD</a>
        <a class="btn @if($page == 'cj') btn-success @else btn-default @endif col-md-2 "href="{{route('punido.index','cj')}}">CJ</a>
        <a class="btn @if($page == 'adl') btn-success @else btn-default @endif col-md-2 "href="{{route('punido.index','adl')}}">ADL</a>
        <a class="btn @if($page == 'NA') btn-success @else btn-default @endif col-md-2 "href="{{route('punido.index','NA')}}">NA</a>
        <a class="btn @if($page == 'conselho') btn-success @else btn-default @endif col-md-2 "href="{{route('punido.conselho')}}">Conselhos</a>
    <div>
</section>