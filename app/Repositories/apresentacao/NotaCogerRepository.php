<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\apresentacao;

use Cache;
use App\Models\Sjd\Apresentacao\NotaCoger;
use App\Repositories\BaseRepository;

class NotaCogerRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia; 

	public function __construct(NotaCoger $model)
	{
        $this->model = $model;
        
        $this->verTodasUnidades = session('ver_todas_unidades');
        $this->unidade = session('cdopmbase');
    }

    public function cleanCache()
	{
        Cache::tags('nota_comparecimento')->flush();
    }
    
    public function all()
	{
        $this->cleanCache(); 
        $registros = Cache::tags('nota_comparecimento')->remember('todos_nota_comparecimento', self::$expiration, function() {
            return $this->model
            ->orderBy('id_notacomparecimento', 'DESC')
            ->get();
        });


        return $registros;
    } 

    public function ano($ano)
	{
        $this->cleanCache(); 
        $registros = Cache::tags('nota_comparecimento')->remember('todos_nota_comparecimento:'.$ano, self::$expiration, function() use ($ano) {
            return $this->model->where('sjd_ref_ano','=',$ano)
            ->orderBy('id_notacomparecimento', 'DESC')
            ->get();
        });

        return $registros;
    } 

    //@override
    public function apagadosAno($ano)
	{

        $registros = Cache::tags('nota_comparecimento')->remember('todos_nota_comparecimento:apagadas'.$ano, self::$expiration, function() use ($ano) {
            return $this->model->where('sjd_ref_ano',$ano)->onlyTrashed()
            ->orderBy('id_notacomparecimento', 'DESC')
            ->get();
        });

        return $registros;
    } 

}

