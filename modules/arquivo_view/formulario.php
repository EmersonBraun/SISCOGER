<?php  
$numero = $_REQUEST['numero'];
$letra = $_REQUEST['letra'];
?>
<script language='javascript'>
	function validarForm(formulario) {
		if (formulario.descricao.value=="") { window.alert("Preencha a descri&ccedil;&atilde;o"); return false; }
		return true;
	}
</script>

<h1>Inserir arquivo:</h1> 
<table class='noprint'>

		<form name="arquivo" action="?module=arquivo_view&opcao=cadastrar" onsubmit='return validarForm(this);' method="POST">

			<?php
			echo "<input type=\"hidden\" name=\"arquivo[procedimento]\" value=\"$procedimento\">";
			// echo "<input type=\"hidden\" name=\"arquivo[sjd_ref]\" value=\"$row[sjd_ref]\">";
			// echo "<input type=\"hidden\" name=\"arquivo[sjd_ref_ano]\" value=\"$row[sjd_ref_ano]\">";
			// echo "<input type=\"hidden\" name=\"arquivo[arquivo_data]\" value=\"".data::hoje()."\">";
		   	echo "<input type=\"hidden\" name=\"arquivo[rg]\" value=\"".$usuario->rg."\">";
		   	echo "<input type=\"hidden\" name=\"arquivo[nome]\" value=\"".$usuario->nome."\">";
		   	echo "<input type=\"hidden\" name=\"arquivo[opm]\" value=\"".$usuario->opm->abreviatura."\">";
			form::openTR();
				form::openTD();
					$textoForm="<select name=arquivo[procedimento] class='procedimento' $opcaoGeral2 >
						<option>ipm</option>
					    <option>sindicancia</option>
					    <option>cd</option>
					    <option>cj</option>
					    <option>apfdc</option>
					    <option>apfdm</option>
					    <option>fatd</option>
					    <option>iso</option>
					    <option>desercao</option>
					    <option>it</option>
					    <option>adl</option>
					    <option>pad</option>
					    <option>sai</option>
					    <option>proc_outros</option>
					</select>";
					form::input("Procedimento","",$textoForm);
				form::closeTD();
				form::openTD();
					$textoForm="<input name=arquivo[sjd_ref] class='ref' $opcaoGeral2 onblur='ajaxIdProc()''>";
					form::input("Numero","",$textoForm);
					//form::input("Numero", "arquivo[numero]");
				form::closeTD();
				form::openTD();
					$textoForm="<input name=arquivo[sjd_ref_ano] class='ano' $opcaoGeral2 onblur='ajaxIdProc()''>";
					form::input("Ano","",$textoForm);
				form::closeTD();
				form::openTD();
					form::input("Data do arquivo","arquivo[arquivo_data]");
				form::closeTD();
				form::openTD();
					$textoForm="<input id='proc' required readonly $opcaoGeral2 >";
					form::input("ID","",$textoForm);
				form::closeTD();
			form::closeTR();
			form::openTR();
				form::openTD();
					$textoForm="<select name=arquivo[local_atual] $opcaoGeral2>
						<option>Arquivo COGER</option>
						<option>Arquivo Geral(PMPR)</option>
						<option>Cautela (Sa&iacute;da)</option>
					</select>";
					form::input("Local","",$textoForm);
				form::closeTD();
				if(is_null($numero)){
					form::openTD();
						form::loop("N&uacute;mero", "arquivo[numero]","1","100","-");
					form::closeTD();
				}else{
					form::openTD();
						$textoForm="<input name=arquivo[numero] value='$numero' readonly>";
						form::input("N&uacute;mero","",$textoForm);
					form::closeTD();
				}
				if(is_null($letra)){
					form::openTD();
						form::loop("Letra", "arquivo[letra]","a","z","-");
					form::closeTD();
				}else{
					form::openTD();
						$textoForm="<input name=arquivo[letra] value='$letra' readonly>";
						form::input("Letra","",$textoForm);
					form::closeTD();
				}
				form::openTD();
					form::input("Observa&ccedil;&otilde;es.", "arquivo[obs]");
				form::closeTD();
			form::closeTR();
			form::openTR();
				form::openTD();
					?> 
					<input type="submit" value="Inserir">
					<?php
				form::closeTD();
			form::closeTR();
			 ?>
        <br>
		
		</form>
</table>

<br>


