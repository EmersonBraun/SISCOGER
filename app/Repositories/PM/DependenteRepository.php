<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;

use App\Repositories\BaseRepository;
use App\Models\meta4\Ausencia;
use App\Models\rhparana\DependentesAtiva;
use App\Models\rhparana\DependentesInativo;
use Illuminate\Support\Facades\DB;

class DependenteRepository extends BaseRepository
{
    protected $ativa;
    protected $inativo;
    protected $expiration = 60 * 24 * 7;  //uma semana

	public function __construct(DependentesAtiva $ativa, DependentesInativo $inativo)
	{
        $this->ativa = $ativa; 
        $this->inativo = $inativo;    
    }
    
    public function cleanCache()
	{
        Cache::tags('dependente')->flush();
    }

    public function ativa()
	{
        $registros = Cache::tags('dependente')->remember('todos_dependente:ativa', $this->expiration, function() {
            return $this->ativa->all();
        });

        return $registros;
    }

    public function ativaPM($rg)
	{
        $registros = Cache::tags('dependente')->remember('dependente:ativa:rg'.$rg, $this->expiration, function() use($rg){
            return $this->ativa->select(DB::raw('DISTINCT nome, sexo, data_nasc, parentesco'))->where('rg','=', $rg)->get();
        });

        return $registros;
    }

    public function inativo()
	{
        $registros = Cache::tags('dependente')->remember('todos_dependente:inativo', $this->expiration, function() {
            return $this->inativo->all();
        });

        return $registros;
    }

    public function inativoPM($rg)
	{
        $registros = Cache::tags('dependente')->remember('dependente:inativo:rg'.$rg, $this->expiration, function() use($rg){
            return $this->inativo->select(DB::raw('DISTINCT nome, sexo, data_nasc, parentesco'))->where('rg','=', $rg)->get();
        });

        return $registros;
    }

    public function dependentes($rg)
    {
        $dependentes = $this->ativaPM($rg);
        
        if(is_null($dependentes))
        {
            $dependentes = $this->inativoPM($rg);
        }
        
        return $dependentes;
    }

}

