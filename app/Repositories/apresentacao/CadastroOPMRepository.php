<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\apresentacao;

use Cache;
use App\Models\Sjd\Apresentacao\CadastroOPM;
use App\Models\Sjd\Apresentacao\CadastroOPMAutoridade;
use App\Repositories\BaseRepository;

class CadastroOPMRepository extends BaseRepository
{
    protected $opm;
    protected static $expiration = 60 * 24;//um dia; 

	public function __construct(
        CadastroOPM $opm,
        CadastroOPMAutoridade $autoridade
    )
	{
        $this->opm = $opm;
        $this->autoridade = $autoridade;
    }

    public function cleanCache()
	{
        Cache::tags('cadastroopm')->flush();
    }
    
    public function all()
	{
        $registros = Cache::tags('cadastroopm')->remember('todos_cadastroopm', self::$expiration, function() {
            return $this->opm->orderBy('id_cadastroopmcoger','DESC')->get();
        });

        return $registros;
    } 

    public function get($cdopm)
	{
        $registros = Cache::tags('cadastroopm')->remember('cadastroopm:'.$cdopm, self::$expiration, function() use ($cdopm){
            return $this->opm->where('cdopm',$cdopm)->first();
        });

        return $registros;
    }

    public function opm_intermediaria($cdopm)
    {
        $opm = $this->get($cdopm);
        $intermediaria = $opm ? $opm->opm_intermediaria_nome_por_extenso : false;
        $opm_comp = $opm ? $opm->opm_nome_por_extenso : false;

        return $intermediaria && $intermediaria !== $opm_comp ? $intermediaria : false;
    }

    public function findOrFail($id)
    {
        return $this->opm->findOrFail($id);
    }

}

