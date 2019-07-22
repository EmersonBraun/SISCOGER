<script language='javascript'>
	function validarForm(formulario) {
		if (formulario.descricao.value=="") { window.alert("Preencha a descricao"); return false; }
		return true;
	}
</script>

<?
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

echo "<center><h1>";
	if ($procedimento=="ipm") echo "Inquérito Policial Militar";
	if ($procedimento=="cj") echo "Conselho de Justificação";
	if ($procedimento=="cd") echo "Conselho de Disciplina";
	if ($procedimento=="sindicancia") echo "Sindicância";
	if ($procedimento=="fatd") echo "Formulário de Apuração de Transgressão Disciplinar";
	if ($procedimento=="desercao") echo "Deserção";
	if ($procedimento=="iso") echo "Inquérito Sanitário de Origem";
	if ($procedimento=="apfd") echo "Auto de Prisão em Flagrante Delito";
	if ($procedimento=="it") echo "Inqu&eacute;rito T&eacute;cnico";
	if ($procedimento=="adl") echo "Apuracao Disciplinar de Licenciamento";
echo "</h1></center>\r\n";
?>

<table class='bordasimples' width="100%" bgcolor="white" border="0">
<?
echo "<tr>
	<td align='center' colspan=\"3\" bgcolor=\"#DBEAF5\">";
	
	if (!isset($noheader)) {
		echo "<a href=\"?module=$procedimento&".$procedimento."[id]=".$row["id_$procedimento"]."\">";	
		echo "Visualização e atualização</a> | "
		."<a href=\"?module=movimento&movimento[id_$procedimento]=".$idp."\">Movimentos</a> | ".
		"Sobrestamentos".
		"</td></tr>";
	}
?>
<?

form::openTR();
	form::openTD();
		form::openLabel("Nº");
			echo "$row[sjd_ref]/$row[sjd_ref_ano]";
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::openLabel("OPM");
			if($row[cdopm]) echo strtoupper(get_opm_by_id($row[cdopm])); 
			elseif ($row[opm_sigla]) echo strtoupper($row[opm_sigla]);
			else echo "CG";
		form::closeLabel();
	form::closeTD();
form::closeTR();
form::openTR();
	form::openTD();
		form::openLabel("Data do fato");
			echo data::inverte($row[fato_data]);
		form::closeLabel();
	form::closeTD();
	form::openTD();
		if (isset($row[abertura_data])) {
			form::openLabel("Data de abertura");
			echo data::inverte($row[abertura_data]);
			form::closeLabel();
		}
		//Auto de prisao em flagrante, tem tipo penal, mas nao data de abertura
		elseif (isset($row[tipo_penal])) {
			form::openLabel("Tipo penal");
			echo $row[tipo_penal];
			form::closeLabel();
		}
	form::closeTD();
form::closeTR();

//envolvidos
mysql_select_db("sjd", $con[8]);
$sqlE="SELECT * FROM envolvido WHERE id_$procedimento='".$row["id_$procedimento"]."'";
$resE=mysql_query($sqlE);

form::openTR();
	form::openTD("colspan=2");
		form::openLabel("Envolvidos");
		while ($rowE=mysql_fetch_assoc($resE)) {
			if ($rowE[nome]) echo "$rowE[cargo] $rowE[nome] - $rowE[situacao]<br>";
		}
		form::closeLabel();
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='2'");
		form::openLabel("S&iacute;ntese do fato");
			echo "$row[sintese_txt]";
		form::closeLabel();
	form::closeTD();
form::closeTR();

?>
				</td></tr>
				</td></tr><tr>
				</table>
</form>
</td>
</tr>
<tr>
<? 
//para impressao, nao coloca o formulario
if (!isset($noheader) and $user["nivel"]>=2) { ?>
	<TD colspan='2'>
	<form name="sobrestamento" action="?module=sobrestamento&acao=gravar" onsubmit='return validarForm(this);' method="POST">
<?php
	echo "<input type=\"hidden\" name=\"sobrestamento[id_$procedimento]\" value=\"$idp\">";
	echo "<input type=\"hidden\" name=\"sobrestamento[rg]\" value=\"".$usuario->rg."\">";
	echo "<br>";
	echo "<h1>Inserir sobrestamento</h1>";
	echo "</td></TR>";

	form::openTR();
		form::openTD("colspan='2'");
			$opcoes="size='70' maxlength='180' id='descricao' ";
			form::input("Motivo","sobrestamento[motivo]");
		form::closeTD();
	form::closeTR();

	form::openTR();
		form::openTD();
			form::input("Data de inicio","sobrestamento[inicio_data]");
		form::closeTD();
		form::openTD();
			form::input("Publica&ccedil;&atilde;o do in&iacute;cio (Ex: BG 100/2007)","sobrestamento[publicacao_inicio]");
		form::closeTD();
	form::closeTR();

	form::openTR();
		form::openTD();
			form::input("Data de termino","sobrestamento[termino_data]");
		form::closeTD();
		form::openTD();
			form::input("Publica&ccedil;&atilde;o do termino (Ex: BG 100/2007)","sobrestamento[publicacao_termino]");
		form::closeTD();
	form::closeTR();
	
	form::openTR(); form::openTD();
		if (!$opcaoGeral2) echo "<input type='submit' value='Inserir'>";
	form::closeTD(); form::closeTR();
?>

	</TD>
<? } ?>
	
</tr>

</table>
				
<br>



<table cellpadding="0" cellspacing="0" width="100%" border="0"><tr><td bgcolor="white">

<table cellpadding="0" cellspacing="0" width="100%" bgcolor="#4682B4"><tr><td>
<table align=center border=0 cellpadding="0" cellspacing="1" width="100%">
	<tr><th colspan="5" bgcolor="#DBEAF5"><font face="tahoma, verdana" size="2">Sobrestamentos</font></th></tr>
	<tr bgcolor=white align=center><td>In&iacute;cio</td><td>T&eacute;rmino</td><td>Motivo</td></tr>

<?

$sql="SELECT * FROM sobrestamento WHERE id_$procedimento='$idp' ORDER BY inicio_data DESC, id_sobrestamento DESC";
if ($_SESSION[debug]) echo $sql;
$res=mysql_query($sql);

if (mysql_num_rows($res)) {
	$i=0;
	while ($row=mysql_fetch_array($res)) {
	($i%2)?($cor="white"):($cor="#EEEEEE");
	echo "<tr bgcolor=$cor>";
		echo "<td>".data::inverte($row['inicio_data'])." (".$row['publicacao_inicio'].")</td>";
		echo "<td>".data::inverte($row['termino_data'])." (".$row['publicacao_termino'].")</td>";
		echo "<td>";
		if (!isset($noheader))
		echo "<a href='?module=sobrestamento&opcao=atualizar&sobrestamento[id]=".$row[id_sobrestamento]."&procedimento=".$procedimento."'>";
		echo $row['motivo']."</a></td>";
	echo "</tr>";
	$i++;
	}
}
else {
	echo "<tr bgcolor=white><td colspan=3><b>Não há sobrestamentos.</b></td></tr>";
}

?>
