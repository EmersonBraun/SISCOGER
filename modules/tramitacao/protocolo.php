<?php
include ("ficha.php");
if ($user['nivel']<>4 && $user['nivel']<>5) { echo "Voce nao tem permissao para acessar este recurso."; exit; } // alteracao solicitada pelo Cap Todisco

//Tabela com as tramitacoes
$sql="SELECT * FROM protocolo WHERE rg='$rg'";
if ($_SESSION['debug']) pre($sql);
//pre($sql);
$res=mysql_query($sql);
echo "<h1>Protocolo</h1>";
openTable("class='bordasimples' width='100%'");
		openTR("bgcolor='$cor'");
			echo "<td><h2>#</h2></td>";
			echo "<td><h2>N&SmallCircle; Documento</h2></td>";
			echo "<td><h2>Descri&ccedil;&atilde;o</h2></td>";
			echo "<td><h2>RG Autor</h2></td>";
			echo "<td><h2>RG Analista</h2></td>";
			echo "<td><h2>Observa&ccedil;&otilde;es</h2></td>";
			echo "<td><h2>A&ccedil;&otilde;es</h2></td>";
		closeTR();

	if (mysql_num_rows($res)==0) {
		openLine(2);
			echo "Nao ha protocolos para esse policial.";
		closeLine();
	}
	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor="#EEEEEE"):($cor="#FFFFFF");

		openTR("bgcolor='$cor'");
			echo "<td>$row[id_protocolo]</td>";
			echo "<td>$row[numero]</td>";
			echo "<td>$row[descricao_txt]</td>";//tb envolvido
			echo "<td>$row[rg_autor]</td>";
			echo "<td>$row[rg_analista]</td>";
			echo "<td>$row[obs]</td>";
			echo "<td>";

			link::popup("?module=protocolo&protocolo[id]=$row[id_protocolo]&opcao=atualizar&noheader");
			echo "<img src='img/lapis.gif'>&nbsp;</a>";
			echo 	"<a onclick=\"apagar_proc('protocolo',$row[id_protocolo]);\" style='cursor: pointer'>
					<img border=0 src='img/delete.png'>
				</a>";
			echo "</td>";

		closeTR();
		$i++;
	}

closeTable();

link::popup("?module=protocolo&rg=$rg&opcao=cadastrar&noheader",750,300);
echo "<input class='noprint' type='button' value='Adicionar'>";
echo "</a>";
?>
