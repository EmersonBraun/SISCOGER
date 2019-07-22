<script language='javascript'>
	function validarForm(formulario) {
		if (formulario.descricao.value=="") { window.alert("Preencha a descri&ccedil;&atilde;o"); return false; }
		return true;
	}
</script>

<?php
//var_dump($procedimento);exit;
//include_once("controle_acesso.php");//verifica permissões do usuário
if (($user['nivel']==6 || $user['nivel']==7) && $procedimento!="sai") { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

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
echo "</h1></center>\r\n";
?>

<table class='bordasimples' width='100%' bgcolor='white'>
<?
echo "<tr>
	<td align='center' colspan=\"3\" bgcolor='#E0E0E0'>";
//var_dump($procedimento);
echo "<hr>";
	if (!isset($noheader)) {
		echo "<a href=\"?module=$procedimento&".$procedimento."[id]=".$row["id_$procedimento"]."\">";
		//vizualização
		echo "Visualização e atualização</a>";
		//movimentação
		echo "| <a href=\"?module=movimento&movimento[id_$procedimento]=".$idp."\">Movimentos</a>";
		if ($procedimento!="ipm" and $procedimento!="desercao" and $procedimento!="apfd" and $procedimento!="sai")
		echo " | <a href=\"?module=sobrestamento&sobrestamento[id_$procedimento]=".$idp."\">Sobrestamentos</a>";
		//réu
		if ($procedimento=="ipm" or $procedimento=="desercao" or $procedimento=="apfd")
		echo " | <a href=\"?module=envolvido&opcao=indiciado&".$procedimento."[id]=".$idp."\">R&eacute;u(s)</a>";
        //acompanhamento                                                                                                                   
        $procOndeMostrarAcompanhamento = array('ipm', 'sindicancia', 'fatd', 'cd', 'cj', 'adl');                           
        if (in_array($procedimento, $procOndeMostrarAcompanhamento)) {                                                                              
		echo " | <a href=\"?module=subscription&tipo_processo={$procedimento}&id_processo={$idp}\">Acompanhamento</a>";
		//arquivo
		echo "| Arquivo";
        }

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
			elseif ($row['opm_sigla']) echo strtoupper($row["opm_sigla"]);
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
			if ($row['fato_data']!="0000-00-00") echo data::inverte($row['fato_data']);
			else echo "N&atilde;o informada.";
		form::closeLabel();
	form::closeTD();
	form::openTD("colspan='2'");
		if (isset($row['abertura_data'])) {
			form::openLabel("Data de abertura");
			if ($row['abertura_data'] !="0000-00-00") echo data::inverte($row['abertura_data']);
			else echo "N&atilde;o informada.";
			form::closeLabel();
		}
		//Auto de prisao em flagrante, tem tipo penal, mas nao data de abertura
		elseif (isset($row['tipo_penal'])) {
			form::openLabel("Tipo penal");
			echo $row['tipo_penal'];
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
<?php
//para impressao, nao coloca o formulario
if ((!$opcaoGeral2)) 
{
	//if (!isset($noheader) and $acesso_liberado == true) {
	if (!isset($noheader) and $user["nivel"]>=2 or $user['nivel']==-1) 
	{ antigo
	?>
		<TD class='noprint'>
		<form name="arquivo" action="?module=arquivo&acao=gravar" onsubmit='return validarForm(this);' method="POST">
		<br>

		Inserir arquivo:  

		<?php
		echo "<input type=\"hidden\" name=\"arquivo[procedimento]\" value=\"$procedimento\">";
		echo "<input type=\"hidden\" name=\"arquivo[id_$procedimento]\" value=\"$idp\">";
		echo "<input type=\"hidden\" name=\"arquivo[sjd_ref]\" value=\"$row[sjd_ref]\">";
		echo "<input type=\"hidden\" name=\"arquivo[sjd_ref_ano]\" value=\"$row[sjd_ref_ano]\">";
		echo "<input type=\"hidden\" name=\"arquivo[arquivo_data]\" value=\"".data::hoje()."\">";
	   	echo "<input type=\"hidden\" name=\"arquivo[rg]\" value=\"".$usuario->rg."\">";
	   	echo "<input type=\"hidden\" name=\"arquivo[nome]\" value=\"".$usuario->nome."\">";
	   	echo "<input type=\"hidden\" name=\"arquivo[opm]\" value=\"".$usuario->opm->abreviatura."\">";
		form::openTR();
			form::openTD();
				$textoForm="<select name=arquivo[local_atual] $opcaoGeral2>
					<option>Arquivo COGER</option>
					<option>Arquivo Geral(PMPR)</option>
					<option>Cautela (Sa&iacute;da)</option>
				</select>";
				form::input("Local","",$textoForm);
			form::closeTD();
			form::openTD();
				form::loop("N&uacute;mero", "arquivo[numero]","1","100","-");
			form::closeTD();
			form::openTD();	
				form::loop("Letra", "arquivo[letra]","a","z","-");
			form::closeTD(); 				
			form::openTD();
				form::input("Observa&ccedil;&otilde;es.", "arquivo[obs]");
			form::closeTD();
			form::openTD();
				?> 
				<input type="submit" value="Inserir">
				<?php
			form::closeTD();
		form::closeTR();
		 ?>
        
        <br>
		
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

<h1>Arquivos</h1>
<table class='bordasimples' width='100%' cellpadding='0' cellspacing='0'><tr><td>
<table align=center border=0 cellpadding="0" cellspacing="1" width="100%">
	<tr bgcolor="#E0E0E0" align=center>
		<?php
			echo "<td>Data</td><td>Local</td><td>N&uacute;mero</td><td>Letra</td><td>Observa&ccedil;&otilde;es.</td>";
			if ($user['nivel'] >=4) echo "<td>RG</td>";
			echo "</tr>";
		?>

<?

	$sql="SELECT * FROM arquivo WHERE id_$procedimento='$idp' ORDER BY arquivo_data DESC, id_arquivo DESC";
	if ($_SESSION["debug"]) echo $sql;
	$res=mysql_query($sql);

	if (mysql_num_rows($res)) {
		$i=0;
		while ($row=mysql_fetch_array($res)) {
			($i%2)?($cor="white"):($cor="#EEEEEE");
			echo "<tr bgcolor=$cor>";
			echo "<td>";
			echo data::inverte($row['arquivo_data'])."</td>";
			// if($row['local'] == 'Cautela (Saída)'){
			// 	echo " <a href='?module=arquivo&opcao=atualizar&arquivo[id]=".$row['id_arquivo']."&procedimento=".$procedimento."'>";
			// }
			echo "<td>$row[local_atual]</a></td>";
			echo "<td>$row[numero]</td>";
			echo "<td>$row[letra]</td>";
			echo "<td>$row[obs]</td>";
			echo "<td>$row[rg]</td>";

			echo "</tr>";
			$i++;
		}
	}
	else {
		echo "<tr bgcolor=white><td colspan=5><b>Não há arquivo.</b></td></tr>";
	}
}
closeTable();
closeTable();

?>
