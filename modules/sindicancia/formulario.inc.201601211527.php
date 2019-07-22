<?
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

if (!$sindicancia->sjd_ref_ano) $sindicancia->sjd_ref_ano=$_SESSION[sjd_ano];

if ($opcao=="atualizar") {
$sql="SELECT * FROM envolvido WHERE situacao='Sindicado' AND id_sindicancia='".$sindicancia->id_sindicancia."'";
$resI=mysql_query($sql);
if ($resI) $indiciados=mysql_num_rows($resI);

$sql="SELECT * FROM ofendido WHERE situacao='Ofendido' AND id_sindicancia='".$sindicancia->id_sindicancia."'";
$resO=mysql_query($sql);
if ($resO) $ofendidos=mysql_num_rows($resO);

//ligacoes
	$sqlL="SELECT * FROM ligacao WHERE destino_proc='sindicancia' AND destino_sjd_ref='".$sindicancia->sjd_ref."' AND destino_sjd_ref_ano='".$sindicancia->sjd_ref_ano."'";
	$resL=mysql_query($sqlL);
	$ligacoes=mysql_num_rows($resL);
}

if (!$ofendidos) $ofendidos=0;
if (!$indiciados) $indiciados=1;

?>

<script language=javascript>
function validar(form) {
	nome = document.sindicancia.sintese.value; // verifica o campo nome
	if (nome == "") { // verifica se o campo nome está vazio
	alert("Preencha o campo síntese do fato"); // mensagem exibida se o campo não for preenchido
	document.sindicancia.sintese.focus(); // coloque esse linha no script fazendo referência ao formulário e ao campo com foco //
	return false;
	}
	campo=document.getElementsByName('sindicancia[id_andamento]')[0];
	if (campo.value=="") {
		window.alert("Preencha o andamento!"); campo.focus(); return false;
	}
	
	//ANDAMENTO
	campo=document.getElementsByName('sindicancia[id_andamento]')[0];
	if (campo.value=="7") { //CONCLUIDO
		//DATA DE ABERTURA
		campo=document.getElementsByName('sindicancia[abertura_data]')[0];
		if (campo.value=="") {
			window.alert("Preencha a data de abertura!"); campo.focus(); return false;
		}
		//ENCARREGADO
		campo=document.getElementsByName('envolvido[encarregado][rg]')[0];
		if (campo.value=="") {
			window.alert("Preencha o Encarregado!"); campo.focus(); return false;
		}
		//RESULTADO DOS ENVOLVIDOS
		campo=document.getElementsByName('envolvido[1][resultado]')[0];
		nomek=document.getElementsByName('envolvido[1][nome]')[0];
		if (campo.value=="" && nomek.value!="") {
			window.alert("Preencha o resultado do Sindicado!"); campo.focus(); return false;
		}
	}
	
	
return true;
}
</script>


<form ID='sindicancia' class="controlar-modificacao" name="sindicancia" action="index.php?module=sindicancia" method=post onSubmit="return validar(this);" enctype="multipart/form-data">
<input type="hidden" name="sindicancia[id_sindicancia]">
<input type="hidden" name="sindicancia[sjd_ref]">
<input type="hidden" name="sindicancia[sjd_ref_ano]">

<!-- sindicancia -->
<?if ($opcao=="cadastrar"){?><center><h1>Nova Sindic&acirc;ncia</h1></center><?}?>
<?if ($opcao=="atualizar"){?><center><h1>Sindic&acirc;ncia</h1></center><?}?>

<table class='bordasimples' width='100%'>
	<?if ($opcao=="cadastrar"){?>
	<tr><th colspan="5" bgcolor="#DBEAF5"><font face="tahoma, verdana" size="2">Formulário de preenchimento</font></th></tr> 	<?}?>
	<?if ($opcao=="atualizar"){?>
	<tr>
		<td align="center" colspan="3" bgcolor="#DBEAF5">
		Visualização e atualização | 
		<a href="?module=movimento&movimento[id_sindicancia]=<?=$sindicancia->id_sindicancia;?>">Movimentos</a> |
		<a href="?module=sobrestamento&sobrestamento[id_sindicancia]=<?=$sindicancia->id_sindicancia;?>">Sobrestamentos</a>
		</td>
	</tr>
	<?}?>

<?

