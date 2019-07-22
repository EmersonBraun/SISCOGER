<?php


    if (isset($_FILES['planilhamassificado'])) {
        $errosPlanilha = array();
        $folhasDaPlanilha = array();

        $nomeOriginalDoArquivo = $_FILES['planilhamassificado']['name'];

        //validar tamanho
        if ($_FILES['planilhamassificado']['error'] == 1) {
            $errosPlanilha[] = sprintf("O arquivo excede o tamanho máximo de: %s por arquivo e %s para envio total",ini_get('upload_max_filesize'),ini_get('post_max_size'));
        }

        //validar tipo
        $tipo = explode('.', $_FILES['planilhamassificado']['name']);
        $tipo = $tipo[count($tipo)-1];



        if (!in_array($tipo, array('xlsx','xls','ods'))) {
            $errosPlanilha[] = "O arquivo deve ser uma planilha eletrônica do Microsoft Excel ou no formato aberto ODS.";
        } else {
            $nomeTemporarioDoArquivo = $_FILES['planilhamassificado']['tmp_name'].".{$tipo}";
            copy($_FILES['planilhamassificado']['tmp_name'],$nomeTemporarioDoArquivo);
        }



        // carregar planilha e obter o arquivo
        if (count($errosPlanilha) == 0) {
            try {
                $objetoPlanilha = new FPlanilha();
                $objetoPlanilha->carregarDeUmArquivo($nomeTemporarioDoArquivo);
                $folhasDaPlanilha = $objetoPlanilha->getNomesDasFolhas();


                unlink($nomeTemporarioDoArquivo);
                $nomeDoArquivoCriado = $objetoPlanilha->getNomeDoArquivo();
                $caminhoDoArquivoCriado = $objetoPlanilha->getPlanilhaPath();
                $caminhoRelativoDoArquivoCriado = $objetoPlanilha->getCaminhoRelativoDoArquivo();

                $_SESSION['planilhas'][$nomeDoArquivoCriado]['folhas'] = $folhasDaPlanilha;
                $_SESSION['planilhas'][$nomeDoArquivoCriado]['caminhoDoArquivoCriado'] = $caminhoDoArquivoCriado;
                $_SESSION['planilhas'][$nomeDoArquivoCriado]['caminhoRelativoDoArquivoCriado'] = $caminhoRelativoDoArquivoCriado;
            } catch (Exception $ex) {
                $errosPlanilha[] = $ex->getMessage();
            }

        }
    } else if (isset($nomeDoArquivoCriado)) {
        $errosPlanilha = array();
        $folhasDaPlanilha = array();

        try {
            $objetoPlanilha = new FPlanilha();

            $objetoPlanilha->carregarDeUmArquivo($nomeDoArquivoCriado);
            $folhasDaPlanilha = $objetoPlanilha->getNomesDasFolhas();

            $nomeDoArquivoCriado = $objetoPlanilha->getNomeDoArquivo();
            $caminhoDoArquivoCriado = $objetoPlanilha->getPlanilhaPath();
            $caminhoRelativoDoArquivoCriado = $objetoPlanilha->getCaminhoRelativoDoArquivo();
        } catch (Exception $ex) {
            $errosPlanilha[] = $ex->getMessage();
        }


    }

?>
<script language=javascript>
function validar(form) {

    var camposObrigatorios = {
        'sjd_ref': 'Número',
        'sjd_ref_ano': 'Ano',
        'expedicao_data': 'Data',
        'tipo': 'Tipo de Nota'
    }


    for (campoNome in camposObrigatorios) {
        campo=document.getElementsByName('notacomparecimento[' + campoNome + ']')[0];

        if (campo.value=="") {
                window.alert("Preencha o " + camposObrigatorios[campoNome] + "!");
                campo.focus();
                return false;
        }
    }

    return true;
}
</script>
<br />
<form id='notacomparecimento' name="notacomparecimento" action="index.php?<?=http_build_query($urlQuery);?>" method="post" onSubmit="return validar(this);" enctype="multipart/form-data">

<?php
if (!empty($errosPlanilha)) {

    foreach ($errosPlanilha as $e) {
        echo "<h3>{$e}</h3>";
    }

}
?>
<table class="bordasimples" width="100%" cellpadding="0px">

<?php

form::openTR();
	form::openTD('colspan="2"');
	        echo "<h1>Cadastro Massificado - Etapa 1";
	form::closeTD();
form::closeTR();
form::openTR();
    form::openTD('colspan="2"');
    form::openLabel("Modelos para download:");?>
    - <a href="planilha/modelo.xls">Microsoft Excel 97/2000/XP/2003</a><br />
    - <a href="planilha/modelo.xlsx">Microsoft Excel 2007/2010/2013</a><br />
    - <a href="planilha/modelo.ots">Planilha de formato aberto (Open Document Format)</a>
<?php
form::closeLabel();
    form::closeTD();
form::closeTR();
form::openTR();
        form::openTD();
        if (!isset($nomeDoArquivoCriado)) {
		form::openLabel("Informe o arquivo com a planilha que contém os dados");
	        echo "<input name='planilhamassificado' type='file' onchange='this.form.submit()'>";
		form::closeLabel();

        } else {
                form::openLabel("Arquivo enviado");
                echo "<input type='hidden' name='nome_original_do_arquivo' value='{$nomeOriginalDoArquivo}'>";
                echo "<input type='hidden' name='nome_do_arquivo_criado' value='{$nomeDoArquivoCriado}'>";
                echo "<a href='{$caminhoRelativoDoArquivoCriado}'>{$nomeDoArquivoCriado}</a> <a href='index.php?reiniciarcadastro=1&" .http_build_query($urlQuery). "'><img border='0' src='img/wrong.gif'></a>";
                form::closeLabel();
        }
        form::closeTD();
	form::openTD();
        if (isset($nomeDoArquivoCriado)) {
		form::openLabel("Selecione a planilha");
                echo "<input type='hidden' name='etapamassificado' value='1'>";
	        echo "<select name='nome_da_folha'>";
                foreach ($folhasDaPlanilha as $s) {
                    $sEsc = escaparHtml($s);
                    echo '<option value="' . $sEsc .'" >';
                    echo $sEsc;
                    echo "</option>";
                }
                echo "</select>";

		form::closeLabel();

        }
        form::closeTD();
form::closeTR();
form::openTR();
	form::openTD();
        if (isset($nomeDoArquivoCriado)) {
	    echo "<input type='submit' value='Próximo'>";
        } else {
            echo "<input type='submit' value='Carregar'>";
        }
	form::closeTD();
form::closeTR();
?>
</table>
<br />
<?php include 'listaapresentacaomassificado.inc.php'; ?>
