<?php

include ("filtro.inc.php");

$sql=<<<SQL
    SELECT * FROM localdeapresentacao
    LEFT JOIN municipio ON municipio.id_municipio=localdeapresentacao.id_municipio
    WHERE 1=1
SQL;

$where = " ";

if (isset($_REQUEST['filtro']['id_municipio']) && (integer) $_POST['filtro']['id_municipio'] !=0) {
    $id_muncipio = (integer) $_POST['filtro']['id_municipio'];
    $where .= " and localdeapresentacao.id_municipio = {$id_muncipio} ";
}

if (isset($_REQUEST['filtro']['localdeapresentacao'])) {
    $localdeapresentacao = mysql_real_escape_string($_POST['filtro']['localdeapresentacao']);
    $where .= " and localdeapresentacao.localdeapresentacao like '%{$localdeapresentacao}%' ";
}

$sql .= $where;

if ($_SESSION[debug]) pre($sql);

?>

<center>
<!-- -->
<TABLE width="100%" cellpadding="0px"  class="bordasimples">
   <tr><TD colspan="10"><h2><center>Locais de apresentação</center></h2></TD></tr>
    <?php

    openTR();   

    $mostrar = array('Número', 'Nome', 'Município', 'telefone');

    foreach ($mostrar as $campo) {
        echo "<td><b>".ucwords(strtolower($campo))."</b></td>";
    }

    closeTR();

    mysql_select_db("sjd");
    $res=mysql_query($sql);
    $i=0;
    
    while ($row=mysql_fetch_array($res)) { 
        $i%2?($cor=white):($cor='#EEEEEE');
        echo "<tr bgcolor=$cor>";

        echo "<td>
            <a href='?module=localdeapresentacao&localdeapresentacao[id]=$row[id_localdeapresentacao]'>
                {$row['id_localdeapresentacao']}
            </a>
            </td>";
        echo "<td>
                <a href='?module=localdeapresentacao&localdeapresentacao[id]=$row[id_localdeapresentacao]'>
                    {$row['localdeapresentacao']}
                </a>
            </td>";
        echo "<td>{$row['municipio']}</td>";
        echo "<td>{$row['telefone']}</td>";

        echo "</tr>";
        $i++;
    }
    echo "<tr><td colspan='10'><h1>Total: ".mysql_num_rows($res)."</h1></td></tr>";
    ?>
        </select>
   </TR>
   </TR>

</td></tr></table>

<br>
