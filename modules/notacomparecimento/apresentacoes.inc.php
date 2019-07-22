<br />
<?php

$tabela = new TabelaHtml();
$tabela->setUrlBasica("?module={$module}&opcao={$opcao}&notacomparecimento[id]={$notacomparecimento->id_notacomparecimento}");
$tabela->setTitulo(sprintf('Apresentacações - Nota nº %s/%s', $notacomparecimento->sjd_ref, $notacomparecimento->sjd_ref_ano));
//$tabela->setQtdeRegistroPorPaginaPadrao(2);

$sql = "SELECT a.*, pm.nome, pm.rg, pm.cargo, pm.quadro, pm.subquadro, cs.apresentacaoclassificacaosigilo, tp.apresentacaotipoprocesso, c.apresentacaocondicao, opm.ABREVIATURA as opmsigla, opmApres.ABREVIATURA as apres_opm,"
   . " n.apresentacaonotificacao, "
   . " s.apresentacaosituacao FROM `apresentacao` a "
   . " LEFT JOIN `RHPARANA`.`POLICIAL` pm ON pm.rg = a.pessoa_rg "
   . " LEFT JOIN `apresentacaoclassificacaosigilo` cs ON cs.id_apresentacaoclassificacaosigilo = a.id_apresentacaoclassificacaosigilo "
   . " LEFT JOIN `apresentacaotipoprocesso` tp ON tp.id_apresentacaotipoprocesso = a.id_apresentacaotipoprocesso "
   . " LEFT JOIN `apresentacaocondicao` c ON c.id_apresentacaocondicao = a.id_apresentacaocondicao "
   . " LEFT JOIN `apresentacaosituacao` s ON s.id_apresentacaosituacao = a.id_apresentacaosituacao "
   . " LEFT JOIN `apresentacaonotificacao` n ON a.id_apresentacaonotificacao = n.id_apresentacaonotificacao "
   . " LEFT JOIN `RHPARANA`.`opmPMPR` opm ON pm.opm_meta4 = opm.META4"
   . " LEFT JOIN `RHPARANA`.`opmPMPR` opmApres ON a.cdopm = opmApres.CODIGOBASE"
        ;
$query = new Query(new PDO($pdo['dsn']['sjd'],$pdo['user'],$pdo['password']), $sql);
$tabela->setQuery($query);

// apresentacoes da nota
$filtro = new FiltroTabela();
$filtro->setNome('permanente');

$filtro->setComparador(function() use ($notacomparecimento){
    return sprintf("id_notacomparecimento = %s", $notacomparecimento->id_notacomparecimento);
});
$tabela->filtrosPermanentes->attach($filtro);

$coluna = new ColunaHtml('Nº Apres.',array('a.id_apresentacao',function($row) use ($notacomparecimento){
    return "<a href='?module=apresentacao&apresentacao[id]={$row['id_apresentacao']}&notacomparecimento[id]={$notacomparecimento->id_notacomparecimento}'>{$row['sjd_ref']}/{$row['sjd_ref_ano']}</a>";
}));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Not.',array('n.apresentacaonotificacao',function($row){
    $data = DateTime::createFromFormat("Y-m-d", $row['comparecimento_data']);
    $dataDeHoje = DateTime::createFromFormat("Y-m-d", date("Y-m-d"));

    $intervalo = $dataDeHoje->diff($data);

    $destacar = false;
    if ($intervalo->days < 7) {
        $destacar = true;
    }

    $img = apresentacaonotificacao::getImg($row['id_apresentacaonotificacao'],$destacar);
    return "<center>{$img}</center>";
}));
$tabela->colunas->attach($coluna);

if ($user['nivel']!=2) {
    $coluna = new ColunaHtml('OPM',array('opmApres.ABREVIATURA', 'apres_opm'));
    $tabela->colunas->attach($coluna);
}

$coluna = new ColunaHtml('Nº Of.',array('a.documento_de_origem','documento_de_origem'));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Pessoa',function($row){
    if (!empty($row['rg'])) {
        $pessoa = "{$row['cargo']}";
        $pessoa .= " {$row['quadro']}";
        if ($row['subquadro'] != 'NA') {
            $pessoa .= " {$row['subquadro']}";
        }
        $pessoa .= " {$row['nome']}";
    } else {
        $pessoa = "{$row['pessoa_cargo']}";
        $pessoa .= " {$row['pessoa_quadro']}";
        $pessoa .= " {$row['pessoa_nome']}";
    }
    return $pessoa;
});
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Unidade', function($row){
    if (!empty($row['opmsigla'])) {
        $opmsigla = "{$row['opmsigla']}";
    } else {
        $opmsigla = "{$row['pessoa_unidade_lotacao_sigla']}";
    }

    return $opmsigla;
});
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Tipo',array('tp.apresentacaotipoprocesso', 'apresentacaotipoprocesso'));
$tabela->colunas->attach($coluna);
$coluna = new ColunaHtml('Autos','autos_numero');
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Condição', array('c.apresentacaocondicao','apresentacaocondicao'));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Local', array('a.comparecimento_local_txt', function($row){
    $texto = $row['comparecimento_local_txt'];
    $textoReduzido = substr($texto, 0, 35);

    $continua = $texto == $textoReduzido ? "" : "...";

    return sprintf("<span title='%s' onclick='javascript: (function(elm){elm.innerHTML = elm.title;})(this)'>%s%s</span>",  escaparHtml($texto), escaparHtml($textoReduzido), $continua);
}));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Data/Hora', array('a.comparecimento_dh','comparecimento_dh'));
$coluna->setTipo(ColunaHtml::COL_DATETIME);
$coluna->setDateFormat("d/m/Y H:i");
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Situação', array('s.apresentacaosituacao', 'apresentacaosituacao'));
$tabela->colunas->attach($coluna);

$tabela->render();
