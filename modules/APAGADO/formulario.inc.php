<br>
<script language='javascript'>
function confirmar() {
	if (window.confirm("Tem certeza?")) return true;
	else return false;
}
</script>

<?php
$tabelasMostradas=Array("id_andamento", "id_municipio", "id_situacao", "id_comportamento", "id_gradacao", "id_classpunicao");


//Regras de negocio aqui
//Exemplo: data de hoje, controle de niveis, etc

?>

<form id="APAGADO" name="APAGADO" action="?module=APAGADO" method="POST" enctype="multipart/form-data">

<!-- campo obrigatorio, nao delete -->
<input type=hidden name=APAGADO[id_APAGADO]>

<?php
openTable("width='100%' class='bordasimples' bgcolor='#FFFFFF'");
openLine();
	echo "<h2>Item APAGADO</h2>";
closeLine();

form::openTR();
	form::openTD();
		form::input("RG que apagou","APAGADO[rg]");
	form::closeTD();
	form::openTD("colspan='2'");
		$opcoes="size='60'";
		form::input("Nome que apagou","APAGADO[nome]");
	form::closeTD();

form::closeTR();

form::openTR();
	form::openTD();
		form::input("Objeto apagado","APAGADO[objeto]");
	form::closeTD();
	form::openTD();
		form::input("Data-hora","APAGADO[datahora]");
	form::closeTD();
	form::openTD();
		form::input("IP","APAGADO[ip]");
	form::closeTD();
form::closeTR();
 
openLine();
	h2("Objeto apagado");
closeLine();

$objetoapagado=simplexml_load_string(utf8_encode($APAGADO->objetoapagado));

openLine();
foreach($objetoapagado as $chave=>$valor) {
	echo "<b>$chave</b>: ".utf8_decode($valor);
	//Mostra de forma amigavel os id
	if (substr($chave,0,3)=="id_" and in_array($chave, $tabelasMostradas)) {
		$tabelaPesquisa=substr($chave,3);
		$sqlX="SELECT $tabelaPesquisa FROM $tabelaPesquisa WHERE $chave='$valor'";
		//Por ex: se for andamento fica SELECT * FROM andamento WHERE id_andamento='x'
		//echo $sqlX;
		$rox=mysql_fetch_assoc(mysql_query($sqlX));
		echo " (".$rox["$tabelaPesquisa"].")"; 
	}
	
	
	echo "<br>\r\n";
	$i++;
}
closeLine();

//echo "<tr><td><input type='submit' name='acao' value='".ucwords($opcao)."'>&nbsp;";

//if ($opcao=="atualizar") {
//	echo "<input type='submit' name='acao' value='Apagar' onclick='return confirmar();'></TD></tr>";
//}
?>
		
</table>
<!-- -->
</form>


<?php
if ($APAGADO) {
	formulario::values($APAGADO);
}

//js::desativaTudo();
?>
