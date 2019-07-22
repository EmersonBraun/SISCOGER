<?php /**
<form id='correio' action='<?=$_SERVER['REQUEST_URI'];?>' method='POST'>
<table class='bordasimples' width='100%'>
<tr>
	<td colspan='4'>
		<h2>Filtro
			<a href='#noplace' onclick='$("#linhafiltro").show()'>+</a>
			<a href='#noplace' onclick='$("#linhafiltro").hide()'>-</a>
		</h2>
        </td>
</tr>
<tr id='linhafiltro' style='display:none;'>
    <td><b><label>Contexto:</label></b> <br /> <input type="text" name="correio[contexto_email]" /></td>
    <td><b><label>Assunto:</label></b> <br /> <input type="text" name="correio[assunto]" /></td>
    <td><b><label>Destinatario:</label></b> <br /> <input type="text" name="filtro_destinatario" /></td>
    <td><input type='submit' value='Listar' name='filtro'></td>
</tr>
</table>
</form>
<br />
 *
 */
?>
<?php

$tabela = new TabelaHtml();
$tabela->setUrlBasica("?module={$module}&opcao=listar");
$tabela->setTitulo($opm_login->descricao);
$tabela->setSubtitulo('Emails agendados');

$sql = <<<SQL
        SELECT
            `email`.`id_email`,
            `email`.`contexto_email`,
            `email`.`id_contexto_email`,
            `email`.`destinatario_nome`,
            `email`.`destinatario_email`,
            `email`.`assunto`,
            `email`.`anexos`,
            `email`.`usuario_rg`,
            `email`.`dh`,

            CASE
		WHEN `email`.`dh_confirmacao_de_leitura`THEN 'Leitura Confirmada' is not null
                WHEN `email`.`dh_cancelamento` is not null THEN 'Cancelado'
                WHEN `email`.`dh_envio` is not null THEN 'Enviado'
                WHEN `email`.`dh_ult_tentativa_com_erro` is not null THEN concat('Erro:',`email`.`nr_tentativas_com_erro`)
                WHEN `email`.`dh_agendamento` is not null THEN 'Agendado'
                ELSE 'Pendente' END AS 'status',
            CASE
                WHEN `email`.`dh_confirmacao_de_leitura`THEN `email`.`dh_confirmacao_de_leitura` is not null
                WHEN `email`.`dh_cancelamento` is not null THEN `email`.`dh_cancelamento`
                WHEN `email`.`dh_envio` is not null THEN `email`.`dh_envio`
                WHEN `email`.`dh_ult_tentativa_com_erro` is not null THEN `email`.`dh_ult_tentativa_com_erro`
                WHEN `email`.`dh_agendamento` is not null THEN `email`.`dh_agendamento`
                ELSE `email`.`dh` END AS 'dh_status',
            `email`.`erros`,
            `email`.`prioridade`,
            `email`.`usuario_rg_cancelamento`
        FROM `sjd`.`email`
SQL;

$query = new Query(new PDO($pdo['dsn']['sjd'],$pdo['user'],$pdo['password']), $sql);
$tabela->setQuery($query);

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


if (isset($filtroBusca['data_cadastro_ini']) && !empty($filtroBusca['data_cadastro_ini'])) {

    $filtro = new FiltroTabela();
    $filtro->setNome('data_cadastro_ini');
    $filtro->setComparador(function($valor) {

        $data = DateTime::createFromFormat("d/m/Y", $valor);
        if ($data instanceof DateTime) {
            return sprintf("a.criacao_dh >= '%s 00:00:00'", mysql_real_escape_string($data->format("Y-m-d")));
        }
    });
    $filtro->setValor($filtroBusca['data_cadastro_ini']);
    $tabela->filtros->attach($filtro);
}

