<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;
use App\Models\Sjd\Policiais\Ofendido;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class OfendidoRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Ofendido $model)
	{
        $this->model = $model;      
    }

    public function cleanCache()
	{
        Cache::tags('ofendido')->flush();
    }
    
    public function all()
	{

        $registros = Cache::tags('ofendido')->remember('todos_ofendido', $this->expiration, function() {
            return $this->model->all();
        });

        return $registros;
    } 

    public function listProc($proc, $id)
	{
        $registros = Cache::tags('ofendido')->remember('ofendido:proc', $this->expiration, function() use($proc, $id) {
            return $this->model->where('id_'.$proc,$id)->get();
        });

        return $registros;
    }

    public function ofendidoProc($id_proc, $id)
	{
        $registros = Cache::tags('ofendido')->remember('ofendido:proc', $this->expiration, function() use($id_proc, $id) {
            return $this->model->where('situacao','Ofendido')->where($id_proc,$id)->get();
        });

        return $registros;
    }
    
    public function list($query, $proc)
	{
        $registros = $this->model
            ->join($proc,$proc.'.id_'.$proc,'ofendido.id_'.$proc)
            ->where($query)
            ->orderBy('id_ofendido','DESC')
            ->get();

        return $registros;
    }

    public function relatorio($query, $proc)
	{
        $registros = [
            'resultado' => $this->countType('situacao',$query, $proc),
            'sexo' => $this->countType('sexo',$query, $proc),
            'escolaridade' => $this->countType('escolaridade',$query, $proc)
        ];

        return $registros;
    }

    public function countType($type, $query, $proc)
    {
        $notnull = ['ofendido.id_'.$proc,'<>','0'];
        array_push($query,$notnull);
        $registros = $this->model
            ->select(DB::raw('COUNT(situacao) AS quantidade, '.$type.' as grupo'))
            ->join($proc,$proc.'.id_'.$proc,'ofendido.id_'.$proc)
            ->where($query)
            ->groupBy('resultado')
            ->orderBy('grupo','DESC')
            ->get();

        return $registros;
        /*
        SELECT COUNT(situacao) AS quantidade, resultado as grupo FROM ofendido
			INNER JOIN ipm ON ipm.id_ipm=ofendido.id_ipm
        WHERE  sjd_ref_ano  >= '2019'  AND  sjd_ref_ano  <= '2019'  AND  ofendido.id_ipm!='0'   
        GROUP BY resultado  
        ORDER BY grupo ASC
        */
    }

}
