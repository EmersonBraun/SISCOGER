<script language='javascript'>
function confirmar() {
	if (window.confirm("Tem certeza?")) return true;
	else return false;
}
</script>

<?php
//Regras de negocio aqui
//Exemplo: data de hoje, controle de niveis, etc

if (!$sai->sjd_ref_ano) $sai->sjd_ref_ano=$_SESSION[sjd_ano];
if (!$sai->rg) $sai->rg=$_REQUEST['rg'];
//if (!$sai->data) $sai->data=date("d/m/Y");
if (!$sai->rg_cadastro) $sai->rg_cadastro=$usuario->rg;
if (!$sai->cdopm) $sai->cdopm=$usuario->opm->codigoBase;
if (!$sai->opm_abreviatura) $sai->opm_abreviatura=$usuario->opm->abreviatura;
if (!$sai->digitador) $sai->digitador=$usuario->nome;

//if (!$sai->rg) die("<h3>RG invalido</h3>");
$policial=new policial($sai->rg);
if (!$sai->cargo) $sai->cargo=$policial->cargo;
if (!$sai->nome) $sai->nome=$policial->nome;

//Cria resultados SQL com os ofendidos,envolvidos, viaturas e documentos ligados ao SAI
if ($opcao=="atualizar") {

	$sql="SELECT * FROM envolvido WHERE situacao='Denunciado' AND id_sai='".$sai->id_sai."'";
	if ($_SESSION[debug]) echo $sql;
	$resI=mysql_query($sql);
	if ($resI) $indiciados=mysql_num_rows($resI);

	$sql="SELECT * FROM ofendido WHERE id_sai='".$sai->id_sai."'";
	if ($_SESSION[debug]) echo $sql;
	$resO=mysql_query($sql);
	if ($resO) $ofendidos=mysql_num_rows($resO);


//ligacoes
$sqlL="SELECT * FROM ligacao WHERE destino_proc='sai' AND id_sai=".$sai->id_sai."";
$resL=mysql_query($sqlL);
$ligacoes=mysql_num_rows($resL);
//pre($sqlL);
}

if (!$ofendidos) $ofendidos=0;
if (!$indiciados) $indiciados=1;
?>

<form id="sai" class="controlar-modificacao" name="sai" action="index.php?module=sai" method="POST" enctype="multipart/form-data">

<!-- campo obrigatorio, nao delete -->
<input type=hidden name=sai[id_sai]>
<input type="hidden" name="sai[sjd_ref]">
<input type="hidden" name="sai[sjd_ref_ano]">
<!--sai
<input type=hidden name=sai[rg]>
<input type=hidden name=sai[cargo]>
<input type=hidden name=sai[nome]>
-->

<input type=hidden name=sai[rg_cadastro]>
<input type=hidden name=sai[cdopm]>
<input type=hidden name=sai[opm_abreviatura]>

<div class='bordasimples'>

<?php if ($opcao=="cadastrar"){?><center><h1>Novo registro SAI</h1></center><?}?>
<?php if ($opcao=="atualizar"){?><center><h1>Registro SAI</h1></center><?}?>

<table class='bordasimples' width='100%'>
	<?if ($opcao=="cadastrar"){?>
	<tr>
		<th colspan="5" bgcolor="#DBEAF5">
			<font face="tahoma, verdana" size="2">Formul&aacute;rio para cadastro SAI</font>
		</th>
	</tr>
	<?php } ?>

	<?php if ($opcao=="atualizar"){?>
	<tr>
		<td align="center" colspan="3" bgcolor="#DBEAF5">
		Visualiza&ccedil;&atilde;o e atualiza&ccedil;&atilde;o | 
		<a href="?module=movimento&movimento[id_sai]=<?=$sai->id_sai;?>">Movimentos</a> |
		<a href="?module=sobrestamento&sobrestamento[id_sai]=<?=$sai->id_sai;?>">Sobrestamentos</a>
		</td>
	</tr>
	<?}?>
</tr>
<?php
//pre($sai);
//var_dump($sai);
form::openTR();
	form::openTD("width='50%' colspan=1");
		form::openLabel("Andamento SAI");
			formulario::option("sai","andamento","WHERE procedimento='sai'","",0,0);
		form::closeLabel();
	form::closeTD();
	openTD("colspan='2'");
		form::openLabel("Andamento COGER");
			formulario::option("sai","andamentocoger","WHERE procedimento='sai'","",0,0);
		form::closeLabel();		
	closeTD();
form::closeTR();

