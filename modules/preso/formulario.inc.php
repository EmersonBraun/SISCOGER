<br>
<script language='javascript'>
function confirmar() {
	if (window.confirm("Tem certeza?")) return true;
	else return false;
}
function validar(form) {
	//Reserva
	campo=document.getElementsByName('preso[cargo]')[0];
	if (campo.value=="") {
		campo.value="RR"; return true;
	}
	//Sintese
	campo=document.getElementsByName('preso[complemento]')[0];
	if (campo.value=="") {
		window.alert("Preencha o artigo da infracao!"); campo.focus(); return false;
	}
	//Tipo da prisao
	campo=document.getElementsByName('preso[id_presotipo]')[0];
	if (campo.value=="") {
		window.alert("Preencha o tipo da prisao!"); campo.focus(); return false;
	}
}
</script>

<?
include("/var/www/sjd/define.php");

//Regras de negocio aqui
//Exemplo: data de hoje, controle de niveis, etc

?>

<form id="preso" class="controlar-modificacao" name="preso" action="?module=preso" method="POST" enctype="multipart/form-data" onSubmit="return validar(this);">

<!-- campo obrigatorio, nao delete -->
<input type=hidden name=preso[id_preso]>

<div class='bordasimples'>

<?php
openTable("width='100%' bgcolor='#FFFFFF' class='bordasimples'");
openLine();
	echo "<h2>Formulario para cadastro de Preso</h2>";
closeLine();

form::openTR();
	form::openTD();
		form::openLabel("RG");
		if ($preso->rg) $disabled="disabled";
		echo "<input $disabled id='foco' type=text size=12 onkeypress='return DigitaNumeroTempoReal(this, event);' name=preso[rg] onblur=\"ajaxForm(this,'policial',Array('nome','cargo'));\"></td>";
		form::closeLabel();
	form::closeTD();

	form::openTD();
		form::openLabel("Cargo/Nome");
		echo "<input readonly=\"readonly\" type=text size=10 name=\"preso[cargo]\">&nbsp;&nbsp;";
		echo "<input readonly=\"readonly\" type=text size=50 ajax=1 name='preso[nome]'>";
		form::closeLabel();
	form::closeTD();

form::closeTR();

form::openTR();
	form::openTD();
		$cdopm_selected=$preso->cdopm_prisao;
		form::openLabel("OPM em que estava servindo quando foi preso");
		echo "<select id='preso[cdopm_quandopreso]' name='preso[cdopm_quandopreso]'>";
			include("includes/option_opm_todas.php");
		echo "</select>";
		abaixoAcima('preso[cdopm_quandopreso]');
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::openLabel("OM atual");
		echo "Essa informa&ccedil;&atilde;o vir&aacute; do Meta4";
		form::closeLabel();
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='2'");
		form::openLabel("Local de reclus&atilde;o/deten&ccedil;&atilde;o");
		?>
		<select name='preso[local]'>
			<option rel='quartel' value='quartel'>Quartel</option>
			<option rel='civil' value='civil'>&Oacute;rg&atilde;os civis</option>
		</select>
		<?php
		form::closeLabel();
	form::closeTD();

	openTR("id ='quartel' rel='quartel'");
		openTD("colspan='2'");
		form::openLabel("Quartel onde o policial est&aacute; preso");
			echo "<select id='preso[cdopm_prisao]' name='preso[cdopm_prisao]'>";
				include("includes/option_opm_todas.php");
			echo "</select>";
			abaixoAcima("preso[cdopm_prisao]");
		form::closeLabel();
		closeTD();
	closeTR();

	openTR("id='civil' rel='civil'");
		openTD("colspan='2'");
		form::input("Local onde o policial est&aacute; preso (Ex: COCT II)","preso[localreclusao]");
		closeTD();
	closeTR();
form::closeTR();

form::openTR();
	form::openTD();
	form::openLabel("Procedimento vinculado");
		echo "<select id='proc1' name='preso[origem_proc]' >";
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
echo "<input id='ref1' onkeypress='return dntr(this,event)' onblur=\"ajaxLigacao('1')\" type='text' size='3' maxlength='4' name='preso[origem_sjd_ref]'>/";

?>
<input id='ano1' onkeypress='return dntr(this,event)' onblur="ajaxLigacao('1');"  type='text' size=3 maxlength=4 name="preso[origem_sjd_ref_ano]"> 
               &nbsp;(Ano com 4 digitos)</font>
        </td>
        <td>
                OPM: <input id="<?php echo 'opm'.$indice; ?>" readonly type='text' size='15' name="preso[origem_opm]">
                <font color='darkblue'> (Apenas para confer&ecirc;ncia)</font>
        </td>
<?php

form::closeLabel();



form::openTR();
	form::openTD();
		$opcoes="size='40'";
		form::input("Processo, N&ordm; do processo - Comarca. (<b>Ex: A&ccedil;&atilde;o Penal Militar n&ordm; 2010.0000XXX-X - Curitiba</b>)","preso[processo]");
	form::closeTD();
	form::openTD();
		$opcoes="size='60'";
		form::input("Artigos da Infra&ccedil;&atilde;o penal (Ex: Art. 121 &sect; 2&ordm; CP)","preso[complemento]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD();
		form::input("N&ordm; do mandado de pris&atilde;o, se houver (Ex: 000183216-55)", "preso[numeromandado]");
	form::closeTD();
	form::openTD();
		form::openLabel("Tipo da pris&atilde;o");
			formulario::option("preso","presotipo","","","",0);
		form::closeLabel();
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD();
		form::input("Vara (Ex: 3&ordf; Vara Criminal)", "preso[vara]");
	form::closeTD();
	form::openTD();
		form::input("Comarca (Ex: Curitiba)", "preso[comarca]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD();
		form::input("Data de entrada na pris&atilde;o","preso[inicio_data]");
	form::closeTD();
	form::openTD();
		form::input("Data de sa&iacute;da da pris&atilde;o","preso[fim_data]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='2'");
		form::input("Observa&ccedil;&otilde;es","preso[obs_txt]");
	form::closeTD();
form::closeTR();



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
if ($preso) {
	formulario::values($preso);
}
?>
