<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\apresentacao;

use Cache;
use App\Models\Sjd\Apresentacao\Apresentacao;
use App\Repositories\BaseRepository;

class ApresentacaoRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia; 

	public function __construct(Apresentacao $model)
	{
        $this->model = $model;
        
        $this->verTodasUnidades = session('ver_todas_unidades');
        $this->unidade = session('cdopmbase');
    }

    public function cleanCache()
	{
        Cache::tags('apresentacao')->flush();
    }
    
    public function all()
	{
        $registros = Cache::tags('apresentacao')->remember('todos_apresentacao', self::$expiration, function() {
            return $this->model->all();
        });


        return $registros;
    } 

    public function ano($ano)
	{

        $registros = Cache::tags('apresentacao')->remember('todos_apresentacao:'.$ano, self::$expiration, function() use ($ano) {
            return $this->model->where('sjd_ref_ano','=',$ano)->get();
        });

        return $registros;
    } 

    //@override
    public function apagadosAno($ano)
	{

        $registros = Cache::tags('apresentacao')->remember('todos_apresentacao:apagadas'.$ano, self::$expiration, function() use ($ano) {
            return $this->model->where('sjd_ref_ano',$ano)->onlyTrashed()->get();
        });

        return $registros;
    } 

}

