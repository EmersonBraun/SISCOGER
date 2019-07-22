<?php
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

//Tabela com as tramitacoes
$sql="SELECT * FROM tramitacaoopm WHERE rg='$rg' ORDER BY data DESC, id_tramitacaoopm DESC";
if ($_SESSION['debug']) pre($sql);
$res=mysql_query($sql);

openTable("class='bordasimples' width='100%'");
	openLine(5); h2("Tramita&ccedil;&otilde;es OPM (<a href='#x' title='Campo destinado &agrave; SJD da Unidade, para cadastro de informa&ccedil;&otilde;es sobre a vida funcional do militar, ou protocolos de documentos.'>?</a>)"); closeLine();

	if (mysql_num_rows($res)==0) {
		openLine(2);
			echo "Nao ha tramita&ccedil;&otilde;es para esse policial.";
		closeLine();
	}

	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#EEEEEE"):($cor="#FFFFFF");
		openTR("bgcolor='$cor'");
			echo "<td>".data::inverte($row["data"])."</td>";
			//echo "<td>$row[opm_abreviatura]</td>";
			echo "<td>$row[descricao_txt]</td>";
			echo "<td>$row[digitador]</td>";
			echo "<td>$row[opm_abreviatura]</td>";

			echo "<td>";
		if (!$opcaoGeral2) {
			link::popup("?module=tramitacaoopm&tramitacaoopm[id]=$row[id_tramitacaoopm]&noheader",600,400);
			echo "<img src='img/lapis.gif'>&nbsp;</a>";
			//Tramitacao da OPM, a propria unidade pode apagar
			if ($user['nivel'] >=2 )
			echo "<a onclick='return Confirma();' href='?module=tramitacaoopm&opcao=apagar&acao=apagar&tramitacaoopm[id]=$row[id_tramitacaoopm]'><img border=0 src='img/delete.png'></a>";
		}
			echo "</td>";

		closeTR();
		$i++;
	}

closeTable();

link::popup("?module=tramitacaoopm&rg=$rg&opcao=cadastrar&noheader",650,450);
echo "<input type='button' value='Adicionar'>";
echo "</a>";
?>
