<?
$module=$_REQUEST[module];
if ($module=="sai") $situacao="Juntado";


?>
<form name="saidocumentos" action="index.php?module=sai" method="POST" enctype="multipart/form-data">
<table class="bordacinza" width=100% bgcolor="White" cellspacing=1>
<tbody>
	<?if ($indice==1 or !isset($indice) or $module=="sai") { ?> 
	<!-- Cabeçalho do Grid -->
	<TR><TD>Nome do documento</TD><td>Documento</td><td></td></TR>
	<!-- Fim cabeçalho do Grid -->
	<? } ?>
	
	<TR>
	<input type="hidden" name="saidocumentos[<?=$indice?>][id_saidocumentos]">
	<input type="hidden" name="saidocumentos[<?=$indice?>][id_<?=$module;?>]">
	<td><input size="15" type="text" name="saidocumentos[<?=$indice;?>][nome_documento]"></td>
	<?php /*
	form::openTD("colspan='2' width='50%'");
		form::input("Documento","saidocumentos["$indice"]["documento_file"]");
	form::closeTD();*/
	?>
	<td><input type="file" size="30" name="saidocumentos[<?=$indice;?>][documento_file]"></td>
	<td><input readonly type="text" size="15" name="saidocumentos[<?=$indice;?>][situacao]" value='<? echo $situacao;?>'></td> 	<td><?botao::excluir("saidocumentos",$indice);?></td>
	</TR>
</tbody>
</table>
</form>