<?php
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

if (!$pad->sjd_ref_ano) $pad->sjd_ref_ano=$_SESSION[sjd_ano];

if ($opcao=="atualizar") {
	$sql="SELECT * FROM envolvido WHERE situacao='Presidente' AND id_pad='".$pad->id_pad."'";
	$resP=mysql_query($sql);

	//CONTA CIVIS
	$sql="SELECT * FROM ofendido WHERE situacao='Envolvido' AND id_pad='".$pad->id_pad."'";
	$resO=mysql_query($sql);
	$ofendidos=mysql_num_rows($res);
	
	//CONTA PJ
	$sql="SELECT * FROM pj WHERE id_pad='".$pad->id_pad."'";
	$resP=mysql_query($sql);
	$pjs=mysql_num_rows($res);
	
}


?>

<script language=javascript>
function validar(form) {
	nome = document.pad.sintese.value; // verifica o campo nome
	if (nome == "") { // verifica se o campo nome está vazio
	alert("Preencha o campo síntese do fato"); // mensagem exibida se o campo não for preenchido
	document.pad.sintese.focus(); // coloque esse linha no script fazendo referência ao formulário e ao campo com foco //
	return false;
	}
	campo=document.getElementsByName('pad[id_andamento]')[0];
	if (campo.value=="") {
		window.alert("Preencha o andamento!"); campo.focus(); return false;
	}
	
	//ANDAMENTO
	campo=document.getElementsByName('pad[id_andamento]')[0];
	if (campo.value=="7") { //CONCLUIDO
		//DATA DE ABERTURA
		campo=document.getElementsByName('pad[abertura_data]')[0];
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
			window.alert("Preencha o resultado do Acusado!"); campo.focus(); return false;
		}
	}
	
	
return true;
}
</script>

<br>
<form ID='pad' class="controlar-modificacao" name="pad" action="index.php?module=pad" method=post onSubmit="return validar(this);" enctype="multipart/form-data">
<input type="hidden" name="pad[id_pad]">
<input type="hidden" name="pad[sjd_ref]">
<input type="hidden" name="pad[sjd_ref_ano]">

<!-- pad -->
<?if ($opcao=="cadastrar"){?><center><h1>Novo Processo Administrativo Autonomo</h1></center><?}?>
<?if ($opcao=="atualizar"){?><center><h1>Processo Administrativo Autonomo</h1></center><?}?>

<table class='bordasimples' width='100%'>
	<?if ($opcao=="cadastrar"){?>
	<tr><th colspan="5" bgcolor="#DBEAF5"><font face="tahoma, verdana" size="2">Formulário de preenchimento</font></th></tr> 	<?}?>
	<?if ($opcao=="atualizar"){?>
	<tr>
		<td align="center" colspan="3" bgcolor="#DBEAF5">
		Visualização e atualização | 
		<a href="?module=movimento&movimento[id_pad]=<?=$pad->id_pad;?>">Movimentos</a> |
		<a href="?module=sobrestamento&sobrestamento[id_pad]=<?=$pad->id_pad;?>">Sobrestamentos</a>
		<?if ($user['nivel']==4 || $user['nivel']==5){?>
		| <a href="?module=arquivo&arquivo[id_pad]=<?=$pad->id_pad;?>">Arquivo</a>
		<?}?>
		</td>
	</tr>
	<?}?>

