<?php
if ($user['nivel']==6 || $user['nivel']==7) { $opcaoGeral="readonly"; $opcaoGeral2="disabled"; } // alteracao solicitada pelo Cap Todisco

//Campos padrao para serem mostrados na lista
if (!$_REQUEST['mostrar']) {
	$_REQUEST['mostrar']=Array("ultimodia_data","classpunicao","gradacao","descricao_txt","opm_abreviatura");
}

$policialRg = $_REQUEST['policial']['rg'];

$tabela = new TabelaHtml();
$tabela->setUrlBasica("?module={$module}&opcao={$opcao}&policial[rg]={$policialRg}");
$tabela->setTitulo("Apresentações");


$sql = "SELECT a.*, pm.nome, pm.rg, pm.cargo, pm.quadro, pm.subquadro, cs.apresentacaoclassificacaosigilo, tp.apresentacaotipoprocesso, c.apresentacaocondicao, "
   . " opm.ABREVIATURA as opmsigla, opmApres.ABREVIATURA as apres_opm, "
   . " s.apresentacaosituacao "
   . " FROM `apresentacao` a "

   . " LEFT JOIN `RHPARANA`.`POLICIAL` pm ON pm.rg = a.pessoa_rg "
   . " LEFT JOIN `apresentacaoclassificacaosigilo` cs ON cs.id_apresentacaoclassificacaosigilo = a.id_apresentacaoclassificacaosigilo "
   . " LEFT JOIN `apresentacaotipoprocesso` tp ON tp.id_apresentacaotipoprocesso = a.id_apresentacaotipoprocesso "
   . " LEFT JOIN `apresentacaocondicao` c ON c.id_apresentacaocondicao = a.id_apresentacaocondicao "
   . " LEFT JOIN `apresentacaosituacao` s ON a.id_apresentacaosituacao = s.id_apresentacaosituacao "
   . " LEFT JOIN `RHPARANA`.`opmPMPR` opm ON pm.opm_meta4 = opm.META4"
   . " LEFT JOIN `RHPARANA`.`opmPMPR` opmApres ON a.cdopm = opmApres.CODIGOBASE"
        ;
$query = new Query(new PDO($pdo['dsn']['sjd'],$pdo['user'],$pdo['password']), $sql);
//pre($query);
$tabela->setQuery($query);

// primeiro filtro permanente
$filtro = new FiltroTabela();
$filtro->setNome('permanente');
$filtro->setComparador(function() use ($policialRg) {
    return sprintf("a.pessoa_rg = '%s'", $policialRg);
});
$tabela->filtrosPermanentes->attach($filtro);

// não exibe ag. publicacao e temporarias
$filtro = new FiltroTabela();
$filtro->setNome('pendentes');
$filtro->setComparador(function(){
    return sprintf(" a.id_apresentacaosituacao NOT IN (7,8) ");
});
$tabela->filtrosPermanentes->attach($filtro);

$coluna = new ColunaHtml('Nº Apres.',function($row){
    return "<a href='?module=apresentacao&apresentacao[id]={$row['id_apresentacao']}]'>{$row['sjd_ref']}/{$row['sjd_ref_ano']}</a>";
});
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
    return str_replace('?', '-',$row['comparecimento_local_txt']);
}));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Data/Hora', array('a.comparecimento_dh','comparecimento_dh'));
$coluna->setTipo(ColunaHtml::COL_DATETIME);
$coluna->setDateFormat("d/m/Y H:i");
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Situação', array('s.apresentacaosituacao', 'apresentacaosituacao'));
$tabela->colunas->attach($coluna);

$tabela->render();