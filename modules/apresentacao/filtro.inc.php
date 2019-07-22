<?php $cdopm_selected=$_REQUEST['filtro_busca']['pessoa_opm']; ?>
<form id='apresentacao'>
    <input type="hidden" name="module" value="<?=$module;?>" />
    <input type="hidden" name="opcao" value="<?=$opcao;?>" />
    <table width='100%' class='bordasimples' style='border-top:0px;'>
        <tr>
            <td colspan='9'>
                <h2>Filtro
                    <a href='#noplace' onclick="$('.linhafiltro').show();
                            $('#linhafiltro3').show();">+</a>
                    <a href='#noplace' onclick="$('.linhafiltro').hide();
                            $('#linhafiltro3').hide();">-</a></h2>
            </td>
        </tr>

        <tr class='linhafiltro' style='display:none;'>
            <td>
                <?php // aqui inicia o modelo de label + input  ?>
                <?php // open label OPM, por exemplo  ?>
                <table width="100%" align="left" cellpadding="1" bgcolor="#F2F2F2" class="borda">
                    <tr>
                        <td bgcolor="#FFFFFF" class="borda">OPM QUE CADASTROU:</td>
                    </tr>
                    <tr>
                        <td>

                            <select name=filtro_busca[opm_cadastro]>
                                <?php include ("includes/option_opm4.php"); ?>
                            </select>

                            <?php // close label OPM, por exemplo  ?>
                        </td>
                    </tr>
                </table>
                <?php // aqui termina o modelo de label + input  ?>

            </td>



            <td colspan="1">
                <?php // aqui inicia o modelo de label + input  ?>
                <?php // open label Data da apresentação, por exemplo  ?>
                <table width="100%" align="left" cellpadding="1" bgcolor="#F2F2F2" class="borda">
                    <tr>
                        <td bgcolor="#FFFFFF" class="borda">Número:(Ex.: 1/<?=date("Y");?>)</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" size="8" name="filtro_busca[numero]" />
                        <?php // close label OPM, por exemplo  ?>
                        </td>

                    </tr>
                </table>
            </td><?php // aqui termina o modelo de label + input   ?>

            <td colspan="1">
                <?php // aqui inicia o modelo de label + input  ?>
                <?php // open label Data da apresentação, por exemplo  ?>
                <table width="100%" align="left" cellpadding="1" bgcolor="#F2F2F2" class="borda">
                    <tr>
                        <td bgcolor="#FFFFFF" class="borda">Número da Nota:</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" size="8" name="filtro_busca[numero_nota]" />
                        <?php // close label OPM, por exemplo  ?>
                        </td>

                    </tr>
                </table>
            </td><?php // aqui termina o modelo de label + input   ?>

            <td colspan="1">
                <?php // aqui inicia o modelo de label + input  ?>
                <?php // open label Data da apresentação, por exemplo  ?>
                <table width="100%" align="left" cellpadding="1" bgcolor="#F2F2F2" class="borda">
                    <tr>
                        <td bgcolor="#FFFFFF" class="borda">Pessoa/RG:</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" size="25" name=filtro_busca[pessoa_rg] />
                        <?php // close label OPM, por exemplo  ?>
                        </td>

                    </tr>
                </table>
            </td><?php // aqui termina o modelo de label + input   ?>




            <td colspan="2">
                <?php // aqui inicia o modelo de label + input  ?>
                <?php // open label Data da apresentação, por exemplo  ?>
                <table width="100%" align="left" cellpadding="1" bgcolor="#F2F2F2" class="borda">
                    <tr>
                        <td bgcolor="#FFFFFF" class="borda">Data da apresentação:</td>
                    </tr>
                    <tr>
                        <td>

                            De&nbsp; <?php
                            formulario::data("filtro_busca", "data_ini");
                            calendario::cria(1, "apresentacao", "filtro_busca[data_ini]");
                            ?>
                            At&eacute;&nbsp;
                            <?php formulario::data("filtro_busca", "data_fim");
                            calendario::cria(2, "apresentacao", "filtro_busca[data_fim]");
                ?>

                        <?php // close label OPM, por exemplo  ?>
                        </td>

                    </tr>
                </table>


            </td><?php // aqui termina o modelo de label + input   ?>

            <td colspan="2">
                <?php // aqui inicia o modelo de label + input  ?>
                <?php // open label Data da apresentação, por exemplo  ?>
                <table width="100%" align="left" cellpadding="1" bgcolor="#F2F2F2" class="borda">
                    <tr>
                        <td bgcolor="#FFFFFF" class="borda">Data do cadastro:</td>
                    </tr>
                    <tr>
                        <td>

                            De&nbsp; <?php
                            formulario::data("filtro_busca", "data_cadastro_ini");
                            calendario::cria(3, "apresentacao", "filtro_busca[data_cadastro_ini]");
                            ?>
                            At&eacute;&nbsp;
                            <?php formulario::data("filtro_busca", "data_cadastro_fim");
                            calendario::cria(4, "apresentacao", "filtro_busca[data_cadastro_fim]");
                ?>

                        <?php // close label OPM, por exemplo  ?>
                        </td>

                    </tr>
                </table>


            </td><?php // aqui termina o modelo de label + input   ?>

            <td rowspan="2"><?php // aqui inicia o modelo de label + input  ?>
                <?php // open label ação, por exemplo  ?>
                <table width="100%" style="height:100%" align="left" cellpadding="1" bgcolor="#F2F2F2" class="borda">
                    <tr>
                        <td bgcolor="#FFFFFF" class="borda">Ação:</td>
                    </tr>
                    <tr>
                        <td style="height: 90px">
                            <input type='submit' value='Listar' name='$opcao'>
                        </td>

                    </tr>
                </table>