form::openTR("width='100%'");
	form::openTD("width='33%'");
		form::input("Data do fato","sai[data]");
	form::closeTD();

	form::openTD("width='33%'");
		form::openLabel("OPM (Local do fato)");
		echo "<select id='foco' name='sai[cdopm_fato]' $opcaoGeral2>";
			include ("includes/option_opm.php");
		echo "</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD("width='33%'");
		form::openLabel("OPM (Apura&ccedil;&atilde;o)");
		echo "<select id='foco' name='sai[cdopm_controle]' $opcaoGeral2>";
			include ("includes/option_opm.php");
		echo "</select>";
		form::closeLabel();
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='3'");
		form::input("Data da abertura","sai[abertura_data]");
	form::closeTD();
form::closeTR();

openTR("width='100%'");
	
	openTD("width='33%'");
		form::openLabel("Cidade do fato");
			formulario::option("sai","municipio","","","",0);
		form::closeLabel();
	closeTD();
	openTD("width='33%'");
		form::input("Bairro","sai[bairro]");
	closeTD();
	openTD("width='33%'");
		form::input("Logradouro","sai[logradouro]");
	closeTD();
closeTR();

	
openTR();
	openTD("width='33%'");
		form::openLabel("BOU (Boletim de Ocorr&ecirc;ncia Unificado)");
			echo "Ano: ";			
			echo "<select name='sai[bou_ano]'>\r\n";
				for ($i=2005;$i<=date("Y");$i++) {
					echo "<option>$i</option>";
				}
			echo "</select>  N&ordm;";
			echo "<input name='sai[bou_numero]' type='text' size='7' maxlength='7' onkeypress='return dntr(this, event);'>";
		form::closeLabel();
	closeTD();
	  Informação.
	form::openTD("width='33%'");
		//$opcoes="readonly";
		$textoForm="<select name=sai[docorigem] $opcaoGeral2>
		<option value='-'>-</option>
		<option value='audiencia de custodia'>Audi&ecirc;ncia de cust&oacute;dia</option>
		<option value='direto'>Direto</option>
		<option value='e-mail'>E-mail</option>
		<option value='informacao'>Informa&ccedil;&atilde;o</option>
		<option value='noticia de fato'>Not&iacute;cia de fato</option>
		<option value='pedido de providencia'>Pedido de provid&ecirc;ncia</option>
		<option value='termo'>Termo</option>
		<option value='0800'>0800</option>
		<option value='181'>181</option>
		<option value='CI'>CI</option>
		<option value='EI'>EI</option>
		<option value='MP'>MP</option>
		<option value='PM'>PM</option>
		<option value='PID'>PID</option>
		<option value='PJM'>PJM</option>
		<option value='PB'>PB</option>
		<option value='RI'>RI</option>
		<option value='SPPA'>SPPA</option>
		<option value='outros'>Outros</option>
		</select>";
		form::input("Doc. Origem","",$textoForm);
	closeTD();
	openTD("width='33%'");
		form::input("N&ordm; Documento, ou descri&ccedil;&atilde;o outros documentos","sai[numerodoc]");
	closeTD();

closeTR();
	

openTR();
	form::openTD();
		//$opcoes="readonly";
		$textoForm="<select name=sai[motivo_principal] $opcaoGeral2>
		<option value='-'>-</option>
		<option value='corrupcao'>Corrup&ccedil;&atilde;o</option>
		<option value='prevaricacao'>Prevarica&ccedil;&atilde;o</option>
		<option value='abuso de autoridade'>Abuso de autoridade</option>
		<option value='tortura'>Tortura</option>
		<option value='lesao corporal'>Les&atilde;o corporal</option>
		<option value='homicidio'>Homic&iacute;dio</option>
		<option value='trafico de drogas'>Tr&aacute;fico de drogas</option>
		<option value='uso de entorpecente'>Uso de entorpecente</option>
		<option value='improbidade administrativa'>Improbiedade administrativa</option>
		<option value='servico (bico)'>Servi&ccedil;o (Bico)</option>
		<option value='roubo / furto'>Roubo / Furto</option>
		<option value='caixa eletronico'>Caixa eletr&ocirc;nico</option>
		<option value='lei maria da penha'>Lei Maria da Penha</option>
		<option value='abordagem'>Abordagem</option>
		<option value='outros'>Outros</option>
		</select>";
		form::input("Motivo principal","",$textoForm);
	closeTD();
	form::openTD();
		//$opcoes="readonly";
		$textoForm="<select name=sai[motivo_secundario] $opcaoGeral2>
		<option value='-'>-</option>
		<option value='corrupcao'>Corrup&ccedil;&atilde;o</option>
		<option value='prevaricacao'>Prevarica&ccedil;&atilde;o</option>
		<option value='abuso de autoridade'>Abuso de autoridade</option>
		<option value='tortura'>Tortura</option>
		<option value='lesao corporal'>Les&atilde;o corporal</option>
		<option value='homicidio'>Homic&iacute;dio</option>
		<option value='trafico de drogas'>Tr&aacute;fico de drogas</option>
		<option value='uso de entorpecente'>Uso de entorpecente</option>
		<option value='improbidade administrativa'>Improbiedade administrativa</option>
		<option value='servico (bico)'>Servi&ccedil;o (Bico)</option>
		<option value='roubo / furto'>Roubo / Furto</option>
		<option value='caixa eletronico'>Caixa eletr&ocirc;nico</option>
		<option value='lei maria da penha'>Lei Maria da Penha</option>
		<option value='abordagem'>Abordagem</option>
		<option value='outros'>Outros</option>
		</select>";
		form::input("Motivo secund&aacute;rio","",$textoForm);
	closeTD();
	form::openTD();
		//$opcoes="readonly";
		form::input("Descri&ccedil;&atilde;o outros motivos","sai[desc_outros]");
	closeTD();
