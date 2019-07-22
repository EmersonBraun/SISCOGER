<?php

//Tabela com as tramitacoes
$sql="SELECT * FROM tramitacao WHERE rg='$rg' ORDER BY data DESC, id_tramitacao DESC";
if ($_SESSION['debug']) pre($sql);
$res=mysql_query($sql);

openTable("class='bordasimples' width='100%'");
	openLine(4); h2("Tramita&ccedil;&otilde;es"); closeLine();

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

			echo "<td>";
		if ($user['nivel']==5) {
			link::popup("?module=tramitacao&tramitacao[id]=$row[id_tramitacao]&noheader");
			echo "<img src='img/lapis.gif'>&nbsp;</a>";
			if ($user['nivel'] >=5 )
			echo "<a onclick='return Confirma();' href='?module=tramitacao&opcao=apagar&acao=apagar&tramitacao[id]=$row[id_tramitacao]'><img border=0 src='img/delete.png'></a>";
		}
			
			echo "</td>";

		closeTR();
		$i++;
	}

closeTable();

link::popup("?module=tramitacao&rg=$rg&opcao=cadastrar&noheader",650,450);
echo "<input class='noprint' type='button' value='Adicionar'>";
echo "</a>";
?>
