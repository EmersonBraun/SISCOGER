<?php

namespace App\Http\Controllers\FileUpload;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Storage;
use File;
use Response;

Use App\Repositories\FileUpload\FileUploadRepository;

class FileUploadController extends Controller
{
    protected $repository;
    public function __construct(FileUploadRepository $repository)
	{
        $this->repository = $repository;
    }

    public function index($proc, $id, $arquivo)
    {
        $list = $this->repository->active($proc, $id, $arquivo); 
        $apagados = $this->repository->removeds($proc, $id, $arquivo); 

        if($list){
            return response()->json([
                'list' => $list,
                'apagados' => $apagados,
                'success' => true
            ]);
        }
        
        return response()->json([
            'success' => false,
        ], 500);
    }

    public function show($proc, $procid, $arquivo, $hash)
    {
        // validações
        $validation = $this->validations($proc, $procid, $arquivo, $hash);
        if($validation) return response()->json($validation, 500);

        $search = $this->repository->getByHash($hash);
        if(!$search) abort(404);

        $path = $this->getFile($search, $proc, $procid, $arquivo);
        if(!$path) abort(404);
        
        $response = $this->makeResponse($path);
        return $response;
    }

    public function download($id)
    {
        $search = $this->repository->get($id);
        $path = storage_path($search->path);
        $path = str_replace('//','/',$path);
        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);
        $headers = array('Content-Type: '.$type,);

        return Response::download($path, $search->name, $headers);
    }

    public function validations($proc, $procid, $arquivo, $hash)
    {
        if(!$proc) return $msg = ['erro' => 'Falta Proc','success' => false];
        if(!$procid) return $msg = ['erro' => 'Falta ID Proc','success' => false];
        if(!$arquivo) return $msg = ['erro' => 'Falta arquivo','success' => false];
        if(!$hash) return $msg = ['erro' => 'Falta HASH','success' => false];
        return $msg = null;
    }

    public function getFile($search, $proc, $procid, $arquivo)
    {
        $config = config('app.uploads');
        $path = storage_path($search->path);

        if (!File::exists($path)) {

            $fileAntigo = $this->repository->fileAntigo($proc, $procid); 
            
            if(!$fileAntigo) abort(404);

            $path = $config.'/'.$arquivo;
        }

        return $path;
    }

    public function makeResponse($path)
    {
        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }


    public function store(Request $request)
    {
        $dados = $request->all(); // dados requisição
        $file = $request->file('file'); //arquivo
        $filename = $this->nameFile($dados, $file); // nome do arquivo
        $data_arquivo = $this->dataFile($dados); // data do arquivo
        $proc = $this->repository->getOriginProc($dados); //pegar procedimento
        $update = $this->repository->updateOriginTable($dados, $filename, $data_arquivo); //atualiza tabela do procedimento

        $folder = $this->hash();
        $config = $this->config();
        $path = $config.'/'.$folder.'/'.$filename;

        if(Storage::disk('uploads')->putFileAs($folder,  $file, $filename)) {
            $this->saveFile($filename, $dados, $file, $path, $proc, $data_arquivo);

            return response()->json([
                'success' => true,
            ], 200);
        }

        return response()->json([
            'success' => false
        ], 500);
    }

    public function nameFile($dados, $file)
    {
       if($dados['nome_original']) $filename = tira_acentos($file->getClientOriginalName());   
       else $filename = $dados['proc'].$dados['id_proc'].'_'.$dados['name'].'.'.$dados['ext']; 
       return $filename;
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

    public function saveFile($filename, $dados, $file, $path, $proc, $data_arquivo)
    {
        $file = [
        'hash' => $this->hash(),
        'name' => $filename,
        'campo' => $dados['name'],
        'mime' => $file->getClientMimeType(),
        'path' => $path,
        'size' => $file->getClientSize(),
        'sjd_ref' => $proc['sjd_ref'],
        'sjd_ref_ano' => $proc['sjd_ref_ano'],
        'rg' => $dados['rg'],
        'proc' => $dados['proc'],
        'id_proc' => $dados['id_proc'],
        'data_arquivo' => $data_arquivo,
        'obs' => $dados['obs']
        ];

        $this->repository->create($file);
        $this->repository->clearCache($file['proc'],$file['id_proc'],$file['campo']);
         
    }

    public function delete($id)
    {
        $delete = $this->repository->delete($id);
        if ($delete) {
            return response()->json([
                'success' => true,
            ], 200);
        }
        return response()->json([
            'success' => false
        ], 500);

    }

    public function destroy($id)
    {
        $search =  $this->repository->get($id);
        $destroy = $this->repository->destroy($id);

        $path = storage_path($search->path);
        if (file_exists($path)) {
            unlink($path);
            return response()->json([
                'success' => true,
            ], 200);
        }
        return response()->json([
            'success' => false
        ], 500);

    }
}
