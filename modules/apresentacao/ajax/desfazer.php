<?php

$atIdApresentacao;
$atIdObjeto;

$a = new apresentacao();
$a->setValues(array('id' => $atIdApresentacao));

if (!isset($_REQUEST['objeto']) || !isset($_REQUEST['id_objeto']) || (!isset($_REQUEST['id_apresentacao']))) {
    enviarResposta(array(
        'valido' => false,
        'mensagem' => utf8_encode("Código incorreto. Dados insuficientes para desfazer a ação.(1)"),
    ));
}

$atClasse = $_REQUEST['objeto'];
$campoIdDoObjeto = "id_{$atClasse}";

if (!class_exists($atClasse)) {
    enviarResposta(array(
        'valido' => false,
        'mensagem' => utf8_encode("Código incorreto. Dados insuficientes para desfazer a ação.(2)"),
    ));
}

$atObjetoClasse = new $atClasse();
$atObjetoClasse->setValues(array('id' => mysql_real_escape_string($_REQUEST['id_objeto'])));

if (!property_exists($atObjetoClasse, $atClasse)) {
    enviarResposta(array(
        'valido' => false,
        'mensagem' => utf8_encode("Código incorreto. Dados insuficientes para desfazer a ação.(3)"),
    ));
}

if (!$a instanceof apresentacao || !isset($a->sjd_ref) || !$atObjetoClasse instanceof $atClasse || !isset($atObjetoClasse->$atClasse)) {
    enviarResposta(array(
        'valido' => false,
        'mensagem' => utf8_encode("Código incorreto.(4)"),
    ));
}

$atObjetoAnterior['objeto']    = $atClasse;
$atObjetoAnterior['id'] = $a->$campoIdDoObjeto;
$atObjetoAnteriorDaClasse = $a->$atClasse;
$atObjetoAnterior['nome'] = $atObjetoAnteriorDaClasse->$atClasse;

//var_dump($a);
$a->$campoIdDoObjeto = $atIdObjeto;
$a->$atClasse = $atObjetoClasse;
//var_dump($a, $atIdObjeto, $atObjetoClasse, $a->$atClasse);
apresentacao::atualiza($a);

$classeNova = $a->$atClasse;

enviarResposta(array(
    'valido' => true,
    'hash' => 'desfeito',
    'apresentacao' => array(
        'id' => utf8_encode("{$a->id_apresentacao}"),
        'numero' => utf8_encode("{$a->sjd_ref}/{$a->sjd_ref_ano}"),
        'origem' => utf8_encode($a->documento_de_origem),
        'autos' => utf8_encode($a->autos_numero),
        'nome' => utf8_encode("{$a->pessoa_posto} {$a->pessoa_nome}"),
        'data' => utf8_encode($a->comparecimento_data),
        'hora' => utf8_encode($a->comparecimento_hora),
        'modificado' => array(
            'objeto' => utf8_encode($atClasse),
            'id' => utf8_encode($a->$campoIdDoObjeto),
            'nome' => utf8_encode($atObjetoClasse->$atClasse),
        ),

    ),
    'objeto_anterior' => array(
        'objeto' => utf8_encode($atClasse),
        'id' => $atObjetoAnterior['id'],
        'nome' => utf8_encode($atObjetoAnterior['nome'])
    )
));


