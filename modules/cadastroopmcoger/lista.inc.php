<?php

//error_reporting( E_ALL );

echo '<br />';
$tabela = new TabelaHtml();
$tabela->setUrlBasica("?module={$module}&opcao={$opcao}");
$tabela->setTitulo($opm_login->descricao);
$tabela->setSubtitulo('Cadastro de Unidades');

$sql = "SELECT c.*,"
   . " opmIntermed.ABREVIATURA as opm_interm_sigla, "
   . " opm.ABREVIATURA, "
   . " pm.cargo, pm.quadro, pm.subquadro, pm.nome, "
   . " pm_autoridade.cargo as autoridade_cargo, pm_autoridade.quadro as autoridade_quadro, pm_autoridade.subquadro as autoridade_subquadro, pm_autoridade.nome as autoridade_nome, "
   . " m.municipio, m.nomecomacento "
   . " FROM `cadastroopmcoger` c "
   . " LEFT JOIN `RHPARANA`.`POLICIAL` pm_autoridade ON c.opm_autoridade_rg = pm_autoridade.rg"
   . " LEFT JOIN `RHPARANA`.`POLICIAL` pm ON c.usuario_rg = pm.rg"
   . " LEFT JOIN `RHPARANA`.`opmPMPR` opm ON c.cdopm = opm.CODIGOBASE"
   . " LEFT JOIN `RHPARANA`.`opmPMPR` opmIntermed ON c.opm_intermediaria_cdopm = opmIntermed.CODIGOBASE"
   . " LEFT JOIN `sjd`.`municipio` m ON c.id_municipio = m.id_municipio"
   ;

$query = new Query(new PDO($pdo['dsn']['sjd'],$pdo['user'],$pdo['password']), $sql);
$tabela->setQuery($query);

$coluna = new ColunaHtml('OM. Interm.', array('opmIntermed.CODIGO', function($row){
    return "{$row['opm_interm_sigla']}";
}));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Unidade', array('c.ABREVIATURA', function($row){
    return "<a href='?module=cadastroopmcoger&cadastroopmcoger[id]={$row['id_cadastroopmcoger']}'>{$row['ABREVIATURA']}</a>";
}));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Município', array('m.nomecomacento','nomecomacento'));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Comandante/Chefe/Diretor', array('c.opm_autoridade_nome',function($row){

    $cargo = FHelperICO::converterCargoMeta4EmCargoIco($row['autoridade_cargo']);

    $quadro = FHelperICO::converterQuadroEmQuadroIco($row['autoridade_quadro'], $row['autoridade_subquadro']);

    $nome = FHelperICO::converterNomeMeta4EmNomeIco($row['autoridade_nome']);

    return escaparHtml("{$cargo} {$quadro} {$nome}");
}));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Responsável pela atualização', array('pm.nome', function($row){

    $cargo = FHelperICO::converterCargoMeta4EmCargoIco($row['cargo']);

    $quadro = FHelperICO::converterQuadroEmQuadroIco($row['quadro'], $row['subquadro']);

    $nome = FHelperICO::converterNomeMeta4EmNomeIco($row['nome']);

    return escaparHtml("{$cargo} {$quadro} {$nome}");
}));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Data/Hora Atualização', array('c.dh','dh'));
$coluna->setTipo(ColunaHtml::COL_DATETIME);
$coluna->setDateFormat("d/m/Y H:i");
$tabela->colunas->attach($coluna);

$tabela->setOrdemPadrao('opmIntermed.CODIGO, opm.ABREVIATURA');

$tabela->render();
