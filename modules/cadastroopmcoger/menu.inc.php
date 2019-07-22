<center><h1>Dados cadastrais da Unidade</h1></center>
<center><h2><?=$opmResp->descricao;?></h2></center>
<?php if (in_array($user["nivel"], array(4,5,7))): ?>
<div class='bordasimples'>
    <table width='100%' class='menu' cellpadding='0' cellspacing='0' bgcolor='#F0F0F0'>
        <tr>
            <td>
                <ul>
                    <?php
                    menuli("Listar", "listar");
                    ?>
                </ul>
            </td>
        </tr>
        <tr>
            <td>
                <?
                //if ($opcao=="cadastrar") echo "<center><h1>Novo MATERIAL</h1></center>";
                //if ($opcao=="atualizar") echo "<center><h1>Editar MATERIAL</h1></center>";
                //if ($opcao=="listar") echo "<center><h1>Materiais cadastrados</h1></center>";
                //if ($opcao=="buscar") echo "<center><h1>Procurar MATERIAL</h1></center>";
                //if ($opcao=="excluir") echo "<center><h1>Exclus&atilde;o de MATERIAL</h1></center>";
                ?>
            </td>
        </tr>
    </table>
</div>
<?php endif; ?>
