<?php
//Regras de negocio aqui
//Exemplo: data de hoje, controle de niveis, etc

if (!$proc_outros->sjd_ref_ano) $proc_outros->sjd_ref_ano=$_SESSION[sjd_ano];
if (!$proc_outros->rg) $proc_outros->rg=$_REQUEST['rg'];
if (!$proc_outros->abertura_data) $proc_outros->abertura_data=date("d/m/Y");
if (!$proc_outros->data) $proc_outros->data=date("d/m/Y");
if (!$proc_outros->rg_cadastro) $proc_outros->rg_cadastro=$usuario->rg;
if (!$proc_outros->cdopm) $proc_outros->cdopm=$usuario->opm->codigo;
if (!$proc_outros->opm_abreviatura) $proc_outros->opm_abreviatura=$usuario->opm->abreviatura;
if (!$proc_outros->digitador) $proc_outros->digitador=$usuario->nome;

//if (!$proc_outros->rg) die("<h3>RG invalido</h3>");
$policial=new policial($proc_outros->rg);
if (!$proc_outros->cargo) $proc_outros->cargo=$policial->cargo;
if (!$proc_outros->nome) $proc_outros->nome=$policial->nome;

//Cria resultados SQL com os ofendidos,envolvidos, viaturas e documentos ligados ao proc_outros
if ($opcao=="atualizar") {

	$sql="SELECT * FROM envolvido WHERE id_proc_outros='".$proc_outros->id_proc_outros."'";
	if ($_SESSION[debug]) echo $sql;
	$resI=mysql_query($sql);
	if ($resI) $indiciados=mysql_num_rows($resI);

	$sql="SELECT * FROM ofendido WHERE id_proc_outros='".$proc_outros->id_proc_outros."'";
	if ($_SESSION[debug]) echo $sql;
	$resO=mysql_query($sql);
	if ($resO) $ofendidos=mysql_num_rows($resO);


//ligacoes
$sqlL="SELECT * FROM ligacao WHERE destino_proc='proc_outros' AND id_proc_outros=".$proc_outros->id_proc_outros."";
$resL=mysql_query($sqlL);
$ligacoes=mysql_num_rows($resL);
//pre($sqlL);
}

if (!$ofendidos) $ofendidos=0;
if (!$indiciados) $indiciados=1;
?>

