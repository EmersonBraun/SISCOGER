<script language='javascript'>
function confirmar() {
	if (window.confirm("Tem certeza?")) return true;
	else return false;
}

function validar(form) {
	//Gradacao
	campo=document.getElementsByName('denunciacivil[id_gradacao]')[0];
	if (campo.value=="") {
		window.alert("Preencha a grada&ccedil;&atilde;o!"); campo.focus(); return false;
	}
	//Classificacao
	campo=document.getElementsByName('denunciacivil[id_classdenunciacivil]')[0];
	if (campo.value=="") {
		window.alert("Preencha a classifica&ccedil;&atilde;o!"); campo.focus(); return false;
	}
	//Classificacao
	campo=document.getElementsByName('denunciacivil[cdopm]')[0];
	if (campo.value=="") {
		window.alert("Preencha a OPM da denunciacivil!"); campo.focus(); return false;
	}
return true;
}

</script>

<?php
$secao = substr ($_SESSION[usuario]->opm->codigo, 1 , 4); //para ver se é da SAI

if ($user['nivel']==6 || ($user['nivel']==7 && $secao!=='2003')) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

//Regras de negocio aqui
//Exemplo: data de hoje, controle de niveis, etc

if (!$denunciacivil->rg) $denunciacivil->rg=$_REQUEST['rg'];
if (!$denunciacivil->data) $denunciacivil->data=date("d/m/Y");
if (!$denunciacivil->rg_cadastro) $denunciacivil->rg_cadastro=$usuario->rg;

if (!$denunciacivil->rg) die("<h3>RG invalido</h3>");
$policial=new policial($denunciacivil->rg);
if (!$denunciacivil->cargo) $denunciacivil->cargo=$policial->cargo;
if (!$denunciacivil->nome) $denunciacivil->nome=$policial->nome;

?>

<form id="denunciacivil" class="controlar-modificacao" name="denunciacivil" onsubmit='return validar(this)' action="?module=denunciacivil&noheader" method="POST" enctype="multipart/form-data">

<!-- campo obrigatorio, nao delete -->
<input type=hidden name=denunciacivil[id_denunciacivil]>

<!--
<input type=hidden name=denunciacivil[data]>
-->

<input type=hidden name=denunciacivil[rg_cadastro]>

<div class='bordasimples'>

<?php

//lock = variavel que trava os campos de referencia, pois a pessoa esta cadastrando diretamente do fatd
if (isset($_REQUEST['lock'])) $lock=" readonly "; else $lock="";

//pre($denunciacivil);
openTable("width='100%' bgcolor='#FFFFFF'");
openLine();
	echo "<h2>Formulario para cadastro de denunciacivil</h2>";
closeLine();

form::openTR();
	form::openTD("colspan='3'");
		form::openLabel("Policial");
		echo "RG: <input type='text' size='12' maxlength='25' readonly name='denunciacivil[rg]'>";
		echo "RG: <input type='text' size='6' maxlength='10' readonly name='denunciacivil[cargo]'>";
		echo "RG: <input type='text' size='40' readonly name='denunciacivil[nome]'>";
		form::closeLabel();
	form::closeTD();
form::closeTR();

openTR();
	openTD("colspan='3'");
		form::openLabel("OPM");
		echo $policial->opm->descricao;
		form::closeLabel();
	closeTD();
closeTR();

openTR();
	openTD("colspan='3'");
		$opcoes="size='60' maxlength='200' $opcaoGeral2";
		form::input("Processo, N&ordm; do processo - Comarca. (<b>Ex: A&ccedil;&atilde;o Penal Militar n&ordm; 2010.0000XXX-X - Curitiba</b>)","denunciacivil[processo]");
	closeTD();
closeTR();
openTR();
	openTD("colspan='3'");
		$opcoes="size=60";
		form::input("Infra&ccedil;&atilde;o da den&uacute;ncia - Artigo, Lei e Infra&ccedil;&atilde;o Penal (<b>Ex: Art. 121, C&oacute;digo Penal, Homic&iacute;dio)</b>","denunciacivil[infracao]");
	closeTD();
closeTR();

openTR();
		openTD();
			form::openLabel("Processo Crime");
			echo "<select name='denunciacivil[processocrime]' $opcaoGeral2>";
				echo "<option value=''>Selecione</option>";
				echo "<option value='Denunciado'>Denunciado</option>";
				echo "<option value='Arquivado'>Arquivado</option>";

			echo "</select>";
			form::closeLabel();
		closeTD();
		
		openTD("colspan='2'");
			form::openLabel("Julgamento");
				echo "<select name='denunciacivil[julgamento]' $opcaoGeral2>";
					echo "<option rel='none' value=''>Selecione</option>";
					echo "<option rel='foicondenado' value='Condenado'>Condenado</option>";
					echo "<option rel='none' value='Absolvido'>Absolvido</option>";
				echo "</select>\r\n";
				echo "<input type='checkbox' name='denunciacivil[transitojulgado_bl]' $opcaoGeral2>Transitou em julgado";
			form::closeLabel();
		closeTD();
closeTR();


		closeTR();
		
		openTR("rel='foicondenado$i'");
		openTD();
			form::openLabel("Pena");
				echo "<input size='2' onkeypress='return dntr(this,event)' type='text' name='denunciacivil[pena_anos]' $opcaoGeral2>anos ";
				echo "<input size='2' onkeypress='return dntr(this,event)' type='text' name='denunciacivil[pena_meses]' $opcaoGeral2> meses";
				echo "<input size='2' onkeypress='return dntr(this,event)' type='text' name='denunciacivil[pena_dias]' $opcaoGeral2> dias";
			
			form::closeLabel();
		closeTD();
		openTD();
			form::openLabel("Tipo da pena");
				echo "<select name='denunciacivil[tipodapena]' $opcaoGeral2>";
					echo "<option value=''>Selecione</option>";
					echo "<option value='Detencao'>Deten&ccedil;&atilde;o</option>";
					echo "<option value='Reclusao'>Reclus&atilde;o</option>";
				echo "</select>\r\n";
			form::closeLabel();
		closeTD();
		openTD();
			form::openLabel("Restritiva de direito?");
				echo "<input type='checkbox' name='denunciacivil[restritiva_bl]' $opcaoGeral2>";
			form::closeLabel();
		closeTD();
	closeTR();
	openTR();
		openTD("colspan='3'");
			form::input("Observa&ccedil;&otilde;es (Artigo da senten&ccedil;a da condena&ccedil;&atilde;o, data da den&uacute;ncia, data do tr&acirc;nsito em julgado e outros complementos)<br><b>Exemplo: Lei N. 9455/97 - TORTURA. par. 1, inciso I, alinea a. Data da denuncia: xx/xx/xx, transitou em julgado em xx/xx/xx</b>","denunciacivil[obs_txt]");
		closeTD();
	closeTR();

if (!$opcaoGeral2) {
	echo "<tr><td><input type='submit' name='acao' value='".ucwords($opcao)."'>&nbsp;";

	if ($opcao=="atualizar" and $user['nivel']>=5) {
		echo "<input type='submit' name='acao' value='Apagar' onclick='return confirmar();'></TD></tr>";
	}
}
?>
		
</table>
<!-- -->
</form>

</div>


<?
if ($denunciacivil) {
	formulario::values($denunciacivil);
}
?>
