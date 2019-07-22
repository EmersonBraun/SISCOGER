<?php
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

if (!$desercao->sjd_ref_ano) $desercao->sjd_ref_ano=$_SESSION[sjd_ano];

if ($opcao=="atualizar") {
//envolvidos
	$sql="SELECT * FROM envolvido WHERE situacao='Desertor' AND id_desercao='".$desercao->id_desercao."'";
	$resI=mysql_query($sql);
	if ($resI) $indiciados=mysql_num_rows($resI);
	$desertor=mysql_fetch_assoc($resI);

}



if (!$indiciados) $indiciados=1;
if (!$ofendidos) $ofendidos=0;

?>

<form ID='desercao' class="controlar-modificacao" name="desercao" action="index.php?module=desercao" method=post onSubmit="return validar(this);">
<input type="hidden" name="desercao[id_desercao]">
<input type="hidden" name="desercao[sjd_ref]">
<input type="hidden" name="desercao[sjd_ref_ano]">

<!-- desercao -->
<?if ($opcao=="cadastrar"){?><center><h1>Cadastrar Desercao</h1></center><?}?>
<?if ($opcao=="atualizar"){?><center><h1>Desercao</h1></center><?}?>

<table cellspacing="1" width="100%" border="0">

</tr></table>

<table border=0 width=100% class='bordasimples'>

	<?if ($opcao=="cadastrar"){?>
	<tr><td colspan="5" bgcolor="#E0E0E0"><font face="tahoma, verdana" size="2">Formulário de 
preenchimento</font></th></tr> 	<?}?> 	<?if ($opcao=="atualizar"){?>
	<tr>
	<td align="center" colspan="2" bgcolor="#DBEAF5">Visualização e atualização
	| <a href="?module=movimento&movimento[id_desercao]=<?=$desercao->id_desercao;?>">Movimentos</a>
	| <a href="?module=envolvido&opcao=indiciado&desercao[id]=<?=$desercao->id_desercao;?>">R&eacute;u(s)</a>
	<?if ($user['nivel']==4 || $user['nivel']==5){?>
	| <a href="?module=arquivo&arquivo[id_desercao]=<?=$desercao->id_desercao;?>">Arquivo</a>
	</td></tr>
	<?}}?>

<?
if ($user['nivel']==4 || $user['nivel']==5)
{
	form::openTD("colspan='5'");
		echo "<hr>O Procedimento é prioritário?(só preencha se tiver certeza)
		<select name='desercao[prioridade]'>
			<option value='0'>N&Atilde;O</option>
			<option value='1'>SIM</option>
		</select>
		<hr>";
	form::closeTR();
}
//
form::openTR();
	form::openTD("width='50%' colspan=1");
	form::openLabel("Nº da deser&ccedil;&atilde;o e OPM");
		if ($desercao->sjd_ref) {
			echo "<input readonly name='numeracao' type='text' value='".$desercao->sjd_ref."/".$desercao->sjd_ref_ano."'>";
		}
		else {
			echo "<input readonly name='numeracao' type='text' value='*/".$_SESSION[sjd_ano]."'>";
		}
		echo "<select name='desercao[cdopm]' $opcaoGeral2>";
			include ("includes/option_opm.php");
		echo "</select>";
	form::closeLabel();
	form::closeTD();
	form::openTD("colspan='1' width='50%'");
		form::openLabel("Andamento COGER");
			if ($user['nivel']>=4)
			formulario::option("desercao","andamentocoger","WHERE procedimento='desercao'");			
			else
			echo "<input type='text' disabled name='sopramostrar' value='".$desercao->andamentocoger->andamentocoger."'>";
		form::closeLabel();
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan=1 width='50%'");
		form::input("Data do fato","desercao[fato_data]");
	form::closeTD();
	form::openTD("colspan='1' width='50%'");
		$textoForm="<select name='desercao[doc_tipo]' $opcaoGeral2>
			<option value=''>Escolha</option>
			<option value='BG'>BG</option>
			<option value='BI'>BI</option>
			</select>";
		$textoForm.="&nbsp;N&ordm;&nbsp;";
		$textoForm.="<input type='text' name='desercao[doc_numero]' maxlength=8 onkeyup='formatar(this,\"###/####\")' $opcaoGeral2>"; 		form::input("Documento da publica&ccedil;&atilde;o","",$textoForm);
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD();
		form::openLabel("Termo");
		echo "<select name='desercao[termo_exclusao]' $opcaoGeral2>\r\n";
		echo "<option value=''>Escolha</option>";
		echo "<option value='Exclusao'>Exclus&atilde;o</option>";
		echo "<option value='Agregacao'>Agrega&ccedil;&atilde;o</option>";
		echo "</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::input("Publicado no (Ex: BG 110/2010)","desercao[termo_exclusao_pub]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD();
		form::openLabel("Termo");
		echo "<select name='desercao[termo_captura]' $opcaoGeral2>\r\n";
		echo "<option value=''>Escolha</option>";
		echo "<option value='Captura'>Captura</option>";
		echo "<option value='Apresentacao espontanea'>Apresenta&ccedil;&atilde;o Espont&acirc;nea</option>";
		echo "</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::input("Publicado no (Ex: BG 110/2010)","desercao[termo_captura_pub]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD();
		form::openLabel("Pericia?");
		echo "<select name='desercao[pericia]' $opcaoGeral2>\r\n";
		echo "<option value=''>Escolha</option>";
		echo "<option value='Sim'>Sim</option>";
		echo "<option value='Nao'>Nao</option>";
		echo "</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::input("Publicado no (Ex: BG 110/2010)","desercao[pericia_pub]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD();
		form::openLabel("Termo");
		echo "<select name='desercao[termo_inclusao]' $opcaoGeral2>\r\n";
		echo "<option value=''>Escolha</option>";
		echo "<option value='Inclusao'>Inclus&atilde;o</option>";
		echo "<option value='Reversao'>Revers&atilde;o</option>";
		echo "</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::input("Publicado no (Ex: BG 110/2010)","desercao[termo_inclusao_pub]");
	form::closeTD();
form::closeTR();

openTR();
	openTD();
		form::input("Referencia VAJME (N&ordm; do processo, vara)","desercao[referenciavajme]");
	closeTD();
closeTR();

form::openTR();
	form::openTD("colspan=2");
		echo "<h5>Desertor</h5>";
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan=2");
		$indice=1;
		include ("modules/envolvido/subformulario.inc");
	form::closeTD();
form::closeTR();


?>


<!-- Indiciados -->
	<?
//formulario::subform("envolvido",$indiciados,"Desertor");?>
<!-- Fim Indiciados -->
</td></tr>
<tr><td>
<?
if ($user['nivel']<>6 && $user['nivel']<>7)  {
	if ($opcao=="cadastrar") echo "<input type='submit' name='acao' value='Cadastrar'>";
	if ($opcao=="atualizar" and $user['nivel']>1) echo "<input type='submit' name='acao' value='Atualizar'>";
	if ($user['nivel']>=5 and $opcao!="cadastrar") echo "<input type='submit' name='acao' value='Apagar'>";
}
?>
</td></tr>

</table>

</form>

<?
//Preenchimento automático formulário
if ($desercao) {
	formulario::values($desercao);
	if ($desertor) {
		formulario::values($desertor,"envolvido[1]");
		if ($user['nivel']<>5) echo "<script>document.getElementsByName('envolvido[1][rg]')[0].disabled=true;</script>";
	}

}

if ($user['nivel']<2) js::desativaTudo();

?>
