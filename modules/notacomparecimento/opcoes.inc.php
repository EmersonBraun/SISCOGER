<table cellpadding="0" cellspacing="1" width="100%" border="0"><tr><td colspan=2 bgcolor="#4682B4">
    <table cellspacing="1" width="100%" border="0">

<?php if ($opcao == "cadastrar"): ?>
        <tr>
            <th colspan="5" bgcolor="#DBEAF5"><font face="tahoma, verdana" size="2">Formul�rio de preenchimento</font></th>
        </tr>
<?php endif; ?>

<?php if (in_array($opcao, array("atualizar", "visualizar"))): ?>
        <tr>
            <td align="center" colspan="2" bgcolor="#DBEAF5">
                Visualiza��o/atualiza��o |
                <a href="?module=notacomparecimento&opcao=listarapresentacoes&notacomparecimento[id]=<?= $notacomparecimento->id_notacomparecimento; ?>">Apresenta��es</a>
                <?php if (in_array($user["nivel"], array(4,5))): ?>
                |<a href="?module=notacomparecimento&opcao=apresentacaomassificado&notacomparecimento[id]=<?= $notacomparecimento->id_notacomparecimento; ?>">Cadastro Massificado</a>
                <?php endif; ?>
            </td>
        </tr>
<?php endif; ?>

<?php if (in_array($opcao, array("listarapresentacoes"))): ?>
        <tr>
            <td align="center" colspan="2" bgcolor="#DBEAF5">
                <a href="?module=notacomparecimento&notacomparecimento[id]=<?= $notacomparecimento->id_notacomparecimento; ?>">Visualiza��o/atualiza��o</a> |
                Apresenta��es
                <?php if (in_array($user["nivel"], array(4,5))): ?>
                | <a href="?module=notacomparecimento&opcao=apresentacaomassificado&notacomparecimento[id]=<?= $notacomparecimento->id_notacomparecimento; ?>">Cadastro Massificado</a>
                <?php endif; ?>
            </td>
        </tr>
<?php endif; ?>

<?php if (in_array($opcao, array("apresentacaomassificado"))): ?>
        <tr>
            <td align="center" colspan="2" bgcolor="#DBEAF5">
                <a href="?module=notacomparecimento&notacomparecimento[id]=<?= $notacomparecimento->id_notacomparecimento; ?>">Visualiza��o/atualiza��o</a> |
                <a href="?module=notacomparecimento&opcao=listarapresentacoes&notacomparecimento[id]=<?= $notacomparecimento->id_notacomparecimento; ?>">Apresenta��es</a> |
                Cadastro Massificado
            </td>
        </tr>
<?php endif; ?>



    </tr>
    </table>
</table>