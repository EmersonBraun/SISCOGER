<?

//include ("menu.inc.php");
include ("filtro.inc");
$sql="SELECT * FROM protocolo";
include ("includes/filtro.php");
//$sql=lista::paginas();
?>

<div class='bordasimples'>
<TABLE border=0 width="100%">

<?php
echo "<tr><td colspan='6'><h2>protocolos cadastrados</h2></td></tr>";

//Cabecalho
echo "<tr>";
foreach ($mostrar as $campo) {
	if     ($campo=="id_protocolo") lista::td("Identifica&ccedil;&atilde;o  protocolo","id_protocolo");
	if ($campo=="numero") lista::td("N&SmallCircle; Documento","numero");
	if ($campo=="descricao_txt") lista::td("Descri&ccedil;&atilde;o","descricao_txt");
	if ($campo=="rg") lista::td("RG envolvido","rg");
	if ($campo=="rg_autor") lista::td("RG Cadastro","rg_autor");
	if ($campo=="rg_analista") lista::td("RG Analista","rg_analista");
	if ($campo=="obs") lista::td("Observa&ccedil;&otilde;es","obs");
}
echo "</tr>\r\n";

//executa a query no servidor
$res=mysql_query($sql,$con[8]);

$i=0; //contador

//Imprime linha a linha todos os resultados da query
while ($row=mysql_fetch_array($res)) {

	//muda a cor para cada linha
	$i%2?($cor=white):($cor='#EEEEEE');
	
	openTR("bgcolor='$cor'");
	foreach ($mostrar as $campo) {
		if     ($campo=="id_protocolo") echo "<td>".lista::link("atualizar").$row["id_protocolo"]."</a></td>";
		if ($campo=="numero") echo "<td>$row[numero]</td>";
		if ($campo=="descricao_txt") echo "<td>$row[descricao_txt]</td>";
		if ($campo=="rg") echo "<td>$row[rg]</td>";
		if ($campo=="rg_autor") echo "<td>$row[rg_autor]</td>";
		if ($campo=="rg_analista") echo "<td>$row[rg_analista]</td>";
		if ($campo=="obs") echo "<td>$row[obs]</td>";
	}
	closeTR();
$i++;

}
//lista::rodape($sql);
?>
</table>
</div>
<br>
