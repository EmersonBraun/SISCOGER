<?php

//para fazer upload
if (! function_exists('arquivo')) 
{
	function arquivo($request, $arquivo, $proced, $id)
	{

        //validação
        $request->validate([
            $arquivo => 'file|mimes:doc,pdf,docx,odt|max:5100',
        ]);

        //arquivo
        $file = $request->file($arquivo);

        //extensão file
        $ext = $file->guessClientExtension();

        //novo nome
        $nomeFile = $proced.$id."_".$arquivo.".".$ext;

        //diretório arquivo
        $dir = config('sistema.diretorio')."/".$proced;
        
        if(!is_dir($dir))
        {
            File::makeDirectory($dir, 7777, true, true);
        }
        
        //mover para diretório
        $upload = $file->move($dir,$nomeFile);
        
        // Verifica se NÃO deu certo o upload (Redireciona de volta)
        if ( !$upload )
        {
            abort(400, 'Nenhum arquivo foi enviado.');
        }

        //Local file salvo no banco
        return $nomeFile;
 
	}
}