<?
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

//Definicao de variaveis
$movimento->rg=$_SESSION[usuario]->rg;
$procedimento=$_REQUEST[procedimento];

//Formulario de atualizacao
echo "<form name='movimento' action='?module=movimento&opcao=atualizar&procedimento=$procedimento' method='POST'>";
echo "<input type='hidden' name='movimento[id_movimento]'>";

echo "<table width=100%>";
echo "<tr><td colspan=2><h2>Atualização de movimento</h2></td></tr>";

form::openTR();
	form::openTD();
		$opcoes="readonly";
		form::input("Nº identificador", "movimento[id_$procedimento]");
	form::closeTD();
	form::openTD();
		$opcoes="readonly";
		form::input("RG", "movimento[rg]");
	form::closeTD();
form::closeTR();
form::openTR();
	form::openTD("colspan='2'");
		$texto="<textarea name='movimento[descricao]'] rows=5 cols=67' $opcaoGeral2></textarea>";
		form::input("Descrição","",$texto);
	form::closeTD();
form::closeTR();
form::openTR();
	form::openTD();
		if (!$opcaoGeral2) {
			echo "<input type='submit' name='acao' value='Atualizar'>";
			if ($user["nivel"]>=5) echo "<input type='submit' name='acao' value='Apagar'>";
		}
	form::closeTD();
form::closeTR();



echo "</table>";
echo "</form>";

//preenche o formulario
formulario::values($movimento);

?>
