<?php
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco
if ($user["nivel"] < 2 or ($ipm->andamento->id_andamento=="5" and $user['nivel']<4)) $opcaoGeral="readonly";

//pre($ipm);

if (!$ipm->opm_sigla) $ipm->opm_sigla=$login_unidade;
if (!$ipm->opm_ref) $ipm->opm_sigla=$login_unidade;
if (!$ipm->opm_ref_ano) $ipm->opm_ref_ano=$_SESSION[sjd_ano];
if (!$ipm->sjd_ref_ano) $ipm->sjd_ref_ano=$_SESSION[sjd_ano];

//Cria resultados SQL com os ofendidos e envolvidos ligados ao IPM
if ($opcao=="atualizar") {
$sql="SELECT * FROM envolvido WHERE situacao='Indiciado' AND id_ipm='".$ipm->id_ipm."'";
$resI=mysql_query($sql);
if ($resI) $indiciados=mysql_num_rows($resI);
$sql="SELECT * FROM ofendido WHERE situacao='Ofendido' AND id_ipm='".$ipm->id_ipm."'";
$resO=mysql_query($sql);
if ($resO) $ofendidos=mysql_num_rows($resO);

//ligacoes
$sqlL="SELECT * FROM ligacao WHERE destino_proc='ipm' AND destino_sjd_ref='".$ipm->sjd_ref."' AND destino_sjd_ref_ano='".$ipm->sjd_ref_ano."'";
$resL=mysql_query($sqlL);
$ligacoes=mysql_num_rows($resL);
//pre($sqlL);
}

$required = ($opcao=="atualizar") ? "required='true'" : "";

if (!$ofendidos) $ofendidos=0;
if (!$indiciados) $indiciados=1;

?>

