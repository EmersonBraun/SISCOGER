<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;
use Cache;
use App\User;
use App\Models\Sjd\Proc\Cj;
use App\Repositories\BaseRepository;

class CjRepository extends BaseRepository
{
    protected $model;
    protected static $expiration = 60; 

	public function __construct(Cj $model)
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
            $registros = Cache::remember('todos_cj', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_cj_'.$unidade, self::$expiration, function() use ($unidade) {
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
            $registros = Cache::remember('todos_cj'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_cj_'.$unidade.$ano, self::$expiration, function() use ($unidade, $ano) {
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
            $registros = Cache::remember('andamento_cj', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_cj', '=', 'cj.id_cj')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::remember('andamento_cj_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_cj', '=', 'cj.id_cj')
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
            $registros = Cache::remember('andamento_cj', self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_cj', '=', 'cj.id_cj')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::remember('andamento_cj_'.$unidade, self::$expiration, function() use ($unidade, $ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_cj', '=', 'cj.id_cj')
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
            $registros = Cache::remember('julgamento_cj', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_cj', '=', 'cj.id_cj')
                                ->where('envolvido.id_cj', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','cj'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::remember('julgamento_cj_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_cj', '=', 'cj.id_cj')
                                ->where('envolvido.id_cj', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','cj'))
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
            $registros = Cache::remember('julgamento_cj', self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_cj', '=', 'cj.id_cj')
                                ->where('envolvido.id_cj', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','cj'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::remember('julgamento_cj_'.$unidade, self::$expiration, function() use ($unidade,$ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_cj', '=', 'cj.id_cj')
                                ->where('envolvido.id_cj', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','cj'))
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

            $registros = Cache::remember('cj_prazo_opm', self::$expiration, function() {
                return $this->model
                    ->selectRaw('cj.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_cj=cj.id_cj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_cj=cj.id_cj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_cj, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_cj != '' GROUP BY id_cj ORDER BY sobrestamento.id_cj ASC LIMIT 1) b"),
                        'b.id_cj', '=', 'cj.id_cj')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_cj', '=', 'cj.id_cj')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->get();

            });
                    
        }
        else 
        {
            $registros = Cache::remember('cj'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade){
                return $this->model
                    ->selectRaw('cj.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_cj=cj.id_cj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_cj=cj.id_cj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_cj, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_cj != '' GROUP BY id_cj ORDER BY sobrestamento.id_cj ASC LIMIT 1) b"),
                        'b.id_cj', '=', 'cj.id_cj')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_cj', '=', 'cj.id_cj')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('adl.cdopm','=',$unidade)
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

            $registros = Cache::remember('cj_prazo_opm'.$ano, self::$expiration, function() use ($ano) {
                return $this->model
                    ->selectRaw('cj.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_cj=cj.id_cj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_cj=cj.id_cj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_cj, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_cj != '' GROUP BY id_cj ORDER BY sobrestamento.id_cj ASC LIMIT 1) b"),
                        'b.id_cj', '=', 'cj.id_cj')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_cj', '=', 'cj.id_cj')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('adl.sjd_ref_ano','=',$ano)
                    ->get();
                });
                    
        }
        else 
        {
            $registros = Cache::remember('cj'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade, $ano){
                return $this->model
                    ->selectRaw('cj.*, 
                    (SELECT  motivo FROM sobrestamento WHERE sobrestamento.id_cj=cj.id_cj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo,  
                    (SELECT  motivo_outros FROM sobrestamento WHERE   sobrestamento.id_cj=cj.id_cj ORDER BY sobrestamento.id_sobrestamento DESC LIMIT 1) AS motivo_outros, 
                    envolvido.cargo, envolvido.nome, dias_uteis(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (dias_uteis(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_cj, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_cj != '' GROUP BY id_cj ORDER BY sobrestamento.id_cj ASC LIMIT 1) b"),
                        'b.id_cj', '=', 'cj.id_cj')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_cj', '=', 'cj.id_cj')
                            ->where('envolvido.situacao', '=', 'Presidente')
                            ->where('envolvido.rg_substituto', '=', '');
                    })
                    ->where('adl.cdopm','=',$unidade)
                    ->where('adl.sjd_ref_ano','=',$ano)
                    ->get();

            });   
        }
        return $registros;
    }


}

