<?php

if (!$adl->sjd_ref_ano) $adl->sjd_ref_ano=$_SESSION[sjd_ano];

if (!$adl->id_andamentocoger) $adl->id_andamentocoger=65; //SE NAO TEM ANDAMENTO COGER, EH COMISSAO PROCESSANTE

if ($opcao=="atualizar") {
$sql="SELECT * FROM envolvido WHERE situacao='Acusado' AND id_adl='".$adl->id_adl."'";
$resI=mysql_query($sql);
if ($resI) $indiciados=mysql_num_rows($resI);

$sql="SELECT * FROM ofendido WHERE situacao='Ofendido' AND id_adl='".$adl->id_adl."'";
if ($_SESSION[debug]) echo $sql."<br>\r\n";
$resO=mysql_query($sql);
if ($resO) $ofendidos=mysql_num_rows($resO);

//ligacoes
	$sqlL="SELECT * FROM ligacao WHERE destino_proc='adl' AND destino_sjd_ref='".$adl->sjd_ref."' AND destino_sjd_ref_ano='".$adl->sjd_ref_ano."'";
	$resL=mysql_query($sqlL);
	$ligacoes=mysql_num_rows($resL);
}

if (!$ofendidos) $ofendidos=0;
if (!$indiciados) $indiciados=1;

?>

<script language=javascript>
function validar(form) {
	//andamento
	campo=document.getElementsByName('adl[id_andamento]')[0];
	if (campo.value=="") {
		window.alert("Preencha o andamento!"); campo.focus(); return false;
	}
	//MOTIVO DA ABERTURA
	campo=document.getElementsByName('adl[id_motivoconselho]')[0];
	if (campo.value=="") {
		window.alert("Preencha o Motivo da ADL!"); campo.focus(); return false;
	}
	//PORTARIA NUMERO
	campo=document.getElementsByName('adl[portaria_numero]')[0];
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
	//ESCRIVAO
	campo=document.getElementsByName('envolvido[escrivao][rg]')[0];
	if (campo.value=="") {
		window.alert("Preencha o Escrivao"); campo.focus(); return false;
	}
	//SE ESTIVER CONCLUIDO
	campo=document.getElementsByName('adl[id_andamento]')[0];
	if (campo.value=="16") { //CONCLUIDO
		//ACUSADO
		campo=document.getElementsByName('envolvido[1][resultado]')[0];
		if (campo.value=="") {
			window.alert("Preencha o Resultado do Acusado"); campo.focus(); return false;
		}
	}
return true;
}
</script>

<form id='adl' class="controlar-modificacao" name="adl" action="index.php?module=adl" method="post" onSubmit="return validar(this);" enctype="multipart/form-data">
<input type="hidden" name="adl[id_adl]">
<input type="hidden" name="adl[sjd_ref]">
<input type="hidden" name="adl[sjd_ref_ano]">
<input type="hidden" name="adl[cdopm]" value="0">

<!-- adl -->
<?if ($opcao=="cadastrar"){?><center><h1>Nova Apura&ccedil;&atilde;o Disciplinar de Licenciamento</h1></center><?}?>
<?if ($opcao=="atualizar"){?><center><h1>Apura&ccedil;&atilde;o Disciplinar de Licenciamento</h1></center><?}?>

<table class='bordasimples' width='100%'>
	<?if ($opcao=="cadastrar"){?>
	<tr><th colspan="5" bgcolor="#DBEAF5"><font face="tahoma, verdana" size="2">Formulário de 
preenchimento</font></th></tr> 	<?}?>
 	<?if ($opcao=="atualizar"){?>
	<tr>
		<td align="center" colspan="3" bgcolor="#DBEAF5">
		Visualiza&ccedil;&atilde;o e atualiza&ccedil;&atilde;o | 
		<a href="?module=movimento&movimento[id_adl]=<?=$adl->id_adl;?>">Movimentos</a> |
		<a href="?module=sobrestamento&sobrestamento[id_adl]=<?=$adl->id_adl;?>">Sobrestamentos</a>
		</td>
	</tr>
	<?}?>

</tr>

<?

if ($user['nivel']<=1) $opcaoGeral="readonly";
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

