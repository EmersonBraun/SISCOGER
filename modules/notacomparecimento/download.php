<?php

if (!isset($notacomparecimento->id_notacomparecimento) || empty($notacomparecimento->id_notacomparecimento)) {
    echo '<h3>Não foi possível identificar a planilha</h3>';
    echo '<a href="?module=notacomparecimento">Voltar</a>';
    exit();
}
ob_end_clean();

$pdo = new PDO($pdo['dsn']['sjd'],$pdo['user'],$pdo['password']);

$leitor = new FEscritorDePlanilhaDeApresentacao($notacomparecimento, $pdo);


$leitor->escrever();

// Redirect output to a clientâ€™s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="nota_coger_'. $notacomparecimento->id_notacomparecimento . '_' . date("Y") .'.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$arquivo = $leitor->getPlanilhaPath();

readfile($arquivo);
