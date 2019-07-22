<?php

$idsApresentacoesSelecionadasIn = implode(',', $idsApresentacoesSelecionadas);

if (empty($idsApresentacoesSelecionadas)) {
    $idsApresentacoesSelecionadasIn = "0";
}

$tabela = new TabelaHtml();
$tabela->setUrlBasica("?module={$module}");
$tabela->setTitulo('APRESENTAÇÕES SELECIONADAS');

$sql = "SELECT a.*, pm.nome, pm.rg, pm.cargo, pm.quadro, pm.subquadro, cs.apresentacaoclassificacaosigilo, tp.apresentacaotipoprocesso, c.apresentacaocondicao, "
   . " opm.ABREVIATURA as opmsigla, opmApres.ABREVIATURA as apres_opm, "
   . " if(a.memorando_pdf is null OR a.memorando_pdf = '', 0,1) as possui_pdf,"
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

// somente futuras
$filtro = new FiltroTabela();
$filtro->setNome('permanente');
$filtro->setComparador(function(){
    return sprintf(" a.comparecimento_dh >= '%s'", date("Y-m-d 00:00:00"));
});
$tabela->filtrosPermanentes->attach($filtro);


// primeiro filtro permanente
$filtro = new FiltroTabela();
$filtro->setNome('selecionadas');
$filtro->setComparador(function() use ($idsApresentacoesSelecionadasIn){
    return sprintf(" a.id_apresentacao in ( $idsApresentacoesSelecionadasIn ) ");
});
$tabela->filtrosPermanentes->attach($filtro);

// não exibe ag. publicacao e temporarias
$filtro = new FiltroTabela();
$filtro->setNome('pendentes');
$filtro->setComparador(function() use ($user,$codigoBase){
    return sprintf(" ( a.id_apresentacaosituacao NOT IN (7,8) OR ( a.usuario_rg = '%s' ) OR ( a.cdopm = '%s' ) ) ", $user['UserLogin'], $codigoBase);
});
$tabela->filtrosPermanentes->attach($filtro);

if (!in_array($user["nivel"], array(4,5))) {
    $filtro = new FiltroTabela();
    $filtro->setNome('so opm');
    $filtro->setComparador(function() use ($codigoBase){
        return sprintf(" (a.cdopm like '%s' OR a.pessoa_unidade_lotacao_codigo like '%s' OR a.pessoa_opm_codigo like '%s' OR opm.codigo like '%s')  ", "{$codigoBase}%", "{$codigoBase}%", "{$codigoBase}%", "{$codigoBase}%");
    });
    $tabela->filtrosPermanentes->attach($filtro);
}

if (!in_array($user["nivel"], array(4,5))) {
    $filtro = new FiltroTabela();
    $filtro->setNome('publicas');
    $idPostoUsuario = $usuario->id_posto;
    $rgDoUsuario = $user['UserLogin'];
    $filtro->setComparador(function() use ($idPostoUsuario, $rgDoUsuario) {
        if ($idPostoUsuario > 7) {
            $idPostoMaximo = 8;
        } else if ($idPostoUsuario <=7) {
            $idPostoMaximo = 0;
        }
        return sprintf(" ( (a.id_apresentacaoclassificacaosigilo IN (1,2)) OR (a.id_apresentacaoclassificacaosigilo = 3 AND id_posto <= %d ) OR (a.id_apresentacaoclassificacaosigilo = 3 AND id_posto is null )  OR (a.id_apresentacaoclassificacaosigilo = 4 AND a.pessoa_rg = '%s' ) OR ( a.usuario_rg = '%s' ) OR (a.id_apresentacaoclassificacaosigilo = 5 AND id_posto >= %d ))", $idPostoUsuario, $rgDoUsuario, $rgDoUsuario, $idPostoMaximo);
    });
    $tabela->filtrosPermanentes->attach($filtro);
}


$renderizadorDeAtributo = function($row){
    $onclk =  " class='id_apresentacao id_apresentacao_{$row['id_apresentacao']}' ";

    return " {$onclk} ";
};


$coluna = new ColunaHtml('Nº Apres.',array('a.id_apresentacao',function($row){
    return "<a href='?module=apresentacao&apresentacao[id]={$row['id_apresentacao']}'>{$row['sjd_ref']}/{$row['sjd_ref_ano']}</a>";
}));
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

if ($user['nivel']!=2) {
    $coluna = new ColunaHtml('OPM',array('opmApres.ABREVIATURA', 'apres_opm'));
    $coluna->setRenderAtributos($renderizadorDeAtributo);
    $tabela->colunas->attach($coluna);
}

