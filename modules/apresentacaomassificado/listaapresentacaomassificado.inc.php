<?
//error_reporting( E_ALL );

$tabela = new TabelaHtml();
if (isset($notacomparecimento)) {

    $tabela->setUrlBasica("?module={$module}&opcao={$opcao}&notacomparecimento[id]={$notacomparecimento->id_notacomparecimento}");
} else {
    $tabela->setUrlBasica("?module={$module}&opcao={$opcao}");
}

$tabela->setTitulo($opm_login->descricao);
$tabela->setSubtitulo('Últimos arquivos manipulados');

$sql = "SELECT * FROM apresentacaomassificado";

$query = new Query(new PDO($pdo['dsn']['sjd'],$pdo['user'],$pdo['password']), $sql);
$tabela->setQuery($query);


// primeiro filtro permanente
if (isset($notacomparecimento->id_notacomparecimento)) {
    $filtro = new FiltroTabela();
    $filtro->setNome('nota comparecimento');
    $filtro->setComparador(function() use ($notacomparecimento){
        return sprintf(" id_notacomparecimento = %s ", $notacomparecimento->id_notacomparecimento);
    });
    $tabela->filtrosPermanentes->attach($filtro);
} else {
    $filtro = new FiltroTabela();
    $filtro->setNome('nota comparecimento');
    $filtro->setComparador(function() {
        return sprintf(" ( id_notacomparecimento is null or id_notacomparecimento = 0) ", $notacomparecimento->id_notacomparecimento);
    });
    $tabela->filtrosPermanentes->attach($filtro);
}

if (!in_array($user['nivel'], array(5))) {
$filtro = new FiltroTabela();
$filtro->setNome('Usuario Ou OPM');
$filtro->setComparador(function($valor) use ($cdopm,$user){
    return " ( cdopm = '{$cdopm}' OR usuario_rg = '{$user['UserLogin']}' ) ";
});
$tabela->filtros->attach($filtro);
}
$planTemp = new FPlanilha();
$pathPlanilha = $planTemp->getCaminhoRelativoDoArquivo();
$caminhoDaPastaPlanilha = $planTemp->getPastaPlanilhas();

$coluna = new ColunaHtml('Nome do arquivo', array('nome_original_do_arquivo',function($row) use ($pathPlanilha,$caminhoDaPastaPlanilha){
    $retorno = "{$row['nome_original_do_arquivo']} (<a href='{$pathPlanilha}{$row['nome_do_arquivo']}'>Original</a>)";

    $arquivoS = explode('.', $row['nome_do_arquivo']);
$arquivoS = "{$arquivoS[0]}-sistema.xls";
    $arquivoSPath = "{$caminhoDaPastaPlanilha}/{$arquivoS}";

    if (file_exists($arquivoSPath)) {
        $retorno .= "(<a href='{$pathPlanilha}{$arquivoS}'>Sistema</a>)";
    }

    return $retorno;
}));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Planilha', array('nome_da_folha','nome_da_folha'));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Data', array('datahora', function($row){
    $data = new DateTime($row['datahora']);
    return $data->format("d/m/Y H:i:s");
}));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Situação', function($row) use ($urlQuery) {

    $urlQuery['apresentacaomassificado']['id'] = $row['id_apresentacaomassificado'];
    $linkDaApresentacaoMassificado = http_build_query($urlQuery);

    switch ($row['situacao']) {
    case apresentacaomassificado::DADOS_DIVERGENTES:
        $a = "<a href='?{$linkDaApresentacaoMassificado}'>Inconsistente</a>";
        break;
    case apresentacaomassificado::TEMP:
        $a = "<a href='?{$linkDaApresentacaoMassificado}'>Temporário</a>";
        break;
    case apresentacaomassificado::IMPORTANDO:
        $a = "<a href='?{$linkDaApresentacaoMassificado}'>Importando dados</a>";
        break;
    case apresentacaomassificado::CONCLUIDA:
        $a = "Concluído";
        break;
    case apresentacaomassificado::ERRO_NA_PLANILHA:
        $a = "<a href='?{$linkDaApresentacaoMassificado}'>Erro na planilha</a>";
        break;
    default:
        $a = "###";
        break;
    }
    return $a;
});
$tabela->colunas->attach($coluna);

$tabela->setOrdemPadrao('datahora DESC');

$tabela->render();
