<?php
if (!$notacomparecimento->sjd_ref_ano)
    $notacomparecimento->sjd_ref_ano = $_SESSION[sjd_ano];

//if ($opcao=="atualizar") {
//$sql="SELECT * FROM envolvido WHERE situacao='Paciente' AND id_iso='".$iso->id_iso."'";
//$resI=mysql_query($sql);
//if ($resI) $indiciados=mysql_num_rows($resI);
//
//$sql="SELECT * FROM ofendido WHERE situacao='Ofendido' AND id_iso='".$iso->id_iso."'";
//$resO=mysql_query($sql);
//if ($resO) $ofendidos=mysql_num_rows($resO);
//
////ligacoes
//	$sqlL="SELECT * FROM ligacao WHERE destino_proc='iso' AND destino_sjd_ref='".$iso->sjd_ref."' AND destino_sjd_ref_ano='".$iso->sjd_ref_ano."'";
//	$resL=mysql_query($sqlL);
//	$ligacoes=mysql_num_rows($resL);
//
//}
//
//if (!$indiciados) $indiciados=1;
//if (!$ofendidos) $ofendidos=0;
?>

<script language=javascript>
    function validar(form) {

        if (aguardando == true) {
            window.alert("Aguarde enquanto o nome é preenchido");
            return false;
        }

        var camposObrigatorios = {
            'sjd_ref': 'Número',
            'sjd_ref_ano': 'Ano',
            'expedicao_data': 'Data',
            'tipo': 'Tipo de Nota'
        }


        for (campoNome in camposObrigatorios) {
            campo = document.getElementsByName('notacomparecimento[' + campoNome + ']')[0];

            if (campo.value == "") {
                window.alert("Preencha o " + camposObrigatorios[campoNome] + "!");
                campo.focus();
                return false;
            }
        }

        return true;
    }
</script>
<? ?>

<form class="controlar-modificacao" ID='notacomparecimento' name="notacomparecimento" action="index.php?module=notacomparecimento" method=post onSubmit="return validar(this);" enctype="multipart/form-data">
    <input type="hidden" name="notacomparecimento[id_notacomparecimento]">

    <!-- notacomparecimento -->
<? if ($opcao == "cadastrar") { ?><center><h1>Nova Nota de Comparecimento</h1></center><? } ?>
<? if ($opcao == "atualizar") { ?><center><h1>Nota de Comparecimento</h1></center><? } ?>

    <?php include 'opcoes.inc.php'; ?>

    <table border=0 width=100%>

<?
form::openTR();
form::openTD("width='50%' colspan=1");
form::openLabel("Número da nota e ano");
echo "<input size='5' name='notacomparecimento[sjd_ref]' type='text' value='" . $notacomparecimento->sjd_ref . "' $opcaoGeral2>";
echo "/";
echo "<input size='5' maxlength='4' name='notacomparecimento[sjd_ref_ano]' type='text' value='" . $notacomparecimento->sjd_ref_ano . "' $opcaoGeral2>";
?>
        <select name="notacomparecimento[status]" <?= $opcaoGeral2; ?>>
            <option value="pendente" <?php echo ($notacomparecimento->status == notacomparecimento::PENDENTE) ? 'selected' : ''; ?> >Pendente</option>
            <option value="publicada" <?php echo ($notacomparecimento->status == notacomparecimento::PUBLICADA) ? 'selected' : ''; ?> >Publicada</option>
        </select>
        <?php
        form::closeLabel();
        form::closeTD();
        form::openTD();
        form::input("Data", "notacomparecimento[expedicao_data]");
        form::closeTD();
        form::closeTR();

        form::openTR();
        form::openTD("colspan='2'");
        form::openLabel("Tipo de Nota");
        formulario::option("notacomparecimento", "tiponotacomparecimento", "WHERE ativo=1", "", 0, 0);
        form::closeTD();
        form::closeTR();

        form::openTR();


        if (isset($notacomparecimento->id_notacomparecimento) && $notacomparecimento->id_notacomparecimento > 0) {
            form::openTD();
            form::input("Arquivo PDF", "notacomparecimento[nota_file]");
            form::closeTD();
            form::openTD();
            form::openLabel('Planilha');
            echo "<a href='?module=notacomparecimento&opcao=download&notacomparecimento[id]={$notacomparecimento->id_notacomparecimento}&noheader&nomenu'>Download</a>";
            form::closeLabel();
            form::closeTD();
        } else {
            form::openTD("colspan='2' width='100%'");
            form::input("Arquivo PDF", "notacomparecimento[nota_file]");
            form::closeTD();
        }

        form::closeTR();

        form::openTR();
        form::openTD("colspan='2' width='100%'");
        $opcoes = " id='observacao_txt' rows='7' cols='80' ";
        form::input("Observações", "notacomparecimento[observacao_txt]");
        form::closeTD();
        form::closeTR();
        ?>

        <table border=0 width=100%>
            <tr><td>

                    <table cellpadding="1" cellspacing="1" width="100%" bgcolor="#EEEEEE"><tr><td>
                                <table align=center border=0 cellpadding="0" cellspacing="1" width="100%">
                                    <tr><th colspan="6" bgcolor="#EEEEEE"><font face="tahoma, verdana" size="2">Autoridade</font></th></tr>
                                    <tr bgcolor=white align=center><td>RG</td><td valign="center">Nome<a href='http://10.47.1.8/pm/consultapm.php' target="_blank"><img border=0 src='img/lupa.gif' width="20" /></a></td><td>Posto/Graduação</td><td>Quadro</td><td>Função</td></tr>
                                    <tr bgcolor=white>
                                        <td><input type=text size=12 name=notacomparecimento[autoridade_rg] onkeypress='return DigitaNumeroTempoReal(this, event)' onblur="ajaxFormAutoridade(this, 'policial', Array('autoridade_nome', 'autoridade_cargo', 'autoridade_quadro'));" <?php echo $opcaoGeral2; ?>></td>
                                        <td><input type=text size=30 ajax=1 name=notacomparecimento[autoridade_nome]></td>
                                        <td><input type=text size=10 name="notacomparecimento[autoridade_cargo]"></td>
                                        <td><input type=text size=10 name="notacomparecimento[autoridade_quadro]"></td>
                                        <td><input type=text size=15 name="notacomparecimento[autoridade_funcao]"></td>
                                    </tr>
                                </table>
                            </td></tr></table>


                </td></tr>
            <tr><td>
