<?php
echo "<a href='?module=sai&opcao=lista'>Clique aqui para voltar.</a>";
h1("Busca no campo SAI");

echo "<form action='?module=tramitacao&opcao=busca_sai' method='POST'>";
$campo=$_REQUEST['campo'];

openTable("class='bordasimples' width='100%'");
	openTR();
		openTD(" width='60%'");
			$opcoes="id='foco' value='$_REQUEST[busca]'";
			form::input("Palavras-chave (busca por similaridade)", "busca");
		closeTD();
		openTD(" width='40%'");
			form::openLabel("Campo em que as palavras v&atilde;o ser buscadas");
				echo "<input "; if ($campo=="sintese_txt") echo "checked"; echo " type='radio' name='campo' value='sintese_txt'> S&iacute;ntese (SAI) 	|";
				echo "<input "; if ($campo=="docorigem") echo "checked"; echo " type='radio' name='campo' value='docorigem'> Doc. Origem (SAI) 	|";
				echo "<input "; if ($campo=="diligencias_txt") echo "checked"; echo " type='radio' name='campo' value='diligencias_txt'> Dilig&ecirc;ncias ";
				
			form::closeLabel();
		closeTD();
		openTD("class='noprint' width='10%'");
			form::openLabel("A&ccedil;&atilde;o");
			echo "<input class='noprint' type='submit' name='acao' value='Buscar'>";
			form::closeLabel();
		closeTD();
	closeTR();
closeTable();

echo "</form>";
js::foco();

if ($acao=="buscar") {

	//Pega o campo busca do REQUEST
	$busca=$_REQUEST['busca'];
	$order=$_REQUEST['order'];
	if (!$order) $order="scoreA";

	//Pega o campo, pra saber em qual tabela procurar
	//Sao tres possibilidades:
	//sintese_txt, busca no campo sintese_txt da tabela sai
	//docorigem, busca no campo docorigem da tabela sai
	//diligencias_txt, busca no campo diligencias_txt da tabela saidiligencias
	$campo=$_REQUEST['campo'];

	//pre($campo);
	if ($campo=="sintese_txt") $tabela="sai";
	if ($campo=="docorigem") $tabela="sai";
	if ($campo=="diligencias_txt") $tabela="saidiligencias";

	//Busca por campos _txt eh com fullindex

	if (!$campo) die("Campo n&atilde;o definido!");

	if (substr($campo,-4)=="_txt") {
		$sql=" SELECT *,
		MATCH ($campo) AGAINST ('$busca') AS scoreA
		FROM $tabela ";

		if ($tabela=="saidiligencias") $sql.=" INNER JOIN sai ON sai.id_sai=saidiligencias.sai ";

		$sql.=" WHERE MATCH ($campo) AGAINST ('$busca')
		ORDER BY $order DESC";
	}
	else {
		$sql=" SELECT * FROM $tabela WHERE $campo LIKE '%$busca%'";
	}

	if ($_SESSION['debug']) pre($sql);
	//pre($sql);
	$res=mysql_query($sql);

	echo "<br>";
	h2("Resultados");
	openTable("class='bordasimples' width='100%'");

	openTR();
		lista::td("Rg","rg");
		lista::td("Cargo","cargo");
		lista::td("Nome","nome");
		lista::td("Data","data");
		lista::td("Doc. Origem","docorigem");
		echo "<td>S&iacute;ntese</td>";
		if ($tabela=="saidiligencias") echo "<td>Dilig&ecirc;ncia</td>";
	closeTR();

	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor='#FFFFFF'):($cor='#E0E0E0');
		openTR("bgcolor='$cor'");
			echo "<td><a href='?module=tramitacao&policial[rg]=$row[rg]'>$row[rg]</a></td>";
			echo "<td>$row[cargo]</td>";
			echo "<td>$row[nome]</td>";
			echo "<td>".data::inverte($row[data])."</td>";
			echo "<td>$row[docorigem]</td>";
			echo "<td>$row[sintese_txt]</td>";
			if ($tabela=="saidiligencias") echo "<td>$row[diligencias_txt]</td>";
		closeTR();
	$i++;
	}

	if (mysql_num_rows($res)==0) h1("Nenhum resultado encontrado!");

	closeTable();

}

?>
