<?php

//Definicao de variaveis
//die;
global $login,$login_unidade, $nivel;
$procedimentos=$_REQUEST[procedimentos];

if ($_SESSION[debug]) pre($procedimentos);
if (!is_array($procedimentos)) $procedimentos=$sjd_procedimentos;


?>

	<table cellpadding="0" cellspacing="1" border="0" width="100%">
	<tr>
		<td align="center">			
		<table cellpadding="0" cellspacing="0" width="100%" border="0"><tr><td bgcolor="#4682B4">
		<center><h1>Processos e procedimentos</h1></center>
		<table cellpadding="5" cellspacing="1" width="100%" border="0">
		<tr><td colspan="2" bgcolor="#DBEAF5"><font face="tahoma, verdana" size="2">Busca Nominal</font></td></tr>
		
		<tr>
		<td bgcolor="#ffffff" valign="top">
			
		<form name="relatorio" action='index.php?module=ipm&opcao=relatorio_nomes&acao=gerar' method=post>
		<table border=0 width=100%>
			<tbody>
		<?
		form::openTR();
			form::openTD("width=100%");
			form::openLabel("Policial Envolvido");
				echo "
				RG:<input type=text size=20 ajax=1 name=policial[rg] onblur=\"ajaxForm(this, 'policial',Array('nome'))\" value=\"$policial[rg]\">
				<input type=text size=40 ajax=1 name=policial[nome] value=\"$policial[nome]\">";
			form::closeLabel();
			form::closeTD();
		form::closeTR();
		form::openTR();
			form::openTD("colspan='2'");
				$opcoes=" value='".$_REQUEST['policial']['cargo']."' ";
				form::input("Cargo","policial[cargo]");
			form::closeTD();
		form::closeTR();
		form::openTR();
			form::openTD();
				form::openLabel("Processos/Procedimentos");
				$sqlP="SELECT * FROM procedimentos_tipos";
				$res=mysql_query($sqlP);
				echo "<table border=0 width=100%>";
				$ii=0;	//3 proc por linha
				while ($rowP=mysql_fetch_assoc($res)) {
				if ($i%3 == 0) echo "<tr>";
				echo "<td width='33%'><input type='checkbox' ";
				if (is_array($procedimentos)) {
				if (in_array(strtolower($rowP[sigla]),$procedimentos)) echo " checked ";
				}
				echo " name='procedimentos[]' "
				."value='".strtolower($rowP[sigla])."'>"
				."$rowP[nome] </td>";
				if ($i%3 ==2) echo "</tr>";
				}
				echo "</table>";
				form::closeLabel();
			form::closeTD();
		form::closeTR();
		if (!isset($noheader)) {
		form::openTR();
			form::openTD();
				form::openLabel("Versão para impressão");
				echo "<input type=checkbox name='noheader'>Marque aqui";		
				form::closeLabel();
			form::closeTD();
		form::closeTR();
		}
		?>
	
	<tr bgcolor=white><td colspan=4 bgcolor=white align=left><input type=submit border=0 value=Filtrar>&nbsp;<input type=submit border=0 value='Gerar PDF'></td></tr>
</table></table></table>
<?

//pre($_REQUEST);

//if ($_REQUEST[policial][nome]) echo "sim";
//if ($_REQUEST[policial][cargo]) echo "sim";

if ($_REQUEST['acao']=='gerar' && ($_REQUEST[policial][nome] || $_REQUEST[policial][cargo])) include ("modules/ipm/gerar.php");
?>
