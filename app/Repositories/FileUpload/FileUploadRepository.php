<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\FileUpload;

use Cache;

use App\Repositories\BaseRepository;
Use App\Models\Sjd\Arquivo\FileUpload;
Use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FileUploadRepository extends BaseRepository
{
    protected $model;
    protected static $expiration = 60 * 24;//um dia; 

	public function __construct(FileUpload $model)
	{
        $this->model = $model;
    }

    public function clearCache($proc, $id, $campo)
	{
        Cache::forget('upload:'.$proc.$id.$campo);
    }

    public function get($id)
	{
        $registros = Cache::tags('upload')->remember('upload:'.$id, self::$expiration, function() use($id){
            return $this->model->where('id',$id)->withTrashed()->first();
        });

        return $registros;
    }

    public function newFiles()
	{
        return $this->model->where('is_old_file','0')->get();
    }
    
    public function active($proc, $id, $campo)
	{
        // $registros = Cache::tags('upload')->remember('upload:active'.$proc.$id.$campo, self::$expiration, function() use($proc, $id, $campo){
            return $this->model->where([
                ['proc',$proc],
                ['id_proc',$id],
                ['campo',$campo],
                ['is_old_file','0']
            ])->get();
        // });

        // dd($registros);
        // return $registros;
    } 

    public function old($proc, $id, $campo)
	{
        // $registros = Cache::tags('upload')->remember('upload:old'.$proc.$id.$campo, self::$expiration, function() use($proc, $id, $campo){
            return $this->model->where([
                ['proc',$proc],
                ['id_proc',$id],
                ['campo',$campo],
                ['is_old_file','1']
            ])->get();
        // });

        // dd($registros);
        // return $registros;
    } 

    public function removeds($proc, $id, $campo)
	{
        // $registros = Cache::tags('upload')->remember('upload:deleted'.$proc.$id.$campo, self::$expiration, function() use($proc, $id, $campo){
            return $this->model->onlyTrashed()->where([
                ['proc',$proc],
                ['id_proc',$id],
                ['campo',$campo]
            ])->get();
        // });

        // return $registros;
    }

    public function prepareToCreate(array $data, array $dados, array $proc ,object $file)
    {
        $data = [
            'hash' => $data['hash'],
            'name' => $data['filename'],
            'campo' => $dados['name'],
            'mime' => $file->getClientMimeType(),
            'path' => $data['path'], 
            'size' => $file->getClientSize(),
            'sjd_ref' => $proc['sjd_ref'],
            'sjd_ref_ano' => $proc['sjd_ref_ano'],
            'rg' => $dados['rg'],
            'id_proc' => $dados['id_proc'],
            'proc' => $dados['proc'],
            'data_arquivo' => $data['data_arquivo'],
            'obs' => $dados['obs'],
            'is_old_file' => 0
        ];

        return $data;
    }

    public function createFile(array $file)
    {
        $create = $this->create($file);
        if($create) $this->clearCache($file['proc'],$file['id_proc'],$file['campo']);
        return $create;
    }

    public function getByHash($hash)
	{
        // $registros = Cache::tags('upload')->remember('upload'.$hash, self::$expiration, function() use($hash){
            return $this->model->where('hash',$hash)->withTrashed()->first();
        // });

        return $registros;
    }

    public function fileAntigo($proc, $procid)
    {
        $registros = Cache::tags('upload')->remember('upload'.$proc.$procid, self::$expiration, function() use($proc, $procid){
            return DB::table($proc)->where('id_'.$proc, $procid)->value();
        });

        return $registros;  
    }

    public function updateOriginTable($dados, $filename, $data_arquivo)
    {

        $nome = $this->nome($dados, $filename);
        $data = $this->dataArquivo($dados, $data_arquivo);

        return ['nome' => $nome, 'data' => $data];
    }

    public function nome($dados, $filename)
    {
        $nome = false;
        if(Schema::hasColumn($dados['proc'], $dados['name'])) {
            $nome = DB::table($dados['proc'])
                ->where('id_'.$dados['proc'], $dados['id_proc'])
                ->update([$dados['name'] => $filename]);
        }

        return $nome;
    }

    public function dataArquivo($dados, $data_arquivo)
    {
        $data = false;
        if(Schema::hasColumn($dados['proc'], $dados['name'].'_data')) {
            $data = DB::table($dados['proc'])
                ->where('id_'.$dados['proc'], $dados['id_proc'])
                ->update([$dados['name'].'_data' => $data_arquivo]);
        }
        return $data;
    }

    public function getOriginProc($dados)
    {
        return DB::table($dados['proc'])->where('id_'.$dados['proc'], $dados['id_proc'])->first();
    }

}

