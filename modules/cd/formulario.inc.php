<?php

if (!$cd->sjd_ref_ano) $cd->sjd_ref_ano=$_SESSION[sjd_ano];

if ($opcao=="atualizar") {
$sql="SELECT * FROM envolvido WHERE situacao='Acusado' AND id_cd='".$cd->id_cd."'";
$resI=mysql_query($sql);
if ($resI) $indiciados=mysql_num_rows($resI);

$sql="SELECT * FROM ofendido WHERE situacao='Ofendido' AND id_cd='".$cd->id_cd."'";
if ($_SESSION[debug]) echo $sql."<br>\r\n";
$resO=mysql_query($sql);
if ($resO) $ofendidos=mysql_num_rows($resO);

//ligacoes
$sqlL="SELECT * FROM ligacao WHERE destino_proc='cd' AND destino_sjd_ref='".$cd->sjd_ref."' AND destino_sjd_ref_ano='".$cd->sjd_ref_ano."'";
$resL=mysql_query($sqlL);
$ligacoes=mysql_num_rows($resL);
}

if (!$ofendidos) $ofendidos=0;
if (!$indiciados) $indiciados=1;

?>

<script language=javascript>
function validar(form) {
	//ANDAMENTO
	campo=document.getElementsByName('cd[id_andamento]')[0];
	if (campo.value=="") {
		window.alert("Preencha o andamento!"); campo.focus(); return false;
	}
	//MOTIVO DA ABERTURA
	campo=document.getElementsByName('cd[id_motivoconselho]')[0];
	if (campo.value=="") {
		window.alert("Preencha o Motivo do Conselho!"); campo.focus(); return false;
	}
	//PORTARIA NUMERO
	campo=document.getElementsByName('cd[portaria_numero]')[0];
	if (campo.value=="") {
		window.alert("Preencha o N da portaria do CG!"); campo.focus(); return false;
	}
	//ACUSADO
	campo=document.getElementsByName('envolvido[1][rg]')[0];
	if (campo.value=="") {
		window.alert("Preencha o Acusado"); campo.focus(); return false;
	}
	//PRESIDENTE
	campo=document.getElementsByName('envolvido[presidente][rg]')[0];
	if (campo.value=="") {
		window.alert("Preencha o Presidente"); campo.focus(); return false;
	}
	//INTERROGANTE
	campo=document.getElementsByName('envolvido[interrogante][rg]')[0];
	if (campo.value=="") {
		window.alert("Preencha o Interrogante"); campo.focus(); return false;
	}
	//ESCRIVAO
	campo=document.getElementsByName('envolvido[escrivao][rg]')[0];
	if (campo.value=="") {
		window.alert("Preencha o Escrivao"); campo.focus(); return false;
	}
	//SE ESTIVER CONCLUIDO
	campo=document.getElementsByName('cd[id_andamento]')[0];
	if (campo.value=="10") { //CONCLUIDO
		//ACUSADO
		campo=document.getElementsByName('envolvido[1][resultado]')[0];
		if (campo.value=="") {
			window.alert("Preencha o Resultado do Acusado"); campo.focus(); return false;
		}
	}
}
// -->
</script>

<?
?>

<form class="controlar-modificacao" id='cd' name="cd" action="index.php?module=cd" method=post onSubmit="return validar(this);" enctype="multipart/form-data">
<input type="hidden" name="cd[id_cd]">
<input type="hidden" name="cd[sjd_ref]">
<input type="hidden" name="cd[sjd_ref_ano]">

<!-- cd -->
<?if ($opcao=="cadastrar"){?><center><h1>Novo Conselho de Disciplina</h1></center><?}?>
<?if ($opcao=="atualizar"){?><center><h1>Conselho de Disciplina</h1></center><?}?>

<!--<table cellpadding="0" cellspacing="1" width="100%" border="0"><tr><td colspan=2 bgcolor="#4682B4">-->
<table class='bordasimples' style='margin-bottom:4px;' cellspacing="1" width="100%" border="0">
	<?if ($opcao=="cadastrar"){?>
	<tr><th colspan="5" bgcolor="#DBEAF5"><font face="tahoma, verdana" size="2">Formulário de
preenchimento</font></th></tr> 	<?}?>
 	<?if ($opcao=="atualizar"){?>
	<tr>
		<td align="center" colspan="3" bgcolor="#DBEAF5">
		Visualização e atualização |
		<a href="?module=movimento&movimento[id_cd]=<?=$cd->id_cd;?>">Movimentos</a> |
		<a href="?module=sobrestamento&sobrestamento[id_cd]=<?=$cd->id_cd;?>">Sobrestamentos</a> |                          
        <a href="?module=subscription&tipo_processo=cd&id_processo=<?=$cd->id_cd;?>">Acompanhamento</a> 
        <?if ($user['nivel']==4 || $user['nivel']==5){?>
        | <a href="?module=arquivo&arquivo[id_cd]=<?=$cd->id_cd;?>">Arquivo</a>
        <?}?>
		</td>
	</tr>
	<?}?>

