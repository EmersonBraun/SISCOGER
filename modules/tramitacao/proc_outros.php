<?php
include ("ficha.php");
if ($user['nivel']<>5 && $user['nivel']<>7) { echo "Voce nao tem permissao para acessar este recurso."; exit; } // alteracao solicitada pelo Cap Todisco

//Tabela com as tramitacoes
$sql="SELECT proc_outros.*, envolvido.situacao, envolvido.resultado, ligacao.origem_proc, ligacao.origem_sjd_ref, ligacao.origem_sjd_ref_ano
 FROM envolvido LEFT JOIN proc_outros ON proc_outros.id_proc_outros = envolvido.id_proc_outros LEFT JOIN ligacao ON ligacao.id_proc_outros = envolvido.id_proc_outros WHERE envolvido.rg='$rg' AND envolvido.id_proc_outros <> 0";
if ($_SESSION['debug']) pre($sql);
//pre($sql);
$res=mysql_query($sql);

openTable("class='bordasimples' width='100%'");
		openTR("bgcolor='$cor'");
			echo "<td><h2>N&SmallCircle;  proc_outros</h2></td>";
			echo "<td><h2>Andamento</h2></td>";
			echo "<td><h2>Andamento COGER</h2></td>";
			echo "<td><h2>Motivo Abertura</h2></td>";
			//echo "<td><h2>Sintese do fato</h2></td>";
			//echo "<td><h2>Situa&ccedil;&atilde;o</h2></td>";
			echo "<td><h2>Doc. Origem</h2></td>";
			echo "<td><h2>Resultado</h2></td>";
			//echo "<td><h2>Digitador</h2></td>";
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
			echo "<td><a href='?module=proc_outros&proc_outros[id]=$row[id_proc_outros]'>$row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
			echo "<td>$row[andamento]</td>";
			echo "<td>$row[andamentocoger]</td>";
			echo "<td>$row[motivo_abertura]</td>";
			echo "<td>$row[doc_origem]</td>";
			//echo "<td>$row[sintese_txt]</td>";
			//echo "<td>$row[situacao]</td>";//tb envolvido
			echo "<td>$row[origem_proc]-$row[origem_sjd_ref]/$row[origem_sjd_ref_ano]</td>";
			//echo "<td>$row[digitador]</td>";

			echo "<td>";

			link::popup("?module=movimento&movimento[id_proc_outros]=$row[id_proc_outros]");//?module=proc_outros&opcao=diligencia&acao=adicionardiligencia&proc_outros[id]=
			echo "<img src='img/add-green.png' height=16 width=16>&nbsp;</a>";
		if ($user['nivel']==5) {
			link::popup("?module=proc_outros&proc_outros[id]=$row[id_proc_outros]&noheader");
			echo "<img src='img/lapis.gif'>&nbsp;</a>";
			if ($user['nivel']==5)
			echo "<a onclick='return Confirma();' href='?module=proc_outros&opcao=apagar&acao=apagar&proc_outros[id]=$row[id_proc_outros]'><img border=0 src='img/delete.png'></a>";
		}
			echo "</td>";

		closeTR();
		$i++;
	}

closeTable();

link::popup("?module=proc_outros&rg=$rg&opcao=cadastrar&noheader",650,670);
echo "<input class='noprint' type='button' value='Adicionar'>";
echo "</a>";
?>
