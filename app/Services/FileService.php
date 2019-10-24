<?php
//Aqui fica a parte de lógica dos controllers, para não ficar enchendo de atribuições erradas
namespace App\Services;

use File;
use Response;

class FileService 
{

    protected $repository;

	public function __construct(
        // logRepository $repository
    )
	{
        // $this->repository = $repository;
    }

    public function validations($proc, $procid, $arquivo, $hash)
    {
        $msg = [];
        if(!$proc) return $msg = ['erro' => 'Falta Proc','success' => false];
        if(!$procid) return $msg = ['erro' => 'Falta ID Proc','success' => false];
        if(!$arquivo) return $msg = ['erro' => 'Falta arquivo','success' => false];
        if(!$hash) return $msg = ['erro' => 'Falta HASH','success' => false];
        return $msg;
    }

    public function getPath($search)
    {
        $path = storage_path($search->path);
        $path = str_replace('//','/',$path);

        if (!File::exists($path)) abort(404);
        return $path;
    }

    public function headers($path)
    {
        $type = File::mimeType($path);
        $headers = array('Content-Type: '.$type,);
        return $headers;
    }

    public function pathUploads()
    {
        return config('app.uploads');
    }

    public function makeResponse($path)
    {
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    public function nameFile($dados, $file)
    {
       if($dados['nome_original']) $filename = tira_acentos($file->getClientOriginalName());   
       else $filename = $dados['proc'].$dados['id_proc'].'_'.$dados['name'].'.'.$dados['ext']; 
       return $filename;
    }

    public function nomeOriginal($file)
    {
        return tira_acentos($file->getClientOriginalName());
    }

    public function dataFile($dados)
    {
        return (!$dados['data_arquivo']) ? date('Y-m-d'): $dados['data_arquivo'];
    }

    public function hash()
    {
        return hash( 'sha256', time());
    }

    public function config() // descrição do caminho dos arquivos
    {
        return (!is_null(config('app.uploads'))) ? config('app.uploads') : '' ;
    }

    public function getPathComplete($filename)
    {
        $folder = $this->hash();
        $config = $this->config();
        return $config.'/'.$folder.'/'.$filename;
    }
}

