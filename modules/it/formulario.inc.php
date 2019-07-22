<?php
echo "<?php opcache_reset(); ?>";
include_once("controle_acesso.php");

system("chmod -R 775 /var/www/protocolo"); 

if (!$it->sjd_ref_ano) $it->sjd_ref_ano=$_SESSION[sjd_ano];

if ($it->id_it) {
	$sql="SELECT * FROM envolvido WHERE situacao='Condutor' AND id_it='".$it->id_it."'";
	if ($_SESSION[debug]) echo $sql;
	$resI=mysql_query($sql);
	if ($resI) $indiciados=mysql_num_rows($resI);
	$sql="SELECT * FROM ofendido WHERE situacao='Condutor Civil' AND id_it='".$it->id_it."'";
	if ($_SESSION[debug]) echo $sql;
	$resO=mysql_query($sql);
	if ($resO) $ofendidos=mysql_num_rows($resO);
}
if (!$ofendidos) $ofendidos=0;
if (!$indiciados) $indiciados=1;

//definição do objeto do IT
if ($opcao=="atualizar") {
	$result = mysql_query("SELECT objetoprocedimento FROM sjd.it WHERE id_it='$it->id_it'");
$objetoprocedimento = mysql_result($result, 0);
}

?>

<script language=javascript>
function validar(form) {
	campo=document.getElementsByName('it[id_andamento]')[0];
	if (campo.value=="") {
		window.alert("Preencha o andamento!"); campo.focus(); return false;
	}
	campo=document.getElementsByName('it[cdopm]')[0];
	if (campo.value=="") {
		window.alert("Preencha a OPM!"); campo.focus(); return false;
	}
	campo=document.getElementsByName('it[fato_data]')[0];
	if (campo.value=="") {
		window.alert("Preencha a Data do fato!"); campo.focus(); return false;
	}
	campo=document.getElementsByName('objetoprocedimento[objetoprocedimento]')[0];
	if (campo.value=="") {
		window.alert("Preencha o objeto do procedimento"); campo.focus(); return false;
	}
	/*campo=document.getElementsByName('it[cdopm]')[0];
	if (campo.value=="") {
		window.alert("Preencha a OPM!"); campo.focus(); return false;
	}*/
function confirmar() {
	if (window.confirm("Tem certeza?")) return true;
	else return false;
}
</script>

<form ID='it' class="controlar-modificacao" name="it" action="index.php?module=it" method=post onSubmit="return validar(this);" enctype='multipart/form-data'>
	<input type="hidden" name="it[id_it]">
	<input type="hidden" name="it[sjd_ref]">
	<input type="hidden" name="it[sjd_ref_ano]">

<!-- it -->
<?php if ($opcao=="cadastrar"){?><center><h1>Novo Inquérito Técnico</h1></center><?}?>
<?php if ($opcao=="atualizar"){?><center><h1>Inquérito Técnico</h1></center><?}?>

<table class='bordasimples' width='100%'>
	<?if ($opcao=="cadastrar"){?>
	<tr>
		<th colspan="5" bgcolor="#DBEAF5">
			<font face="tahoma, verdana" size="2">Formulário de preenchimento</font>
		</th>
	</tr>
	<?php } ?>

	<?php if ($opcao=="atualizar"){?>
	<tr>
		<td align="center" colspan="3" bgcolor="#DBEAF5">
		Visualização e atualização | 
		<a href="?module=movimento&movimento[id_it]=<?=$it->id_it;?>">Movimentos</a> |
		<a href="?module=sobrestamento&sobrestamento[id_it]=<?=$it->id_it;?>">Sobrestamentos</a>
		<?if ($user['nivel']==4 || $user['nivel']==5){?>
		| <a href="?module=arquivo&arquivo[id_it]=<?=$it->id_it;?>">Arquivo</a>
		<?}?>
		</td>
	</tr>
	<?}?>
</tr>
<?php
if ($opcao=="atualizar")
{
	//caso esteja com sobrestamento sem data de término
	$sql="SELECT * FROM sobrestamento WHERE id_it='".$it->id_it."' AND termino_data='0000-00-00'";
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
		<select name='it[prioridade]'>
			<option value='0'>N&Atilde;O</option>
			<option value='1'>SIM</option>
		</select>
		<hr>";
	form::closeTR();
}
//
form::openTR();
	form::openTD("width='50%' colspan=1");
		form::openLabel("N do IT e andamento");
			if ($it->sjd_ref) {
				echo "<input readonly name='numeracao' type='text' value='".$it->sjd_ref."/".$it->sjd_ref_ano."'>";
			}
			else {
				echo "<input readonly name='numeracao' type='text' value='*/".$_SESSION[sjd_ano]."'>";
			}
			formulario::option("it","andamento","WHERE procedimento='it'","",0,0);
		form::closeLabel();
	form::closeTD();
	openTD("colspan='2'");
		form::openLabel("Andamento COGER");
			if ($acesso_liberado) {
				formulario::option("it","andamentocoger","WHERE procedimento='it'","",0,0);
			}
			else {
				//echo "<input readonly name='it[andamentocoger]'>";
			}
		form::closeLabel();
		
	closeTD();

form::closeTR();

form::openTR();
	form::openTD("width='50%' colspan='1'");
		form::openLabel("OPM");
			/*echo "<select id='foco' name='it[cdopm]' $opcaoGeral2>";
				//gambiarra, erro: quando a DAL mexe (nivel 3) o option muda automaticamente para DAL.
				$nivelatual=$user['nivel'];
				$user['nivel']=4;
				include ("includes/option_opm.php");
				$user['nivel']=$nivelatual;
			echo "</select>";
			*/
		if ($user['nivel']>=4) {
			echo "<select id='foco' name='it[cdopm]' $opcaoGeral2>";
				include ("includes/option_opm.php");
			echo "</select>";
		}else{
			echo "<input tipe='text' value='$opm_login->codigoBase' name='it[cdopm]' readonly='true' hidden='true'>";
			echo "<input tipe='text' value='$opm_login->abreviatura' readonly='true'>";
			/*form::input("Data da abertura","it[cdopm]");*/
		}	
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::inputRequired("Data do fato","it[fato_data]");
	form::closeTD();
	form::openTD();
		form::input("Data da abertura","it[abertura_data]");
	form::closeTD();
form::closeTR();

//objeto procedimento do it
if ($opcao=="cadastrar") {
form::openTR();
	form::openTD("width='50%'");
	form::openLabel("Objeto do procedimento");
		formulario::optionAlterada("it","objetoprocedimento","WHERE procedimento='it'", " required='true'" ,0,0);
	form::closeLabel();
	form::closeTD();

	//viatura

	form::openTD("style='colspan:1; display:' id='viatura1'");
		form::input("Placa da viatura (sem tra&ccedil;o)","it[vtr_placa]");
	form::closeTD();
	form::openTD("style='colspan:1; display:' id='viatura2'");
		form::input("Prefixo da viatura","it[vtr_prefixo]");
	form::closeTD();

	//arma

	form::openTD("style='display:none' colspan='2' id='arma'");
		form::input("Número de patrimônio","it[identificacao_arma]");
	form::closeTD();

	//munição

	form::openTD("style='display:none' colspan='2' id='municao'");
		form::input("Lote (se houver) ou quantidade","it[identificacao_municao]");
	form::closeTD();

	//semovente

	form::openTD("style='display:none' colspan='2' id='semovente'");
		form::input("Identificação do semovente","it[identificacao_semovente]");
	form::closeTD();

	//outros

	form::openTD("style='display:none' colspan='2' id='outros'");
		form::input("Outros","it[outros]");
	form::closeTD();

form::closeTR();
}

if ($opcao=="atualizar") {

	switch ($objetoprocedimento) {
		case 'viatura':
		form::openTR();
			form::openTD("style='colspan:1; display:'");
				form::input("Objeto do procedimento","it[objetoprocedimento]\" readonly=\"true");
			form::closeTD();
			form::openTD("style='colspan:1; display:' id='viatura1'");
				form::input("Placa da viatura (sem tra&ccedil;o)","it[vtr_placa]");
			form::closeTD();
			form::openTD("style='colspan:1; display:' id='viatura2'");
				form::input("Prefixo da viatura","it[vtr_prefixo]");
			form::closeTD();
		form::closeTR();
		break;
		case 'arma':
		form::openTR();
			form::openTD("style='colspan:1; display:'");
				form::input("Objeto do procedimento","it[objetoprocedimento]\" readonly=\"true");
			form::closeTD();
			form::openTD("style='display:' colspan='2' id='arma'");
				form::input("Número de patrimônio","it[identificacao_arma]");
			form::closeTD();
		form::closeTR();
		break;
		case 'municao':
		form::openTR();
			form::openTD("style='colspan:1; display:'");
				form::input("Objeto do procedimento","it[objetoprocedimento]\" readonly=\"true");
			form::closeTD();
			form::openTD("style='display:' colspan='2' id='municao'");
				form::input("Lote (se houver) ou quantidade","it[identificacao_municao]");
			form::closeTD();
		form::closeTR();
		break;
		case 'semovente':
		form::openTR();
			form::openTD("style='colspan:1; display:'");
				form::input("Objeto do procedimento","it[objetoprocedimento]\" readonly=\"true");
			form::closeTD();
			form::openTD("style='display:' colspan='2' id='semovente'");
				form::input("Identificação do semovente","it[identificacao_semovente]");
			form::closeTD();
		form::closeTR();
		break;
		case 'outros':
		form::openTR();
			form::openTD("style='colspan:1; display:'");
				form::input("Objeto do procedimento","it[objetoprocedimento]\" readonly=\"true");
			form::closeTD();
			form::openTD("style='display:' colspan='2' id='outros'");
				form::input("Outros","it[outros]");
			form::closeTD();
		form::closeTR();
		break;
		
		default:
			echo "Erro na Query";
			break;
	}
}
//fim do objeto procedimento do it
form::openTR();
	form::openTD("width='50%'");
		form::input("Portaria de instaura&ccedil;&atilde;o da OPM","it[portaria_numero]","####/####");
	form::closeTD();
	form::openTD("colspan='2'");
		form::openLabel("Boletim Interno da publica&ccedil;&atilde;o");
			echo "<input type='text' size='8' name='it[boletiminterno_numero]' onkeyup='formatar(this,\"###/####\")' $opcaoGeral2>";
			echo "de";
			formulario::data("it","boletiminterno_data");
		form::closeLabel();
	form::closeTD();
form::closeTR();

//opções caso viatura
if ($opcao=="cadastrar") {
	form::openTR("style='display:' id='viatura3'");
		form::openTD("colspan='1' width='50%'");
						/*form::openLabel("Tipo do acidente");
				formulario::option("it","tipo_acidente","WHERE procedimento='it'",0,0);
			form::closeLabel();*/
		$textoForm="<select name=it[tipo_acidente] $opcaoGeral2>
		<option value='-'>-</option>
		<option value='nao identificado'>Não identificado</option>
		<option value='abalroamento lateral'>Abalroamento lateral</option>
		<option value='abalroamento transversal'>Abalroamento transversal</option>
		<option value='atropelamento'>Atropelamento</option>
		<option value='atropelamento de animal'>Atropelamento de animal</option>
		<option value='capotamento'>Capotamento</option>
		<option value='colisao frontal'>Colisão frontal</option>
		<option value='colisao traseira'>Colisão traseira</option>
		<option value='choque'>Choque</option>
		<option value='engavetamento'>Engavetamento</option>
		<option value='incendio'>Incêndio</option>
		<option value='queda de passageiro'>Queda de passageiro</option>
		<option value='queda de objeto'>Queda de objeto</option>
		<option value='queda de moto'>Queda de moto</option>
		<option value='queda de veiculo'>Queda de veículo</option>
		<option value='tombamento'>Tombamento</option>
		<option value='acidente complexo'>Acidente complexo</option>
		<option value='nao identificado'>Não identificado</option>
		</select>";
		form::input("Tipo de acidente","",$textoForm);
		form::closeTD();
		form::openTD("colspan='1'");
			form::openLabel("Avarias");
				echo "<select name='it[avarias]' $opcaoGeral2>";
					echo "<option value=''>Selecione</option>";
					echo "<option value='Pequena Monta'>Pequena Monta</option>";
					echo "<option value='Media Monta'>Media Monta</option>";
					echo "<option value='Grande Monta'>Grande Monta</option>";
				echo "</select>";
			form::closeLabel();
		form::closeTD();
		form::openTD("colspan='1'");
		$textoForm="<select name=it[situacaoviatura] $opcaoGeral2>
		<option value='nao informado'>Não informado</option>
		<option value='consertada com onus'>Consertada com ônus</option>
		<option value='consertada sem onus'>Consertada sem ônus</option>
		<option value='inservivel'>Inservível</option>
		<option value='aguarda conserto'>Aguarda conserto</option>
		</select>";
		form::input("Situação Viatura","",$textoForm);//trocado texto de Realização de acordo amigável
	form::closeTD();
	form::closeTR();
}
if ($opcao=="atualizar") {
	if ($objetoprocedimento =="viatura") {
	form::openTR();
		form::openTD("colspan='1' width='50%'");
			/*form::openLabel("Tipo do acidente");
				formulario::option("it","tipo_acidente","WHERE procedimento='it'",0,0);
			form::closeLabel();*/
		$textoForm="<select name=it[tipo_acidente] $opcaoGeral2>
		<option value='-'>-</option>
		<option value='nao identificado'>Não identificado</option>
		<option value='abalroamento lateral'>Abalroamento lateral</option>
		<option value='abalroamento transversal'>Abalroamento transversal</option>
		<option value='atropelamento'>Atropelamento</option>
		<option value='atropelamento de animal'>Atropelamento de animal</option>
		<option value='capotamento'>Capotamento</option>
		<option value='colisao frontal'>Colisão frontal</option>
		<option value='colisao traseira'>Colisão traseira</option>
		<option value='choque'>Choque</option>
		<option value='engavetamento'>Engavetamento</option>
		<option value='incendio'>Incêndio</option>
		<option value='queda de passageiro'>Queda de passageiro</option>
		<option value='queda de objeto'>Queda de objeto</option>
		<option value='queda de moto'>Queda de moto</option>
		<option value='queda de veiculo'>Queda de veículo</option>
		<option value='tombamento'>Tombamento</option>
		<option value='acidente complexo'>Acidente complexo</option>
		<option value='nao identificado'>Não identificado</option>
		</select>";
		form::input("Situação Viatura","",$textoForm);
		form::closeTD();
		form::openTD("colspan='1'");
			form::openLabel("Avarias");
				echo "<select name='it[avarias]' $opcaoGeral2>";
					echo "<option value=''>Selecione</option>";
					echo "<option value='Pequena Monta'>Pequena Monta</option>";
					echo "<option value='Media Monta'>Media Monta</option>";
					echo "<option value='Grande Monta'>Grande Monta</option>";
				echo "</select>";
			form::closeLabel();
		form::closeTD();
		form::openTD("colspan='1'");
		$textoForm="<select name=it[situacaoviatura] $opcaoGeral2>
		<option value='nao informado'>Não informado</option>
		<option value='consertada com onus'>Consertada com ônus</option>
		<option value='consertada sem onus'>Consertada sem ônus</option>
		<option value='inservivel'>Inservível</option>
		<option value='aguarda conserto'>Aguarda conserto</option>
		</select>";
		form::input("Situação Viatura","",$textoForm);//trocado texto de Realização de acordo amigável
	form::closeTD();
	form::closeTR();
	}
}

form::openTR();
	form::openTD("colspan='3' width='100%'");
		form::input("S&iacute;ntese do fato (Quem, quando, onde, como e por quê)","it[sintese_txt]");
	form::closeTD();
form::closeTR();


if ($user["nivel"] >=3) {

form::openTR();
	form::openTD("colspan='1' width='50%'");
		form::input("Nº do BR da publicação","it[br_numero]","###/####");
	form::closeTD();

	form::openTD("colspan='2'");
		form::input("Situação do objeto","it[situacao_objeto]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='1' width='50%'");
		$textoForm="<select name=it[acordoamigavel] $opcaoGeral2>
		<option value='-'>-</option>
		<option value='S'>Sim</option>
		<option value='N'>Não</option>
		</select>";
		form::input("Ressarcimento Extrajudicial","",$textoForm);//trocado texto de Realização de acordo amigável
	form::closeTD();
	form::openTD("colspan='1'");
		form::openLabel("Causa do acidente");
			formulario::option("it","causa_acidente","","",0,0);
		form::closeLabel();
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='1' width='50%'");
		form::openLabel("Responsabilidade civil");
			formulario::option("it","resp_civil","","",0,0);
		form::closeLabel();
	form::closeTD();
	form::openTD("colspan='2'");
		form::input("Número do arquivo","it[arquivo_numero]");
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("width=50%");
		form::input("Número do protocolo integrado","it[protocolo_numero]");
	form::closeTD();
	form::openTD("colspan='2'");
		$textoForm="<select name=it[acaojudicial] $opcaoGeral2>
		<option value='-'>-</option>
		<option value='S'>Sim</option>
		<option value='N'>Não</option>
		</select>";
		form::input("Ação judicial","",$textoForm);
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("width='50%'");
		form::input("Valor do dano estimado","it[danoestimado_rs]");
	form::closeTD();
	form::openTD("colspan='2'");
		form::input("Valor do dano real","it[danoreal_rs]");
	form::closeTD();
form::closeTR();
}

//PDF relatório do encarregado
form::openTR();
	form::openTD("colspan='2' width='50%'");
		form::input("Relat&oacute;rio do Oficial Encarregado","it[relatorio_file]");
	form::closeTD();
	form::openTD("colspan='1' width='50%'");
		form::input("Data do Relat&oacute;rio","it[relatorio_data]");
	form::closeTD();
form::closeTR();
//PDF solução Unidade
form::openTR();
	form::openTD("colspan='2' width='50%'");
		form::input("Solu&ccedil;&atilde;o Unidade","it[solucao_unidade_file]");
	form::closeTD();
	form::openTD("colspan='1' width='50%'");
		form::input("Data da Solu&ccedil;&atilde;o","it[solucao_unidade_data]");
	form::closeTD();
form::closeTR();
//PDF solução complementar
form::openTR();
	form::openTD("colspan='2' width='50%'");
		if ($user["nivel"]<4) $opcoes="readonly";
		form::input("Solu&ccedil;&atilde;o Complementar","it[solucao_complementar_file]");
	form::closeTD();
	form::openTD("colspan='1' width='50%'");
		if ($user["nivel"]<4) $opcoes="readonly";
		form::input("Data da Solu&ccedil;&atilde;o","it[solucao_complementar_data]");
	form::closeTD();
form::closeTR();


if ($opcao=="atualizar") {
$encarregado=new envolvido("WHERE rg_substituto='' AND situacao='Encarregado' AND id_it='".$it->id_it."'","","simples");
}
?>

<!--Encarregado e Escrivão-->
<tr><td colspan='3'>

<table cellpadding="1" cellspacing="1" width="100%" bgcolor="#EEEEEE"><tr><td>
<table align=center border=0 cellpadding="0" cellspacing="1" width="100%">
	<tr>
		<th colspan="5" bgcolor="#EEEEEE"><font face="tahoma, verdana" size="2">Oficial Encarregado</font></th>
	</tr>
	<tr bgcolor=white align=center>
		<td>RG</td>
		<td valign="center">Nome<a href='http://10.47.1.8/pm/consultapm.php' target="_blank"><img border=0 src='img/lupa.gif' width="20" /></a></td>
		<td>Posto/Graduação</td>
		<td>Situação</td>
		<td>A&ccedil;&atilde;o</td>
	</tr>
	<tr bgcolor=white>
		<input type="hidden" name="envolvido[encarregado][id_envolvido]">
		<input type="hidden" name="envolvido[encarregado][id_it]">
		<td><input type=text size=12 name=envolvido[encarregado][rg] onblur="ajaxForm(this,'policial',Array('nome','cargo'));" onkeypress="return DigitaNumeroTempoReal(this,event)"></td>
		<td><input readonly type=text readonly size=30 ajax=1 name=envolvido[encarregado][nome]></td>
		<td><input readonly type=text readonly size=10 name="envolvido[encarregado][cargo]"></td>
		<td width='160px'><input readonly type=text size=15 name="envolvido[encarregado][situacao]" value="Encarregado"></td> 
		<?php
            if ($opcao=="atualizar") $id=$encarregado->id_envolvido; $deletar=false;
            if ($user['nivel']<>6 && $user['nivel']<>7)include ("includes/botoes.inc");
        ?>
	</tr>
</table>
</td></tr>
</table>
<!-- Fim Encarregado e Escrivão -->

<!-- Indiciados -->
<tr><td colspan='3'>
	<?formulario::subform("envolvido",$indiciados,"Envolvidos");?>
</td></tr>
<!-- Fim Indiciados -->
<tr><td colspan='3'>
<!-- Ofendidos -->
	<?formulario::subform("ofendido",$ofendidos,"Civis envolvidos (Apenas se houver)");?>
<!-- Fim Ofendidos -->
</td></tr>
</td></tr>


<?php
form::openTR(); form::openTD();
if ($user['nivel']<>6 && $user['nivel']<>7) {
	if ($opcao=="cadastrar") echo "<input type='submit' name='acao' value='Cadastrar'>";
	if ($opcao=="atualizar" and $user['nivel']>=2) echo "<input type='submit' name='acao' value='Atualizar'>";
	if ($user['nivel']>=5 and $opcao!="cadastrar") echo "<input type='submit' name='acao' value='Apagar' onclick='return confirmar();'>";//
}
form::closeTD(); form::closeTR();
?>
<!-- fechamento do formulário -->
</table>
</form>

<?php
//Preenchimento automático formulário
if ($it) {
	formulario::values($it);
	formulario::values($encarregado, "envolvido[encarregado]");
        $i=1;
        while  ($row=@mysql_fetch_assoc($resI)) {
                formulario::values($row,"envolvido[$i]");
        /*if ($row[rg] and $user['nivel']<>5) echo "<script>document.getElementsByName('envolvido[$i][rg]')[0].disabled=true;</script>";*/
               $i++;
        }
        $i=1;
        while  ($row=@mysql_fetch_assoc($resO)) {
                formulario::values($row,"ofendido[$i]");
                $i++;
        }
}
?>
