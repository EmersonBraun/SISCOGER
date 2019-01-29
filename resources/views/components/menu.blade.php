<div class='form-group col-md-12 col-xs-12 nopadding'>
    {{-- se 'prop' => ['0','outro valor']  usa apenas o botão--}}
    @if($prop['0'] != 0)
    <div class='btn-group col-md-{{$prop['0']}} col-xs-12 nopadding'>
        @forelse ($menu as $m)
        <a class="btn btn-{{$m['type'] ?? 'default'}} col-md-{{$m['md'] ?? '12'}} col-xs-{{$m['xs'] ?? '12'}}"  href="{{route($m['route'])}}">
                {{$m['name']}}
            </a>
        @empty
            <a class="btn btn-success col-md-12 col-xs-12 "  href="{{route($title.'.lista')}}">Lista</a>  
        @endforelse
    @endif
    </div>
    {{-- se 'prop' => ['outro valor', '0']  usa apenas o menu--}}
    @if($prop['1'] != 0)
        <div class='col-md-{{$prop['1']}} col-xs-12 litlepadding'>
            <a class="btn btn-block btn-primary"  href="{{route(strtolower(tira_acentos($title)).'.create')}}">
            <i class="fa fa-plus"></i> Adicionar {{$title}}</a>
        </div>
    @endif
    {{-- se 'prop' => ['outro valor', 'outro valor', 'esse']  usa ano--}}
    {{-- @if($prop['2'] != 0)
    <div class='col-md-{{$prop['2']}} col-xs-6  pull-right'>
        <div class="pull-right">
        <label for="navegaco">Listar ano: </label>
        <select class="" id="navegacao" data-toggle="tooltip" data-placement="bottom" 
        title="O ano apenas modifica a listagem,os dados continuam sendo inseridos em {{date('Y')}}"> 
        <option selected='selected'> {{ $ano }} </option>
        @for ($i = date('Y'); $i >= 2008; $i--)
            @if($i != $ano)
            <option onclick="javascript:location.href='{{route($route,['ano' => $i])}}'"> {{ $i }} </option>
            @endif
        @endfor  
        </select> 
        </div>
    </div>
    @endif --}}
<div>

        