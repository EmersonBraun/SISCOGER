<section class="content-header nopadding">  
    <h1>Tramitação COGER - {{$title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tramitação COGER - {{$title}}</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        @for ($i = 2005; $i <= (int) date('Y'); $i++)
            <a class="btn @if($i == $ano) btn-success @else btn-default @endif col-xs-1" href="{{route('busca.tramitacaocoger',$i)}}">{{$i}}</a>
        @endfor
    <div>
</section>