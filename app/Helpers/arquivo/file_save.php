<?php

//para mover arquivo e salvar na base de dados
if (! function_exists('file_save')) 
{
	function file_save($arquivo, $proced, $id)
	{    
        //rec_crpm_file file
    	if ($request->hasFile($arquivo))
    	{
            //arquivo
            $file = $request->file($arquivo);
    		//extensão file
    		$ext = $file->guessClientExtension();
    		//novo nome
            $nomeFile = $proced.$id."_".$file.".".$ext;
            //diretório arquivo
            $dir = config('sistema.diretorio').$proced;
    		//mover para diretório
    		$file->move($dir,$nomeFile);
    		//Local file salvo no banco
    		return $nomeFile;
    	}
    	else
    	{
    		return '';
        }

	}
}