<?php
if ($user['nivel']<>5 && $user['nivel']<>7) { echo "Voce nao tem permissao para acessar este recurso."; exit; } // alteracao solicitada pelo Cap Todisco

//Tabela com as tramitacoes
$sql="SELECT * FROM sai WHERE rg='$rg' ORDER BY id_sai DESC";
if ($_SESSION['debug']) pre($sql);
$res=mysql_query($sql);

openTable("class='bordasimples' width='100%'");
		openTR("bgcolor='$cor'");
			echo "<td><h2>Data</h2></td>";
			echo "<td><h2>Doc. Origem</h2></td>";
			echo "<td><h2>S&iacute;ntese</h2></td>";
			echo "<td><h2>Dilig&ecirc;ncias</h2></td>";
			echo "<td><h2>Arquivo/Pasta</h2></td>";
			echo "<td><h2>Digitador</h2></td>";
			echo "<td><h2>A&ccedil;&otilde;es</h2></td>";
		closeTR();

	if (mysql_num_rows($res)==0) {
		openLine(2);
			echo "Nao ha tramitacoes para esse policial.";
		closeLine();
	}

	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#EEEEEE"):($cor="#FFFFFF");

		$sql2="SELECT id_saidiligencias, diligencias_txt, digitador, data FROM saidiligencias WHERE sai='$row[id_sai]';";
		$res2=mysql_query($sql2);

		$diligencias = "<ul>";
		while ($row2=mysql_fetch_assoc($res2)) {
			$diligencias .= "<li>";
			$diligencias .= "$row2[diligencias_txt]";
			if ($user['nivel']==5) {
				$diligencias .= "<br /><small><a href='#' title=' 'onclick=\"window.open('?module=sai&opcao=diligencia&acao=editardiligencia&saidiligencias[id]=$row2[id_saidiligencias]&noheader','popupCPO','width=520,height=365,resizable=1, scrollbars=1,top=0,left=0')\">[editar]</a>";
				$diligencias .= "<a onclick='return Confirma();' href='?module=sai&opcao=diligencia&acao=apagardiligencia&saidiligencias[id]=$row2[id_saidiligencias]'>[apagar]</a></small>";
			}
			$diligencias .= "<br /><small><i>Digitado por $row2[digitador] em ".data::inverte($row2[data])."</i></small>";
			$diligencias .= "</li><br />";
		}
		$diligencias .= "</ul>";

		openTR("bgcolor='$cor'");
			echo "<td>".data::inverte($row["data"])."</td>";
			//echo "<td>$row[opm_abreviatura]</td>";
			echo "<td>$row[docorigem]</td>";
			echo "<td>$row[sintese_txt]</td>";
			echo "<td>$diligencias</td>";
			echo "<td>$row[arquivopasta]</td>";
			echo "<td>$row[digitador]</td>";

			echo "<td>";

			link::popup("?module=sai&opcao=diligencia&acao=adicionardiligencia&sai[id]=$row[id_sai]&noheader");
			echo "<img src='img/add-green.png' height=16 width=16>&nbsp;</a>";
		if ($user['nivel']==5) {
			link::popup("?module=sai&sai[id]=$row[id_sai]&noheader");
			echo "<img src='img/lapis.gif'>&nbsp;</a>";
			if ($user['nivel']==5)
			echo "<a onclick='return Confirma();' href='?module=sai&opcao=apagar&acao=apagar&sai[id]=$row[id_sai]'><img border=0 src='img/delete.png'></a>";
		}
			echo "</td>";

		closeTR();
		$i++;
	}

closeTable();

link::popup("?module=sai&rg=$rg&opcao=cadastrar&noheader",650,670);
echo "<input class='noprint' type='button' value='Adicionar'>";
echo "</a>";
?>
