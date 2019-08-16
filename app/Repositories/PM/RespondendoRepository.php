<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;
use App\Models\Sjd\Policiais\Envolvido;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;

class RespondendoRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Envolvido $model)
	{
        $this->model = $model;      
    }

    public function cleanCache()
	{
        Cache::tags('respondendo')->flush();
    }

    public function busca($proc, $query, $cargos, $array=false)
	{
        $q = $this->model
        ->select(DB::raw("envolvido.*, '".$proc."' as procedimento, ".$proc.".sjd_ref, ".$proc.".sjd_ref_ano, ".$proc.".id_andamento, ".$proc.".cdopm"))
        ->join($proc, $proc.'.id_'.$proc, '=', 'envolvido.id_'.$proc)
        ->where($query)
        ->whereIn('envolvido.cargo', $cargos)
        ->orderBy('id_envolvido', 'desc');
        if($array) return $q->toArray();
        return $q->get();
    } 

}