closeTR();

form::openTR();
	form::openTD("colspan='3'");
		form::input("S&iacute;ntese","sai[sintese_txt]");
	form::closeTD();
form::closeTR();


/*form::openTR();
	form::openTD("colspan='1'");
		form::input("Nome relat&oacute;rio","sai[sintese]");
	form::closeTD();
	form::openTD("colspan='2'");
		form::input("","sai[relatorio_file]");
	form::closeTD();
form::closeTR();*/
//formEnvolvido($viaturaenvolvida, "Viaturas envolvidas","viaturaenvolvida",false);
//formEnvolvido($envolvido, "Policiais envolvidos","envolvido",false);
//formEnvolvido($ofendido, "V&iacute;timas/Denunciantes/Testemunhas","ofendido",false);
//formEnvolvido($saidocumentos, "Documentos juntados","saidocumentos",false);

form::openTR();
	form::openTD("colspan='1' width='50%'");
		form::input("Placa da viatura (sem tra&ccedil;o)","sai[vtr1_placa]");
	form::closeTD();
	form::openTD("colspan='2' width='50%'");
		form::input("Prefixo da viatura","sai[vtr1_prefixo]");
	form::closeTD();
form::closeTR();
form::openTR();
	form::openTD("colspan='1' width='50%'");
		form::input("Placa da viatura (sem tra&ccedil;o)","sai[vtr2_placa]");
	form::closeTD();
	form::openTD("colspan='2' width='50%'");
		form::input("Prefixo da viatura","sai[vtr2_prefixo]");
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
		form::input("Documento juntado","sai[relatorio1_file]");
	form::closeTD();
	form::openTD("colspan='1' width='33%'");
		form::input("Nome documento","sai[relatorio1]");
	form::closeTD();
	form::openTD("colspan='1' width='33%'");
		form::input("Data do documento","sai[relatorio1_data]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='1' width='33%'");
		form::input("Documento juntado","sai[relatorio2_file]");
	form::closeTD();
	form::openTD("colspan='1' width='33%'");
		form::input("Nome documento","sai[relatorio2]");
	form::closeTD();
	form::openTD("colspan='1' width='33%'");
		form::input("Data do documento","sai[relatorio2_data]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='1' width='33%'");
		form::input("Documento juntado","sai[relatorio3_file]");
	form::closeTD();
	form::openTD("colspan='1' width='33%'");
		form::input("Nome documento","sai[relatorio3]");
	form::closeTD();
	form::openTD("colspan='1' width='33%'");
		form::input("Data do documento","sai[relatorio3_data]");
	form::closeTD();
form::closeTR();

form::openTR();
	openTD();
		//$opcoes="readonly";
		$opcoes="size='40'";
		form::input("Digitador","sai[digitador]");
	closeTD();

	/*openTD();
		//$opcoes="readonly";
		$textoForm="<select name=sai[destino] $opcaoGeral2>
		<option value='-'>-</option>
		<option value='arquivo'>Arquivo</option>
		<option value='operacoes'>Opera&ccedil;&otilde;es</option>
		<option value='analise'>An&aacute;lise</option>
		<option value='pesquisa'>Pesquisa</option>
		<option value='cai'>CAI</option>
		<option value='chefe sai'>Chefe SAI</option>
		<option value='sub chefe sai'>Sub Chefe SAI</option>
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
if ($sai) {
	formulario::values($sai);
	if ($opcao=="atualizar") {
		//$envolvido=new envolvido("WHERE situacao='Denunciado' AND id_sai='".$sai->id_sai."'","","simples");
		//$ofendido=new ofendido("WHERE situacao='Ofendido' AND id_sai='".$sai->id_sai."'","","simples");

		
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
