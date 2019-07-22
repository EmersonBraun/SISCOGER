<?php

echo "<center><h1>";
	if ($proc=="ipm") echo "Inquérito Policial Militar";
	if ($proc=="cj") echo "Conselho de Justificação";
	if ($proc=="cd") echo "Conselho de Disciplina";
	if ($proc=="sindicancia") echo "Sindicância";
	if ($proc=="fatd") echo "Formulário de Apuração de Transgressão Disciplinar";
	if ($proc=="desercao") echo "Deserção";
	if ($proc=="iso") echo "Inquérito Sanitário de Origem";
	if ($proc=="apfd") echo "Auto de Prisão em Flagrante Delito";
	if ($proc=="it") echo "Inqu&eacute;rito T&eacute;cnico";
	if ($proc=="adl") echo "Apuracao Disciplinar de Licenciamento";
echo "</h1></center>\r\n";

?>

<table class='bordasimples' width='100%'>
    <tr>
            <td align="center" colspan="3" bgcolor="#DBEAF5">
            <a href="?module=<?=$proc;?>&<?=$proc;?>[id]=<?=$idProcesso;?>">Visualização e atualização</a> |
            <a href="?module=movimento&movimento[id_<?=$proc;?>]=<?=$idProcesso;?>">Movimentos</a>

            <?php                                                                                                                  
            //sobrestamento
			if ($procedimento!="ipm" and $procedimento!="desercao" and $procedimento!="apfd")
			echo "| <a href=\"?module=sobrestamento&sobrestamento[id_$proc]=".$idProcesso."\">Sobrestamentos</a>";                                                                                                                     
            ?> 
            | Acompanhamento
            <?php 
            if ($user['nivel']==4 || $user['nivel']==5) {
            	echo "| <a href=\"?module=arquivo&arquivo[id_$proc]=".$idProcesso."\">Arquivo</a>"; 
            }
            ?>
            </td>
    </tr>

<?php

    form::openTR();
	form::openTD();
		form::openLabel("Nº");
                        echo "{$objetoProcesso->sjd_ref}/{$objetoProcesso->sjd_ref_ano}";
		form::closeLabel();
	form::closeTD();
	form::openTD();
		form::openLabel("OPM");
			if($objetoProcesso->cdopm) echo strtoupper(get_opm_by_id($objetoProcesso->cdopm));
			elseif ($objetoProcesso->opm_sigla) echo strtoupper($objetoProcesso->opm_sigla);
			else echo "CG";
		form::closeLabel();
	form::closeTD();
form::closeTR();
form::openTR();
	form::openTD();
		form::openLabel("Data do fato");
			echo data::inverte($objetoProcesso->fato_data);
		form::closeLabel();
	form::closeTD();
	form::openTD();
		if (isset($objetoProcesso->abertura_data)) {
			form::openLabel("Data de abertura");
			echo data::inverte($objetoProcesso->abertura_data);
			form::closeLabel();
		}
		//Auto de prisao em flagrante, tem tipo penal, mas nao data de abertura
		elseif (isset($objetoProcesso->tipo_penal)) {
			form::openLabel("Tipo penal");
			echo $objetoProcesso->tipo_penal;
			form::closeLabel();
		}
	form::closeTD();
form::closeTR();

//envolvidos
mysql_select_db("sjd", $con[8]);
$sqlE="SELECT * FROM envolvido WHERE id_{$proc} ='".$idProcesso."'";
$resE=mysql_query($sqlE);

form::openTR();
	form::openTD("colspan=2");
		form::openLabel("Envolvidos");
		while ($rowE=mysql_fetch_assoc($resE)) {
			if ($rowE[nome]) echo "$rowE[cargo] $rowE[nome] - $rowE[situacao]<br>";
		}
		form::closeLabel();
	form::closeTD();
form::closeTR();

form::openTR();
	form::openTD("colspan='2'");
		form::openLabel("S&iacute;ntese do fato");
			echo $objetoProcesso->sintese_txt;
		form::closeLabel();
	form::closeTD();
form::closeTR();

?>

</table>
