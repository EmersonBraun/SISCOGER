<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use Illuminate\Support\Facades\DB;

use Cache;
use App\Models\Sjd\Proc\Cd;
use App\Repositories\BaseRepository;
use App\Services\AutorizationService;

class CdRepository extends BaseRepository
{
    protected $model;
    protected $service;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia  

	public function __construct(
        Cd $model,
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
        Cache::tags('cd')->flush();
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
            $registros = Cache::tags('cd')->remember('todos_cd', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::tags('cd')->remember('todos_cd:'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')->get();
            });
        }

        return $registros;
    } 

    public function ano($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('cd')->remember('todos_cd:'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::tags('cd')->remember('todos_cd:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('cdopm','like',$this->unidade.'%')->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        return $registros;
    } 

    public function andamento()
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('cd')->remember('andamento_cd', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_cd', '=', 'cd.id_cd')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('cd')->remember('andamento_cd:'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_cd', '=', 'cd.id_cd')
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
            $registros = Cache::tags('cd')->remember('andamento_cd:'.$ano, self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_cd', '=', 'cd.id_cd')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('cd')->remember('andamento_cd:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_cd', '=', 'cd.id_cd')
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
            $registros = Cache::tags('cd')->remember('julgamento_cd', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_cd', '=', 'cd.id_cd')
                                ->where('envolvido.id_cd', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','cd'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('cd')->remember('julgamento_cd:'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cd.cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_cd', '=', 'cd.id_cd')
                                ->where('envolvido.id_cd', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','cd'))
                    ->get();
            });
        }
        return $registros;
    }

    public function julgamentoAno($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('cd')->remember('julgamento_cd:'.$ano, self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_cd', '=', 'cd.id_cd')
                                ->where('envolvido.id_cd', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','cd'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('cd')->remember('julgamento_cd:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_cd', '=', 'cd.id_cd')
                                ->where('envolvido.id_cd', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','cd'))
                    ->get();
            });
        }
        return $registros;
    }

    public function prazos()
    {
        if($this->verTodasUnidades)
        {

            $registros = Cache::tags('cd')->remember('prazo_cd', self::$expiration, function() {
                return $this->model
                    ->selectRaw('cd.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_cd=cd.id_cd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_cd=cd.id_cd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_cd, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_cd != '' GROUP BY id_cd ORDER BY sobrestamento.id_cd ASC LIMIT 1) b"),
                        'b.id_cd', '=', 'cd.id_cd')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_cd', '=', 'cd.id_cd')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->get(); 
            });
                    
        }
        else 
        {
            $registros = Cache::tags('cd')->remember('prazo_cd:'.$this->unidade, self::$expiration, function() {
                return $this->model
                    ->selectRaw('cd.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_cd=cd.id_cd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_cd=cd.id_cd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_cd, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_cd != '' GROUP BY id_cd ORDER BY sobrestamento.id_cd ASC LIMIT 1) b"),
                        'b.id_cd', '=', 'cd.id_cd')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_cd', '=', 'cd.id_cd')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('cd.cdopm','like',$this->unidade.'%')
                    ->get();
    
                });   
        }
        return $registros;
    }

    public function prazosAno($ano)
    {
        if($this->verTodasUnidades)
        {

            $registros = Cache::tags('cd')->remember('prazo_cd:'.$ano, self::$expiration, function() use ($ano) {
                return $this->model
                    ->selectRaw('cd.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_cd=cd.id_cd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_cd=cd.id_cd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_cd, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_cd != '' GROUP BY id_cd ORDER BY sobrestamento.id_cd ASC LIMIT 1) b"),
                        'b.id_cd', '=', 'cd.id_cd')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_cd', '=', 'cd.id_cd')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('cd.sjd_ref_ano','=',$ano)
                    ->get();
                });
                    
        }
        else 
        {
            $registros = Cache::tags('cd')->remember('prazo_cd:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano){
                return $this->model
                    ->selectRaw('cd.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_cd=cd.id_cd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_cd=cd.id_cd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_cd, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_cd != '' GROUP BY id_cd ORDER BY sobrestamento.id_cd ASC LIMIT 1) b"),
                        'b.id_cd', '=', 'cd.id_cd')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_cd', '=', 'cd.id_cd')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('cd.sjd_ref_ano','=',$ano)
                    ->where('cd.cdopm','like',$this->unidade.'%')
                    ->get();

            });   
        }
        return $registros;
    }

    public function aberturas($unidade='')
    {
        $unidade = !$unidade ? $this->unidade : $unidade;
        $cd_aberturas = Cache::remember('cd_aberturas'.$unidade, 60, function() use ($unidade){
            return DB::table('cd')
                ->where('cdopm', 'LIKE', $unidade.'%') 
                ->where('abertura_data','=','0000-00-00')
                ->get();
        });
        return $cd_aberturas;
    }
    
    public function foraDoPrazo($unidade)
    {
        $unidade = !$unidade ? $this->unidade : $unidade;
        $cd_prazos = Cache::remember('cd_prazos'.$unidade, 60, function() use ($unidade){
            return DB::connection('sjd')
            ->select('SELECT * FROM (
            SELECT cd.id_cd, andamento, andamentocoger, envolvido.cargo, envolvido.nome, 
            cdopm, sjd_ref, sjd_ref_ano, abertura_data, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal,
            b.dusobrestado,
            (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis FROM cd
            LEFT JOIN
            (SELECT id_cd, SUM(DIASUTEIS(inicio_data, termino_data)+1) AS dusobrestado fROM sobrestamento
            WHERE termino_data !=:termino_data AND id_cd!=:id_cd
            GROUP BY id_cd) b
            ON b.id_cd = cd.id_cd
            LEFT JOIN envolvido ON
                envolvido.id_cd=cd.id_cd AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto
            LEFT JOIN andamento ON
                andamento.id_andamento=cd.id_andamento
            LEFT JOIN andamentocoger ON
                andamentocoger.id_andamentocoger=cd.id_andamentocoger 
                WHERE cd.id_andamento=:id_andamento) dt
            WHERE dt.cdopm LIKE :opm AND dt.diasuteis>:diasuteis',
            [
                'termino_data' => '0000-00-00',
                'id_cd' => '',
                'situacao' => 'Presidente',
                'rg_substituto' => '',
                'id_andamento' => '9',
                'opm' => $unidade.'%',
                'diasuteis' => '60'
            ]);
        });
        return $cd_prazos;
    }
    public function QtdOMAnos($unidade='', $ano='')
    {
        $unidade = !$unidade ? $this->unidade : $unidade;
        //inicializar a variável
        $cd_ano = [];
        if($ano != '')
        {
            $cd_ano = DB::connection('sjd')
            ->table('cd')
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
                //Quantidade de cd por ano
                $qtd_cd_ano = DB::connection('sjd')
                ->table('cd')
                ->select(DB::raw('count(sjd_ref) AS qtd'))
                ->where('sjd_ref_ano','=',$i)
                ->where('cdopm','like',$unidade.'%')
                ->groupBy('sjd_ref_ano')
                ->first();
                //insere no array para ficar 'ano' => 'qtd'
                $cd_ano = array_add($cd_ano,$i, $qtd_cd_ano['qtd'] ?? 0);
            }
        }
        
        return $cd_ano;
    }

}

