<section class="content-header nopadding">  
    <h1>Recurso - {{$title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Recurso - {{$title}}</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <div class="btn-group col-md-10 col-xs-12 nopadding">
            @foreach ($procs as $proc)
            <a class="btn @if($page == $proc['procedimento']) btn-success @else btn-default @endif col-md-1 col-xs-1" href="{{route('recurso.proc',$proc['procedimento'])}}">{{$proc['procedimento']}}</a>  
            @endforeach
            <a class="btn @if($page == 'lista') btn-success @else btn-default @endif col-md-3 col-xs-3" href="{{route('recurso.lista')}}">Consulta</a>
            @if(session('is_admin'))
            <a class="btn @if($page == 'apagados') btn-success @else btn-default @endif col-md-2 col-xs-2" href="{{route('recurso.apagados')}}">Apagados</a>
            @else 
            <span class="col-md-6 col-xs-6"></span>
            @endif
        </div>
        @if(hasPermissionTo('criar-recursos'))
        <div class="col-md-2 col-xs-12 litlepadding">
            <a class="btn btn-block btn-primary" href="{{route('recurso.create')}}">
            <i class="fa fa-plus"></i> Adicionar Recurso</a>
        </div>
        @endif
    <div>
</section>