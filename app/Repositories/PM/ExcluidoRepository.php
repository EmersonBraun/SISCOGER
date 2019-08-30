<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ExcluidoRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

    public function cleanCache()
	{
        Cache::tags('pm_excluido')->flush();
    }
    
    public function conselhos()
	{
        $unidade = session('cdopmbase');
        $verTodasUnidades = session('ver_todas_unidades');

        if($verTodasUnidades)
        {

            $registros = Cache::tags('pm_excluido')->remember('todos_exclusao_conselhos', $this->expiration, function() {
                return DB::table('view_excluido_procedimentos')->get();
            });
        }
        else 
        {
            $registros = Cache::tags('pm_excluido')->remember('exclusao_conselhos:unidade'.$unidade, $this->expiration, function() use ($unidade){
                return DB::table('view_excluido_procedimentos')
                ->orWhere('adl_cdopm',$unidade)
                ->orWhere('cd_cdopm',$unidade)
                ->orWhere('cj_cdopm',$unidade)
                ->get();
            });
        }
        return $registros;
    } 

    public function judicial()
	{
        $registros = Cache::tags('pm_excluido')->remember('todos_exclusao_judicial', $this->expiration, function() {
            return DB::table('exclusaojudicial')->get();
        });

        return $registros;
    }

    public function estaExcluido($rg)
    {
        $registros = Cache::tags('pm_excluido')->remember('esta_excluido:rg'.$rg, $this->expiration, function() use($rg){
            return DB::table('envolvido')
                    ->where('resultado','=', 'Excluído')
                    ->where('exclusaobg_numero','>', 0)
                    ->where('rg','=', $rg)
                    ->first();
        });
        
        $registros = (is_null($registros)) ? false : (object) $registros;

        return $registros;
    }

    public function excluidoGeral()
    {
        $registros = Cache::tags('pm_excluido')->remember('esta_excluido:geral', $this->expiration, function() {
            return DB::table('envolvido')
                    ->where('resultado','=', 'Excluído')
                    ->where('exclusaobg_numero','>', 0)
                    ->get();
        });
    
        return $registros;
    }

}