<?
if ($user['nivel'] <> 6 && $user['nivel'] <> 7) {
    if ($opcao == "cadastrar")
        echo "<input type='submit' name='acao' value='Cadastrar'>";
    if ($opcao == "atualizar")
        echo "<input type='submit' name='acao' value='Atualizar'>";
    if ($user[nivel] == 5 and $iso->id_iso)
        echo "&nbsp;<input type='submit' name='acao' value='Apagar'>";
}
?>
                </td></tr>

        </table>

</form>

<?php
//Preenchimento automático formulário
if ($notacomparecimento) {
    formulario::values($notacomparecimento);

    formulario::values($encarregado, "envolvido[encarregado]");
    $i = 1;
    while ($row = @mysql_fetch_assoc($resI)) {
        formulario::values($row, "envolvido[$i]");
        if ($row[rg] and $user['nivel'] <> 5)
            echo "<script>document.getElementsByName('envolvido[$i][rg]')[0].disabled=true;</script>";
        $i++;
    }
    if ($ligacoes) {
        $i = 1;
        while ($rowL = mysql_fetch_assoc($resL)) {
            formulario::values($rowL, "ligacao[$i]");
            $i++;
        }
    }
}
?>
<script>


    function ajaxFormAutoridade(campo, tabela, vetor) {
        //Parâmetros: O índice da tabela campo será procurado na tabela tabela e retornará os resultados nos campos da tabela vetor.
        //window.alert('rocks');
        if (aguardando)
            return false;
        aguardando = true;

        //Definição de variáveis
        var strposIni = campo.name.lastIndexOf("[");
        var strposFim = (campo.name.lastIndexOf("]") - strposIni);
        var coluna = campo.name.substr(strposIni + 1, strposFim - 1);
        var prefixo = campo.name.substr(0, strposIni);

        //Exibe o texto carregando nos campos da Array vetor
        for (var i = 0; i < vetor.length; i++) {
            document.getElementsByName(prefixo + '[' + vetor[i] + ']')[0].value = '...carregando...';
        }

        vetor2 = ['nome', 'cargo', 'quadro'];
        coluna2 = 'rg';

        var valor = campo.value;

        //Abre a url
        var urlAjax = "ajax/ajax.form.php?tabela=" + tabela + "&" + tabela + "[" + coluna2 + "]=" + valor;
        for (var i = 0; i < vetor2.length; i++) {
            urlAjax += "&ret[]=" + vetor2[i];
        }
        xmlhttp.open("GET", urlAjax, true);

        //Executada quando o navegador obtiver o código
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4) {
                //Lê o texto
                var texto = xmlhttp.responseText
                //window.alert(texto);
                //Desfaz o urlencode
                texto = texto.replace(/\+/g, " ")
                texto = unescape(texto)
                //Split no texto
                texto = texto.split(";");

                //Exibe o texto no campo escolhido
                aguardando = false;
                for (var i = 0; i < vetor.length; i++) {
                    document.getElementsByName(prefixo + '[' + vetor[i] + ']')[0].value = texto[i];
                }
                //campo.value=texto

            }
        }
        xmlhttp.send(null)
    }


</script>