<?php

//pre($apfd);

if (!$apfd->opm_sigla) $apfd->opm_sigla=$login_unidade;
if (!$apfd->sjd_ref_ano) $apfd->sjd_ref_ano=$_SESSION[sjd_ano];

if ($opcao=="atualizar") {
$sql="SELECT * FROM envolvido WHERE situacao='Acusado' AND id_apfd='".$apfd->id_apfd."'";
$resI=mysql_query($sql);
if ($resI) $indiciados=mysql_num_rows($resI);

$sql="SELECT * FROM ofendido WHERE situacao='Ofendido' AND id_apfd='".$apfd->id_apfd."'";
if ($_SESSION[debug]) echo $sql."<br>\r\n";
$resO=mysql_query($sql);
if ($resO) $ofendidos=mysql_num_rows($resO);
}

if (!$ofendidos) $ofendidos=0;
if (!$indiciados) $indiciados=1;

if ($user['nivel']<4) {
	if ($apfd->andamentocoger->andamentocoger!="") $opcaoGeral="readonly";
}
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco
//pre($opcaoGeral);

?>

<script language=javascript>
function validar(form) {
	nome = document.apfd.sintese.value;
	if (nome == "") { 
		alert("Preencha o campo síntese do fato"); 
		document.apfd.sintese.focus(); 
		return false;
	}

	campo=document.getElementsByName("apfd[tipo]")[0];
	if (campo.value=="") {
		alert("Preencha o Tipo (Crime militar ou comum)");	campo.focus(); return false;
	}
	campo=document.getElementsByName("apfd[tipo_penal_novo]")[0];
	if (campo.value=="") {
		alert("Preencha o tipo penal");	campo.focus(); return false;
	}

}
</script>

<?
?>

<form ID='apfd' class="controlar-modificacao" name="apfd" action="index.php?module=apfd" method="post" onSubmit="return validar(this);" enctype="multipart/form-data">
<input type="hidden" name="apfd[id_apfd]">
<input type="hidden" name="apfd[sjd_ref]">
<input type="hidden" name="apfd[sjd_ref_ano]">

<!-- apfd -->
<?if ($opcao=="cadastrar"){?><center><h1>Novo Auto de Prisão em Flagrante Delito</h1></center><?}?>
<?if ($opcao=="atualizar"){?><center><h1>Auto de Prisão em Flagrante Delito</h1></center><?}?>

<table class='bordasimples' width='100%' style='margin-bottom:4px;'>
	<?if ($opcao=="cadastrar"){?>
	<tr><th colspan="5" bgcolor="#DBEAF5"><font face="tahoma, verdana" size="2">Formulário de 
preenchimento</font></th></tr> 	<?}?>

	<?if ($opcao=="atualizar"){?>
	<tr bgcolor='#E0E0E0'>
		<td align='center' colspan='3'>Visualização e atualização
		| <a href="?module=movimento&movimento[id_apfd]=<?=$apfd->id_apfd;?>">Movimentos</a></font>
		| <a href="?module=envolvido&opcao=indiciado&apfd[id]=<?=$apfd->id_apfd;?>">R&eacute;u(s)</a></font>
		</td>
	</tr>
	<?}?>

</tr>


<?

form::openTR();
	form::openTD("width='50%' colspan=1");
		form::openLabel("N&ordm; do APFD e OPM");
			if ($apfd->sjd_ref) {
				echo "<input readonly name='numeracao' type='text' value='".$apfd->sjd_ref."/".$apfd->sjd_ref_ano."'>";
			}
			else {
				echo "<input readonly name='numeracao' type='text' value='*/".$_SESSION[sjd_ano]."'>";
			}
			echo "<select name='apfd[cdopm]'>";
				include ("includes/option_opm.php");
			echo "</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::openLabel("Andamento COGER");
			if ($user['nivel']>=4)			
			formulario::option("apfd","andamentocoger","WHERE procedimento='apfd'");
			else
			echo "<input type='text' disabled name='sopramostrar' value='".$apfd->andamentocoger->andamentocoger."'>";
		form::closeLabel();
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("width='50%' colspan=1");
		form::openLabel("Tipo");
			if ($apfd->tipo) $disabled="disabled";
			echo "<select name='apfd[tipo]' $disabled>
			<option rel='none' value=''>Selecione</option>
			<option rel='none' value='Crime comum'>Crime comum</option>
			<option rel='crimemilitar' value='Crime militar'>Crime militar</option>
			</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD("width='50%' colspan=1");
		form::input("Data do fato","apfd[fato_data]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='2' width='100%'");
		$opcoes=" id='sintese' rows='7' cols='80' ";
		form::input("S&iacute;ntese do fato (Quem, quando, onde, como e por quê)","apfd[sintese_txt]");
	form::closeTD();
