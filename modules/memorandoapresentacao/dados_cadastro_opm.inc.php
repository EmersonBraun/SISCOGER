
    <table width="100%" cellpadding="0px"  class="bordasimples">
        <tr>
            <td colspan="2"><h1 style="text-align: center">DADOS PARA CRIAÇÃO</h1>
        </tr>
        <tr>
            <td style="width: 100px; background: #dbeaf5 fixed"><h2>Cabeçalho<span style="color: red">*</span></h2></td>
            <td style="border: 1px solid black"><?= $memorandoapresentacao->getCabecalhoEmHtml(); ?></td>
        </tr>
        <tr>
            <td style="width: 100px; background: #dbeaf5 fixed"><h2>Nº Sequência</h2></td>
            <td style="border: 1px solid black"><input type="text" name="memorandoapresentacao[proximo_numero]" value="<?= $memorandoapresentacao->numeroDeSequenciaInicial; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 100px; background: #dbeaf5 fixed"><h2>Sigla Seção</h2></td>
            <td style="border: 1px solid black"><input type="text" name="memorandoapresentacao[sigla]" value="<?= $memorandoapresentacao->sigla; ?>" /></td>
        </tr>
        <tr>
            <td style="width: 100px; background: #dbeaf5 fixed"><h2>Data</h2></td>
            <td style="border: 1px solid black"><?= $memorandoapresentacao->getDataEmHtml(); ?></td>
        </tr>
        <tr>
            <td style="width: 100px; background: #dbeaf5 fixed"><h2>Assunto</h2></td>
            <td style="border: 1px solid black"><?= $memorandoapresentacao->getAssuntoEmHtml(); ?></td>
        </tr>
        <tr>
            <td style="width: 100px; background: #dbeaf5 fixed"><h2>Nr. Vias</h2></td>
            <td style="border: 1px solid black">
                <label><input type="radio" name="memorandoapresentacao[vias]" value="1" <?php echo $memorandoapresentacao->nrVias == 1 ? 'checked' : ''; ?> />1 via</label>
                <label><input type="radio" name="memorandoapresentacao[vias]" value="2" <?php echo $memorandoapresentacao->nrVias != 1 ? 'checked' : ''; ?> />2 vias (SJD e Policial)</label>
            </td>
        </tr>
        <tr>
            <td style="width: 100px; background: #dbeaf5 fixed"><h2>Fecho<span style="color: red">*</span></h2></td>
            <td style="border: 1px solid black"><?php
                $sqlAutoridades = sprintf("
                SELECT * FROM (
                SELECT 0 as ordem, posto1.id_posto, c1.id_cadastroopmcoger as id_autoridade, pm1.rg, pm1.cargo, pm1.quadro, pm1.subquadro, pm1.nome, c1.opm_autoridade_funcao as funcao
                FROM `cadastroopmcoger` c1
                LEFT JOIN `RHPARANA`.`POLICIAL` pm1 ON c1.opm_autoridade_rg = pm1.rg
                LEFT JOIN `sjd`.`posto` posto1 ON pm1.cargo = posto1.posto
                WHERE c1.cdopm = '%s'
                UNION
                SELECT 1 as ordem, posto2.id_posto, ca.id_cadastroopmcogerautoridade as id_autoridade, pm2.rg, pm2.cargo, pm2.quadro, pm2.subquadro, pm2.nome, ca.funcao as funcao
                FROM `cadastroopmcogerautoridade` ca
                LEFT JOIN `cadastroopmcoger` c2 ON c2.id_cadastroopmcoger = ca.id_cadastroopmcoger
                LEFT JOIN `RHPARANA`.`POLICIAL` pm2 ON ca.rg = pm2.rg
                LEFT JOIN `sjd`.`posto` posto2 ON pm2.cargo = posto2.posto
                WHERE c2.cdopm = '%s') AS autoridades
                ORDER BY ordem, id_posto, nome
            ", mysql_real_escape_string($codigoBase), mysql_real_escape_string($codigoBase));

                @$res = mysql_query($sqlAutoridades, $con[8]);

                if (($res === false) || mysql_num_rows($res) == 0) {
                    echo 'Não foram encontradas autoridades no cadastro da opm: ' . $opm_login->abreviatura;
                } else {
?>
                <div style="height:120px;overflow-y:scroll" >
                    <style>
                        .linha-autoridade:hover {
                            background-color: #CCCCCC;
                        }
                    </style>
                <table border="0">

<?php
                    while ($row = mysql_fetch_assoc($res)) {
                        //var_dump($row);
                        if ($row['ordem'] == 0) {
                            $autoridadeTipo = 'cadastroopmcoger';
                        } else {
                            $autoridadeTipo = 'cadastroopmcogerautoridade';
                        }

                        $autoridadeId = $row['id_autoridade'];

                        $autoridadeRg = $row['rg'];

                        echo '<tr>';
                        echo '<td>';

                        $checked = ( ($autoridadeTipo == $memorandoapresentacao->autoridadeTipo) && ($autoridadeId == $memorandoapresentacao->autoridadeId) )? 'checked' : '';

                        echo "<label><input type='radio' id='id_autoridade_{$autoridadeTipo}_{$autoridadeId}' name='id_autoridade' value='{$autoridadeTipo}+{$autoridadeId}+{$autoridadeRg}' $checked /></label>";
                        echo '</td>';
                        echo '<td class="linha-autoridade">';
                        echo "<label for='id_autoridade_{$autoridadeTipo}_{$autoridadeId}'>";
                        echo FHelperICO::obtemNomeConformeAIco($row['cargo'],$row['quadro'],$row['subquadro'],$row['nome']);
                        echo ",<br />";
                        echo "<strong>{$row['funcao']}</strong>.";
                        echo '</label>';
                        echo '</td>';
                        echo '</tr>';
                    }

                    ?>

                </table>
                </div>

                <?php
                }
                ?></td>
        </tr>
        <tr>
            <td colspan="2">
                <?php if (!is_null($idsApresentacoesSelecionadas) && !empty($idsApresentacoesSelecionadas )):?>
                <input type="submit" name="acao" value="Gerar"/>
                <?php endif; ?>
                <input type="submit" name="acao" value="Alterar" />
                <button onclick="javascript: (function(obj,event) {event.preventDefault();window.location='?module=cadastroopmcoger'})(this,event)">Editar cadastro da Unidade</button>
                <button onclick="javascript: (function(obj,event) {event.preventDefault();window.location='?module=apresentacao&opcao=listar'})(this,event)">Voltar e selecionar</button>
                <button onclick="javascript: (function(obj,event) {event.preventDefault();limparEVoltar();})(this,event)">Limpar e voltar</button>
            </td>
        </tr>
    </table>
            <input type="hidden" name="ids" />