<?php // aqui termina o modelo de label + input   ?>
            </td>

        </tr>
        <tr class='linhafiltro' style='display:none;'>
            <td>
                <?php // aqui inicia o modelo de label + input  ?>
                <?php // open label OPM, por exemplo  ?>
                <table width="100%" align="left" cellpadding="1" bgcolor="#F2F2F2" class="borda">
                    <tr>
                        <td bgcolor="#FFFFFF" class="borda">OPM PM:</td>
                    </tr>
                    <tr>
                        <td>

                            <select name=filtro_busca[opm_pessoa]>
                                <?php include ("includes/option_opm4.php"); ?>
                            </select>

                            <?php // close label OPM, por exemplo  ?>
                        </td>
                    </tr>
                </table>
                <?php // aqui termina o modelo de label + input  ?>

            </td>




            <td>
                <?php // aqui inicia o modelo de label + input  ?>
                <?php // open label Data da apresentação, por exemplo  ?>
                <table width="100%" align="left" cellpadding="1" bgcolor="#F2F2F2" class="borda">
                    <tr>
                        <td bgcolor="#FFFFFF" class="borda">Nº Of.:</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" size="8" name=filtro_busca[documento_de_origem] />
                        <?php // close label OPM, por exemplo  ?>
                        </td>

                    </tr>
                </table>
            </td><?php // aqui termina o modelo de label + input   ?>




            <td colspan="2">
                <?php // aqui inicia o modelo de label + input  ?>
                <?php // open label Data da apresentação, por exemplo  ?>
                <table width="100%" align="left" cellpadding="1" bgcolor="#F2F2F2" class="borda">
                    <tr>
                        <td bgcolor="#FFFFFF" class="borda">Autos:</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" size="25" name=filtro_busca[autos_numero] />
                        <?php // close label OPM, por exemplo  ?>
                        </td>

                    </tr>
                </table>
            </td><?php // aqui termina o modelo de label + input   ?>

            <td colspan="2">
                <?php // aqui inicia o modelo de label + input  ?>
                <?php // open label Data da apresentação, por exemplo  ?>
                <table width="100%" align="left" cellpadding="1" bgcolor="#F2F2F2" class="borda">
                    <tr>
                        <td bgcolor="#FFFFFF" class="borda">Local/Órgão:</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" size="25" name=filtro_busca[local] />
                        <?php // close label OPM, por exemplo  ?>
                        </td>

                    </tr>
                </table>
            </td><?php // aqui termina o modelo de label + input   ?>
            <td>
                <?php // aqui inicia o modelo de label + input  ?>
                <?php // open label OPM, por exemplo  ?>
                <table width="100%" align="left" cellpadding="1" bgcolor="#F2F2F2" class="borda">
                    <tr>
                        <td bgcolor="#FFFFFF" class="borda">Situação:</td>
                    </tr>
                    <tr>
                        <td>

                            <select name=filtro_busca[id_apresentacaosituacao]>
                                <option value=''></option>
                                <?php include ("includes/option_apresentacao_situacao.php"); ?>
                            </select>

                            <?php // close label OPM, por exemplo  ?>
                        </td>
                    </tr>
                </table>
                <?php // aqui termina o modelo de label + input  ?>

            </td>
        </tr>
    </table>
</form>