form::openTR();
	form::openTD();
		form::openLabel("Nº da sindic&acirc;ncia e Andamento");
		if ($sindicancia->sjd_ref) {
			echo "<input size='8' readonly name='numeracao' type='text' value='".$sindicancia->sjd_ref."/".$sindicancia->sjd_ref_ano."'>";
		}
		else {
			$textoForm="<input readonly name='numeracao' type='text' value='*/".$_SESSION[sjd_ano]."'>";
		}
		formulario::option("sindicancia","andamento","WHERE procedimento='sindicancia'","","",0);
		form::closeLabel();
	form::closeTD();
	openTD("colspan='2'");
		form::openLabel("Andamento COGER");
			if ($user['nivel']>=4)
				formulario::option("sindicancia","andamentocoger","WHERE procedimento='sindicancia'","","",0);
			else
				echo "&nbsp;".$sindicancia->andamentocoger->andamentocoger;
		form::closeLabel();
	closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan=3");
		$indice=0;
		if ($_SESSION['debug'])  { 
			pre($sql);
			pre("Procedimentos de origem encontrados: $total");
		}
		formulario::subform("ligacao",$ligacoes,"Procedimento(s) de Origem (apenas se houver)");
		form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='3' width='100%'");
		$opcoes="rows='4' cols='80'";
		form::input("Documentos de origem","sindicancia[doc_origem_txt]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("width='50%'");
		form::input("Data do fato","sindicancia[fato_data]");
	form::closeTD();
	form::openTD("colspan='2' width='50%'");		
		form::openLabel("OPM");
		echo "<select name='sindicancia[cdopm]' $opcaoGeral2>";
			include("includes/option_opm.php");
		echo "</select>";
		form::closeLabel();
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='3' width='100%'");
		$opcoes=" id='sintese' rows='7' cols='80' ";
		form::input("S&iacute;ntese do fato (Quem, quando, onde, como e por quê)","sindicancia[sintese_txt]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='1' width='50%'");
		form::input("N&ordm; da portaria de designa&ccedil;&atilde;o de sindicante","sindicancia[portaria_numero]","####/####");
	form::closeTD();	
	form::openTD("colspan='1' width='50%'");
		form::input("Data da portaria de designa&ccedil;&atilde;o","sindicancia[portaria_data]");
	form::closeTD();
	
	form::openTD("colspan='1' width='50%'");
		$textoForm="<select name='sindicancia[doc_tipo]' $opcaoGeral2>
			<option value=''>Escolha</option>
			<option value='BG'>BG</option>
			<option value='BI'>BI</option>
			<option value='BR'>BR</option>\r\n</select>";
		$textoForm.="&nbsp;N&ordm;&nbsp;";
		$textoForm.="<input type='text' name='sindicancia[doc_numero]' size='8' maxlength=8 onkeyup='formatar(this,\"###/####\")' $opcaoGeral2>";
		form::input("Boletim de publica&ccedil;&atilde;o da portaria","",$textoForm);
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='3'");
		form::input("Data da abertura","sindicancia[abertura_data]");
	form::closeTD();

form::closeTR();

form::openTR();
	form::openTD("colspan='2' width='50%'");
		form::input("Solu&ccedil;&atilde;o do Comandante","sindicancia[sol_cmt_file]");
	form::closeTD();
	form::openTD("colspan='1' width='50%'");
		form::input("Data da Solu&ccedil;&atilde;o","sindicancia[sol_cmt_data]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='2' width='50%'");
		if ($user["nivel"]<4) $opcoes="readonly";
		form::input("Solu&ccedil;&atilde;o do Comandante Geral","sindicancia[sol_cmtgeral_file]");
	form::closeTD();
	form::openTD("colspan='1' width='50%'");
		if ($user["nivel"]<4) $opcoes="readonly";
		form::input("Data da Solu&ccedil;&atilde;o","sindicancia[sol_cmtgeral_data]");
	form::closeTD();
form::closeTR();


?>

<TR><TD colspan=3> <!-- Main -->

<!--Encarregado e Escrivão-->
<?
if ($opcao=="atualizar") {
$encarregado=new envolvido("WHERE rg_substituto='' AND situacao='Encarregado' AND id_sindicancia='".$sindicancia->id_sindicancia."'","","simples");
$escrivao=new envolvido("WHERE rg_substituto='' AND situacao='Escrivão' AND id_sindicancia='".$sindicancia->id_sindicancia."'","","simples");
}
?>



<table border=0 width=100% class='bordacinza'>
<tr><td>

<table align=center border=0 cellpadding="0" cellspacing="1" width="100%">
	<tr><th colspan="5" bgcolor="#EEEEEE"><font face="tahoma, verdana" size="2">Membros</font></th></tr>
	<tr bgcolor=white align=center><td>RG</td><td valign="center">Nome<a 
href='http://10.47.1.8/pm/consultapm.php' target="_blank"><img border=0 src='img/lupa.gif' width="20" /></a></td><td>Posto/Graduação</td><td width='160px'>Situação</td><td>Ação</td></tr>

<?php
formEnvolvido($encarregado, "Encarregado","encarregado",false);
formEnvolvido($escrivao, "Escrivão","escrivao",false);
?>

</table>
<!-- Fim Encarregado e Escrivão -->

</TD></TR>

<TR><TD colspan=3>

<!-- Indiciados -->
	<?formulario::subform("envolvido",$indiciados,"Sindicados");?>
<!-- Fim Indiciados -->

</TD></TR>

<TR><TD colspan=3>

<!-- Ofendidos -->
        <?formulario::subform("ofendido",$ofendidos,"V&iacute;timas (Apenas se houver)");?>
<!-- Fim Ofendidos -->

</TD></TR>

<tr><td>
<?
if ($user['nivel']<>6 && $user['nivel']<>7) {
	if ($opcao=="cadastrar") echo "<input type='submit' name='acao' value='Cadastrar'>";
	if ($opcao=="atualizar" and $user[nivel]>=2) echo "<input type='submit' name='acao' value='Atualizar'>";

	if ($user['nivel']>=5 and $opcao!="cadastrar") echo "<input type='submit' name='acao' value='Apagar'>";
}
//	pre ($user);
?>
</td></tr>
</table>

</form>

<?
//Preenchimento automático formulário
if ($sindicancia) {
        formulario::values($sindicancia);

        if ($opcao=="atualizar") {

        formulario::values($encarregado,"envolvido[encarregado]");
        formulario::values($escrivao,"envolvido[escrivao]");
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

if ($user[nivel]<2) js::desativaTudo();

?>