form::closeTR();

form::openTR();
	openTD("colspan='2'");
		form::openLabel("Tipos penais (Do mais grave ao menos grave)");
			echo "<select name='apfd[tipo_penal_novo]'>";
				echo "<option value=''>Selecione</option>";
				include ("includes/option_crime.html");
			echo "</select>";
		form::closeLabel();
	closeTD();
form::closeTR();

openLine(2);
	form::openLabel("Especificar (preencha somente se for escolhido o tipo penal <b>OUTROS</b>)");
		echo "<input type='text' name='apfd[especificar]' size='40'>";
	form::closeLabel();
closeLine();

openTR();
	form::openTD("colspan='1' width='50%'");
		$textoForm="<select name='apfd[doc_tipo]'>
			<option value=''>Escolha</option>
			<option value='BI'>BI</option>
			<option value='BG'>BG</option>
			<option value='BR'>BR</option>\r\n</select>";
		$textoForm.="&nbsp;N&ordm;&nbsp;";
		$textoForm.="<input type='text' name='apfd[doc_numero]' maxlength=8 onkeyup='formatar(this,\"###/####\")'>"; 		
		form::input("Documento da publica&ccedil;&atilde;o","",$textoForm);
	form::closeTD();
	openTD();
		form::input("Referencia da VAJME (N&ordm; do processo e vara)","apfd[referenciavajme]");
	closeTD();
closeTR();

?>

<!--Encarregado e Escrivão-->
<table border=0 width=100% class='bordasimples'>
<tr rel='crimemilitar'><td>

<?
if ($opcao=="atualizar") {
	$presidente=new envolvido("WHERE rg_substituto='' AND situacao='Presidente' AND id_apfd='".$apfd->id_apfd."'","","simples");
	$condutor=new envolvido("WHERE rg_substituto='' AND situacao='Condutor' AND id_apfd='".$apfd->id_apfd."'","","simples");
	$escrivao=new envolvido("WHERE rg_substituto='' AND situacao='Escrivão' AND id_apfd='".$apfd->id_apfd."'","","simples");
}
?>


