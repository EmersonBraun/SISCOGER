<?

if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

$q = isset($_REQUEST['q']) ? $_REQUEST['q'] : '';
$voltar = isset($_REQUEST['voltar']) ? $_REQUEST['voltar'] : '';

?>

<script language=javascript>
    function validar(form) {

        if (aguardando == true) {
            window.alert("Aguarde enquanto o nome é preenchido");
            return false;
        }

        var camposObrigatorios = {
            'localdeapresentacao': 'Nome do local',
            'id_municipio': 'Nome do município',
            'bairro': 'Nome do bairro'
        }


        for (campoNome in camposObrigatorios) {
            campo = document.getElementsByName('localdeapresentacao[' + campoNome + ']')[0];

            if (campo.value.trim() == "") {
                window.alert("Preencha o " + camposObrigatorios[campoNome] + "!");
                campo.focus();
                return false;
            }
        }
<?php /*
        if (Verifica_Hora('apresentacao[comparecimento_hora]') === false) {
            campo = document.getElementsByName('apresentacao[comparecimento_hora]')[0];
            window.alert("A hora está em formato errado!");
            campo.focus();
            return false;
        }
*/ ?>
        return true;
    }

    function Verifica_Hora(Campo) {

        Hora = document.getElementsByName(Campo)[0];
        hrs = (Hora.value.substring(0, 2));
        min = (Hora.value.substring(3, 5));

        estado = "";
        if ((hrs < 00) || (hrs > 23) || (min < 00) || (min > 59) || (min == '') || (min.length != 2))
        {
            return false
        }
        if (Hora == "")
        {
            return false
        }
        return true

    }
</script>

<form class="controlar-modificacao" id="localdeapresentacao" name="localdeapresentacao" onsubmit='return validar(this)' action="?module=localdeapresentacao" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="q" value="<?=$q;?>" />
    <input type="hidden" name="voltar" value="<?=$voltar;?>" />

<!-- campo obrigatorio, nao delete -->
<input type="hidden" name="localdeapresentacao[id_localdeapresentacao]" value="<?=$localdeapresentacao->id_localdeapresentacao;?>">






<?if ($opcao=="cadastrar"){?><center><h1>Novo Local de Apresentação</h1></center><?}?>
<?if ($opcao=="atualizar"){?><center><h1>Local de Apresentação</h1></center><?}?>

<table class='bordasimples' cellspacing="1" width="100%" border="0">
	<tr>
		<td bgcolor="#ffffff" valign="top">
		<?php
		//echo "<table width='100%'>";
		form ::openTR();
			form::openTD("colspan='3'");
				form::openLabel("Nome do local");
				echo "<input name='localdeapresentacao[localdeapresentacao]' type='text' size='80' maxlength='255' value='{$localdeapresentacao->localdeapresentacao}'>";
				form::closeLabel();
			form::closeTD();
                        form::openTD("colspan='1'");
				form::openLabel("Genero gramatical (para fins de geração de documentos)");
                                echo "<select name='localdeapresentacao[id_genero]'>";
                                echo "<option value='2'>Feminino</option>";
                                echo "<option value='1'>Masculino</option>";
                                echo "</select>";
				form::closeLabel();
			form::closeTD();
		form ::closeTR();
		form ::openTR();
			form::openTD();
				form::openLabel("UF");
				echo "<select name='localdeapresentacao[uf]'>";
					echo '<option value="PR" ';
					echo $localdeapresentacao->uf == "PR" ? "selected" : "";
					echo '>PR</option>';

					echo '<option value="BR" ';
					echo $localdeapresentacao->uf == "BR" ? "selected" : "";
					echo '>Outros Estados</option>';
				echo "</select>";
				form::closeLabel();
			form::closeTD();
			form::openTD("colspan='2'");
				form::openLabel("Município");
					formulario::option("localdeapresentacao","municipio",$localdeapresentacao->id_municipio,"","",0);
				form::closeLabel();
			form::closeTD();
			form::openTD("colspan='2'");
				form::openLabel("Bairro");
				echo "<input name='localdeapresentacao[bairro]' type='text' size='40' maxlength='100' value='{$localdeapresentacao->bairro}'>";
				form::closeLabel();
			form::closeTD();
		form ::closeTR();
		form ::openTR();
			form::openTD("colspan='2'");
				form::openLabel("Logradouro");
				echo "<input name='localdeapresentacao[logradouro]' type='text' size='40' maxlength='100' value='{$localdeapresentacao->logradouro}'>";
				form::closeLabel();
			form::closeTD();
			form::openTD();
				form::openLabel("Número");
				echo "<input name='localdeapresentacao[numero]' type='text' size='10' maxlength='20' value='{$localdeapresentacao->numero}'>";
				form::closeLabel();
			form::closeTD();
			form::openTD("colspan='1'");
				form::openLabel("Complemento");
				echo "<input name='localdeapresentacao[complemento]' type='text' size='40' maxlength='60' value='{$localdeapresentacao->complemento}'>";
				form::closeLabel();
			form::closeTD();
		form ::closeTR();
		form ::openTR();
			form::openTD("colspan='2'");
                                form::input("CEP", "localdeapresentacao[cep]", "##.###-###");
			form::closeTD();
			form::openTD("colspan='3'");
				form::openLabel("Telefone");
				echo "<input name='localdeapresentacao[telefone]' type='text' size='40' maxlength='60' value='{$localdeapresentacao->telefone}'>";
				form::closeLabel();
			form::closeTD();
		form ::closeTR();
		openTR();
			openTD("colspan=5");
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


</form>
<?
//Preenchimento automático formulário
if ($localdeapresentacao) {
    formulario::values($localdeapresentacao);
}
?>