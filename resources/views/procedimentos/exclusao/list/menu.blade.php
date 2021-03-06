<section class="content-header nopadding">  
    <h1>Exclusão - {{$title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Exclusão - {{$title}}</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <div class="btn-group col-md-6 col-xs-12 nopadding">
            <a class="btn @if($page == 'lista') btn-success @else btn-default @endif col-md-6 col-xs-6" href="{{route('exclusao.lista')}}">Consulta</a>
            @if(session('is_admin'))
            <a class="btn @if($page == 'apagados') btn-success @else btn-default @endif col-md-6 col-xs-6" href="{{route('exclusao.apagados')}}">Apagados</a>
            @else 
            <span class="col-md-6 col-xs-6"></span>
            @endif
        </div>
        @if(hasPermissionTo('criar-exclusao'))
        <div class="col-md-6 col-xs-12 litlepadding">
            <a class="btn btn-block btn-primary" href="{{route('exclusao.create')}}">
            <i class="fa fa-plus"></i> Adicionar Exclusão</a>
        </div>
        @endif
    <div>
</section>