<script language=javascript>
function validar(form) {
	//Sintese
	campo=document.getElementsByName('ipm[sintese_txt]')[0];
	if (campo.value=="") {
		window.alert("Preencha a sintese do fato!"); campo.focus(); return false;
	}

	//Andamento	
	campo=document.getElementsByName('ipm[id_andamento]')[0];
	if (campo.value=="") {
		window.alert("Preencha o andamento!"); campo.focus(); return false;
	}
	
	//Municipio
	campo=document.getElementsByName('ipm[id_municipio]')[0];
	if (campo.value=="") {
		window.alert("Preencha o Municipio!"); campo.focus(); return false;
	}
	
	//OPM
	campo=document.getElementsByName('ipm[cdopm]')[0];
	if (campo.value=="") {
		window.alert("O campo OPM esta em branco!"); campo.focus(); return false;
	}
	// EPROC
	campo=document.getElementsByName('ipm[n_eproc]')[0];
	if (campo.value=="0") {
		window.alert("Insira o numero do EPROC"); campo.focus(); return false;
	}
	campo=document.getElementsByName('ipm[ano_eproc]')[0];
	if (campo.value=="0") {
		window.alert("Insira o ano do EPROC"); campo.focus(); return false;
	}

	
	//SE ESTIVER CONCLUIDO
	campo=document.getElementsByName('ipm[id_andamento]')[0];
	if (campo.value=="5") { //CONCLUIDO
		//ENCARREGADO
		campo=document.getElementsByName('envolvido[encarregado][rg]')[0];
		if (campo.value=="") {
			window.alert("Preencha o encarregado!"); campo.focus(); return false;
		}
		//ESCRIVAO
		campo=document.getElementsByName('envolvido[escrivao][rg]')[0];
		if (campo.value=="") {
			window.alert("Preencha o escrivao!"); campo.focus(); return false;
		}
		//AUTUACAO_DATA
		campo=document.getElementsByName('ipm[autuacao_data]')[0];
		if (campo.value=="") {
			window.alert("Para marcar o IPM como CONCLUIDO, e obrigatorio o preenchimento da DATA DA PORTARIA DE INSTAURACAO!"); campo.focus(); return false;
		}
		//RELATO_ENC_FILE
		if (isdefined(document.getElementsByName('relato_enc_file')[0])) {
			campo=document.getElementsByName('relato_enc_file')[0];
			if (campo.value=="") {
				window.alert("Para marcar o IPM como CONCLUIDO, e obrigatorio o preenchimento do RELATORIO DO ENCARREGADO!"); campo.focus(); return false;
			}
		}
		//relato_cmtopm_file
		if (isdefined(document.getElementsByName('ipm[relato_cmtopm_file]')[0])) {
			campo=document.getElementsByName('ipm[relato_cmtopm_file]')[0];
			campoopm=document.getElementsByName('ipm[cdopm]')[0];
			if (campo.value=="" && campoopm.value!="0") {
				window.alert("Para marcar o IPM como CONCLUIDO, e obrigatorio o preenchimento do RELATORIO DO CMT DA OPM!"); campo.focus(); return false;
			}
		}
		//TENTADO/CONSUMADO
		campo=document.getElementsByName('ipm[tentado]')[0];
		if (campo.value=="") {
			window.alert("Preencha se o crime foi TENTADO ou CONSUMADO!"); campo.focus(); return false;
		}

		//data do fato
		campo=document.getElementsByName('ipm[fato_data]')[0];
		if (campo.value=="") {
			window.alert("Preencha a data do fato!"); campo.focus(); return false;
		}

		//data do fato
		campo=document.getElementsByName('ipm[id_situacao]')[0];
		if (campo.value=="" && (<?php echo $ipm->sjd_ref_ano >= 2016 ? "true" : "false"; ?>)) {
			window.alert("Preencha a situacao (Em servico ou fora de servico)!"); campo.focus(); return false;
		}
		
		//RESULTADO DOS ENVOLVIDOS
		campo=document.getElementsByName('envolvido[1][resultado]')[0];
		nomek=document.getElementsByName('envolvido[1][nome]')[0];
		if (campo.value=="" && nomek.value!="") {
			window.alert("Preencha o resultado do Indiciado!"); campo.focus(); return false;
		}
	}//END IF CONCLUIDO
	
	//SE TIVER OFENDIDO OBRIGATORIO NOME E RESULTADO. PEDIDO CAPITAO HEITOR
	var numeroOfendidos=0;

	for (zcont=1; zcont<=4; zcont++) {
		//window.alert(zcont.toString()); //debug

		if (isdefined(document.getElementsByName('ofendido['+zcont.toString()+'][idade]')[0])) {

			numeroOfendidos++; //Isso eh para a proxima verificacao, no caso de homicidio e lesao corporal tem que ter no minimo 1
			//window.alert('Ofendido');
			//verifica nome do ofendido
			campo=document.getElementsByName('ofendido['+zcont.toString()+'][nome]')[0];
			if (campo.value=="") {
				window.alert("Preencha o nome do Ofendido nº!"+zcont.toString()); campo.focus(); return false;
			}
			//verifica o resultado
			campo=document.getElementsByName('ofendido['+zcont.toString()+'][resultado]')[0];
			if (campo.value=="NA") {
				window.alert("Preencha o resultado do Ofendido nº!"+zcont.toString()); campo.focus(); return false;
			}
			//verifica o sexo
			campo=document.getElementsByName('ofendido['+zcont.toString()+'][sexo]')[0];
			if (campo.value=="") {
				window.alert("Preencha o sexo do Ofendido nº!"+zcont.toString()); campo.focus(); return false;
			}

		}

	}//for zcont

/*
	//Se for homicidio ou lesao corporal, obrigatorio no minimo 1 ofendido
	if (document.getElementById('crime').value=="Homicidio" || document.getElementById("crime").value=="Lesao Corporal") {
		//window.alert("Homicidio ou lesao"); 
		if (numeroOfendidos<1) { window.alert("Para os crimes de homicidio e Lesao Corporal, obrigatorio preencher no minimo 1 ofendido."); return false; }
		
	} //homicidio e lesao
*/
	
	//Data futura

return true;
}
// -->
</script>

<form class="controlar-modificacao" ID='ipm' name="ipm" action="index.php?module=ipm" method=post onSubmit="return validar(this);" enctype='multipart/form-data'>

<input type="hidden" name="ipm[id_ipm]">
<input type="hidden" name="ipm[opm_sigla]">
<input type="hidden" name="ipm[opm_ref]">
<input type="hidden" name="ipm[opm_ref_ano]">
<input type="hidden" name="ipm[sjd_ref]">
<input type="hidden" name="ipm[sjd_ref_ano]">

<!-- IPM -->
<?if ($opcao=="cadastrar"){?><center><h1>Novo Inqu&eacute;rito Policial Militar</h1></center><?}?>
<?if ($opcao=="atualizar"){?><center><h1>Inqu&eacute;rito Policial Militar</h1></center><?}?>

