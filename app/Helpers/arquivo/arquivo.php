<?php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\File;
// use Validator;

//para fazer upload
if (! function_exists('arquivo')) 
{
	function arquivo($request, $arquivo, $proced, $id)
	{
        $rota = Route::currentRouteName(); //proc.movimentos
        $rota = explode ('.', $rota); //divide em [0] -> proc e [1]-> movimentos
        $rota = $rota[0];

        // $validator = Validator::make($request->file(), [
        //     $arquivo => 'file|mimes:doc,docx,odt|max:5100',
        // ]);
        //dd($validator);
        if ($validator->fails()) {
            return redirect($rota.'.edit')
                        ->withErrors($validator)
                        ->withInput();
            exit;
        }
        //dd($validator);
        //validação
        // $request->validate([
        //     $arquivo => 'file|mimes:doc,pdf,docx,odt|max:100', 
        // ]);

        //arquivo
        $file = $request->file($arquivo);

        //extensão file
        $ext = $file->guessClientExtension();

        //novo nome
        $nomeFile = $proced.$id."_".$arquivo.".".$ext;

        //diretório arquivo
        // $dir = config('sistema.diretorio')."/".$proced;
        $dir = config('sistema.diretorio');
    
        // config('sistema.diretorio') public_path('arquivo')
        // $dir = asset('storage/arquivo');
        
        if(!is_dir($dir))
        {
            File::makeDirectory($dir, $mode = 0777, true, true);
        }
       
        //mover para diretório
        $upload = $file->move($dir,$nomeFile);
        //$upload =  Storage::putFileAs($arquivo, new File($dir), $nomeFile);
        
        // Verifica se NÃO deu certo o upload (Redireciona de volta)
        if ( !$upload ) abort(400, 'Nenhum arquivo foi enviado.');

        //$visibility = Storage::setVisibility($nomeFile, 'public');

        //Local file salvo no banco
        return $nomeFile;
 
	}
}