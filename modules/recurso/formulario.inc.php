<br>
<script language='javascript'>
function confirmar() {
	if (window.confirm("Tem certeza?")) return true;
	else return false;
}
</script>

<?php
//Regras de negocio aqui
//Exemplo: data de hoje, controle de niveis, etc

//pre($usuario);

if (!$recurso->rg) $recurso->rg=$usuario->rg;
if (!$recurso->nome) $recurso->nome=$usuario->nome;
if (!$recurso->datahora) $recurso->datahora=date("d/m/Y H:i");
if (!$recurso->cdopm) $recurso->cdopm=$opm_login->codigoBase;
if (!$recurso->opm) $recurso->opm=$opm_login->abreviatura;
?>

<form id="recurso" class="controlar-modificacao" name="recurso" action="?module=recurso" method="POST" enctype="multipart/form-data">

<!-- campo obrigatorio, nao delete -->
<input type=hidden name=recurso[id_recurso]>

<input type=hidden name=recurso[rg]>
<input type=hidden name=recurso[nome]>
<input type=hidden name=recurso[cdopm]>
<input type=hidden name=recurso[opm]>

<?php
openTable("width='100%' class='bordasimples'");
openLine();
	echo "<h2>Formul&aacute;rio para cadastro de recebimento recurso (protocolo)</h2>";
closeLine();

form::openTR();
	form::openTD();
		form::openLabel("Procedimento");
			$opcoes="id='foco'";
			echo "<select name='recurso[procedimento]'>\r\n";
				foreach ($sjd_procedimentos as $proc) {
					echo "<option value='$proc'>$proc</option>";
				}
			echo "</select>\r\n";
		form::closeLabel();
	form::closeTD();

	form::openTD();
		form::openLabel("N&ordm; e ano do procedimento");
			echo "<input type='text' size='4' maxlength='4' onkeypress='return dntr(this, event);' name='recurso[sjd_ref]'>/";
			echo "<input type='text' size='4' maxlength='4' onkeypress='return dntr(this, event);' name='recurso[sjd_ref_ano]'>";

		form::closeLabel();
	form::closeTD();

form::closeTR();

form::openTR();
	form::openTD("colspan='2'");
		$opcoes="readonly";
		form::input("Data e hora do recebimento (autom&aacute;tico)","recurso[datahora]");
	form::closeTD();
form::closeTR();


echo "<tr><td><input type='submit' name='acao' value='".ucwords($opcao)."'>&nbsp;";

if ($opcao=="atualizar" and $user['nivel']==5) {
	echo "<input type='submit' name='acao' value='Apagar' onclick='return confirmar();'></TD></tr>";
}
?>
		
</table>
<!-- -->
</form>

</div>


<?
if ($recurso) {
	formulario::values($recurso);
}
?>