<table class='bordasimples' cellspacing="1" width="100%" border="0">
	<?if ($opcao=="cadastrar"){?>
	<tr><th colspan="5"><h2>Formulário de preenchimento</h2></td></tr>
	<?}?>
	<?if ($opcao=="atualizar"){?>
	<tr>
		<td align="center" colspan="5" bgcolor="#DBEAF5">
		Visualização e atualização |
		<a href="?module=movimento&movimento[id_ipm]=<?=$ipm->id_ipm;?>">Movimentos</a> |
		<a href="?module=envolvido&opcao=indiciado&ipm[id]=<?=$ipm->id_ipm;?>">R&eacute;u(s)</a> |
        <a href="?module=subscription&tipo_processo=ipm&id_processo=<?=$ipm->id_ipm;?>">Acompanhamento</a>
        <?if ($user['nivel']==4 || $user['nivel']==5){?>
        | <a href="?module=arquivo&arquivo[id_ipm]=<?=$ipm->id_ipm;?>">Arquivo</a>
        <?}?>
		</td>
	</tr>
	<?}?>

	<tr>
		<td bgcolor="#ffffff" valign="top">

		<?php
		//echo "<table width='100%'>";
		form ::openTR();
//			form::openTR();

		//Deixar procedimento como prioritário
		if ($user['nivel']==4 || $user['nivel']==5)
		{
			form::openTD("colspan='5'");
				echo "<hr>O Procedimento é prioritário?(só preencha se tiver certeza)
				<select name='ipm[prioridade]'>
					<option value='0'>N&Atilde;O</option>
					<option value='1'>SIM</option>
				</select>
				<hr>";
			form::closeTR();
		}
		//
			form::openTD("colspan='2'");
				form::openLabel("Andamento");
					formulario::option("ipm","andamento","WHERE procedimento='ipm'","","",0);
				form::closeLabel();
			form::closeTD();

			form::openTD("width='50%' colspan='3'");
				form::openLabel("N&ordm; e Andamento (COGER)");
					if ($ipm->sjd_ref)
						echo $ipm->sjd_ref."/".$ipm->sjd_ref_ano;
					else
						echo "*/".$_SESSION["sjd_ano"];
						
					//echo "<select>";
					if ($user['nivel']>=4) {
						formulario::option("ipm","andamentocoger","WHERE procedimento='ipm' ORDER BY id_andamentocoger","","",0);
					}
					else {
						echo "-".$ipm->andamentocoger->andamentocoger;
					}
					//echo "</select>";
				form::closeLabel();
			form::closeTD();

		form::closeTR();

	form::openTR();
		form::openTD("colspan='5'");
			$indice=0;
			if ($_SESSION['debug'])  { 
				pre($sqlL);
				pre("Procedimentos de origem encontrados: $total");
			}
			formulario::subform("ligacao",$ligacoes,"Procedimento(s) de Origem (IPM, sindicancia, etc.)");
			form::closeTD();
	form::closeTR();		
		
		form::openTR();
			openTD();
				form::openLabel("OPM");
				echo "<select name='ipm[cdopm]'>";
					include("includes/option_opm.php");
				echo "</select>";
				form::closeLabel();
			closeTD();

			form::openTD("colspan='2'");
				form::input("Data do fato", "ipm[fato_data]");
			form::closeTD();
			form::openTD("colspan='2'");
				form::input("Data da portaria de delega&ccedil;&atilde;o de poderes","ipm[abertura_data]");
			form::closeTD();


		form::closeTR();

		form::openTR();
			form::openTD("colspan='2'");
				form::input("Data da portaria de instaura&ccedil;&atilde;o", "ipm[autuacao_data]");
			form::closeTD();
			form::openTD("colspan='3'");
				form::openLabel("N&ordm; da portaria de delega&ccedil;&atilde;o de poderes");
				echo "<input $opcaoGeral name='ipm[portaria_numero]' type='text' size='9' maxlength='9' onkeyup=\"formatar(this,'####/####')\">";
				echo "<font color='red'>(Ex: 0120/2010)</font>";
				form::closeLabel();
			form::closeTD();
		form::closeTR();
			
		form::openTR();
			form::openTD("colspan='2'");
				form::openLabel("Motivo da abertura (crime)");
					echo "<select id='crime' name='ipm[crime]'>";
					include ("includes/option_crime.html");
					echo "</select>";
					echo "<select name='ipm[tentado]'><option value=''>Selecione</option><option>Tentado</option><option>Consumado</option></select>";
					
				form::closeLabel();
			form::closeTD();
			
			form::openTD("colspan='3'");
				$opcoes=" size='32' maxlength='45' ";
				form::input("Especificar (no caso de o crime n&atilde;o constar na lista)","ipm[crime_especificar]");
			form::closeTD();
		form::closeTR();
		
		form::openTR(" rel='confronto' class='question' ");
			form::openTD("colspan='2'");
				form::openLabel("V&iacute;tima do crime");
				echo "<select name='ipm[vitima]'>";
					echo "<option value='Civil'>Civil</option>";
					echo "<option value='Policial Militar'>Policial Militar</option>";
					echo "<option value='Civil e Militar'>Civil e Militar</option>";
				echo "</select>";
				form::closeLabel();
			form::closeTD();
			form::openTD("colspan='3'");
				$texto="Tanto o individuo como o militar estadual efetuaram disparo(s) de arma de fogo.";

				form::openLabel("Confronto armado [<a href='#none' title='$texto'>?</a>]");
				echo "<input type='checkbox' name='ipm[confronto_armado_bl]'>";
				echo "Marque essa caixa se houve confronto armado.";
				form::closeLabel();
			form::closeTD();
		form::closeTR();

		openTR();
			openTD("colspan='3'");
				form::openLabel("Situa&ccedil;&atilde;o");
					formulario::option("ipm","situacao","","","",0);
				form::closeLabel();
			closeTD();


			openTD("colspan='2'");
				form::openLabel("Cidade do fato");
					formulario::option("ipm","municipio","","","",0);
				form::closeLabel();
			closeTD();
		closeTR();

		openTR();
			openTD();
				form::openLabel("BOU (Boletim de Ocorr&ecirc;ncia Unificado)");
					echo "Ano: ";			
					echo "<select name='ipm[bou_ano]'>\r\n";
						for ($i=2005;$i<=date("Y");$i++) {
							echo "<option>$i</option>";
						}
					echo "</select>  N&ordm;";
					echo "<input name='ipm[bou_numero]' type='text' size='7' maxlength='7' onkeypress='return dntr(this, event);'>";
				form::closeLabel();
			closeTD();

			openTD();
				form::openLabel("EPROC");
					echo "N&ordm;: ";			
					echo "<input name='ipm[n_eproc]' type='text' size='7' $required>\r\n";
					echo "Ano:<input name='ipm[ano_eproc]' type='text' size='7' $required maxlength='7'>";
				form::closeLabel();
			closeTD();
		closeTR();

		form::openTR();
			form::openTD("colspan='5' width='100%'");
				$opcoes=" rows='7' cols='80' ";
				form::input("S&iacute;ntese do fato (Quem, quando, onde, como e por quê)","ipm[sintese_txt]");
			form::closeTD();
		form::closeTR();

		form::openTR();
			form::openTD("colspan='5'");
				$opcoes=" size='60' ";
				form::input("Conclus&atilde;o do encarregado","ipm[relato_enc]");
			form::closeTD();
		form::closeTR();

		form::openTR();
			form::openTD("colspan='3'");
				form::input("PDF - Conclus&atilde;o do encarregado","ipm[relato_enc_file]");
			form::closeTD();
			form::openTD("colspan='2'");
				form::input("Data","ipm[relato_enc_data]");
			form::closeTD();
		form::closeTR();

		form::openTR();
			form::openTD("colspan='5'");
				$opcoes=" size='60' ";
				form::input("Solu&ccedil;&atilde;o do Cmt OPM","ipm[relato_cmtopm]");
			form::closeTD();
		form::closeTR();

		form::openTR();
			form::openTD("colspan='3'");
				$opcoes=" size='40' ";
				form::input("PDF - Solu&ccedil;&atilde;o do Cmt OPM","ipm[relato_cmtopm_file]");
			form::closeTD();
			form::openTD("colspan='2'");
				form::input("Data","ipm[relato_cmtopm_data]");
			form::closeTD();
		form::closeTR();

		form::openTR();
			form::openTD("colspan='5'");
				$opcoes=" size='60' ";
				if ($_SESSION["user"]["nivel"]<4) $opcoes=" readonly='true' size='60'";
				form::input("Decis&atilde;o do Cmt Geral","ipm[relato_cmtgeral]");
			form::closeTD();
		form::closeTR();

		form::openTR();
			form::openTD("colspan='3'");
				if ($_SESSION["user"]["nivel"]<4) $opcoes=" readonly='true' size='40'";
				else $opcoes=" size='40'";
				form::input("PDF - Decis&atilde;o do Cmt Geral","ipm[relato_cmtgeral_file]");
			form::closeTD();
			form::openTD("colspan='2'");
				if ($_SESSION["user"]["nivel"]<4) $opcoes="readonly";
				form::input("Data","ipm[relato_cmtgeral_data]");
			form::closeTD();
		form::closeTR();

		openTR();
			openTD("colspan='3'");
				form::input("Relat&oacute;rio complementar","ipm[relcomplementar_file]");
			form::openTD("colspan='2'");
				form::input("Data","ipm[relcomplementar_data]");
			form::closeTD();
			closeTD();
		closeTR();
		//echo "</table>";
			
