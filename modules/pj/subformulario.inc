<?php
$module=$_REQUEST["module"];
?>

<table class="bordacinza" width=100% bgcolor="White" cellspacing=1>
<tbody>
	<TR>
	<input type="hidden" name="pj[<?=$indice?>][id_pj]">
	<input type="hidden" name="pj[<?=$indice?>][id_<?=$module;?>]">
	<td>Razao Social:<input <?php echo $readonly; ?> <?php echo $opcaoGeral2;?> size="12" type="text" name="pj[<?=$indice;?>][razaosocial]"></td>
	<td>CNPJ:<input  name="pj[<?=$indice?>][cnpj]" type="text" size='18' maxlength='18' onkeyup="formatar(this,'##.###.###/####-##')">&nbsp;&nbsp;<font color='red'>(##.###.###/####-##)</font></td>
	<td>Pessoa contato:<input  name="pj[<?=$indice?>][contato]" type="text" size='20'></td>
	<td>Fone:<input  name="pj[<?=$indice?>][telefone]" type="text" size='10'></td>
	
	<td width='160px'>
<?php
	
	echo '<td>';
	if (!$opcaoGeral2) {
		botao::excluir("pj",$indice);
	}
	echo "<img src='img/atualizar_gray.png'></td>";
	?>
	</td>
	</tr>
</tbody>
</table>
