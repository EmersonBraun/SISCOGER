<?php
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

if (!$fatd->sjd_ref_ano) $fatd->sjd_ref_ano=$_SESSION[sjd_ano];

if ($fatd->andamento->id_andamento==2 and $user['nivel']<4) $opcaoGeral="readonly";

if ($opcao=="atualizar") {
$sql="SELECT * FROM envolvido WHERE situacao='Acusado' AND id_fatd='".$fatd->id_fatd."'";
$resI=mysql_query($sql);
if ($resI) $indiciados=mysql_num_rows($resI);

$sql="SELECT * FROM ofendido WHERE situacao='Ofendido' AND id_fatd='".$fatd->id_fatd."'";
$resO=mysql_query($sql);
if ($resO) $ofendidos=mysql_num_rows($resO);

//ligacoes
	$sqlL="SELECT * FROM ligacao WHERE destino_proc='fatd' AND destino_sjd_ref='".$fatd->sjd_ref."' AND destino_sjd_ref_ano='".$fatd->sjd_ref_ano."'";
	$resL=mysql_query($sqlL);
	$ligacoes=mysql_num_rows($resL);
}

if (!$ofendidos) $ofendidos=0;
if (!$indiciados) $indiciados=1;


?>

<script language=javascript>
function validar(form) {
	//ANDAMENTO
	campo=document.getElementsByName('fatd[id_andamento]')[0];
	if (campo.value=="") {
		window.alert("Preencha o andamento!"); campo.focus(); return false;
	}
	//SE ESTIVER CONCLUIDO
	campo=document.getElementsByName('fatd[id_andamento]')[0];
	if (campo.value=="2") { //CONCLUIDO
		//ENCARREGADO
		campo=document.getElementsByName('envolvido[encarregado][rg]')[0];
		if (campo.value=="") {
			window.alert("Preencha o encarregado!"); campo.focus(); return false;
		}
		//ACUSADO
		campo=document.getElementsByName('envolvido[1][rg]')[0];
		if (campo.value=="") {
			window.alert("Preencha o acusado!"); campo.focus(); return false;
		}
		//DATA DE ABERTURA
		campo=document.getElementsByName('fatd[abertura_data]')[0];
		if (campo.value=="") {
			window.alert("Preencha a data de abertura!"); campo.focus(); return false;
		}
		//DATA DO FATO
		campo=document.getElementsByName('fatd[fato_data]')[0];
		if (campo.value=="") {
			window.alert("Preencha a data do fato!"); campo.focus(); return false;
		}
		//motivo
		/*	campo=document.getElementsByName('fatd[motivo_fatd]')[0];
		if (campo.value=="") {
			window.alert("Preencha o Motivo!"); campo.focus(); return false;
		}*/
		//fato_file
		if (isdefined(document.getElementsByName('fato_file')[0])) {
			campo=document.getElementsByName('fato_file')[0];
			if (campo.value=="") {
				window.alert("Faltou o PDF do Relato do fato imputado!"); campo.focus(); return false;
			}
		}
		//relatorio_file
		if (isdefined(document.getElementsByName('relatorio_file')[0])) {
			campo=document.getElementsByName('relatorio_file')[0];
			if (campo.value=="") {
				window.alert("Faltou o Relatorio do Encarregado!"); campo.focus(); return false;
			}
		}
		//solcmt

		if (isdefined(document.getElementsByName('fatd[sol_cmt_file]')[0])) {
			campo=document.getElementsByName('fatd[sol_cmt_file]')[0];
			campoopm=document.getElementsByName('fatd[cdopm]')[0];
			if (campo.value=="" && campoopm.value!="0") {
				window.alert("Para marcar o FATD como CONCLUIDO, e obrigatorio o preenchimento do RELATORIO DO CMT DA OPM!"); campo.focus(); return false;
			}
		}


		//RESULTADO DO ACUSADO
		campo=document.getElementsByName('envolvido[1][resultado]')[0];
		nomek=document.getElementsByName('envolvido[1][nome]')[0];
		if (campo.value=="" && nomek.value!="") {
			window.alert("Preencha o resultado do Acusado!"); campo.focus(); return false;
		}
	} //END IF CONCLUIDO
return true;

}
</script>

<?
?>

