<section class="content-header nopadding">  
    <h1>Autoridades - {{$title}} </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Autoridades - {{$title}}</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <a class="btn @if($page == 'comando') btn-success @else btn-default @endif col-xs-4" href="{{route('autoridadeom.comando')}}">Comando/Direção</a>
        <a class="btn @if($page == 'outras') btn-success @else btn-default @endif col-xs-4" href="{{route('autoridadeom.outras')}}">Outras</a>
        @if(hasPermissionTo('editar-dados-unidade'))  
            <a class="btn btn-block btn-primary" href="{{route('autoridadeom.form')}}">
            <i class="fa fa-plus"></i> Alterar dados OM</a>
        @endif
    <div>
</section>