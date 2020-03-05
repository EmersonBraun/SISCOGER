<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use Illuminate\Support\Facades\DB;

use Cache;
use App\Models\Sjd\Proc\Fatd;
use App\Repositories\BaseRepository;
use App\Services\AutorizationService;

class FatdRepository extends BaseRepository
{
    protected $model;
    protected $service;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia  

	public function __construct(
        Fatd $model,
        AutorizationService $service
    )
	{
		$this->model = $model;
        $this->service = $service;

        $isapi = $this->service->isApi();
        $verTodasUnidades = $this->service->verTodasOPM();

        $this->verTodasUnidades = ($verTodasUnidades || $isapi) ? 1 : 0;
        $this->unidade = ($isapi) ? '0' : session('cdopmbase');
    }

    public function cleanCache()
	{
        Cache::tags('fatd')->flush();
    }

    public function procRefAno($ref, $ano = '', $name)
    {
        if(!$ano) $proc = $this->model->findOrFail($ref);
        else $proc = $this->model->where([['sjd_ref',$ref],['sjd_ref_ano',$ano]])->first();

        if(!$proc) abort(404);
        $canSee = $this->service->canSee($proc, $name);
        if(!$canSee) abort(403);
        return $proc;
    }

    public function all()
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('fatd')->remember('todos_fatd', $this->expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::tags('fatd')->remember('todos_fatd:'.$this->unidade, $this->expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')->get();
            });
        }

        return $registros;
    } 

    public function ano($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('fatd')->remember('todos_fatd:'.$ano, $this->expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::tags('fatd')->remember('todos_fatd:'.$ano.':'.$this->unidade, $this->expiration, function() use ($ano) {
                return $this->model->where('cdopm','like',$this->unidade.'%')->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        return $registros;
    } 

    public function andamento()
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('fatd')->remember('andamento_fatd', $this->expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('fatd')->remember('andamento_fatd:'.$this->unidade, $this->expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        return $registros;
    }

    public function andamentoAno($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('fatd')->remember('andamento_fatd:'.$ano, $this->expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('fatd')->remember('andamento_fatd:'.$ano.':'.$this->unidade, $this->expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        return $registros;
    }

    public function julgamento()
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('fatd')->remember('julgamento_fatd', $this->expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                                ->where('envolvido.id_fatd', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','fatd'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('fatd')->remember('julgamento_fatd:'.$this->unidade, $this->expiration, function()  {
                return $this->model->where('fatd.cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                                ->where('envolvido.id_fatd', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','fatd'))
                    ->get();
            });
        }
        return $registros;
    }

    public function julgamentoAno($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('fatd')->remember('julgamento_fatd:'.$ano, $this->expiration, function() use ($ano){
                return $this->model->where('fatd.sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                                ->where('envolvido.id_fatd', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','fatd'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('fatd')->remember('julgamento_fatd:'.$ano.':'.$this->unidade, $this->expiration, function() use ($ano) {
                return $this->model->where('fatd.sjd_ref_ano', '=' ,$ano)
                    ->where('fatd.cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                                ->where('envolvido.id_fatd', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','fatd'))
                    ->get();
            });
        }
        return $registros;
    }

    public function prazos()
    {
        if($this->verTodasUnidades)
        {

            $registros = Cache::tags('fatd')->remember('prazo_fatd', $this->expiration, function() {
                return $this->model
                    ->selectRaw('DISTINCT fatd.*,
                    (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM    sobrestamento WHERE sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros,
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW()))+1 AS dutotal, 
                    b.dusobrestado, 
                    (DIASUTEIS(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_fatd, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_fatd!= '' GROUP BY id_fatd) b"),
                        'b.id_fatd', '=', 'fatd.id_fatd')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->get();
            });
                    
        }
        else 
        {
            $registros = Cache::tags('fatd')->remember('prazo_fatd:'.$this->unidade, $this->expiration, function() {
                return $this->model
                    ->selectRaw('DISTINCT fatd.*,
                    (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM    sobrestamento WHERE sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros,
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW()))+1 AS dutotal, 
                    b.dusobrestado, 
                    (DIASUTEIS(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_fatd, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_fatd!= '' GROUP BY id_fatd) b"),
                        'b.id_fatd', '=', 'fatd.id_fatd')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('fatd.cdopm','like',$this->unidade.'%')
                    ->get();

            });   
        }
        return $registros;
    }

    public function prazosAno($ano)
    {
        if($this->verTodasUnidades)
        {

            $registros = Cache::tags('fatd')->remember('prazo_fatd:'.$ano, $this->expiration, function() use ($ano) {
                return $this->model
                    ->selectRaw('DISTINCT fatd.*,
                    (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM    sobrestamento WHERE sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros,
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW()))+1 AS dutotal, 
                    b.dusobrestado, 
                    (DIASUTEIS(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_fatd, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_fatd!= '' GROUP BY id_fatd) b"),
                        'b.id_fatd', '=', 'fatd.id_fatd')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('fatd.sjd_ref_ano','=',$ano)
                    ->get();

                
                });
                    
        }
        else 
        {
            $registros = Cache::tags('fatd')->remember('prazo_fatd:'.$ano.':'.$this->unidade, $this->expiration, function() use ($ano){
                return $this->model
                    ->selectRaw('DISTINCT fatd.*,
                    (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM    sobrestamento WHERE sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros,
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW()))+1 AS dutotal, 
                    b.dusobrestado, 
                    (DIASUTEIS(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_fatd, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_fatd!= '' GROUP BY id_fatd) b"),
                        'b.id_fatd', '=', 'fatd.id_fatd')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('fatd.sjd_ref_ano','=',$ano)
                    ->where('fatd.cdopm','like',$this->unidade.'%')
                    ->get();

            });   
        }
        return $registros;
    }

    public function foraDoPrazo($unidade)
    {
        if($this->verTodasUnidades)
        {

            $registros = Cache::tags('fatd')->remember('fora_prazo_fatd:todos', 60, function(){
                return DB::connection('sjd')->select('SELECT * FROM
                (SELECT fatd.id_fatd, envolvido.cargo, envolvido.nome, cdopm, 
                    sjd_ref, sjd_ref_ano, abertura_data, 
                    DIASUTEIS(abertura_data,DATE(NOW()))+1 AS dutotal,
                    b.dusobrestado,
                    (DIASUTEIS(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis 
                    FROM fatd
                    LEFT JOIN
                    (SELECT id_fatd, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado 
                    FROM sobrestamento
                        WHERE termino_data != :termino_data AND id_fatd != :id_fatd
                        GROUP BY id_fatd) b
                        ON b.id_fatd = fatd.id_fatd
                    LEFT JOIN envolvido ON
                        envolvido.id_fatd = fatd.id_fatd 
                        AND envolvido.situacao = :situacao 
                        AND rg_substituto = :rg_substituto
                    WHERE fatd.id_andamento = :id_andamento) 
                    AS dt WHERE dt.diasuteis > :diasuteis', 
                    [
                        'termino_data' => '0000-00-00',
                        'id_fatd' => '',
                        'situacao' => 'Encarregado',
                        'rg_substituto' => '',
                        'id_andamento' => '1',
                        'diasuteis' => '30'
                    ]);
            });
                    
        }
        else 
        {
            $registros = Cache::tags('fatd')->remember('fora_prazo_fatd:'.$this->unidade, 60, function() {
                return DB::connection('sjd')->select('SELECT * FROM
                (SELECT fatd.id_fatd, envolvido.cargo, envolvido.nome, fatd.cdopm, 
                    sjd_ref, sjd_ref_ano, abertura_data, 
                    DIASUTEIS(abertura_data,DATE(NOW()))+1 AS dutotal,
                    b.dusobrestado,
                    (DIASUTEIS(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis 
                    FROM fatd
                    LEFT JOIN
                    (SELECT id_fatd, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado 
                    FROM sobrestamento
                        WHERE termino_data != :termino_data AND id_fatd != :id_fatd
                        GROUP BY id_fatd) b
                        ON b.id_fatd = fatd.id_fatd
                    LEFT JOIN envolvido ON
                        envolvido.id_fatd = fatd.id_fatd 
                        AND envolvido.situacao = :situacao 
                        AND rg_substituto = :rg_substituto
                    WHERE fatd.id_andamento = :id_andamento 
                    AND fatd.cdopm LIKE :opm) 
                    AS dt WHERE dt.diasuteis > :diasuteis', 
                    [
                        'termino_data' => '0000-00-00',
                        'id_fatd' => '',
                        'situacao' => 'Encarregado',
                        'rg_substituto' => '',
                        'id_andamento' => '1',
                        'opm' => $this->unidade.'%',
                        'diasuteis' => '30'
                    ]);
            });   
        }
        return $registros;
    }

    public function foraDoPrazoUnidade($unidade='')
    {
        $unidade = !$unidade ? $this->unidade : $unidade;
        $registros = Cache::tags('fatd')->remember('fora_prazo_fatd:'.$unidade, 60, function() use ($unidade){
            return DB::connection('sjd')->select('SELECT * FROM
            (SELECT fatd.id_fatd, envolvido.cargo, envolvido.nome, cdopm, 
                sjd_ref, sjd_ref_ano, abertura_data, 
                DIASUTEIS(abertura_data,DATE(NOW()))+1 AS dutotal,
                b.dusobrestado,
                (DIASUTEIS(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis 
                FROM fatd
                LEFT JOIN
                (SELECT id_fatd, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado 
                FROM sobrestamento
                    WHERE termino_data != :termino_data AND id_fatd != :id_fatd
                    GROUP BY id_fatd) b
                    ON b.id_fatd = fatd.id_fatd
                LEFT JOIN envolvido ON
                    envolvido.id_fatd = fatd.id_fatd 
                    AND envolvido.situacao = :situacao 
                    AND rg_substituto = :rg_substituto
                WHERE fatd.id_andamento = :id_andamento 
                AND fatd.cdopm LIKE :opm) 
                AS dt WHERE dt.diasuteis > :diasuteis', 
                [
                    'termino_data' => '0000-00-00',
                    'id_fatd' => '',
                    'situacao' => 'Encarregado',
                    'rg_substituto' => '',
                    'id_andamento' => '1',
                    'opm' => $unidade.'%',
                    'diasuteis' => '30'
                ]);
        });   

        return $registros;
    }

    public function punidos($unidade='')
    {
        $unidade = !$unidade ? $this->unidade : $unidade;
        $registros = Cache::tags('fatd')->remember('punidos_fatd:'.$unidade, 60, function() use ($unidade){
            return DB::connection('sjd')
            ->table('view_fatd_punicao')
            ->where('cdopm', 'LIKE', $unidade.'%') 
            ->where('id_punicao','=','0')
            ->get();
        });  
        
        return $registros;
    }

 
    public function aberturas($unidade){  
        $unidade = !$unidade ? $this->unidade : $unidade;  
        $registros = Cache::tags('fatd')->remember('aberturas_fatd:'.$unidade, 60, function() use ($unidade){
            return $this->model
            ->where('cdopm', 'LIKE', $unidade.'%') 
            ->where('abertura_data','=','0000-00-00')
            ->get(); 
        });
        return $registros;
    }


    public function QtdOMAnos($unidade='', $ano='')
    {
        $unidade = !$unidade ? $this->unidade : $unidade;
        //inicializar a variável
        $registros = [];
        if($ano != '')
        {
            $registros = $this->model
            ->select(DB::raw('count(sjd_ref) AS qtd'))
            ->where('sjd_ref_ano','=',$ano)
            ->where('cdopm','like',$unidade.'%')
            ->groupBy('sjd_ref_ano')
            ->first();
        }
        else
        {
            for($i = 2008; $i <= date('Y'); $i++)
            {
                //Quantidade de por ano
                $qtd_ano = $this->model
                ->select(DB::raw('count(sjd_ref) AS qtd'))
                ->where('sjd_ref_ano','=',$i)
                ->where('cdopm','like',$unidade.'%')
                ->groupBy('sjd_ref_ano')
                ->first();
                //insere no array para ficar 'ano' => 'qtd'
                $registros = array_add($registros,$i, $qtd_ano['qtd'] ?? 1);
            }
        }
        
        return $registros;
    }
}

