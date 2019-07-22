<?php
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco
	if (!is_array($sjd_procedimentos)) { include("/var/www/sjd/define.php"); }
	$procedimentos=$sjd_procedimentos;
?>
<table class="bordacinza" width=100% bgcolor="White" cellspacing=1>
<tbody>
	<tr>
	<input type="hidden" name="ligacao[<?=$indice?>][id_ligacao]">
	<td>
		<select id="<?php echo 'proc'.$indice; ?>" name="ligacao[<?=$indice?>][origem_proc]" <?php echo $opcaoGeral2;?>>
		<option value=''>Escolha</option>
		<?php
		foreach ($procedimentos as $proc) { 
			//NAO PODE SE ORIGINAR DA DESERCAO NEM DO APFD
			if ($proc=="apfd") {
				echo "<option value='apfdc'>apfd comum</option>";
				echo "<option value='apfdm'>apfd militar</option>";
			}
			else echo "<option value='$proc'>$proc</option>";
		}
		?>
		</select>
	</td>
	<td>
		N&ordm;
		<input id="<?php echo 'ref'.$indice; ?>" onkeypress='return dntr(this,event)' onblur="ajaxLigacao('<?echo $indice?>')"
		type="text" size="3" maxlength='4' name="ligacao[<?=$indice;?>][origem_sjd_ref]" <?php echo $opcaoGeral2;?>>/
		<input id="<?php echo 'ano'.$indice; ?>" onkeypress='return dntr(this,event)' onblur="ajaxLigacao('<?echo $indice?>')"
		type="text" size="3" maxlength='4' name="ligacao[<?=$indice;?>][origem_sjd_ref_ano]" <?php echo $opcaoGeral2;?>>
		<font color='red'>&nbsp;(Ano com 4 digitos)</font>
	</td>
	<td>
		OPM: <input id="<?php echo 'opm'.$indice; ?>" readonly type='text' size='15' name="ligacao[<?=$indice;?>][origem_opm]">
		<font color='darkblue'> (Apenas para confer&ecirc;ncia)</font>
	</td>
	<td>
		<?php if (!$opcaoGeral2) botao::excluir("ligacao",$indice); ?>
	</td>

	</tr>
</tbody>
</table>
