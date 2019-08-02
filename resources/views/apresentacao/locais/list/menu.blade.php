<section class="content-header nopadding">  
    <h1>Nota COGER - {{$title}} {{$ano}}</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Nota COGER - {{$title}}</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <div class="btn-group col-md-8 col-xs-12 nopadding">
            <a class="btn @if($page == 'index') btn-success @else btn-default @endif col-md-6 col-xs-6" href="{{route('notacoger.index',['ano' => $ano])}}">Consulta</a>
            <a class="btn @if($page == 'apagados') btn-success @else btn-default @endif col-md-6 col-xs-6" href="{{route('notacoger.apagados',['ano' => $ano])}}">Apagados</a>
        </div>
        @if(hasPermissionTo('criar-nota-coger'))  
            <div class="col-md-2 col-xs-12 litlepadding">
                <a class="btn btn-block btn-primary" href="{{route('notacoger.create')}}">
                <i class="fa fa-plus"></i> Adicionar Nota Coger</a>
            </div>
        @endif
        <div class='col-md-2 col-xs-6  pull-right'>
            <div class="pull-right">
                <label for="navegaco">Listar ano: </label>
                <select class="" id="navegacao" data-toggle="tooltip" data-placement="bottom" 
                title="O ano apenas modifica a listagem,os dados continuam sendo inseridos em {{date('Y')}}"> 
                  <option selected='selected'> {{ $ano }} </option>
                    @for ($i = date('Y'); $i >= 2008; $i--)
                        @if($i != $ano)
                        <option onclick="javascript:location.href='{{route('notacoger.'.$page,['ano' => $i])}}'"> {{ $i }} </option>
                        @endif
                    @endfor  
                </select> 
            </div>
        </div>
    <div>
</section>
