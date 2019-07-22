<?php

$codigoPartes = explode('-', $atCodigo);

if (count($codigoPartes) == 1) {
    $atCodigo = $atCodigo . '-' . $atAno;
}

$a = apresentacao::getInstancePeloHash($atCodigo);
$apresentacaoHash = apresentacao::getApresentacaoHashPeloHash($atCodigo);

if (!$a instanceof apresentacao) {
    enviarResposta(array(
        'valido' => false,
        'mensagem' => utf8_encode("Código incorreto."),
    ));
}

$classeAnterior = $apresentacaoHash['classe'];
$campoIdDoObjeto = "id_{$apresentacaoHash['classe']}";

$atObjetoAnterior['objeto']    = $classeAnterior;
$atObjetoAnterior['id'] = $a->$campoIdDoObjeto;
$atObjetoAnteriorDaClasse = $a->$classeAnterior;
$atObjetoAnterior['nome'] = $atObjetoAnteriorDaClasse->$classeAnterior;

$a->alterarUsandoHash($atCodigo);

$classeNova = $a->$classeAnterior;

enviarResposta(array(
    'valido' => true,
    'hash' => $atCodigo,
    'apresentacao' => array(
        'id' => utf8_encode("{$a->id_apresentacao}"),
        'numero' => utf8_encode("{$a->sjd_ref}/{$a->sjd_ref_ano}"),
        'origem' => utf8_encode($a->documento_de_origem),
        'autos' => utf8_encode($a->autos_numero),
        'nome' => utf8_encode("{$a->pessoa_posto} {$a->pessoa_nome}"),
        'data' => utf8_encode($a->comparecimento_data),
        'hora' => utf8_encode($a->comparecimento_hora),
        'modificado' => array(
            'objeto' => utf8_encode($classeAnterior),
            'id' => utf8_encode($a->$campoIdDoObjeto),
            'nome' => utf8_encode($classeNova->$classeAnterior),
        ),

    ),
    'objeto_anterior' => array(
        'objeto' => utf8_encode($classeAnterior),
        'id' => $atObjetoAnterior['id'],
        'nome' => utf8_encode($atObjetoAnterior['nome'])
    )
));


