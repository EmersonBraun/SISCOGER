<?php
include("filtro.inc");
//Filtra para somente ver a unidade do login, incluindo os comandos.
if ($user[nivel]<3) {
	if (!$it->opm_codigo_st) $it->cdopm_st=$opm_login->codigoBase;
}
$it->sjd_ref_ano=$_SESSION[sjd_ano];

//$sql="SELECT it.*, rhopm.ABREVIATURA FROM it LEFT JOIN RHPARANA.opmPMPR AS rhopm ON rhopm.CODIGOBASE = it.cdopm";

$sql="SELECT  it.*, rhopm.ABREVIATURA, a.andamento, ag.andamentocoger, ca.causa_acidente, rc.resp_civil FROM it
LEFT JOIN andamento AS a ON it.id_andamento=a.id_andamento AND a.procedimento='it'
LEFT JOIN andamentocoger AS ag ON it.id_andamentocoger=ag.id_andamentocoger AND ag.procedimento='it'
LEFT JOIN causa_acidente AS ca ON it.id_causa_acidente=ca.id_causa_acidente
LEFT JOIN resp_civil AS rc ON it.id_resp_civil=rc.id_resp_civil 
LEFT JOIN RHPARANA.opmPMPR AS rhopm ON rhopm.CODIGOBASE = it.cdopm";
include ("includes/filtro.php");
if ($_SESSION[debug]) pre($sql);
//$sql=lista::paginas();
?>


<center>
<!-- -->
<TABLE width="100%" cellpadding="0px"  class="bordasimples">
   <tr><TD colspan="14"><center><h1><?=$opm_login->descricao;?></center></h1></TD></tr>
   <tr><TD colspan="14"><h2><center>Inqueritos T&eacute;cnicos - <?echo $_SESSION[sjd_ano];?></center></h2></TD></tr>
<?php

openTR();	
foreach ($mostrar as $campo) {
	
	if     ($campo=="NROPM") lista::td("OPM","NROPM");
	elseif ($campo=="NRSJD") lista::td("N&ordm; COGER","NRSJD");
	elseif ($campo=="sintese_txt") lista::td("Sintese do fato","sintese_txt");
	elseif ($campo=="objetoprocedimento") lista::td("Objeto Procedimento","objetoprocedimento");
	elseif ($campo=="descricao") lista::td("Descri&ccedil;a&#771;o","descricao");
	elseif ($campo=="acordoamigavel") lista::td("Ressarc. Extrajud.","acordoamigavel"); 
	elseif ($campo=="causa_acidente") lista::td("Causa acidente","causa_acidente");
	elseif ($campo=="situacaoviatura")lista::td("Situa&ccedil;a&#771;o viatura","situacaoviatura"); 
	elseif ($campo=="resp_civil") lista::td("Respons. civil","resp_civil"); 
	elseif ($campo=="acaojudicial") lista::td("A&ccedil;a&#771;o judicial","acaojudicial");
	elseif ($campo=="danoreal_rs") lista::td("Valor do dano","danoreal_rs"); 
	elseif ($campo=="tipo_acidente") lista::td("Tipo de acidente","tipo_acidente"); 
	elseif ($campo=="andamento") lista::td("Andamento","andamento");
	elseif ($campo=="andamentocoger") lista::td("And. COGER","andamentocoger");
	elseif ($campo=="fato_data") lista::td("Data do fato","fato_data");
	//else echo "<td><b>".ucwords(strtolower($campo))."</b></td>";
}
closeTR();

mysql_select_db("sjd");
$res=mysql_query($sql);
$i=0;


while ($row=mysql_fetch_array($res)) {
	
	$i%2?($cor=white):($cor='#EEEEEE');
	echo "<tr bgcolor=$cor>";
	//Imprime cada um dos campos selecionados para ser mostrado			
	foreach ($mostrar as $campo) {
		//campos em maiusculo, mostra mais de uma informacao

		if     ($campo=="NROPM") echo "<td>$row[ABREVIATURA]</td>";
		elseif ($campo=="NRSJD") echo "<td><a href='?module=it&it[id]=$row[id_it]'>$row[sjd_ref]/$row[sjd_ref_ano]</a></td>";
		elseif ($campo=="sintese_txt")echo "<td>$row[sintese_txt]</td>";
		elseif ($campo=="objetoprocedimento") echo "<td>$row[objetoprocedimento]</td>";
		elseif ($campo=="descricao") {
			switch ($row[objetoprocedimento]){
				case 'viatura':
					echo "<td>$row[vtr_prefixo], (placa $row[vtr_placa])</td>";
				break;
				case 'arma':
					echo "<td>$row[identificacao_arma]</td>";
				break;
				case 'municao':
					echo "<td>$row[identificacao_municao]</td>";
				break;
				case 'semovente':
					echo "<td>$row[identificacao_semovente]</td>";
				break;
				case 'outros':
					echo "<td>$row[outros]</td>";
				break;
			}
		}
		elseif ($campo=="acordoamigavel") echo "<td>$row[acordoamigavel]</td>";
		elseif ($campo=="causa_acidente") echo "<td>$row[causa_acidente]</td>";
		elseif ($campo=="situacaoviatura") echo "<td>$row[situacaoviatura]</td>";
		elseif ($campo=="resp_civil") echo "<td>$row[resp_civil]</td>";
		elseif ($campo=="acaojudicial") echo "<td>$row[acaojudicial]</td>";
		elseif ($campo=="danoreal_rs") echo "<td>$row[danoreal_rs]</td>";
		elseif ($campo=="tipo_acidente") echo "<td>$row[tipo_acidente]</td>";
		elseif ($campo=="andamento") echo "<td>$row[andamento]</td>";
		elseif ($campo=="andamentocoger") echo "<td>$row[andamentocoger]</td>";
		elseif ($campo=="fato_data") echo "<td>".data::inverte($row["fato_data"])."</td>";
	}

	echo "</tr>";
$i++;
}
//if($arquivo)echo $excel;
//lista::rodape($sql);

?>

        </select>
   </TR>
   </TR>

</td></tr></table>

<br>