<form ID='fatd' class="controlar-modificacao" name="fatd" action="index.php?module=fatd" method=post onSubmit="return validar(this);" enctype="multipart/form-data">
<input type="hidden" name="fatd[id_fatd]">
<input type="hidden" name="fatd[sjd_ref]">
<input type="hidden" name="fatd[sjd_ref_ano]">

<!-- fatd -->
<?if ($opcao=="cadastrar"){?><center><h1>Novo Formul&aacute;rio de Apura&ccedil;&atilde;o de Transgress&atilde;o Disciplinar</h1></center><?}?>
<?if ($opcao=="atualizar"){?><center><h1>Formul&aacute;rio de Apura&ccedil;&atilde;o de Transgress&atilde;o Disciplinar</h1></center><?}?>

<table width='100%' class='bordasimples'>
	<?if ($opcao=="cadastrar"){?>
	<tr><th colspan="5" bgcolor="#DBEAF5"><font face="tahoma, verdana" size="2">Formulário de
preenchimento</font></th></tr> 	<?}?>
	<?if ($opcao=="atualizar"){?>
	<tr>
		<td align="center" colspan="3" bgcolor="#DBEAF5">
		Visualização e atualização |
		<a href="?module=movimento&movimento[id_fatd]=<?=$fatd->id_fatd;?>">Movimentos</a> |
		<a href="?module=sobrestamento&sobrestamento[id_fatd]=<?=$fatd->id_fatd;?>">Sobrestamentos</a> |
        <a href="?module=subscription&tipo_processo=fatd&id_processo=<?=$fatd->id_fatd;?>">Acompanhamento</a>
        <?if ($user['nivel']==4 || $user['nivel']==5){?>
        | <a href="?module=arquivo&arquivo[id_fatd]=<?=$fatd->id_fatd;?>">Arquivo</a>
        <?}?>
		</td>
	</tr>
	<?}?>