</tr>

<!--
</table>
<table class='bordasimples' border=0 width=100%>
-->

<?

if ($user['nivel']<=1) $opcaoGeral="readonly";
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco
if ($opcao=="atualizar")
{
	//caso esteja com sobrestamento sem data de término
	$sql="SELECT * FROM sobrestamento WHERE id_cd='".$cd->id_cd."' AND termino_data='0000-00-00'";
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
		<select name='cd[prioridade]'>
			<option value='0'>N&Atilde;O</option>
			<option value='1'>SIM</option>
		</select>
		<hr>";
	form::closeTR();
}
//
form::openTR();
	form::openTD("colspan='2'");
		form::openLabel("N&ordm; do CD e andamento");
		if ($cd->sjd_ref) {
			echo "<input readonly name='numeracao' type='text' value='".$cd->sjd_ref."/".$cd->sjd_ref_ano."'>";
		}
		else {
			echo "<input readonly name='numeracao' type='text' value='*/".$_SESSION[sjd_ano]."'>";
		}
		formulario::option("cd","andamento","WHERE procedimento='cd'","","",0,0);
		form::closeLabel();
	form::closeTD();
	openTD();
		form::openLabel("Andamento COGER");
			formulario::option("cd","andamentocoger","WHERE procedimento='cd'","","",0,0);
		form::closeLabel();
	closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='3'");
		$indice=0;
		if ($_SESSION['debug'])  {
			pre($sql); pre("Procedimentos de origem encontrados: $total");
		}
		formulario::subform("ligacao",$ligacoes,"Procedimento(s) de Origem (apenas se houver)");
		form::closeTD();
form::closeTR();

openTR();
	openTD("colspan='3'");
		form::openLabel("Motivo da abertura (Lei nº 16.544/2010)");
			//Abre o select
			echo "<select name='cd[id_motivoconselho]'>\r\n";
			echo "<option rel='none' value='0'>Selecione</option>";
			$sql="SELECT * FROM motivoconselho";
			$res=mysql_query($sql);
			while ($row=mysql_fetch_assoc($res)) {
				if ($row['id_motivoconselho']==2) $rel="acusado"; else $rel="none";
				echo "<option rel='$rel' value='$row[id_motivoconselho]'>$row[motivoconselho]</option>";
			}
			echo "</select>\r\n"; //fecha o select
		form::closeLabel();
	closeTD();
closeTR();

openTR("rel='acusado'");
	openTD("colspan='2'");
		form::openLabel("Selecione");
			echo "<input type='checkbox' value='On' name='cd[ac_desempenho_bl]'>Procedido incorretamente no desempenho do cargo ou fun&ccedil;&atilde;o.<br>";
			echo "<input type='checkbox' value='On' name='cd[ac_conduta_bl]'>Conduta irregular ou ato que venha a denegrir a imagem da Corpora&ccedil;&atilde;o.<br>";
			echo "<input type='checkbox' value='On' name='cd[ac_honra_bl]'>Praticado ato que afete a honra pessoal, o pundonor militar ou o decoro da classe.<br>";
		form::closeLabel();
	closeTD();
closeTR();

openTR();
	openTD("colspan='3'");
		form::openLabel("Situação");
			formulario::option("cd","situacaoconselho","","",0,0);
		form::closeLabel();
	closeTD();
closeTR();

openTR();
	openTD("colspan='2'");
		form::openLabel("Em decorr&ecirc;ncia de");
			formulario::option("cd","decorrenciaconselho","","","",0);
		form::closeLabel();
	closeTD();
	openTD("");
		form::input("Especificar (no caso de outros motivos)","cd[outromotivo]");
	closeTD();

closeTR();


form::openTR();
	form::openTD("colspan='1'");
		form::input("N&ordm; da portaria do CG","cd[portaria_numero]","####/####");
	form::closeTD();
	form::openTD("colspan='1' width='50%'");
		form::input("Data da portaria do CG","cd[portaria_data]");
	form::closeTD();
	form::openTD("colspan='1' width='50%'");
		$textoForm="<select name='cd[doc_tipo]' $opcaoGeral2>
			<option value=''>Escolha</option>
			<option value='BG'>BG</option>
			<option value='BR'>BR</option>\r\n</select>";
		$textoForm.="&nbsp;N&ordm;&nbsp;";
		$textoForm.="<input type='text' name='cd[doc_numero]' maxlength=8 onkeyup='formatar(this,\"###/####\")' $opcaoGeral2>";
		form::input("Boletim de publica&ccedil;&atilde;o da portaria","",$textoForm);
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("width='50%'");
		form::input("Data do fato","cd[fato_data]");
	form::closeTD();
	form::openTD("width='50%'");
		form::input("Data da abertura","cd[abertura_data]");
	form::closeTD();
	form::openTD("width='50%'");
		form::input("Data de prescri&ccedil;&atilde;o","cd[prescricao_data]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='3'");
		$textoForm="<input type='text' name='cd[doc_prorrogacao]' size=25 maxlength=25 $opcaoGeral2>";
		form::input("Documento da prorroga&ccedil;&atilde;o de prazo","",$textoForm);
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='3' width='100%'");
		$opcoes=" id='sintese_txt' rows='7' cols='80' ";
		form::input("S&iacute;ntese do fato (Quem, quando, onde, como e por quê)","cd[sintese_txt]");
	form::closeTD();
