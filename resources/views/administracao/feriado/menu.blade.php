<section class="content-header nopadding">  
    <h1>Feriado - Lista</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Feriado - Lista</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <div class="col-md-6 col-xs-12 litlepadding">
            <a class="btn btn-block btn-default" href="{{route('feriado.index')}}">Consulta</a>
        </div>
        @if(hasPermissionTo('criar-feriados'))   
        <div class="col-md-6 col-xs-12 litlepadding">
            <a class="btn btn-block btn-primary" href="{{route('feriado.create')}}">
            <i class="fa fa-plus"></i> Adicionar Feriado</a>
        </div>
        @endif
    <div>
</section>