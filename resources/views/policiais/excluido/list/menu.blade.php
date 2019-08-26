<section class="content-header nopadding">  
    <h1>Exluído - {{$title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Exluído - {{$title}}</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <a class="btn @if($page == 'conselho') btn-success @else btn-default @endif col-md-6 col-xs-12" href="{{route('excluido.conselho')}}">Conselho</a>
        <a class="btn @if($page == 'judicial') btn-success @else btn-default @endif col-md-6 col-xs-12" href="{{route('excluido.judicial')}}">Judicial</a>
    <div>
</section>