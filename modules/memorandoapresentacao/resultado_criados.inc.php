<table width="100%" cellpadding="0px"  class="bordasimples">
    <tr>
        <td colspan="4"><h1 style="text-align: center">RESULTADO DA CRIAÇÃO</h1>
    </tr>
    <tr>
        <td style="background: #dbeaf5 fixed">Arquivo PDF contendo todos os memorandos gerados</td>
        <td><a href="<?=$gerador->getArquivoCompleto()->getLinkRelativo();?>"><?=$gerador->getArquivoCompleto()->getNome();?></a></td>
    </tr>
    <tr>
        <td style="background: #dbeaf5 fixed">Arquivo ZIP contendo todos os memorandos gerados em arquivos separados</td>
        <td><a href="<?=$gerador->getArquivoZip()->getLinkRelativo();?>"><?=$gerador->getArquivoZip()->getNome();?></a></td>
    </tr>
    <tr>
        <td colspan="4">* Os arquivos PDF também estão disponíveis para download no módulo Apresentação e na tabela abaixo</td>
    </tr>

</table>
