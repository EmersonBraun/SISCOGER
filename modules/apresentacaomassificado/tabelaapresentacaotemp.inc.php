<?php

$tabela = new TabelaHtml();

$tabela->setUrlBasica("?" . http_build_query($urlQuery));

$tabela->setTitulo(sprintf('Apresentacações - Nota nº %s/%s', $notacomparecimento->sjd_ref, $notacomparecimento->sjd_ref_ano));
//$tabela->setQtdeRegistroPorPaginaPadrao(2);

$sql = "
    SELECT
        at.id_apresentacao_temp,
        at.linha as linha,
        at.erros_txt,
        at.cdopm,
        at.id_notacomparecimento,
        at.planilha_rg,
        at.pessoa_rg,
        at.planilha_nome,
        at.pessoa_nome,
        at.pessoa_posto,
        at.pessoa_opm_sigla,
        posto.id_posto,
        opm.ABREVIATURA as sigla,
        at.comparecimento_local_txt,
        at.documento_de_origem,
        at.autos_numero,
        opmpm.ABREVIATURA as pm_opm_sigla,
        at.planilha_opm_sigla,
        at.planilha_dia_comp,
        at.comparecimento_data,
        at.planilha_horario_comp,
        at.comparecimento_hora,
        at.comparecimento_dh,
        at.acusados,
        at.observacao_txt,
        at.erros_txt,
        at.divergencia_nome,
        at.divergencia_rg,
        at.divergencia_opm,
        at.erro_dia,
        at.erro_horario,
        concat (
        IF(at.divergencia_nome = 1,'NOME;',''),
        IF(at.divergencia_rg = 1,'RG;',''),
        IF(at.divergencia_OPM = 1,'OPM;',''),
        IF(at.erro_dia = 1,'DATA;',''),
        IF(at.erro_horario = 1,'HORA;','')
        ) as divergencia

    FROM apresentacao_temp at
        LEFT JOIN `RHPARANA`.`posto` posto ON at.pessoa_posto =  posto.posto
        LEFT JOIN `RHPARANA`.`opmPMPR` opm ON at.cdopm =  opm.CODIGOBASE
        LEFT JOIN `RHPARANA`.`opmPMPR` opmpm ON at.pessoa_opm_codigo =  opmpm.CODIGO
";
$query = new Query(new PDO($pdo['dsn']['sjd'], $pdo['user'], $pdo['password']), $sql);
$tabela->setQuery($query);
$tabela->setOrdemPadrao('at.linha ASC');

// apresentacoes da nota
$filtro = new FiltroTabela();
$filtro->setNome('notacomparecimento');
$filtro->setComparador(function() use ($notacomparecimentoId) {
    if (is_null($notacomparecimentoId)) {
        return sprintf("(at.id_notacomparecimento is null OR at.id_notacomparecimento = 0)");
    } else {
        return sprintf("(at.id_notacomparecimento = %s)", $notacomparecimentoId);
    }
});
$tabela->filtrosPermanentes->attach($filtro);
//fim filtro nota

// arquivo
$filtro = new FiltroTabela();
$filtro->setNome('arquivo');
$filtro->setComparador(function() use ($nomeDoArquivoCriado) {
    return sprintf("(at.arquivo = '%s')", mysql_real_escape_string($nomeDoArquivoCriado));
});
$tabela->filtrosPermanentes->attach($filtro);
// fim filtro arquivo

// folha
$filtro = new FiltroTabela();
$filtro->setNome('folha');
$filtro->setComparador(function() use ($nomeDaFolha) {
    return sprintf("(at.folha = '%s')", mysql_real_escape_string($nomeDaFolha));
});
$tabela->filtrosPermanentes->attach($filtro);
// fim filtro folha

$renderizadorDeAtributo = function($row){
    if (!empty($row['divergencia'])) {
        return ' bgcolor = "#FFCCCC" ';
    }
    return '';
};

