<?php

$nomeDoArquivoDeLog = "consulta_inativo";

$query = isset($_POST["query"]) ? $_POST["query"] : "";
$nrDeLinhasAExibir = isset($_POST["nrDeLinhasAExibir"]) ? $_POST["nrDeLinhasAExibir"] : 60;
$reverso = isset($_POST["reverso"]) ? (boolean)($_POST["reverso"]=="true") : true;

?>
<table cellpadding="0" cellspacing="1" border="0" width="100%">
		<tr>
			<td align="center">
				<form action='?module=inativo&opcao=log' method='POST'>
				<table cellpadding="0" cellspacing="0" width="95%" class="borda" cellpadding="1">
					<tr>
						<td bgcolor="#4682B4" colspan="4">
							<h1>Filtros</h1>
						</td>
					</tr>
					<tr>
						<td>
<?php
	form::openLabel("Termos");
	echo "<input name='query' type='text' size='30' value='$query'>\r\n";
	form::closeLabel();
?>
						</td>
						<td>
<?php
	form::openLabel("Quantidade de registros a exibir");
	echo "<input name='nrDeLinhasAExibir' type='text' size='8' maxsize='8' value='$nrDeLinhasAExibir'>\r\n";
	form::closeLabel();
?>
						</td>
						<td>
<?php
	form::openLabel("Ordem");
?>
                            <select name="reverso">
                            	<option value="true" <?php if ($reverso === true) echo "selected"; ?>>Mais recente primeiro</option>
								<option value="false" <?php if ($reverso === false) echo "selected"; ?>>Mais antigo primeiro</option>
							</select>
<?php
	form::closeLabel();
?>
						</td>
						<td>
							<input type='submit' name='acao' value='Filtrar'>
						</td>

					</tr>
				</table>
				</form>

            <img src="img/pixel.gif" width="1" height="20" border="0"><br>
			<table cellpadding="0" cellspacing="0" width="95%" border="0"><tr><td bgcolor="#4682B4">
			<center><h1>Consulta de Inativos</h1></center>
			<table cellpadding="5" cellspacing="1" width="100%" border="0">
			<tr><th colspan="2" bgcolor="#DBEAF5"><font face="tahoma, verdana" size="2">Log de visualização</font></td></tr>
			<tr bgcolor=white><TD bgcolor=white><?php

			if (log::ler($nomeDoArquivoDeLog,$nrDeLinhasAExibir,$reverso,$query) === false) {
				echo "Nenhum registro encontrado.";
			}

			?></TD></tr>

</table>