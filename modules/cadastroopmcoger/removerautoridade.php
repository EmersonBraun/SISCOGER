<?php

$cadastroopmcogerautoridade = new cadastroopmcogerautoridade();

if (isset($_REQUEST['cadastroopmcogerautoridade']['id']) && isset($_REQUEST['validacao'])
    && $_REQUEST['validacao'] == md5(md5($_REQUEST['cadastroopmcogerautoridade']['id']))
    ) {
    $cadastroopmcogerautoridade->setValues($_REQUEST['cadastroopmcogerautoridade']);
    cadastroopmcogerautoridade::apaga($cadastroopmcogerautoridade);
}

