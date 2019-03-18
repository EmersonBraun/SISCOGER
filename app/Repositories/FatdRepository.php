<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;
use Cache;
use App\User;
use App\Models\Sjd\Proc\Fatd;
use App\Repositories\BaseRepository;

class FatdRepository extends BaseRepository
{
    protected $model;
    protected static $expiration = 60; 

	public function __construct(Fatd $model)
	{
		$this->model = $model;
    }
    
    public function all()
	{
        $unidade = session('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {
            $registros = Cache::remember('todos_fatd', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_fatd_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')->get();
            });
        }

        return $registros;
    } 

    public function ano($ano)
	{
        $unidade = session('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {
            $registros = Cache::remember('todos_fatd'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_fatd_'.$unidade.$ano, self::$expiration, function() use ($unidade, $ano) {
                return $this->model->where('cdopm','like',$unidade.'%')->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        return $registros;
    } 

    public function andamento()
	{
        $unidade = session('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {
            $registros = Cache::remember('andamento_fatd', self::$expiration, function() {
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
            $registros = Cache::remember('andamento_fatd_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
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
        $unidade = session('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {
            $registros = Cache::remember('andamento_fatd', self::$expiration, function() use ($ano){
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
            $registros = Cache::remember('andamento_fatd_'.$unidade, self::$expiration, function() use ($unidade, $ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
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
        $unidade = session('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {
            $registros = Cache::remember('julgamento_fatd', self::$expiration, function() {
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
            $registros = Cache::remember('julgamento_fatd_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
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
        $unidade = session('cdopmbase');
        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {
            $registros = Cache::remember('julgamento_fatd', self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
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
            $registros = Cache::remember('julgamento_fatd_'.$unidade, self::$expiration, function() use ($unidade,$ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
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
        //traz os dados do usuário
        $unidade = session()->get('cdopmbase');

        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {

            $registros = Cache::remember('fatd_prazo_opm', self::$expiration, function() {
                return $this->model
                    ->selectRaw('DISTINCT fatd.*,
                    (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM    sobrestamento WHERE sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros,
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW()))+1 AS dutotal, 
                    b.dusobrestado, 
                    (dias_uteis(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_fatd, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
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
            $registros = Cache::remember('fatd'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade){
                return $this->model
                    ->selectRaw('DISTINCT fatd.*,
                    (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM    sobrestamento WHERE sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros,
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW()))+1 AS dutotal, 
                    b.dusobrestado, 
                    (dias_uteis(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_fatd, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_fatd!= '' GROUP BY id_fatd) b"),
                        'b.id_fatd', '=', 'fatd.id_fatd')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('fatd.cdopm','like',$unidade.'%')
                    ->get();

            });   
        }
        return $registros;
    }

    public function prazosAno($ano)
    {
        //traz os dados do usuário
        $unidade = session()->get('cdopmbase');

        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {

            $registros = Cache::remember('fatd_prazo_opm'.$ano, self::$expiration, function() use ($ano) {
                return $this->model
                    ->selectRaw('DISTINCT fatd.*,
                    (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM    sobrestamento WHERE sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros,
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW()))+1 AS dutotal, 
                    b.dusobrestado, 
                    (dias_uteis(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_fatd, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
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
            $registros = Cache::remember('fatd'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade, $ano){
                return $this->model
                    ->selectRaw('DISTINCT fatd.*,
                    (SELECT  motivo FROM    sobrestamento WHERE   sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM    sobrestamento WHERE sobrestamento.id_fatd=fatd.id_fatd ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros,
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW()))+1 AS dutotal, 
                    b.dusobrestado, 
                    (dias_uteis(abertura_data,DATE(NOW()))+1-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_fatd, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_fatd!= '' GROUP BY id_fatd) b"),
                        'b.id_fatd', '=', 'fatd.id_fatd')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_fatd', '=', 'fatd.id_fatd')
                            ->where('envolvido.situacao', '=', 'Encarregado')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('fatd.sjd_ref_ano','=',$ano)
                    ->where('fatd.cdopm','like',$unidade.'%')
                    ->get();

            });   
        }
        return $registros;
    }

}