form::openTR();
	form::openTD("colspan='2'");
		form::openLabel("Nº do ADL e andameno");
		if ($adl->sjd_ref) {
			echo "<input readonly name='numeracao' type='text' value='".$adl->sjd_ref."/".$adl->sjd_ref_ano."'>";
		}
		else {
			echo "<input readonly name='numeracao' type='text' value='*/".$_SESSION[sjd_ano]."'>";
		}
		formulario::option("adl","andamento","WHERE procedimento='adl'");
		form::closeLabel();
	form::closeTD();
	openTD();
		form::openLabel("Andamento COGER");
			formulario::option("adl","andamentocoger","WHERE procedimento='adl'");
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
			echo "<select name='adl[id_motivoconselho]'>\r\n";
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
			echo "<input type='checkbox' value='On' name='adl[ac_desempenho_bl]'>Procedido incorretamente no desempenho do cargo ou fun&ccedil;&atilde;o.<br>";
			echo "<input type='checkbox' value='On' name='adl[ac_conduta_bl]'>Conduta irregular ou ato que venha a denegrir a imagem da Corpora&ccedil;&atilde;o.<br>";
			echo "<input type='checkbox' value='On' name='adl[ac_honra_bl]'>Praticado ato que afete a honra pessoal, o pundonor militar ou o decoro da classe.<br>";
		form::closeLabel();
	closeTD();
closeTR();

openTR();
	openTD("colspan='2'");
		form::openLabel("Em decorr&ecirc;ncia de");
			formulario::option("adl","decorrenciaconselho");
		form::closeLabel();
	closeTD();
	openTD();
		form::input("Especificar (no caso de outros motivos)","adl[outromotivo]");
	closeTD();
closeTR();

form::openTR();
	form::openTD("colspan='1'");
		form::input("N&ordm; da portaria do CG","adl[portaria_numero]","####/####");
	form::closeTD();
	form::openTD("colspan='1' width='50%'");
		form::input("Data da portaria do CG","adl[portaria_data]");
	form::closeTD();
	form::openTD("colspan='1' width='50%'");
		$textoForm="<select name='adl[doc_tipo]' $opcaoGeral2>
			<option value=''>Escolha</option>
			<option value='BG'>BG</option>
			<option value='BR'>BR</option>\r\n</select>";
		$textoForm.="&nbsp;N&ordm;&nbsp;";
		$textoForm.="<input type='text' name='adl[doc_numero]' maxlength=8 onkeyup='formatar(this,\"###/####\")' $opcaoGeral2>";
		form::input("Boletim de publica&ccedil;&atilde;o da portaria","",$textoForm);
	form::closeTD();
form::closeTR();


form::openTR();
	form::openTD("width='50%'");
		form::input("Data do fato","adl[fato_data]");
	form::closeTD();
	form::openTD("width='50%'");
		form::input("Data da abertura","adl[abertura_data]");
	form::closeTD();
	form::openTD("width='50%'");
		form::input("Data de prescri&ccedil;&atilde;o","adl[prescricao_data]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='3' width='100%'");
		$opcoes=" id='sintese_txt' rows='7' cols='80' ";
		form::input("S&iacute;ntese do fato (Quem, quando, onde, como e por quê)","adl[sintese_txt]");
	form::closeTD();
form::closeTR();

$opcaoGeral="";

form::openTR();
	form::openTD("colspan='3'");
		form::input("Libelo","adl[libelo_file]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='2'");
		form::openLabel("Resumo do parecer da comiss&atilde;o");
			echo "<select name='adl[parecer_comissao]' $opcaoGeral2>";
			echo "<option value=''>Selecione</option>";
			echo "<option value='Opta pela exclusao'>Opta pela exclusao</option>";
			echo "<option value='Opta pela permanencia'>Opta pela permanencia</option>";
			echo "<option value='Opta pela reforma'>Opta pela reforma</option>";
			echo "</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD("colspan='1' width='50%'");
		form::input("Parecer da Comiss&atilde;o (PDF)","adl[parecer_file]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='2'");
		form::openLabel("Resumo da decis&atilde;o do Cmt Geral");
			echo "<select name='adl[parecer_cmtgeral]' $opcaoGeral2>";
			echo "<option value=''>Selecione</option>";
			echo "<option value='Opta pela exclusao'>Opta pela exclusao</option>";
			echo "<option value='Opta pela permanencia'>Opta pela permanencia</option>";
			echo "<option value='Opta pela reforma'>Opta pela reforma</option>";
			echo "</select>";
		form::closeLabel();
	form::closeTD();
	form::openTD("colspan='1' width='50%'");
		form::input("Decis&atilde;o do Cmt Geral (PDF)","adl[decisao_file]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='3' width=100%");
		$textoForm="<input type='text' name='adl[doc_prorrogacao]' size=25 maxlength=25 $opcaoGeral2>";
		form::input("Documento da prorroga&ccedil;&atilde;o de prazo","",$textoForm);
	form::closeTD();
form::closeTR();

openLine(3);
	h2("Recursos");
closeLine();

openTR();
	openTD("colspan='2'");
		form::input("Reconsidera&ccedil;&atilde;o de ato (solu&ccedil;&atilde;o)","adl[rec_ato_file]");
	closeTD();
	openTD();
		form::input("Recurso ao Governador (solu&ccedil;&atilde;o)","adl[rec_gov_file]");
	closeTD();
