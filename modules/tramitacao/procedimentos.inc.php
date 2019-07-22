<?php
$procedimentos=Array("ipm","cj","cd","adl","sindicancia","fatd","desercao","apfd","iso","it","pad","proc_outros");

foreach ($procedimentos as $vax) {
	$camposX[]="id_$vax";
}
	$campos=implode(", ", $camposX);
//pre($campos);

//Agora imprime os procedimentos
$sql="SELECT rg, rg_substituto, nome, situacao, resultado, $campos FROM envolvido  
	WHERE rg='$rg'
	UNION ALL 
		SELECT rg, rg AS rg2, nome, situacao, resultado, $campos FROM ofendido
	WHERE rg='$rg'
";
//pre($sql);
//pre($sql);
$res=mysql_query($sql);



openTable("class='bordasimples' width='100%'");
	openLine(); h2("Procedimentos"); closeLine();

openTR();
	echo "<td>Proc.</td>";
	echo "<td>CDOPM</td>";
	echo "<td>Situa&ccedil;&atilde;o</td>";
	echo "<td>Andamento</td>";
	echo "<td>A&ccedil;&atilde;o</td>";

closeTR();


$i=0; //contador pras cores
while ($row=mysql_fetch_assoc($res)) {
	($i%2)?($cor="#FFFFFF"):($cor="#F0F0F0");
	openTR("bgcolor='$cor'");
	//pre($row);
	foreach ($procedimentos as $proc) {
		if ($row["id_$proc"]) {
			$naba=new $proc("LEFT JOIN RHPARANA.opmPMPR opm ON
				opm.CODIGOBASE= $proc.cdopm WHERE id_$proc='".$row["id_$proc"]."'");
			//pre($naba);
			openTD();
				echo ucwords($proc)." n&ordm; ";
				echo $naba->sjd_ref."/".$naba->sjd_ref_ano;
			closeTD();
			
			echo "<td>".$naba->ABREVIATURA."</td>";
			openTD();
				echo $row["situacao"];
				if ($row["rg_substituto"]) echo " substituido";
			closeTD();
			
			echo "<td>".$naba->andamento->andamento."</td>";

			openTD("");
				//ATUALIZACAO DE SEGURANCA, PEDIDO TEN TODISCO 1/11/11
				if ($user['nivel']<4) {
					if ($proc!="cd" and $proc!="cj" and $proc!="adl" and $proc!="sai") {
					echo "<a target='_blank' href='?module=movimento&movimento[id_".$proc."]=".$row["id_$proc"]."'>Ver movimentos</a>";
					}
				}
				else 
					echo "<a target='_blank' href='?module=movimento&movimento[id_".$proc."]=".$row["id_$proc"]."'>Ver movimentos</a>";
			closeTD();
		}
	}
	closeTR();
	$i++;
}
openLine(); h1("Total: $i"); closeLine();

closeTable();
?>
