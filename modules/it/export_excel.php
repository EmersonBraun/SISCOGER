<?php
error_reporting(E_ALL);
// Obter acesso à classe PHPExcel
require_once 'classes/PHPExcel.php';
// Nome do Arquivo do Excel que será gerado
$arquivo = 'dados_it.xls';

// Criar um novo objecto PHPExcel
$objPHPExcel = new PHPExcel();
//Filtra para somente ver a unidade do login, incluindo os comandos.
$objPHPExcel->getProperties()->setCreator("Auto gerado")
->setLastModifiedBy("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT")
->setTitle("Busca IT")


$data = json_decode($excel);
$key = $excel['key'];
$cols = explode('|', $excel['cols']);

$objPHPExcel->setActiveSheetIndex(0);
$activeSheet = $objPHPExcel->getActiveSheet();

// TODO deal with more than 26 columns... does Excel double letters up or what?
function getColLetter ($i) {
$COLS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$ct = ($i > 25) ? floor($i / 26) : 0;
$ret = $COLS[$i % 26];
    while ($ct--)
        $ret .= $ret;
return $ret;
}
// prepare header row
foreach ($cols as $i=>$col) {
    $activeSheet->setCellValue(getColLetter($i) . 1, $col);
}
// prepare the rest
foreach ($data->$key as $i=>$row) {
    foreach ($cols as $j=>$col) {
        $activeSheet->setCellValue(getColLetter($j) . ($i + 2), $row->$col);
    }
}

echo $arquivo;
exit;
//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//$objWriter->save('php://output');	

// Indicação da criação do ficheiro
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

// Força o Download do Arquivo Gerado
header('Content-Type: application/vnd.ms-excel');
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
header('Cache-Control: max-age=0');
$objWriter->save('php://output');

//header("location: http://10.47.1.90/sjd/index.php?module=it&opcao=buscar");


?>