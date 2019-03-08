<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;
use Cache;
use App\User;
use App\Models\Sjd\Proc\Iso;
use App\Repositories\BaseRepository;

class IsoRepository extends BaseRepository
{
    protected $model;
    protected static $expiration = 60; 

	public function __construct(Iso $model)
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
            $registros = Cache::remember('todos_iso', self::$expiration, function() {
                return $this->model->all();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_iso_'.$unidade, self::$expiration, function() use ($unidade) {
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
            $registros = Cache::remember('todos_iso'.$ano, self::$expiration, function() use ($ano) {
                return $this->model->where('sjd_ref_ano','=',$ano)->get();
            });
        }
        else 
        {
            $registros = Cache::remember('todos_iso_'.$unidade.$ano, self::$expiration, function() use ($unidade, $ano) {
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
            $registros = Cache::remember('andamento_iso', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_iso', '=', 'iso.id_iso')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::remember('andamento_iso_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_iso', '=', 'iso.id_iso')
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
            $registros = Cache::remember('andamento_iso', self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_iso', '=', 'iso.id_iso')
                        ->where('envolvido.situacao', '=', 'Presidente')
                        ->where('envolvido.rg_substituto', '=', ''); 
                    })->get();
            });
        }
        else 
        {
            $registros = Cache::remember('andamento_iso_'.$unidade, self::$expiration, function() use ($unidade, $ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                    $join->on('envolvido.id_iso', '=', 'iso.id_iso')
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
            $registros = Cache::remember('julgamento_iso', self::$expiration, function() {
                return $this->model
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_iso', '=', 'iso.id_iso')
                                ->where('envolvido.id_iso', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','iso'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::remember('julgamento_iso_'.$unidade, self::$expiration, function() use ($unidade) {
                return $this->model->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_iso', '=', 'iso.id_iso')
                                ->where('envolvido.id_iso', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','iso'))
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
            $registros = Cache::remember('julgamento_iso', self::$expiration, function() use ($ano){
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->leftJoin('envolvido', function ($join) {
                        $join->on('envolvido.id_iso', '=', 'iso.id_iso')
                                ->where('envolvido.id_iso', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','iso'))
                    ->get();
            });
        }
        else 
        {
            $registros = Cache::remember('julgamento_iso_'.$unidade, self::$expiration, function() use ($unidade,$ano) {
                return $this->model->where('sjd_ref_ano', '=' ,$ano)
                    ->where('cdopm','like',$unidade.'%')
                    ->leftJoin('envolvido', function ($join){
                        $join->on('envolvido.id_iso', '=', 'iso.id_iso')
                                ->where('envolvido.id_iso', '<>', 0);
                    })
                    ->leftJoin('punicao', 'punicao.id_punicao', '=', 'envolvido.id_punicao')
                    ->where('envolvido.situacao','=',sistema('procSituacao','iso'))
                    ->get();
            });
        }
        return $registros;
    }

    public static function prazos()
    {
        //traz os dados do usuário
        $unidade = session()->get('cdopmbase');

        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {

            $registros = Cache::remember('iso_prazo_opm', self::$expiration, function() {
                return DB::connection('sjd')->select('SELECT iso.*, envolvido.cargo, envolvido.nome, 
                    (DATEDIFF(DATE(NOW()),abertura_data)+1) AS diasuteis FROM iso
                    LEFT JOIN envolvido ON envolvido.id_iso=iso.id_iso AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto', 
                        [
                            'situacao' => 'Encarregado',
                            'rg_substituto' => ''
                        ]); 
                    });
                    
        }
        else 
        {
                $registros = Cache::remember('iso'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade){
                        return DB::connection('sjd')->select('SELECT iso.*, envolvido.cargo, envolvido.nome, 
                            (DATEDIFF(DATE(NOW()),abertura_data)+1) AS diasuteis FROM iso
                            LEFT JOIN envolvido ON
                                envolvido.id_iso=iso.id_iso AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto
                            WHERE ipm.cdopm like :unidade%', 
                                [
                                    'situacao' => 'Encarregado',
                                    'rg_substituto' => '',
                                    'unidade' => $unidade
                                ]); 
    
                });   
        }
        return $registros;
    }

    public static function prazosAno($ano)
    {
        //traz os dados do usuário
        $unidade = session()->get('cdopmbase');

        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {

            $registros = Cache::remember('iso_prazo_opm'.$ano, self::$expiration, function() use ($ano) {
                return DB::connection('sjd')->select('SELECT iso.*, envolvido.cargo, envolvido.nome, 
                    (DATEDIFF(DATE(NOW()),abertura_data)+1) AS diasuteis FROM iso
                    LEFT JOIN envolvido ON envolvido.id_iso=iso.id_iso AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto 
                    WHERE iso.sjd_ref_ano = :ano', 
                        [
                            'situacao' => 'Encarregado',
                            'rg_substituto' => '',
                            'ano' => $ano
                        ]); 
                });
                    
        }
        else 
        {
            $registros = Cache::remember('iso'.$unidade.'_prazo_topm', self::$expiration, function() use ($unidade, $ano){
                return DB::connection('sjd')->select('SELECT iso.*, envolvido.cargo, envolvido.nome, 
                    (DATEDIFF(DATE(NOW()),abertura_data)+1) AS diasuteis FROM iso
                    LEFT JOIN envolvido ON
                        envolvido.id_iso=iso.id_iso AND envolvido.situacao=:situacao AND rg_substituto=:rg_substituto
                    WHERE ipm.cdopm like :unidade% AND sjd_ref_ano = :ano', 
                        [
                            'situacao' => 'Encarregado',
                            'rg_substituto' => '',
                            'unidade' => $unidade,
                            'ano' => $ano
                        ]); 

            });   
        }
        return $registros;
    }


}

