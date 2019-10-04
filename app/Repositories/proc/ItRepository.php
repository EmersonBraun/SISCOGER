<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use Illuminate\Support\Facades\DB;

use Cache;
use App\Models\Sjd\Proc\It;
use App\Repositories\BaseRepository;
use App\Services\AutorizationService;

class ItRepository extends BaseRepository
{
    protected $model;
    protected $service;
    protected $unidade;
    protected $verTodasUnidades;
    protected static $expiration = 60 * 24;//um dia 

	public function __construct(
        It $model,
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
        Cache::tags('it')->flush();
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
            $registros = Cache::tags('it')->remember('todos_it', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::tags('it')->remember('todos_it:'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')->get();
            });
        }

        return $registros;
    } 

    public function ano($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('it')->remember('todos_it:'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::tags('it')->remember('todos_it:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('cdopm','like',$this->unidade.'%')->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        return $registros;
    } 

    public function relValores()
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('it')->remember('viaturas_it', self::$expiration, function() {
                return $this->model->where('objetoprocedimento','=','viatura')->get();
            });
        }
        else 
        {
            $registros = Cache::tags('it')->remember('viaturas_it:'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('objetoprocedimento','=','viatura')
                ->where('cdopm','like',$this->unidade.'%')->get();
            });
        }

        return $registros;
    } 

    public function relValoresAno($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('it')->remember('viaturas_it:'.$ano, self::$expiration, function() use ($ano){
                return $this->model->where('objetoprocedimento','=','viatura')->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::tags('it')->remember('viaturas_it:'.$this->unidade.':'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('objetoprocedimento','=','viatura')
                ->where('cdopm','like',$this->unidade.'%')->where('sjd_ref_ano','=',$ano)->get();
            });
        }

        return $registros;
    } 

    public function andamento()
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('it')->remember('andamento_it', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_it', '=', 'it.id_it')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('it')->remember('andamento_it:'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_it', '=', 'it.id_it')
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
            $registros = Cache::tags('it')->remember('andamento_it:'.$ano, self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_it', '=', 'it.id_it')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::tags('it')->remember('andamento_it:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_it', '=', 'it.id_it')
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
            $registros = Cache::tags('it')->remember('julgamento_it', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_it', '=', 'it.id_it')
                                ->where('envolvido.id_it', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','it'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('it')->remember('julgamento_it:'.$this->unidade, self::$expiration, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_it', '=', 'it.id_it')
                                ->where('envolvido.id_it', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','it'))
                    ->get();
            });
        }
        return $registros;
    }

    public function julgamentoAno($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('it')->remember('julgamento_it:'.$ano, self::$expiration, function() use ($ano){
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_it', '=', 'it.id_it')
                                ->where('envolvido.id_it', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','it'))
                    ->where('it.sjd_ref_ano', '=' ,$ano)
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('it')->remember('julgamento_it:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano) {
                return $this->model
                    ->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_it', '=', 'it.id_it')
                                ->where('envolvido.id_it', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','it'))
                    ->where('it.sjd_ref_ano', '=' ,$ano)
                    ->get();
            });
        }
        return $registros;
    }

    public function prazos()
    {
        if($this->verTodasUnidades)
        {

            $registros = Cache::tags('it')->remember('prazo_it', self::$expiration, function() {
                return $this->model
                    ->selectRaw('DISTINCT it.*, 
                    (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_it=it.id_it ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM    sobrestamento WHERE   sobrestamento.id_it=it.id_it ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_it, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_it!= '' GROUP BY id_it) b"),
                        'b.id_it', '=', 'it.id_it')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_it', '=', 'it.id_it')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->get();
                });   
        }
        else 
        {
            $registros = Cache::tags('it')->remember('prazo_it:'.$this->unidade, self::$expiration, function() {
                return $this->model
                    ->selectRaw('DISTINCT it.*, 
                    (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_it=it.id_it ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM    sobrestamento WHERE   sobrestamento.id_it=it.id_it ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_it, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_it!= '' GROUP BY id_it) b"),
                        'b.id_it', '=', 'it.id_it')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_it', '=', 'it.id_it')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('it.cdopm','like',$this->unidade.'%')
                    ->get();
            });   
        }
        return $registros;
    }

    public function prazosAno($ano)
    {
        if($this->verTodasUnidades)
        {

            $registros = Cache::tags('it')->remember('prazo_it:'.$ano, self::$expiration, function() use ($ano) {
                return $this->model
                    ->selectRaw('DISTINCT it.*, 
                    (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_it=it.id_it ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM    sobrestamento WHERE   sobrestamento.id_it=it.id_it ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_it, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_it!= '' GROUP BY id_it) b"),
                        'b.id_it', '=', 'it.id_it')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_it', '=', 'it.id_it')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('it.sjd_ref_ano','=',$ano)
                    ->get(); 
                });
                    
        }
        else 
        {
            $registros = Cache::tags('it')->remember('prazo_it:'.$ano.':'.$this->unidade, self::$expiration, function() use ($ano){
                return $this->model
                    ->selectRaw('DISTINCT it.*, 
                    (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_it=it.id_it ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM    sobrestamento WHERE   sobrestamento.id_it=it.id_it ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_it, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_it!= '' GROUP BY id_it) b"),
                        'b.id_it', '=', 'it.id_it')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_it', '=', 'it.id_it')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('it.cdopm','like',$this->unidade.'%')
                    ->where('it.sjd_ref_ano','=',$ano)
                    ->get();

            });   
        }
        return $registros;
    }
}

