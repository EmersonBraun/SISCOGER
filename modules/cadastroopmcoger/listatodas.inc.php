<?
//error_reporting( E_ALL );

//resolve bug option_opm
$apresentacao->cdopm = null;

include ("filtro.inc.php");

$filtroBusca = $_REQUEST['filtro_busca'];

echo '<br />';
$tabela = new TabelaHtml();
$tabela->setUrlBasica("?module={$module}&opcao={$opcao}");
$tabela->setTitulo($opm_login->descricao);
$tabela->setSubtitulo('Apresentações - 2016 (Todas)');

$sql = "SELECT a.*, pm.nome, pm.rg, pm.cargo, pm.quadro, pm.subquadro, cs.apresentacaoclassificacaosigilo, tp.apresentacaotipoprocesso, c.apresentacaocondicao, "
   . " opm.ABREVIATURA as opmsigla, opmApres.ABREVIATURA as apres_opm, "
   . " s.apresentacaosituacao "
   . " FROM `apresentacao` a "

   . " LEFT JOIN `RHPARANA`.`POLICIAL` pm ON pm.rg = a.pessoa_rg "
   . " LEFT JOIN `RHPARANA`.`posto` posto ON a.pessoa_posto = posto.posto "
   . " LEFT JOIN `apresentacaoclassificacaosigilo` cs ON cs.id_apresentacaoclassificacaosigilo = a.id_apresentacaoclassificacaosigilo "
   . " LEFT JOIN `apresentacaotipoprocesso` tp ON tp.id_apresentacaotipoprocesso = a.id_apresentacaotipoprocesso "
   . " LEFT JOIN `apresentacaocondicao` c ON c.id_apresentacaocondicao = a.id_apresentacaocondicao "
   . " LEFT JOIN `apresentacaosituacao` s ON a.id_apresentacaosituacao = s.id_apresentacaosituacao "
   . " LEFT JOIN `RHPARANA`.`opmPMPR` opm ON pm.opm_meta4 = opm.META4"
   . " LEFT JOIN `RHPARANA`.`opmPMPR` opmApres ON a.cdopm = opmApres.CODIGOBASE"
        ;
$query = new Query(new PDO($pdo['dsn']['sjd'],$pdo['user'],$pdo['password']), $sql);
$tabela->setQuery($query);

// não exibe ag. publicacao e e
$filtro = new FiltroTabela();
$filtro->setNome('pendentes');
$filtro->setComparador(function(){
    return sprintf(" a.id_apresentacaosituacao NOT IN (7,8) ");
});
$tabela->filtrosPermanentes->attach($filtro);


if (isset($filtroBusca['opm_cadastro']) && !empty($filtroBusca['opm_cadastro'])) {
    $filtro = new FiltroTabela();
    $filtro->setNome('opm_cadastro');
    $filtro->setComparador(function($valor) {

        if (substr($valor,0,3)=="EQ_") {
            $valor=substr($valor,3);
            $valor = mysql_real_escape_string($valor);
            return "a.cdopm like '{$valor}'";
        } else {
            $valor = mysql_real_escape_string($valor);
            return "a.cdopm like '{$valor}%'";
        }

    });
    $filtro->setValor($filtroBusca['opm_cadastro']);
    $tabela->filtros->attach($filtro);
}


if (!in_array($user["nivel"], array(4,5))) {
    $filtro = new FiltroTabela();
    $filtro->setNome('publicas');
    $idPostoUsuario = $usuario->id_posto;
    $rgDoUsuario = $user['UserLogin'];
    $filtro->setComparador(function() use ($idPostoUsuario, $rgDoUsuario) {
        return sprintf(" ( (a.id_apresentacaoclassificacaosigilo IN (1,2)) OR (a.id_apresentacaoclassificacaosigilo = 3 AND id_posto >= %d )  OR (a.id_apresentacaoclassificacaosigilo = 4 AND a.pessoa_rg = '%s' ) OR ( a.usuario_rg = '%s' ) )", $idPostoUsuario, $rgDoUsuario, $rgDoUsuario);
    });
    $tabela->filtrosPermanentes->attach($filtro);
}

if (isset($filtroBusca['data_ini']) && !empty($filtroBusca['data_ini'])) {
    $filtro = new FiltroTabela();
    $filtro->setNome('data_ini');
    $filtro->setComparador(function($valor) {

        $data = DateTime::createFromFormat("d/m/Y", $valor);
        if ($data instanceof DateTime) {
            return sprintf("a.comparecimento_data >= '%s'", mysql_real_escape_string($data->format("Y-m-d")));
        }
    });
    $filtro->setValor($filtroBusca['data_ini']);
    $tabela->filtros->attach($filtro);
}

if (isset($filtroBusca['data_fim']) && !empty($filtroBusca['data_fim'])) {
    $filtro = new FiltroTabela();
    $filtro->setNome('data_fim');
    $filtro->setComparador(function($valor) {

        $data = DateTime::createFromFormat("d/m/Y", $valor);
        if ($data instanceof DateTime) {
            return sprintf("a.comparecimento_data <= '%s'", mysql_real_escape_string($data->format("Y-m-d")));
        }
    });
    $filtro->setValor($filtroBusca['data_fim']);
    $tabela->filtros->attach($filtro);
}

