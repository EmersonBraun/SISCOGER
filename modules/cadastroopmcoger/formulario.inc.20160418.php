<?php
if ($user['nivel'] == 6 || $user['nivel'] == 7) {
    $opcaoGeral = "readonly";
    $opcaoGeral2 = "disabled";
} // alteracao solicitada pelo Cap Todisco
?>
<script language=javascript>
    function validar(form) {

        if (aguardando == true) {
            window.alert("Aguarde enquanto o nome é preenchido");
            return false;
        }

        var camposObrigatorios = {
            'opm_nome_por_extenso': 'Nome da Unidade por extenso'
        }


        for (campoNome in camposObrigatorios) {
            campo = document.getElementsByName('cadastroopmcoger[' + campoNome + ']')[0];

            if (campo.value.trim() == "") {
                window.alert("É necessário preencher o campo: " + camposObrigatorios[campoNome] + "!");
                campo.focus();
                return false;
            }
        }

        var campoCdOpmIntermed = document.getElementsByName('cadastroopmcoger[opm_intermediaria_cdopm]')[0];
        var campoOpmIntermed = document.getElementsByName('cadastroopmcoger[opm_intermediaria_nome_por_extenso]')[0];

        if ((campoCdOpmIntermed.value != '') && (campoOpmIntermed.value.trim() == "")) {
            window.alert("É necessário preencher o campo: Nome da Unidade Intermediária por extenso!");
            campoOpmIntermed.focus();
            return false;
        }
<?php /**
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
<? ?>

<form class="controlar-modificacao" ID='cadastroopmcoger' name="cadastroopmcoger" action="index.php?module=cadastroopmcoger" method="post" onSubmit="return validar(this);" enctype="multipart/form-data">
    <input type="hidden" name="cadastroopmcoger[id_cadastroopmcoger]" value="<?=$cadastroopmcoger->id_cadastroopmcoger;?>">
    <input type="hidden" name="cadastroopmcoger[cdopm]">


    <table border=0 width=100%>

        <?php
        form::openTR();

        form::openTD(" colspan='2' ");

        form::openLabel("OM Interm.");
        echo "<select name='cadastroopmcoger[opm_intermediaria_cdopm]' >";
        echo "<option value=''>Nao se aplica</option>";

        $cdopm_cmdo_selected = $cadastropmcoger->opm_intermediaria_cdopm;
        include 'includes/option_opm_cmdo.php';

        echo "</select>";

        form::closeLabel();

        form::closeTD();

        form::openTD("colspan='10'");
        form::openLabel("Nome da Unidade Intermediaria por extenso");

        echo "<input size='45' name='cadastroopmcoger[opm_intermediaria_nome_por_extenso]' type='text' />";

        form::closeLabel();
        form::closeTD();
        form::closeTR();

        form::openTR();
        form::openTD("colspan='10'");
        form::openLabel("Nome da Unidade por extenso");

        echo "<input size='45' name='cadastroopmcoger[opm_nome_por_extenso]' type='text' />";


        form::closeLabel();
        form::closeTD();

        form::openTD(" colspan='2' ");

        form::openLabel("Municipio");

        echo "<select name='cadastroopmcoger[id_municipio]' >";
        $ocultarTodos = true;
        include 'includes/option_municipios.php';

        echo "</select>";

        form::closeLabel();

        form::closeTD();


        form::closeTR();
        form::openTR();
        form::openTD(' colspan="12" ');
        form::openLabel("Comandante/Chefe/Diretor");
        ?>

        <table border=0 width=100%>
            <tr><td>

                    <table cellpadding="1" cellspacing="1" width="100%" bgcolor="#EEEEEE">
                        <tr>
                            <td>
                                <table align=center border=0 cellpadding="0" cellspacing="1" width="100%">
                                    <tr bgcolor=white align=center>
                                        <td>RG</td>
                                        <td valign="center">Cargo/Quadro/Nome</td>
                                        <td>Função</td>
                                    </tr>
                                    <tr bgcolor=white>
                                        <td valign="top"><input type=text size=12 name='cadastroopmcoger[opm_autoridade_rg]' onkeypress='return DigitaNumeroTempoReal(this, event)' onblur="ajaxFormAutoridade(this, 'autoridade_nome');"></td>
                                        <td valign="top"><input type=text size='40' id='autoridade_nome' value='<?= FHelperICO::obtemNomeConformeAIco($autoridade); ?>' readonly></td>
                                        <td valign="top"><input type=text size='45' name="cadastroopmcoger[opm_autoridade_funcao]" /></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

                    <?php
                    form::closeLabel();
                    echo '<br />';
                    form::closeTD();

                    form::closeTR();

                    form::openTR();
                    form::openTD(' colspan="12" ');
                    form::openLabel("Outras Autoridades");
                    echo "<button onclick='javascript: adicinarLinhaAutoridade(this, event)'>(+) Adicionar</button>";

                    $sqlAutoridades = sprintf("
                        SELECT c.*,
                            pm.cargo, pm.quadro, pm.subquadro, pm.nome
                        FROM `cadastroopmcogerautoridade` c
                        LEFT JOIN `RHPARANA`.`POLICIAL` pm ON c.rg = pm.rg
                        LEFT JOIN `sjd`.`posto` posto ON pm.cargo = posto.posto
                        WHERE c.id_cadastroopmcoger = %d
                        ORDER BY posto.id_posto, pm.nome
                    ", mysql_real_escape_string($cadastroopmcoger->id_cadastroopmcoger));

                    @$res = mysql_query($sqlAutoridades, $con[8]);
                    ?>

                    <table border=0 width=100%>
                        <tr>
                            <td>

                                <table align=center border=0 cellpadding="0" cellspacing="1" width="100%" >
                                    <thead>
                                    <tr bgcolor=white align=center>
                                        <td >RG</td>
                                        <td valign="center">Cargo/Quadro/Nome</td>
                                        <td>Função</td>
                                        <td>Ação</td>
                                    </tr>
                                    </thead>
                                    <tbody id='tabela_autoridades'>
                                    <?php $iAutoridade = 0; ?>
                                    <?php while ($aut = mysql_fetch_assoc($res)): ?>
                                        <?php $nomeConformeAIco = FHelperICO::obtemNomeConformeAIco($aut['cargo'], $aut['quadro'], $aut['subquadro'], $aut['nome']); ?>
                                        <tr bgcolor=white>
                                            <td valign="top">
                                                <input type='hidden' name='autoridades[<?= $iAutoridade; ?>][id]' value='<?= $aut['id_cadastroopmcogerautoridade']; ?>'/>
                                                <input type=text size=10 name='autoridades[<?= $iAutoridade; ?>][rg]' onkeypress='return DigitaNumeroTempoReal(this, event)' onblur="ajaxFormAutoridade(this, 'autoridades_nome[<?= $iAutoridade; ?>]');" value='<?= $aut['rg']; ?>'></td>
                                            <td valign="top"><input type=text size='50' id='autoridades_nome[<?= $iAutoridade; ?>]' value='<?= $nomeConformeAIco; ?>' readonly></td>
                                            <td valign="top"><input type='text' name='autoridades[<?= $iAutoridade; ?>][funcao]' value='<?= $aut['funcao']; ?>'/></td>
                                            <td valign="top"><a href="?module=cadastroopmcoger&cadastroopmcoger[id]=<?= $cadastroopmcoger->id_cadastroopmcoger; ?>&opcao=removerautoridade&cadastroopmcogerautoridade[id]=<?= $aut['id_cadastroopmcogerautoridade']; ?>&validacao=<?= md5(md5($aut['id_cadastroopmcogerautoridade'])); ?>"><img src='img/wrong.gif'></a></td>
                                        </tr>

                                        <?php $iAutoridade++; ?>
                                    <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table>

                    <?php
                    form::closeLabel();
                    form::closeTD();

                    form::closeTR();
                    ?>
        </table>


        <br>
        </td></tr>
        <tr><td>
                <?php
                if (($opcao == "cadastrar"))
                    echo "<input type='submit' name='acao' value='Cadastrar'> ";
                if (($opcao == "atualizar"))
                    echo "<input type='submit' name='acao' value='Atualizar'> ";
                ?>
            </td></tr>

    </table>

</form>

<?php
//Preenchimento automático fo^rmulário
if ($cadastroopmcoger) {
    formulario::values($cadastroopmcoger);
}
?>

<script>
    var idAutoridades = document.getElementById('tabela_autoridades').childElementCount;

    function adicinarLinhaAutoridade(objeto, evento) {
        evento.preventDefault();
        var campos = document.getElementsByName('autoridades_nome');
        var id = idAutoridades;
        idAutoridades++;


        var $linha = $('<tr bgcolor=white id="linha_ajax_'+id+'">' +
                '<td valign="top"><input type="text" size="10" name="autoridades[' + id + '][rg]" onkeypress="return DigitaNumeroTempoReal(this, event)" onblur="ajaxFormAutoridade(this,\'autoridades_nome[' + id + ']\');"></td>' +
                '<td valign="top"><input type="text" size="50" id="autoridades_nome[' + id + ']" readonly></td>' +
                '<td valign="top"><input type="text" name="autoridades[' + id + '][funcao]" /></td>' +
                '<td valign="top"><img src="img/wrong.gif" onclick="javascript: removerLinha(this,event,'+id+');"></td>' +
                '</tr>');

        var tabela = document.getElementById('tabela_autoridades');

        $tabela = $(tabela);

        $tabela.append($linha);

    }

    function removerLinha(objeto, evento, id) {
        $elm = $(document.getElementById('linha_ajax_'+id));
        $elm.remove();

    }

    function ajaxFormAutoridade(campo, campo_destino_nome) {
        if (aguardando)
            return false;
        aguardando = true;

        var rg = campo.value;

        var campo_destino = document.getElementById(campo_destino_nome);

        campo_destino.value = '...carregando...';

        //Abre a url
        var urlAjax = "ajax/ajax.nome_ico.php?rg=" + rg;

        xmlhttp.open("GET", urlAjax, true);

        //Executada quando o navegador obtiver o código
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4) {
                //Lê o texto
                var texto = xmlhttp.responseText
                //window.alert(texto);
                //Desfaz o urlencode
                texto = unescape(texto)

                //Exibe o texto no campo escolhido
                aguardando = false;

                campo_destino.value = texto;

            }
        }
        xmlhttp.send(null)
    }

    function buscaopm(object, event) {
        //console.log(object, event);
        event.preventDefault();
        window.open('?module=apresentacao&opcao=apresentacaoselecionaropm&nomenu=true&noheader=true', 'childWindow', 'width=600,height=400,resizable=yes,scrollbars=yes,status=no,location=no,left=0,top=0');
    }

    function buscapmpelonome(object, event) {
        //console.log(object, event);
        event.preventDefault();
        var nome = document.getElementsByName('apresentacao[pessoa_nome]')[0].value;
        window.open('?module=apresentacao&opcao=buscarpelonome&nomenu=true&noheader=true&nome_a_localizar=' + nome, 'childWindow', 'width=1024,height=600,resizable=yes,scrollbars=yes,status=no,location=no,left=0,top=0');
    }

<?php if (isset($campoSetFocus)): ?>
        document.getElementsByName('<?= $campoSetFocus; ?>')[0].focus();
<?php endif; ?>

</script>

<script>
    function voltarparanota() {
        window.location = "?module=notacomparecimento&opcao=listarapresentacoes&notacomparecimento[id]=<?= $notacomparecimento->id_notacomparecimento; ?>"
    }

    function selecionaLocal(elm, event) {
        elmLocal = document.getElementById('comparecimento_local_txt');
        elmLocal.value = elm.value;
    }

    function ajaxFormLocal() {
        if (aguardando)
            return false;
        elmSelect = document.getElementById('comparecimento_local_id');
        elmSelect.innerHTML = "<option>Localizando...</option>"
        aguardando = true;

        var valor = document.getElementById('comparecimento_local_txt').value;

        //Abre a url
        var urlAjax = "ajax/ajax.local.php?local_de_apresentacao_query=" + valor;
        xmlhttp.open("GET", urlAjax, true);

        //Executada quando o navegador obtiver o código
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4) {
                //Lê o texto
                elmSelect.innerHTML = xmlhttp.responseText
                aguardando = false;
            }
        }
        xmlhttp.send(null)
    }

</script>