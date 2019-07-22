<br>
<script language='javascript'>
function confirmar() {
	if (window.confirm("Tem certeza?")) return true;
	else return false;
}
</script>

<?php
//Captura ligacoes no banco de dados
$sqlL="SELECT * FROM ligacao WHERE destino_proc='falecimento' AND id_falecimento='".$falecimento->id_falecimento."'";
$resL=mysql_query($sqlL);
$ligacoes=mysql_num_rows($resL);

?>

<form id="falecimento" class="controlar-modificacao" name="falecimento" action="?module=falecimento" method="POST" enctype="multipart/form-data">

<!-- campo obrigatorio, nao delete -->
<input type=hidden name=falecimento[id_falecimento]>

<?php
openTable("width='100%' bgcolor='#FFFFFF' class='bordasimples'");
openLine();
	echo "<h2>Formulario para cadastro de &oacute;bitos e les&otilde;es</h2>";
closeLine();

form::openTR();
	form::openTD();
		form::openLabel("RG");
		if ($falecimento->rg) $disabled="disabled";
		echo "<input $disabled id='foco' type=text size=12 onkeypress='return DigitaNumeroTempoReal(this, event);' name=falecimento[rg] onblur=\"ajaxForm(this,'policial',Array('nome','cargo'));\"></td>";
		form::closeLabel();
	form::closeTD();

	form::openTD();
		form::openLabel("Cargo/Nome");
		echo "<input id='frmcargo' readOnly=\"readonly\" type=text size=10 name=\"falecimento[cargo]\">&nbsp;&nbsp;";
		echo "<input id='frmnome' readOnly=\"readonly\" type=text size=50 ajax=1 name='falecimento[nome]'>";
		echo "&nbsp;&nbsp;<a title='Somente libere caso o PM n&atilde;o esteja no Meta4' href='#none' onclick=\"document.getElementById('frmnome').readOnly=false; document.getElementById('frmcargo').readOnly=false;\">Liberar campo</a>";
		form::closeLabel();
	form::closeTD();
closeTR();


form::openTR();
	form::openTD();
		form::input("Data do fato","falecimento[data]");
	form::closeTD();
	openTD("colspan='2'");
		form::openLabel("Cidade do fato");
			formulario::option("falecimento","municipio","","","",0);
		form::closeLabel();
	closeTD();
form::closeTR();

	openTR();
		openTD("colspan='2'");
			form::openLabel("Endereco");
			?>
			Rua/Av
			<input type='text' size='60' maxlength='250' name='falecimento[endereco]'>
			n&ordm; e compl.
			<input type='text' size='15' name='falecimento[endereco_numero]'>
			<?php

			form::closeLabel();
		closeTD();
	closeTR();

form::openTR();
	form::openTD("colspan='3'");
		$indice=0;
		formulario::subform("ligacao",$ligacoes,"Procedimento(s) relacionados (apenas se houver)");
		form::closeTD();
form::closeTR();		

	if ($ligacoes) {
		$i=1;
		while ($rowL=mysql_fetch_assoc($resL)) {
			formulario::values($rowL,"ligacao[$i]");
			$i++;
		}
	}


openTR();
	openTD();
		form::openLabel("OPM");
		echo "<select name='falecimento[cdopm]'>";
			include("includes/option_opm.php");
		echo "</select>";
		form::closeLabel();
	closeTD();

	openTD();
		form::openLabel("BOU (Boletim de Ocorr&ecirc;ncia Unificado)");
			echo "Ano: ";			
			echo "<select name='falecimento[bou_ano]'>\r\n";
				for ($i=2005;$i<=date("Y");$i++) {
					echo "<option>$i</option>";
				}
			echo "</select>  N&ordm;";
			echo "<input name='falecimento[bou_numero]' type='text' size='7' maxlength='7' onkeypress='return dntr(this, event);'>";
		form::closeLabel();
	closeTD();
closeTR();

openTR();
	openTD();
		form::openLabel("Situa&ccedil;&atilde;o");
			formulario::option("falecimento","situacao","","",0,0);
		form::closeLabel();
	closeTD();

	openTD();
		form::openLabel("Resultado");
			?>
			<select name='falecimento[resultado]'>
				<option value=''>SELECIONE</option>
				<option value='Obito'>Obito</option>
				<option value='Lesao Corporal'>Lesao Corporal</option>
			</select>
			<?php
		form::closeLabel();
	closeTD();
closeTR();

openTR();
	openTD("colspan='3'");
		form::input("Descri&ccedil;&atilde;o do fato","falecimento[descricao_txt]");
	closeTD();
closeTR();


echo "<tr><td><input type='submit' name='acao' value='".ucwords($opcao)."'>&nbsp;";

if ($opcao=="atualizar" and $user['nivel']==5) {
	echo "<input type='submit' name='acao' value='Apagar' onclick='return confirmar();'></TD></tr>";
}
?>
		
</table>
<!-- -->
</form>

</div>


<?
if ($falecimento) {
	formulario::values($falecimento);
}
?>
