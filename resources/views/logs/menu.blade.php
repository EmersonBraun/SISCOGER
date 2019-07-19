<section class="content-header nopadding">  
    <h1><i class="fa fa-bug"></i> LOG - {{$title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">LOG - {{$title}}</li>
    </ol>
    <br>   
    <div class="btn-group col-md-12 col-xs-12 nopadding">
        <a class="btn @if($page == 'created') btn-success @else btn-default @endif col-md-3 col-xs-3" href="{{route('log.created',$title)}}">Criados</a>
        <a class="btn @if($page == 'updated') btn-success @else btn-default @endif col-md-3 col-xs-3" href="{{route('log.updated',$title)}}">Atualizados</a>
        <a class="btn @if($page == 'deleted') btn-success @else btn-default @endif col-md-3 col-xs-3" href="{{route('log.deleted',$title)}}">Apagados</a>
        <a class="btn @if($page == 'restored') btn-success @else btn-default @endif col-md-3 col-xs-3" href="{{route('log.restored',$title)}}">Restaurados</a>
    </div>
</section>