$coluna = new ColunaHtml('Nº Of.',array('a.documento_de_origem','documento_de_origem'));
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('RG',array('a.pessoa_rg', 'rg'));
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Cargo',array('posto.id_posto', 'pessoa_posto'));
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Nome',function($row){
    $pessoa = '';
    if (!empty($row['rg'])) {
        $pessoa .= " {$row['nome']}";
    } else {
        $pessoa .= " {$row['pessoa_nome']}";
    }
    return $pessoa;
});
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Unidade', function($row){
    if (!empty($row['opmsigla'])) {
        $opmsigla = "{$row['opmsigla']}";
    } else {
        $opmsigla = "{$row['pessoa_unidade_lotacao_sigla']}";
    }

    return $opmsigla;
});
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Tipo',array('tp.apresentacaotipoprocesso', 'apresentacaotipoprocesso'));
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Autos','autos_numero');
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Condição', array('c.apresentacaocondicao','apresentacaocondicao'));
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Local', array('a.comparecimento_local_txt', function($row){
    $texto = $row['comparecimento_local_txt'];
    $textoReduzido = substr($texto, 0, 35);

    $continua = $texto == $textoReduzido ? "" : "...";

    return sprintf("<span title='%s' onclick='javascript: (function(elm){elm.innerHTML = elm.title;})(this)'>%s%s</span>",  escaparHtml($texto), escaparHtml($textoReduzido), $continua);
}));
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Data/Hora', array('a.comparecimento_dh','comparecimento_dh'));
$coluna->setTipo(ColunaHtml::COL_DATETIME);
$coluna->setDateFormat("d/m/Y H:i");
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Situação', array('s.apresentacaosituacao', 'apresentacaosituacao'));
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Cadastro', array('a.criacao_dh','criacao_dh'));
$coluna->setTipo(ColunaHtml::COL_DATETIME);
$coluna->setDateFormat("d/m/y H:i");
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('PDF', array('possui_pdf', function($row){
    $caminho = isset($row['memorando_pdf']) ? $row['memorando_pdf'] : '';

    $a = "<a href='{$caminho}'><img src='img/icone-pdf.gif' /></a>";

    return empty($caminho) ? '&nbsp;' : $a;
}));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Ação',array('a.id_apresentacao',function($row){
    return "<img src='img/wrong.gif' onclick='remover({$row['id_apresentacao']})' />";
}));
$coluna->setRenderAtributos($renderizadorDeAtributo);
$tabela->colunas->attach($coluna);

$tabela->render();

$id = md5(date("YmdHisu"));

$_SESSION['sqlParaPlanilha'][$id] = $tabela->getSql();

?>
<p>
    <?php if (!empty($idsApresentacoesSelecionadas )):?>
    <input type="submit" name="acao" value="Gerar"/>
    <?php endif; ?>
    <button onclick="javascript: (function(obj,event) {event.preventDefault();window.location='?module=apresentacao&opcao=listar'})(this,event)">Voltar e selecionar</button>
    <button onclick="javascript: (function(obj,event) {event.preventDefault();limparEVoltar();})(this,event)">Limpar e voltar</button>
</p>

<style type="text/css">
    .riscado {
        text-decoration: line-through;
    }
</style>
<script>

<?php
    $jsIdsApresentacoes = json_encode(array_values($idsApresentacoesSelecionadas));
?>
var selecionadas = <?=$jsIdsApresentacoes;?>;

function remover (id) {

    var url = criarUrl('remover', id);
    $.get(url, function(dados) {
        if (dados.ids) {
            $('.id_apresentacao_' + id).addClass('riscado');
            console.log(selecionadas.indexOf(""+id));
            var index = selecionadas.indexOf(""+id);
            if (index > -1) {
                selecionadas.splice(index, 1);
            }
        }
    });

}

function limparEVoltar(id) {

    var url = criarUrl('limpar', 0);
    $.get(url, function(dados) {
        if (dados.ids) {
            $('.id_apresentacao_' + id).addClass('riscado');
            console.log(selecionadas.indexOf(""+id));
            var index = selecionadas.indexOf(""+id);
            if (index > -1) {
                selecionadas.splice(index, 1);
            }
        }
        window.location = "?module=apresentacao&opcao=listar"
    });

}

var criarUrl = function(acao, id) {
    return "?module=memorandoapresentacao&noheader&nomenu&ajax=true&acao=" + acao + "&id_apresentacao=" + id;
}

function submeterFormulario() {
    document.getElementsByName('ids')[0].value = selecionadas;
}

</script>