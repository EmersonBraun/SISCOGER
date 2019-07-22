<script language='javascript'>
	function validarForm(formulario) {
		if (formulario.descricao.value=="") 
			{ 
				window.alert("Selecione a descricao"); return false; 
			}
		else if (formulario.inicio_data.value=="") 
			{ 
				window.alert("Selecione a data"); return false; 
			}
		else if (formulario.publicacao_inicio.value=="") 
			{ 
				window.alert("Preencha a publicação do início"); return false; 
			}
		else
			{
				return true;
			}
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
	if ($procedimento=="sai") echo "Policiais - Investiga&ccedil;&atilde;o";
	if ($procedimento=="proc_outros") echo "Controle de Audi&ecirc;ncia de Cust&oacute;dia | Pedido de Provid&ecirc;ncia | Noticia de Fato";
echo "</h1></center>\r\n";
?>

<table class='bordasimples' class='col-md-12' bgcolor="white" border="0">
<?php
echo "<tr>
	<td align='center' class='col-md-12' bgcolor=\"#DBEAF5\">";
	//var_dump($procedimento);
	if (!isset($noheader)) {
		echo "<a href=\"?module=$procedimento&".$procedimento."[id]=".$row["id_$procedimento"]."\">";
		echo "Visualização e atualização</a> | "
		."<a href=\"?module=movimento&movimento[id_$procedimento]=".$idp."\">Movimentos</a> | ".
		"Sobrestamentos";

        $procOndeMostrarAcompanhamento = array('ipm', 'sindicancia', 'fatd', 'cd', 'cj', 'adl');

        if (in_array($procedimento, $procOndeMostrarAcompanhamento)) {
            echo " | <a href=\"?module=subscription&tipo_processo={$procedimento}&id_processo=" . $row["id_$procedimento"] . "\">Acompanhamento</a>";
            if ($user['nivel']==4 || $user['nivel']==5){
	        //arquivo
			echo " | <a href=\"?module=arquivo&arquivo[id_$procedimento]=".$idp."\">Arquivo</a>";
			}
        }

		echo "</td></tr>";
	}
?>
<?

form::openTR("class='col-md-12'");
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
form::openTR("class='col-md-12'");
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

form::openTR("class='col-md-12'");
	form::openTD("colspan=2");
		form::openLabel("Envolvidos");
		while ($rowE=mysql_fetch_assoc($resE)) {
			if ($rowE[nome]) echo "$rowE[cargo] $rowE[nome] - $rowE[situacao]<br>";
		}
		form::closeLabel();
	form::closeTD();
form::closeTR();

form::openTR("class='col-md-12'");
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
<br>
</td>
</tr>
<table class="border border-primary">
<tr>


<? 
//para impressao, nao coloca o formulario
if (!isset($noheader) and $user["nivel"]>=2) { ?>
	<form  name="sobrestamento" class='col-md-12' action="?module=sobrestamento&acao=gravar" onsubmit='return validarForm(this);' method="POST">
<?php
	echo "<input type=\"hidden\" name=\"sobrestamento[id_$procedimento]\" value=\"$idp\">";
	echo "<input type=\"hidden\" name=\"sobrestamento[rg]\" value=\"".$usuario->rg."\">";
	echo "<br>";
	echo "<h1>Inserir sobrestamento</h1>";
	echo "</td></TR>";

	form::openTR("class='col-md-12'");
		form::openTD("class='col-md-12'");
			//Férias, Incidente de Insanidade, Substituição, Laudos/Perícia, Deslinde Criminal e Outros
			$textoForm="<select required='true' name=sobrestamento[motivo] id='descricao' onchange='aparece_outros()' $opcaoGeral2>
			<option value='Férias Acusado'>Férias Acusado</option>
			<option value='Férias Comissão'>Férias Comissão</option>
			<option value='Incidente de Insanidade'>Incidente de Insanidade</option>
			<option value='Substituição'>Substituição</option>
			<option value='Laudos/Perícia'>Laudos/Perícia</option>
			<option value='Deslinde Criminal'>Deslinde Criminal</option>
			<option value='outros'>Outros</option>
			</select>";
			form::input("Motivo","",$textoForm);
		form::closeTD();
		form::openTD("class='col-md-6' id='descricao_outros' style='display: none'");
			//$opcoes="size='30' maxlength='180'";
			form::input("Motivo outros","sobrestamento[motivo_outros]");
		form::closeTD();
	form::closeTR();

	form::openTR("class='col-md-12'");
		form::openTD("class='col-md-4'");
			$opcaoGeral2="required='true'";
			form::input("Data de inicio","sobrestamento[inicio_data]");
		form::closeTD();
		unset($opcaoGeral2);

		form::openTD("class='col-md-4'");
			echo "<label>N&deg; Documento<br>
			<input name='sobrestamento[doc_controle_inicio]' type='text' placeholder='Ex: Despacho n° 2.144/2018'>
			</label>";
		form::closeTD();

		form::openTD("class='col-md-4'");
			echo "<label>Publica&ccedil;&atilde;o do in&iacute;cio<br>
			<input name='sobrestamento[publicacao_inicio]' type='text' placeholder='Ex: BG 100/2007'>
			</label>";
			//form::input("Publica&ccedil;&atilde;o do in&iacute;cio (Ex: BG 100/2007)","sobrestamento[publicacao_inicio]");
		form::closeTD();
	form::closeTR();

	form::openTR("class='col-md-12'");
		form::openTD("class='col-md-4'");
			//$opcaoGeral2="required='true'";
			form::input("Data de termino","sobrestamento[termino_data]");
		form::closeTD();

		form::openTD("class='col-md-4'");
			echo "<label>N&deg; Documento<br>
			<input name='sobrestamento[doc_controle_termino]' type='text' placeholder='Ex: Despacho n° 2.144/2018'>
			</label>";
			//form::input("N&deg; Documento","sobrestamento[documento_controle]","<br>Ex: Despacho n° 2.144/2018");
		form::closeTD();

		form::openTD("class='col-md-4'");
		echo "<label>Publica&ccedil;&atilde;o do in&iacute;cio<br>
			<input name='sobrestamento[publicacao_termino]' type='text' placeholder='Ex: BG 100/2007'>
			</label>";
			//form::input("Publica&ccedil;&atilde;o do termino (Ex: BG 100/2007)","sobrestamento[publicacao_termino]");
		form::closeTD();
	form::closeTR();

	form::openTR("class='col-md-12'"); form::openTD();
		if (!$opcaoGeral2) echo "<input type='submit' value='Inserir' data-toggle='tooltip' data-placement='top' title='Tooltip on top'>";
	
	form::closeTD(); form::closeTR();
?>

	</TD>
<? } ?>
	
</tr>

</table>
				
<br>


<div class="table-responsive">
<table class="table table-light table-bordered">
<tbody style="width: 100%">
	<tr><h1><font face="tahoma, verdana" size="2">Sobrestamentos</font></h1></tr>

	<tr>
		<td><b>In&iacute;cio</b></td>
		<td><b>Doc.In&iacute;cio</b></td>
		<td><b>T&eacute;rmino</b></td>
		<td><b>Doc. T&eacute;rmino</b></td>
		<td><b>Motivo</b></td>
		<td><b>Motivo outros</b></td>
		<td><b>Atualizar sobrestamento</b></td>
	</tr>

<?

$sql="SELECT * FROM sobrestamento WHERE id_$procedimento='$idp' ORDER BY inicio_data DESC, id_sobrestamento DESC";
if ($_SESSION[debug]) echo $sql;
$res=mysql_query($sql);

if (mysql_num_rows($res)) {
	$i=0;
	while ($row=mysql_fetch_array($res)) {
	//($i%2)?($cor="table-light"):($cor="");
	echo "<tr>";

		echo "<td>".data::inverte($row['inicio_data'])." (".$row['publicacao_inicio'].")</td>";
		echo "<td>$row[doc_controle_inicio]</td>";
		if ($row['termino_data'] == '0000-00-00') 
		{
			echo "<td class='pisca' style='color:red'>Sem data</td>";
		}
		else
		{
			echo "<td>".data::inverte($row['termino_data'])." (".$row['publicacao_termino'].")</td>";
		}
		echo "<td>$row[doc_controle_termino]</td>";
	
		if ($row['motivo'] == '') {
			echo "<td>$row[motivo_outros]</td>";
			echo "<td>$row[motivo]</td>";
		}
		else
		{
			echo "<td>$row[motivo]</td>";
			echo "<td>$row[motivo_outros]</td>";
		}

	echo "<td>
	<a href='?module=sobrestamento&opcao=atualizar&sobrestamento[id]=".$row[id_sobrestamento]."&procedimento=".$procedimento."'>
	Atualizar</a>
	</td>";

	echo "</tr>";
	$i++;
	}
}
else {
	echo "<tr bgcolor=white><td colspan=4><b>Não há sobrestamentos.</b></td></tr>";
}

?>
</tbody>
</table>
</div>
