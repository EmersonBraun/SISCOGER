{{-- compatibilidade para atualização dos dados --}}
@php if(!isset($indice)) $indice = $relacao['id_ofendido']; @endphp
<input type="hidden" name="ofendido[{{$indice}}][id_ofendido]" value="@if(isset($relacao['id_ofendido'])) {{$relacao['id_ofendido']}} @endif">
<input type="hidden" name="ofendido[{{$indice}}][id_{{$proc}}]" value="@if(isset($relacao['id_'.$proc])) {{$relacao['id_'.$proc]}} @endif">
<input type="hidden" name="ofendido[{{$indice}}][situacao]" value='{{$situacao ?? $relacao['situacao']}}'>
<div class="col-lg-2 col-md-2 col-xs 2">
    RG:<br><input type="text" size='12' name="ofendido[{{$indice}}][rg]"
    value="@if(isset($relacao['rg'])) {{$relacao['rg']}} @endif" class="form-control">
</div>
<div class="col-lg-3 col-md-3 col-xs 3">
    Nome:<br><input type="text" size="30" name="ofendido[{{$indice}}][nome]"
    value="@if(isset($relacao['nome'])) {{$relacao['nome']}} @endif" class="form-control">
</div>
@if ($proc=="ipm")
    <div class="col-lg-3 col-md-3 col-xs 3">
    Resultado:<br>
    <select name="ofendido[{{$indice}}][resultado]" class="form-control">
        @foreach (config('sistema.ofendidoResultado') as $r)  
            <option value="{{$r}}" @if (isset($relacao['resultado'])) selected @endif>{{$r}}</option>
        @endforeach
    </select>
    </div>
@endif
<div class="col-lg-2 col-md-2 col-xs 2">
    Sexo:<br>
    <select name="ofendido[{{$indice}}][resultado]" class="form-control">
        @foreach (config('sistema.ofendidoSexo') as $r)  
            <option value="{{$r}}" @if (isset($relacao['sexo'])) selected @endif>{{$r}}</option>
        @endforeach
    </select>
</div>

@if ($proc=="sai") 

    <div class="col-lg-2 col-md-2 col-xs 2">
    Fone:<br>
        <input size='10' maxlength='20' name='ofendido[{{$indice}}][fone]' type='text'
        value="@if(isset($relacao['fone'])) {{$relacao['fone']}} @endif" class="form-control">
    </div>
    <div class="col-lg-2 col-md-2 col-xs 2">
    E-mail:<br>
        <input size='20' maxlength='40' name='ofendido[{{$indice}}][email]' type='text'
        value="@if(isset($relacao['email'])) {{$relacao['email']}} @endif" class="form-control">
    </div>

@else
    <div class="col-lg-1 col-md-1 col-xs 1">    
    Idade:<br>
        <input size='3' maxlength='3' name='ofendido[{{$indice}}][idade]' type='text'
        value="@if(isset($relacao['nome'])) {{$relacao['nome']}} @endif" class="form-control">
    </div>
    <div class="col-lg-3 col-md-3 col-xs 3">
    Escolaridade:<br>
        <select name="ofendido[{{$indice}}][escolaridade]" class="form-control">
            @foreach (config('sistema.escolaridade') as $e)  
                <option value="{{$e}}" @if (isset($relacao['escolaridade'])) selected @endif>{{$e}}</option>
            @endforeach
        </select>
    </div>
@endif
@if ($proc=="sai" || $proc=="proc_outros") 
    <div class="col-lg-3 col-md-3 col-xs 3">    
    Envolvimento:<br>
    <select name="ofendido[{{$indice}}][situacao]" class="form-control">
        @foreach (config('sistema.ofendidoSituacao') as $s)  
            <option value="{{$s}}" @if (isset($relacao['situacao'])) selected @endif>{{$s}}</option>
        @endforeach
    </select>
@endif
</div>
@if(!$unico)
<div class="col-lg-1 col-md-1 col-xs 1">
<br>
    <a href="javascript:removerForm('ofendido',{{$indice}});"> 
    <i class="fa fa-times" style="color: red"></i>
    </a>
</div> 
@endif

