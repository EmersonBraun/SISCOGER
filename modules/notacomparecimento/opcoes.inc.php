<table cellpadding="0" cellspacing="1" width="100%" border="0"><tr><td colspan=2 bgcolor="#4682B4">
    <table cellspacing="1" width="100%" border="0">

<?php if ($opcao == "cadastrar"): ?>
        <tr>
            <th colspan="5" bgcolor="#DBEAF5"><font face="tahoma, verdana" size="2">Formulário de preenchimento</font></th>
        </tr>
<?php endif; ?>

<?php if (in_array($opcao, array("atualizar", "visualizar"))): ?>
        <tr>
            <td align="center" colspan="2" bgcolor="#DBEAF5">
                Visualização/atualização |
                <a href="?module=notacomparecimento&opcao=listarapresentacoes&notacomparecimento[id]=<?= $notacomparecimento->id_notacomparecimento; ?>">Apresentações</a>
                <?php if (in_array($user["nivel"], array(4,5))): ?>
                |<a href="?module=notacomparecimento&opcao=apresentacaomassificado&notacomparecimento[id]=<?= $notacomparecimento->id_notacomparecimento; ?>">Cadastro Massificado</a>
                <?php endif; ?>
            </td>
        </tr>
<?php endif; ?>

<?php if (in_array($opcao, array("listarapresentacoes"))): ?>
        <tr>
            <td align="center" colspan="2" bgcolor="#DBEAF5">
                <a href="?module=notacomparecimento&notacomparecimento[id]=<?= $notacomparecimento->id_notacomparecimento; ?>">Visualização/atualização</a> |
                Apresentações
                <?php if (in_array($user["nivel"], array(4,5))): ?>
                | <a href="?module=notacomparecimento&opcao=apresentacaomassificado&notacomparecimento[id]=<?= $notacomparecimento->id_notacomparecimento; ?>">Cadastro Massificado</a>
                <?php endif; ?>
            </td>
        </tr>
<?php endif; ?>

<?php if (in_array($opcao, array("apresentacaomassificado"))): ?>
        <tr>
            <td align="center" colspan="2" bgcolor="#DBEAF5">
                <a href="?module=notacomparecimento&notacomparecimento[id]=<?= $notacomparecimento->id_notacomparecimento; ?>">Visualização/atualização</a> |
                <a href="?module=notacomparecimento&opcao=listarapresentacoes&notacomparecimento[id]=<?= $notacomparecimento->id_notacomparecimento; ?>">Apresentações</a> |
                Cadastro Massificado
            </td>
        </tr>
<?php endif; ?>



    </tr>
    </table>
</table>