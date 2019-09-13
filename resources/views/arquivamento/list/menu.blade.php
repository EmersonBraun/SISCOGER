<section class="content-header nopadding">  
    <h1>Arquivo - {{$title}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Arquivo - {{$title}}</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <div class="btn-group col-md-12 col-xs-12 nopadding">
            <a class="btn @if($page == 'coger') btn-success @else btn-default @endif col-xs-3 " href="{{route('arquivamento.local','coger')}}">COGER</a>
            <a class="btn @if($page == 'cautela') btn-success @else btn-default @endif col-xs-3 " href="{{route('arquivamento.local','cautela')}}">Cautela</a>
            <a class="btn @if($page == 'pmpr') btn-success @else btn-default @endif col-xs-3 " href="{{route('arquivamento.local','pmpr')}}">Arquivo Geral PMPR</a>
            <a class="btn @if($page == 'prateleira') btn-success @else btn-default @endif col-xs-3 " href="{{route('arquivamento.prateleira',$numero)}}">Arquivo Prateleiras</a>
        </div>
    <div>
</section>