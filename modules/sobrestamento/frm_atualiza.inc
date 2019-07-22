<?php
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

//Definicao de variaveis
$sobrestamento->rg=$_SESSION[usuario]->rg;
$procedimento=$_REQUEST[procedimento];

//Formulario de atualizacao
echo "<form name='sobrestamento' action='?module=sobrestamento&opcao=atualizar&procedimento=$procedimento' method='POST'>";
echo "<input type='hidden' name='sobrestamento[id_sobrestamento]'>";
echo "<input type='hidden' name='sobrestamento[id_$procedimento]'>";

echo "<table width=100%>";
echo "<tr><td colspan=4><h2>Atualização de sobrestamento</h2></td></tr>";

form::openTR();
		form::openTD("colspan='2'");
		//Férias, Incidente de Insanidade, Substituição, Laudos/Perícia, Deslinde Criminal e Outros
		$textoForm="
		<select readonly name=sobrestamento[motivo] id='descricao'>
			<option value='Férias'>Férias</option>
			<option value='Incidente de Insanidade'>Incidente de Insanidade</option>
			<option value='Substituição'>Substituição</option>
			<option value='Laudos/Perícia'>Laudos/Perícia</option>
			<option value='Deslinde Criminal'>Deslinde Criminal</option>
			<option value='outros'>Outros</option>
		</select>";
		form::input("Motivo","",$textoForm);
		form::closeTD();
		form::openTD("width='50%' id='descricao_outros' style='display:'");
		$opcoes="size='30' maxlength='180'";
		form::input("Motivo outros","sobrestamento[motivo_outros]");
	form::closeTD();
	form::closeTR();

	form::openTR();
		form::openTD();
			form::input("Data de inicio","sobrestamento[inicio_data]");
		form::closeTD();
		form::openTD();
			form::input("N&deg; Documento (Ex: Despacho n° 2.144/2018)","sobrestamento[doc_controle_inicio]");
		form::closeTD();
		form::openTD();
			form::input("Publica&ccedil;&atilde;o do in&iacute;cio (Ex: BG 100/2007)","sobrestamento[publicacao_inicio]");
		form::closeTD();
	form::closeTR();

	form::openTR();
		form::openTD();
			/*if($_SESSION[usuario]->opm->codigoBase != '020' || $user['nivel'] < 4 )
			{
				$opcaoGeral2="required='true'";
				form::input("Data de termino","sobrestamento[termino_data]");
				unset($opcaoGeral2);
			}
			else
			{*/
				form::input("Data de termino","sobrestamento[termino_data]");
			//}
		form::closeTD();
		form::openTD();
			form::input("N&deg; Documento (Ex: Despacho n° 2.144/2018)","sobrestamento[doc_controle_termino]");
		form::closeTD();
		form::openTD();
			form::input("Publica&ccedil;&atilde;o do termino (Ex: BG 100/2007)","sobrestamento[publicacao_termino]");
		form::closeTD();
	form::closeTR();
	
form::openTR();
	form::openTD();
		if ($user['nivel']<>6 && $user['nivel']<>7) {
			echo "<input type='submit' name='acao' value='Atualizar'>";
			if ($user["nivel"]>=5) echo "<input type='submit' name='acao' value='Apagar'>";
		}
	form::closeTD();
form::closeTR();



echo "</table>";
echo "</form>";

//preenche o formulario
formulario::values($sobrestamento);

?>
