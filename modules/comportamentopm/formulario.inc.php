<script language='javascript'>
function confirmar() {
	if (window.confirm("Tem certeza?")) return true;
	else return false;
}
function validar(form) {
	//COMP
	campo=document.getElementsByName('comportamentopm[id_comportamento]')[0];
	if (campo.value=="") {
		window.alert("Preencha o novo comportamento!"); campo.focus(); return false;
	}
	return true;
}
</script>

<?
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco
//Regras de negocio aqui
//Exemplo: data de hoje, controle de niveis, etc

if (!$comportamentopm->rg) $comportamentopm->rg=$_REQUEST['rg'];
if (!$comportamentopm->data) $comportamentopm->data=date("d/m/Y");
if (!$comportamentopm->rg_cadastro) $comportamentopm->rg_cadastro=$usuario->rg;
if (!$comportamentopm->cdopm) $comportamentopm->cdopm=$usuario->opm->codigoBase;
if (!$comportamentopm->opm_abreviatura) $comportamentopm->opm_abreviatura=$usuario->opm->abreviatura;

if (!$comportamentopm->rg) die("<h3>RG invalido!</h3>");
$policial=new policial($comportamentopm->rg);

if (!$policial->nome) die ("<h3>Policial inexistente!</h3>");

?>

<form id="comportamentopm" class="controlar-modificacao" onsubmit='return validar(this);' name="comportamentopm" action="?module=comportamentopm&noheader" method="POST" enctype="multipart/form-data">

<!-- campo obrigatorio, nao delete -->
<input type=hidden name=comportamentopm[id_comportamentopm]>

<!--
<input type=hidden name=comportamentopm[data]>
-->

<input type=hidden name=comportamentopm[rg_cadastro]>
<input type=hidden name=comportamentopm[cdopm]>
<input type=hidden name=comportamentopm[opm_abreviatura]>

<div class='bordasimples'>

<?php
//pre($comportamentopm);
openTable("width='100%' bgcolor='#FFFFFF'");
openLine();
	echo "<h2>Formulario para adicionar PUNI&Ccedil;&Atilde;O/mudanca de COMPORTAMENTO</h2>";
closeLine();

form::openTR();
	form::openTD("colspan='2'");
		form::openLabel("Policial");
		echo "RG: <input type='text' size='12' maxlength='25' readonly name='comportamentopm[rg]'>";
		echo $policial->cargo." ".$policial->nome;
		form::closeLabel();
	form::closeTD();
form::closeTR();

openTR();
	openLine();
		form::openLabel("OPM");
		echo $policial->opm->descricao;
		form::closeLabel();
	closeLine();
closeTR();


openTR();
	openTD();
		//$opcoes="readonly";
		form::input("Data (Art. 63 RDE)","comportamentopm[data]");
	closeTD();
	openTD();
		//$opcoes="readonly";
		$opcoes="size='40' maxlength='120'";
		form::input("Publica&ccedil;&atilde;o <font color='blue'>(Ex: BI n&ordm; 010/2011)</font>","comportamentopm[publicacao]");
	closeTD();
closeTR();


openTR();
	openTD();
		form::openLabel("Novo comportamento");
			formulario::option("comportamentopm","comportamento","","",0,0);
		form::closeLabel();
	closeTD();
	openTD();
		$textoForm="<select name=comportamentopm[motivo] id=comportamentopm[motivo] onchange='motivoComportamentopm()' $opcaoGeral2>						
		<option value=''>Selecione</option>
		<option value='Inclusao na PMPR'>Inclus&atildeo na PMPR</option>
<option value='Alt. de comportamento - ART. 51 RDE. &sect;7&ordm; I- do \"Mau\" para o \"Insuficiente\"'>Alt. de comportamento - ART. 51 RDE. &sect;7&ordm; I- do \"Mau\" para o \"Insuficiente\"</option>
<option value='Alt. de comportamento - ART. 51 RDE. &sect;7&ordm; II- do \"Insuficiente\" para o \"Bom\"'>Alt. de comportamento - ART. 51 RDE. &sect;7&ordm; II- do \"Insuficiente\" para o \"Bom\"</option>
<option value='Alt. de comportamento - ART. 51 RDE. &sect;7&ordm; III- do \"Bom\" para o \"Otimo\"'>Alt. de comportamento - ART. 51 RDE. &sect;7&ordm; III- do \"Bom\" para o \"&Oacute;timo\"</option>
<option value='Alt. de comportamento - ART. 51 RDE. &sect;7&ordm; IV- do \"Otimo\" para o \"Excepcional\"'>Alt. de comportamento - ART. 51 RDE. &sect;7&ordm; IV- do \"&Oacute;timo\" para o \"Excepcional\"</option>
<option value='Cancelamento de Punicao - ART. 59 RDE.'>Cancelamento de Punicao - ART. 59 RDE.</option>
		</select>";
		form::input("Motivo","",$textoForm);
	closeTD();
closeTR();

form::openTR("id='comportamentopmtr' style='display:none'");
	form::openTD("colspan='2'");
		form::openLabel("Qual Puni&ccedil;&atilde;o");
		$sql = "SELECT id_punicao, procedimento, sjd_ref, sjd_ref_ano, descricao_txt FROM sjd.punicao WHERE rg='$policial->rg'";
		//pre($sql);exit;
		$res=mysql_query($sql);
		$cont=mysql_num_rows($res);
		if(!$cont){	
			echo "N&atilde;o H&acute;";
		}
		else{
			echo "<select name='comportamentopm[id_punicao]' $opcaoGeral2 style='text-overflow: ellipsis'>";
			$i=0;
			while ($row=mysql_fetch_array($res)) {
				echo "<option value=\"row['id_punicao']\">";
				echo strtoupper($row['procedimento'])."-".$row['sjd_ref']."/".$row['sjd_ref_ano']." \"".$row['descricao_txt']."\"";
				echo "</option>";
			$i++;
			}
			echo "</select>";
		}
		form::closeLabel();
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='2'");
		$opcoes="rows='2' cols='60'";
		form::input("Observa&ccedil;&otilde;es","comportamentopm[motivo_txt]");
	form::closeTD();
form::closeTR();

if (!$opcaoGeral2) {
	echo "<tr><td><input type='submit' name='acao' value='".ucwords($opcao)."'>&nbsp;";

	if ($opcao=="atualizar") {
		echo "<input type='submit' name='acao' value='Apagar' onclick='return confirmar();'></TD></tr>";
	}
}
?>
		
</table>
<!-- -->
</form>

</div>


<?
if ($comportamentopm) {
	formulario::values($comportamentopm);
}
?>
