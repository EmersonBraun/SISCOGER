<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\apresentacao;

use Cache;
use App\Models\Sjd\Apresentacao\CadastroOPMAutoridade;
use App\Repositories\BaseRepository;

class CadastroOPMAutoridadeRepository extends BaseRepository
{
    protected $model;
    protected static $expiration = 60 * 24;//um dia; 

	public function __construct(CadastroOPMAutoridade $model)
	{
        $this->model = $model;
    }

    public function cleanCache()
	{
        Cache::tags('cadastroopmautoridade')->flush();
    }
    
    public function all()
	{
        $registros = Cache::tags('cadastroopmautoridade')->remember('todos_cadastroopmautoridade', self::$expiration, function() {
            return $this->model->orderBy('id_cadastroopmcogerautoridade','DESC')->get();
        });


        return $registros;
    } 

    public function get($id)
	{
        $registros = Cache::tags('cadastroopmautoridade')->remember('cadastroopmautoridade:'.$id, self::$expiration, function() use ($id){
            return $this->model->where('id_cadastroopmcoger',$id)->get();
        });

        return $registros;
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

}

