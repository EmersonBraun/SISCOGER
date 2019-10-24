<?php

namespace App\Http\Controllers\FileUpload;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Storage;
use File;
use Response;

Use App\Repositories\FileUpload\FileUploadRepository;
use App\Services\FileService;

class FileUploadController extends Controller
{
    protected $repository;
    protected $service;
    public function __construct(
        FileUploadRepository $repository,
        FileService $service
    )
	{
        $this->repository = $repository;
        $this->service = $service;
    }

    public function index($proc, $id, $arquivo)
    {
        $list = $this->repository->active($proc, $id, $arquivo);
        $old = $this->repository->old($proc, $id, $arquivo); 
        $apagados = $this->repository->removeds($proc, $id, $arquivo); 

        if($list){
            return response()->json([
                'list' => $list,
                'old' => $old,
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
        $validation = $this->service->validations($proc, $procid, $arquivo, $hash);
        if($validation) return response()->json($validation, 500);
        
        $search = $this->repository->getByHash($hash);
        if(!$search) abort(404);

        $path = $this->getFile($search, $proc, $procid, $arquivo);
        if(!$path) abort(404);
        
        $response = $this->service->makeResponse($path);
        return $response;
    }

    public function download($id)
    {
        $search = $this->repository->get($id);
        $path = $this->service->getPath($search);
        $headers = $this->service->headers($path);

        return Response::download($path, $search->name, $headers);
    }

    public function getFile($search, $proc, $procid, $arquivo)
    {
        $config = $this->service->pathUploads();
        $path = $this->service->getPath($search);

        if (!File::exists($path)) {

            $fileAntigo = $this->repository->fileAntigo($proc, $procid); 
            
            if(!$fileAntigo) abort(404);

            $path = $config.'/'.$arquivo;
        }

        return $path;
    }

    public function store(Request $request)
    {
        $dados = $request->all(); // dados requisição
        $file = $request->file('file'); //arquivo

        $filename = $this->service->nameFile($dados, $file); // nome do arquivo
        $data_arquivo = $this->service->dataFile($dados); // data do arquivo

        $proc = $this->repository->getOriginProc($dados); //pegar procedimento
        $update = $this->repository->updateOriginTable($dados, $filename, $data_arquivo); //atualiza tabela do procedimento

        $path = $this->service->getPathComplete($filename);

        if(Storage::disk('uploads')->putFileAs($this->service->hash(),  $file, $filename)) {
            $data = [
                'hash' => $this->service->hash(),
                'filename' => $filename, 
                'data_arquivo' => $data_arquivo,
                'path' => $path,  
            ];

            $dateToCreate = $this->repository->prepareToCreate($data, $dados, $proc, $file);
            $create = $this->repository->createFile($dateToCreate);

            if($create) return response()->json(['success' => true,], 200);
            return response()->json(['success' => false,], 200);
        }

        return response()->json(['success' => false], 200);
    }

    public function delete($id)
    {
        $delete = $this->repository->delete($id);
        if ($delete) return response()->json(['success' => true,], 200);
        return response()->json(['success' => false], 200);
    }

    public function destroy($id)
    {
        $search =  $this->repository->findOrFail($id);
        $destroy = $this->repository->findAndDestroy($id);

        $path = $this->service->getPath($search);
        if (file_exists($path)) {
            unlink($path);
            return response()->json(['success' => true,], 200);
        }
        return response()->json(['success' => false], 500);
    }
}
