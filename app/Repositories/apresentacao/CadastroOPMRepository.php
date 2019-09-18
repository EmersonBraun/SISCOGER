<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\apresentacao;

use Cache;
use App\Models\Sjd\Apresentacao\CadastroOPM;
use App\Repositories\BaseRepository;

class CadastroOPMRepository extends BaseRepository
{
    protected $model;
    protected static $expiration = 60 * 24;//um dia; 

	public function __construct(CadastroOPM $model)
	{
        $this->model = $model;
    }

    public function cleanCache()
	{
        Cache::tags('cadastroopm')->flush();
    }
    
    public function all()
	{
        $registros = Cache::tags('cadastroopm')->remember('todos_cadastroopm', self::$expiration, function() {
            return $this->model->orderBy('id_cadastroopmcoger','DESC')->get();
        });

        return $registros;
    } 

    public function get($cdopm)
	{
        $registros = Cache::tags('cadastroopm')->remember('cadastroopm:'.$cdopm, self::$expiration, function() use ($cdopm){
            return $this->model->where('cdopm',$cdopm)->first();
        });

        return $registros;
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

}

