<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\proc;

use Cache;
use Illuminate\Support\Facades\DB;
use App\Models\Sjd\Proc\Ipm;
use App\Repositories\BaseRepository;
use App\Services\AutorizationService;

class IpmRepository extends BaseRepository
{
    protected $model;
    protected $service;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia 

	public function __construct(
        Ipm $model,
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
        Cache::tags('ipm')->flush();
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
            $registros = Cache::tags('ipm')->remember('todos_ipm', 60, function() {
                return $this->model->orderBy('ipm.id_ipm','DESC')->get();
            });
        }
        else 
        {
            $registros = Cache::tags('ipm')->remember('todos_ipm:'.$this->unidade, 60, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')->orderBy('ipm.id_ipm','DESC')->get();
            });
        }

        return $registros;
    } 

    public function ano($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('ipm')->remember('todos_ipm:'.$ano, 60, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->orderBy('ipm.id_ipm','DESC')->get();
            });
        }
        else 
        {
            $registros = Cache::tags('ipm')->remember('todos_ipm:'.$ano.':'.$this->unidade, 60, function() use ($ano) {
                return $this->model->where('cdopm','like',$this->unidade.'%')->where('sjd_ref_ano','=',$ano)->orderBy('ipm.id_ipm','DESC')->get();
            });
        }
        return $registros;
    } 

    public function andamento()
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('ipm')->remember('andamento_ipm', 60, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })
                    ->orderBy('ipm.id_ipm','DESC')
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('ipm')->remember('andamento_ipm:'.$this->unidade, 60, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })
                    ->orderBy('ipm.id_ipm','DESC')
                    ->get();
            });
        }
        return $registros;
    }

    public function andamentoAno($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('ipm')->remember('andamento_ipm:'.$ano, 60, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })
                    ->orderBy('ipm.id_ipm','DESC')
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('ipm')->remember('andamento_ipm:'.$ano.':'.$this->unidade, 60, function() use ($ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })
                    ->orderBy('ipm.id_ipm','DESC')
                    ->get();
            });
        }
        return $registros;
    }

    public function julgamento()
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('ipm')->remember('julgamento_ipm', 60, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
                                ->where('envolvido.id_ipm', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','ipm'))
                    ->orderBy('ipm.id_ipm','DESC')
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('ipm')->remember('julgamento_ipm:'.$this->unidade, 60, function()  {
                return $this->model->where('cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
                                ->where('envolvido.id_ipm', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','ipm'))
                    ->orderBy('ipm.id_ipm','DESC')
                    ->get();
            });
        }
        return $registros;
    }

    public function julgamentoAno($ano)
	{
        if($this->verTodasUnidades)
        {
            $registros = Cache::tags('ipm')->remember('julgamento_ipm:'.$ano, 60, function() use ($ano){
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
                                ->where('envolvido.id_ipm', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','ipm'))
                    ->where('ipm.sjd_ref_ano', '=' ,$ano)
                    ->orderBy('ipm.id_ipm','DESC')
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::tags('ipm')->remember('julgamento_ipm:'.$ano.':'.$this->unidade, 60, function() use ($ano) {
                return $this->model
                    ->where('ipm.cdopm','like',$this->unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
                                ->where('envolvido.id_ipm', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','ipm'))
                    ->where('ipm.sjd_ref_ano', '=' ,$ano)
                    ->orderBy('ipm.id_ipm','DESC')
                    ->get();
            });
        }
        return $registros;
    }

    public function prazos()
    {
        if($this->verTodasUnidades)
        {

            $registros = Cache::tags('ipm')->remember('prazo_ipm', 60, function() {
                return $this->model
                    ->selectRaw('ipm.*, envolvido.cargo, envolvido.nome, 
                    (DATEDIFF(DATE(NOW()),autuacao_data)+1) AS diasuteis')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->orderBy('ipm.id_ipm','DESC')
                    ->get();

            });
                    
        }
        else 
        {
            $registros = Cache::tags('ipm')->remember('prazo_ipm:'.$this->unidade, 60, function() {
                return $this->model
                    ->selectRaw('ipm.*, envolvido.cargo, envolvido.nome, 
                    (DATEDIFF(DATE(NOW()),autuacao_data)+1) AS diasuteis')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('ipm.cdopm','like',$this->unidade.'%')
                    ->orderBy('ipm.id_ipm','DESC')
                    ->get();

            });   
        }
        return $registros;
    }

    public function prazosAno($ano)
    {
        if($this->verTodasUnidades)
        {

            $registros = Cache::tags('ipm')->remember('prazo_ipm:'.$ano, 60, function() use ($ano) {
                return $this->model
                    ->selectRaw('ipm.*, envolvido.cargo, envolvido.nome, 
                    (DATEDIFF(DATE(NOW()),autuacao_data)+1) AS diasuteis')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('ipm.sjd_ref_ano','=',$ano)
                    ->orderBy('ipm.id_ipm','DESC')
                    ->get();
                });
                    
        }
        else 
        {
            $registros = Cache::tags('ipm')->remember('prazo_ipm:'.$ano.':'.$this->unidade, 60, function() use ($ano){
                return $this->model
                    ->selectRaw('ipm.*, envolvido.cargo, envolvido.nome, 
                    (DATEDIFF(DATE(NOW()),autuacao_data)+1) AS diasuteis')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_ipm', '=', 'ipm.id_ipm')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('ipm.sjd_ref_ano','=',$ano)
                    ->where('ipm.cdopm','like',$this->unidade.'%')
                    ->orderBy('ipm.id_ipm','DESC')
                    ->get();

            });   
        }
        return $registros;
    }

    public function foraDoPrazo($unidade='')
     {
        $unidade = !$unidade ? $this->unidade : $unidade;
         $ipm_prazos = Cache::remember('ipm_prazos'.$unidade, 60, function() use ($unidade){
 
         return DB::table('view_ipm_prazo')
             ->where('cdopm', 'LIKE', $unidade.'%') 
             ->where('diasuteis','>','60')
             ->get();
             
         });
 
         return $ipm_prazos;
     }
 
     public function instauracao($unidade)
     {
        $unidade = !$unidade ? $this->unidade : $unidade;
        $ipm_instauracao = Cache::remember('ipm_instauracao'.$unidade, 60, function()  use ($unidade){
 
         return DB::table('ipm')
             ->where('cdopm', 'LIKE', $unidade.'%') 
             ->where('autuacao_data','=','0000-00-00')
             ->get();
 
         });
 
         return $ipm_instauracao;
    }

    public function QtdOMAnos($unidade='', $ano='')
    {
        $unidade = !$unidade ? $this->unidade : $unidade;
        //inicializar a variável
        $ipm_ano = [];
        if($ano != '')
        {
            $ipm_ano = DB::connection('sjd')
            ->table('ipm')
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
                //Quantidade de ipm por ano
                $qtd_ipm_ano = DB::connection('sjd')
                ->table('ipm')
                ->select(DB::raw('count(sjd_ref) AS qtd'))
                ->where('sjd_ref_ano','=',$i)
                ->where('cdopm','like',$unidade.'%')
                ->groupBy('sjd_ref_ano')
                ->first();
                //insere no array para ficar 'ano' => 'qtd'
                $ipm_ano = array_add($ipm_ano,$i, $qtd_ipm_ano['qtd']);
            }
        }
        
        return $ipm_ano;
    }


}

