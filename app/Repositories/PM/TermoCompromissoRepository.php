<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;

use App\Repositories\BaseRepository;
use App\Models\Sjd\Administracao\Termocompromisso;

class TermoCompromissoRepository extends BaseRepository
{
    protected $model;
    protected $expiration = 60 * 24 * 7;  //uma semana

	public function __construct(Termocompromisso $model)
	{
        $this->model = $model;     
    }
    
    public function cleanCache()
	{
        Cache::tags('termo_compromisso')->flush();
    }

    public function all()
	{
        $registros = Cache::tags('termo_compromisso')->remember('todos_termo_compromisso', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    }

    public function getByRg($rg)
	{
        $registros = Cache::tags('termo_compromisso')->remember('termo_compromisso:rg'.$rg, $this->expiration, function() use($rg){
            return $this->model->where('rg', $rg)->first();
        });

        return $registros;
    }
}