<?
if ($user['nivel']==4 || $user['nivel']==5)
{
	form::openTD("colspan='5'");
		echo "<hr>O Procedimento é prioritário?(só preencha se tiver certeza)
		<select name='pad[prioridade]'>
			<option value='0'>N&Atilde;O</option>
			<option value='1'>SIM</option>
		</select>
		<hr>";
	form::closeTR();
}
//
form::openTR();
	form::openTD();
		form::openLabel("Nº do PAD e Andamento");
		if ($pad->sjd_ref) {
			echo "<input size='8' readonly name='numeracao' type='text' value='".$pad->sjd_ref."/".$pad->sjd_ref_ano."'>";
		}
		else {
			$textoForm="<input readonly name='numeracao' type='text' value='*/".$_SESSION["sjd_ano"]."'>";
		}
		formulario::option("pad","andamento","WHERE procedimento='pad'","","",0);
		form::closeLabel();
	form::closeTD();
	openTD("colspan='2'");
		form::openLabel("Andamento COGER");
			if ($user['nivel']>=4)
				formulario::option("pad","andamentocoger","WHERE procedimento='pad'","","",0);
			else
				echo "&nbsp;".$pad->andamentocoger->andamentocoger;
		form::closeLabel();
	closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='3' width='100%'");
		$opcoes="rows='2' cols='80'";
		form::input("Documentos de origem","pad[doc_origem_txt]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("width='50%'");
		form::input("Data do fato","pad[fato_data]");
	form::closeTD();
	form::openTD("colspan='2' width='50%'");		
		form::openLabel("OPM");
		echo "<select name='pad[cdopm]' $opcaoGeral2>";
			include("includes/option_opm.php");
		echo "</select>";
		form::closeLabel();
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='3' width='100%'");
		$opcoes=" id='sintese' rows='7' cols='80' ";
		form::input("S&iacute;ntese do fato (Quem, quando, onde, como e por quê)","pad[sintese_txt]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='1' width='50%'");
		form::input("N&ordm; da portaria de designa&ccedil;&atilde;o","pad[portaria_numero]","####/####");
	form::closeTD();	
	form::openTD("colspan='1' width='50%'");
		form::input("Data da portaria de designa&ccedil;&atilde;o","pad[portaria_data]");
	form::closeTD();
	
	form::openTD("colspan='1' width='50%'");
		$textoForm="<select name='pad[doc_tipo]' $opcaoGeral2>
			<option value=''>Escolha</option>
			<option value='BG'>BG</option>
			<option value='BI'>BI</option>
			<option value='BR'>BR</option>\r\n</select>";
		$textoForm.="&nbsp;N&ordm;&nbsp;";
		$textoForm.="<input type='text' name='pad[doc_numero]' size='8' maxlength=8 onkeyup='formatar(this,\"###/####\")' $opcaoGeral2>";
		form::input("Boletim de publica&ccedil;&atilde;o da portaria","",$textoForm);
	form::closeTD();
closeTR();
openTR();
	form::openTD("colspan='3'");
		form::input("Data da abertura","pad[abertura_data]");
	form::closeTD();

form::closeTR();

form::openTR();
	form::openTD("colspan='1'");
		form::input("Relatorio","pad[relatorio_file]");
	form::closeTD();

	form::openTD("colspan='2'");
		form::input("Solucao","pad[solucao_file]");
	form::closeTD();

form::closeTR();


?>

<TR><TD colspan=3> <!-- Main -->

<!--Encarregado e Escrivão-->
<?
if ($opcao=="atualizar") {
$encarregado=new envolvido("WHERE rg_substituto='' AND situacao='Presidente' AND id_pad='".$pad->id_pad."'","","simples");
//$membro=new envolvido("WHERE rg_substituto='' AND situacao='Escrivão' AND id_pad='".$pad->id_pad."'","","simples");
}
?>



<table border=0 width=100% class='bordacinza'>
<tr><td>

<table align=center border=0 cellpadding="0" cellspacing="1" width="100%">
	<tr><td	colspan="5" bgcolor="#EEEEEE"><font face="tahoma, verdana" size="2"><b>Membros</b></font></td></tr>
	<tr bgcolor=white align=center><td>RG</td>
	<td valign="center">Nome<a href='http://10.47.1.8/pm/consultapm.php' target="_blank">
	<img border=0 src='img/lupa.gif' width="20" /></a></td><td>Posto/Graduação</td><td width='160px'>Situação</td><td>Ação</td></tr>

<?php
formEnvolvido($encarregado, "'Presidente'","encarregado",false);

formEnvolvido($encarregado, "'Membro'","membroa",false);
formEnvolvido($encarregado, "'Membro'","membrob",false);

closeTable();

openLine(6);
	//echo "<b><font face=\"tahoma, verdana\" size=\"2\">Pessoas f&iacute;sicas envolvidas</font></b>";
	formulario::subform("ofendido",$ofendidos,"Civis envolvidos (Pessoa f&iacute;sica, Apenas se houver)");
	
closeLine();


openLine(6);
	$indice=1;
	formulario::subform("pj",$pjs,"Pessoas juridicas envolvidas");
closeLine();

closeTable();

closeTD();
closeTR();

openTR(); openTD();

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
if ($pad) {
        formulario::values($pad);

		
		
		
        if ($opcao=="atualizar") {
			formulario::values($encarregado,"envolvido[encarregado]");
			
			//Preenche os membros
			$sql="SELECT * FROM envolvido WHERE rg_substituto='' AND situacao='Membro' and id_pad='".$pad->id_pad."'";
			$res=mysql_query($sql);
			$membroa=mysql_fetch_assoc($res);
			$membrob=mysql_fetch_assoc($res);
			
			formulario::values($membroa,"envolvido[membroa]");
			formulario::values($membrob,"envolvido[membrob]");
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
		//Preenche as PJ
		$i=1;
        while  ($row=@mysql_fetch_assoc($resP)) {
                formulario::values($row,"pj[$i]");
                $i++;
        }
	
}

if ($user[nivel]<2) js::desativaTudo();

?>
