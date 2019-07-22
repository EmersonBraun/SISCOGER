<?
//error_reporting( E_ALL );

include ("filtro.inc");

$tabela = new TabelaHtml();
$tabela->setUrlBasica("?module={$module}&opcao={$opcao}");
$tabela->setTitulo('DIRETORIA DE DESENVOLVIMENTO TECNOLOGIA E QUALIDADE');
$tabela->setSubtitulo('Apresentações - 2016 (Todas - A partir de hoje)');
$tabela->setQtdeRegistroPorPaginaPadrao(2);

$sql = "SELECT a.*, pm.nome, pm.rg, pm.cargo, pm.quadro, pm.subquadro, cs.apresentacaoclassificacaosigilo, tp.apresentacaotipoprocesso, c.apresentacaocondicao, opm.ABREVIATURA as opmsigla FROM `apresentacao` a "
   . " LEFT JOIN `RHPARANA`.`POLICIAL` pm ON pm.rg = a.pessoa_rg "
   . " LEFT JOIN `apresentacaoclassificacaosigilo` cs ON cs.id_apresentacaoclassificacaosigilo = a.id_apresentacaoclassificacaosigilo "
   . " LEFT JOIN `apresentacaotipoprocesso` tp ON tp.id_apresentacaotipoprocesso = a.id_apresentacaotipoprocesso "
   . " LEFT JOIN `apresentacaocondicao` c ON c.id_apresentacaocondicao = a.id_apresentacaocondicao "
   . " LEFT JOIN `RHPARANA`.`opmPMPR` opm ON pm.opm_meta4 = opm.META4";

$query = new Query(new PDO($pdo['dsn'],$pdo['user'],$pdo['password']), $sql);
$tabela->setQuery($query);

// primeiro filtro permanente
$filtro = new FiltroTabela();
$filtro->setNome('permanente');
$filtro->setComparador(function(){
    return sprintf("comparecimento_dh >= '%s'", date("Y-m-d 00:00:00"));
});
$tabela->filtrosPermanentes->attach($filtro);

$filtro = new FiltroTabela();
$filtro->setNome('nome');
$filtro->setComparador(function($valor){
    return "pessoa_nome like '%{$valor}%'";
});
$tabela->filtros->attach($filtro);

$coluna = new ColunaHtml('Nº Apres.',function($row){return "{$row['sjd_ref']}/{$row['sjd_ref_ano']}";});
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Nº Of.',array('a.documento_de_origem','documento_de_origem'));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Pessoa',function($row){
    if (!empty($row['rg'])) {
        $pessoa = "{$row['cargo']}";
        $pessoa .= " {$row['quadro']}";
        if ($row['subquadro'] != 'NA') {
            $pessoa .= " {$row['subquadro']}";
        }
        $pessoa .= " {$row['nome']}";
    } else {
        $pessoa = "{$row['pessoa_cargo']}";
        $pessoa .= " {$row['pessoa_quadro']}";
        $pessoa .= " {$row['pessoa_nome']}";
    }
    return $pessoa;
});
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Unidade', function($row){
    if (!empty($row['opmsigla'])) {
        $opmsigla = "{$row['opmsigla']}";
    } else {
        $opmsigla = "{$row['pessoa_unidade_lotacao_sigla']}";
    }

    return $opmsigla;
});
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Tipo',array('tp.apresentacaotipoprocesso', 'apresentacaotipoprocesso'));
$tabela->colunas->attach($coluna);
$coluna = new ColunaHtml('Autos','autos_numero');
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Condição', array('c.apresentacaocondicao','apresentacaocondicao'));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Local', array('a.comparecimento_local_txt', 'comparecimento_local_txt'));
$tabela->colunas->attach($coluna);

$coluna = new ColunaHtml('Data/Hora', array('a.comparecimento_dh','comparecimento_dh'));
$coluna->setTipo(ColunaHtml::COL_DATETIME);
$coluna->setDateFormat("d/m/Y H:i");
$tabela->colunas->attach($coluna);

$tabela->render();

echo '<br />';



$filtroOpm = "";

$sql=" SELECT *, a.*, pm.nome, pm.rg, pm.cargo, pm.quadro, pm.subquadro, cs.apresentacaoclassificacaosigilo, tp.apresentacaotipoprocesso, c.apresentacaocondicao, opm.ABREVIATURA as opmsigla FROM `apresentacao` a "
   . " LEFT JOIN `RHPARANA`.`POLICIAL` pm ON pm.rg = a.pessoa_rg "
   . " LEFT JOIN `apresentacaoclassificacaosigilo` cs ON cs.id_apresentacaoclassificacaosigilo = a.id_apresentacaoclassificacaosigilo "
   . " LEFT JOIN `apresentacaotipoprocesso` tp ON tp.id_apresentacaotipoprocesso = a.id_apresentacaotipoprocesso "
   . " LEFT JOIN `apresentacaocondicao` c ON c.id_apresentacaocondicao = a.id_apresentacaocondicao "
   . " LEFT JOIN `RHPARANA`.`opmPMPR` opm ON pm.opm_meta4 = opm.META4 ";