<table cellpadding="1" cellspacing="1" width="100%" bgcolor="#EEEEEE"><tr><td>
<table align=center border=0 cellpadding="0" cellspacing="1" width="100%">
	<tr><th colspan="5" bgcolor="#EEEEEE"><font face="tahoma, verdana" size="2">Membros</font></th></tr>
	<tr bgcolor=white align=center><td>RG</td><td valign="center">Nome<a href='http://10.47.1.8/pm/consultapm.php' target="_blank"><img border=0 src='img/lupa.gif' width="20"/></a></td><td>Posto/Graduação</td><td>Situação</td><td>Acao</td></tr>
	<tr bgcolor=white>
		<input type="hidden" name="envolvido[presidente][id_envolvido]">
		<input type="hidden" name="envolvido[presidente][id_apfd]">
		<td><input type=text size='12' name=envolvido[presidente][rg] onkeypress='return DigitaNumeroTempoReal(this,event)' onblur="ajaxForm(this,'policial',Array('nome','cargo'));"></td>
		<td><input readonly type=text size=30 ajax=1 name=envolvido[presidente][nome]></td>
		<td><input readonly type=text size=10 name="envolvido[presidente][cargo]"></td>
		<td width='160px'><input readonly type=text size=15 name="envolvido[presidente][situacao]" value="Presidente"></td>
		<? 
		$deletar=false;
		if ($opcao=="atualizar") $id=$presidente->id_envolvido;
		if ($user['nivel']<>6 && $user['nivel']<>7) include ("includes/botoes.inc");
		?>
	</tr>
	<tr bgcolor=white>
		<input type="hidden" name="envolvido[condutor][id_envolvido]">
		<input type="hidden" name="envolvido[condutor][id_apfd]">
		<td><input type=text size='12' name=envolvido[condutor][rg] onkeypress='return DigitaNumeroTempoReal(this,event)' onblur="ajaxForm(this,'policial',Array('nome','cargo'));"></td>
		<td><input readonly type=text size=30 ajax=1 name=envolvido[condutor][nome]></td>
		<td><input readonly type=text size=10 name="envolvido[condutor][cargo]"></td>
		<td><input readonly type=text size=15 name="envolvido[condutor][situacao]" value="Condutor"></td>
		<? 
		if ($opcao=="atualizar") $id=$condutor->id_envolvido;
		if ($user['nivel']<>6 && $user['nivel']<>7) include ("includes/botoes.inc");
		?>
	</tr>
	<tr bgcolor=white>
		<input type="hidden" name="envolvido[escrivao][id_envolvido]">
		<input type="hidden" name="envolvido[escrivao][id_apfd]">
		<td><input type=text size='12' name=envolvido[escrivao][rg] onblur="ajaxForm(this,'policial',Array('nome','cargo'));" onkeypress='return DigitaNumeroTempoReal(this,event)'></td>
		<td><input readonly type=text size=30 ajax=1 name=envolvido[escrivao][nome]></td>
		<td><input readonly type=text size=10 name="envolvido[escrivao][cargo]"></td>
		<td><input readonly type=text size=15 name="envolvido[escrivao][situacao]" value="Escrivão"></td>
		<? 
		if ($opcao=="atualizar") $id=$escrivao->id_envolvido;
		if ($user['nivel']<>6 && $user['nivel']<>7) include ("includes/botoes.inc");
		?>
	</tr>
</table>
</td></tr>
</table>
<!-- Fim Encarregado e Escrivão -->

<!-- Indiciados -->
<tr><td>
	<?formulario::subform("envolvido",$indiciados,"Acusados");?>
</td></tr>
<!-- Fim Indiciados -->
<tr><td>
<!-- Ofendidos -->
	<?formulario::subform("ofendido",$ofendidos,"V&iacute;timas (Apenas se houver)");?>
<!-- Fim Ofendidos -->
</td></tr>
<tr><td>
<?
if ($user['nivel']<>6 && $user['nivel']<>7)  {
	if ($opcao=="cadastrar") echo "<input type='submit' name='acao' value='Cadastrar'>";
	if ($opcao=="atualizar" and $user['nivel']>1 and $opcaoGeral!="readonly") echo "<input type='submit' name='acao' value='Atualizar'>";
	if ($user['nivel']>=5 and $opcao!="cadastrar") echo "<input type='submit' name='acao' value='Apagar'>";
}
?>


</td></tr>



</table>

</form>

<?php

//pre($opcaoGeral);
if ($opcaoGeral=="readonly") js::desativaTudo();

//Preenchimento automático formulário
if ($apfd) {
	formulario::values($apfd);
	
	if ($opcao=="atualizar") {

	formulario::values($presidente,"envolvido[presidente]");
	formulario::values($condutor,"envolvido[condutor]");
	formulario::values($escrivao,"envolvido[escrivao]");

	formulario::values($vetorIndiciados,"envolvido");

	}

	$i=1;
	while  ($row=@mysql_fetch_assoc($resI)) {
		formulario::values($row,"envolvido[$i]");
		if ($row[rg] and $user['nivel']<>5) echo "<script>document.getElementsByName('envolvido[$i][rg]')[0].disabled=true;</script>";
		$i++;
	}
	$i=1;
	while  ($row=@mysql_fetch_assoc($resO)) {
		formulario::values($row,"ofendido[$i]");
		$i++;
	}
}

if ($user['nivel']<2) js::desativaTudo();
//PEDIDO TEN TODISCO
if ($opcaoGeral=="readonly") js::desativaTudo();

?>
