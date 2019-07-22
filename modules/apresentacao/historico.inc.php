<?php
//error_reporting( E_ALL );

echo '<br />';
$tabela = new TabelaHtml();
$tabela->setUrlBasica("?module={$module}&opcao=atualizar&apresentacao[id]={$apresentacao->id_apresentacao}");
$tabela->setTitulo('HISTÓRICO DE ALTERAÇÕES');

$sql = "SELECT * FROM historicocontrolado";

$query = new Query(new PDO($pdo['dsn']['sjd'],$pdo['user'],$pdo['password']), $sql);
$tabela->setQuery($query);

// primeiro filtro permanente
$filtro = new FiltroTabela();
$filtro->setNome('permanente');
$filtro->setComparador(function() use ($apresentacao, $module){
    return sprintf("tabela ='%s' AND id_tabela = %s", mysql_real_escape_string($module), mysql_real_escape_string($apresentacao->id_apresentacao));
});
$tabela->filtrosPermanentes->attach($filtro);

$coluna = new ColunaHtml('Data/Hora', 'dh');
$coluna->setTipo(ColunaHtml::COL_DATETIME);
$coluna->setDateFormat("d/m/Y H:i");
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Usuário', 'usuario_nome');
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('IP', 'ip');
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Campo', array('campo', function($row){
    return apresentacao::$labels[$row['campo']];
}));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Anterior', array('valor_antigo',function($row){
    if ($row['campo'] == 'memorando_pdf') {
        return "<a href='{$row['valor_antigo']}'>{$row['valor_antigo']}</a>";
    }
    return $row['valor_antigo'];
}));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Novo', array('valor_novo',function($row){
    if ($row['campo'] == 'memorando_pdf') {
        return "<a href='{$row['valor_novo']}'>{$row['valor_novo']}</a>";
    }
    return $row['valor_novo'];
}));
$tabela->colunas->attach($coluna);

$tabela->setQtdeRegistroPorPaginaPadrao(10);
$tabela->setOrdemPadrao("id_historicocontrolado DESC");

$tabela->render();