//pre($sql);
// Usuário COGER
if (in_array((integer)$user["nivel"],array(4,5))) {
    $apresentacoesAExibir = '(Todas - A partir de hoje)';
    $permissao = array(1,2,3,4);
}
// Usuário SJD Oficial
else if (in_array((integer)$user["nivel"],array(2))) {
    $filtroOpm = " pessoa_opm_codigo like '%{$opm_login->codigoBase}%' ";
    $permissao = array(1,2,3);
    $apresentacoesAExibir = '(Somente OPM - A partir de hoje)';
}
// Usuário SJD Praça
else if (in_array((integer)$user["nivel"],array(2))) {
    $filtroOpm = " pessoa_opm_codigo like '%{$opm_login->codigoBase}%' ";
    $permissao = array(1,2,3);
    $apresentacoesAExibir = '(Apenas Publicas da OPM - A partir de hoje)';
}
else {
    $apresentacoesAExibir = '(Somente publicas - A partir de hoje)';
}

// Verifica se algum filtro foi definido, se não foi, filtra pelo ano
if (empty($filtros)) {
    $hoje = new DateTime();
    $hoje->setTime(0, 0, 0);
    $filtros[] = '(EXTRACT(YEAR FROM comparecimento_data) = EXTRACT(YEAR FROM now()) OR sjd_ref_ano=EXTRACT(YEAR FROM now()))';
    $filtros[] = sprintf("comparecimento_dh >= '%s'", $hoje->format("Y-m-d H:i:s"));
}

// filtro para unidade
$filtros[] = empty($filtroOpm) ? ' 1=1 ' : $filtroOpm;


if (empty($ordem)) {
    $ordem = ' comparecimento_dh DESC';
}

$where = " WHERE " . implode(' AND ',$filtros) . " ";

$ordem = " ORDER BY " . $ordem . " ";

$sql = $sql . $where . $ordem;



?>

<center>
<!-- -->
<TABLE width="100%" cellpadding="0px"  class="bordasimples">
    <tr><TD colspan="9"><h1><center><?=$opm_login->descricao;?></center></h1></TD></tr>
   <tr><TD colspan=9><h2><center>Apresentações - <?echo $_SESSION['sjd_ano'];?> <?=$apresentacoesAExibir;?></center></h2></TD></tr>
   <Tr>
       <TD width='80' class="lista"><b>Nº Apres.</b></TD>
       <td><b>Nº Of.</b></td>
       <td><b>Pessoa</b></td>
       <td><b>Unidade</b></td>
       <td><b>Tipo</b></td>
       <td><b>Autos</b></td>
       <td><b>Condição</b></td>
       <td><b>Local</b></td>
       <td><b>Data/Hora</b></td>
   </tr>
   	<?
	mysql_select_db("sjd");
	$res=mysql_query($sql);
	$i=0;
	while ($row=mysql_fetch_array($res)) {
                $datahora = new DateTime($row['comparecimento_dh']);
		$i%2?($cor='white'):($cor='#EEEEEE');
		echo "<tr bgcolor=$cor>"
                ."<td><a href='?module=apresentacao&apresentacao[id]={$row['id_apresentacao']}'>{$row['sjd_ref']}/{$row['sjd_ref_ano']}</a></td>"
                ."<td>".$row['documento_de_origem']."</td>";

                echo "<td>";

                if (!empty($row['rg'])) {
                    $pessoa = "{$row['cargo']}";
                    $pessoa .= " {$row['quadro']}";
                    if ($row['subquadro'] != 'NA') {
                        $pessoa .= " {$row['subquadro']}";
                    }
                    $pessoa .= " {$row['nome']}";
                } else {
                    $pessoa = "{$row['pessoa_cargo']}";
                    $pessoa .= " {$row['pessoa_quadro']}";
                    $pessoa .= " {$row['pessoa_nome']}";
                }

                echo $pessoa;
                echo "</td>";

                echo "<td>";

                if (!empty($row['opmsigla'])) {
                    $opmsigla = "{$row['opmsigla']}";
                } else {
                    $opmsigla = "{$row['pessoa_unidade_lotacao_sigla']}";
                }

                echo $opmsigla;
                echo "</td>";

                echo "<td>{$row['apresentacaotipoprocesso']}</td>";
                echo "<td>{$row['autos_numero']}</td>";

                echo "<td>{$row['apresentacaocondicao']}</td>";
                echo "<td>{$row['comparecimento_local_txt']}</td>";

                echo "<td>".$datahora->format("d/m/Y H:i")."</td>";



		echo "</tr>";
	$i++;
	}
	echo "<tr><td colspan=9><h1>Total: ".mysql_num_rows($res)."</h1></td></tr>";
	?>
        </select>
   </TR>
   </TR>

</td></tr></table>

<br>