form::closeTR();

$opcaoGeral="";

form::openTR();
	form::openTD("colspan='3'");
		form::input("Libelo","cd[libelo_file]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='2'");
		form::openLabel("Resumo do parecer da comiss&atilde;o");
			echo "<select name='cd[parecer_comissao]' $opcaoGeral2>";
			echo "<option value=''>Selecione</option>";
			echo "<option value='Opta pela exclusao'>Opta pela exclusao</option>";
			echo "<option value='Opta pela permanencia'>Opta pela permanencia</option>";
			echo "<option value='Opta pela reforma'>Opta pela reforma</option>";
			echo "</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD("colspan='1' width='50%'");
		form::input("Parecer da Comiss&atilde;o (PDF)","cd[parecer_file]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='2'");
		form::openLabel("Resumo da decis&atilde;o do Cmt Geral");
			echo "<select name='cd[parecer_cmtgeral]' $opcaoGeral2>";
			echo "<option value=''>Selecione</option>";
			echo "<option value='Opta pela exclusao'>Opta pela exclusao</option>";
			echo "<option value='Opta pela permanencia'>Opta pela permanencia</option>";
			echo "<option value='Opta pela reforma'>Opta pela reforma</option>";
			echo "</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD("colspan='1' width='50%'");
		form::input("Decis&atilde;o do Cmt Geral (PDF)","cd[decisao_file]");
	form::closeTD();
form::closeTR();

openLine(3);
	h2("Recursos");
closeLine();

openTR();
	openTD("colspan='2'");
		form::input("Reconsidera&ccedil;&atilde;o de ato (solu&ccedil;&atilde;o)","cd[rec_ato_file]");
	closeTD();
	openTD();
		form::input("Recurso ao Governador (solu&ccedil;&atilde;o)","cd[rec_gov_file]");
	closeTD();
closeTR();

openLine(3);
	h2("Ac&oacute;rd&atilde;os");
closeLine();

openTR();
	openTD("colspan='2'");
		form::input("TJ-PR","cd[tjpr_file]");
	closeTD();
	openTD();
		form::input("STJ/STF","cd[stj_file]");
	closeTD();
closeTR();



