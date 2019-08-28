<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;
use App\Models\Sjd\Policiais\Sai;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class SaiRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

	public function __construct(Sai $model)
	{
        $this->model = $model;      
    }

    public function cleanCache()
	{
        Cache::tags('sai')->flush();
    }
    
    public function ano($ano)
	{
        $registros = Cache::tags('sai')->remember('saiss:'.$ano, $this->expiration, function() use ($ano){
            return $this->model->where([
               ['data','>=',$ano.'-01-01'],
               ['data','<=',$ano.'-12-31'],
            ])
            ->orWhere('sjd_ref_ano',$ano)
            ->get();
        });

        return $registros;
    } 


    public function prazoAno($ano)
    {
        //traz os dados do usuário
        $unidade = session()->get('cdopmbase');

        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');
        

        if($verTodasUnidades)
        {
            $registros = Cache::tags('sai')->remember('prazo_sai:'.$ano, $this->expiration, function() use ($ano){
                return $this->model
                    ->selectRaw('sai.*, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                    b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                    ->leftJoin(
                        DB::raw("(SELECT id_sai, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                        WHERE termino_data != '0000-00-00' AND id_sai != '' GROUP BY id_sai ORDER BY sobrestamento.id_sai ASC LIMIT 1) b"),
                        'b.id_sai', '=', 'sai.id_sai')
                    ->where([
                        ['data','>=',$ano.'-01-01'],
                        ['data','<=',$ano.'-12-31'],
                     ])
                    ->get();
            });             
        }
        else 
        {
            $registros = Cache::tags('sai')->remember('prazo_sai:'.$ano.':'.$unidade, $this->expiration, function() use ($unidade, $ano){
                return $this->model
                ->selectRaw('sai.*, DIASUTEIS(abertura_data,DATE(NOW())) AS dutotal, 
                b.dusobrestado, (DIASUTEIS(abertura_data,DATE(NOW()))-IFNULL(b.dusobrestado,0)) AS diasuteis')
                ->leftJoin(
                    DB::raw("(SELECT id_sai, SUM(dias_uteis(inicio_data, termino_data)+1) AS dusobrestado FROM sobrestamento
                    WHERE termino_data != '0000-00-00' AND id_sai != '' GROUP BY id_sai ORDER BY sobrestamento.id_sai ASC LIMIT 1) b"),
                    'b.id_sai', '=', 'sai.id_sai')
                ->where([
                    ['data','>=',$ano.'-01-01'],
                    ['data','<=',$ano.'-12-31'],
                 ])
                ->where('sai.cdopm','like',$unidade.'%')
                ->get();

            });   
        }
        return $registros;
    }

    public function resultado($ano)
    {
        //traz os dados do usuário
        $unidade = session()->get('cdopmbase');

        //verifica se o usuário tem permissão para ver todas unidades
        $verTodasUnidades = session('ver_todas_unidades');
        

        if($verTodasUnidades)
        {
            $registros = Cache::tags('sai')->remember('ligacao_sai:'.$ano, $this->expiration, function() use ($ano){
                return $this->model
                    ->leftJoin('ligacao','ligacao.id_sai', '=', 'sai.id_sai')
                    ->where([
                        ['data','>=',$ano.'-01-01'],
                        ['data','<=',$ano.'-12-31'],
                     ])
                    ->get();
            });             
        }
        else 
        {
            $registros = Cache::tags('sai')->remember('ligacao_sai:'.$ano.':'.$unidade, $this->expiration, function() use ($unidade, $ano){
                return $this->model
                ->leftJoin('ligacao','ligacao.id_sai', '=', 'sai.id_sai')
                ->where([
                    ['data','>=',$ano.'-01-01'],
                    ['data','<=',$ano.'-12-31'],
                 ])
                ->where('sai.cdopm','like',$unidade.'%')
                ->get();

            });   
        }
        return $registros;
    }

    
}
