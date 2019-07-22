<script language='javascript'>
	function validarForm(formulario) {
		if (formulario.descricao.value=="") { window.alert("Preencha a descri&ccedil;&atilde;o"); return false; }
		return true;
	}
</script>

<h1>Busca arquivo:</h1> 
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
					$textoForm="<input name=arquivo[sjd_ref] class='ref' $opcaoGeral2 onblur='ajaxArquivo()''>";
					form::input("Numero","",$textoForm);
					//form::input("Numero", "arquivo[numero]");
				form::closeTD();
				form::openTD();
					$textoForm="<input name=arquivo[sjd_ref_ano] class='ano' $opcaoGeral2 onblur='ajaxArquivo()''>";
					form::input("Ano","",$textoForm);
				form::closeTD();
				form::openTD();
					$textoForm="<input id='proc' required $opcaoGeral2 >";
					form::input("Local","",$textoForm);
				form::closeTD();
			form::closeTR();
			 ?>
        <br>
		
		</form>
</table>

<br>


