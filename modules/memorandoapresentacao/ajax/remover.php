<?php


if (isset($_REQUEST['id_apresentacao'])) {

    $chave = array_search($_REQUEST['id_apresentacao'], $idsApresentacoesSelecionadas);

    if ($chave !== false) {
        unset($idsApresentacoesSelecionadas[$chave]);
    }

}