if ($opcao=="atualizar") {
$encarregado=new envolvido("WHERE rg_substituto='' AND situacao='Encarregado' and id_ipm='".$ipm->id_ipm."'","","simples");
$escrivao=new envolvido("WHERE rg_substituto='' AND situacao='Escrivao' and id_ipm='".$ipm->id_ipm."'","","simples");
}

?>

<!-- coluna para enc e escriavao -->
<tr><td colspan='5'>

<table class='bordacinza' width='100%'>
<tr><td bgcolor='#F0F0F0' colspan="5"><b>Encarregado e Escriv&atilde;o</b></td></tr>
<tr bgcolor=white align=center><td>RG</td><td valign="center">Nome</td><td>Posto/Graduação</td><td width='160px'>Situação</td><td>Ação</td></tr>

<?php
formEnvolvido($encarregado, "Encarregado","encarregado",false);
formEnvolvido($escrivao, "Escrivão","escrivao",false);
?>

</table>

</td></tr>
<!-- fim coluna para enc e escriavao -->

<tr><td colspan='5'>
	<?php
	formulario::subform("envolvido",$indiciados,"Indiciados");
	?>
</td></tr>

<tr bgcolor='white'>
	<td colspan='5'>
		<?php $indice=1;
		formulario::subform("ofendido",$ofendidos,"Ofendidos (Apenas se houver)");
		?>
	</td>