$coluna = new ColunaHtml('Linha', array('at.linha', 'linha'));
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Nº. Of.', array('at.documento_de_origem', 'documento_de_origem'));
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Local', array('at.comparecimento_local_txt', function($row) {
        $texto = str_replace('?', '-', $row['comparecimento_local_txt']);
        $texto = str_replace("\n", "<br />", escaparHtml($texto));
        return $texto;
    }));
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Autos', array('at.autos_numero', 'autos_numero'));
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('ME', array('at.planilha_nome', function($row) {

    $nome = !empty($row['pessoa_nome']) ? $row['pessoa_posto'] . ' '. $row['pessoa_nome'] : 'Não encontrado';

    if ($row['divergencia_nome'] == 1) {

        $texto = "<b><strike>" . escaparHtml($row['planilha_nome']) ."</strike><br />" .escaparHtml($nome) . "</b>";
        return $texto;
    }
    return escaparHtml($nome);

}));
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('RG', array('at.planilha_rg', function($row) {

    $rg = !empty($row['pessoa_rg']) ? formatarRg($row['pessoa_rg']) : 'Não encontrado';

    if ($row['divergencia_rg'] == 1) {

        $texto = "<b><strike>" . escaparHtml(formatarRg($row['planilha_rg'])) ."</strike><br />" .escaparHtml($rg)."</b>";
        return $texto;
    }
    return escaparHtml($rg);

}));
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Unidade', array('at.planilha_opm_sigla', function($row){

    $opmSigla = !empty($row['pm_opm_sigla']) ? $row['pm_opm_sigla'] : 'Não encontrada';

    if ($row['divergencia_opm'] == 1) {

        $texto = "<b><strike>" . escaparHtml($row['planilha_opm_sigla']) ."</strike><br />" .escaparHtml($opmSigla)."</b>";
        return $texto;
    }
    return escaparHtml($opmSigla);

}));
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Data', array('at.comparecimento_data', function($row){

    $dataObjeto = DateTime::createFromFormat("Y-m-d", $row['comparecimento_data']);
    $data = $row['comparecimento_data'] == '0000-00-00' ? 'Erro na conversão' : $dataObjeto->format("d/m/Y");

    if ($row['erro_dia'] == 1) {

        $texto = "<b><strike>" . escaparHtml($row['planilha_dia_comp']) ."</strike><br />" .escaparHtml($data) . "</b>";
        return $texto;
    }
    return escaparHtml($data);

}));
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('hora', array('at.comparecimento_hora', function($row){

    $dataObjeto = DateTime::createFromFormat("H:i:s", $row['comparecimento_hora']);
    $data = $row['comparecimento_hora'] == '00:00:00' ? 'Erro na conversão' : $dataObjeto->format("H:i");

    if ($row['erro_horario'] == 1) {

        $texto = "<b><strike>" . escaparHtml($row['planilha_horario_comp']) ."</strike><br />" .escaparHtml($data) . "</b>";
        return $texto;
    }

    return $data;

}));
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Acusados', array('at.acusados', 'acusados'));
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Observação', array('at.observacao_txt', 'observacao_txt'));
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Divergências', array('divergencia',function($row) {
    return str_replace(';', '<br />', $row['divergencia']);
}));
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Erros', array('erros_txt',function($row) {

    $errosColuna = unserialize($row['erros_txt']);

    $errosColuna = is_array($errosColuna) ? $errosColuna : array($errosColuna);

    return implode('<br />', $errosColuna);
}));
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

/*
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

  $coluna = new ColunaHtml('Local', array('a.comparecimento_local_txt', 'comparecimento_local_txt'));
  $tabela->colunas->attach($coluna);

  $coluna = new ColunaHtml('Data/Hora', array('a.comparecimento_dh','comparecimento_dh'));
  $coluna->setTipo(ColunaHtml::COL_DATETIME);
  $coluna->setDateFormat("d/m/Y H:i");
  $tabela->colunas->attach($coluna);
 */
$tabela->render();
