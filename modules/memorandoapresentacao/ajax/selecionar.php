<?php


if (isset($_REQUEST['id_apresentacao'])) {
    if (!is_array($_REQUEST['id_apresentacao'])) {
        $idsApresentacoesSelecionadas[] = $_REQUEST['id_apresentacao'];
    } else {
        $idsApresentacoesSelecionadas = array_merge($idsApresentacoesSelecionadas, $_REQUEST['id_apresentacao']);
    }

    $idsApresentacoesSelecionadas = array_unique($idsApresentacoesSelecionadas);
}
