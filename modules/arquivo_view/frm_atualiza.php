<?
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

//Definicao de variaveis
$arquivo->rg=$_SESSION[usuario]->rg;
$arquivo->nome=$_SESSION[usuario]->nome;
$procedimento=$_REQUEST[procedimento];

//Formulario de atualizacao
echo "<form name='arquivo' action='?module=arquivo&opcao=atualizar&procedimento=$procedimento' method='POST'>";
echo "<input type='hidden' name='arquivo[id_arquivo]'>";
// echo "<input type=\"hidden\" name=\"arquivo[procedimento]\" value=\"$procedimento\">";
// echo "<input type=\"hidden\" name=\"arquivo[id_$procedimento]\" value=\"$idp\">";
// echo "<input type=\"hidden\" name=\"arquivo[sjd_ref]\" value=\"$row[sjd_ref]\">";
// echo "<input type=\"hidden\" name=\"arquivo[sjd_ref_ano]\" value=\"$row[sjd_ref_ano]\">";
echo "<input type=\"hidden\" name=\"arquivo[retorno_data]\" value=\"".data::hoje()."\">";
// echo "<input type=\"hidden\" name=\"arquivo[rg]\" value=\"".$usuario->rg."\">";
// echo "<input type=\"hidden\" name=\"arquivo[nome]\" value=\"".$usuario->nome."\">";
// echo "<input type=\"hidden\" name=\"arquivo[opm]\" value=\"".$usuario->opm->abreviatura."\">";

echo "<table width=100%>";
echo "<tr><td colspan=3><h2>Atualização de arquivo</h2></td></tr>";

form::openTR();
	form::openTD();
		$opcoes="readonly";
		form::input("RG", "arquivo[rg]");
	form::closeTD();
	form::openTD();
		$opcoes="readonly";
		form::input("Nome", "arquivo[nome]");
	form::closeTD();
form::closeTR();
form::openTR();
	form::openTD();
		$textoForm="<select name=arquivo[local] $opcaoGeral2>
			<option selected>Arquivo COGER</option>
			<option>Arquivo Geral(PMPR)</option>
			<option>Cautela (Retorno)</option>
		</select>";
		form::input("Local","",$textoForm);
	form::closeTD();
	form::openTD();
		form::loop("N&uacute;mero", "arquivo[numero]","1","100","-");
	form::closeTD();
	form::openTD();
		form::loop("Letra", "arquivo[letra]","a","z","-");
	form::closeTD();
form::closeTR();
form::openTR();
	form::openTD();
		if (!$opcaoGeral2) {
			echo "<input type='submit' name='acao' value='Atualizar'>";
			//if ($user["nivel"]>=5) echo "<input type='submit' name='acao' value='Apagar'>";
		}
	form::closeTD();
form::closeTR();

echo "</table>";
echo "</form>";

//preenche o formulario
formulario::values($arquivo);

?>