<script language=javascript>
function validar(form) {
	campo=document.getElementsByName('proc_outros[andamento]')[0];
	if (campo.length<=0) {
		window.alert("Preencha o andamento!"); campo.focus(); return false;
	}
	campo=document.getElementsByName('proc_outros[cdopm]')[0];
	if (campo.length<=0) {
		window.alert("Preencha a OPM!"); campo.focus(); return false;
	}
	campo=document.getElementsByName('proc_outros[abertura_data]')[0];
	if (campo.length<=0) {
		window.alert("Preencha a Data do fato!"); campo.focus(); return false;
	}
	campo=document.getElementsByName('proc_outros[motivo_abertura]')[0];
	if (campo.length<=0) {
		window.alert("Preencha o motivo da abertura!"); campo.focus(); return false;
	}
	/*campo=document.getElementsByName('proc_outros[cdopm]')[0];
	if (campo.value=="") {
		window.alert("Preencha a OPM!"); campo.focus(); return false;
	}*/
function confirmar() {
	if (window.confirm("Tem certeza?")) return true;
	else return false;
}
</script>

<form id="proc_outros" class="controlar-modificacao" name="proc_outros" action="index.php?module=proc_outros" method="POST" onSubmit="return validar(this);" enctype="multipart/form-data">

<!-- campo obrigatorio, nao delete -->
<input type=hidden name="proc_outros[id_proc_outros]">
<input type="hidden" name="proc_outros[sjd_ref]">
<input type="hidden" name="proc_outros[sjd_ref_ano]">
<!--proc_outros
<input type=hidden name=proc_outros[rg]>
<input type=hidden name=proc_outros[cargo]>
<input type=hidden name=proc_outros[nome]>
-->

<input type=hidden name=proc_outros[rg_cadastro]>
<input type=hidden name=proc_outros[cdopm]>
<input type=hidden name=proc_outros[opm_abreviatura]>

<div class='bordasimples'>

<?php if ($opcao=="cadastrar"){?><center><h1>Novo registro Procededimento Outros</h1></center><?}?>
<?php if ($opcao=="atualizar"){?><center><h1>Registro Procededimento Outros</h1></center><?}?>

<table class='bordasimples' width='100%'>
	<?if ($opcao=="cadastrar"){?>
	<tr>
		<th colspan="5" bgcolor="#DBEAF5">
			<font face="tahoma, verdana" size="2">Formul&aacute;rio para cadastro Procededimento Outros</font>
		</th>
	</tr>
	<?php } ?>

	<?php if ($opcao=="atualizar"){?>
	<tr>
		<td align="center" colspan="3" bgcolor="#DBEAF5">
		Visualiza&ccedil;&atilde;o e atualiza&ccedil;&atilde;o | 
		<a href="?module=movimento&movimento[id_proc_outros]=<?=$proc_outros->id_proc_outros;?>">Movimentos</a>
		<?if ($user['nivel']==4 || $user['nivel']==5){?>
		| <a href="?module=arquivo&arquivo[id_proc_outros]=<?=$proc_outros->id_proc_outros;?>">Arquivo</a>
		<?}?>
		<!--<a href="?module=sobrestamento&sobrestamento[id_proc_outros]=<?=$proc_outros->id_proc_outros;?>">Sobrestamentos</a>-->
		</td>
	</tr>
	<?}?>
</tr>
<?php
//pre($proc_outros);
//var_dump($proc_outros);
form::openTR();
	form::openTD("width='33%'");
		//$opcoes="readonly";
		$textoForm="<select required name=proc_outros[andamento]>
		<option value=''></option>
		<option value='abertura'>Abertura</option>
		<option value='em andamento'>Em andamento</option>
		<option value='concluido'>Conclu&iacute;do</option>
		</select>";
		form::input("Andamento","",$textoForm);
	closeTD();
	form::openTD("width='33%' ");
		//$opcoes="readonly";
		$textoForm="<select required name=proc_outros[andamentocoger]>
		<option value=''></option>
		<option value='unidade'>Unidade</option>
		<option value='arquivo'>Arquivo</option>
		<option value='COGER'>COGER</option>
		<option value='poder judiciario'>Poder Judici&aacute;rio</option>
		<option value='ministerio publico'>Minist&eacute;rio P&uacute;blico</option>
		<option value='outros orgaos'>Outros Org&atilde;os</option>
		</select>";
		form::input("Andamento COGER","",$textoForm);
	closeTD();
	form::openTD("width='33%' ");
		form::input("N&deg; PID","proc_outros[num_pid]");
	form::closeTD();
form::closeTR();

form::openTR("width='100%'");
	
	form::openTD("width='33%' ");
		form::input("Data do fato","proc_outros[data]");
	form::closeTD();
	form::openTD("width='33%' ");
		form::input("Data de recebimento","proc_outros[abertura_data]");
	form::closeTD();
	form::openTD("width='33%' ");
		form::input("Data limite","proc_outros[limite_data]");
	form::closeTD();
form::closeTR();


openTR("width='100%'");	
	form::openTD("width='33%'");
		form::openLabel("OPM (Apura&ccedil;&atilde;o)");
		echo "<select id='foco' name='proc_outros[cdopm_apuracao]' $opcaoGeral2>";
			include ("includes/option_opm.php");
		echo "</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD("width='33%'");
		//$opcoes="readonly";
		$textoForm="<select name=proc_outros[doc_origem] $opcaoGeral2>
		<option value=''></option>
		<option value='audiencia de custodia'>Audi&ecirc;ncia de cust&oacute;dia</option>
		<option value='noticia de fato'>Not&iacute;cia de fato</option>
		<option value='pedido de providencia'>Pedido de provid&ecirc;ncia</option>
		<option value='outros'>Outros</option>
		</select>";
		form::input("Doc. Origem","",$textoForm);
	closeTD();
	openTD("width='33%'");
		form::input("N&ordm; Documento, ou descri&ccedil;&atilde;o outros documentos","proc_outros[num_doc_origem]");
	closeTD();
closeTR();
	

openTR();
	form::openTD("width='33%'");
		//$opcoes="readonly";
		$textoForm="<select name=proc_outros[motivo_abertura] $opcaoGeral2>
		<option value=''></option>
		<option value='abordagem'>Abordagem</option>
		<option value='abuso de autoridade'>Abuso de autoridade</option>
		<option value='caixa eletronico'>Caixa eletr&ocirc;nico</option>
		<option value='corrupcao'>Corrup&ccedil;&atilde;o</option>
		<option value='crimes sexuais'>Crimes sexuais</option>
		<option value='discriminacao racial'>Discrimina&ccedil;&atilde;o racial</option>
		<option value='estatuto do desarmamento'>Estatuto do desarmamento</option>
		<option value='estelionato'>Estelionato</option>
		<option value='extorsao'>Extors&atilde;o</option>
		<option value='homicidio'>Homic&iacute;dio</option>
		<option value='improbidade administrativa'>Improbiedade administrativa</option>
		<option value='lei maria da penha'>Lei Maria da Penha</option>
		<option value='lesao corporal'>Les&atilde;o corporal</option>				
		<option value='prevaricacao'>Prevarica&ccedil;&atilde;o</option>
		<option value='roubo / furto'>Roubo / Furto</option>
		<option value='servico (bico)'>Servi&ccedil;o (Bico)</option>			
		<option value='tortura'>Tortura</option>
		<option value='trafico de drogas'>Tr&aacute;fico de drogas</option>
		<option value='uso de entorpecente'>Uso de entorpecente</option>
		<option value='outros'>Outros</option>
		</select>";
		form::input("Motivo Abertura","",$textoForm);
	closeTD();
	form::openTD("width='33%'");
		//$opcoes="readonly";
		form::input("Descri&ccedil;&atilde;o outros motivos","proc_outros[desc_outros]");
	closeTD();
		openTD("width='33%'");
		form::openLabel("Cidade do fato");
			formulario::option("proc_outros","municipio","","","",0);
		form::closeLabel();
	closeTD();
closeTR();

form::openTR();
	form::openTD("colspan='3'");
		form::input("S&iacute;ntese","proc_outros[sintese_txt]");
	form::closeTD();
form::closeTR();

form::openTR();
	openTD("colspan='3'");
		form::openLabel("BOU (Boletim de Ocorr&ecirc;ncia Unificado)");
			echo "Ano: ";			
			echo "<select name='proc_outros[bou_ano]'>\r\n";
				for ($i=2005;$i<=date("Y");$i++) {
					echo "<option>$i</option>";
				}
			echo "</select>  N&ordm;";
			echo "<input name='proc_outros[bou_numero]' type='text' size='7' maxlength='7' onkeypress='return dntr(this, event);'>";
		form::closeLabel();	
	closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='1' width='50%'");
		form::input("Placa da viatura (sem tra&ccedil;o)","proc_outros[vtr1_placa]");
	form::closeTD();
	form::openTD("colspan='2' width='50%'");
		form::input("Prefixo da viatura","proc_outros[vtr1_prefixo]");
	form::closeTD();
form::closeTR();
form::openTR();
	form::openTD("colspan='1' width='50%'");
		form::input("Placa da viatura (sem tra&ccedil;o)","proc_outros[vtr2_placa]");
	form::closeTD();
	form::openTD("colspan='2' width='50%'");
		form::input("Prefixo da viatura","proc_outros[vtr2_prefixo]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan=3");
		formulario::subform("envolvido",$indiciados,"Policiais envolvidos");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan=3");
		$indice=1;
		formulario::subform("ofendido",$ofendidos,"V&iacute;timas/Denunciantes/Testemunhas");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='1' width='33%'");
		form::input("Documento juntado","proc_outros[relatorio1_file]");
	form::closeTD();
	form::openTD("colspan='1' width='33%'");
		form::input("Nome documento","proc_outros[relatorio1]");
	form::closeTD();
	form::openTD("colspan='1' width='33%'");
		form::input("Data do documento","proc_outros[relatorio1_data]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='1' width='33%'");
		form::input("Documento juntado","proc_outros[relatorio2_file]");
	form::closeTD();
	form::openTD("colspan='1' width='33%'");
		form::input("Nome documento","proc_outros[relatorio2]");
	form::closeTD();
	form::openTD("colspan='1' width='33%'");
		form::input("Data do documento","proc_outros[relatorio2_data]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='1' width='33%'");
		form::input("Documento juntado","proc_outros[relatorio3_file]");
	form::closeTD();
	form::openTD("colspan='1' width='33%'");
		form::input("Nome documento","proc_outros[relatorio3]");
	form::closeTD();
	form::openTD("colspan='1' width='33%'");
		form::input("Data do documento","proc_outros[relatorio3_data]");
	form::closeTD();
form::closeTR();

form::openTR();
	openTD("colspan='3'");
		//$opcoes="readonly";
		$opcoes="size='40'";
		form::input("Digitador","proc_outros[digitador]");
	closeTD();

	/*openTD();
		//$opcoes="readonly";
		$textoForm="<select name=proc_outros[destino] $opcaoGeral2>
		<option value='-'>-</option>
		<option value='arquivo'>Arquivo</option>
		<option value='operacoes'>Opera&ccedil;&otilde;es</option>
		<option value='analise'>An&aacute;lise</option>
		<option value='pesquisa'>Pesquisa</option>
		<option value='cai'>CAI</option>
		<option value='chefe proc_outros'>Chefe proc_outros</option>
		<option value='sub chefe proc_outros'>Sub Chefe proc_outros</option>
		<option value='sargenteacao'>Sargentea&ccedil;&atilde;o</option>
		<option value='unidade'>Unidade</option>
		</select>";
		form::input("Destino dos documentos","",$textoForm);
	closeTD();*/
form::closeTR();

form::openTR();
	form::openTD("colspan=3");
		$indice=0;
		if ($_SESSION['debug'])  {
			pre($sql);
			pre("Procedimentos resultantes: $total");
		}
		formulario::subform("ligacao",$ligacoes,"Procedimento resultante (apenas se houver)");
		form::closeTD();
form::closeTR();


form::openTR();
	form::openTD("colspan=3");
	echo "<input type='submit' name='acao' value='".ucwords($opcao)."'>&nbsp;";
	
	if ($opcao=="atualizar") {
		echo "<input type='submit' name='acao' value='Apagar' onclick='return confirmar();'>";
	}
	form::closeTD();
form::closeTR();
closeTable();
?>

</td></tr></table>
<!-- Fim detalhes -->

</form>

</div>

<?
if ($proc_outros) {
	formulario::values($proc_outros);
	if ($opcao=="atualizar") {
		//$envolvido=new envolvido("WHERE situacao='Denunciado' AND id_proc_outros='".$proc_outros->id_proc_outros."'","","simples");
		//$ofendido=new ofendido("WHERE situacao='Ofendido' AND id_proc_outros='".$proc_outros->id_proc_outros."'","","simples");

		
		formulario::values($vetorEnvolvidos,"envolvido");
		formulario::values($vetorOfendidos,"ofendido");

	}

	$i=1;
	while  ($row=@mysql_fetch_assoc($resI)) {
		formulario::values($row,"envolvido[$i]");
		$i++;
	}

	$i=1;
	while  ($row=@mysql_fetch_assoc($resO)) {
		formulario::values($row,"ofendido[$i]");
		$i++;
	}


	if ($ligacoes) {
		$i=1;
		while ($rowL=mysql_fetch_assoc($resL)) {
			formulario::values($rowL,"ligacao[$i]");
			$i++;
		}
	}
	
}
?>
