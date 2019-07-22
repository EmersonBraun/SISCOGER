<?php

if ($user['nivel']<4) {
	if (!$_REQUEST['envolvido']['CODIGOBASE_st']) 
		$_REQUEST['envolvido']['CODIGOBASE_st']=$opm_login->codigoBase;
}
//pre($_REQUEST);
if (!$_REQUEST['order']) $_REQUEST['order']='id_posto';

$posto=$_REQUEST['posto'];

//QUERY dos excluidos
//Excluidos sao os envolvidos com ipm_julgamento=Denunciado
//Todos tem que ter cadastrada a data de exclusao, para fins estatisticos.

$sql="SELECT pm.rg, pm.nome, pm.cargo, opm.ABREVIATURA, opm.CODIGOBASE, c.comportamento, cpm.data,
	posto.id_posto
	FROM RHPARANA.POLICIAL pm
	LEFT JOIN sjd.comportamentopm cpm ON
		cpm.rg=pm.rg
	LEFT JOIN sjd.comportamento c ON
		c.id_comportamento=cpm.id_comportamento
	LEFT JOIN RHPARANA.opmPMPR opm ON opm.META4 = pm.opm_meta4
	LEFT JOIN RHPARANA.posto ON posto.posto=pm.cargo
	INNER JOIN sjd.ult_comportamento u ON u.ult_data=cpm.data AND cpm.rg=u.rg";

	$sqlWhere[]="id_posto>6"; //EXCLUI OS OFICIAIS
	if ($posto) $sqlWhere[]=" id_posto='$posto'"; //EXCLUI OS OFICIAIS
	
	//COMPORTAMENTO
	$comportamento=$_REQUEST['c']['id_comportamento'];
	//pre($_REQUEST);
	if ($comportamento) $sqlWhere[]=" c.id_comportamento='$comportamento'";

	//$sqlWhere[]="ipm_processocrime='Denunciado'";
	
	//WHERE ipm_processocrime='Denunciado'";

if ($_SESSION['debug']) pre($sql);

$envolvido->setValues($_REQUEST['envolvido']);
//$order='id_posto';
include("includes/filtro.php");
//pre($sql);
$total=mysql_num_rows($res);

//FILTRO

echo "<form id='envolvido' action='".$_SESSION['REQUEST_URI']."' method='POST'>";
echo "<table width='100%' class='bordasimples'>";

form::openTR();
	form::openTD("colspan='5'");
		?>
		<h2>Filtro
			<a href='#noplace' onclick='$("#linhafiltro").show()'>+</a>
			<a href='#noplace' onclick='$("#linhafiltro").hide()'>-</a>
		</h2>
		<?php
	form::closeTD();

form::closeTR();

form::openTR("id='linhafiltro' style='display:none;'");
	form::openTD();
		form::openLabel("OPM");
			echo "<select name=envolvido[CODIGOBASE_st]>";
			include ("includes/option_opm.php");
			echo "</select>";
		form::closeLabel();
	form::closeTD();
	openTD();
		form::openLabel("Comportamento");
			echo
		'<select id="comportamento[id_comportamento]" name="c[id_comportamento]" onchange="ajaxForm(this,"comportamento",Array("id_comportamento","comportamento"));">
		<option rel="none" value="">Selecione</option><option rel="none" value="1">Excepcional</option>
		<option rel="none" value="2">&Oacute;timo</option>
		<option rel="none" value="3">Bom</option>
		<option rel="none" value="4">Insuficiente</option>
		<option rel="none" value="5">Mau</option>
		</select>';
		form::closeLabel();
	closeTD();
	openTD();
		form::openLabel("GRADUA&Ccedil;&Atilde;O");
			$sqlX="SELECT * FROM RHPARANA.posto WHERE id_posto>=7 ORDER BY id_posto DESC";
			$resX=mysql_query($sqlX);
			echo "<select name='posto'>";
			echo "<option value=''>Todos</option>";
			while ($rowX=mysql_fetch_assoc($resX)) {
				//pre($rowX); //die;
				echo "<option value='$rowX[id_posto]'>$rowX[posto]</option>";
			}
			echo "</select>";
		form::closeLabel();
	closeTD();
	openTD();
		form::openLabel("Acao");
		echo "<input type='submit' value='Listar' name='$opcao'>";
		form::closeLabel();
	closeTD();

form::closeTR();
echo "</table>";
echo "</form>";

formulario::values($envolvido);

echo "<br>";
mysql_select_db("sjd",$con[8]);

$sql=lista::paginas($sql);
$res=mysql_query($sql);

//TABELA

openTable("class='bordasimples' width='100%'");
	openLine(7);
		h1("Controle de Comportamento (Pra&ccedil;as)");
	closeLine();

	//cabecalho
	openTR("bgcolor='#E0E0E0'");
		echo "<td>Nome</td><td>OM atual</td><td>Comportamento</td>";
		lista::td("Data","data");//<td>Data</td>";
	closeTR();

	$i=0;

	//pre($sql); die;

	while ($row=mysql_fetch_assoc($res)) {
		//pre($row); die;
		$excluido = mysql_fetch_assoc(mysql_query("SELECT * FROM sjd.envolvido WHERE rg='$row[rg]' and resultado='Excluído'"));
		if (!$excluido) 
		{
		
		($i%2)?($cor="#E0E0E0"):($cor="#FFFFFF");
		openTR("bgcolor='$cor'");
			
			echo "<td><a target='_blank' href='?module=tramitacao&policial[rg]=$row[rg]'>$row[cargo] $row[nome]</a></td>";
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>$row[comportamento]</td>";
			echo "<td>".data::inverte($row["data"])."</td>";
		$i++;
		}
		//$rgs[]="'".$row['rg']."'";
		closeTR();
	}

//openLine();
lista::rodape($sql);
//closeLine();
closeTable();

//h1("Total: $i");
//SELECT * FROM sjd.envolvido WHERE rg='91987937' and resultado='Excluído';
unset($sqlWhere);
$sql="SELECT pm.rg, pm.nome, pm.cargo, opm.ABREVIATURA, opm.CODIGOBASE,
	posto.id_posto
	FROM RHPARANA.POLICIAL pm
	LEFT JOIN RHPARANA.opmPMPR opm ON opm.META4 = pm.opm_meta4
	LEFT JOIN RHPARANA.posto ON posto.posto=pm.cargo ";
	
	$sqlWhere[]="id_posto>6"; //EXCLUI OS OFICIAIS
	if ($posto) $sqlWhere[]=" id_posto='$posto'"; //EXCLUI OS OFICIAIS
	
	//if ($rgs[0]) {
	$sqlWhere[]=" pm.rg NOT IN (SELECT DISTINCT rg FROM comportamentopm) ";
	//}
	include("includes/filtro.php");
	$sql.=" LIMIT 0,50";
	
//pre($sqlE);
echo "<br>\r\n";
$res=mysql_query($sql);
//pre($sql);

h3("Policiais sem comportamento cadastrado (M&acute;x 50)");
openTable("class='bordasimples' width='100%'");
$i=0;
while ($row=mysql_fetch_assoc($res)) {
	($i%2)?($cor="#E0E0E0"):($cor="#FFFFFF");	
		openTR("bgcolor='$cor'");
			openTD();
				
				echo "<a target='_blank' href='?module=tramitacao&policial[rg]=$row[rg]'>";
				echo "$row[cargo] $row[nome]";
				echo "</a>";
			
			closeTD();
			echo "<td>$row[ABREVIATURA]</td>";
			echo "<td>S/comportamento</td>";
			echo "<td>S/data</td>";
		closeTR();
		$i++;
}
closeTable();

?>
