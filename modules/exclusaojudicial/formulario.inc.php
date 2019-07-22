<br>
<script language='javascript'>
function confirmar() {
	if (window.confirm("Tem certeza?")) return true;
	else return false;
}
</script>

<?
include("/var/www/sjd/define.php");

//Regras de negocio aqui
//Exemplo: data de hoje, controle de niveis, etc

?>

<form id="exclusaojudicial" class="controlar-modificacao" name="exclusaojudicial" action="?module=exclusaojudicial" method="POST" enctype="multipart/form-data">

<!-- campo obrigatorio, nao delete -->
<input type=hidden name=exclusaojudicial[id_exclusaojudicial]>

<div class='bordasimples'>

<?php
openTable("width='100%' bgcolor='#FFFFFF' class='bordasimples'");
openLine();
	echo "<h2>Formulario para cadastro de exclusaojudicial</h2>";
closeLine();

form::openTR();
	form::openTD("colspan='2'");
		form::openLabel("RG");
		if ($exclusaojudicial->rg) $disabled="disabled";
		echo "<input $disabled id='foco' type=text size=12 onkeypress='return DigitaNumeroTempoReal(this, event);' name=exclusaojudicial[rg] onblur=\"ajaxForm(this,'policial',Array('nome','cargo'));\"></td>";
		form::closeLabel();
	form::closeTD();

	form::openTD();
		form::openLabel("Cargo/Nome");
		echo "<input id='frmnome' readonly=\"readonly\" type=text size=10 name=\"exclusaojudicial[cargo]\">&nbsp;&nbsp;";
		echo "<input id='frmcargo' readonly=\"readonly\" type=text size=40 ajax=1 name='exclusaojudicial[nome]'><a onclick=\"document.getElementById('frmnome').readOnly=false; document.getElementById('frmcargo').readOnly=false;\">Liberar campo</a>";
		form::closeLabel();
	form::closeTD();

form::closeTR();

form::openTR();
	form::openTD("colspan='2'");
		$cdopm_selected=$exclusaojudicial->cdopm_prisao;
		form::openLabel("OPM em que estava servindo quando exclu&iacute;do");
		echo "<select id='exclusaojudicial[cdopm_quandoexcluido]' name='exclusaojudicial[cdopm_quandoexcluido]'>";
		include("includes/option_opm_todas.php");
		echo "</select>";
		abaixoAcima('exclusaojudicial[cdopm_quandoexcluido]');
		form::closeLabel();
	form::closeTD();
	form::openTD();

	form::closeTD();
form::closeTR();

	openTR("id='civil' rel='civil'");
		openTD("colspan='2'");
		form::input("Local onde o policial est&aacute; exclusaojudicial (Ex: COCT II)","exclusaojudicial[localreclusao]");
		closeTD();
	closeTR();
form::closeTR();

form::openTR();
	form::openTD("colspan='2'");
	form::openLabel("Procedimento vinculado (se houver)");
		echo "<select id='proc1' name='exclusaojudicial[origem_proc]' >";
		echo "<option value=''>Nenhum</option>";
                foreach ($sjd_procedimentos as $proc) {
                        if ($proc=="apfd") {
                                echo "<option value='apfdc'>apfd comum</option>";
                                echo "<option value='apfdm'>apfd militar</option>";
                        }
                        else echo "<option value='$proc'>$proc</option>";
                }
                echo "</select>";
	form::closeLabel();
form::closeTD();
form::openTD();
$indice="1";
form::openLabel("Numera&ccedil;&atilde;o");
echo "N&ordm;";
echo "<input id='ref1' onkeypress='return dntr(this,event)' onblur=\"ajaxLigacao('1')\" type='text' size='3' maxlength='4' name='exclusaojudicial[origem_sjd_ref]'>/";

?>
<input id='ano1' onkeypress='return dntr(this,event)' onblur="ajaxLigacao('1');"  type='text' size=3 maxlength=4 name="exclusaojudicial[origem_sjd_ref_ano]"> 
               &nbsp;(Ano com 4 digitos)</font>
        </td>
        <td>
                OPM: <input id="<?php echo 'opm'.$indice; ?>" readonly type='text' size='15' name="exclusaojudicial[origem_opm]">
                <font color='darkblue'> (Apenas para confer&ecirc;ncia)</font>
        </td>
<?php

form::closeLabel();



form::openTR();
	form::openTD("colspan='2'");
		$opcoes="size='40'";
		form::input("Processo, N&ordm; do processo - Comarca. (<b>Ex: A&ccedil;&atilde;o Penal Militar n&ordm; 2010.0000XXX-X - Curitiba</b>)","exclusaojudicial[processo]");
	form::closeTD();
	form::openTD();
		$opcoes="size='60'";
		form::input("Artigos da Infra&ccedil;&atilde;o penal (Ex: Art. 121 &sect; 2&ordm; CP)","exclusaojudicial[complemento]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='2'");
		form::input("Vara e Comarca(Ex: 3&ordf; Vara Criminal de Curitiba)", "exclusaojudicial[vara]");
	form::closeTD();
	form::openTD();
		form::input("N&ordm; &uacute;nico (Ex: 0003956-00.2012.8.16.0013)", "exclusaojudicial[numerounico]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD();
		form::input("Data da senten&ccedil;a","exclusaojudicial[data]");
	form::closeTD();
	form::openTD();
		form::input("Data da exclus&atilde;o (data que publicou a portaria)","exclusaojudicial[exclusao_data]");
	form::closeTD();
	form::openTD();
		form::openLabel("Portaria e Boletim Geral");
			echo "Portaria n&ordm;";
			echo "<input type='text' name='exclusaojudicial[portaria_numero]' size='5' maxlength='5' onkeypress='return dntr(this, event)'>";
			echo "publicada no BG n&ordm; ";
			echo "<input type='text' name='exclusaojudicial[bg_numero]' size='3' maxlength='3' onkeypress='return dntr(this, event)'>/";
			echo "<input type='text' name='exclusaojudicial[bg_ano]' size='4' maxlength='4' onkeypress='return dntr(this, event)'>";
			echo "<font color='darkgreen'>*Ano com 4 d&iacute;gitos</font>";
		form::closeLabel();
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='3'");
		form::input("Observa&ccedil;&otilde;es","exclusaojudicial[obs_txt]");
	form::closeTD();
form::closeTR();



echo "<tr><td><input type='submit' name='acao' value='".ucwords($opcao)."'>&nbsp;";

if ($opcao=="atualizar") {
	echo "<input type='submit' name='acao' value='Apagar' onclick='return confirmar();'></TD></tr>";
}
?>
		
</table>
<!-- -->
</form>

</div>


<?
if ($exclusaojudicial) {
	formulario::values($exclusaojudicial);
}
?>
