<?php
include ("ficha.php");
if ($user['nivel']<>5 && $user['nivel']<>7) { echo "Voce nao tem permissao para acessar este recurso."; exit; } // alteracao solicitada pelo Cap Todisco

//Tabela com as tramitacoes
$sql="SELECT sai.*, envolvido.situacao, envolvido.resultado, ligacao.origem_proc, ligacao.origem_sjd_ref, ligacao.origem_sjd_ref_ano
 FROM envolvido LEFT JOIN sai ON sai.id_sai = envolvido.id_sai LEFT JOIN ligacao ON ligacao.id_sai = envolvido.id_sai WHERE envolvido.rg='$rg' AND envolvido.id_sai <> 0";
if ($_SESSION['debug']) pre($sql);
//pre($sql);
$res=mysql_query($sql);

openTable("class='bordasimples' width='100%'");
		openTR("bgcolor='$cor'");
			echo "<td><h2>N&SmallCircle;  SAI</h2></td>";
			echo "<td><h2>Motivo Abertura</h2></td>";
			echo "<td><h2>Sintese do fato</h2></td>";
			echo "<td><h2>Situa&ccedil;&atilde;o</h2></td>";
			echo "<td><h2>Resultado</h2></td>";
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

		openTR("bgcolor='$cor'");
			if ($row["sjd_ref_ano"]!=="0") 
			{
				echo "<td><a href='?module=sai&sai[id]=$row[id_sai]'>$row[sjd_ref]/$row[sjd_ref_ano]</td>";
			}
			else
			{
				echo "<td><a href='?module=sai&sai[id]=$row[id_sai]'>$row[id_sai]</a></td>";
			}
			echo "<td>$row[motivo_principal]</td>";
			echo "<td>$row[sintese_txt]</td>";
			echo "<td>$row[situacao]</td>";//tb envolvido
			echo "<td>$row[origem_proc]-$row[origem_sjd_ref]/$row[origem_sjd_ref_ano]</td>";
			echo "<td>$row[digitador]</td>";

			echo "<td>";

			link::popup("?module=movimento&movimento[id_sai]=$row[id_sai]");//?module=sai&opcao=diligencia&acao=adicionardiligencia&sai[id]=
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