closeTR();

openLine(3);
	h2("Ac&oacute;rd&atilde;os");
closeLine();

openTR();
	openTD("colspan='2'");
		form::input("TJ-PR","adl[tjpr_file]");
	closeTD();
	openTD();
		form::input("STJ/STF","adl[stj_file]");
	closeTD();
closeTR();



if ($user['nivel']>=1) {
?>

<!--Encarregado e Escriv&atilde;o-->
<?
if ($opcao=="atualizar") {
$presidente=new envolvido("WHERE rg_substituto='' AND situacao='Presidente' AND id_adl='".$adl->id_adl."'","","simples");
$interrogante=new envolvido("WHERE rg_substituto='' AND situacao='Membro' AND id_adl='".$adl->id_adl."'","","simples");
$escrivao=new envolvido("WHERE rg_substituto='' AND situacao='Escrivão' AND id_adl='".$adl->id_adl."'","","simples");
$defensor=new envolvido("WHERE rg_substituto='' AND situacao='Defensor' AND id_adl='".$adl->id_adl."'","","simples");
}
?>

<tr><td colspan='3'>

<table cellpadding="1" cellspacing="1" width="100%" bgcolor="#EEEEEE"><tr><td>
<table align=center border=0 cellpadding="0" cellspacing="1" width="100%">
	<tr><th colspan="5" bgcolor="#EEEEEE"><font face="tahoma, verdana" size="2">Membros</font></th></tr>
	<tr bgcolor=white align=center><td>RG</td><td valign="center">Nome<a href='http://10.47.1.8/pm/consultapm.php' target="_blank"><img border=0 src='img/lupa.gif' width="20" /></a></td><td>Posto/Gradua&ccedil;&atilde;o</td><td>Situa&ccedil;&atilde;o</td><td>A&ccedil;&atilde;o</td></tr>
	<tr bgcolor=white>
		<input type="hidden" name="envolvido[presidente][id_envolvido]">
		<input type="hidden" name="envolvido[presidente][id_adl]">
		<td><input type=text size="12" name=envolvido[presidente][rg] onblur="ajaxForm(this,'policial',Array('nome','cargo'));" <?php echo $opcaoGeral2;?>></td>
		<td><input type=text size=30 ajax=1 name=envolvido[presidente][nome] readonly></td>
		<td><input type=text size=10 name="envolvido[presidente][cargo]"readonly></td>
		<td width='160px'><input readonly type=text size=15 name="envolvido[presidente][situacao]" value="Presidente"></td>
		<?
                if ($opcao=="atualizar") $id=$presidente->id_envolvido; $deletar=false;
                if ($user['nivel']<>6 && $user['nivel']<>7) include ("includes/botoes.inc");
                ?>
	</tr>
	<tr bgcolor=white>
		<input type="hidden" name="envolvido[escrivao][id_envolvido]">
		<input type="hidden" name="envolvido[escrivao][id_adl]">
		<td><input type=text size="12" name=envolvido[escrivao][rg] onblur="ajaxForm(this,'policial',Array('nome','cargo'));" <?php echo $opcaoGeral2;?>></td>
		<td><input type=text size=30 ajax=1 name=envolvido[escrivao][nome] readonly></td>
		<td><input type=text size=10 name="envolvido[escrivao][cargo]" readonly></td>
		<td><input readonly type=text size=15 name="envolvido[escrivao][situacao]" value="Escriv&atilde;o"></td>
                <?
                if ($opcao=="atualizar") $id=$escrivao->id_envolvido;
                if ($user['nivel']<>6 && $user['nivel']<>7) include ("includes/botoes.inc");
                ?>

	</tr>

	<tr bgcolor=white>
		<input type="hidden" name="envolvido[defensor][id_envolvido]">
		<input type="hidden" name="envolvido[defensor][id_adl]">
		<td><input type=text size="12" name=envolvido[defensor][rg] onblur="ajaxForm(this,'policial',Array('nome','cargo'));" <?php echo $opcaoGeral2;?>></td>
		<td><input type=text size=30 ajax=1 name=envolvido[defensor][nome] readonly></td>
		<td><input type=text size=10 name="envolvido[defensor][cargo]" readonly></td>
		<td><input readonly type=text size=15 name="envolvido[defensor][situacao]" value="Defensor"></td>
                <?
                if ($opcao=="atualizar") $id=$defensor->id_envolvido;
                if ($user['nivel']<>6 && $user['nivel']<>7) include ("includes/botoes.inc");
                ?>

	</tr>

</table>
</td></tr></table>
<!-- Fim Encarregado e Escriv&atilde;o -->

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
if ($adl) {
        formulario::values($adl);

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
