<?
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

//Regras de negocio aqui
//Exemplo: data de hoje, controle de niveis, etc

if (!$punicao->rg) $punicao->rg=$_REQUEST['rg'];
if (!$punicao->data) $punicao->data=date("d/m/Y");
if (!$punicao->rg_cadastro) $punicao->rg_cadastro=$usuario->rg;
if (!$punicao->digitador) $punicao->digitador=$usuario->nome;

if (!$punicao->rg) die("<h3>RG invalido</h3>");
$policial=new policial($punicao->rg);
if (!$punicao->cargo) $punicao->cargo=$policial->cargo;
if (!$punicao->nome) $punicao->nome=$policial->nome;
if (!$punicao->id_posto) $punicao->id_posto=$policial->id_posto;

?>

<script language='javascript'>
function confirmar() {
	if (window.confirm("Tem certeza?")) return true;
	else return false;
}

function validar(form) {
	//Gradacao
	campo=document.getElementsByName('punicao[id_gradacao]')[0];
	if (campo.value=="") {
		window.alert("Preencha a grada&ccedil;&atilde;o!"); campo.focus(); return false;
	}
	//Classificacao
	campo=document.getElementsByName('punicao[id_classpunicao]')[0];
	if (campo.value=="") {
		window.alert("Preencha a classifica&ccedil;&atilde;o!"); campo.focus(); return false;
	}
	//Classificacao
	campo=document.getElementsByName('punicao[cdopm]')[0];
	if (campo.value=="") {
		window.alert("Preencha a OPM da punicao!"); campo.focus(); return false;
	}
<?php
if ($punicao->id_posto >= 7) {
?>
	//Comportamento
	campo=document.getElementsByName('punicao[id_comportamento]')[0];
	if (campo.value=="") {
		window.alert("Preencha o Comportamento!"); campo.focus(); return false;
	}
<?php
}
?>	
	//Atrelar classificacao com gradacao
	classificacao=document.getElementsByName('punicao[id_classpunicao]')[0];
	gradacao=document.getElementsByName('punicao[id_gradacao]')[0];
	if (classificacao.value=="1") { //LEVE
		if (gradacao.value!="1" && gradacao.value!="2") {
			window.alert("Punicao LEVE so pode ser ADVERTENCIA ou IMPEDIMENTO");
			gradacao.focus();
			return false;
		}
	}
	
	if (classificacao.value=="2") { //MEDIA
		if (gradacao.value!="3" && gradacao.value!="4") {
			window.alert("Punicao MEDIA so pode ser REPREENSAO ou DETENCAO");
			gradacao.focus();
			return false;
		}
	}
	
	if (classificacao.value=="3") { //GRAVE
		if (gradacao.value!="5") {
			window.alert("Punicao GRAVE so pode ser PRISAO");
			gradacao.focus();
			return false;
		}
	}
	

return true;
}

</script>

<form id="punicao" class="controlar-modificacao" name="punicao" onsubmit='return validar(this)' action="?module=punicao&noheader" method="POST" enctype="multipart/form-data">

<!-- campo obrigatorio, nao delete -->
<input type=hidden name=punicao[id_punicao]>

<!--
<input type=hidden name=punicao[data]>
-->

<input type=hidden name=punicao[rg_cadastro]>
<input type=hidden name=punicao[opm_abreviatura]>
<input type=hidden name=punicao[digitador]>

<div class='bordasimples'>

<?php

//lock = variavel que trava os campos de referencia, pois a pessoa esta cadastrando diretamente do fatd
if (isset($_REQUEST['lock'])) $lock=" readonly "; else $lock="";

if ($punicao->id_punicao) $lock=" readonly";

//pre($punicao);
openTable("width='100%' bgcolor='#FFFFFF'");
openLine();
	echo "<h2>Formulario para cadastro de punicao</h2>";
closeLine();

form::openTR();
	form::openTD("colspan='2'");
		form::openLabel("Policial");
		echo "RG: <input type='text' size='12' maxlength='25' readonly name='punicao[rg]'>";
		echo "RG: <input type='text' size='6' maxlength='10' readonly name='punicao[cargo]'>";
		echo "RG: <input type='text' size='40' readonly name='punicao[nome]'>";
		form::closeLabel();
	form::closeTD();