if (isset($filtroBusca['data_cadastro_fim']) && !empty($filtroBusca['data_cadastro_fim'])) {
    $filtro = new FiltroTabela();
    $filtro->setNome('data_cadastro_fim');
    $filtro->setComparador(function($valor) {

        $data = DateTime::createFromFormat("d/m/Y", $valor);
        if ($data instanceof DateTime) {
            return sprintf("a.criacao_dh <= '%s 23:59:59'", mysql_real_escape_string($data->format("Y-m-d")));
        }
    });
    $filtro->setValor($filtroBusca['data_cadastro_fim']);
    $tabela->filtros->attach($filtro);
}


if (isset($filtroBusca['pessoa_rg']) && !empty($filtroBusca['pessoa_rg'])) {
    $filtro = new FiltroTabela();
    $filtro->setNome('pessoa_rg');
    $filtro->setComparador(function($valor) {

        $nome = '%'.mysql_real_escape_string($valor).'%';
        $rg = '%'.mysql_real_escape_string(preg_replace('/[^0-9]/','',$valor)).'%';

        return sprintf(" ( a.pessoa_nome like '%s' OR a.pessoa_rg like '%s' ) ",
                $nome ,$rg);
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

if (isset($filtroBusca['numero']) && !empty($filtroBusca['numero'])) {
    $filtro = new FiltroTabela();
    $filtro->setNome('numero');
    $filtro->setComparador(function($valor) {
        $valores = explode('/', $valor);
        $numero = isset($valores[0]) ? (integer)$valores[0] : 0;
        $ano = isset($valores[1]) ? (integer)$valores[1] : 0;

        if ($ano == 0 ) {
            return " ( a.sjd_ref = {$numero} ) ";
        } else {
            return " ( a.sjd_ref = {$numero} AND a.sjd_ref_ano = {$ano} ) ";
        }

    });
    $filtro->setValor($filtroBusca['numero']);
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

if (isset($filtroBusca['id_apresentacaosituacao']) && !empty($filtroBusca['id_apresentacaosituacao'])) {
    $filtro = new FiltroTabela();
    $filtro->setNome('apresentacaosituacao');
    $filtro->setComparador(function($valor) {
        $valor = mysql_real_escape_string($valor);
        return " ( a.id_apresentacaosituacao = {$valor} ) ";
    });
    $filtro->setValor($filtroBusca['id_apresentacaosituacao']);
    $tabela->filtros->attach($filtro);
}

$coluna = new ColunaHtml('ID',array('id_email',function($row){
    return "<a href='?module=email&email[id]={$row['id_email']}'>{$row['id_email']}</a>";
}));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Contexto',array('id_contexto_email',function($row){
    if (class_exists($row['contexto_email'])) {
        $contexto = new $row['contexto_email']();
        $contexto->setValues(array('id' => $row['id_contexto_email']));

        if (property_exists($contexto, 'sjd_ref')) {
            return "<a href='?module={$row['contexto_email']}&{$row['contexto_email']}[id]={$row['id_contexto_email']}'>{$row['contexto_email']} nº {$contexto->sjd_ref}/{$contexto->sjd_ref_ano}</a>";
        }

        return "<a href='?module={$row['contexto_email']}&{$row['contexto_email']}[id]={$row['id_contexto_email']}'>{$row['contexto_email']} nº {$row['id_contexto_email']}</a>";
    }
    return $row['contexto_email'];
}));

$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Destinatário',array('destinatario_nome',function($row){
    return "{$row['destinatario_nome']} ({$row['destinatario_email']})";
}));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Assunto','assunto');
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Criação', array('dh','dh'));
$coluna->setTipo(ColunaHtml::COL_DATETIME);
$coluna->setDateFormat("d/m/y H:i");
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Prioridade','prioridade');
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Situação','status');
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Data relativa a situação', array('dh_status','dh_status'));
$coluna->setTipo(ColunaHtml::COL_DATETIME);
$coluna->setDateFormat("d/m/y H:i");
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Usuário','usuario_rg');
$tabela->colunas->attach($coluna);

$tabela->setOrdemPadrao('id_email DESC');

$tabela->render();
