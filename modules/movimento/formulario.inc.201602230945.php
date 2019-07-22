<script language='javascript'>
	function validarForm(formulario) {
		if (formulario.descricao.value=="") { window.alert("Preencha a descri&ccedil;&atilde;o"); return false; }
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

<table class='bordasimples' width='100%' bgcolor='white'>
<?
echo "<tr>
	<td align='center' colspan=\"3\" bgcolor='#E0E0E0'>";
	
	if (!isset($noheader)) {
		echo "<a href=\"?module=$procedimento&".$procedimento."[id]=".$row["id_$procedimento"]."\">";	
		echo "Visualização e atualização</a> | Movimentos";
		if ($procedimento!="ipm" and $procedimento!="desercao" and $procedimento!="apfd") 
		echo " | <a href=\"?module=sobrestamento&sobrestamento[id_$procedimento]=".$idp."\">Sobrestamentos</a>";
		if ($procedimento=="ipm" or $procedimento=="desercao" or $procedimento=="apfd")
		echo " | <a href=\"?module=envolvido&opcao=indiciado&".$procedimento."[id]=".$idp."\">R&eacute;u(s)</a>";
		
		echo "</td></tr>";
	}
?>
<?

form::openTR();
	form::openTD();
		form::openLabel("Nº e OPM");
			echo "$row[sjd_ref]/$row[sjd_ref_ano] - ";
			if($row['cdopm']) {
				$unidade=new opm(completaZeros($row['cdopm'])); 
				echo $unidade->abreviatura;
			}
			elseif ($row[opm_sigla]) echo strtoupper($row["opm_sigla"]);
			else echo "CG";
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::openLabel("Andamento");
			echo "$row[andamento]";
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::openLabel("Andamento COGER");
			if ($row["andamentocoger"]) echo "$row[andamentocoger]";
			else echo "N&atilde;o informado";
		form::closeLabel();
	form::closeTD();
form::closeTR();
form::openTR();
	form::openTD();
		form::openLabel("Data do fato");
			if ($row['fato_data']!="0000-00-00") echo data::inverte($row[fato_data]);
			else echo "N&atilde;o informada.";
		form::closeLabel();
	form::closeTD();
	form::openTD("colspan='2'");
		if (isset($row[abertura_data])) {
			form::openLabel("Data de abertura");
			if ($row['abertura_data'] !="0000-00-00") echo data::inverte($row[abertura_data]);
			else echo "N&atilde;o informada.";
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
	form::openTD("colspan=3");
		form::openLabel("Envolvidos");
		while ($rowE=mysql_fetch_assoc($resE)) {
			if ($rowE[nome]) echo "$rowE[cargo] $rowE[nome] - $rowE[situacao]";
			if ($rowE['rg_substituto']) echo " Substituido";
			if ($rowE[nome]) echo "<br>";
		}
		form::closeLabel();
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='3'");
		form::openLabel("S&iacute;ntese do fato");
			echo "$row[sintese_txt]";
		form::closeLabel();
	form::closeTD();
form::closeTR();

if ($procedimento=="ipm") {
	openTR();
		openTD("colspan='3'");
			form::openLabel("Refer&ecirc;ncia da VAJME");
				if ($row['vajme_ref']) echo "$row[vajme_ref]"; else echo "N&atilde;o informada.";
			form::closeLabel();
		closeTD();
	closeTR();

}

?>
</table>
</form>

<table>
<tr>
<? 
//para impressao, nao coloca o formulario
if ((!$opcaoGeral2)) {
	if (!isset($noheader) and $user["nivel"]>=2 or $user['nivel']==-1) { ?>
		<TD class='noprint'>
		<form name="movimento" action="?module=movimento&acao=gravar" onsubmit='return validarForm(this);' method="POST">

		<? echo "<input type=\"hidden\" name=\"movimento[id_$procedimento]\" value=\"$idp\">";
		   echo "<input type=\"hidden\" name=\"movimento[rg]\" value=\"".$usuario->rg."\">";
		   echo "<input type=\"hidden\" name=\"movimento[opm]\" value=\"".$usuario->opm->abreviatura."\">";
		 ?>
		<br>
		Inserir Movimento:
		<input type="Text" name="movimento[data]" maxlength="10" size="12" value="<?echo data::hoje();?>" onkeyup="MascaraData(this, event), pulaFocus(10, this, form.horaInicialCon)">
		<textarea rows='3' cols="60" id="descricao" name="movimento[descricao]"></textarea>
		<input type="submit" value="Inserir">
		</form>
		</TD>
<?
	} 
}
?>
	
</tr>

</table>
				
<br>
<?php
if ($user["nivel"]<>6) {
?>

<h1>Movimentos</h1>
<table class='bordasimples' width='100%' cellpadding='0' cellspacing='0'><tr><td>
<table align=center border=0 cellpadding="0" cellspacing="1" width="100%">
	<tr bgcolor="#E0E0E0" align=center>
		<?php
			echo "<td>Data</td><td>Descricao</td><td>OPM</td>";
			if ($user['nivel'] >=4) echo "<td>RG</td>";
			echo "</tr>";
		?>

<?

	$sql="SELECT * FROM movimento WHERE id_$procedimento='$idp' ORDER BY data DESC, id_movimento DESC";
	if ($_SESSION["debug"]) echo $sql;
	$res=mysql_query($sql);

	if (mysql_num_rows($res)) {
		$i=0;
		while ($row=mysql_fetch_array($res)) {
		($i%2)?($cor="white"):($cor="#EEEEEE");
		echo "<tr bgcolor=$cor>";
			echo "<td>".data::inverte($row['data'])."</td>";
			echo "<td>";
			if (!isset($noheader) and $user['nivel']>1) {
				
			//EDICAO BLOQUEADA, PEDIDO CAP TODISCO 04/12/2013
			//ERROU, FICA ERRADO, ESCREVA O MOVIMENTO DE VOLTA.
				 //if ($user['nivel']>=4 OR $row["rg"]==$usuario->rg)
				 //echo "<a href='?module=movimento&opcao=atualizar&movimento[id]=".$row[id_movimento]."&procedimento=".$procedimento."'>";
			}
		
			//SEGURANCA PEDIDO TEN TODISCO 26 OUT 2011
			if ($user["nivel"]<4 and substr($row["opm"],0,5)=="COGER") {
				echo " ---- ";
			}
			else echo $row['descricao']."</a></td>";
		
		
			echo "<td>$row[opm]</td>";

			if ($user['nivel']>=4) {
				echo "<td>$row[rg]</td>";
			}
		echo "</tr>";
		$i++;
		}
	}
	else {
		echo "<tr bgcolor=white><td colspan=5><b>Não há movimentos.</b></td></tr>";
	}
}
closeTable();
closeTable();


//SOBRESTAMENTOS


if ($procedimento=="sindicancia" or $procedimento=="adl" or $procedimento=="cj" or $procedimento=="cd" or $procedimento=="fatd") {
	echo "<br>";
	h1("Sobrestamentos");
	openTable("class='bordasimples' width='100%'");

	$sql="SELECT * FROM sobrestamento WHERE id_$procedimento='$idp' ORDER BY inicio_data DESC, id_sobrestamento DESC";
	if ($_SESSION["debug"]) pre($sql);
	$res=mysql_query($sql);

	if (mysql_num_rows($res)) {
		$i=0;
		openTR();
			echo "<td>Inicio</td><td>Fim</td><td>Motivo</td>";
		closeTR();
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
		echo "<tr bgcolor=white><td colspan=3>Não há sobrestamentos.</td></tr>";
	}

	closeTable();

}

?>