form::closeTR();

openTR();
	openTD();
		form::openLabel("OPM");
		echo $policial->opm->descricao;
		form::closeLabel();
	closeTD();
	openTD();
		form::openLabel("OPM da Punicao");
			echo "<select name='punicao[cdopm]' $opcaoGeral2>";
				include("includes/option_opm.php");
			echo "</select>";
		form::closeLabel();
	closeTD();
closeTR();

openTR();
	openTD();
		form::openLabel("Procedimento");
			//A UNIDADE CADASTRA PUNICAO DECORRENTE DE FATD, a coger consegue cadastrar de outros procedimentos.
			//14/07/2011
			if (!$lock) {
			echo "<select id='proc1' name='punicao[procedimento]' $opcaoGeral2>";
				echo "<option value=''>Selecione</option>";
				echo "<option value='NA'>FATD S/N COGER</option>";
				echo "<option value='fatd'>FATD</option>";
				if ($user['nivel']>=4) {
					echo "<option value='cd'>CD</option>";
					echo "<option value='adl'>ADL</option>";
					echo "<option value='cj'>CJ</option>";
				}
			echo "</select>";
			}
			else {
				echo "<input type='text' size='5' readonly name='punicao[procedimento]'>";
			}
			
			echo "&nbsp;FATDs anteriores a 2010 n&atilde;o t&ecirc;m N&ordm; COGER";
			
		form::closeLabel();
	closeTD();
	
	openTD();
		form::openLabel("N&ordm; e ANO da COGER");
			echo "<input $lock id='ref1' name='punicao[sjd_ref]' type='text' size='4' maxlength='4' onblur='ajaxLigacao(1)' $opcaoGeral2>";
			echo "/";
			echo "<input $lock id='ano1' name='punicao[sjd_ref_ano]' type='text' size='4' maxlength='4' onblur='ajaxLigacao(1)' $opcaoGeral2>";
			if ($lock=="") {
				echo "&nbsp; OPM:";
				echo "<input readonly type='text' size='10' id='opm1'>";
			}
		form::closeLabel();
	closeTD();
closeTR();


openTR();
	openTD();
		//$opcoes="readonly";
		form::input("Data da publica&ccedil;&atilde;o da nota de puni&ccedil;&atilde;o","punicao[punicao_data]");
	closeTD();
	openTD();
		form::openLabel("Classifica&ccedil;&atilde;o e Grada&ccedil;&atilde;o");
			formulario::option("punicao","classpunicao","","",0,0);
			formulario::option("punicao","gradacao","","",0,0);
		form::closeLabel();
	closeTD();
closeTR();


openTR();
	openTD();
		$opcoes="onkeypress='return dntr(this,event)' size='2' maxlength='2'";
		form::input("Dias (impedimento, pris&atilde;o e deten&ccedil;&atilde;o)","punicao[dias]");
	closeTD();
	openTD();
		form::input("Ultimo dia de cumprimento da puni&ccedil;&atilde;o (Art. 63 RDE)","punicao[ultimodia_data]");
	closeTD();
closeTR();

form::openTR();
	form::openTD("colspan='2'");
		$opcoes="rows='5' cols='60' ";
		form::input("punicao","punicao[descricao_txt]");
	form::closeTD();
form::closeTR();

if ($punicao->id_posto >= 7) {
	openTR();
		openTD("colspan='2'");
			form::openLabel("Comportamento decorrente");
				formulario::option("punicao","comportamento","","",0,0);
			form::closeLabel();
		closeTD();
	closeTR();
}

if (!$opcaoGeral2) {
	echo "<tr><td><input type='submit' name='acao' value='".ucwords($opcao)."'>&nbsp;";

	if ($opcao=="atualizar") {
		echo "<input type='submit' name='acao' value='Apagar' onclick='return confirmar();'></TD></tr>";
	}
}
?>
		
</table
<!-- -->
</form>

</div>


<?
if ($punicao) {
	formulario::values($punicao);
}
?>
