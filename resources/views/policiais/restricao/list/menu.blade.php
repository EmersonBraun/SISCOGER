<section class="content-header nopadding">  
        <h1>Restrições - {{$title}} {{$ano}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Restrições - {{$title}}</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <div class="btn-group col-md-4 col-xs-12 nopadding">
            <a class="btn @if($page == 'index') btn-success @else btn-default @endif col-xs-12 " href="{{route('restricao.index')}}">Consulta</a>
        </div>
        <div class="col-md-4 col-xs-12 litlepadding">
            <a class="btn btn-block btn-primary" href="{{route('busca.pm')}}">Busca PM</a>
        </div>
        <div class="col-md-4 col-xs-12 litlepadding form">
            <select class="form-control" id="navegacao"> 
                <option selected='selected'> {{ $ano }} </option>
                @for ($i = date('Y'); $i >= 2008; $i--)
                    @if($i != $ano)
                    <option onclick="javascript:location.href='{{route('restricao.'.$page,['ano' => $i])}}'"> {{ $i }} </option>
                    @endif
                @endfor  
            </select> 
        </div>
    <div>
</section>