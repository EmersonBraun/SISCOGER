<?php
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

if (!$iso->sjd_ref_ano) $iso->sjd_ref_ano=$_SESSION[sjd_ano];

if ($opcao=="atualizar") {
$sql="SELECT * FROM envolvido WHERE situacao='Paciente' AND id_iso='".$iso->id_iso."'";
$resI=mysql_query($sql);
if ($resI) $indiciados=mysql_num_rows($resI);

$sql="SELECT * FROM ofendido WHERE situacao='Ofendido' AND id_iso='".$iso->id_iso."'";
$resO=mysql_query($sql);
if ($resO) $ofendidos=mysql_num_rows($resO);

//ligacoes
	$sqlL="SELECT * FROM ligacao WHERE destino_proc='iso' AND destino_sjd_ref='".$iso->sjd_ref."' AND destino_sjd_ref_ano='".$iso->sjd_ref_ano."'";
	$resL=mysql_query($sqlL);
	$ligacoes=mysql_num_rows($resL);

}

if (!$indiciados) $indiciados=1;
if (!$ofendidos) $ofendidos=0;


?>

<script language=javascript>
function validar(form) {
	campo=document.getElementsByName('iso[id_andamento]')[0];
	if (campo.value=="") {
		window.alert("Preencha o andamento!"); campo.focus(); return false;
	}
return true;
}
</script>
<?
?>

<form ID='iso' class="controlar-modificacao" name="iso" action="index.php?module=iso" method=post onSubmit="return validar(this);" enctype="multipart/form-data">
<input type="hidden" name="iso[id_iso]">
<input type="hidden" name="iso[sjd_ref]">
<input type="hidden" name="iso[sjd_ref_ano]">

<!-- iso -->
<?if ($opcao=="cadastrar"){?><center><h1>Novo Inqu&eacute;rito Sanit&aacute;rio de Origem</h1></center><?}?>
<?if ($opcao=="atualizar"){?><center><h1>Inqu&eacute;rito Sanit&aacute;rio de Origem</h1></center><?}?>

<table cellpadding="0" cellspacing="1" width="100%" border="0"><tr><td colspan=2 bgcolor="#4682B4">
<table cellspacing="1" width="100%" border="0">
	<?if ($opcao=="cadastrar"){?>
	<tr><th colspan="5" bgcolor="#DBEAF5"><font face="tahoma, verdana" size="2">Formulário de 
preenchimento</font></th></tr> 	<?}?>
	<?if ($opcao=="atualizar"){?>
	<tr>
		<td align="center" colspan="2" bgcolor="#DBEAF5">
		Visualização e atualização | 
		<a href="?module=movimento&movimento[id_iso]=<?=$iso->id_iso;?>">Movimentos</a> |
		<a href="?module=sobrestamento&sobrestamento[id_iso]=<?=$iso->id_iso;?>">Sobrestamentos</a>
		</td>
	</tr>
	<?}?>

</tr></table>
</table>

<table border=0 width=100%>

<?

form::openTR();
	form::openTD("width='50%' colspan=1");
		form::openLabel("N&ordm; do ISO e andamento");
		if ($iso->sjd_ref) {
			echo "<input readonly name='numeracao' type='text' value='".$iso->sjd_ref."/".$iso->sjd_ref_ano."'>";
		}
		else {
			echo "<input readonly name='numeracao' type='text' value='*/".$_SESSION[sjd_ano]."'>";
		}
		formulario::option("iso","andamento","WHERE procedimento='iso'");
		form::closeLabel();
	form::closeTD();
	openTD();
		form::openLabel("Tramite administrativo");
			formulario::option("iso","andamentocoger","WHERE procedimento='iso'");
		form::closeLabel();
	closeTD();
	/*
	form::openTD("colspan='1' width='50%'");
		form::openLabel("OPM");
			echo "<select name='iso[cdopm]>'";
				include ("includes/option_opm.php");
			echo "</select>";
		form::closeLabel();
	form::closeTD();
	*/
form::closeTR();

