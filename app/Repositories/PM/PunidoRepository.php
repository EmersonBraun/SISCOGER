<?php
//Aqui ficam as consultas de banco de dados dos processos e procedimentos
namespace App\Repositories\PM;

use Cache;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Models\Sjd\Policiais\Punicao;

class PunidoRepository extends BaseRepository
{
    protected $model;
    protected $unidade;
    protected $verTodasUnidades;
    protected $expiration = 60 * 24;//um dia; 

    public function __construct(Punicao $model)
	{
        $this->model = $model;    
    }

    public function cleanCache()
	{
        Cache::tags('punido')->flush();
    }
    
    public function all()
	{
        $unidade = session('cdopmbase');
        $verTodasUnidades = session('ver_todas_unidades');
        $verSuperior = session('ver_superior');
        
        $nivel = session('nivel');
        if(!$verSuperior) $cargosPodeVer = $this->cargosQuePodeVer($nivel);

        if($verTodasUnidades)
        {
            if($verSuperior)
            {
                $registros = Cache::tags('punido')->remember('todos_punido', $this->expiration, function() {
                    return $this->model->all();
                });
            }
            else
            {
                $registros = Cache::tags('punido')->remember('todos_punido:nivel'.$nivel, $this->expiration, function() use ($cargosPodeVer) {
                    return $this->model->whereIn('cargo',$cargosPodeVer)->get();
                });
            }
        }
        else 
        {
            if($verSuperior)
            {
                $registros = Cache::tags('punido')->remember('punido:unidade'.$unidade, $this->expiration, function() use ($unidade){
                    return $this->model->where('cdopm',$unidade)->get();
                });
            }
            else
            {
                $registros = Cache::tags('punido')->remember('punido:unidade'.$unidade.':'.$nivel, $this->expiration, function() use ($cargosPodeVer, $unidade){
                    return $this->model->whereIn('cargo',$cargosPodeVer)->where('cdopm',$unidade)->get();
                });
            }
        }

        return $registros;
    } 

    public function conselhos()
	{
        $unidade = session('cdopmbase');
        $verTodasUnidades = session('ver_todas_unidades');
        $verSuperior = session('ver_superior');
        
        $nivel = session('nivel');
        if(!$verSuperior) $cargosPodeVer = $this->cargosQuePodeVer($nivel);

        if($verTodasUnidades)
        {
            if($verSuperior)
            {
                $registros = Cache::tags('punido')->remember('todos_punido_conselhos', $this->expiration, function() {
                    return DB::table('view_punicao_conselhos')->get();
                });
            }
            else
            {
                $registros = Cache::tags('punido')->remember('todos_punido_conselhos:nivel'.$nivel, $this->expiration, function() use ($cargosPodeVer) {
                    return DB::table('view_punicao_conselhos')->whereIn('cargo',$cargosPodeVer)->get();
                });
            }
        }
        else 
        {
            if($verSuperior)
            {
                $registros = Cache::tags('punido')->remember('punido_conselhos:unidade'.$unidade, $this->expiration, function() use ($unidade){
                    return DB::table('view_punicao_conselhos')->where('cdopm',$unidade)->get();
                });
            }
            else
            {
                $registros = Cache::tags('punido')->remember('punido_conselhos:unidade'.$unidade.':'.$nivel, $this->expiration, function() use ($cargosPodeVer, $unidade){
                    return DB::table('view_punicao_conselhos')->whereIn('cargo',$cargosPodeVer)->where('cdopm',$unidade)->get();
                });
            }
        }

        return $registros;
    } 

    public function cargosQuePodeVer($nivel)
    {
        $postos = [
            'CELAGREG' => '0',
            'CEL' => '1',
            'TENCEL' => '2',
            'MAJ' => '3',
            'CAP' => '4',
            '1TEN' => '5',
            '2TEN' => '6',
            'ASPOF' => '7',
            'ALUNO' => '8',
            'ALUNO3A' => '9',
            'ALUNO2A' => '10',
            'ALUNO1A' => '11',
            'SUBTEN' => '12',
            '1SGT' => '13',
            '2SGT' => '14',
            '3SGT' => '15',
            'CABO' => '16',
            'SD1C' => '17',
            'SD2C' => '18'
        ];

        $podeVer = array_filter($postos, function($element) use ($nivel) 
        {
            return ($element > $nivel); 
        });

        return array_keys($podeVer);
    }

}