</tr>
<?
if ($opcao=="atualizar")
{
	//caso esteja com sobrestamento sem data de término
	$sql="SELECT * FROM sobrestamento WHERE id_fatd='".$fatd->id_fatd."' AND termino_data='0000-00-00'";
	if ($_SESSION[debug]) echo $sql."<br>\r\n";
	$resS=mysql_query($sql);
	$sobrest_abertos=mysql_num_rows($resS);
	if ($sobrest_abertos && $user['nivel']!=5) 
	{
		$opcaoGeral="readonly"; $opcaoGeral2="disabled";
		h2("<center><font color='red'>Procedimento com sobrestamento em aberto, favor colocar data de término para habilitar as alterações!</font></center>");
	}
}
//colocar procedimento como prioritário
if ($user['nivel']==4 || $user['nivel']==5)
{
	form::openTD("colspan='5'");
		echo "<hr>O Procedimento é prioritário?(só preencha se tiver certeza)
		<select name='fatd[prioridade]'>
			<option value='0'>N&Atilde;O</option>
			<option value='1'>SIM</option>
		</select>
		<hr>";
	form::closeTR();
}
//
form::openTR();
	form::openTD();
		form::openLabel("N&ordm; e Andamento");
		if ($fatd->sjd_ref) {
			echo "<input readonly name='numeracao' type='text' value='".$fatd->sjd_ref."/".$fatd->sjd_ref_ano."'>";
		}
		else {
			echo "<input readonly name='numeracao' type='text' value='*/".$_SESSION['sjd_ano']."'>";
		}
		formulario::option("fatd","andamento","WHERE procedimento='fatd'","","",0);
		form::closeLabel();
	form::closeTD();
	openTD("colspan='2'");
		form::openLabel("Andamento COGER");
			if ($user['nivel']>=4) {
			formulario::option("fatd","andamentocoger","WHERE procedimento='fatd'","","",0);
			}
			else {
			echo "<input readonly type='text' value='".$fatd->andamentocoger->andamentocoger."'>";
			}
		form::closeLabel();
	closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan=3");
		$indice=0;
		if ($_SESSION['debug'])  {
			pre($sql); pre("Procedimentos de origem encontrados: $total");
		}
		formulario::subform("ligacao",$ligacoes,"Procedimento(s) de Origem (apenas se houver)");
		form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='3' width='100%'");
		form::input("Documentos de origem","fatd[doc_origem_txt]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("width='50%'");
		form::input("Data do fato","fatd[fato_data]");
	form::closeTD();
	form::openTD("colspan='2' width='50%'");
		form::openLabel("OPM");
		$cdopm=$fatd->cdopm;
		echo "<select name='fatd[cdopm]' $opcaoGeral2>";
			include("includes/option_opm.php");
		echo "</select>";
		form::closeLabel();
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("width='50%'");
		$textoForm="<select name=fatd[motivo_fatd] id=fatd[motivo_fatd] onchange='motivoFatd()' $opcaoGeral2>						
		<option value=''>Selecione</option>
		<option value='Falta ao serviço'>Falta ao serviço</option>
		<option value='Atraso ao serviço'>Atraso ao serviço</option>
		<option value='Não prestar sinais de respeito'>Não prestar sinais de respeito</option>
		<option value='Desrespeito a superior, par ou subordinado'>Desrespeito a superior, par ou subordinado</option>
		<option value='Transgressões relativas ao atendimento de ocorrência'>Transgressões relativas ao atendimento de ocorrência</option>
		<option value='Sair de sua área de responsabilidade quando em serviço'>Sair de sua área de responsabilidade quando em serviço</option>
		<option value='Realizar viagens/deslocamentos fora de seu município sem autorização do comando'>Realizar viagens/deslocamentos fora do município s/ aut. CMD</option>
		<option value='Falta de asseio pessoal'>Falta de asseio pessoal</option>
		<option value='Portar-se de maneira inconveniente'>Portar-se de maneira inconveniente</option>
		<option value='Extravio de material'>Extravio de material</option>
		<option value='Falta em audiência'>Falta em audiência</option>
		<option value='Desidia Processual'>Desidia Processual</option>
		<option value='Pratica Crime Militar'>Pratica Crime Militar</option>
		<option value='Pratica Crime Comum'>Pratica Crime Comum</option>
		<option value='Desrespeito a outras normativas'>Desrespeito a outras normativas</option>
		<option value='Crimes contra a dignidade sexual'>Crimes contra a dignidade sexual</option>
		<option value='Violência doméstica'>Violência doméstica</option>
		<option value='Outro'>Outro</option>
		</select>";
		form::input("Motivo do FATD","",$textoForm);
	form::closeTD();
	if ($opcao=="cadastrar") {$none = "none";
		form::openTD("style='width:50%; display: $none'; id='fatdoutros';");
			form::input("Descriç&atilde;o","fatd[motivo_outros]\" id='motdoutros' ");
		form::closeTD();
	} else if ($opcao=="atualizar" && $fatd->motivo_outros !== ""){
		form::openTD("style='width:50%; display: block'; id='fatdoutros';");
			form::input("Descriç&atilde;o","fatd[motivo_outros]\" id='motdoutros' ");
		form::closeTD();
	}
	
form::closeTR();

form::openTR();
	form::openTD("colspan='3' width='100%'");
		$textoForm="<select name=fatd[situacao_fatd] id=fatd[situacao_fatd] $opcaoGeral2>						
		<option value='Em serviço ou atendimento de ocorrência'>Em serviço ou atendimento de ocorrência</option>
		<option value='Fora de serviço ou outras circunstâncias'>Fora de serviço ou outras circunstâncias</option>
		</select>";
		form::input("Situaç&atilde;o","",$textoForm);
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='3' width='100%'");
		$opcoes=" id='sintese_txt' rows='7' cols='80' ";
		form::input("S&iacute;ntese do fato (Quem, quando, onde, como e por quê)","fatd[sintese_txt]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='1' width='50%'");
		form::input("N&ordm; do despacho que designa o Encarregado <b>ATEN&Ccedil;&Atilde;O, CINCO N&Uacute;MEROS</b>","fatd[despacho_numero]","#####/####");
	form::closeTD();
	form::openTD("colspan='1' width='50%'");
		form::input("Data do despacho","fatd[portaria_data]");
	form::closeTD();
	form::openTD("colspan='1' width='50%'");
		$textoForm="<select name='fatd[doc_tipo]' $opcaoGeral2>
			<option value=''>Escolha</option>
			<option value='BG'>BG</option>
			<option value='BI'>BI</option>\r\n
			<option value='BR'>BR</option>\r\n</select>";
		$textoForm.="&nbsp;N&ordm;&nbsp;";
		$textoForm.="<input type='text' size='9' name='fatd[doc_numero]' maxlength=8 onkeyup='formatar(this,\"###/####\")' $opcaoGeral2>";
		form::input("Boletim de publica&ccedil;&atilde;o do despacho","",$textoForm);
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='3'");
		form::input("Data da abertura","fatd[abertura_data]");
	form::closeTD();
form::closeTR();


form::openTR();
	form::openTD("colspan='1' width='50%'");
		form::input("Relato do fato imputado","fatd[fato_file]");
	form::closeTD();
	form::openTD("colspan='2' width='50%'");
		form::input("Relat&oacute;rio","fatd[relatorio_file]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='1' width='50%'");
		form::input("Solu&ccedil;&atilde;o do Comandante","fatd[sol_cmt_file]");
	form::closeTD();

	form::openTD("colspan='2' width='50%'");
		form::input("Solu&ccedil;&atilde;o do Cmt Geral","fatd[sol_cg_file]");
	form::closeTD();

form::closeTR();

form::openTR();
	form::openTD("colspan='1' width='50%'");
		//if ($user["nivel"]<4) $opcoes=" readonly=true";
		form::input("Nota de puni&ccedil;&atilde;o","fatd[notapunicao_file]");
	form::closeTD();

	openTD("colspan='2'");
		form::input("Publica&ccedil;&atilde;o da nota de puni&ccedil;&atilde;o (Ex: BI n&ordm; 12/2011)","fatd[publicacaonp]");
	closeTD();
form::closeTR();

openLine(3);
	h2("Recursos");
closeLine();


form::openTR();
	openTD();
		form::input("Reconsidera&ccedil;&atilde;o de ato (solu&ccedil;&atilde;o)","fatd[rec_ato_file]");
	closeTD();

	openTD("colspan='2'");
		form::input("Recurso Cmt OPM","fatd[rec_cmt_file]");
	closeTD();
form::closeTR();

openTR();
	openTD();
		form::input("Recurso Cmt CRPM","fatd[rec_crpm_file]");
	closeTD();
	openTD("colspan='2'");
		form::input("Recurso Cmt Geral","fatd[rec_cg_file]");
	closeTD();
closeTR();


?>
<!--Encarregado e Escrivão-->
<?
if ($opcao=="atualizar") {
$encarregado=new envolvido("WHERE rg_substituto='' AND situacao='Encarregado' AND id_fatd='".$fatd->id_fatd."'","","simples");
$acusador=new envolvido("WHERE rg_substituto='' AND situacao='Acusador' AND id_fatd='".$fatd->id_fatd."'","","simples");
$defensor=new envolvido("WHERE rg_substituto='' AND situacao='Defensor' AND id_fatd='".$fatd->id_fatd."'","","simples");
}
?>

<tr><td colspan='3'>

<table cellpadding="1" cellspacing="1" width="100%" bgcolor="#EEEEEE"><tr><td>
<table align=center border=0 cellpadding="0" cellspacing="1" width="100%">
	<tr><th colspan="5" bgcolor="#EEEEEE"><font face="tahoma, verdana" size="2">Membros</font></th></tr>
	<tr bgcolor=white align=center><td>RG</td><td valign="center">Nome<a href='http://10.47.1.8/pm/consultapm.php' target="_blank"><img border=0 src='img/lupa.gif' width="20" /></a></td><td>Posto/Graduação</td><td width='160px'>Situação</td><td>Ação</td></tr>
	<tr bgcolor=white>
		<input type="hidden" name="envolvido[encarregado][id_envolvido]">
		<input type="hidden" name="envolvido[encarregado][id_fatd]">
		<?php
		if ($opcaoGeral=="readonly") $readonly="readonly"; else $readonly="";
		echo "<td><input $readonly type='text' size='12' name='envolvido[encarregado][rg]' onkeypress='return DigitaNumeroTempoReal(this,event)' onblur=\"ajaxForm(this,'policial',Array('nome','cargo'));\"></td>";
		?>
		<td><input readonly="readonly" type=text size=30 ajax=1 name=envolvido[encarregado][nome]></td>
		<td><input readonly="readonly" type=text size=10 name="envolvido[encarregado][cargo]"></td>
		<td><input readonly="readonly" type=text size=15 name="envolvido[encarregado][situacao]" value="Encarregado"></td>
		<? $deletar=false;
		if ($opcao=="atualizar") $id=$encarregado->id_envolvido;
		if ($user['nivel']<>6 && $user['nivel']<>7) include ("includes/botoes.inc"); ?>
 	</tr>
	<tr bgcolor=white>
		<input type="hidden" name="envolvido[acusador][id_envolvido]">
		<input type="hidden" name="envolvido[acusador][id_fatd]">
		<?php
		echo "<td><input $readonly type=text size=12 name=envolvido[acusador][rg] onkeypress='return DigitaNumeroTempoReal(this,event)' onblur=\"ajaxForm(this,'policial',Array('nome','cargo'));\"></td>";
		?>
		<td><input readonly="readonly" type=text size=30 ajax=1 name=envolvido[acusador][nome]></td>
		<td><input readonly="readonly" type=text size=10 name="envolvido[acusador][cargo]"></td>
		<td><input readonly type=text size=15 name="envolvido[acusador][situacao]" value="Acusador"></td>
		<? $deletar=false;
		if ($opcao=="atualizar") $id=$acusador->id_envolvido;
		if ($user['nivel']<>6 && $user['nivel']<>7) include ("includes/botoes.inc"); ?>
	</tr>
	<tr bgcolor=white>
		<input type="hidden" name="envolvido[defensor][id_envolvido]">
		<input type="hidden" name="envolvido[defensor][id_fatd]">
		<?php
		echo "<td><input $readonly type=text size=12 name=envolvido[defensor][rg] onkeypress='return DigitaNumeroTempoReal(this,event)' onblur=\"ajaxForm(this,'policial',Array('nome','cargo'));\"></td>";
		?>
		<td><input readonly="readonly" type=text size=30 ajax=1 name=envolvido[defensor][nome]></td>
		<td><input readonly="readonly" type=text size=10 name="envolvido[defensor][cargo]"></td>
		<td><input readonly type=text size=15 name="envolvido[defensor][situacao]" value="Defensor"></td>
		<? $deletar=false;
		if ($opcao=="atualizar") $id=$defensor->id_envolvido;
		if ($user['nivel']<>6 && $user['nivel']<>7) include ("includes/botoes.inc"); ?>
	</tr>
</table>
</td></tr>
</table>
<!-- Fim Encarregado e Escrivão -->

<!-- Indiciados -->
<tr><td colspan='3'>
	<?formulario::subform("envolvido",$indiciados,"Acusado");?>
</td></tr>
<!-- Fim Indiciados -->
<!-- Ofendidos -->
        <?//formulario::subform("ofendido",$ofendidos,"V&iacute;timas (Apenas se houver)");?>
<!-- Fim Ofendidos -->

</td></tr>
<tr><td>
<?
if ($user['nivel']<>6 && $user['nivel']<>7)  {
	if ($opcao=="cadastrar") echo "<input type='submit' name='acao' value='Cadastrar'>";
	if ($opcao=="atualizar" and $user['nivel']>1) {
		//if ($fatd->andamento->andamento!="CONCLUÍDO" or $user['nivel']>=4)
		echo "<input type='submit' name='acao' value='Atualizar'>";
	}
	if ($user['nivel']>=5 and $opcao!="cadastrar") echo "<input type='submit' name='acao' value='Apagar'>";
}
?>
</td></tr>
</table>

</form>

<?
//Preenchimento automático formulário
if ($fatd) {
       formulario::values($fatd);

        if ($opcao=="atualizar") {

        formulario::values($encarregado,"envolvido[encarregado]");
        formulario::values($acusador,"envolvido[acusador]");
        formulario::values($defensor,"envolvido[defensor]");

        formulario::values($vetorIndiciados,"envolvido");

        }

        $i=1;
        while  ($row=@mysql_fetch_assoc($resI)) {
                formulario::values($row,"envolvido[$i]");
		if ($row[rg] and $user['nivel']<>5) echo "<script>document.getElementsByName('envolvido[$i][rg]')[0].disabled=true;</script>";
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

if ($user['nivel']<2) js::desativaTudo();
if ($fatd->andamento->id_andamento==2 and $user['nivel']<4) js::desativaTudo();

?>
