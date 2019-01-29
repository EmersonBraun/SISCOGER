{{-- compatibilidade para atualização dos dados --}}
@php if(!isset($indice)) $indice = $relacao['id_ligacao']; @endphp
<input type="hidden" name="ligacao[{{$indice}}][id_ligacao]" value="@if(isset($relacao['id_ligacao'])) {{$relacao['id_ligacao']}} @endif">
    <div class="col-lg-3 col-md-3 col-xs 3">
		@if(isset($relacao['origem_proc'])) 
		<input type="hidden" name="ligacao[{{$indice}}][origem_proc]" value="{{$relacao['id_ligacao']}}">
		@else
			<select id="proc{{$indice}}" name="ligacao[{{$indice}}][origem_proc]" class="form-control">
			<option value=''>Escolha</option>
				@foreach (config('sistema.pocedimentosOpcoes') as $proc) 
					{{-- NAO PODE SE ORIGINAR DA DESERCAO NEM DO APFD --}}
					
					@if ($proc=="apfd")
						<option value='apfdc'>apfd comum</option>
						<option value='apfdm'>apfd militar</option>
					@else 
						<option value='{{$proc}}'>{{$proc}}</option>
					@endif
				@endforeach
			</select>
		@endif
	</div>
    <div class="col-lg-2 col-md-2 col-xs 2">
		<input class="numero form-control" id="ref{{$indice}}" onchange="ajaxLigacao('{{$indice}}')"
		type="text" maxlength='4' name="ligacao[{{$indice}}][origem_sjd_ref]" placeholder="Nº"
		value="@if(isset($relacao['origem_sjd_ref'])) {{$relacao['origem_sjd_ref']}} @endif" >
    </div>
    <div class="col-lg-3 col-md-3 col-xs 3">
        <input class="numero form-control" id="ano{{$indice}}" onchange="ajaxLigacao('{{$indice}}')"
		type="text" maxlength='4' name="ligacao[{{$indice}}][origem_sjd_ref_ano]" placeholder="Ano com 4 digitos"
		value="@if(isset($relacao['origem_sjd_ref_ano'])) {{$relacao['origem_sjd_ref_ano']}} @endif">
	</div>
    <div class="col-lg-3 col-md-3 col-xs 3">
		<input id="opm{{$indice}}" readonly type='text' size='35' name="ligacao[{{$indice}}][origem_opm]" placeholder="Apenas para conferência"
		value="@if(isset($relacao['origem_opm'])) {{$relacao['origem_opm']}} @endif" class="form-control">
	</div>
    <div class="col-lg-1 col-md-1 col-xs 1">
        <a href="javascript:removerForm('ligacao',{{$indice}});"><i class="fa fa-times" style='color: red'></i></a>
	</div>

	</tr>
</tbody>
</table>