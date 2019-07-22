<?php

h1("Busca no campo tramita&ccedil;&atilde;o COGER");

echo "<form action='?module=tramitacao&opcao=busca_tramitacao' method='POST'>";

openTable("class='bordasimples' width='100%'");
	openTR();
		openTD();
			$opcoes="size='60' id='foco' value='$_REQUEST[busca]'";
			form::input("Palavras-chave (busca por similaridade)", "busca");
		closeTD();
		openTD("class='noprint'");
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


	$sql="SELECT *,
		MATCH (descricao_txt) AGAINST ('$busca') AS scoreA
		FROM tramitacao WHERE MATCH (descricao_txt) AGAINST ('$busca') 
		ORDER BY $order DESC";

	if ($_SESSION['debug']) pre($sql);
	
	$res=mysql_query($sql);

	echo "<br>";
	h2("Resultados");
	openTable("class='bordasimples' width='100%'");

	openTR();
		lista::td("Rg","rg");
		lista::td("Cargo","cargo");
		lista::td("Nome","nome");
		lista::td("Data","data");
		echo "<td>Descri&ccedil;&atilde;o</td>";
	closeTR();

	while ($row=mysql_fetch_assoc($res)) {
		($i%2)?($cor='#FFFFFF'):($cor='#E0E0E0');
		openTR("bgcolor='$cor'");
			echo "<td><a href='?module=tramitacao&policial[rg]=$row[rg]'>$row[rg]</a></td>";
			echo "<td>$row[cargo]</td>";
			echo "<td>$row[nome]</td>";
			echo "<td>".data::inverte($row[data])."</td>";
			echo "<td>$row[descricao_txt]</td>";
		closeTR();
	$i++;
	}

	if (mysql_num_rows($res)==0) h1("Nenhum resultado encontrado!");

	closeTable();

}

?>
