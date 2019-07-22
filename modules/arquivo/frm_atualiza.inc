<?php
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

//Definicao de variaveis
$arquivo->rg=$_SESSION[usuario]->rg;
$arquivo->nome=$_SESSION[usuario]->nome;
$procedimento=$_REQUEST[procedimento];
$ref=$_REQUEST[ref];
$ano=$_REQUEST[ano];


//Formulario de atualizacao
echo "<form name='arquivo' action='?module=arquivo&opcao=atualizar' method='POST'>";
echo "<input type='hidden' name='arquivo[id_arquivo]'>";
// echo "<input type=\"hidden\" name=\"arquivo[procedimento]\" value=\"$procedimento\">";
// echo "<input type=\"hidden\" name=\"arquivo[id_$procedimento]\" value=\"$idp\">";
// echo "<input type=\"hidden\" name=\"arquivo[sjd_ref]\" value=\"$ref\">";
// echo "<input type=\"hidden\" name=\"arquivo[sjd_ref_ano]\" value=\"$ano\">";
echo "<input type=\"hidden\" name=\"arquivo[retorno_data]\" value=\"".data::hoje()."\">";
// echo "<input type=\"hidden\" name=\"arquivo[rg]\" value=\"".$usuario->rg."\">";
// echo "<input type=\"hidden\" name=\"arquivo[nome]\" value=\"".$usuario->nome."\">";
// echo "<input type=\"hidden\" name=\"arquivo[opm]\" value=\"".$usuario->opm->abreviatura."\">";

echo "<table width=100%>";
echo "<tr><td colspan=4><h2>Atualização de arquivo - ".strtoupper($procedimento)." - $ref/$ano</h2></td></tr>";

form::openTR("class='row'");
	form::openTD("class='col-md-4'");
		$textoForm="<select name=arquivo[local_atual] $opcaoGeral2>
			<option>Arquivo COGER</option>
			<option>Arquivo Geral(PMPR)</option>
		</select>";
		form::input("Local","",$textoForm);
	form::closeTD();
	form::openTD("class='col-md-4'");
		form::loop("N&uacute;mero", "arquivo[numero]","1","100","-");
	form::closeTD();
	form::openTD("class='col-md-4'");
		form::loop("Letra", "arquivo[letra]","a","z","-");
	form::closeTD();
form::closeTR();
form::openTR();
	form::openTD();
		form::input("Data","arquivo[arquivo_data]");
	form::closeTD();
	form::openTD("colspan='2'");
		$textoForm="<input name='arquivo[obs]' class='form-control' type='text' size='30'>";
		form::input("Observacoes","",$textoForm);
	form::closeTD();
form::closeTR();
form::openTR();
	form::openTD();
		if (!$opcaoGeral2) {
			echo "<input type='submit' name='acao' value='Atualizar'>";
			echo "<input type='submit' name='acao' value='Apagar'>";
		}
	form::closeTD();
form::closeTR();

echo "</table>";
echo "</form>";

//preenche o formulario
formulario::values($arquivo);

?>