if (isset($filtroBusca['pessoa_rg']) && !empty($filtroBusca['pessoa_rg'])) {
    $filtro = new FiltroTabela();
    $filtro->setNome('pessoa_rg');
    $filtro->setComparador(function($valor) {
        $valor = mysql_real_escape_string($valor);
        return " ( a.pessoa_nome like '%{$valor}%' OR a.pessoa_rg like '%{$valor}%' ) ";
    });
    $filtro->setValor($filtroBusca['pessoa_rg']);
    $tabela->filtros->attach($filtro);
}

if (isset($filtroBusca['opm_pessoa']) && !empty($filtroBusca['opm_pessoa'])) {
    $filtro = new FiltroTabela();
    $filtro->setNome('opm_pessoa');
    $filtro->setComparador(function($valor) {

        if (substr($valor,0,3)=="EQ_") {
            $valor=substr($valor,3);
            $valor = mysql_real_escape_string($valor);
            return "a.pessoa_opm_codigo like '{$valor}'";
        } else {
            $valor = mysql_real_escape_string($valor);
            return "a.pessoa_opm_codigo like '{$valor}%'";
        }

    });
    $filtro->setValor($filtroBusca['opm_pessoa']);
    $tabela->filtros->attach($filtro);
}

if (isset($filtroBusca['documento_de_origem']) && !empty($filtroBusca['documento_de_origem'])) {
    $filtro = new FiltroTabela();
    $filtro->setNome('documento_de_origem');
    $filtro->setComparador(function($valor) {
        $valor = str_replace(' ', '%', $valor);
        $valor = str_replace('.', '%', $valor);
        $valor = str_replace('-', '%', $valor);
        $valor = mysql_real_escape_string($valor);
        return " ( a.documento_de_origem like '%{$valor}%' ) ";
    });
    $filtro->setValor($filtroBusca['documento_de_origem']);
    $tabela->filtros->attach($filtro);
}

if (isset($filtroBusca['autos_numero']) && !empty($filtroBusca['autos_numero'])) {
    $filtro = new FiltroTabela();
    $filtro->setNome('autos_numero');
    $filtro->setComparador(function($valor) {
        $valor = str_replace(' ', '%', $valor);
        $valor = str_replace('.', '%', $valor);
        $valor = str_replace('-', '%', $valor);
        $valor = mysql_real_escape_string($valor);
        return " ( a.autos_numero like '%{$valor}%' ) ";
    });
    $filtro->setValor($filtroBusca['autos_numero']);
    $tabela->filtros->attach($filtro);
}


if (isset($filtroBusca['local']) && !empty($filtroBusca['local'])) {
    $filtro = new FiltroTabela();
    $filtro->setNome('local');
    $filtro->setComparador(function($valor) {
        $valor = str_replace(' ', '%', $valor);
        $valor = str_replace('.', '%', $valor);
        $valor = str_replace('-', '%', $valor);
        $valor = mysql_real_escape_string($valor);
        return " ( a.comparecimento_local_txt like '%{$valor}%' ) ";
    });
    $filtro->setValor($filtroBusca['local']);
    $tabela->filtros->attach($filtro);
}

$coluna = new ColunaHtml('Nº Apres.',array('a.id_apresentacao',function($row){
    return "<a href='?module=apresentacao&apresentacao[id]={$row['id_apresentacao']}'>{$row['sjd_ref']}/{$row['sjd_ref_ano']}</a>";
}));
$tabela->colunas->attach($coluna);

if ($user['nivel']!=2) {
    $coluna = new ColunaHtml('OPM',array('opmApres.ABREVIATURA', 'apres_opm'));
    $tabela->colunas->attach($coluna);
}

$coluna = new ColunaHtml('Nº Of.',array('a.documento_de_origem','documento_de_origem'));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('RG',array('a.pessoa_rg', 'rg'));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Cargo',array('posto.id_posto', 'pessoa_posto'));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Nome',function($row){
    if (!empty($row['rg'])) {
        $pessoa .= " {$row['nome']}";
    } else {
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

$coluna = new ColunaHtml('Local', array('a.comparecimento_local_txt', 'comparecimento_local_txt'));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Data/Hora', array('a.comparecimento_dh','comparecimento_dh'));
$coluna->setTipo(ColunaHtml::COL_DATETIME);
$coluna->setDateFormat("d/m/Y H:i");
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Situação', array('s.apresentacaosituacao', 'apresentacaosituacao'));
$tabela->colunas->attach($coluna);

$tabela->render();

$id = md5(date("YmdHisu"));

$_SESSION['sqlParaPlanilha'][$id] = $tabela->getSql();

?>
<p style="text-align: center"><a href="?module=apresentacao&opcao=download&_id=<?=$id;?>&noheader&nomenu">Download</a></p>