if ($user['nivel']>=1) {
?>

<!--Encarregado e Escrivão-->
<?
if ($opcao=="atualizar") {
$presidente=new envolvido("WHERE rg_substituto='' AND situacao='Presidente' AND id_cd='".$cd->id_cd."'","","simples");
$interrogante=new envolvido("WHERE rg_substituto='' AND situacao='Membro' AND id_cd='".$cd->id_cd."'","","simples");
$escrivao=new envolvido("WHERE rg_substituto='' AND situacao='Escrivão' AND id_cd='".$cd->id_cd."'","","simples");
$defensor=new envolvido("WHERE rg_substituto='' AND situacao='Defensor' AND id_cd='".$cd->id_cd."'","","simples");
}
?>

<table border=0 width=100% class='bordasimples'>
<tr><td>

<table cellpadding="1" cellspacing="1" width="100%" bgcolor="#EEEEEE"><tr><td>
<table align=center border=0 cellpadding="0" cellspacing="1" width="100%">
	<tr><th colspan="5" bgcolor="#EEEEEE"><font face="tahoma, verdana" size="2">Membros</font></th></tr>
	<tr bgcolor=white align=center><td>RG</td><td valign="center">Nome<a href='http://10.47.1.8/pm/consultapm.php' target="_blank"><img border=0 src='img/lupa.gif' width="20" /></a></td><td>Posto/Graduação</td><td>Situação</td><td>Ação</td></tr>
	<tr bgcolor=white>
		<input type="hidden" name="envolvido[presidente][id_envolvido]">
		<input type="hidden" name="envolvido[presidente][id_cd]">
		<td><input type=text <?php echo $opcaoGeral2;?> size=12 name=envolvido[presidente][rg] onkeypress='return DigitaNumeroTempoReal(this,event)' onblur="ajaxForm(this,'policial',Array('nome','cargo'));"></td>
		<td><input readonly type=text size=30 ajax=1 name=envolvido[presidente][nome]></td>
		<td><input readonly type=text size=10 name="envolvido[presidente][cargo]"></td>
		<td  width='160px'><input readonly type=text size=15 name="envolvido[presidente][situacao]" value="Presidente"></td>
		<?
                if ($opcao=="atualizar" && $user['nivel']<>6 || $user['nivel']<>7) $id=$presidente->id_envolvido; $deletar=false;
                if ($user['nivel']<>6 && $user['nivel']<>7) include ("includes/botoes.inc"); // alteracao solicitada pelo Cap Todisco
                ?>
	</tr>
	<tr bgcolor=white>
		<input type="hidden" name="envolvido[interrogante][id_envolvido]">
		<input type="hidden" name="envolvido[interrogante][id_cd]">
		<td><input type=text <?php echo $opcaoGeral2;?> size=12 name=envolvido[interrogante][rg] onkeypress='return DigitaNumeroTempoReal(this,event)' onblur="ajaxForm(this,'policial',Array('nome','cargo'));"></td>
		<td><input readonly type=text size=30 ajax=1 name="envolvido[interrogante][nome]"></td>
		<td><input readonly type=text size=10 name="envolvido[interrogante][cargo]"></td>
		<td><input readonly type=text size=15 name="envolvido[interrogante][situacao]" value="Membro"></td>
		<?
                if ($opcao=="atualizar") $id=$interrogante->id_envolvido;
                if ($user['nivel']<>6 && $user['nivel']<>7) include ("includes/botoes.inc");
                ?>

	</tr>
	<tr bgcolor=white>
		<input type="hidden" name="envolvido[escrivao][id_envolvido]">
		<input type="hidden" name="envolvido[escrivao][id_cd]">
		<td><input type=text <?php echo $opcaoGeral2;?> size=12 name=envolvido[escrivao][rg] onblur="ajaxForm(this,'policial',Array('nome','cargo'));" onkeypress="return DigitaNumeroTempoReal(this,event)"></td>
		<td><input readonly type=text size=30 ajax=1 name=envolvido[escrivao][nome]></td>
		<td><input readonly type=text size=10 name="envolvido[escrivao][cargo]"></td>
		<td><input readonly type=text size=15 name="envolvido[escrivao][situacao]" value="Escrivão"></td>
                <?
                if ($opcao=="atualizar") $id=$escrivao->id_envolvido;
                if ($user['nivel']<>6 && $user['nivel']<>7) include ("includes/botoes.inc");
                ?>
	</tr>

	<tr bgcolor=white>
		<input type="hidden" name="envolvido[defensor][id_envolvido]">
		<input type="hidden" name="envolvido[defensor][id_cd]">
		<td><input type=text <?php echo $opcaoGeral2;?> size=12 name=envolvido[defensor][rg] onblur="ajaxForm(this,'policial',Array('nome','cargo'));" onkeypress="return DigitaNumeroTempoReal(this,event)"></td>
		<td><input readonly type=text size=30 ajax=1 name=envolvido[defensor][nome]></td>
		<td><input readonly type=text size=10 name="envolvido[defensor][cargo]"></td>
		<td><input readonly type=text size=15 name="envolvido[defensor][situacao]" value="Defensor"></td>
                <?
                if ($opcao=="atualizar") $id=$defensor->id_envolvido;
                if ($user['nivel']<>6 && $user['nivel']<>7) include ("includes/botoes.inc");
                ?>
	</tr>


</table>
</td></tr></table>
<!-- Fim Encarregado e Escrivão -->

<!-- Indiciados -->
	<?formulario::subform("envolvido",$indiciados,"Acusados");?>
<!-- Fim Indiciados -->
<!-- Ofendidos -->
<?formulario::subform("ofendido",$ofendidos,"V&iacute;timas (Apenas se houver)");?>
<!-- Fim Ofendidos -->
</td></tr>
<?
}
?>

<tr><td>
<?



if ($user['nivel']<>6 && $user['nivel']<>7)  {
	if ($opcao=="cadastrar") echo "<input type='submit' name='acao' value='Cadastrar'>";
	if ($opcao=="atualizar") echo "<input type='submit' name='acao' value='Atualizar'>";
	if ($user['nivel']>=5 and $opcao!="cadastrar") echo "<input type='submit' name='acao' value='Apagar'>";
}
?>


</td></tr>


<?


?>


</table>

</form>

<?

//if ($user['nivel']<=1) js::desativaTudo();

//Preenchimento automático formulário
if ($cd) {
        formulario::values($cd);

        if ($opcao=="atualizar") {

        formulario::values($presidente,"envolvido[presidente]");
        formulario::values($interrogante,"envolvido[interrogante]");
        formulario::values($escrivao,"envolvido[escrivao]");
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

?>