form::openTR();
	form::openTD("colspan=2");
		$indice=0;
		if ($_SESSION['debug'])  { 
			pre($sql); pre("Procedimentos de origem encontrados: $total");
		}
		formulario::subform("ligacao",$ligacoes,"Procedimento(s) de Origem (apenas se houver)");
		form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("width='50%'");
		form::input("Data do fato","iso[fato_data]");
	form::closeTD();
	form::openTD("width='50%'");
		form::input("Data da abertura","iso[abertura_data]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='2' width='100%'");
		$opcoes=" id='sintese_txt' rows='7' cols='80' ";
		form::input("S&iacute;ntese do fato","iso[sintese_txt]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='1' width='50%'");
		form::input("Tipo penal","iso[tipo_penal]");
	form::closeTD();
	form::openTD("colspan='1' width='50%'");
		$textoForm="<select name='iso[doc_tipo]' $opcaoGeral2>
			<option value=''>Escolha</option>
			<option value='BG'>BG</option>
			<option value='BI'>BI</option>
			<option value='BR'>BR</option>\r\n</select>";
		$textoForm.="&nbsp;N&ordm;&nbsp;";
		$textoForm.="<input type='text' name='iso[doc_numero]' maxlength=8 onkeyup='formatar(this,\"###/####\")' $opcaoGeral2>"; 		form::input("Documento da publica&ccedil;&atilde;o","",$textoForm);
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='1' width='50%'");
		form::input("N&ordm; da portaria da Corregedoria ou do Comandante","iso[portaria_numero]","####/####");
	form::closeTD();
	form::openTD("colspan='1' width='50%'");
		form::input("Data da portaria","iso[portaria_data]");
	form::closeTD();
form::closeTR();

?>

<!--Encarregado e Escrivão-->
<?
if ($opcao=="atualizar")
$encarregado=new envolvido("WHERE rg_substituto='' AND situacao='Encarregado' AND id_iso='".$iso->id_iso."'","","simples");

?>

<table border=0 width=100%>
<tr><td>

<table cellpadding="1" cellspacing="1" width="100%" bgcolor="#EEEEEE"><tr><td>
<table align=center border=0 cellpadding="0" cellspacing="1" width="100%">
	<tr><th colspan="5" bgcolor="#EEEEEE"><font face="tahoma, verdana" size="2">Membros</font></th></tr>
	<tr bgcolor=white align=center><td>RG</td><td valign="center">Nome<a href='http://10.47.1.8/pm/consultapm.php' target="_blank"><img border=0 src='img/lupa.gif' width="20" /></a></td><td>Posto/Graduação</td><td>Situação</td><td>Ação</td></tr>
	<tr bgcolor=white>
		<input type="hidden" name="envolvido[encarregado][id_envolvido]">
		<input type="hidden" name="envolvido[encarregado][id_iso]">
		<td><input type=text size=12 name=envolvido[encarregado][rg] onkeypress='return DigitaNumeroTempoReal(this,event)' onblur="ajaxForm(this,'policial',Array('nome','cargo'));" <?php echo $opcaoGeral2;?>></td>
		<td><input readonly type=text size=30 ajax=1 name=envolvido[encarregado][nome]></td>
		<td><input readonly type=text size=10 name="envolvido[encarregado][cargo]"></td>
		<td><input readonly type=text size=15 name="envolvido[encarregado][situacao]" value="Encarregado"></td>
		<?
		$deletar=false;
		if ($opcao=="atualizar") $id=$encarregado->id_envolvido;
		if ($user['nivel']<>6 && $user['nivel']<>7) include ("includes/botoes.inc");
		?>
	</tr>
</table>
</td></tr></table>
<!-- Fim Encarregado e Escrivão -->


<!-- Indiciados -->
	<?formulario::subform("envolvido",$indiciados,"Pacientes");?>
<!-- Fim Indiciados -->
<br>
</td></tr>
<tr><td>
<?
if ($user['nivel']<>6 && $user['nivel']<>7) {
	if ($opcao=="cadastrar") echo "<input type='submit' name='acao' value='Cadastrar'>";
	if ($opcao=="atualizar") echo "<input type='submit' name='acao' value='Atualizar'>";
	if ($user[nivel]==5 and $iso->id_iso) echo "&nbsp;<input type='submit' name='acao' value='Apagar'>";
}
?>
</td></tr>

</table>

</form>

<?
//Preenchimento automático formulário
if ($iso) {
	formulario::values($iso);
	
	formulario::values($encarregado, "envolvido[encarregado]");
	$i=1;
        while  ($row=@mysql_fetch_assoc($resI)) {
                formulario::values($row,"envolvido[$i]");
		if ($row[rg] and $user['nivel']<>5) echo "<script>document.getElementsByName('envolvido[$i][rg]')[0].disabled=true;</script>";
                $i++;
        }
	if ($ligacoes) {
		$i=1;
		while ($rowL=mysql_fetch_assoc($resL)) {
			formulario::values($rowL,"ligacao[$i]");
			$i++;
		}
	}
}

?>