</tr>


<!--
</table>

<br>
<table width='100%' class='bordasimples'>	
-->

<?php
if ($opcaoGeral=="readonly") js::desativaTudo();
	//include("includes/frm_defensor.php");
	unset($opcoes);
	unset($opcaoGeral);
	if ($user["nivel"] < 2 or ($ipm->andamento->id_andamento=="5" and $user['nivel']<4)) $opcaoGeral="readonly";
	openTR();
		openTD("colspan='2'");
			form::input("Referência da Vajme (Nº do processo, vara)","ipm[vajme_ref]");
		closeTD();
		openTD("colspan='3'");
		/*
		//Descontinuado dia 14/07.
		openTD("colspan='2'");
			form::openLabel("Julgamento");
			?>
			<select name="ipm[julgamento]">
			<option value="">Escolha se necessário</option>
			<option value="Condenado">Condenado</option>
			<option value="Absolvido">Absolvido</option>
			</select>
			<?php
			form::closeLabel();
		*/
		if ($user['nivel']<4) {
			if ($ipm->andamentocoger->andamentocoger=="JUSTICA COMUM")
				$opcaoGeral=""; else $opcaoGeral="readonly";
		}
		form::input("Referência da Justiça Comum (Nº do processo, vara)","ipm[justicacomum_ref]");
		
		closeTD();
		
	closeTR();
	openTR();
		openTD("colspan=4");
			if ($user['nivel']<>6 && $user['nivel']<>7)  {
				if ($user["nivel"]>=2) {
					echo "<input type=submit name='acao' value='".ucwords($opcao)."'> ";
				}
				if ($user[nivel]>=5 and $ipm->id_ipm)
					echo "<input type=submit name='opcao' value='Apagar'>";
			}
		closeTD();
	closeTR();
closeTable();
?>



</td></tr></table>
<!-- Fim detalhes -->


</form>
<?
//Preenchimento automático formulário
if ($ipm) {
	formulario::values($ipm);
	if ($opcao=="atualizar") {
		$encarregado=new envolvido("WHERE situacao='Encarregado' AND id_ipm='".$ipm->id_ipm."'","","simples");
		$escrivao=new envolvido("WHERE situacao='Escrivão' AND id_ipm='".$ipm->id_ipm."'","","simples");
		//arquivo
		$arquivos=new arquivo("WHERE id_ipm='".$ipm->id_ipm."'","","simples");
		formulario::values($vetorArquivo,"arquivo");

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
//Regras de negócio específicas
	//O encarregado e o escrivão são exibidos primeiro.
	
if ($user["nivel"]==1) {
?>

<script language='javascript'>
	var inputs = document.getElementsByTagName('input');
	for (var c=0; c< inputs.length; c++) {
		if (inputs[c].type=="text" || inputs[c].type=="checkbox") {
			inputs[c].readOnly=true;
		}
	}
	var inputs = document.getElementsByTagName('select');
	for (var c=0; c< inputs.length; c++) {
		//if (inputs[c].type=="text") {
			inputs[c].disabled=true;
//		}
	}
</script>
<?php } ?>
