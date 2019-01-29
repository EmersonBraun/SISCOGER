{{-- compatibilidade para atualização dos dados --}}
@php if(!isset($indice)) $indice = $relacao['id_envolvido']; @endphp
<div style="display: none">
    <input class="form-control" type="hidden" name="envolvido[{{$indice}}][id_envolvido]" value="@if(isset($relacao['id_envolvido']))  {{$relacao['id_envolvido']}}@endif">
    <input class="form-control" type="hidden" name="envolvido[{{$indice}}][id_{{$proc}}]" value="@if(isset($relacao['id_'.$proc])) {{$relacao['id_'.$proc]}}@endif">
    <input class="form-control" type="hidden" name="envolvido[{{$indice}}][situacao]" value="{{$situacao ?? $relacao['situacao']}}">
</div>
<div class="col-lg-3 col-md-3 col-xs 3">    
    <input class="form-control" required="true" size="12" type="text" name="envolvido[{{$indice}}][rg]" value="@if(isset($relacao['rg'])) {{$relacao['rg']}}@endif" onblur="completaDados($(this).val(),'{{$indice}}nome', '{{$indice}}cargo');" placeholder="RG">
</div>
<div class="col-lg-3 col-md-3 col-xs 3">
    <input class="form-control" readonly="true" type="text" size="30" value="@if(isset($relacao['nome'])) {{$relacao['nome']}}@endif" name="envolvido[{{$indice}}][nome]" id="{{$indice}}nome" placeholder="Nome">
</div>
<div class="col-lg-3 col-md-3 col-xs 3">
    <input class="form-control" readonly="true" type="text" size="10" value="@if(isset($relacao['cargo'])) {{$relacao['cargo']}}@endif" name="envolvido[{{$indice}}][cargo]" id="{{$indice}}cargo" placeholder="Posto/Grad.">
</div>
<div class="col-lg-2 col-md-2 col-xs 2">
    @if ($proc == 'apfd')
    <input class="form-control" value="Acusado" readonly name="envolvido[{{$indice}}][resultado]" id="{{$indice}}cargo" placeholder="Resultado">  
    @else
        <select class="form-control" name="envolvido[{{$indice}}][resultado]">
            @foreach (config('sistema.envolvido'.ucfirst($proc)) as $r)  
                <option value="{{$r}}" @if (isset($relacao['resultado'])) selected @endif>{{$r}}</option>
            @endforeach
        </select>
    @endif
</div>
<div class="col-lg-1 col-md-1 col-xs 1">
    @if(!$unico)
        <a href="javascript:removerForm('envolvido',{{$indice}});"> 
        <i class="fa fa-times" style="color: red"></i>
        </a>
    @endif 
</div>
