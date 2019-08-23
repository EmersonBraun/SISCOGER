<section class="content-header nopadding">  
    <h1>Policiais Punidos - {{$title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Policiais Punidos - {{$title}}</li>
    </ol>
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <a class="btn @if($page == 'geral') btn-success @else btn-default @endif col-md-6 "href="{{route('punido.index')}}">Geral</a>
        <a class="btn @if($page == 'conselho') btn-success @else btn-default @endif col-md-6 "href="{{route('punido.conselho')}}">Conselhos</a>
    <div>
</section>