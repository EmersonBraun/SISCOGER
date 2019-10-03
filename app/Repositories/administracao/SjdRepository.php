<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\administracao;

use Cache;

use App\Repositories\BaseRepository;
use App\Models\Sjd\Administracao\Sjd;

class SjdRepository extends BaseRepository
{
    protected $model;
    protected $expiration = 60 * 24 * 7;  //uma semana

	public function __construct(Sjd $model)
	{
        $this->model = $model;     
    }
    
    public function cleanCache()
	{
        Cache::tags('sjd')->flush();
    }

    public function all()
	{
        $registros = Cache::tags('sjd')->remember('todos_sjd', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    }

    public function getByRg($rg)
	{
        $registros = Cache::tags('sjd')->remember('sjd:rg'.$rg, $this->expiration, function() use($rg){
            return $this->model->where('rg', $rg)->first();
        });

        return $registros;
    }
}

