<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use Illuminate\Support\Facades\DB;

use Cache;

use App\Repositories\BaseRepository;
use App\Models\Sjd\Proc\Sobrestamento;
use App\Repositories\proc\ProcRepository;

class SobrestamentoRepository extends BaseRepository
{
    protected $model;
    protected $proc;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia 

	public function __construct(
        Sobrestamento $model,
        ProcRepository $proc
    )
	{
		$this->model = $model;
        
        // ver se vem da api (não logada)
        $proc = Route::currentRouteName(); //listar.algo
        $proc = explode ('.', $proc); //divide em [0] -> listar e [1]-> algo
        $proc = $proc[0];

        $isapi = ($proc == 'api') ? 1 : 0;
        $verTodasUnidades = session('ver_todas_unidades');

        $this->verTodasUnidades = ($verTodasUnidades || $isapi) ? 1 : 0;
        $this->unidade = ($isapi) ? '0' : session('cdopmbase');
    }

    public function cleanCache()
	{
        Cache::tags('sobrestamento')->flush();
    }

    public function create(array $data)
    {
        try {
            $exec = $this->model->create($data);
            if($exec) $this->cleanCache();
            $andamento = $this->proc->changeAndamento($data, 'SOBRESTADO');
            if($andamento) return true;
            return true;
        } catch (\Throwable $th) {
            //dd($th)
            return false;
        }
    }

    public function update(array $data, $id)
    {
        $fim_sobrestamento = ($data['termino_data']) ? true : false;
        try {
            $exec = $this->model->find($id)->update($data);
            if($exec) {
                $this->cleanCache();
                if($fim_sobrestamento) 
                {
                    $andamento = $this->proc->changeAndamento($data, 'ANDAMENTO');
                    if($andamento) return true;
                    return false;
                }
                return true;
            }
        } catch (\Throwable $th) {
            //dd($th)
            return false;
        }
    }

    public function firstOrCreate(array $data)
    {
        try {
            $exec = $this->model->firstOrCreate($data);
            if($exec) $this->cleanCache();
            return true;
        } catch (\Throwable $th) {
            //dd($th)
            return false;
        }
    }

    public function findAndDelete($id)
	{
        try {
            $exec = $this->model->findOrFail($id)->delete();
            if($exec) $this->cleanCache();
            return true;
        } catch (\Throwable $th) {
            //dd($th)
            return false;
        }
    }

    public function findAndRestore($id)
	{
        try {
            $exec = $this->model->withTrashed()->findOrFail($id)->restore();
            if($exec) $this->cleanCache();
            return true;
        } catch (\Throwable $th) {
            //dd($th)
            return false;
        }
    }

    public function findAndDestroy($id)
	{
        try {
            $exec = $this->model->withTrashed()->findOrFail($id)->forceDelete();
            if($exec) $this->cleanCache();
            return true;
        } catch (\Throwable $th) {
            //dd($th)
            return false;
        }
    }

    public function listProc($proc, $id)
    {
        $registros = Cache::tags('sobrestamento')->remember('sobrestamento:'.$proc.$id, $this->expiration, function() use ($proc, $id){
            return $this->model->where('id_'.$proc,'=',$id)->get();;
        });

        return $registros;
    }

    


    public function sobrestados($proc)
	{
        $unidade = session('cdopmbase');
        $verTodasUnidades = session('ver_todas_unidades');

        $andamento = $this->andamento($proc);

        if($verTodasUnidades)
        {
            $registros = Cache::tags('sobrestamento')->remember('sobrestament:'.$proc, 60, function() use ($proc, $andamento){
                return DB::connection('sjd')->select("SELECT DISTINCT s.*, ".$proc.".* , opm.ABREVIATURA,
                DIASUTEIS(".$proc.".abertura_data,DATE(NOW()))+1 
                AS dutotal,
                b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) 
                AS diasuteis FROM sobrestamento AS s
                LEFT JOIN (SELECT id_".$proc.", DIASUTEIS(inicio_data, DATE(NOW())) 
                AS dusobrestado FROM sobrestamento
                WHERE termino_data ='0000-00-00' AND inicio_data !='0000-00-00' AND id_".$proc."!='') 
                AS b ON b.id_".$proc." = s.id_".$proc."
                INNER JOIN ".$proc." ON
                        s.id_".$proc."=".$proc.".id_".$proc." 
                LEFT JOIN RHPARANA.opmPMPR AS opm ON
                        opm.CODIGOBASE=".$proc.".cdopm
                WHERE s.termino_data ='0000-00-00' AND 
                ".$proc.".id_andamento=".$andamento." ORDER BY ".$proc.".id_".$proc." DESC");
            });
        }
        else 
        {
            $registros = Cache::tags('sobrestamento')->remember('sobrestament:'.$proc.':'.$unidade, 60, function() use ($proc, $andamento, $unidade){
                return DB::connection('sjd')->select("SELECT DISTINCT s.*, ".$proc.".* , opm.ABREVIATURA,
                DIASUTEIS(".$proc.".abertura_data,DATE(NOW()))+1 
                AS dutotal,
                b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) 
                AS diasuteis FROM sobrestamento AS s
                LEFT JOIN (SELECT id_".$proc.", DIASUTEIS(inicio_data, DATE(NOW())) 
                AS dusobrestado FROM sobrestamento
                WHERE termino_data ='0000-00-00' AND inicio_data !='0000-00-00' AND id_".$proc."!='') 
                AS b ON b.id_".$proc." = s.id_".$proc."
                INNER JOIN ".$proc." ON
                        s.id_".$proc."=".$proc.".id_".$proc." 
                LEFT JOIN RHPARANA.opmPMPR AS opm ON opm.CODIGOBASE=".$proc.".cdopm
                WHERE s.termino_data ='0000-00-00' 
                AND ".$proc.".cdopm LIKE ".$unidade."%
                AND ".$proc.".id_andamento=".$andamento." ORDER BY ".$proc.".id_".$proc." DESC");
            });
        }

        return $registros;
    } 

    public function andamento($proc)
    {
        if($proc == 'adl') $andamento = '17';
        if($proc == 'cd') $andamento = '11';
        if($proc == 'cj') $andamento = '14';
        if($proc == 'fatd') $andamento = '3';
        if($proc == 'it') $andamento = '23';
        if($proc == 'sindicancia') $andamento = '8';

        return $andamento;
    }

}

