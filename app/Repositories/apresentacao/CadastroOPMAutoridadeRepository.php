<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\apresentacao;

use App\Models\Sjd\Apresentacao\CadastroOPM;
use Cache;
use App\Models\Sjd\Apresentacao\CadastroOPMAutoridade;
use App\Repositories\BaseRepository;
use App\Repositories\PM\PolicialRepository;

class CadastroOPMAutoridadeRepository extends BaseRepository
{
    protected $autoridade;
    protected static $expiration = 60 * 24;//um dia; 

	public function __construct(
        CadastroOPMAutoridade $autoridade,
        PolicialRepository $pm
    )
	{
        $this->autoridade = $autoridade;
        $this->pm = $pm;
    }

    public function cleanCache()
	{
        Cache::tags('cadastroopmautoridade')->flush();
    }
    
    public function all()
	{
        $registros = Cache::tags('cadastroopmautoridade')->remember('todos_cadastroopmautoridade', self::$expiration, function() {
            return $this->autoridade->orderBy('id_cadastroopmcogerautoridade','DESC')->get();
        });


        return $registros;
    } 

    public function get($id)
	{
        $registros = Cache::tags('cadastroopmautoridade')->remember('cadastroopmautoridade:'.$id, self::$expiration, function() use ($id){
            return $this->autoridade->where('id_cadastroopmcoger',$id)->get();
        });

        foreach ($registros as $registro) {
            $pm = $this->pm->get($registro['rg']);
            $registro['nome'] = "$pm->cargo_ico $pm->quadro_ico $pm->nome_ico";
        }
        return $registros;
    }

    public function findOrFail($id)
    {
        return $this->autoridade->findOrFail($id);
    }

}

